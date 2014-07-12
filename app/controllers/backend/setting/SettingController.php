<?php

namespace App\Controllers\Backend;

class SettingController extends \BaseController {
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

    public function __construct() {
        $this->beforeFilter(function() {
            if (\Auth::user()->is('Administrator') == FALSE) {
                return \Redirect::to('backend');
            }
        });
    }

    public function index() {
        $sid = \Systemconfigwebsite::where('user_id', \Auth::user()->id)->get();
        $data['page'] = array(
            'title' => 'General',
            'view' => 'backend.setting.index',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'Setting' => '#'
            ),
            'item' => $sid[0]
        );
        return \View::make($data['page']['view'], $data);
    }

    public function saveSetting() {
        $rules = array(
            'site_name' => 'required|min:2|max:255',
            'from_address' => 'email'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            try {
                $sfw = \Systemconfigwebsite::find(\Input::get('id'));
                $sfw->site_name = trim(\Input::get('site_name'));
                $sfw->site_offline = (\Input::has('site_offline') ? \Input::get('site_offline') : 1);
                $sfw->offline_message = trim(\Input::get('offline_message'));
                $sfw->keywords = trim(\Input::get('meta_keywords'));
                $sfw->description = trim(\Input::get('meta_description'));
                $sfw->driver = trim(\Input::get('driver'));
                $sfw->host = trim(\Input::get('host'));
                $sfw->port = trim(\Input::get('port'));
                $sfw->from_address = trim(\Input::get('from_address'));
                $sfw->form_name = trim(\Input::get('form_name'));
                $sfw->username = trim(\Input::get('username'));
                $sfw->password = trim(\Input::get('password'));
                $sfw->updated_user = \Auth::user()->id;
                $sfw->save();
                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'message' => 'Save data Success.'
                            ), 200));
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

}
