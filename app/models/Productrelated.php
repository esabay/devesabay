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
class Productrelated extends Eloquent {

    protected $table = 'productrelated';
    protected $fillable = array('product_id', '_token');

    protected function related($id) {
        $sid = \Session::all();
        $pc = \Productrelated::where('product_id', $id)->where('_token', $sid['_token'])->count();
        if ($pc <= 0) {
            \Productrelated::create(array('product_id' => $id, '_token' => $sid['_token']));
        }
    }

}
