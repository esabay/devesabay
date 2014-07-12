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
class Careerapplicationexperience extends Eloquent {

    protected $table = 'career_application_experience';
    protected $fillable = array('info_id', 'ex_form', 'ex_to', 'company', 'address', 'position', 'salary', 'description', 'disabled');

}
