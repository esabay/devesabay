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
class Postimg extends Eloquent {

    protected $table = 'postimg';
    protected $fillable = array('post_id', 'name', 'title', 'url', 'disabled');

}
