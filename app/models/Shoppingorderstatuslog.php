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
class Shoppingorderstatuslog extends Eloquent {

    protected $table = 'shopping_order_status_log';
    protected $fillable = array('order_id', 'status', 'created_user', 'updated_user');

    protected function setLog($param = array()) {
        $data2 = array('status' => $param['status']);
        $attributes = array(
            'order_id' => $param['order_id'],
            'created_user' => \Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s')
        );
        $data = array_merge($data2, $attributes);

        \Shoppingorderstatuslog::create($data);
    }

}
