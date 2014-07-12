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
class Project extends Eloquent {

    protected $table = 'project_project';
    protected $fillable = array('category_id', 'client_id', 'assigned', 'code', 'name', 'progress', 'startdate', 'deadline', 'phases', 'description', 'created_user', 'disabled');

}
