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
class Examination extends Eloquent {

    protected $table = 'examination';
    protected $fillable = array('type_id', 'title', 'description', 'department_id', 'created_user', 'updated_user', 'disabled');

    protected function getCountQuestion($param) {
        $num = \Examinationquestion::where('examination_id', $param)->count();
        if ($num > 0) {
            $rs = \Lang::get('jexamination.amount') . ' ' . $num . ' ' . \Lang::get('jexamination.item');
        } else {
            $rs = \Lang::get('jexamination.no_question');
        }
        return $rs;
    }

}
