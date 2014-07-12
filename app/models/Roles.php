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
class Roles extends Eloquent {

//put your code here
    protected $table = 'roles';
    protected $fillable = array('id', 'name', 'description','level','created_at','updated_at');

}
