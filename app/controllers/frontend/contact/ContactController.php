<?php

namespace App\Controllers\Frontend;

class ContactController extends \BaseController {
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

    public function index() {
        if (!\Request::isMethod('post')) {
            $data['page'] = array(
                'title' => 'Contact',
                'view' => 'frontend.contact.index',
                'small_banner' => \App::make('WidgetController')->widget('small_banner'),
                'brands_list' => \App::make('WidgetController')->widget('brands_list')
            );
            return \View::make($data['page']['view'], $data);
        } else {
            $rules = array(
                'name' => 'required|max:100',
                'phone' => 'required|max:100',
                'email' => 'email',
                'title' => 'required|max:100',
                'message' => 'required|max:255',
                'recaptcha_response_field' => 'required|recaptcha',
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
                    $contact = new \Contactlist();
                    $contact->name = trim(\Input::get('name'));
                    $contact->phone = trim(\Input::get('phone'));
                    $contact->email = trim(\Input::get('email'));
                    $contact->group_id = \Input::get('group_id');
                    $contact->title = trim(\Input::get('title'));
                    $contact->message = trim(\Input::get('message'));
                    $contact->save();
                    return \Response::json(array(
                                'error' => array(
                                    'status' => TRUE,
                                    'message' => array('ส่งข้อความเรียบร้อยแล้ว'),
                                ), 200));
                } catch (Exception $ex) {
                    echo $ex;
                }
            }
        }
    }

}
