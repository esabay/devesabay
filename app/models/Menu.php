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
class Menu extends Eloquent {

//put your code here
    protected $table = 'menu';
    protected $fillable = array('id', 'sub_id', 'name', 'url');
}
