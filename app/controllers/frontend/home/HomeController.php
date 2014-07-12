<?php

namespace App\Controllers\Frontend;

class HomeController extends \BaseController {
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
            'title' => 'Pages',
            'view' => 'frontend.home.index',
            'content' => \App::make('WidgetController')->widget('flexslider'),
            //'featured_product' => \App::make('WidgetController')->widget('featured_product'),
            'show_product' => \App::make('WidgetController')->widget('show_product'),
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list')
        );
        return \View::make($data['page']['view'], $data);
    }

}
