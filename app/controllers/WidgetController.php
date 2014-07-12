<?php

class WidgetController extends \BaseController {
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

###################### Widget

    public function widget($v) {
        if ($v == 'flexslider') {
            $data['page'] = array(
                'view' => 'frontend.widget.flexslider'
            );
            return \View::make($data['page']['view']);
        }

        if ($v == 'featured_product') {
            $data['page'] = array(
                'view' => 'frontend.widget.featured_product',
                'result_featured_product' => \DB::table('products')
                        ->where('disabled', 0)
                        ->where('featured', 0)
                        ->orderBy('ProductID', 'desc')
                        ->take(4)
                        ->get()
            );
            return \View::make($data['page']['view'], $data);
        }

        if ($v == 'show_product') {
            $data['page'] = array(
                'view' => 'frontend.widget.show_product',
                'result_last_product' => \DB::table('products')
                        ->where('disabled', 0)
                        ->orderBy('ProductID', 'desc')
                        ->take(12)
                        ->get(),
                'result_spacial_product' => \DB::table('products')
                        ->where('disabled', 0)
                        ->where('special', 0)
                        ->orderBy('created_at', 'desc')
                        ->take(12)
                        ->get(),
                'result_popular_product' => \DB::table('products')
                        ->where('disabled', 0)
                        ->where('view', '>', 0)
                        ->orderBy('view', 'desc')
                        ->take(12)
                        ->get()
            );
            return \View::make($data['page']['view'], $data);
        }

        if ($v == 'headercart') {
            $data['page'] = array(
                'view' => 'frontend.widget.header_cart'
            );
            return \View::make($data['page']['view']);
        }

        if ($v == 'small_banner') {
            $data['page'] = array(
                'view' => 'frontend.widget.small_banner'
            );
            return \View::make($data['page']['view']);
        }

        if ($v == 'brands_list') {
            $data['page'] = array(
                'view' => 'frontend.widget.brands_list'
            );
            return \View::make($data['page']['view']);
        }

        if ($v == 'related_product') {
            $rs = \Products::find(\Input::segment(3));
            if ($rs->related) {
                $exp_rs = explode(',', $rs->related);
            } else {
                $exp_rs = array();
            }
            $data['page'] = array(
                'view' => 'frontend.widget.related_product',
                'result_related_product' => $exp_rs
            );
            return \View::make($data['page']['view'], $data);
        }

        if ($v == 'recommended_product') {
            $rs = \Products::find(\Input::segment(3));
            if ($rs->recommended) {
                $exp_rs = explode(',', $rs->recommended);
            } else {
                $exp_rs = array();
            }
            $data['page'] = array(
                'view' => 'frontend.widget.recommended_product',
                'result_recommended_product' => $exp_rs
            );
            return \View::make($data['page']['view'], $data);
        }

        if ($v == 'last_product') {
            $sid = \Session::all();
            $data['page'] = array(
                'view' => 'frontend.widget.last_product',
                'result_last_product' => \DB::table('products')
                        ->join('productrelated', 'productrelated.product_id', '=', 'products.ProductID')
                        ->where('productrelated._token', $sid['_token'])
                        ->orderBy('productrelated.created_at', 'desc')
                        ->take(6)
                        ->get()
            );
            return \View::make($data['page']['view'], $data);
        }

        if ($v == 'news_gallery') {
            $data['page'] = array(
                'view' => 'frontend.widget.news_gallery'
            );
            return \View::make($data['page']['view']);
        }

        if ($v == 'timeline') {
            $data['page'] = array(
                'view' => 'backend.widget.timeline',
                'result' => \DB::table('timeline')
                        ->take(10)
                        ->orderBy('id', 'desc')
                        ->get()
            );
            return \View::make($data['page']['view'], $data);
        }

        if ($v == 'dashboard_news') {
            $data['page'] = array(
                'view' => 'backend.widget.dashboard_news',
                'result' => \DB::table('post')
                        ->where('categories_id', 431)
                        ->where('disabled', 0)
                        ->take(5)
                        ->orderBy('id', 'desc')
                        ->get()
            );
            return \View::make($data['page']['view'], $data);
        }

        if ($v == 'state_neworder') {
            $data['page'] = array(
                'view' => 'backend.widget.block_state_neworder',
                'count' => \Shoppingorder::where('status', 1)
                        ->where('disabled', 1)->count()
            );
            return \View::make($data['page']['view'], $data);
        }

        if ($v == 'state_newuser') {
            $data['page'] = array(
                'view' => 'backend.widget.block_state_newuser',
                'count' => \DB::select('SELECT count(id) as c_user FROM users WHERE DATE_FORMAT( created_at, "%Y-%m" ) = "' . date("Y-m") . '"')
            );
            return \View::make($data['page']['view'], $data);
        }

        if ($v == 'state_sale') {
            $data['page'] = array(
                'view' => 'backend.widget.block_state_sale',
                'count' => \Shoppingorder::where('status', 5)
                        ->where('disabled', 0)->count()
            );
            return \View::make($data['page']['view'], $data);
        }

        if ($v == 'state_totalprofit') {
            $data['page'] = array(
                'view' => 'backend.widget.block_state_totalprofit',
                'sum' => \Shoppingorder::where('status', 5)
                        ->where('disabled', 0)->sum('sum_price')
            );
            return \View::make($data['page']['view'], $data);
        }

        if ($v == 'notification_dd') {
            $notic = \DB::table('system_notifications')
                    ->where('read', 1)
                    ->orWhere('read', 0);
            $notic_count = \DB::table('system_notifications')
                    ->where('read', 1);
            if (\Auth::user()->is('Sale Order Online')) {
                $notic = $notic->where('role_txt', 'Sale Order Online');
                $notic_count = $notic_count->where('role_txt', 'Sale Order Online');
            } elseif (\Auth::user()->is('Content')) {
                $notic = $notic->where('role_txt', 'Content');
                $notic_count = $notic_count->where('role_txt', 'Content');
            } else {
                $notic = $notic->where('role_txt', NULL);
                $notic_count = $notic_count->where('role_txt', NULL);
            }
            $notic = $notic->take(8)
                    ->orderBy('id', 'desc')
                    ->get();
            $notic_count = $notic_count->count();
            $data['page'] = array(
                'view' => 'backend.widget.notification_dropdown',
                'count' => $notic_count,
                'result' => $notic
            );
            return \View::make($data['page']['view'], $data);
        }
    }

}
