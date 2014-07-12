<?php

namespace App\Controllers\Frontend;

class UserController extends \BaseController {
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

    function register() {
        $data['page'] = array(
            'title' => 'Register',
            'view' => 'frontend.user.register',
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list')
        );
        return \View::make($data['page']['view'], $data);
    }

    function login() {
        $data['page'] = array(
            'title' => 'เข้าสู่ระบบ / ลงทะเบียน',
            'view' => 'frontend.user.login',
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list')
        );
        return \View::make($data['page']['view'], $data);
    }

    function activateUser($param) {
        if (\User::where('salt', $param)->where('verified', 0)->count() > 0) {
            $fuser = \User::where('salt', $param)
                    ->where('verified', 0)
                    ->get();
            \User::where('salt', $param)->update(array('verified' => 1));
            $user = new \Toddish\Verify\Models\User;
            $user->id = $fuser[0]->id;
            $user->roles()->sync(array(26));
            $rtxt = 'ยืนยันการสมัครสมาชิกเสร็จเรียบร้อยแล้ว คุณสามารถเข้าสู่ระบบได้ทันที';
            $ac_status = 0;
            $dealerattachments = new \Dealerattachments();
            $dealerattachments->user_id = $fuser[0]->id;
            $dealerattachments->save();

            $data = array(
                'fullname' => $fuser[0]->firstname . ' ' . $fuser[0]->lastname,
                'email' => $fuser[0]->email
            );

            \Mail::send('frontend.user.email.activate_success', $data, function($message) use ($data) {
                $message->to($data['email'], $data['fullname'])->subject('Inside IT Distribution Register Success');
            });
        } else {
            $rtxt = 'ยืนยันการสมัครผิดพลาด กรุณาลองใหม่อีกครั้ง หรือติดต่อเจ้าหน้าที่';
            $ac_status = 1;
        }

        $data['page'] = array(
            'title' => 'ยืนยันการสมัครสมาชิก',
            'view' => 'frontend.user.user_activate',
            'msg' => $rtxt,
            'ac_status' => $ac_status,
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list')
        );
        return \View::make($data['page']['view'], $data);
    }

    function dashboard() {
        $data['page'] = array(
            'title' => 'บัญชี',
            'view' => 'frontend.user.dashboard',
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list')
        );
        return \View::make($data['page']['view'], $data);
    }

    function editProfile() {
        $data['page'] = array(
            'title' => 'แก้ไขบัญชี',
            'view' => 'frontend.user.profile_edit',
            'item' => \User::find(\Auth::user()->id),
            'file' => \Dealerattachments::where('user_id', \Auth::user()->id)->get(),
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list')
        );
        return \View::make($data['page']['view'], $data);
    }

    function editShipping() {
        $shipping = \DB::table('shopping_shipping_address')->where('users_id', \Auth::user()->id)->get();
        $shipping_user = $shipping[0];

        $data['page'] = array(
            'title' => 'Shipping',
            'view' => 'frontend.user.shipping_edit',
            'item' => $shipping_user,
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list')
        );
        return \View::make($data['page']['view'], $data);
    }

    function editShoppingTax() {
        $shipping = \DB::table('shopping_tax')->where('users_id', \Auth::user()->id)->get();
        $shipping_user = $shipping[0];

        $data['page'] = array(
            'title' => 'Tax Information',
            'view' => 'frontend.user.tax_edit',
            'item' => $shipping_user,
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list')
        );
        return \View::make($data['page']['view'], $data);
    }

    ##############################

    public function registerSave() {
        $rules = array(
            'firstname' => 'required|min:3|max:30',
            'lastname' => 'required|min:3|max:30',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
            'recaptcha_response_field' => 'required|recaptcha',
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'form' => 'frmRegister',
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            try {
                $user = new \Toddish\Verify\Models\User;
                $user->firstname = trim(\Input::get('firstname'));
                $user->lastname = trim(\Input::get('lastname'));
                $user->email = trim(\Input::get('email'));
                $user->mobile = trim(\Input::get('mobile'));
                $user->password = trim(\Input::get('password'));
                $user->save();
                $user->roles()->sync(array(12));

                $shippingadd = new \Shippingaddress();
                $shippingadd->users_id = $user->id;
                $shippingadd->firstname = NULL;
                $shippingadd->lastname = NULL;
                $shippingadd->mobile = NULL;
                $shippingadd->address = NULL;
                $shippingadd->province = 0;
                $shippingadd->amphur = 0;
                $shippingadd->district = 0;
                $shippingadd->zipcode = NULL;
                $shippingadd->save();

                $shoppingtax = new \Shoppingtax();
                $shoppingtax->users_id = $user->id;
                $shoppingtax->companyname = NULL;
                $shoppingtax->address = NULL;
                $shoppingtax->taxcode = NULL;
                $shoppingtax->save();

                //send mail
                $dt = \Carbon::createFromTimeStamp(strtotime($user->created_at));
                $data = array(
                    'fullname' => \Input::get('firstname') . ' ' . \Input::get('lastname'),
                    'email' => \Input::get('email'),
                    'link' => link_to('user/activate/' . $user->salt . '', 'ยืนยันการสมัครสมาชิก'),
                    'expire' => $dt->addHours(24)->toDateString()
                );

                \Mail::send('frontend.user.email.activate_register', $data, function($message) use ($data) {
                    $message->to($data['email'], $data['fullname'])->subject('Inside IT Distribution Register confirm email!');
                });

                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'delay' => 5000,
                                'message' => 'กรุณาตรวจสอบอีเมล์ เพื่อทำการยืนยันการลงทะเบียน'
                            ), 200));
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    public function editProfileSave() {
        $file1 = \Input::file('file1');
        $file2 = \Input::file('file2');
        $file3 = \Input::file('file3');
        $file4 = \Input::file('file4');
        $file5 = \Input::file('file5');
        $rules = array(
            'firstname' => 'required|min:3|max:30',
            'lastname' => 'required|min:3|max:30',
            'id_card' => 'required',
            'mobile' => 'required|min:3|max:20',
            'address' => 'required|min:6|max:255',
            'province' => 'required',
            'amphur' => 'required',
            'district' => 'required',
            'file1' => 'mimes:doc,docx,pdf|max:1024',
            'file2' => 'mimes:doc,docx,pdf|max:1024',
            'file3' => 'mimes:doc,docx,pdf|max:1024',
            'file4' => 'mimes:doc,docx,pdf|max:1024',
            'file5' => 'mimes:doc,docx,pdf|max:1024'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'form' => 'form-add',
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            try {

                $user = \User::find(\Auth::user()->id);
                $user->firstname = trim(\Input::get('firstname'));
                $user->lastname = trim(\Input::get('lastname'));
                $user->id_card = trim(\Input::get('id_card'));
                $user->mobile = trim(\Input::get('mobile'));
                $user->address = trim(\Input::get('address'));
                $user->province = \Input::get('province');
                $user->amphur = \Input::get('amphur');
                $user->district = \Input::get('district');
                $user->zipcode = trim(\Input::get('zipcode'));
                $user->biz_type = \Input::get('biz_type');
                $user->company_name = trim(\Input::get('company_name'));
                $user->save();

                $destinationPath = 'uploads/user/attachments/' . date('Ymd') . '/';
                if ($file1 != NULL) {
                    $f1 = $this->uploadfile(array('file' => $file1, 'pathfile' => $destinationPath));
                    \Dealerattachments::where('user_id', \Auth::user()->id)->update(array('file1' => $f1));
                }
                if ($file2 != NULL) {
                    $f2 = $this->uploadfile(array('file' => $file2, 'pathfile' => $destinationPath));
                    \Dealerattachments::where('user_id', \Auth::user()->id)->update(array('file2' => $f2));
                }
                if ($file3 != NULL) {
                    $f3 = $this->uploadfile(array('file' => $file3, 'pathfile' => $destinationPath));
                    \Dealerattachments::where('user_id', \Auth::user()->id)->update(array('file3' => $f3));
                }
                if ($file4 != NULL) {
                    $f4 = $this->uploadfile(array('file' => $file4, 'pathfile' => $destinationPath));
                    \Dealerattachments::where('user_id', \Auth::user()->id)->update(array('file4' => $f4));
                }
                if ($file5 != NULL) {
                    $f5 = $this->uploadfile(array('file' => $file5, 'pathfile' => $destinationPath));
                    \Dealerattachments::where('user_id', \Auth::user()->id)->update(array('file5' => $f5));
                }
                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'delay' => 3000,
                                'message' => 'Save data success.'
                            ), 200));
            } catch (\Exception $ex) {
                throw $ex;
            }
        }
    }

    public function editShippingSave() {
        $rules = array(
            'firstname2' => 'required|min:3|max:30',
            'lastname2' => 'required|min:3|max:30',
            'mobile2' => 'required|min:3|max:20',
            'address2' => 'required|min:6|max:255',
            'province2' => 'required',
            'amphur2' => 'required',
            'district2' => 'required'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'form' => 'form-add',
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            try {
                $shippingadd = \Shippingaddress::where('users_id', \Auth::user()->id)->first();
                $shippingadd->firstname = trim(\Input::get('firstname2'));
                $shippingadd->lastname = trim(\Input::get('lastname2'));
                $shippingadd->mobile = trim(\Input::get('mobile2'));
                $shippingadd->address = trim(\Input::get('address2'));
                $shippingadd->province = \Input::get('province2');
                $shippingadd->amphur = \Input::get('amphur2');
                $shippingadd->district = \Input::get('district2');
                $shippingadd->zipcode = trim(\Input::get('zipcode2'));
                $shippingadd->save();

                $user = \User::find(\Auth::user()->id);
                $user->addresscopy = (\Input::has('addresscopy') ? \Input::get('addresscopy') : 1);
                $user->save();

                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'delay' => 3000,
                                'message' => 'Save data success.'
                            ), 200));
            } catch (\Exception $ex) {
                throw $ex;
            }
        }
    }

    public function editShoppingTaxSave() {
        $rules = array(
            'companyname' => 'required|min:3|max:100',
            'address' => 'required|min:3|max:30',
            'taxcode' => 'required|min:3|max:20'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'form' => 'form-add',
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            try {

                $shoppingtax = \Shoppingtax::where('users_id', \Auth::user()->id)->first();
                $shoppingtax->companyname = trim(\Input::get('companyname'));
                $shoppingtax->address = trim(\Input::get('address'));
                ;
                $shoppingtax->taxcode = trim(\Input::get('taxcode'));
                ;
                $shoppingtax->save();

                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'message' => 'Save data success.'
                            ), 200));
            } catch (\Exception $ex) {
                throw $ex;
            }
        }
    }

    public function uploadfile($param = array()) {
        $destinationPath = $param['pathfile'];
        $extension = $param['file']->getClientOriginalExtension();
        $filename = str_random(40) . '.' . $extension;
        $param['file']->move($destinationPath, $filename);
        return $destinationPath . $filename;
    }

    public function deleteAttachments($param) {
        $ils = \Dealerattachments::where('user_id', \Auth::user()->id)->get();
        if ($param == 'file1') {
            if (\File::exists($ils[0]->file1)) {
                \File::delete($ils[0]->file1);
            }
            \Dealerattachments::where('user_id', \Auth::user()->id)->update(array('file1' => NULL));
        } elseif ($param == 'file2') {
            if (\File::exists($ils[0]->file2)) {
                \File::delete($ils[0]->file2);
            }
            \Dealerattachments::where('user_id', \Auth::user()->id)->update(array('file2' => NULL));
        } elseif ($param == 'file3') {
            if (\File::exists($ils[0]->file3)) {
                \File::delete($ils[0]->file3);
            }
            \Dealerattachments::where('user_id', \Auth::user()->id)->update(array('file3' => NULL));
        } elseif ($param == 'file4') {
            if (\File::exists($ils[0]->file4)) {
                \File::delete($ils[0]->file4);
            }
            \Dealerattachments::where('user_id', \Auth::user()->id)->update(array('file4' => NULL));
        } elseif ($param == 'file5') {
            if (\File::exists($ils[0]->file5)) {
                \File::delete($ils[0]->file5);
            }
            \Dealerattachments::where('user_id', \Auth::user()->id)->update(array('file5' => NULL));
        }
        return \Response::json(array(
                    'error' => array(
                        'status' => TRUE,
                        'message' => 'Delete file Success.'
                    ), 200));
    }

}
