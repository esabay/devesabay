<?php

namespace App\Controllers\Backend;

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

    public function __construct() {
        $this->beforeFilter(function() {
            if (\Auth::user()->is('Administrator') == FALSE) {
                return \Redirect::to('backend');
            }
        });
    }

    public function getIndex() {
        $data['page'] = array(
            'title' => 'List item',
            'view' => 'backend.user.index',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'Setting' => '#',
                'User' => '#'
            ),
            'result' => \User::all()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addUser() {
        $data['page'] = array(
            'title' => 'Add User',
            'view' => 'backend.user.user_add',
            'result_roles' => \Roles::all()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function editUser() {
        $data['page'] = array(
            'title' => 'Edit User',
            'view' => 'backend.user.user_edit',
            'item' => \User::find(\Input::get('id')),
            'result_roles' => \Roles::all(),
            'result_user_role' => \DB::table('role_user')->where('user_id', \Input::get('id'))->lists('role_id')
        );

        return \View::make($data['page']['view'], $data);
    }

    public function profile() {
        $data['page'] = array(
            'title' => 'Profile',
            'view' => 'backend.user.profile',
            'item' => \User::find(\Auth::user()->id)
        );
        return \View::make($data['page']['view'], $data);
    }

    public function editProfile() {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('organization')->get();
        $ct = \Categorize::tree($categories);
        $arr_cat = array();
        foreach ($ct as $val) {
            $arr_cat[$val->id] = '- ' . $val->title;
        }
        $data['page'] = array(
            'title' => 'Edit Profile',
            'view' => 'backend.user.profile_edit',
            'item' => \User::find(\Auth::user()->id),
            'category' => $arr_cat
        );
        return \View::make($data['page']['view'], $data);
    }

######################################################

    public function addUserSave() {
        $rules = array(
            'username' => 'required|min:2|max:20',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required',
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
                $user = new \Toddish\Verify\Models\User;
                $user->username = \Input::get('username');
                $user->email = \Input::get('email');
                $user->password = \Input::get('password');
                $user->disabled = (\Input::has('disabled') ? \Input::get('disabled') : 0);
                $user->verified = (\Input::has('verified') ? \Input::get('verified') : 0);
                $user->save();
                if (\Input::get('role_id')) {
                    $user->roles()->sync(\Input::get('role_id'));
                }
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

    public function editUserSave() {

        $rules = array(
            'email' => 'required|email'
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
                $user = \User::find(\Input::get('id'));
                $user->username = trim(\Input::get('username'));
                $user->email = trim(\Input::get('email'));
                $user->verified = (\Input::has('verified') ? \Input::get('verified') : 0);
                $user->disabled = (\Input::has('disabled') ? \Input::get('disabled') : 0);
                $user->save();
                $roleuser = \Roleuser::where('user_id', \Input::get('id'))->count();
                if ($roleuser > 0) {
                    \Roleuser::where('user_id', \Input::get('id'))->delete();
                }
                $users = new \Toddish\Verify\Models\User;
                $users->id = \Input::get('id');
                $users->roles()->sync(\Input::get('role_id'));

                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'message' => 'Save data Success.'
                            ), 200));
            } catch (\Exception $ex) {
                throw $ex;
            }
        }
    }

    public function deleteUserSave() {
        try {
            \DB::transaction(function() {
                \User::find(\Input::get('id'))->delete();
            });
            return \Response::json(array(
                        'error' => array(
                            'status' => true,
                            'message' => array('Delete data success.'),
                        ), 200));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function editProfileSave() {
        $rules = array(
            'firstname' => 'min:3|max:50',
            'lastname' => 'min:3|max:50',
            'country' => 'min:3|max:50',
            'birthday' => 'date:yyyy-mm-dd',
            'occupation' => 'min:3|max:50',
            'email' => 'required|email',
            'mobile' => 'numeric',
            'website' => 'url'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'form' => '#form-profile-info',
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            try {
                $data = array(
                    'firstname' => \Input::get('firstname'),
                    'lastname' => \Input::get('lastname'),
                    'nickname' => \Input::get('nickname'),
                    'birthday' => \Input::get('birthday'),
                    'occupation' => \Input::get('occupation'),
                    'email' => \Input::get('email'),
                    'mobile' => \Input::get('mobile'),
                    'website' => \Input::get('website'),
                    'aboutme' => \Input::get('aboutme'),
                    'aboutme' => \Input::get('aboutme'),
                    'department_id' => \Input::get('department_id'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                \User::where('id', \Auth::user()->id)->update($data);
                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'message' => 'Save data Success.'
                            ), 200));
            } catch (\Exception $ex) {
                throw $ex;
            }
        }
    }

    public function editProfileLoginSave() {
        $rules = array(
            'password' => 'required|min:6|max:20|confirmed',
            'password_confirmation' => 'required'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            $user = \User::find(\Auth::user()->id);
            $user->password = trim(\Input::get('password'));
            $user->save();
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function editProfileAvatarSave() {
        $file = \Input::file('avatar');
        $rules = array(
            'avatar' => 'required|image|mimes:jpeg,png|max:512'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            $destinationPath = 'uploads/user/';
            $extension = $file->getClientOriginalExtension();
            $filename = str_random(40) . '.' . $extension;
            $newfile = 'avatar_' . $filename;
            $smallfile = 'small_' . $filename;
            \Input::file('avatar')->move($destinationPath, $filename);
            \Image::make($destinationPath . $filename)->resize(140, null, TRUE)->save($destinationPath . $newfile);
            \Image::make($destinationPath . $filename)->resize(null, 29, TRUE)->save($destinationPath . $smallfile);
            $data = array(
                'medium' => $destinationPath . $newfile,
                'small' => $destinationPath . $smallfile
            );
            \User::where('id', \Auth::user()->id)->update(array('avatar' => json_encode($data)));
            if (\File::exists($destinationPath . $filename)) {
                \File::delete($destinationPath . $filename);
            }
            return \Response::json(array('success' => true, 'file' => asset($destinationPath . $filename)));
        }
    }

}
