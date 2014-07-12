<?php

namespace App\Controllers\Backend;

class JprojectController extends \BaseController {
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

        $data['page'] = array(
            'title' => 'Overview',
            'view' => 'backend.jproject.index',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Project' => 'backend/post',
                'Over View' => '#'
            )
        );
        return \View::make($data['page']['view'], $data);
    }

    public function project() {
        $data['page'] = array(
            'title' => 'Project',
            'view' => 'backend.jproject.project',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Project' => 'backend/post',
                'Project list' => '#'
            ),
            'result' => \DB::table('project_project')
                    ->leftJoin('project_category', 'project_category.id', '=', 'project_project.category_id')
                    ->leftJoin('project_client', 'project_client.id', '=', 'project_project.client_id')
                    ->select('project_project.id', 'project_project.code', 'project_project.name', 'project_project.progress', 'project_project.deadline', 'project_project.progress', 'project_client.name as customer')
                    ->get()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addProject() {
        $data['page'] = array(
            'title' => 'Add Project',
            'view' => 'backend.jproject.project_add',
            'assigned' => \DB::table('users')
                    ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
                    ->select('id', 'username', 'firstname', 'lastname')
                    ->where('role_id', 13)
                    ->lists('username', 'id'),
            'category' => \Projectcategory::all(),
            'customer' => \Projectclient::all()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function editProject() {
        $project = \Project::where('id', \Input::get('id'))->get();
        $data['page'] = array(
            'title' => 'Edit Project',
            'view' => 'backend.jproject.project_edit',
            'item' => $project[0],
            'assigned' => \DB::table('users')
                    ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
                    ->select('id', 'username', 'firstname', 'lastname')
                    ->where('role_id', 13)
                    ->lists('username', 'id'),
            'category' => \Projectcategory::all(),
            'customer' => \Projectclient::all()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function viewProject($id) {
        $project = \Project::where('id', $id)->get();
        $data['page'] = array(
            'title' => $project[0]['name'],
            'view' => 'backend.jproject.project_view',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Project' => 'backend/jproject/project',
                $project[0]['name'] => '#'
            ),
            'item' => $project[0],
            'category' => \Projectcategory::all(),
            'customer' => \Projectclient::all()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function customer() {

        $data['page'] = array(
            'title' => 'Customer',
            'view' => 'backend.jproject.customer',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Project' => 'backend/post',
                'Customer' => '#'
            ),
            'result' => \Projectclient::all()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addCustomer() {
        $data['page'] = array(
            'title' => 'Add Customer',
            'view' => 'backend.jproject.customer_add'
        );
        return \View::make($data['page']['view'], $data);
    }

    public function editCustomer() {
        $cus = \Projectclient::where('id', \Input::get('id'))->get();
        $data['page'] = array(
            'title' => 'Edit Customer',
            'view' => 'backend.jproject.customer_edit',
            'item' => $cus[0]
        );
        return \View::make($data['page']['view'], $data);
    }

    public function document() {
        $data['page'] = array(
            'title' => 'Document',
            'view' => 'backend.jproject.document',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'Document' => '#'
            ),
            'result' => \DB::table('project_req_user')
                    ->join('project_project', 'project_project.id', '=', 'project_req_user.project_id')
                    ->select('project_req_user.id', 'project_req_user.code', 'project_req_user.name', 'project_req_user.required_completion_date', 'project_req_user.status', 'project_req_user.created_at', 'project_req_user.updated_at', 'project_project.name as projectname')
                    ->orderBy('project_req_user.id', 'desc')
                    ->get()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addDocument01() {
        $max = \Projectrequest::max('id');
        if ($max) {
            $c = $max + 1;
            $code = 'ITSR' . date('ym') . str_pad($c, 4, "0", STR_PAD_LEFT);
        } else {
            $code = 'ITSR' . date('ym') . str_pad(1, 4, "0", STR_PAD_LEFT);
        }
        $data['page'] = array(
            'title' => 'Add IT Service Request Form',
            'view' => 'backend.jproject.document01_add',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'Document' => 'backend/jproject/document',
                'IT Service Request Form' => '#'
            ),
            'code' => $code
        );
        return \View::make($data['page']['view'], $data);
    }

    public function editDocument01($id) {
        $project_req_user = \DB::table('project_req_user')
                ->join('project_project', 'project_project.id', '=', 'project_req_user.project_id')
                ->select('project_req_user.id', 'project_req_user.project_id', 'project_req_user.contact_id', 'project_req_user.code', 'project_req_user.name', 'project_req_user.description', 'project_req_user.required_completion_date', 'project_req_user.created_at', 'project_req_user.updated_at', 'project_project.name as projectname')
                ->where('project_req_user.id', $id)
                ->get();

        if (\Projectfile::where('project_req_id', $project_req_user[0]->id)->count() > 0) {
            $filex = \Projectfile::where('project_req_id', $project_req_user[0]->id)->get();
        } else {
            $filex = NULL;
        }

        $data['page'] = array(
            'title' => 'Edit IT Service Request Form',
            'view' => 'backend.jproject.document01_edit',
            'item' => $project_req_user[0],
            'item2' => $filex
        );
        return \View::make($data['page']['view'], $data);
    }

    public function viewDocument01($id) {
        $project_req_user = \DB::table('project_req_user')
                ->join('project_project', 'project_project.id', '=', 'project_req_user.project_id')
                ->select('project_req_user.id', 'project_req_user.contact_id', 'project_req_user.code', 'project_req_user.name', 'project_req_user.description', 'project_req_user.required_completion_date', 'project_req_user.created_user', 'project_req_user.created_at', 'project_req_user.updated_at', 'project_project.name as projectname')
                ->where('project_req_user.id', $id)
                ->get();
        if (\Projectfile::where('project_req_id', $project_req_user[0]->id)->count() > 0) {
            $filex = \Projectfile::where('project_req_id', $project_req_user[0]->id)->get();
        } else {
            $filex = NULL;
        }

        if (\Projectsrsform::where('project_req_id', $project_req_user[0]->id)->count() > 0) {
            $srsform = \Projectsrsform::where('project_req_id', $project_req_user[0]->id)->get();
        } else {
            $srsform = NULL;
        }
        $data['page'] = array(
            'title' => 'View IT Service Request Form',
            'view' => 'backend.jproject.document01_view',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'Document' => 'backend/jproject/document',
                'IT Service Request Form' => '#'
            ),
            'item' => $project_req_user[0],
            'item2' => $filex,
            'item3' => $srsform[0]
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addDocument02($id) {
        $data['page'] = array(
            'title' => 'Add System Requirements Specification Form',
            'view' => 'backend.jproject.document02_add',
            'project_req_id' => $id
        );
        return \View::make($data['page']['view'], $data);
    }

    public function editDocument02($id) {

        $srsedit = \Projectsrsform::where('id', $id)->get();
        $data['page'] = array(
            'title' => 'Edit System Requirements Specification Form',
            'view' => 'backend.jproject.document02_edit',
            'item' => $srsedit[0]
        );
        return \View::make($data['page']['view'], $data);
    }

#########################################################

    public function addProjectSave() {
        $rules = array(
            'code' => 'required|max:30',
            'name' => 'required|max:100',
            'category_id' => 'required',
            'client_id' => 'required',
            'deadline' => 'required'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            $data = array(
                'code' => \Input::get('code'),
                'name' => \Input::get('name'),
                'category_id' => \Input::get('category_id'),
                'client_id' => \Input::get('client_id'),
                'progress' => \Input::get('progress'),
                'startdate' => \Input::get('startdate'),
                'deadline' => \Input::get('deadline'),
                'phases' => \Input::get('phases'),
                'description' => \Input::get('description'),
                'created_user' => \Auth::user()->id
            );
            \Project::create($data);
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function editProjectSave() {
        $rules = array(
            'code' => 'required|max:30',
            'name' => 'required|max:100',
            'category_id' => 'required',
            'client_id' => 'required',
            'deadline' => 'required'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            $data = array(
                'code' => \Input::get('code'),
                'name' => \Input::get('name'),
                'category_id' => \Input::get('category_id'),
                'client_id' => \Input::get('client_id'),
                'progress' => \Input::get('progress'),
                'startdate' => \Input::get('startdate'),
                'deadline' => \Input::get('deadline'),
                'phases' => \Input::get('phases'),
                'description' => \Input::get('description'),
                'created_user' => \Auth::user()->id
            );
            \Project::where('id', \Input::get('id'))->update($data);
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function addCustomerSave() {
        $rules = array(
            'code' => 'required|max:30',
            'name' => 'required|max:100',
            'phone' => 'required|max:30',
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
            $data = array(
                'code' => \Input::get('code'),
                'name' => \Input::get('name'),
                'phone' => \Input::get('phone'),
                'email' => \Input::get('email'),
                'address' => \Input::get('address'),
                'description' => \Input::get('description'),
                'created_user' => \Auth::user()->id
            );
            \Projectclient::create($data);
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function editCustomerSave() {
        $rules = array(
            'code' => 'required|max:30',
            'name' => 'required|max:100',
            'phone' => 'required|max:30',
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
            $data = array(
                'code' => \Input::get('code'),
                'name' => \Input::get('name'),
                'phone' => \Input::get('phone'),
                'email' => \Input::get('email'),
                'address' => \Input::get('address'),
                'description' => \Input::get('description'),
                'created_user' => \Auth::user()->id
            );
            \Projectclient::where('id', \Input::get('id'))->update($data);
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function deleteCustomerSave() {
        try {
            $Projectclient = \Projectclient::find(\Input::get('id'));
            $Projectclient->delete();
            return \Response::json(array(
                        'error' => array(
                            'status' => true,
                            'message' => array('Delete data success.'),
                        ), 200));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function addDocument01Save() {
        $file = \Input::file('attachments');
        $rules = array(
            'name' => 'required|max:100',
            'project_id' => 'required',
            'description' => 'required',
            'attachments' => 'mimes:pdf,doc,docx,txt'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            $data = array(
                'code' => \Input::get('code'),
                'name' => \Input::get('name'),
                'project_id' => \Input::get('project_id'),
                'required_completion_date' => \Input::get('required_completion_date'),
                'description' => \Input::get('description'),
                'contact_id' => \Auth::user()->id,
                'created_user' => \Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s')
            );
            $Projectrequest = \Projectrequest::create($data);

            $data2 = array(
                'pk_id' => $Projectrequest->id,
                'title' => trim(\Input::get('name')),
                'module' => 'jproject',
                'url' => 'jproject/document/view/01/' . $Projectrequest->id . '',
                'created_user' => \Auth::user()->id
            );
            \Timeline::setTimeline($data2);

            if ($file) {
                $destinationPath = 'uploads/project/';
                $filename = $file->getClientOriginalName();
                \Input::file('attachments')->move($destinationPath, $filename);
                $data2 = array(
                    'project_req_id' => $Projectrequest->id,
                    'name' => $filename,
                    'url' => $destinationPath . $filename,
                    'created_user' => \Auth::user()->id
                );
                \DB::table('project_file')->insert($data2);
            }
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function editDocument01Save() {
        $file = \Input::file('attachments');
        $rules = array(
            'name' => 'required|max:100',
            'project_id' => 'required',
            'description' => 'required',
            'attachments' => 'mimes:pdf,doc,docx,txt'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            $data = array(
                'name' => \Input::get('name'),
                'project_id' => \Input::get('project_id'),
                'required_completion_date' => \Input::get('required_completion_date'),
                'description' => \Input::get('description'),
                'status' => \Input::get('status'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            \Projectrequest::where('id', \Input::get('id'))->update($data);

            if ($file) {
                $destinationPath = 'uploads/project/';
                $filename = $file->getClientOriginalName();
                \Input::file('attachments')->move($destinationPath, $filename);
                $data2 = array(
                    'project_req_id' => \Input::get('id'),
                    'name' => $filename,
                    'url' => $destinationPath . $filename
                );
                if (\Input::get('file_id')) {
                    \DB::table('project_file')
                            ->where('id', \Input::get('file_id'))
                            ->update($data2);
                } else {
                    \Projectfile::create($data2);
                }
            }

            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function deleteDocument01Save() {
        try {
            $Projectrequest = \Projectrequest::find(\Input::get('id'));
            $Projectrequest->delete();
            return \Response::json(array(
                        'error' => array(
                            'status' => true,
                            'message' => array('Delete data success.'),
                        ), 200));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function addDocument02Save() {
        $rules = array(
            'functions' => 'required|max:100',
            'brief_des' => 'required',
            'stakeholder' => 'required',
            'main_flow1' => 'required',
            'main_flow2' => 'required'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            $data = array(
                'project_req_id' => \Input::get('project_req_id'),
                'functions' => \Input::get('functions'),
                'brief_des' => \Input::get('brief_des'),
                'input' => \Input::get('input'),
                'source' => \Input::get('source'),
                'output' => \Input::get('output'),
                'requires' => \Input::get('requires'),
                'stakeholder' => \Input::get('stakeholder'),
                'precondition' => \Input::get('precondition'),
                'postcondition' => \Input::get('postcondition'),
                'main_flow1' => \Input::get('main_flow1'),
                'main_flow2' => \Input::get('main_flow2'),
                'exception_condition' => \Input::get('exception_condition'),
                'created_user' => \Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s')
            );
            \Projectsrsform::create($data);
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function editDocument02Save() {
        $rules = array(
            'functions' => 'required|max:100',
            'brief_des' => 'required',
            'stakeholder' => 'required',
            'main_flow1' => 'required',
            'main_flow2' => 'required'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            $data = array(
                'functions' => \Input::get('functions'),
                'brief_des' => \Input::get('brief_des'),
                'input' => \Input::get('input'),
                'source' => \Input::get('source'),
                'output' => \Input::get('output'),
                'requires' => \Input::get('requires'),
                'stakeholder' => \Input::get('stakeholder'),
                'precondition' => \Input::get('precondition'),
                'postcondition' => \Input::get('postcondition'),
                'main_flow1' => \Input::get('main_flow1'),
                'main_flow2' => \Input::get('main_flow2'),
                'exception_condition' => \Input::get('exception_condition'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            \Projectsrsform::where('id', \Input::get('id'))->update($data);
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

}
