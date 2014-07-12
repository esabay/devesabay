<?php

namespace App\Controllers\Backend;

use Carbon\Carbon;

class CommonController extends \BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    function switchLang($ln) {
        if ($ln === 'en') {
            \App::setLocale('en');
        } elseif ($ln === 'th') {
            \App::setLocale('th');
        } else {
            \App::setLocale('en');
        }
    }

    function notification() {
        $data['page'] = array(
            'title' => 'Notification',
            'view' => 'backend.common.notification',
            'result' => \Systemnotifications::orderBy('id', 'desc')->paginate(20)
        );
        return \View::make($data['page']['view'], $data);
    }

    function process2() {
        $interface_path = 'uploads/interface/product/';
        $row = 1;
        if ($handle = opendir($interface_path)) {
            while (false !== ($file = readdir($handle))) {
                $file_lastname = explode(".", $file);
                if ($file_lastname[0] != "process" and $file_lastname[0] != "success" and $file_lastname[1] == "CSV" and $file_lastname[2] == "gz") {
                    $srcName = $interface_path . $file;
                    $this->uncompress($srcName);
                    \File::delete($srcName);
                    $file = $file_lastname[0] . "." . $file_lastname[1];
                    if (\File::exists($interface_path . $file)) {
                        if (\File::move($interface_path . $file, $interface_path . "process/" . $file)) {
                            if (($handle = fopen($interface_path . "process/" . $file, "r")) !== FALSE) {
                                $imp_pro_log = new \Impproductlog();
                                $imp_pro_log->product_file_name = $file;
                                $imp_pro_log->product_cre = 'system';
                                $imp_pro_log->product_upd = 'system';
                                $imp_pro_log->save();
                                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                    if ($row > 1) {

                                        $tmpimport = new \Tmpimport();
                                        $tmpimport->productcode = $data[0];
                                        $tmpimport->brand = $data[1];
                                        $tmpimport->unit = $data[2];
                                        $tmpimport->category = $data[3];
                                        $tmpimport->subcategory = $data[4];
                                        $tmpimport->productname = $data[5];
                                        $tmpimport->stockqty = $data[6];
                                        $tmpimport->warranty = $data[7];
                                        $tmpimport->price1 = $data[8];
                                        $tmpimport->price2 = $data[9];
                                        $tmpimport->price3 = $data[10];
                                        $tmpimport->price4 = $data[11];
                                        $tmpimport->price5 = $data[12];
                                        $tmpimport->limit_order1 = $data[13];
                                        $tmpimport->limit_order2 = $data[14];
                                        $tmpimport->limit_order3 = $data[15];
                                        $tmpimport->limit_order4 = $data[16];
                                        $tmpimport->limit_order5 = $data[17];
                                        $tmpimport->save();
                                    }
                                    $row++;
                                }
                                fclose($handle);
                                \File::move($interface_path . 'process/' . $file, $interface_path . "success/" . $file);
                                \DB::select('CALL PROC_PRODUCT_UPDATE');
                            }
                        }
                    }
                }
            }
        }
    }

    function uncompress($file) {
        $file_name = $file;
        $buffer_size = 4096; // read 4kb at a time
        $out_file_name = str_replace('.gz', '', $file_name);
        $file = gzopen($file_name, 'rb');
        $out_file = fopen($out_file_name, 'wb');
        while (!gzeof($file)) {
            fwrite($out_file, gzread($file, $buffer_size));
        }
        fclose($out_file);
        gzclose($file);
    }

}
