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
class Shoppingorderstatus extends Eloquent {

    protected $table = 'shopping_order_status';
    protected $fillable = array('name', 'title', 'title2', 'disabled');

    protected function getStatus($param) {
        $status = Shoppingorderstatus::find($param);
        $str = $status->title;
        return $str;
    }

    protected function getStatusCp($param) {
        $status = Shoppingorderstatus::find($param);

        if ($param == 1) {
            $rs = 'label-warning';
        } elseif ($param == 2) {
            $rs = 'label-info';
        } elseif ($param == 3) {
            $rs = 'label-primary';
        } elseif ($param == 4) {
            $rs = 'label-primary';
        } elseif ($param == 5) {
            $rs = 'label-primary';
        } elseif ($param == 6) {
            $rs = 'label-inverse';
        } elseif ($param == 7) {
            $rs = 'label-default';
        } elseif ($param == 8) {
            $rs = 'label-success';
        } else {
            $rs = 'label-warning';
        }

        $str = '<span class="label ' . $rs . '">' . $status->title2 . '</span>';
        return $str;
    }

}
