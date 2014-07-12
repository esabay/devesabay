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
class Examinationanswer extends Eloquent {

    protected $table = 'examination_answer';
    protected $fillable = array('assign_id', 'examination_id', 'firstname', 'lastname', 'idcard', 'total', 'log');

}
