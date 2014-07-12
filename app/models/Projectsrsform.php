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
class Projectsrsform extends Eloquent {

    protected $table = 'project_srs_form';
    protected $fillable = array('project_req_id', 'functions', 'brief_des', 'input', 'source', 'requires', 'stakeholder', 'precondition', 'postcondition', 'main_flow1', 'main_flow2', 'exception_condition','created_user');

}
