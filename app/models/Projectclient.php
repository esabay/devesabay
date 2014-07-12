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
class Projectclient extends Eloquent {

    protected $table = 'project_client';
    protected $fillable = array('code', 'name','phone','email','address','description','created_user','disabled');

}
