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
class Projectrequest extends Eloquent {

    protected $table = 'project_req_user';
    protected $fillable = array('project_id', 'code', 'name', 'contact_id', 'required_completion_date', 'description', 'disabled', 'status', 'created_user');

}
