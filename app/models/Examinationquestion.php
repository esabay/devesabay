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
class Examinationquestion extends Eloquent {

    protected $table = 'examination_question';
    protected $fillable = array('examination_id', 'title', 'val', 'rank', 'choice_true', 'text_true', 'disabled');

}
