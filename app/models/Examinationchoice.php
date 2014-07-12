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
class Examinationchoice extends Eloquent {

    protected $table = 'examination_choice';
    protected $fillable = array('question_id', 'title', 'val', 'rank', 'status');
}
