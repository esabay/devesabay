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
class Careerposition extends Eloquent {

    protected $table = 'career_position';
    protected $fillable = array('department_id', 'type', 'title', 'amount', 'description', 'place', 'qualification', 'salary', 'benefit', 'created_user', 'updated_user', 'disabled', 'created_user', 'updated_user');

    protected function getType($param) {
        if ($param == 0) {
            $txt = \Lang::get('jcareer.job_type1');
        } elseif ($param == 1) {
            $txt = \Lang::get('jcareer.job_type2');
        } elseif ($param == 2) {
            $txt = \Lang::get('jcareer.job_type3');
        } elseif ($param == 3) {
            $txt = \Lang::get('jcareer.job_type4');
        }
        return $txt;
    }

    protected function getName($param) {
        $position = Careerposition::find($param);
        if ($position) {
            $rs = $position->title;
        } else {
            $rs = \Lang::get('common.no_data');
        }
        return $rs;
    }

}
