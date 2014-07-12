<?php

namespace App\Controllers\Backend;

class JcareerController extends \BaseController {
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
            'view' => 'backend.jcareer.index',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Career' => 'backend/jcareer',
                'Over View' => '#'
            )
        );
        return \View::make($data['page']['view'], $data);
    }

    public function frontDashboard() {
        $data['page'] = array(
            'view' => 'backend.jcareer.front_dashboard'
        );
        return \View::make($data['page']['view'], $data);
    }

    public function joblist() {
        $data['page'] = array(
            'title' => \Lang::get('jcareer.title_job_list'),
            'view' => 'backend.jcareer.front_job_list',
            'result' => \Careerposition::all()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function jobView($id) {
        $data['page'] = array(
            'view' => 'backend.jcareer.front_job_view',
            'item' => \Careerposition::find($id)
        );
        return \View::make($data['page']['view'], $data);
    }

    public function selectPos() {
        $data['page'] = array(
            'view' => 'backend.jcareer.front_select_position'
        );
        return \View::make($data['page']['view'], $data);
    }

    public function jobDescription() {
        $data['page'] = array(
            'title' => 'Job Description',
            'view' => 'backend.jcareer.jobdescription',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Career' => 'backend/jcareer',
                'Job Description' => '#'
            ),
            'result' => \Careerjobdescription::orderBy('id', 'desc')
                    ->paginate(20)
        );
        return \View::make($data['page']['view'], $data);
    }

    public function view($id) {
        $rs = \DB::table('post')
                ->join('categories', 'categories.id', '=', 'post.categories_id')
                ->where('post.id', $id)
                ->select('post.id', 'post.name', 'post.detail', 'post.detail', 'categories.title as groupname', 'post.disabled', 'post.created_at', 'post.updated_at')
                ->get();
        $data['page'] = array(
            'view' => 'backend.jcareer.post_view',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Career' => 'backend/jcareer',
                '' . $rs[0]->name . '' => '#'
            ),
            'item' => $rs[0]
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addJobDescription() {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('organization')->get();
        $ct = \Categorize::tree($categories);
        $arr_cat = array();
        foreach ($ct as $val) {
            $arr_cat[$val->id] = '- ' . $val->title;
        }
        $data['page'] = array(
            'title' => 'Add Job Description',
            'view' => 'backend.jcareer.jobdescription_add',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Career' => 'backend/jcareer',
                'Job Description' => 'backend/jcareer/jobdescription',
                'Add' => '#'
            ),
            'category' => $arr_cat
        );
        return \View::make($data['page']['view'], $data);
    }

    public function editJobDescription($id) {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('organization')->get();
        $ct = \Categorize::tree($categories);
        $arr_cat = array();
        foreach ($ct as $val) {
            $arr_cat[$val->id] = '- ' . $val->title;
        }
        $data['page'] = array(
            'title' => 'Edit Job Description',
            'view' => 'backend.jcareer.jobdescription_edit',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Career' => 'backend/jcareer',
                'Job Description' => 'backend/jcareer/jobdescription',
                'Edit' => '#'
            ),
            'item' => \Careerjobdescription::find($id),
            'category' => $arr_cat
        );
        return \View::make($data['page']['view'], $data);
    }

    public function viewJobDescription($id) {
        $jobdes = \Careerjobdescription::find($id);
        $data['page'] = array(
            'title' => $jobdes->title,
            'view' => 'backend.jcareer.jobdescription_view',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Career' => 'backend/jcareer',
                'Job Description' => 'backend/jcareer/jobdescription',
                $jobdes->title => '#'
            ),
            'item' => $jobdes
        );
        return \View::make($data['page']['view'], $data);
    }

    public function applicaiton() {
        if (\Auth::user()->department_id != 355) {
            $rs = \DB::table('career_application_info')
                    ->join('career_application_occupation', 'career_application_occupation.info_id', '=', 'career_application_info.id')
                    ->join('career_position', 'career_position.id', '=', 'career_application_occupation.position1')
                    ->select('career_application_info.id', 'career_application_info.firstname', 'career_application_info.lastname', 'career_application_info.sex', 'career_application_info.birthday', 'career_application_info.PROVINCE_ID', 'career_application_info.mobile', 'career_application_info.status', 'career_application_info.created_at')
                    ->where('career_position.department_id', \Auth::user()->department_id)
                    ->paginate(20);
        } else {
            $rs = \Careerapplicationinfo::select(array('id', 'firstname', 'lastname', 'sex', 'birthday', 'PROVINCE_ID', 'mobile', 'status', 'created_at'))
                    ->orderBy('id', 'desc')
                    ->paginate(20);
        }

        $data['page'] = array(
            'title' => 'Application',
            'view' => 'backend.jcareer.application',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Career' => 'backend/jcareer',
                'Application' => '#'
            ),
            'result' => $rs
        );
        return \View::make($data['page']['view'], $data);
    }

    public function formApplicaiton() {
        $data['page'] = array(
            'title' => 'Application',
            'view' => 'backend.jcareer.application_form'
        );
        return \View::make($data['page']['view'], $data);
    }

    public function viewApplicaiton($id) {
        $occupation = \Careerapplicationoccupation::where('info_id', $id)->get();
        $data['page'] = array(
            'title' => 'View Application',
            'view' => 'backend.jcareer.application_view',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Career' => 'backend/jcareer',
                'View Application' => '#'
            ),
            'info' => \Careerapplicationinfo::find($id),
            'occupation' => $occupation[0],
            'education' => \DB::table('career_application_education')->where('info_id', $id)->get(),
            'experience' => \DB::table('career_application_experience')->where('info_id', $id)->get(),
            'training' => \DB::table('career_application_training')->where('info_id', $id)->get(),
            'skill' => \DB::table('career_application_skill')->where('info_id', $id)->get(),
            'interviewer' => \DB::table('career_interview')->where('info_id', $id)->get()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function interview($id) {
        $occupation = \Careerapplicationoccupation::where('info_id', $id)->get();
        $data['page'] = array(
            'title' => 'Interview',
            'view' => 'backend.jcareer.interview',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Career' => 'backend/jcareer',
                'Interview' => '#'
            ),
            'info' => \Careerapplicationinfo::find($id),
            'occupation' => $occupation[0],
            'education' => \DB::table('career_application_education')->where('info_id', $id)->get(),
            'experience' => \DB::table('career_application_experience')->where('info_id', $id)->get(),
            'training' => \DB::table('career_application_training')->where('info_id', $id)->get(),
            'skill' => \DB::table('career_application_skill')->where('info_id', $id)->get(),
            'interviewer' => \DB::table('career_interview')->where('info_id', $id)->get()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function position() {
        $data['page'] = array(
            'title' => 'Position',
            'view' => 'backend.jcareer.position',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Career' => 'backend/jcareer',
                'Position' => '#'
            ),
            'result' => \Careerposition::orderBy('id', 'desc')->paginate(20)
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addPosition() {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('organization')->get();
        $ct = \Categorize::tree($categories);
        $arr_cat = array();
        foreach ($ct as $val) {
            $arr_cat[$val->id] = '- ' . $val->title;
        }
        $data['page'] = array(
            'title' => 'Add Position',
            'view' => 'backend.jcareer.position_add',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Career' => 'backend/jcareer',
                'Position' => 'backend/jcareer/position',
                'Add Position' => '#'
            ),
            'department' => $arr_cat
        );
        return \View::make($data['page']['view'], $data);
    }

    public function editPosition($id) {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('organization')->get();
        $ct = \Categorize::tree($categories);
        $arr_cat = array();
        foreach ($ct as $val) {
            $arr_cat[$val->id] = '- ' . $val->title;
        }
        $data['page'] = array(
            'title' => 'Edit Position',
            'view' => 'backend.jcareer.position_edit',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Career' => 'backend/jcareer',
                'Position' => 'backend/jcareer/position',
                'Edit Position' => '#'
            ),
            'item' => \Careerposition::find($id),
            'department' => $arr_cat
        );
        return \View::make($data['page']['view'], $data);
    }

    public function viewPosition($id) {
        $data['page'] = array(
            'title' => 'View Position',
            'view' => 'backend.jcareer.position_view',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Career' => 'backend/jcareer',
                'Position' =>
                'backend/jcareer/position',
                'View Position' => '#'
            ),
            'item' => \Careerposition::find($id)
        );
        return \View::make($data['page']['view'], $data);
    }

#########################################################

    public function addJobDescriptionSave() {
        $rules = array(
            'title' => 'required|max:255',
            'department_id' => 'required',
            'description' => 'required'
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
                'title' => \Input::get('title'),
                'department_id' => \Input::get('department_id'),
                'description' => \Input::get('description'),
                'created_user' => \Auth::user()->id
            );

            \

            Careerjobdescription::create($data);

            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function editJobDescriptionSave() {
        $rules = array(
            'title' => 'required|max:255',
            'department_id' => 'required',
            'description' => 'required'
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
                'title' => \Input::get('title'),
                'department_id' => \Input::get('department_id'),
                'description' => \Input::get('description'),
                'updated_user' => \Auth::user()->id
            );
            \Careerjobdescription::where('id', \Input::get('id'))
                    ->update($data);
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function deleteJobDescriptionSave() {
        try {
            \Careerjobdescription::find(\Input::get('id'))->delete();
            return \Response::json(array(
                        'error' => array(
                            'status' => true,
                            'message' => array('Delete data success.'),
                        ), 200));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function formApplicaitonSave() {
        $file = \Input::file('photo');
        $rules = array(
            'firstname' => 'required|max:80',
            'lastname' => 'required|max:80',
            'nation_type' => 'required',
            'idcard' => 'required|numeric|unique:career_application_info,idcard',
            'birthday' => 'required:date',
            'sex' => 'required',
            'height' => 'numeric|min:2',
            'weigth' => 'numeric|min:2',
            'nationality_id' => 'required',
            'religion_id' => 'required',
            'address' => 'required|max:255',
            'mobile' => 'required|numeric',
            'email' => 'email',
            'position1' => 'required',
            'gradyear' => 'numeric',
            'gpa' => 'numeric'
        );
        $validator = \Validator::make(\Input::all(), $rules);

        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            $data_info = array(
                'firstname' => trim(\Input::get('firstname')),
                'lastname' => trim(\Input::get('lastname')),
                'nickname' => trim(\Input::get('nickname')),
                'nation_type' => \Input::get('nation_type'),
                'idcard' => trim(\Input:: get('idcard')),
                'passport_no' => trim(\Input::get('passport_no')),
                'issue_card' => trim(\Input::get('issue_card')),
                'birthday' => trim(\Input::get('birthday')),
                'sex' => \ Input::get('sex'),
                'marital' => \Input::get('marital'),
                'height' => trim(\Input::get('height')),
                'weigth' => trim(\Input::get('weigth')),
                'nationality_id' => \Input::get('nationality_id'),
                'religion_id' => \Input::get('religion_id'),
                'birthplace_city' => \Input:: get('birthplace_city'),
                'address' => trim(\ Input::get('address')),
                'DISTRICT_ID' => \Input ::get('district'),
                'AMPHUR_ID' => \Input ::get('amphur'),
                'PROVINCE_ID' => \Input ::get('province'),
                'zipcode' => trim(\Input::get('zipcode')),
                'telephone' => trim(\Input::get('telephone')),
                'mobile' => trim(\Input::get('mobile')),
                'email' => trim(\Input::get('email')),
                'smssvs' => \Input::get('smssvs'),
                'military_status' => \Input::get('military_status')
            );
            $info = \Careerapplicationinfo::create($data_info);
            $occupation = array(
                'info_id' => $info->id,
                'position1' => \Input::get('position1'),
                'position2' => \Input::get('position2'),
                'position3' => \Input::get('position3'),
                'expect_salary' => trim(\Input::get('expect_salary')));
            \Careerapplicationoccupation::create($occupation);

            if (\Input::get('edu_province.0')) {
                for ($i = 0; $i < count(\Input::get('edu_province')); $i++) {
                    if (\Input::get('edu_institute.' . $i . '') != '') {
                        $education = array(
                            'info_id' => $info->id,
                            'province' => \Input::get('edu_province.' . $i . ''),
                            'level' => \Input::get('edu_level.' . $i . ''),
                            'institute' => trim(\Input::get('edu_institute.' . $i . '')),
                            'faculty' => trim(\Input::get('edu_faculty.' . $i . '')),
                            'major' => trim(\Input::get('edu_major.' . $i . '')),
                            'gradyear' => trim(\Input::get('edu_gradyear.' . $i . '')),
                            'gpa' => trim(\Input::get('edu_gpa.' . $i . ''))
                        );
                        \Careerapplicationeducation::create($education);
                    }
                }
            } else {
                $education = array(
                    'info_id' => $info->id
                );
                \Careerapplicationeducation::create($education);
            }

            if (\Input::get('ex_company.0')) {
                for ($j = 0; $j < count(\Input::get('ex_company')); $j++) {
                    if (\Input::get('ex_form.' . $j . '') != '') {
                        $experience = array(
                            'info_id' => $info->id,
                            'ex_form' => \Input::get('ex_form.' . $j . ''),
                            'ex_to' => \Input::get('ex_to.' . $j . ''),
                            'company' => trim(\Input::get('ex_company.' . $j . '')),
                            'address' => trim(\Input::get('ex_address.' . $j . '')),
                            'position' => trim(\Input::get('ex_position.' . $j . '')),
                            'salary' => trim(\Input::get('ex_salary.' . $j . '')),
                            'description' => \Input::get('ex_description.' . $j . '')
                        );
                        \Careerapplicationexperience::create($experience);
                    }
                }
            } else {
                $experience = array(
                    'info_id' => $info->id
                );
                \Careerapplicationexperience::create($experience);
            }

            if (\Input::get('tn_institute.0')) {
                for ($k = 0; $k < count(\Input::get('tn_institute')); $k++) {
                    $training = array(
                        'info_id' => $info->id,
                        'tn_from' => \Input::get('tn_from.' . $k . ''),
                        'tn_to' => \Input::get('tn_to.' . $k . ''),
                        'institute' => trim(\Input::get('tn_institute.' . $k . '')),
                        'subject' => trim(\Input::get('tn_subject.' . $k . ''))
                    );
                    \Careerapplicationtraining::create($training);
                }
            } else {
                $training = array(
                    'info_id' => $info->id
                );
                \Careerapplicationtraining::create($training);
            }

            $skill = array(
                'info_id' => $info->id,
                'listen_th' => \Input::get('listen_th'),
                'speak_th' => \Input::get('speak_th'),
                'read_th' => \Input::get('read_th'),
                'write_th' => \Input::get('write_th'),
                'listen_en' => \ Input::get('listen_en'),
                'speak_en' => \Input::get('speak_en'),
                'read_en' => \Input::get('read_en'),
                'write_en' => \Input::get('write_en'),
                'typing_thai' => trim(\Input::get('typing_thai')),
                'typing_english' => trim(\Input::get('typing_english')),
                'driving_car' => (\Input::has('driving_car') ? 0 : 1),
                'driving_motorcycle' => (\Input::has('driving_motorcycle') ? 0 : 1),
                'driving_truck' => (\Input::has('driving_truck') ? 0 : 1),
                'own_car' => (\Input::has('own_car') ? 0 : 1),
                'own_motorcycle' => (\Input::has('own_motorcycle') ? 0 : 1),
                'own_truck' => (\Input::has('own_truck') ? 0 : 1),
                'licence_car' => (\Input::has('licence_car') ? 0 : 1),
                'licence_motorcycle' => (\Input::has('licence_motorcycle') ? 0 : 1),
                'licence_other' => (\Input::has('licence_other') ? 0 : 1),
                'licence_other_name' => trim(\Input::get('licence_other_name')),
                'qualification' => trim(\Input::get('qualification')),
                'project' => trim(\Input::get('project')),
                'reference' => trim(\Input::get('reference'))
            );
            \Careerapplicationskill::create($skill);

            if ($file) {
                $extension = $file->getClientOriginalExtension();
                $filename = str_random(40) . '.' . $extension;
                $destinationPath = 'uploads/application/';
                $smallfile = 'small_' . $filename;
                $smallfile2 = 'medium_' . $filename;
                \Input::file('photo')->move($destinationPath, $filename);
                \Image::make($destinationPath . $filename)->resize(150, null, TRUE)->save($destinationPath . $smallfile);
                \Image::make($destinationPath . $filename)->resize(250, null, TRUE)->save($destinationPath . $smallfile2);
                $photo = array(
                    'small' => $destinationPath . $smallfile,
                    'medium' => $destinationPath . $smallfile2
                );
                \Careerapplicationinfo::where('id', $info->id)->update(array('photo' => json_encode($photo)));
            }
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => \Lang::get('jcareer.msg_success')
                        ), 200));
        }
    }

    public function addPositionSave() {
        $rules = array(
            'title' => 'required|max:255',
            'department_id' => 'required',
            'type' => 'required',
            'qualification' => 'required',
            'description' => 'required'
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
                'title' => trim(\Input::get('title')),
                'department_id' => \Input::get('department_id'),
                'amount' => trim(\Input::get('amount')),
                'type' => \Input::get('type'),
                'description' => trim(\Input::get('description')),
                'place' => trim(\Input::get('place')),
                'qualification' => trim(\Input::get('qualification')),
                'salary' => trim(\Input::get('salary')),
                'benefit' => trim(\Input::get('benefit')),
                'disabled' => (\Input::has('disabled') ? \Input::get('disabled') : 1),
                'created_user' => \Auth::user()->id
            );

            \

            Careerposition::create($data);

            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function editPositionSave() {
        $rules = array(
            'title' => 'required|max:255',
            'department_id' => 'required',
            'type' => 'required',
            'qualification' => 'required',
            'description' => 'required'
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
                'title' => trim(\Input::get('title')),
                'department_id' => \Input::get('department_id'),
                'amount' => trim(\Input::get('amount')),
                'type' => \Input::get('type'),
                'description' => trim(\Input::get('description')),
                'place' => trim(\Input::get('place')),
                'qualification' => trim(\Input::get('qualification')),
                'salary' => trim(\Input::get('salary')),
                'benefit' => trim(\Input::get('benefit')),
                'disabled' => (\Input::has('disabled') ? \Input::get('disabled') : 1),
                'updated_user' => \Auth::user()->id
            );
            \Careerposition::where('id', \Input::get('id'))->update($data);

            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function deletePositionSave() {
        try {
            \Careerposition::find(\Input::get('id'))->delete();
            return \Response::json(array(
                        'error' => array(
                            'status' => true,
                            'message' => array('Delete data success.'),
                        ), 200));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function cancelInterview() {
        \Careerinterview::where('info_id', \Input::get('id'))->delete();

        $info = \Careerapplicationinfo::find(\Input::get('id'));
        $info->status = 1;
        $info->save();

        return \Response::json(array(
                    'error' => array(
                        'status' => TRUE,
                        'message' => 'Save data Success.'
                    ), 200));
    }

    public function confirmInterview() {
        $data = array(
            'info_id' => \Input::get('id'),
            'status' => 2,
            'disabled' => 0,
            'created_user' => \Auth::user()->id
        );

        \Careerinterview::create($data);

        $info = \Careerapplicationinfo::find(\Input::get('id'));
        $info->status = 2;
        $info->save();

        return \Response::json(array(
                    'error' => array(
                        'status' => TRUE,
                        'message' => 'Save data Success.'
                    ), 200));
    }

    public function checkInterview() {
        if (\DB::table('career_interview')->where('info_id', \Input::get('id'))->get()) {
            if (\DB::table('career_interview')->where('info_id', \Input::get('id'))->count() > 0) {
                $interv = \DB::table('career_interview')->where('info_id', \Input::get('id'))->get();
                if ($interv[0]->created_user == \Auth::user()->id) {
                    return \Response::json(array(
                                'error' => array(
                                    'status' => TRUE,
                                    'new' => 1
                                ), 200));
                } else {
                    return \Response::json(array(
                                'error' => array(
                                    'status' => FALSE,
                                    'message' => \Lang::get('jcareer.interviewer_check_false')
                                ), 400));
                }
            }
        } else {
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'new' => 0
                        ), 200));
        }
    }

    public function addInterviewSave() {
        $rules = array(
            'interview_summary' => 'required'
        );
        $validator = \Validator::make(\Input::all(), $rules);

        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            $fnx = \Careerinterview::where('info_id', \Input::get('info_id'))->where('created_user', \Auth::user()->id)->count();
            if ($fnx > 0) {
                $data = array(
                    'info' => trim(\Input::get('interview_info')),
                    'occupation' => trim(\Input::get('interview_occupation')),
                    'education' => trim(\Input::get('interview_education')),
                    'experience' => trim(\Input::get('interview_experience')),
                    'skill' => trim(\Input::get('interview_skill')),
                    'other' => trim(\Input::get('interview_other')),
                    'summary' => trim(\Input::get('interview_summary')),
                    'status' => \Input::get('status'),
                    'updated_user' => \Auth::user()->id
                );
                \Careerinterview::where('info_id', \Input::get('info_id'))
                        ->where('created_user', \Auth::user()->id)
                        ->update($data);
                $info = \Careerapplicationinfo::find(\Input::get('info_id'));
                $info->status = 3;
                $info->save();
            } else {
                $data = array(
                    'info_id' => \Input::get('info_id'),
                    'info' => trim(\Input::get('interview_info')),
                    'occupation' => trim(\Input::get('interview_occupation')),
                    'education' => trim(\Input::get('interview_education')),
                    'experience' => trim(\Input::get('interview_experience')),
                    'skill' => trim(\Input::get('interview_skill')),
                    'other' => trim(\Input::get('interview_other')),
                    'summary' => trim(\Input::get('interview_summary')),
                    'status' => \Input::get('status'),
                    'created_user' => \Auth::user()->id
                );
                \Careerinterview::create($data);
                $info = \Careerapplicationinfo::find(\Input::get('info_id'));
                $info->status = \Input::get('status');
                $info->save();
            }
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

}
