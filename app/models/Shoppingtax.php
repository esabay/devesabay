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
class Shoppingtax extends Eloquent {

    protected $table = 'shopping_tax';
    protected $fillable = array('users_id', 'companyname', 'address', 'taxcode');

    protected function getTaxInformation($id) {
        $users = \DB::table('shopping_tax')
                ->where('users_id', $id)
                ->get();
        if ($users) {
            $tax = $users[0];
            if ($tax->companyname) {
                return '<strong>' . $tax->companyname . '</strong> <br />' . $tax->address . '<br />' . \Lang::get('jshopping.taxcode') . ' : ' . $tax->taxcode;
            } else {
                return \Lang::get('common.no_data');
            }
        } else {
            return \Lang::get('common.no_data');
        }
    }

}
