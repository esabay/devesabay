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
class Postingimg extends Eloquent {

    protected $table = 'postingimg';
    protected $fillable = array('posting_id', 'title', 'path', 'disabled');

}
