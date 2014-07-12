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
class Careerapplicationeducation extends Eloquent {

    protected $table = 'career_application_education';
    protected $fillable = array('info_id', 'province', 'level', 'institute', 'faculty', 'major', 'gradyear', 'gpa', 'disable');

    protected function getLevel($param) {
        if ($param == 0) {
            $rs = \Lang::get('jcareer.level_0');
        } elseif ($param == 1) {
            $rs = \Lang::get('jcareer.level_1');
        } elseif ($param == 2) {
            $rs = \Lang::get('jcareer.level_2');
        } elseif ($param == 3) {
            $rs = \Lang::get('jcareer.level_3');
        } elseif ($param == 4) {
            $rs = \Lang::get('jcareer.level_4');
        } elseif ($param == 5) {
            $rs = \Lang::get('jcareer.level_5');
        } elseif ($param == 6) {
            $rs = \Lang::get('jcareer.level_6');
        } else {
            $rs = \Lang::get('common.no_data');
        }
        return $rs;
    }

}
