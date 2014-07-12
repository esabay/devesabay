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
class Systemconfigwebsite extends Eloquent {

    protected $table = 'system_config_website';
    protected $fillable = array('user_id', 'site_name', 'site_offline', 'offline_message', 'keywords', 'description', 'driver', 'host', 'port', 'from_address', 'form_name', 'username', 'password', 'disabled', 'created_user', 'updated_user');

    protected function getMeta($param = array()) {

        $us = 1;

        $sfw = \Systemconfigwebsite::find($us);
        if (isset($param['keywords']) == 1) {
            $rs = $sfw->keywords;
        }
        if (isset($param['description']) == 1) {
            $rs = $sfw->description;
        }
        if (isset($param['site_name']) == 1) {
            $rs = $sfw->site_name;
        }
        return $rs;
    }

}
