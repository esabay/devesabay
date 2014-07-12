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
class Gallery extends Eloquent {

    protected $table = 'gallery';
    protected $fillable = array('categories_id', 'name', 'shortdetail', 'imgcover', 'frontend', 'created_user', 'updated_user', 'disabled');

}
