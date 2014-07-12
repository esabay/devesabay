<?php

namespace App\Controllers\Backend;

class JcalendarController extends \BaseController {
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
            'view' => 'backend.jcalendar.index',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Calendar' => 'backend/jcalendar',
                'Over View' => '#'
            )
        );
        return \View::make($data['page']['view'], $data);
    }

    public function events() {
        $data['page'] = array(
            'title' => 'Event',
            'view' => 'backend.jcalendar.event',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'J-Calendar' => 'backend/jcalendar',
                'Event' => '#'
            )
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
            'view' => 'backend.post.post_view',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'Post' => 'backend/post',
                '' . $rs[0]->name . '' => '#'
            ),
            'item' => $rs[0]
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addPost() {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('post')->get();
        $data['page'] = array(
            'title' => 'Add Post',
            'view' => 'backend.post.post_add',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'Post' => 'backend/post',
                'Add' => '#'
            ),
            'category' => \Categorize::tree($categories)->toArray()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function editPost($id) {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('post')->get();
        $ct = \Categorize::tree($categories);
        $arr_cat = array();
        foreach ($ct as $val) {
            $arr_cat[$val->id] = $val->title;
            if ($val->children) {
                foreach ($val->children as $val2) {
                    $arr_cat[$val2->id] = '&nbsp;&nbsp;' . $val2->title;
                    if ($val2->children) {
                        foreach ($val2->children as $val3) {
                            $arr_cat[$val3->id] = '&nbsp;&nbsp;&nbsp;&nbsp;' . $val3->title;
                        }
                    }
                }
            }
        }
        $data['page'] = array(
            'title' => 'Edit Post',
            'item' => \Post::find($id),
            'slide' => \Postimg::where('post_id', $id)->get(),
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'Post' => 'backend/post',
                'Edit' => '#'
            ),
            'category' => $arr_cat,
            'view' => 'backend.post.post_edit'
        );
        return \View::make($data['page']['view'], $data);
    }

    public function group() {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('post')->get();
        $data['page'] = array(
            'title' => 'Group',
            'view' => 'backend.post.group',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'Post' => 'backend/post',
                'List item' => '#'
            ),
            'result' => \Categorize::tree($categories)->toArray()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addGroup() {
        $data['page'] = array(
            'title' => 'Add Group',
            'view' => 'backend.post.group_add'
        );
        return \View::make($data['page']['view'], $data);
    }

    public function editGroup() {
        $data['page'] = array(
            'title' => 'Edit Group',
            'view' => 'backend.post.group_edit',
            'item' => \Categorize::getCategoryProvider()->findById(\Input::get('id'))
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addSubGroup() {
        $data['page'] = array(
            'title' => 'Add Sub Category',
            'view' => 'backend.post.subgroup_add'
        );
        return \View::make($data['page']['view'], $data);
    }

    public function imageSlide() {
        $data['page'] = array(
            'title' => 'Image Slide',
            'view' => 'backend.post.imageslide',
            'result' => \Postimg::all()
        );
        return \View::make($data['page']['view'], $data);
    }

#########################################################

    public function addPostSave() {
        $file = \Input::file('imgcover');
        $file2 = \Input::file('imgslide');
        $url = \Input::get('url');
        $rules = array(
            'name' => 'required|max:100',
            'categories_id' => 'required',
            'shortdetail' => 'required|max:255',
            'detail' => 'required',
            'imgcover' => 'image|mimes:jpeg,png|max:512',
            'imgslide' => 'image|mimes:jpeg,png|max:512'
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
                'categories_id' => \Input::get('categories_id'),
                'shortdetail' => \Input::get('shortdetail'),
                'detail' => \Input::get('detail'),
                'startdate' => (\Input::get('startdate') ? \Input::get('startdate') : date('Y-m-d')),
                'disabled' => (\Input::has('disabled') ? \Input::get('disabled') : 1),
                'frontend' => (\Input::has('frontend') ? \Input::get('frontend') : 1),
                'stylepage' => (\Input::has('stylepage') ? \Input::get('stylepage') : 1),
                'tagsinput' => \Input::get('tagsinput'),
                'seo_title' => \Input::get('seo_title'),
                'seo_keyword' => \Input::get('seo_keyword'),
                'seo_description' => \Input::get('seo_description'),
                'created_user' => \Auth::user()->id
            );
            $Post = \Post::create($data);
            $data2 = array(
                'pk_id' => $Post->id,
                'title' => trim(\Input::get('name')),
                'module' => 'post',
                'url' => 'post/view/' . $Post->id . '',
                'created_user' => \Auth::user()->id
            );
            \Timeline::setTimeline($data2);
            if ($file) {
                $destinationPath = 'uploads/post/';
                $extension = $file->getClientOriginalExtension();
                $filename = str_random(40) . '.' . $extension;
                $smallfile = 'cover_' . $filename;
                $smallfile2 = 'cover_front_' . $filename;
                \Input::file('imgcover')->move($destinationPath, $filename);
                \Image::make($destinationPath . $filename)->resize(250, null, TRUE)->save($destinationPath . $smallfile);
                \Image::make($destinationPath . $filename)->resize(370, 200, TRUE)->save($destinationPath . $smallfile2);
                $data2 = array(
                    'cover' => $destinationPath . $smallfile,
                    'front' => $destinationPath . $smallfile2
                );
                \Post::where('id', $Post->id)->update(array('imgcover' => json_encode($data2)));
            }

            if ($file2) {
                $destinationPath2 = 'uploads/post/gallery/';
                $i = 0;
                foreach ($file2 as $item2) {
                    $extension2 = $item2->getClientOriginalExtension();
                    $filename2 = str_random(40) . '.' . $extension2;
                    $item2->move($destinationPath2, $filename2);
                    \Postimg::create(array('post_id' => $Post->id, 'name' => $filename2, 'title' => $destinationPath2 . $filename2, 'url' => $url[$i]));
                    $i++;
                }
            }

            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function editPostSave() {
        $file = \Input::file('imgcover');
        $file2 = \Input::file('imgslide');
        $rules = array(
            'name' => 'required|max:100',
            'categories_id' => 'required',
            'shortdetail' => 'required|max:255',
            'detail' => 'required',
            'imgcover' => 'image|mimes:jpeg,png|max:512'
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
                'categories_id' => \Input::get('categories_id'),
                'shortdetail' => \Input::get('shortdetail'),
                'detail' => \Input::get('detail'),
                'startdate' => (\Input::get('startdate') ? \Input::get('startdate') : date('Y-m-d')),
                'disabled' => (\Input::has('disabled') ? \Input::get('disabled') : 1),
                'frontend' => (\Input::has('frontend') ? \Input::get('frontend') : 1),
                'stylepage' => (\Input::has('stylepage') ? \Input::get('stylepage') : 1),
                'tagsinput' => \Input::get('tagsinput'),
                'seo_title' => \Input::get('seo_title'),
                'seo_keyword' => \Input::get('seo_keyword'),
                'seo_description' => \Input::get('seo_description'),
                'updated_user' => \Auth::user()->id
            );
            \Post::where('id', \Input::get('id'))->update($data);

            if ($file) {
                $destinationPath = 'uploads/post/';
                $extension = $file->getClientOriginalExtension();
                $filename = str_random(40) . '.' . $extension;
                $smallfile = 'cover_' . $filename;
                $smallfile2 = 'cover_front_' . $filename;
                \Input::file('imgcover')->move($destinationPath, $filename);
                \Image::make($destinationPath . $filename)->resize(250, null, TRUE)->save($destinationPath . $smallfile);
                \Image::make($destinationPath . $filename)->resize(370, 200, TRUE)->save($destinationPath . $smallfile2);
                $data2 = array(
                    'cover' => $destinationPath . $smallfile,
                    'front' => $destinationPath . $smallfile2
                );
                \Post::where('id', \Input::get('id'))->update(array('imgcover' => json_encode($data2)));
                $this->deleteFile($destinationPath . $filename);
            }

            if ($file2) {
                $destinationPath2 = 'uploads/post/gallery/';
                foreach ($file2 as $item2) {
                    $extension = $item2->getClientOriginalExtension();
                    $filename2 = str_random(40) . '.' . $extension;
                    \Input::file('imgslide')->move($destinationPath2, $filename2);
                    \Postimg::create(array('post_id' => \Input::get('id'), 'title' => $destinationPath2 . $smallfile));
                }
            }

            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function deletePostSave() {
        try {
            \DB::transaction(function() {
                \Post::find(\Input::get('id'))->delete();
                \Timeline::where('module', 'post')->where('pk_id', \Input::get('id'))->delete();
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

    public function addGroupSave() {
        $rules = array(
            'type' => 'required|max:100',
            'title' => 'required|max:255'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            $categorize = \Categorize::prepare(array(
                        'type' => \Input::get('type'),
                        'title' => \Input::get('title'),
                        'description' => \Input::get('description'),
                        'front' => (\Input::has('front') ? \Input::get('front') : 1)
            ));

            $categorize->makeRoot();

            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function editGroupSave() {
        $rules = array(
            'title' => 'required|max:255'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            $category = \Categorize::getCategoryProvider()->findById(\Input::get('id'));
            $category->fill(array(
                'title' => \Input::get('title'),
                'description' => \Input::get('description'),
                'front' => (\Input::has('front') ? \Input::get('front') : 1)
            ));
            $category->save();
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function deleteGroupSave() {
        try {
            $category = \Categorize::getCategoryProvider()->findById(\Input::get('id'));
            $category->deleteWithChildren();
            return \Response::json(array(
                        'error' => array(
                            'status' => true,
                            'message' => array('Delete data success.'),
                        ), 200));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function addSubGroupSave() {
        $rules = array(
            'title' => 'required|max:255'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            $categorize = \Categorize::prepare(array(
                        'type' => 'post',
                        'title' => \Input::get('title'),
                        'description' => \Input::get('description')
            ));
            $parent = \Categorize::getCategoryProvider()->findById(\Input::get('id'));
            $categorize->makeChildOf($parent);

            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function deleteFile($path) {
        if (\File::exists($path)) {
            \File::delete($path);
        }
    }

}
