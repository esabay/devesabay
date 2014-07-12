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
class Shoppingorderpayment extends Eloquent {

    protected $table = 'shopping_order_payment';
    protected $fillable = array('order_id', 'type', 'credit_name', 'credit_number', 'credit_exp_m', 'credit_exp_y', 'credit_valid');

}
