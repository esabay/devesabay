<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Permission
 *
 * @author R-D-6
 */
class Post extends Eloquent {

//put your code here
    protected $table = 'post';
    protected $fillable = array('id', 'categories_id', 'name', 'shortdetail', 'detail', 'imgcover', 'disabled', 'tagsinput', 'seo_title', 'seo_keyword', 'seo_description', 'startdate', 'stylepage', 'created_user', 'updated_user');

    protected function getDetail($param) {
        $post = \Post::find($param);
        return $post->detail;
    }

}
