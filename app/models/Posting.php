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
class Posting extends Eloquent {

//put your code here
    protected $table = 'posting';
    protected $fillable = array('id', 'categories_id', 'title', 'price', 'description', 'province', 'amphur', 'amphur', 'zipcode', 'mobile', 'tags', 'disabled', 'created_user', 'updated_user');

}
