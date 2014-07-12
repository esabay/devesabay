<?php

namespace App\Controllers\Frontend;

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
        $g = \Gallery::where('frontend', 0)
                ->where('disabled', 0)
                ->orderBy('id', 'desc')
                ->paginate(12);
        $data['page'] = array(
            'title' => 'Gallery',
            'view' => 'frontend.jgallery.index',
            'result' => $g,
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list')
        );
        return \View::make($data['page']['view'], $data);
    }

    public function viewGallery($id) {
        $gall = \Gallery::find($id);
        $Galleryimg = \Galleryimg::where('gallery_id', $id)->get();
        $data['page'] = array(
            'title' => $gall->name,
            'shortdetail' => $gall->shortdetail,
            'view' => 'frontend.jgallery.view',
            'result' => $Galleryimg,
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list')
        );
        return \View::make($data['page']['view'], $data);
    }

}
