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
class Systemnotifications extends Eloquent {

    protected $table = 'system_notifications';
    protected $fillable = array('pk_id');

    protected function setNotifications($param = array()) {
        if ($param['type'] == 'add') {
            $label = 'label-success';
            $icon = 'icon-plus';
        } elseif ($param['type'] == 'edit') {
            $label = 'label-success';
            $icon = 'icon-edit';
        } elseif ($param['type'] == 'delete') {
            $label = 'label-danger';
            $icon = 'icon-remove';
        } else {
            $label = 'label-warning';
            $icon = 'icon-bell';
        }

        if ($param['module'] == 'jshopping') {
            $roles = 'Dealer';
        } elseif ($param['module'] == 'post') {
            $roles = 'Content';
        } else {
            $roles = NULL;
        }
        $attributes = array(
            'user_id' => \Auth::user()->id,
            'module' => $param['module'],
            'role_txt' => $roles,
            'label' => $label,
            'icon' => $icon,
        );
        $data = array_merge($param, $attributes);
        Systemnotifications::create($data);
    }

}
