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
class Galleryimg extends Eloquent {

    protected $table = 'galleryimg';
    protected $fillable = array('gallery_id', 'name', 'url', 'cover', 'disabled');

}
