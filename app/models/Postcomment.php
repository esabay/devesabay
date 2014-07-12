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
class Postcomment extends Eloquent {

//put your code here
    protected $table = 'postcomment';
    protected $fillable = array('id', 'post_id', 'created_user', 'name', 'email', 'message', 'disabled');

    protected function getUsername($id) {
        $postcomment = \Postcomment::find($id);
        if ($postcomment->name) {
            $str = $postcomment->name;
        } elseif ($postcomment->created_user) {
            $str = User::getUsername($postcomment->created_user);
        } else {
            $str = 'Guest';
        }

        return $str;
    }

}
