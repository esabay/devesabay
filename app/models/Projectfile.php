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
class Projectfile extends Eloquent {

    protected $table = 'project_file';
    protected $fillable = array('project_req_id', 'name', 'url', 'disabled', 'created_user');

}
