<?php

namespace App\Controllers\Backend;

class JbranchController extends \BaseController {
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
        $data['page'] = array(
            'title' => 'Overview',
            'view' => 'backend.jbranch.index',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Branch' => '#',
                'Overview' => '#'
            )
        );
        return \View::make($data['page']['view'], $data);
    }

    public function branch() {
        $data['page'] = array(
            'title' => 'Branch',
            'view' => 'backend.jbranch.branch',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Branch' => 'backend/jbranch',
                'Branch' => '#'
            ),
            'result' => \DB::table('users')
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->where('role_user.role_id', 28)
                    ->paginate(20)
        );
        return \View::make($data['page']['view'], $data);
    }

    public function editBranch($id) {
        if (!\Request::isMethod('post')) {
            $data['page'] = array(
                'title' => 'Branch',
                'view' => 'backend.jbranch.branch_edit',
                'breadcrumbs' => array(
                    'Dashboard' => 'backend',
                    'J-Branch' => 'backend/jbranch',
                    'Branch' => '#'
                ),
                'result' => \DB::table('users')
                        ->join('role_user', 'users.id', '=', 'role_user.user_id')
                        ->where('role_user.role_id', 28)
                        ->paginate(20)
            );
            return \View::make($data['page']['view'], $data);
        } else {
            
        }
    }

}
