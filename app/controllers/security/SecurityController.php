<?php

namespace App\Controllers;

class SecurityController extends \BaseController {
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

    public function getLogin() {
        // show the form
        return \View::make('backend.layouts.login');
    }

    public function getRegister() {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('organization')->get();
        $ct = \Categorize::tree($categories);
        $arr_cat = array();
        foreach ($ct as $val) {
            $arr_cat[$val->id] = '- ' . $val->title;
        }
        $data['page'] = array(
            'title' => 'Edit Profile',
            'view' => 'backend.security.register',
            'category' => $arr_cat
        );
        return \View::make($data['page']['view'], $data);
    }

    public function setRegisterSave() {
        $rules = array(
            'firstname' => 'required|min:3|max:30',
            'lastname' => 'required|min:3|max:30',
            'username' => 'required|min:2|unique:users',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users,email'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'form' => 'form-register',
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            try {
                $user = new \Toddish\Verify\Models\User;
                $user->firstname = \Input::get('firstname');
                $user->lastname = \Input::get('lastname');
                $user->email = \Input::get('email');
                $user->mobile = \Input::get('mobile');
                $user->username = \Input::get('username');
                $user->department_id = \Input::get('department_id');
                $user->password = \Input::get('password');
                $user->save();
                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'delay' => 10000,
                                'message' => 'Register Success'
                            ), 200));
            } catch (\Exception $ex) {
                throw $ex;
            }
        }
    }

    public function doLogin() {
        $rules = array(
            'username_login' => 'required|min:2|max:50', // make sure the email is an actual email
            'password_login' => 'required|min:6' // password can only be alphanumeric and has to be greater than 3 characters
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
                $userdata = array(
                    'identifier' => \Input::get('username_login'),
                    'password' => \Input::get('password_login')
                );
                if (\Auth::attempt($userdata)) {                                        
                    return \Response::json(array(
                                'error' => array(
                                    'status' => TRUE,
                                    'message' => array('Login Success.'),
                                ), 200));
                } else {
                    return \Response::json(array(
                                'error' => array(
                                    'status' => TRUE,
                                    'message' => array('Invalid username or password.'),
                                ), 400));
                }
            } catch (\UserNotFoundException $e) {
                echo $e;
            }
        }
    }

    public function webLogin() {
        $rules = array(
            'username_login' => 'required|min:5|max:100', // make sure the email is an actual email
            'password_login' => 'required|min:6' // password can only be alphanumeric and has to be greater than 3 characters
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'form' => 'frmLogin',
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            try {
                $userdata = array(
                    'identifier' => \Input::get('username_login'),
                    'password' => \Input::get('password_login')
                );
                $auth = \Auth::attempt($userdata);
                if ($auth) {
                    return \Response::json(array(
                                'error' => array(
                                    'status' => TRUE,
                                    'message' => array('Login Success.'),
                                ), 200));
                } else {
                    return \Response::json(array(
                                'error' => array(
                                    'status' => TRUE,
                                    'message' => array('Invalid username or password.'),
                                ), 400));
                }
            } catch (\UserNotFoundException $e) {
                echo $e;
            }
        }
    }

    public function getLogout() {
        \Auth::logout();
        return \Response::json(array(
                    'error' => array(
                        'status' => TRUE,
                        'message' => array('ออกจากระบบเรียบร้อยแล้ว.'),
                    ), 200));
    }

    public function webLogout() {
        \Auth::logout();
        \Redirect::to('/');
    }

}
