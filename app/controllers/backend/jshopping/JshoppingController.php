<?php

namespace App\Controllers\Backend;

class JshoppingController extends \BaseController {
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
            'view' => 'backend.jshopping.index',
            'breadcrumbs' => array(
                'J-Shopping' => 'backend/jshopping',
                'Overview' => '#'
            )
        );
        return \View::make($data['page']['view'], $data);
    }

    public function category() {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('product')->orderBy('title', 'asc')->get();
        $data['page'] = array(
            'title' => 'Category',
            'view' => 'backend.jshopping.category',
            'breadcrumbs' => array(
                'J-Shopping' => 'backend/jshopping',
                'Product' => 'backend/jshopping/product',
                'Category' => '#'
            ),
            'result' => \Categorize::tree($categories)->toArray()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function suppliers() {
        $data['page'] = array(
            'title' => 'Suppliers',
            'view' => 'backend.jshopping.suppliers',
            'breadcrumbs' => array(
                'J-Shopping' => 'backend/jshopping',
                'Suppliers' => '#'
            ),
            'result' => \Suppliers::all()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function shipper() {
        $data['page'] = array(
            'title' => 'บริษัทขนส่งสินค้า',
            'view' => 'backend.jshopping.shipper',
            'breadcrumbs' => array(
                'J-Shopping' => 'backend/jshopping',
                'Shipper' => '#'
            ),
            'result' => \Shipper::all()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addCategory() {
        if (!\Request::isMethod('post')) {
            $data['page'] = array(
                'title' => 'Add Category',
                'view' => 'backend.jshopping.category_add'
            );
            return \View::make($data['page']['view'], $data);
        } else {
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

                $categorize->makeRoot();

                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'message' => 'Save data Success.'
                            ), 200));
            }
        }
    }

    public function editCategory() {
        if (!\Request::isMethod('post')) {
            $data['page'] = array(
                'title' => 'Edit Category',
                'view' => 'backend.jshopping.category_edit',
                'item' => \Categorize::getCategoryProvider()->findById(\Input::get('id'))
            );
            return \View::make($data['page']['view'], $data);
        } else {
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
                    'description' => trim(\Input::get('description'))
                ));
                $category->save();
                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'message' => 'Save data Success.'
                            ), 200));
            }
        }
    }

    public function moveCategory() {
        if (!\Request::isMethod('post')) {
            $categories = \Categorize::getCategoryProvider()->root()->whereType('product')->get();
            $data['page'] = array(
                'title' => 'Move Category',
                'view' => 'backend.jshopping.category_move',
                'result' => \Categorize::tree($categories)->toArray()
            );
            return \View::make($data['page']['view'], $data);
        } else {
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
    }

    public function addSubCategory() {
        if (!\Request::isMethod('post')) {
            $data['page'] = array(
                'title' => 'Add Sub Category',
                'view' => 'backend.jshopping.subcategory_add'
            );
            return \View::make($data['page']['view'], $data);
        } else {
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
    }

    public function product() {
        if (\Input::get('search')) {
            $products = \Products::orderBy('ProductID', 'desc');
            if (\Input::has('s_ProductName')) {
                $products = $products->where('ProductName', 'LIKE', '%' . trim(\Input::get('s_ProductName')) . '%');
            }
            if (\Input::has('cat1')) {
                $products = $products->orWhere('sub1', trim(\Input::get('cat1')));
            }
            if (\Input::has('cat2')) {
                $products = $products->orWhere('sub2', trim(\Input::get('cat2')));
            }
            if (\Input::has('s_ProductCode')) {
                $products = $products->where('ProductCode', 'LIKE', '%' . trim(\Input::get('s_ProductCode')) . '%');
            }
            $rs = $products->paginate(20);
        } else {
            $rs = \DB::table('products')->orderBy('ProductID', 'desc')->paginate(20);
        }
        $categories = \Categorize::getCategoryProvider()->root()->whereType('product')->get();
        $data['page'] = array(
            'title' => 'Product',
            'view' => 'backend.jshopping.product',
            'breadcrumbs' => array(
                'J-Shopping' => 'backend/jshopping',
                'Product' => '#'
            ),
            'result' => $rs,
            'category' => \Categorize::tree($categories)->toArray(),
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addProduct() {
        if (!\Request::isMethod('post')) {
            $categories = \Categorize::getCategoryProvider()->root()->whereType('product')->get();
            $data['page'] = array(
                'title' => 'Add Product',
                'view' => 'backend.jshopping.product_add',
                'breadcrumbs' => array(
                    'J-Shopping' => 'backend/jshopping',
                    'Product' => 'backend/jshopping/product',
                    'Add' => '#'
                ),
                'category' => \Categorize::tree($categories)->toArray(),
                'suppliers' => array('' => \Lang::get('jshopping.please_select')) + \DB::table('suppliers')->lists('CompanyName', 'SupplierID')
            );
            return \View::make($data['page']['view'], $data);
        } else {
            $file = \Input::file('imgcover');
            $rules = array(
                'ProductName' => 'required|max:100',
                'ProductCode' => 'required|unique:products,ProductCode',
                'cat1' => 'required',
                'UnitPrice' => 'required',
                'ShortDetail' => 'max:255',
                'Detail' => 'required',
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
                $product = new \Products();
                $product->ProductCode = trim(\Input::get('ProductCode'));
                $product->ProductName = trim(\Input::get('ProductName'));
                $product->SupplierID = trim(\Input::get('SupplierID'));
                $product->sub1 = (\Input::has('cat1') ? \Input::get('cat1') : 0);
                $product->sub2 = (\Input::has('cat2') ? \Input::get('cat2') : 0);
                $product->sub3 = (\Input::has('cat3') ? \Input::get('cat3') : 0);
                $product->sub4 = (\Input::has('cat4') ? \Input::get('cat4') : 0);
                $product->sub5 = (\Input::has('cat5') ? \Input::get('cat5') : 0);
                $product->ShortDetail = trim(\Input::get('ShortDetail'));
                $product->Detail = trim(\Input::get('Detail'));
                $product->UnitPrice = trim(\Input::get('UnitPrice'));
                $product->UnitsInStock = trim(\Input::get('UnitsInStock'));
                $product->weight = trim(\Input::get('weight'));
                $product->disabled = (\Input::has('disabled') ? \Input::get('disabled') : 1);
                $product->featured = (\Input::has('featured') ? \Input::get('featured') : 1);
                $product->new = (\Input::has('new') ? \Input::get('new') : 1);
                $product->special = (\Input::has('special') ? \Input::get('special') : 1);
                $product->tags = trim(\Input::get('tags'));
                $product->seo_title = trim(\Input::get('seo_title'));
                $product->seo_keyword = trim(\Input::get('seo_keyword'));
                $product->seo_description = trim(\Input::get('seo_description'));
                $product->recommended = trim(\Input::get('recommended'));
                $product->related = trim(\Input::get('related'));
                $product->created_user = \Auth::user()->id;
                $product->save();
                $prod_id = $product->ProductID;

                $j = 1;
                for ($i = 0; $i < 10; $i++) {
                    $price = new \Productprice();
                    $price->product_id = $prod_id;
                    $price->price = (\Input::has('price.' . $i) ? \Input::get('price.' . $i) : 0);
                    $price->active = (\Input::has('active' . $i) ? 0 : 1);
                    $price->rank = $j;
                    $price->save();
                    $j++;
                }
                $data2 = array(
                    'pk_id' => $prod_id,
                    'title' => trim(\Input::get('ProductName')),
                    'module' => 'jshopping',
                    'url' => 'jshopping/product/view/' . $prod_id . '',
                    'created_user' => \Auth::user()->id
                );
                //\Timeline::setTimeline($data2);
                if ($file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = str_random(40) . '.' . $extension;
                    $destinationPath = 'uploads/product/';
                    $smallfile = 'cover_' . $filename;
                    $smallfile2 = 'cover_front_' . $filename;
                    \Input::file('imgcover')->move($destinationPath, $filename);
                    \Image::make($destinationPath . $filename)->resize(250, null, TRUE)->save($destinationPath . $smallfile);
                    \Image::make($destinationPath . $filename)->resize(400, null, TRUE)->save($destinationPath . $smallfile2);
                    $data2 = array(
                        'cover' => $destinationPath . $smallfile,
                        'front' => $destinationPath . $smallfile2
                    );
                    \Products::where('ProductID', $prod_id)->update(array('imgcover' => json_encode($data2)));
                }

                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'message' => 'Save data Success.',
                                'redirect' => 'jshopping/product/edit/' . $prod_id
                            ), 200));
            }
        }
    }

    public function editProduct($id) {
        if (!\Request::isMethod('post')) {
            $categories = \Categorize::getCategoryProvider()->root()->whereType('product')->get();
            $ct = \Categorize::tree($categories);
            $arr_cat = array();
            foreach ($ct as $val) {
                $arr_cat[$val->id] = $val->title;
            }
            $data['page'] = array(
                'title' => 'Edit Product',
                'view' => 'backend.jshopping.product_edit',
                'breadcrumbs' => array(
                    'J-Shopping' => 'backend/jshopping',
                    'Product' => 'backend/jshopping/product',
                    'Add' => '#'
                ),
                'item' => \Products::find($id),
                'category' => $arr_cat,
                'suppliers' => array('' => \Lang::get('jshopping.please_select')) + \DB::table('suppliers')->lists('CompanyName', 'SupplierID')
            );
            return \View::make($data['page']['view'], $data);
        } else {
            $file = \Input::file('imgcover');
            $rules = array(
                'ProductName' => 'required|max:100',
                'cat1' => 'required',
                'ShortDetail' => 'max:255',
                'Detail' => 'required',
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

                $product = \Products::find(\Input::get('id'));
                $product->ProductCode = trim(\Input::get('ProductCode'));
                $product->ProductName = trim(\Input::get('ProductName'));
                $product->SupplierID = trim(\Input::get('SupplierID'));
                $product->sub1 = (\Input::has('cat1') ? \Input::get('cat1') : 0);
                $product->sub2 = (\Input::has('cat2') ? \Input::get('cat2') : 0);
                $product->sub3 = (\Input::has('cat3') ? \Input::get('cat3') : 0);
                $product->sub4 = (\Input::has('cat4') ? \Input::get('cat4') : 0);
                $product->sub5 = (\Input::has('cat5') ? \Input::get('cat5') : 0);
                $product->ShortDetail = trim(\Input::get('ShortDetail'));
                $product->Detail = trim(\Input::get('Detail'));
                $product->UnitPrice = trim(\Input::get('UnitPrice'));
                $product->UnitsInStock = trim(\Input::get('UnitsInStock'));
                $product->weight = trim(\Input::get('weight'));
                $product->disabled = (\Input::has('disabled') ? \Input::get('disabled') : 1);
                $product->featured = (\Input::has('featured') ? \Input::get('featured') : 1);
                $product->new = (\Input::has('new') ? \Input::get('new') : 1);
                $product->special = (\Input::has('special') ? \Input::get('special') : 1);
                $product->tags = trim(\Input::get('tags'));
                $product->seo_title = trim(\Input::get('seo_title'));
                $product->seo_keyword = trim(\Input::get('seo_keyword'));
                $product->seo_description = trim(\Input::get('seo_description'));
                $product->recommended = trim(\Input::get('recommended'));
                $product->related = trim(\Input::get('related'));
                $product->updated_user = \Auth::user()->id;
                $product->save();

                if ($file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = str_random(40) . '.' . $extension;
                    $destinationPath = 'uploads/product/';
                    $filename = $file->getClientOriginalName();
                    $smallfile = 'cover_' . $filename;
                    $smallfile2 = 'cover_front_' . $filename;
                    \Input::file('imgcover')->move($destinationPath, $filename);
                    \Image::make($destinationPath . $filename)->resize(250, null, TRUE)->save($destinationPath . $smallfile);
                    \Image::make($destinationPath . $filename)->resize(400, null, TRUE)->save($destinationPath . $smallfile2);
                    $data2 = array(
                        'cover' => $destinationPath . $smallfile,
                        'front' => $destinationPath . $smallfile2
                    );
                    \Products::where('ProductID', \Input::get('id'))->update(array('imgcover' => json_encode($data2)));
                    if (\File::exists($destinationPath . $filename)) {
                        \File::delete($destinationPath . $filename);
                    }
                }
                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'message' => 'Save data Success.'
                            ), 200));
            }
        }
    }

    public function viewProduct($id) {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('product')->get();
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
            'view' => 'backend.jshopping.product_view',
            'breadcrumbs' => array(
                'J-Shopping' => 'backend/jshopping',
                'Product' => 'backend/jshopping/product',
                'View' => '#'
            ),
            'item' => \Products::find($id),
            'gallery' => \Productimg::where('ProductID', $id)->get(),
            'suppliers' => array('' => \Lang::get('jshopping.please_select')) + \DB::table('suppliers')->lists('CompanyName', 'SupplierID'),
            'productspec_result' => $rs_productspec,
            'productspecvalue_item' => $rs_productspecvalue[0],
            'result_recommended_product' => $recommended,
            'result_related_product' => $related
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addSuppliers() {
        if (!\Request::isMethod('post')) {
            $data['page'] = array(
                'title' => 'Add Suppliers',
                'view' => 'backend.jshopping.suppliers_add'
            );
            return \View::make($data['page']['view'], $data);
        } else {
            try {
                $rules = array(
                    'CompanyName' => 'required|max:100',
                    'ContactName' => 'required|max:100',
                    'ContactTitle' => 'max:100',
                    'Address' => 'max:100',
                    'Phone' => 'required|max:24',
                    'Fax' => 'max:24',
                    'Email' => 'required|email'
                );
                $validator = \Validator::make(\Input::all(), $rules);
                if ($validator->fails()) {
                    return \Response::json(array(
                                'error' => array(
                                    'status' => FALSE,
                                    'message' => $validator->errors()->toArray()
                                ), 400));
                } else {
                    $suppliers = new \Suppliers();
                    $suppliers->CompanyName = trim(\Input::get('CompanyName'));
                    $suppliers->ContactName = trim(\Input::get('ContactName'));
                    $suppliers->ContactTitle = trim(\Input::get('ContactTitle'));
                    $suppliers->Address = trim(\Input::get('Address'));
                    $suppliers->Phone = trim(\Input::get('Phone'));
                    $suppliers->Fax = trim(\Input::get('Fax'));
                    $suppliers->Email = trim(\Input::get('Email'));
                    $suppliers->disabled = (\Input::has('disabled') ? \Input::get('disabled') : 1);
                    $suppliers->save();
                    return \Response::json(array(
                                'error' => array(
                                    'status' => TRUE,
                                    'message' => 'Save data Success.'
                                ), 200));
                }
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

    public function editSuppliers() {
        if (!\Request::isMethod('post')) {
            $data['page'] = array(
                'title' => 'Edit Suppliers',
                'view' => 'backend.jshopping.suppliers_edit',
                'item' => \Suppliers::find(\Input::get('id')),
            );
            return \View::make($data['page']['view'], $data);
        } else {
            try {
                $rules = array(
                    'CompanyName' => 'required|max:100',
                    'ContactName' => 'required|max:100',
                    'ContactTitle' => 'max:100',
                    'Address' => 'max:100',
                    'Phone' => 'required|max:24',
                    'Fax' => 'max:24',
                    'Email' => 'required|email'
                );
                $validator = \Validator::make(\Input::all(), $rules);
                if ($validator->fails()) {
                    return \Response::json(array(
                                'error' => array(
                                    'status' => FALSE,
                                    'message' => $validator->errors()->toArray()
                                ), 400));
                } else {
                    $suppliers = \Suppliers::find(\Input::get('id'));
                    $suppliers->CompanyName = trim(\Input::get('CompanyName'));
                    $suppliers->ContactName = trim(\Input::get('ContactName'));
                    $suppliers->ContactTitle = trim(\Input::get('ContactTitle'));
                    $suppliers->Address = trim(\Input::get('Address'));
                    $suppliers->Phone = trim(\Input::get('Phone'));
                    $suppliers->Fax = trim(\Input::get('Fax'));
                    $suppliers->Email = trim(\Input::get('Email'));
                    $suppliers->disabled = (\Input::has('disabled') ? \Input::get('disabled') : 1);
                    $suppliers->save();

                    return \Response::json(array(
                                'error' => array(
                                    'status' => TRUE,
                                    'message' => 'Save data Success.'
                                ), 200));
                }
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

    public function addShipper() {
        if (!\Request::isMethod('post')) {
            $data['page'] = array(
                'title' => 'Add Shipper',
                'view' => 'backend.jshopping.shipper_add'
            );
            return \View::make($data['page']['view'], $data);
        } else {
            try {
                $rules = array(
                    'title' => 'required|max:100'
                );
                $validator = \Validator::make(\Input::all(), $rules);
                if ($validator->fails()) {
                    return \Response::json(array(
                                'error' => array(
                                    'status' => FALSE,
                                    'message' => $validator->errors()->toArray()
                                ), 400));
                } else {
                    $shipper = new \Shipper();
                    $shipper->title = trim(\Input::get('title'));
                    $shipper->desc = trim(\Input::get('desc'));
                    $shipper->contact = trim(\Input::get('contact'));
                    $shipper->address = trim(\Input::get('address'));
                    $shipper->mobile = trim(\Input::get('mobile'));
                    $shipper->fax = trim(\Input::get('fax'));
                    $shipper->email = trim(\Input::get('email'));
                    $shipper->disabled = (\Input::has('disabled') ? \Input::get('disabled') : 1);
                    $shipper->created_user = \Auth::user()->id;
                    $shipper->save();
                    return \Response::json(array(
                                'error' => array(
                                    'status' => TRUE,
                                    'message' => 'Save data Success.'
                                ), 200));
                }
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

    public function editShipper() {
        if (!\Request::isMethod('post')) {
            $data['page'] = array(
                'title' => 'Edit Shipper',
                'view' => 'backend.jshopping.shipper_edit',
                'item' => \Shipper::find(\Input::get('id')),
            );
            return \View::make($data['page']['view'], $data);
        } else {
            try {
                $rules = array(
                    'title' => 'required|max:100'
                );
                $validator = \Validator::make(\Input::all(), $rules);
                if ($validator->fails()) {
                    return \Response::json(array(
                                'error' => array(
                                    'status' => FALSE,
                                    'message' => $validator->errors()->toArray()
                                ), 400));
                } else {
                    $shipper = \Shipper::find(\Input::get('id'));
                    $shipper->title = trim(\Input::get('title'));
                    $shipper->desc = trim(\Input::get('desc'));
                    $shipper->contact = trim(\Input::get('contact'));
                    $shipper->address = trim(\Input::get('address'));
                    $shipper->mobile = trim(\Input::get('mobile'));
                    $shipper->fax = trim(\Input::get('fax'));
                    $shipper->email = trim(\Input::get('email'));
                    $shipper->disabled = (\Input::has('disabled') ? \Input::get('disabled') : 1);
                    $shipper->updated_user = \Auth::user()->id;
                    $shipper->save();

                    return \Response::json(array(
                                'error' => array(
                                    'status' => TRUE,
                                    'message' => 'Save data Success.'
                                ), 200));
                }
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

    public function spec() {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('product')->orderBy('title', 'asc')->get();
        $data['page'] = array(
            'title' => 'Spec',
            'view' => 'backend.jshopping.spec',
            'breadcrumbs' => array(
                'J-Shopping' => 'backend/jshopping',
                'Spec' => '#'
            ),
            'result' => \Categorize::tree($categories)->toArray()
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addSpec() {
        if (!\Request::isMethod('post')) {
            $data['page'] = array(
                'title' => 'Add Spec',
                'view' => 'backend.jshopping.spec_add'
            );
            return \View::make($data['page']['view'], $data);
        } else {
            try {
                $rules = array(
                    'spec1' => 'required|max:255',
                    'spec2' => 'max:255',
                    'spec3' => 'max:255',
                    'spec4' => 'max:255',
                    'spec5' => 'max:255',
                    'spec6' => 'max:255',
                    'spec7' => 'max:255',
                    'spec8' => 'max:255',
                    'spec9' => 'max:255',
                    'spec10' => 'max:255',
                    'spec11' => 'max:255',
                    'spec12' => 'max:255',
                    'spec13' => 'max:255',
                    'spec14' => 'max:255',
                    'spec15' => 'max:255',
                    'spec16' => 'max:255',
                    'spec17' => 'max:255',
                    'spec18' => 'max:255',
                    'spec19' => 'max:255',
                    'spec20' => 'max:255'
                );
                $validator = \Validator::make(\Input::all(), $rules);
                if ($validator->fails()) {
                    return \Response::json(array(
                                'error' => array(
                                    'status' => FALSE,
                                    'message' => $validator->errors()->toArray()
                                ), 400));
                } else {
                    $productspec = new \Productspec();
                    $productspec->categories_id = \Input::get('categories_id');
                    $productspec->spec1 = \Input::get('spec1');
                    $productspec->spec2 = \Input::get('spec2');
                    $productspec->spec3 = \Input::get('spec3');
                    $productspec->spec4 = \Input::get('spec4');
                    $productspec->spec5 = \Input::get('spec5');
                    $productspec->spec6 = \Input::get('spec6');
                    $productspec->spec7 = \Input::get('spec7');
                    $productspec->spec8 = \Input::get('spec8');
                    $productspec->spec9 = \Input::get('spec9');
                    $productspec->spec10 = \Input::get('spec10');
                    $productspec->spec11 = \Input::get('spec11');
                    $productspec->spec12 = \Input::get('spec12');
                    $productspec->spec13 = \Input::get('spec13');
                    $productspec->spec14 = \Input::get('spec14');
                    $productspec->spec15 = \Input::get('spec15');
                    $productspec->spec16 = \Input::get('spec16');
                    $productspec->spec17 = \Input::get('spec17');
                    $productspec->spec18 = \Input::get('spec18');
                    $productspec->spec19 = \Input::get('spec19');
                    $productspec->spec20 = \Input::get('spec20');
                    $productspec->save();
                    return \Response::json(array(
                                'error' => array(
                                    'status' => TRUE,
                                    'message' => 'Save data Success.'
                                ), 200));
                }
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

    public function editSpec() {
        if (!\Request::isMethod('post')) {
            $spec = \Productspec::where('categories_id', \Input::get('id'))->get()->toArray();
            if (!$spec) {
                $data['page'] = array(
                    'title' => 'Add Spec',
                    'view' => 'backend.jshopping.spec_add'
                );
            } else {
                $data['page'] = array(
                    'title' => 'Edit Spec',
                    'view' => 'backend.jshopping.spec_edit',
                    'item' => $spec[0]
                );
            }
            return \View::make($data['page']['view'], $data);
        } else {
            try {
                $rules = array(
                    'spec1' => 'required|max:255',
                    'spec2' => 'max:255',
                    'spec3' => 'max:255',
                    'spec4' => 'max:255',
                    'spec5' => 'max:255',
                    'spec6' => 'max:255',
                    'spec7' => 'max:255',
                    'spec8' => 'max:255',
                    'spec9' => 'max:255',
                    'spec10' => 'max:255',
                    'spec11' => 'max:255',
                    'spec12' => 'max:255',
                    'spec13' => 'max:255',
                    'spec14' => 'max:255',
                    'spec15' => 'max:255',
                    'spec16' => 'max:255',
                    'spec17' => 'max:255',
                    'spec18' => 'max:255',
                    'spec19' => 'max:255',
                    'spec20' => 'max:255'
                );
                $validator = \Validator::make(\Input::all(), $rules);
                if ($validator->fails()) {
                    return \Response::json(array(
                                'error' => array(
                                    'status' => FALSE,
                                    'message' => $validator->errors()->toArray()
                                ), 400));
                } else {

                    if (\Input::get('id')) {
                        $productspec = \Productspec::findMany(\Input::get('id'));
                        $productspec->categories_id = \Input::get('categories_id');
                        $productspec->spec1 = \Input::get('spec1');
                        $productspec->spec2 = \Input::get('spec2');
                        $productspec->spec3 = \Input::get('spec3');
                        $productspec->spec4 = \Input::get('spec4');
                        $productspec->spec5 = \Input::get('spec5');
                        $productspec->spec6 = \Input::get('spec6');
                        $productspec->spec7 = \Input::get('spec7');
                        $productspec->spec8 = \Input::get('spec8');
                        $productspec->spec9 = \Input::get('spec9');
                        $productspec->spec10 = \Input::get('spec10');
                        $productspec->spec11 = \Input::get('spec11');
                        $productspec->spec12 = \Input::get('spec12');
                        $productspec->spec13 = \Input::get('spec13');
                        $productspec->spec14 = \Input::get('spec14');
                        $productspec->spec15 = \Input::get('spec15');
                        $productspec->spec16 = \Input::get('spec16');
                        $productspec->spec17 = \Input::get('spec17');
                        $productspec->spec18 = \Input::get('spec18');
                        $productspec->spec19 = \Input::get('spec19');
                        $productspec->spec20 = \Input::get('spec20');
                        $productspec->save();
                    } else {
                        $productspec = new \Productspec();
                        $productspec->categories_id = \Input::get('categories_id');
                        $productspec->spec1 = \Input::get('spec1');
                        $productspec->spec2 = \Input::get('spec2');
                        $productspec->spec3 = \Input::get('spec3');
                        $productspec->spec4 = \Input::get('spec4');
                        $productspec->spec5 = \Input::get('spec5');
                        $productspec->spec6 = \Input::get('spec6');
                        $productspec->spec7 = \Input::get('spec7');
                        $productspec->spec8 = \Input::get('spec8');
                        $productspec->spec9 = \Input::get('spec9');
                        $productspec->spec10 = \Input::get('spec10');
                        $productspec->spec11 = \Input::get('spec11');
                        $productspec->spec12 = \Input::get('spec12');
                        $productspec->spec13 = \Input::get('spec13');
                        $productspec->spec14 = \Input::get('spec14');
                        $productspec->spec15 = \Input::get('spec15');
                        $productspec->spec16 = \Input::get('spec16');
                        $productspec->spec17 = \Input::get('spec17');
                        $productspec->spec18 = \Input::get('spec18');
                        $productspec->spec19 = \Input::get('spec19');
                        $productspec->spec20 = \Input::get('spec20');
                        $productspec->save();
                    }
                    return \Response::json(array(
                                'error' => array(
                                    'status' => TRUE,
                                    'message' => 'Save data Success.'
                                ), 200));
                }
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

    public function editProductPrice($id) {
        if (!\Request::isMethod('post')) {
            $price = \Products::find($id)->price;

            $data['page'] = array(
                'title' => 'Edit Product Price',
                'view' => 'backend.jshopping.productprice_edit',
                'result' => $price,
                'item' => \Products::find($id)
            );
            return \View::make($data['page']['view'], $data);
        } else {
            try {
                $rules = array(
                    'UnitPrice' => 'required'
                );
                $validator = \Validator::make(\Input::all(), $rules);
                if ($validator->fails()) {
                    return \Response::json(array(
                                'error' => array(
                                    'status' => FALSE,
                                    'message' => $validator->errors()->toArray()
                                ), 400));
                } else {
                    \DB::transaction(function() {
                        $product = \Products::find(\Input::get('product_id'));
                        $product->UnitPrice = \Input::get('UnitPrice');
                        $product->save();
                        $j = 1;
                        for ($i = 0; $i < 10; $i++) {
                            $price = \Productprice::find(\Input::get('price_id.' . $i));
                            $price->price1 = (\Input::has('price1.' . $i) ? \Input::get('price1.' . $i) : 0);
                            $price->price2 = (\Input::has('price2.' . $i) ? \Input::get('price2.' . $i) : 0);
                            $price->active1 = (\Input::get('active1') == $j ? 0 : 1);
                            $price->active2 = (\Input::get('active2') == $j ? 0 : 1);
                            $price->save();
                            $j++;
                        }
                    });

                    return \Response::json(array(
                                'error' => array(
                                    'status' => TRUE,
                                    'message' => 'Save data Success.'
                                ), 200));
                }
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

    public function addProductSpec($id) {
        if (!\Request::isMethod('post')) {
            $prod = \Products::find($id);
            $pc = \DB::table('category_hierarchy')->where('category_id', $prod->CategoryID)->get();
            $rs_productspec = \Productspec::where('categories_id', $pc[0]->category_parent_id)->get();
            $data['page'] = array(
                'title' => 'Add Product Spec',
                'view' => 'backend.jshopping.productspec_add',
                'result' => $rs_productspec,
                'product_id' => $id,
                'productspec_id' => $rs_productspec[0]->id
            );
            return \View::make($data['page']['view'], $data);
        } else {
            try {
                $rules = array(
                    'spec1' => 'required'
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
                        'product_id' => \Input::get('product_id'),
                        'productspec_id' => \Input::get('productspec_id'),
                        'spec1' => trim(\Input::get('spec1')),
                        'spec2' => trim(\Input::get('spec2')),
                        'spec3' => trim(\Input::get('spec3')),
                        'spec4' => trim(\Input::get('spec4')),
                        'spec5' => trim(\Input::get('spec5')),
                        'spec6' => trim(\Input::get('spec6')),
                        'spec7' => trim(\Input::get('spec7')),
                        'spec8' => trim(\Input::get('spec8')),
                        'spec9' => trim(\Input::get('spec9')),
                        'spec10' => trim(\Input::get('spec10')),
                        'spec11' => trim(\Input::get('spec11')),
                        'spec12' => trim(\Input::get('spec12')),
                        'spec13' => trim(\Input::get('spec13')),
                        'spec14' => trim(\Input::get('spec14')),
                        'spec15' => trim(\Input::get('spec15')),
                        'spec16' => trim(\Input::get('spec16')),
                        'spec17' => trim(\Input::get('spec17')),
                        'spec18' => trim(\Input::get('spec18')),
                        'spec19' => trim(\Input::get('spec19')),
                        'spec20' => trim(\Input::get('spec20'))
                    );
                    \Productspecvalue::create($data);
                    return \Response::json(array(
                                'error' => array(
                                    'status' => TRUE,
                                    'message' => 'Save data Success.'
                                ), 200));
                }
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

    public function editProductSpec($id) {
        if (!\Request::isMethod('post')) {
            $prod = \Products::find($id);
            $pc = \DB::table('category_hierarchy')->where('category_id', $prod->CategoryID)->get();
            $rs_productspec = \Productspec::where('categories_id', $pc[0]->category_parent_id)->get();
            $rs_productspecvalue = \Productspecvalue::where('product_id', $id)->get();
            $data['page'] = array(
                'title' => 'Add Product Spec',
                'view' => 'backend.jshopping.productspec_edit',
                'result' => $rs_productspec,
                'item' => $rs_productspecvalue[0],
                'product_id' => $id,
                'productspec_id' => $rs_productspec[0]->id
            );
            return \View::make($data['page']['view'], $data);
        } else {
            try {
                $rules = array(
                    'spec1' => 'required'
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
                        'spec1' => trim(\Input::get('spec1')),
                        'spec2' => trim(\Input::get('spec2')),
                        'spec3' => trim(\Input::get('spec3')),
                        'spec4' => trim(\Input::get('spec4')),
                        'spec5' => trim(\Input::get('spec5')),
                        'spec6' => trim(\Input::get('spec6')),
                        'spec7' => trim(\Input::get('spec7')),
                        'spec8' => trim(\Input::get('spec8')),
                        'spec9' => trim(\Input::get('spec9')),
                        'spec10' => trim(\Input::get('spec10')),
                        'spec11' => trim(\Input::get('spec11')),
                        'spec12' => trim(\Input::get('spec12')),
                        'spec13' => trim(\Input::get('spec13')),
                        'spec14' => trim(\Input::get('spec14')),
                        'spec15' => trim(\Input::get('spec15')),
                        'spec16' => trim(\Input::get('spec16')),
                        'spec17' => trim(\Input::get('spec17')),
                        'spec18' => trim(\Input::get('spec18')),
                        'spec19' => trim(\Input::get('spec19')),
                        'spec20' => trim(\Input::get('spec20'))
                    );
                    \Productspecvalue::where('product_id', \Input::get('product_id'))->update($data);
                    return \Response::json(array(
                                'error' => array(
                                    'status' => TRUE,
                                    'message' => 'Save data Success.'
                                ), 200));
                }
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

    public function gallery($id) {
        if (!\Request::isMethod('post')) {
            $data['page'] = array(
                'title' => 'Product Gallery',
                'view' => 'backend.jshopping.product_gallery',
                'result' => \Productimg::where('ProductID', $id)->get()
            );
            return \View::make($data['page']['view'], $data);
        } else {
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
    }

    public function setting() {
        $data['page'] = array(
            'title' => 'Product Setting',
            'view' => 'backend.jshopping.setting',
            'breadcrumbs' => array(
                'J-Shopping' => 'backend/jshopping',
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
            'title' => \Lang::get('jshopping.orders'),
            'view' => 'backend.jshopping.orders',
            'breadcrumbs' => array(
                'J-Shopping' => 'backend/jshopping',
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
            'view' => 'backend.jshopping.orders_view',
            'breadcrumbs' => array(
                'J-Shopping' => 'backend/jshopping',
                'Orders' => 'backend/jshopping/orders',
                'View' => '#'
            ),
            'item' => $orders,
            'item_detail' => $order_detail,
            'member' => $users
        );
        return \View::make($data['page']['view'], $data);
    }

    public function printOrder($id) {
        $orders = \Shoppingorder::find($id);
        $users = \User::find($orders->user_id);
        $order_detail = \Shoppingorderdetail::where('shopping_order_id', $orders->id)->get();
        $data['page'] = array(
            'title' => 'ตะกร้าสินค้า',
            'view' => 'backend.jshopping.pdf.invoice',
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
            'view' => 'backend.jshopping.payment_view',
            'item' => $transfer[0]
        );
        return \View::make($data['page']['view'], $data);
    }

    public function changeStatus() {
        if (!\Request::isMethod('post')) {
            $data['page'] = array(
                'title' => 'View Payment',
                'view' => 'backend.jshopping.orders_change_status'
            );
            return \View::make($data['page']['view'], $data);
        } else {
            $rules = array(
                'status' => 'required',
                'remark' => 'max:255',
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
                $order->remark = \Input::get('remark');
                $order->disabled = ((\Input::get('status') == 5) || (\Input::get('status') == 8) ? 0 : 1);
                $order->save();

                \Shoppingorderstatuslog::setLog(array('order_id' => \Input::get('order_id'), 'status' => \Input::get('status'), 'updated_user' => \Auth::user()->id));

                //Send mail admin
                $user = \User::find($order->user_id);
                if (\Input::get('status') == 3) {
                    $data2 = array(
                        'fullname' => $user->firstname . ' ' . $user->lastname,
                        'email' => $user->email,
                    );

                    \Mail::send('frontend.jshopping.email.payment_success_customer', $data2, function($message) use ($data2) {
                        $message->to($data2['email'], $data2['fullname'])->subject('ชำระเงินเรียบร้อยแล้ว');
                    });
                } elseif (\Input::get('status') == 5) {
                    \Products::updateStock(\Input::get('order_id'));
                    $data2 = array(
                        'fullname' => $user->firstname . ' ' . $user->lastname,
                        'email' => $user->email,
                    );

                    \Mail::send('frontend.jshopping.email.shipping_success_customer', $data2, function($message) use ($data2) {
                        $message->to($data2['email'], $data2['fullname'])->subject('ส่งสินค้าเรียบร้อยแล้ว');
                    });
                }
                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'message' => 'Save data Success.'
                            ), 200));
            }
        }
    }

############################################################

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

    public function deleteSuppliersSave() {
        try {
            \DB::transaction(function() {
                \Suppliers::find(\Input::get('id'))->delete();
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

    public function deleteShipperSave() {
        try {
            \DB::transaction(function() {
                \Shipper::find(\Input::get('id'))->delete();
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

    public function deleteProductSave() {
        try {
            \DB::transaction(function() {
                \Products::find(\Input::get('id'))->delete();
                \Timeline::where('module', 'jshopping')->where('pk_id', \Input::get('id'))->delete();
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

}
