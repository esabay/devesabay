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
class Productcomment extends Eloquent {

//put your code here
    protected $table = 'productcomment';
    protected $fillable = array('id', 'product_id', 'created_user', 'name', 'message', 'disabled');

    protected function getUsername($id) {
        $productcomment = \Productcomment::find($id);
        if ($productcomment->name) {
            $str = $productcomment->name;
        } elseif ($productcomment->created_user) {
            $str = User::getUsername($productcomment->created_user);
        } else {
            $str = 'Guest';
        }

        return $str;
    }

}
