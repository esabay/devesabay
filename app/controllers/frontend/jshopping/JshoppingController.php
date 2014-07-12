<?php

namespace App\Controllers\Frontend;

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
        if (\Input::get('search')) {
            $products = \Products::orderBy('ProductID', 'desc');
            if (\Input::has('s_ProductName')) {
                $products = $products->where('ProductName', 'LIKE', '%' . trim(\Input::get('s_ProductName')) . '%');
            }
            if (\Input::has('cat1')) {
                $products = $products->where('sub1', trim(\Input::get('cat1')));
            }
            if (\Input::has('cat2')) {
                $products = $products->where('sub2', trim(\Input::get('cat2')));
            }
            if (\Input::has('s_ProductCode')) {
                $products = $products->where('ProductCode', 'LIKE', '%' . trim(\Input::get('s_ProductCode')) . '%');
            }
            $rs = $products->where('disabled', 0)->paginate(20);
        } else {
            $rs = \DB::table('products')
                    ->where('disabled', 0)
                    ->orderBy('ProductID', 'desc')
                    ->paginate(20);
        }
        $categories = \Categorize::getCategoryProvider()->root()->whereType('product')->get();
        $ct = \Categorize::tree($categories);
        $arr_cat = array();
        foreach ($ct as $val) {
            $arr_cat[$val->id] = $val->title;
        }
        $data['page'] = array(
            'title' => 'ตะกร้าสินค้า',
            'result' => $rs,
            'category' => $arr_cat,
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list')
        );
        return \View::make('frontend.jshopping.index1', $data);
    }

    public function category($id) {
        $categories = \Categorize::getCategoryProvider()->root()->whereType('product')->orderBy('title', 'asc')->get();
        $parent = \Categorize::getCategoryProvider()->findById($id);
        $cat = \DB::table('category_hierarchy')->where('category_id', $id)->get();
        $cat_name = \Categories::find($cat[0]->category_parent_id);
        $data['page'] = array(
            'title' => $parent->title,
            'description' => $parent->description,
            'view' => 'frontend.jshopping.category',
            'result' => \DB::table('products')->where('CategoryID', $id)
                    ->where('disabled', 0)
                    ->orderBy('ProductID', 'desc')
                    ->paginate(15),
            'result_category' => \Categorize::tree($categories)->toArray(),
            'cat_parent' => $cat_name->title,
            'cat_active' => $cat[0]->category_parent_id,
            'cat_sub_active' => $id,
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list'),
            'show_product' => \App::make('WidgetController')->widget('last_product')
        );
        return \View::make($data['page']['view'], $data);
    }

    public function itemProduct($id) {
        $prod = \Products::find($id);
        $prod->view = $prod->view + 1;
        $prod->save();
        \Productrelated::related($id);

        $parent = \Categorize::getCategoryProvider()->findById($prod->CategoryID);
        $cat = \DB::table('category_hierarchy')->where('category_id', $prod->CategoryID)->get();
        $cat_name = \Categories::find($cat[0]->category_parent_id);
        $prod2 = \Products::find($id);
        $pc = \DB::table('category_hierarchy')->where('category_id', $prod2->CategoryID)->get();
        $rs_productspec = \Productspec::where('categories_id', $pc[0]->category_parent_id)->get();
        $rs_productspecvalue = \Productspecvalue::where('product_id', $id)->get();

        $data['page'] = array(
            'title' => $parent->title,
            'description' => $parent->description,
            'cat_parent' => $cat_name->title,
            'cat_id' => $cat[0]->category_id,
            'view' => 'frontend.jshopping.item',
            'item' => \Products::find($id),
            'comment_result' => \Productcomment::where('product_id', $id)
                    ->where('disabled', 0)
                    ->get(),
            'comment_num' => \Productcomment::where('product_id', $id)
                    ->where('disabled', 0)
                    ->count(),
            'gallery' => \Productimg::where('ProductID', $id)->get(),
            'productspec_result' => $rs_productspec,
            'productspecvalue_item' => $rs_productspecvalue[0],
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list'),
            'show_product' => \App::make('WidgetController')->widget('last_product'),
            'related_product' => \App::make('WidgetController')->widget('related_product'),
            'recommended_product' => \App::make('WidgetController')->widget('recommended_product'),
            'seo' => $this->getSEO($id)
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addCart() {
        $prod = \Products::find(\Input::get('id'));
        $items = array(
            'id' => $prod->ProductID,
            'name' => $prod->ProductName,
            'price' => \Products::getPrice($prod->ProductID), //($prod->SalePrice > 0 ? $prod->SalePrice : $prod->UnitPrice),
            'quantity' => (\Input::get('qty') ? \Input::get('qty') : 1),
            'tag' => 0
        );
        \Cart::insert($items);
        return \Response::json(array(
                    'error' => array(
                        'status' => TRUE,
                        'message' => array('เพิ่มรายการสินค้าลงตะกร้าเรียบร้อยแล้ว'),
                    ), 200));
    }

    public function deleteCart() {
        $prod = \Products::find(\Input::get('id'));
        $items = array(
            'id' => $prod->ProductID,
            'name' => $prod->ProductName,
            'price' => ($prod->SalePrice > 0 ? $prod->SalePrice : $prod->UnitPrice),
            'quantity' => 1
        );
        $in = \Cart::insert($items);
        $item = \Cart::item($in);
        $item->remove();
        return \Response::json(array(
                    'error' => array(
                        'status' => TRUE,
                        'message' => array('ลบรายการสินค้าออกจากตะกร้าเรียบร้อยแล้ว'),
                    ), 200));
    }

    public function updateCart() {
        $qty = \Input::get('qty');
        $i = 0;
        foreach (\Input::get('prod_id') as $val) {
            $prod = \Products::find($val);
            $items = array(
                'id' => $prod->ProductID,
                'name' => $prod->ProductName,
                'price' => \Products::getPrice($prod->ProductID),
                'quantity' => $qty[$i],
                'tax' => 0
            );

            $content = \Cart::insert($items);
            $item = \Cart::item($content);
            $item->name = $prod->ProductName;
            $item->quantity = $qty[$i];
            $i++;
        }
        return \Response::json(array(
                    'error' => array(
                        'status' => TRUE,
                        'message' => array('แก้ไขจำนวนสั่งซื้อสินค้าเรียบร้อยแล้ว.'),
                    ), 200));
    }

    public function viewCart() {
        $data['page'] = array(
            'title' => 'ตะกร้าสินค้า',
            'view' => 'frontend.jshopping.cart',
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list'),
            'show_product' => \App::make('WidgetController')->widget('last_product')
        );
        return \View::make($data['page']['view'], $data);
    }

    public function viewOrder($id) {
        $orders = \Shoppingorder::find($id);
        $users = \User::find($orders->user_id);
        $order_detail = \Shoppingorderdetail::where('shopping_order_id', $orders->id)->get();
        $data['page'] = array(
            'title' => 'ตะกร้าสินค้า',
            'view' => 'frontend.jshopping.orders_view',
            'item' => $orders,
            'item_detail' => $order_detail,
            'member' => $users,
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list')
        );
        return \View::make($data['page']['view'], $data);
    }

    public function printOrder($id) {
        $orders = \Shoppingorder::find($id);
        $users = \User::find($orders->user_id);
        $order_detail = \Shoppingorderdetail::where('shopping_order_id', $orders->id)->get();
        $data['page'] = array(
            'title' => 'ตะกร้าสินค้า',
            'view' => 'frontend.jshopping.pdf.invoice',
            'item' => $orders,
            'item_detail' => $order_detail,
            'member' => $users
        );
        return \View::make($data['page']['view'], $data);
    }

    public function viewCartUpdate() {
        $data['page'] = array(
            'title' => 'ตะกร้าสินค้า',
            'view' => 'frontend.jshopping.cart'
        );
        return \View::make($data['page']['view'], $data);
    }

    public function checkout() {
        $data['page'] = array(
            'title' => 'Checkout',
            'view' => 'frontend.jshopping.checkout',
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list'),
            'show_product' => \App::make('WidgetController')->widget('last_product')
        );
        return \View::make($data['page']['view'], $data);
    }

    function history() {

        $data['page'] = array(
            'title' => 'ประวัติการสั่งซื้อ',
            'result' => \Shoppingorder::where('user_id', \Auth::user()->id)->orderBy('id', 'desc')->paginate(20),
            'view' => 'frontend.jshopping.shopping_history',
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list')
        );
        return \View::make($data['page']['view'], $data);
    }

    public function addPayment($code) {
        $order = \Shoppingorder::where('code', $code)->get();
        $data['page'] = array(
            'title' => 'แจ้งชำระเงิน',
            'code' => $code,
            'id' => $order[0]->id,
            'total' => $order[0]->sum_price,
            'view' => 'frontend.jshopping.payment_add'
        );
        return \View::make($data['page']['view'], $data);
    }

    ##################

    public function confirm() {
        try {

            $user = \User::find(\Auth::user()->id);
            if ($user->address != NULL) {
                $dt = \Carbon::now();
                $max = \Shoppingorder::max('id');
                if ($max) {
                    $c = $max + 1;
                    $code = date('ym') . str_pad($c, 6, "0", STR_PAD_LEFT);
                } else {
                    $code = date('ym') . str_pad(1, 6, "0", STR_PAD_LEFT);
                }

                $shoppingorder = new \Shoppingorder();
                $shoppingorder->code = $code;
                $shoppingorder->user_id = \Auth::user()->id;
                $shoppingorder->shipping_id = \Input::get('shipping_option');
                $shoppingorder->shipper_id = \Input::get('shipper_id');
                $shoppingorder->shipping_option_id = \Input::get('shipping_option_id');
                $shoppingorder->payment_id = \Input::get('payment_option');
                $shoppingorder->tax_option = (\Input::has('tax_option') ? \Input::get('tax_option') : 1);
                $shoppingorder->price_before_vat = \Cart::total() / 1.07;
                $shoppingorder->total_price = \Cart::total();
                $shoppingorder->sum_price = \Cart::total();
                $shoppingorder->order_expire = $dt->addDays(3)->toDateString();
                $shoppingorder->created_user = \Auth::user()->id;
                $shoppingorder->save();
                $order_id = $shoppingorder->id;

                \Shoppingorderstatuslog::setLog(array('order_id' => $order_id, 'status' => 1));

                $shoppingorderpayment = new \Shoppingorderpayment();
                $shoppingorderpayment->order_id = $order_id;
                $shoppingorderpayment->type = \Input::get('payment_option');
                $shoppingorderpayment->credit_name = \Input::get('credit_name');
                $shoppingorderpayment->credit_number = \Input::get('credit_number');
                $shoppingorderpayment->credit_exp_m = \Input::get('credit_exp_m');
                $shoppingorderpayment->credit_exp_y = \Input::get('credit_exp_y');
                $shoppingorderpayment->credit_valid = \Input::get('credit_valid');
                $shoppingorderpayment->save();

                foreach (\Cart::contents() as $value) {
                    $Shoppingorderdetail = new \Shoppingorderdetail();
                    $Shoppingorderdetail->shopping_order_id = $order_id;
                    $Shoppingorderdetail->product_id = $value->id;
                    $Shoppingorderdetail->qty = $value->quantity;
                    $Shoppingorderdetail->price = $value->price;
                    $Shoppingorderdetail->price_before_vat = $value->price / 1.07;
                    $Shoppingorderdetail->price_after_vat = $value->price;
                    $Shoppingorderdetail->save();
                }

                $systemnotifications = new \Systemnotifications();
                $systemnotifications->pk_id = $order_id;
                $systemnotifications->title = \Lang::get('jshopping.notified_new_order');
                $systemnotifications->url = 'backend/jshopping/orders/view/' . $order_id . '';
                $systemnotifications->module = 'jshopping';
                $systemnotifications->type = 'add';
                $systemnotifications->save();

                \Cart::destroy();

                // Send notification to Pusher
                $message = "มีรายการสั่งซื้อใหม่จากลูกค้า รหัสสั่งซื้อ " . $code . " กรุณาตรวจสอบ";
                \Pusherer::trigger('test_channel', 'my_event', array('message' => $message));

                //Send mail admin
                $luser = \DB::table('role_user')
                        ->join('users', 'role_user.user_id', '=', 'users.id')
                        ->where('users.disabled', 0)
                        ->where('role_user.role_id', 26)
                        ->get();
                foreach ($luser as $item) {
                    $data = array(
                        'fullname' => $item->firstname . ' ' . $item->lastname,
                        'email' => $item->email,
                        'link' => link_to('backend/jshopping/orders/view/' . $order_id . '', 'แสดงรายการสั่งซื้อใหม่')
                    );

                    \Mail::queue('frontend.jshopping.email.news_order_cp', $data, function($message) use ($data) {
                        $message->to($data['email'], $data['fullname'])->subject('มีรายการสั่งซื้อมาใหม่');
                    });
                }
                //Send mail customer
                $order = \Shoppingorder::find($order_id);
                $data2 = array(
                    'fullname' => \Auth::user()->firstname . ' ' . \Auth::user()->lastname,
                    'email' => \Auth::user()->email,
                    'link' => link_to('shopping/orders/view/' . $order_id . '', 'แสดงรายการสั่งซื้อ'),
                    'create_date' => $order->created_at,
                    'order_id' => $order->code,
                    'payment_medthod' => \Shoppingorder::getPaymentMedthod($order->payment_id),
                    'total' => $order->total_price,
                    'order_expire' => $order->order_expire,
                );

                \Mail::send('frontend.jshopping.email.news_order_customer', $data2, function($message) use ($data2) {
                    $message->to($data2['email'], $data2['fullname'])->subject('Customer Invoice');
                });

                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'message' => \Lang::get('theme_preciso.msg_confirm_checkout_success')
                            ), 200));
            } else {
                return \Response::json(array(
                            'error' => array(
                                'status' => FALSE,
                                'message' => \Lang::get('กรุณากรอกที่อยู่ เพื่อการจัดส่งสินค้าที่รวดเร็ว')
                            ), 400));
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function cancelOrder() {
        try {
            $order = \Shoppingorder::find(\Input::get('id'));
            $order->status = 6;
            $order->updated_user = \Auth::user()->id;
            $order->save();

            $message = "ลูกค้ายกเลิกรายการสั่งซื้อ " . $order->code;
            \Pusherer::trigger('test_channel', 'my_event', array('message' => $message));
            return \Response::json(array(
                        'error' => array(
                            'status' => TRUE,
                            'message' => 'ยกเลิกรายการสั่งซื้อเสร็จสมบูรณ์<br /> ลูกค้าสามารถเลือกซื้อสินค้าใหม่ได้ที่หน้าเว็บ ขอบคุณค่ะ'
                        ), 200));
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function commentSave() {
        $rules = array(
            'name' => 'required|min:3|max:30',
            'message' => 'required|min:5|max:255'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'form' => 'frmRegister',
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            try {
                $data = array(
                    'product_id' => \Input::get('product_id'),
                    'created_user' => (\Auth::check() == TRUE ? \Auth::user()->id : NULL),
                    'name' => \Input::get('name'),
                    'message' => \Input::get('message')
                );
                \Productcomment::create($data);
                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'message' => 'Save comment Success.'
                            ), 200));
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

    public function wishlist() {
        try {
            $count = \Productwishlist::where('user_id', \Auth::user()->id)
                            ->where('product_id', \Input::get('id'))->count();
            if ($count <= 0) {
                $data = array(
                    'user_id' => \Auth::user()->id,
                    'product_id' => \Input::get('id')
                );
                \Productwishlist::create($data);
                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'message' => array('เพิ่มสินค้าที่ชอบสำเร็จ.'),
                            ), 200));
            } else {
                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'message' => array('สินค้านี้มีอยู่แล้วในรายการสินค้าที่ชอบ.'),
                            ), 400));
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getSEO($id) {
        $prod = \Products::find($id);
        $data = array(
            'title' => ($prod->seo_title ? $prod->seo_title : $prod->ProductName), //$post->seo_title,
            'description' => $prod->seo_description,
            'keywords' => $prod->seo_keyword
        );
        return $data;
    }

    public function addPaymentSave() {
        $file = \Input::file('transfer_slip');
        $rules = array(
            'transfer_name' => 'required',
            'transfer_total' => 'required',
            'transfer_date' => 'required|date',
            'transfer_time' => 'required',
            'transfer_in_bank' => 'required',
            'transfer_bank_branch' => 'required',
            'transfer_slip' => 'image'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'form' => 'form-add',
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            try {

                $transfer = new \Shoppingtransfer();
                $transfer->order_id = \Input::get('order_id');
                $transfer->transfer_name = trim(\Input::get('transfer_name'));
                $transfer->transfer_total = trim(\Input::get('transfer_total'));
                $transfer->transfer_date = trim(\Input::get('transfer_date'));
                $transfer->transfer_time = trim(\Input::get('transfer_time'));
                $transfer->transfer_in_bank = trim(\Input::get('transfer_in_bank'));
                $transfer->transfer_out_bank = trim(\Input::get('transfer_out_bank'));
                $transfer->transfer_bank_branch = trim(\Input::get('transfer_bank_branch'));
                $transfer->transfer_remark = trim(\Input::get('transfer_remark'));
                $transfer->save();
                $transfer_id = $transfer->id;

                $order = \Shoppingorder::find(\Input::get('order_id'));
                $order->status = 2;
                $order->save();
                \Shoppingorderstatuslog::setLog(array('order_id' => \Input::get('order_id'), 'status' => 2));

                if ($file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = str_random(40) . '.' . $extension;
                    $destinationPath = 'uploads/shopping/slip/';
                    \Input::file('transfer_slip')->move($destinationPath, $filename);
                    $fname = $destinationPath . $filename;
                    \Shoppingtransfer::where('id', $transfer_id)->update(array('transfer_slip' => $fname));
                }

                $data4 = array(
                    'pk_id' => \Input::get('order_id'),
                    'title' => \Lang::get('jshopping.notified_transfer'),
                    'url' => 'backend/jshopping/orders/view/' . \Input::get('order_id') . '',
                    'module' => 'jshopping',
                    'type' => 'add',
                );
                \Systemnotifications::setNotifications($data4);

                // Send notification to Pusher
                $message = "มีรายการชำระเงินจากลูกค้า รหัสสั่งซื้อ " . $order->code . " กรุณาตรวจสอบ";
                \Pusherer::trigger('test_channel', 'my_event', array('message' => $message));

                //Send mail admin
                $luser = \DB::table('role_user')
                        ->join('users', 'role_user.user_id', '=', 'users.id')
                        ->where('users.disabled', 0)
                        ->where('role_user.role_id', 26)
                        ->get();
                foreach ($luser as $item) {
                    $data = array(
                        'fullname' => $item->firstname . ' ' . $item->lastname,
                        'email' => $item->email,
                        'link' => link_to('backend/jshopping/orders/view/' . \Input::get('order_id') . '', 'แสดงรายการสั่งซื้อ')
                    );

                    \Mail::queue('frontend.jshopping.email.payment_order_cp', $data, function($message) use ($data) {
                        $message->to($data['email'], $data['fullname'])->subject('มีรายการแจ้งชำระเงินจากลูกค้า');
                    });
                }

                return \Response::json(array(
                            'error' => array(
                                'status' => TRUE,
                                'message' => \Lang::get('jshopping.notified_order_confirm_success')
                            ), 200));
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

}
