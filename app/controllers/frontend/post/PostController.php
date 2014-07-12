<?php

namespace App\Controllers\Frontend;

class PostController extends \BaseController {
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
        $categories = \Categorize::getCategoryProvider()
                ->root()
                ->whereType('post')
                ->orderBy('title', 'asc')
                ->get();
        $data['page'] = array(
            'title' => 'Post',
            'view' => 'frontend.post.index',
            'result' => \DB::table('post')
                    ->join('categories', 'categories.id', '=', 'post.categories_id')
                    ->select('post.id', 'post.name', 'post.shortdetail', 'post.imgcover', 'categories.title as groupname', 'post.disabled', 'post.created_at', 'post.updated_at', 'post.created_user')
                    ->where('frontend', 0)
                    ->orderBy('id', 'desc')
                    ->take(5)
                    ->paginate(4),
            'result_category' => \Categorize::tree($categories)->toArray(),
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list')
        );
        return \View::make($data['page']['view'], $data);
    }

    public function viewPost($id) {
        $categories = \Categorize::getCategoryProvider()
                ->root()
                ->whereType('post')
                ->orderBy('title', 'asc')
                ->get();
        $rs = \DB::table('post')
                ->join('categories', 'categories.id', '=', 'post.categories_id')
                ->where('post.id', $id)
                ->select('post.id', 'post.name', 'post.detail', 'post.detail', 'post.stylepage', 'categories.title as groupname', 'post.disabled', 'post.created_at', 'post.updated_at', 'post.created_user')
                ->get();
        $sytlepage = ($rs[0]->stylepage == 0 ? 'frontend.post.view_full' : 'frontend.post.view');
        $data['page'] = array(
            'view' => $sytlepage,
            'breadcrumbs' => array(
                'Dashboard' => 'backend',
                'Post' => 'backend/post',
                '' . $rs[0]->name . '' => '#'
            ),
            'item' => $rs[0],
            'result_category' => \Categorize::tree($categories)->toArray(),
            'small_banner' => \App::make('WidgetController')->widget('small_banner'),
            'brands_list' => \App::make('WidgetController')->widget('brands_list'),
            'seo' => $this->getSEO($id)
        );
        return \View::make($data['page']['view'], $data);
    }

    public function getSEO($id) {
        $post = \Post::find($id);
        $data = array(
            'title' => ($post->seo_title ? $post->seo_title : $post->name), //$post->seo_title,
            'description' => $post->seo_description,
            'keywords' => $post->seo_keyword
        );
        return $data;
    }

    public function commentSave() {
        $rules = array(
            'name' => 'required|min:3|max:30',
            'email' => 'email',
            'message' => 'required|min:5|max:255'
        );
        $validator = \Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {
            return \Response::json(array(
                        'error' => array(
                            'status' => FALSE,
                            'form' => 'submit-comment',
                            'message' => $validator->errors()->toArray()
                        ), 400));
        } else {
            try {
                $data = array(
                    'post_id' => \Input::get('post_id'),
                    'created_user' => (\Auth::check() == TRUE ? \Auth::user()->id : NULL),
                    'name' => \Input::get('name'),
                    'email' => \Input::get('email'),
                    'message' => \Input::get('message')
                );
                \post::create($data);
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

}
