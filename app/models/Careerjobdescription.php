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
class Careerjobdescription extends Eloquent {

    protected $table = 'career_job_description';
    protected $fillable = array('department_id', 'title', 'description', 'status', 'disabled', 'created_user', 'updated_user');

}
