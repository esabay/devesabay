<?php

namespace App\Controllers\Backend;

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of JdealerController
 *
 * @author R-D-6
 */
class JdealerController extends \BaseController {

    public function index() {
        $data['page'] = array(
            'title' => 'Overview',
            'view' => 'backend.jdealer.index',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Dealer' => '#',
                'Overview' => '#'
            )
        );
        return \View::make($data['page']['view'], $data);
    }

    public function dealer() {
        $data['page'] = array(
            'title' => 'Dealer',
            'view' => 'backend.jdealer.dealer',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Dealer' => 'backend/jdealer',
                'Dealer' => '#'
            ),
            'result' => \DB::table('users')
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->whereIn('role_user.role_id', array(12, 28))
                    ->where('users.disabled', 0)
                    ->paginate(20)
        );
        return \View::make($data['page']['view'], $data);
    }

    public function viewDealer($id) {
        if (!\Request::isMethod('post')) {
            $data['page'] = array(
                'title' => 'View Dealer',
                'view' => 'backend.jdealer.dealer_view',
                'breadcrumbs' => array(
                    'Dashboard' => 'backend',
                    'J-Dealer' => 'backend/jdealer',
                    'Dealer' => '#'
                ),
                'item' => \User::find($id),
                'file' => \Dealerattachments::where('user_id', $id)->get(),
            );
            return \View::make($data['page']['view'], $data);
        } else {
            try {
                $user = \User::find($id);
                //send email
                $data = array(
                    'fullname' => $user->firstname . ' ' . $user->lastname,
                    'email' => $user->email
                );

                \Mail::send('backend.jdealer.email.activate_success', $data, function($message) use ($data) {
                    $message->to($data['email'], $data['fullname'])->subject('Inside IT Distribution Change Status Dealer!');
                });

                $user->dealer = (\Input::has('dealer') ? 0 : 1);
                $user->disabled = (\Input::has('disabled') ? 0 : 1);
                $user->save();
                $user->roles()->sync(array(28));
                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'message' => 'Save data Success.'
                            ), 200));
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }
    }

}
