<?php

namespace App\Controllers\Backend;

class JgalleryController extends \BaseController {
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
            'title' => 'Gallery',
            'view' => 'backend.jgallery.index',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'Gallery' => 'backend/post',
                'List item' => '#'
            ),
            'result' => \DB::table('gallery')
                    ->join('categories', 'categories.id', '=', 'gallery.categories_id')
                    ->select('gallery.id', 'gallery.name', 'categories.title as groupname', 'gallery.disabled', 'gallery.frontend', 'gallery.created_at', 'gallery.updated_at')
                    ->orderBy('id', 'desc')
                    ->get()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function add() {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('gallery')->get();
        $data['page'] = array(
            'title' => 'Add Gallery',
            'view' => 'backend.jgallery.add',
            'category' => \Categorize::tree($categories)->toArray()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function edit() {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('gallery')->get();
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
        $g = \Gallery::where('id', \Input::get('id'))->get();
        $data['page'] = array(
            'title' => 'Edit Gallery',
            'view' => 'backend.jgallery.edit',
            'item' => $g[0],
            'category' => $arr_cat,
        );
        return \View::make($data['page']['view'], $data);
    }

    public function view($id) {
        $gall = \Gallery::find($id)->get();
        $Galleryimg = \Galleryimg::where('gallery_id', $id)->get();
        $data['page'] = array(
            'title' => $gall[0]->name,
            'detail' => $gall[0]->shortdetail,
            'view' => 'backend.jgallery.gallery_view',
            'result' => $Galleryimg
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addGallery($id) {
        $data['page'] = array(
            'title' => 'Add Gallery',
            'view' => 'backend.jgallery.gallery_add',
            'result' => \Galleryimg::where('gallery_id', $id)->get()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function group() {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('gallery')->get();
        $data['page'] = array(
            'title' => 'Group',
            'view' => 'backend.jgallery.group',
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'Gallery' => 'backend/post',
                'List item' => '#'
            ),
            'result' => \Categorize::tree($categories)->toArray()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addGroup() {
        $data['page'] = array(
            'title' => 'Add Group',
            'view' => 'backend.jgallery.group_add'
        );
        return \View::make($data['page']['view'], $data);
    }

    public function editGroup() {
        $data['page'] = array(
            'title' => 'Edit Group',
            'view' => 'backend.jgallery.group_edit',
            'item' => \Categorize::getCategoryProvider()->findById(\Input::get('id'))
        );
        return \View::make($data['page']['view'], $data);
    }

    ########################

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
                        'description' => \Input::get('description')
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
                'description' => \Input::get('description')
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

    public function addSave() {
        $file = \Input::file('imgcover');
        $rules = array(
            'name' => 'required|max:100',
            'categories_id' => 'required',
            'imgcover' => 'required|image|mimes:jpeg,png|max:1024'
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
                'disabled' => (\Input::has('disabled') ? \Input::get('disabled') : 1),
                'frontend' => (\Input::has('frontend') ? \Input::get('frontend') : 1),
                'created_user' => \Auth::user()->id
            );
            $gallery_id = \Gallery::create($data);
            $data2 = array(
                'pk_id' => $gallery_id->id,
                'title' => trim(\Input::get('name')),
                'module' => 'jgallery',
                'url' => 'jgallery/view/' . $gallery_id->id . '',
                'created_user' => \Auth::user()->id
            );
            \Timeline::setTimeline($data2);


            if ($file) {
                $destinationPath = 'uploads/gallery/' . $gallery_id->id . '/';
                $extension = $file->getClientOriginalExtension();
                $filename = str_random(40) . '.' . $extension;
                $smallfile = 'cover_' . $filename;
                \Input::file('imgcover')->move($destinationPath, $filename);
                \Image::make($destinationPath . $filename)->resize(250, 170, TRUE)->save($destinationPath . $smallfile);
                $data3 = array(
                    'cover' => $destinationPath . $smallfile
                );
                \Gallery::where('id', $gallery_id->id)->update(array('imgcover' => json_encode($data3)));
            }
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function editSave() {
        $file = \Input::file('imgcover');
        $rules = array(
            'name' => 'required|max:100',
            'categories_id' => 'required',
            'imgcover' => 'required|image|mimes:jpeg,png|max:1024'
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
                'disabled' => (\Input::has('disabled') ? \Input::get('disabled') : 1),
                'frontend' => (\Input::has('frontend') ? \Input::get('frontend') : 1),
                'created_user' => \Auth::user()->id
            );
            \Gallery::where('id', \Input::get('id'))->update($data);

            if ($file) {
                $destinationPath = 'uploads/gallery/' . \Input::get('id') . '/';
                $extension = $file->getClientOriginalExtension();
                $filename = str_random(40) . '.' . $extension;
                $smallfile = 'cover_' . $filename;
                \Input::file('imgcover')->move($destinationPath, $filename);
                \Image::make($destinationPath . $filename)->resize(250, 170, TRUE)->save($destinationPath . $smallfile);
                $data3 = array(
                    'cover' => $destinationPath . $smallfile
                );
                \Gallery::where('id', \Input::get('id'))->update(array('imgcover' => json_encode($data3)));
            }

            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function deleteSave() {
        try {
            $gallery = \Gallery::find(\Input::get('id'));
            $gallery->delete();
            $directory = 'uploads/gallery/' . \Input::get('id') . '';
            if (\File::isDirectory($directory)) {
                \File::deleteDirectory($directory);
            }
            return \Response::json(array(
                        'error' => array(
                            'status' => true,
                            'message' => array('Delete data success.'),
                        ), 200));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function addGallerySave($id) {
        $file = \Input::file('photo');
        $extension = $file->getClientOriginalExtension();
        $filenameG = str_random(40) . '.' . $extension;
        $destinationPathG = 'uploads/gallery/' . $id . '/';
        $smallfileG = 'thumbs_' . $filenameG;
        \Input::file('photo')->move($destinationPathG, $filenameG);
        \Image::make($destinationPathG . $filenameG)->resize(430, null, TRUE)->save($destinationPathG . $smallfileG);
        $data3 = array(
            'photo' => $destinationPathG . $filenameG,
            'thumbs' => $destinationPathG . $smallfileG
        );
        \Galleryimg::create(array('gallery_id' => $id, 'name' => $filenameG, 'url' => json_encode($data3)));
    }

    public function deleteGallerySave($id) {
        try {
            $galleryimg = \Galleryimg::find($id)->get();
            $photo = json_decode(trim($galleryimg[0]->url))->{'photo'};
            if ($galleryimg[0]) {
                $photo = json_decode(trim($galleryimg[0]->url))->{'photo'};
                $thumbs = json_decode(trim($galleryimg[0]->url))->{'thumbs'};
                $this->deleteFile($photo);
                $this->deleteFile($thumbs);
            }
            \Galleryimg::find($id)->delete();
            return \Response::json(array(
                        'error' => array(
                            'status' => true,
                            'message' => array('Delete data success.'),
                        ), 200));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function deleteFile($path) {
        if (\File::exists($path)) {
            \File::delete($path);
        }
    }

}
