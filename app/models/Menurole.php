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
class Menurole extends Eloquent {

//put your code here
    protected $table = 'menu_role';
    protected $fillable = array('role_id', 'menu_id', 'created_at', 'updated_at');
    
    
}
