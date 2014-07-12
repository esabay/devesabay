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
class Examinationanswerdesc extends Eloquent {
    protected $table = 'examination_answer_desc';
    protected $fillable = array('answer_id', 'choice', 'select', 'txt', 'choice_true');
}
