<?php

namespace App\Controllers\Backend;

class PostingController extends \BaseController {
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
            'view' => 'backend.posting.index',
            'result' => \Posting::where('disabled', 0)->orderBy('updated_at', 'desc')->paginate(16)
        );
        return \View::make($data['page']['view'], $data);
    }

    public function category() {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('posting')->orderBy('title', 'asc')->get();
        $data['page'] = array(
            'title' => 'Category',
            'view' => 'backend.posting.category',
            'breadcrumbs' => array(
                'J-Shopping' => 'backend/posting',
                'Product' => 'backend/posting/product',
                'Category' => '#'
            ),
            'result' => \Categorize::tree($categories)->toArray()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addCategory() {
        $data['page'] = array(
            'title' => 'Add Category',
            'view' => 'backend.posting.category_add'
        );
        return \View::make($data['page']['view'], $data);
    }

    public function editCategory() {
        $data['page'] = array(
            'title' => 'Edit Category',
            'view' => 'backend.posting.category_edit',
            'item' => \Categorize::getCategoryProvider()->findById(\Input::get('id'))
        );
        return \View::make($data['page']['view'], $data);
    }

    public function moveCategory() {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('posting')->get();
        $data['page'] = array(
            'title' => 'Move Category',
            'view' => 'backend.posting.category_move',
            'result' => \Categorize::tree($categories)->toArray()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addSubCategory() {
        $data['page'] = array(
            'title' => 'Add Sub Category',
            'view' => 'backend.posting.subcategory_add'
        );
        return \View::make($data['page']['view'], $data);
    }

    public function post() {
        if (\Input::get('search')) {
            $posting = \Posting::orderBy('id', 'desc');
            if (\Input::has('s_title')) {
                $posting = $posting->where('title', 'LIKE', '%' . trim(\Input::get('s_title')) . '%');
            }
            if (\Input::has('s_CategoryID')) {
                $posting = $posting->where('categories_id', 'LIKE', \Input::get('s_CategoryID'));
            }
            if (\Auth::user()->is('PostingManagement') == TRUE) {
                $rs = $posting->paginate(20);
            } else {
                $rs = $posting->where('created_user', \Auth::user()->id)->paginate(20);
            }
        } else {
            if (\Auth::user()->is('PostingManagement') == TRUE) {
                $rs = \Posting::orderBy('id', 'desc')->paginate(20);
            } else {
                $rs = \Posting::where('created_user', \Auth::user()->id)->orderBy('id', 'desc')->paginate(20);
            }
        }

        $categories = \Categorize::getCategoryProvider()->root()->whereType('posting')->get();
        $data['page'] = array(
            'title' => 'Posting',
            'view' => 'backend.posting.post',
            'breadcrumbs' => array(
                'Posting' => 'backend/posting',
                'Posting' => '#'
            ),
            'result' => $rs,
            'category' => \Categorize::tree($categories)->toArray(),
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addPost() {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('posting')->get();
        $data['page'] = array(
            'title' => 'Add Post',
            'view' => 'backend.posting.post_add',
            'breadcrumbs' => array(
                'Posting' => 'backend/posting',
                'Post' => 'backend/posting/post',
                'Add' => '#'
            ),
            'category' => \Categorize::tree($categories)->toArray(),
        );
        return \View::make($data['page']['view'], $data);
    }

    public function editPost($id) {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('posting')->get();
        $ct = \Categorize::tree($categories);
        $arr_cat = array();
        foreach ($ct as $val) {
            $arr_cat[$val->id] = $val->title;
        }
        $posting = \Posting::find($id);
        $tools = json_decode($posting->categories_id);
        $data['page'] = array(
            'title' => 'Edit Post',
            'view' => 'backend.posting.post_edit',
            'breadcrumbs' => array(
                'Posting' => 'backend/posting',
                'Post' => 'backend/posting/post',
                'Edit' => '#'
            ),
            'item' => $posting,
            'cat' => $tools,
            'category' => $arr_cat,
            'photo' => \Postingimg::where('posting_id', $id)->get(),
        );
        return \View::make($data['page']['view'], $data);
    }

    public function viewProduct($id) {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('posting')->get();
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
        $prod2 = \Products::find($id);
        $pc = \DB::table('category_hierarchy')->where('category_id', $prod2->CategoryID)->get();
        $rs_productspec = \Productspec::where('categories_id', $pc[0]->category_parent_id)->get();
        $rs_productspecvalue = \Productspecvalue::where('product_id', $id)->get();

        $parent = \Categorize::getCategoryProvider()->findById($prod2->CategoryID);
        $cat = \DB::table('category_hierarchy')->where('category_id', $prod2->CategoryID)->get();
        $cat_name = \Categories::find($cat[0]->category_parent_id);

        if ($prod2->recommended) {
            $recommended = explode(',', $prod2->recommended);
        } else {
            $recommended = array();
        }

        if ($prod2->related) {
            $related = explode(',', $prod2->related);
        } else {
            $related = array();
        }

        $data['page'] = array(
            'title' => 'Edit Product',
            'category' => $parent->title,
            'cat_parent' => $cat_name->title,
            'view' => 'backend.posting.product_view',
            'breadcrumbs' => array(
                'J-Shopping' => 'backend/posting',
                'Product' => 'backend/posting/product',
                'View' => '#'
            ),
            'item' => \Products::find($id),
            'gallery' => \Productimg::where('ProductID', $id)->get(),
            'suppliers' => array('' => \Lang::get('posting.please_select')) + \DB::table('suppliers')->lists('CompanyName', 'SupplierID'),
            'productspec_result' => $rs_productspec,
            'productspecvalue_item' => $rs_productspecvalue[0],
            'result_recommended_product' => $recommended,
            'result_related_product' => $related
        );
        return \View::make($data['page']['view'], $data);
    }

    public function gallery($id) {
        $data['page'] = array(
            'title' => 'Product Gallery',
            'view' => 'backend.posting.product_gallery',
            'result' => \Productimg::where('ProductID', $id)->get()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function setting() {
        $data['page'] = array(
            'title' => 'Product Setting',
            'view' => 'backend.posting.setting',
            'breadcrumbs' => array(
                'J-Shopping' => 'backend/posting',
                'Setting' => '#'
            ),
        );
        return \View::make($data['page']['view'], $data);
    }

    public function orders() {
//        if (\Input::get('search')) {
//            $products = \Products::orderBy('ProductID', 'desc');
//            if (\Input::has('s_ProductName')) {
//                $products = $products->where('ProductName', 'LIKE', '%' . trim(\Input::get('s_ProductName')) . '%');
//            }
//            if (\Input::has('s_ProductCode')) {
//                $products = $products->where('ProductCode', 'LIKE', '%' . trim(\Input::get('s_ProductCode')) . '%');
//            }
//            if (\Input::has('s_CategoryID')) {
//                $products = $products->where('CategoryID', 'LIKE', \Input::get('s_CategoryID'));
//            }
//            $rs = $products->paginate(20);
//        } else {
//            $rs = \DB::table('orders')->orderBy('id', 'desc')->paginate(20);
//        }
        $rs = \DB::table('shopping_order')->orderBy('id', 'desc')->paginate(20);
        $data['page'] = array(
            'title' => \Lang::get('posting.orders'),
            'view' => 'backend.posting.orders',
            'breadcrumbs' => array(
                'J-Shopping' => 'backend/posting',
                'Orders' => '#'
            ),
            'result' => $rs,
        );
        return \View::make($data['page']['view'], $data);
    }

    public function viewOrders($id) {
        $orders = \Shoppingorder::find($id);
        $users = \User::find($orders->user_id);
        $order_detail = \Shoppingorderdetail::where('shopping_order_id', $orders->id)->get();
        $data['page'] = array(
            'title' => 'View Orders',
            'view' => 'backend.posting.orders_view',
            'breadcrumbs' => array(
                'J-Shopping' => 'backend/posting',
                'Orders' => 'backend/posting/orders',
                'View' => '#'
            ),
            'item' => $orders,
            'item_detail' => $order_detail,
            'member' => $users
        );
        return \View::make($data['page']['view'], $data);
    }

    public function viewPayment($id) {
        $transfer = \Shoppingtransfer::where('order_id', $id)->get();
        $data['page'] = array(
            'title' => 'View Payment',
            'view' => 'backend.posting.payment_view',
            'item' => $transfer[0]
        );
        return \View::make($data['page']['view'], $data);
    }

    public function changeStatus() {
        $data['page'] = array(
            'title' => 'View Payment',
            'view' => 'backend.posting.orders_change_status'
        );
        return \View::make($data['page']['view'], $data);
    }

############################################################

    public function addCategorySave() {
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
                        'type' => trim(\Input::get('type')),
                        'title' => trim(\Input::get('title')),
                        'description' => trim(\Input::get('description')),
                        'disabled' => (\Input::has('disabled') ? \Input::get('disabled') : 1)
            ));

            $categorize->makeRoot();

            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function editCategorySave() {
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
                'title' => trim(\Input::get('title')),
                'description' => trim(\Input::get('description')),
                'disabled' => (\Input::has('disabled') ? \Input::get('disabled') : 1)
            ));
            $category->save();
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function addSubCategorySave() {
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
                        'type' => trim(\Input::get('type')),
                        'title' => trim(\Input::get('title')),
                        'description' => trim(\Input::get('description'))
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

    public function moveCategorySave() {
        try {
            $rules = array(
                'idm' => 'required'
            );
            $validator = \Validator::make(\Input::all(), $rules);
            if ($validator->fails()) {
                return \Response::json(array(
                            'error' => array(
                                'status' => FALSE,
                                'message' => $validator->errors()->toArray()
                            ), 400));
            } else {
                $idm = \Input::get('idm');
                $category = \Categorize::getCategoryProvider()->findById(\Input::get('id'));
                $parent = \Categorize::getCategoryProvider()->findById($idm[0]);
                $category->makeChildOf($parent);
                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'message' => 'Save data Success.'
                            ), 200));
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function deleteCategorySave() {
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

    public function addPostSave() {
        $file1 = \Input::file('photo0');
        $file2 = \Input::file('photo1');
        $file3 = \Input::file('photo2');
        $file4 = \Input::file('photo3');
        $file5 = \Input::file('photo4');
        $file6 = \Input::file('photo5');
        $file7 = \Input::file('photo6');
        $file8 = \Input::file('photo7');
        $rules = array(
            'title' => 'required|max:100',
            'categories_id' => 'required',
            'price' => 'max:255',
            'description' => 'required',
            'mobile' => 'required',
            'province' => 'required',
            'amphur' => 'required',
            'photo0' => 'image|mimes:jpeg,png|max:1024',
            'photo1' => 'image|mimes:jpeg,png|max:1024',
            'photo2' => 'image|mimes:jpeg,png|max:1024',
            'photo3' => 'image|mimes:jpeg,png|max:1024',
            'photo4' => 'image|mimes:jpeg,png|max:1024',
            'photo5' => 'image|mimes:jpeg,png|max:1024',
            'photo6' => 'image|mimes:jpeg,png|max:1024',
            'photo7' => 'image|mimes:jpeg,png|max:1024'
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
                'categories_id' => json_encode(\Input::get('categories_id')),
                'description' => trim(\Input::get('description')),
                'price' => trim(\Input::get('price')),
                'province' => \Input::get('province'),
                'amphur' => \Input::get('amphur'),
                'zipcode' => trim(\Input::get('zipcode')),
                'mobile' => trim(\Input::get('mobile')),
                'tags' => trim(\Input::get('tags')),
                'disabled' => (\Input::has('disabled') ? \Input::get('disabled') : 1),
                'created_user' => \Auth::user()->id
            );
            $posting = \Posting::create($data);
            $data2 = array(
                'pk_id' => $posting->id,
                'title' => trim(\Input::get('title')),
                'module' => 'posting',
                'url' => 'posting/view/' . $posting->id . '',
                'created_user' => \Auth::user()->id
            );
            \Timeline::setTimeline($data2);

            if ($file1 != NULL) {
                $param = array(
                    'posting_id' => $posting->id,
                    'file' => $file1,
                    'type' => 'insert'
                );
                $this->uploadimg($param);
            }
            if ($file2 != NULL) {
                $param = array(
                    'posting_id' => $posting->id,
                    'file' => $file2,
                    'type' => 'insert'
                );
                $this->uploadimg($param);
            }
            if ($file3 != NULL) {
                $param = array(
                    'posting_id' => $posting->id,
                    'file' => $file3,
                    'type' => 'insert'
                );
                $this->uploadimg($param);
            }
            if ($file4 != NULL) {
                $param = array(
                    'posting_id' => $posting->id,
                    'file' => $file4,
                    'type' => 'insert'
                );
                $this->uploadimg($param);
            }
            if ($file5 != NULL) {
                $param = array(
                    'posting_id' => $posting->id,
                    'file' => $file5,
                    'type' => 'insert'
                );
                $this->uploadimg($param);
            }
            if ($file6 != NULL) {
                $param = array(
                    'posting_id' => $posting->id,
                    'file' => $file6,
                    'type' => 'insert'
                );
                $this->uploadimg($param);
            }
            if ($file7 != NULL) {
                $param = array(
                    'posting_id' => $posting->id,
                    'file' => $file7,
                    'type' => 'insert'
                );
                $this->uploadimg($param);
            }
            if ($file8 != NULL) {
                $param = array(
                    'posting_id' => $posting->id,
                    'file' => $file8,
                    'type' => 'insert'
                );
                $this->uploadimg($param);
            }
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function editPostSave() {
        $file1 = \Input::file('photo0');
        $file2 = \Input::file('photo1');
        $file3 = \Input::file('photo2');
        $file4 = \Input::file('photo3');
        $file5 = \Input::file('photo4');
        $file6 = \Input::file('photo5');
        $file7 = \Input::file('photo6');
        $file8 = \Input::file('photo7');
        $rules = array(
            'title' => 'required|max:100',
            'categories_id' => 'required',
            'price' => 'max:255',
            'description' => 'required',
            'mobile' => 'required',
            'province' => 'required',
            'amphur' => 'required',
            'photo0' => 'image|mimes:jpeg,png|max:1024',
            'photo1' => 'image|mimes:jpeg,png|max:1024',
            'photo2' => 'image|mimes:jpeg,png|max:1024',
            'photo3' => 'image|mimes:jpeg,png|max:1024',
            'photo4' => 'image|mimes:jpeg,png|max:1024',
            'photo5' => 'image|mimes:jpeg,png|max:1024',
            'photo6' => 'image|mimes:jpeg,png|max:1024',
            'photo7' => 'image|mimes:jpeg,png|max:1024'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            $postm = \Posting::find(\Input::get('id'));
            if (array_diff(json_decode($postm->categories_id, TRUE), \Input::get('categories_id')) != null) {
                $cat = json_encode(\Input::get('categories_id'));
            } else {
                $cat = $postm->categories_id;
            }
            $data = array(
                'title' => trim(\Input::get('title')),
                'categories_id' => $cat,
                'description' => trim(\Input::get('description')),
                'price' => trim(\Input::get('price')),
                'province' => \Input::get('province'),
                'amphur' => \Input::get('amphur'),
                'zipcode' => trim(\Input::get('zipcode')),
                'mobile' => trim(\Input::get('mobile')),
                'tags' => trim(\Input::get('tags')),
                'disabled' => (\Input::has('disabled') ? \Input::get('disabled') : 1),
                'updated_user' => \Auth::user()->id
            );
            \Posting::where('id', \Input::get('id'))->update($data);

            if (\Input::get('photo_delete') != null) {
                foreach (\Input::get('photo_delete') as $value) {
                    $img_delete = \Postingimg::find($value);
                    $cover = json_decode(trim($img_delete->path))->{'cover'};
                    $medium = json_decode(trim($img_delete->path))->{'medium'};
                    $photo = json_decode(trim($img_delete->path))->{'photo'};
                    if (\File::exists($cover)) {
                        \File::delete($cover);
                    }
                    if (\File::exists($medium)) {
                        \File::delete($medium);
                    }

                    if (\File::exists($photo)) {
                        \File::delete($photo);
                    }
                    \Postingimg::find($value)->delete();
                }
            }

            if ($file1 != NULL) {
                if (\Input::get('photo_id0') != '') {
                    $param = array(
                        'id' => \Input::get('photo_id0'),
                        'file' => $file1,
                        'type' => 'update'
                    );
                    $this->uploadimg($param);
                } else {
                    $param = array(
                        'posting_id' => \Input::get('id'),
                        'file' => $file1,
                        'type' => 'insert'
                    );
                    $this->uploadimg($param);
                }
            }
            if ($file2 != NULL) {
                if (\Input::get('photo_id1') != '') {
                    $param = array(
                        'id' => \Input::get('photo_id1'),
                        'file' => $file2,
                        'type' => 'update'
                    );
                    $this->uploadimg($param);
                } else {
                    $param = array(
                        'posting_id' => \Input::get('id'),
                        'file' => $file2,
                        'type' => 'insert'
                    );
                    $this->uploadimg($param);
                }
            }
            if ($file3 != NULL) {
                if (\Input::get('photo_id2') != '') {
                    $param = array(
                        'id' => \Input::get('photo_id2'),
                        'file' => $file3,
                        'type' => 'update'
                    );
                    $this->uploadimg($param);
                } else {
                    $param = array(
                        'posting_id' => \Input::get('id'),
                        'file' => $file3,
                        'type' => 'insert'
                    );
                    $this->uploadimg($param);
                }
            }
            if ($file4 != NULL) {
                if (\Input::get('photo_id2') != '') {
                    $param = array(
                        'id' => \Input::get('photo_id3'),
                        'file' => $file4,
                        'type' => 'update'
                    );
                    $this->uploadimg($param);
                } else {
                    $param = array(
                        'posting_id' => \Input::get('id'),
                        'file' => $file4,
                        'type' => 'insert'
                    );
                    $this->uploadimg($param);
                }
            }
            if ($file5 != NULL) {
                if (\Input::get('photo_id4') != '') {
                    $param = array(
                        'id' => \Input::get('photo_id4'),
                        'file' => $file5,
                        'type' => 'update'
                    );
                    $this->uploadimg($param);
                } else {
                    $param = array(
                        'posting_id' => \Input::get('id'),
                        'file' => $file5,
                        'type' => 'insert'
                    );
                    $this->uploadimg($param);
                }
            }
            if ($file6 != NULL) {
                if (\Input::get('photo_id5') != '') {
                    $param = array(
                        'id' => \Input::get('photo_id5'),
                        'file' => $file6,
                        'type' => 'update'
                    );
                    $this->uploadimg($param);
                } else {
                    $param = array(
                        'posting_id' => \Input::get('id'),
                        'file' => $file6,
                        'type' => 'insert'
                    );
                    $this->uploadimg($param);
                }
            }
            if ($file7 != NULL) {
                if (\Input::get('photo_id6') != '') {
                    $param = array(
                        'id' => \Input::get('photo_id6'),
                        'file' => $file7,
                        'type' => 'update'
                    );
                    $this->uploadimg($param);
                } else {
                    $param = array(
                        'posting_id' => \Input::get('id'),
                        'file' => $file7,
                        'type' => 'insert'
                    );
                    $this->uploadimg($param);
                }
            }
            if ($file8 != NULL) {
                if (\Input::get('photo_id7') != '') {
                    $param = array(
                        'id' => \Input::get('photo_id7'),
                        'file' => $file8,
                        'type' => 'update'
                    );
                    $this->uploadimg($param);
                } else {
                    $param = array(
                        'posting_id' => \Input::get('id'),
                        'file' => $file8,
                        'type' => 'insert'
                    );
                    $this->uploadimg($param);
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
            foreach (\Postingimg::where('posting_id', \Input::get('id'))->get() as $value) {
                $cover = json_decode(trim($value->path))->{'cover'};
                $medium = json_decode(trim($value->path))->{'medium'};
                $photo = json_decode(trim($value->path))->{'photo'};
                if (\File::exists($cover)) {
                    \File::delete($cover);
                }
                if (\File::exists($medium)) {
                    \File::delete($medium);
                }

                if (\File::exists($photo)) {
                    \File::delete($photo);
                }
                \Postingimg::find($value->id)->delete();
            }
            \Posting::find(\Input::get('id'))->delete();
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
        $filename = str_random(40) . '.' . $extension;
        $destinationPathG = 'uploads/product/gallery/';
        $filenameG = $filename;
        $smallfileG = 'thumbs_' . $filename;
        \Input::file('photo')->move($destinationPathG, $filenameG);
        \Image::make($destinationPathG . $filenameG)->resize(430, null, TRUE)->save($destinationPathG . $smallfileG);
        $data3 = array(
            'photo' => $destinationPathG . $filenameG,
            'thumbs' => $destinationPathG . $smallfileG
        );
        \Productimg::create(array('ProductID' => $id, 'name' => $filenameG, 'title' => json_encode($data3)));
    }

    public function deleteGallerySave($id) {
        try {
            $productimg = \Productimg::find($id)->get();
            $photo = json_decode(trim($productimg[0]->title))->{'photo'};
            if ($productimg[0]) {
                $photo = json_decode(trim($productimg[0]->title))->{'photo'};
                $thumbs = json_decode(trim($productimg[0]->title))->{'thumbs'};
                if (\File::exists($photo)) {
                    \File::delete($photo);
                }
                if (\File::exists($thumbs)) {
                    \File::delete($thumbs);
                }
            }
            \Productimg::find($id)->delete();
            return \Response::json(array(
                        'error' => array(
                            'status' => true,
                            'message' => array('Delete data success.'),
                        ), 200));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function changeStatusSave() {
        $rules = array(
            'status' => 'required'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            $order = \Shoppingorder::find(\Input::get('order_id'));
            $order->status = \Input::get('status');
            $order->save();
            \Shoppingorderstatuslog::setLog(array('order_id' => \Input::get('order_id'), 'status' => \Input::get('status'), 'updated_user' => \Auth::user()->id));

            //Send mail

            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'Save data Success.'
                        ), 200));
        }
    }

    public function uploadimg($param = array()) {
        $destinationPath = 'uploads/posting/' . date('Ymd') . '/';
        $extension = $param['file']->getClientOriginalExtension();
        $filename = str_random(40) . '.' . $extension;
        $smallfile = 'cover_' . $filename;
        $smallfile2 = 'medium_' . $filename;
        $param['file']->move($destinationPath, $filename);
        \Image::make($destinationPath . $filename)->resize(250, null, TRUE)->save($destinationPath . $smallfile);
        \Image::make($destinationPath . $filename)->resize(600, null, TRUE)->save($destinationPath . $smallfile2);
        $data2 = array(
            'cover' => $destinationPath . $smallfile,
            'medium' => $destinationPath . $smallfile2,
            'photo' => $destinationPath . $filename
        );
        if ($param['type'] == 'update') {
            $postingimg = \Postingimg::find($param['id']);

            if ($productimg) {

                $cover = json_decode(trim($productimg->path))->{'cover'};
                $photo = json_decode(trim($productimg->path))->{'photo'};
                $medium = json_decode(trim($productimg->path))->{'medium'};
                if (\File::exists($cover)) {
                    \File::delete($cover);
                }
                if (\File::exists($photo)) {
                    \File::delete($photo);
                }
                if (\File::exists($medium)) {
                    \File::delete($medium);
                }
            }

            $postingimg->title = $param['file']->getClientOriginalName();
            $postingimg->path = json_encode($data2);
            $postingimg->save();
        } else {
            $img = new \Postingimg;
            $img->posting_id = $param['posting_id'];
            $img->title = $param['file']->getClientOriginalName();
            $img->path = json_encode($data2);
            $img->save();
        }
    }

}
