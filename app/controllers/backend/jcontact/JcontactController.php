<?php

namespace App\Controllers\Backend;

/*
 *  @Auther : Adisorn Lamsombuth
 *  @Email : postyim@gmail.com
 *  @Website : esabay.com 
 */

/**
 * Description of JcontactController
 *
 * @author R-D-6
 */
class JcontactController extends \BaseController {

    public function index() {
        $data['page'] = array(
            'title' => 'Overview',
            'view' => 'backend.jcontact.index',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Contact' => '#',
                'Overview' => '#'
            )
        );
        return \View::make($data['page']['view'], $data);
    }

    public function contact() {
        $data['page'] = array(
            'title' => 'Contact',
            'view' => 'backend.jcontact.contact',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Contact' => 'backend/jcontact',
                'Contact' => '#'
            ),
            'result' => \Contactlist::all()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function viewContact($param) {
        $data['page'] = array(
            'title' => 'Contact',
            'view' => 'backend.jcontact.contact_view',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'Overview' => 'backend/jcontact',
                'Contact' => 'backend/jcontact/contact',
                'View' => '#'
            ),
            'item' => \Contactlist::find($param)
        );
        return \View::make($data['page']['view'], $data);
    }

}
