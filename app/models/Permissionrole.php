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
class Permissionrole extends Eloquent {

//put your code here
    protected $table = 'permission_role';
    protected $fillable = array('permission_id', 'role_id', 'created_at', 'updated_at');
}
