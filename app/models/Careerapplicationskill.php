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
class Careerapplicationskill extends Eloquent {

    protected $table = 'career_application_skill';
    protected $fillable = array('info_id', 'lang3', 'lang4', 'listen_th', 'listen_en', 'listen_other', 'speak_th', 'speak_en', 'speak_other', 'read_th', 'read_en', 'read_other', 'write_th', 'write_en', 'write_other', 'typing_thai', 'typing_english', 'driving_car', 'driving_motorcycle', 'driving_truck', 'own_car', 'own_motorcycle', 'own_truck', 'licence_car', 'licence_motorcycle', 'licence_other', 'licence_other_name', 'qualification', 'project', 'reference', 'disabled');

    protected function getSkillLang($param) {
        if ($param == 0) {
            $rs = \Lang::get('jcareer.verygood');
        } elseif ($param == 1) {
            $rs = \Lang::get('jcareer.good');
        } elseif ($param == 2) {
            $rs = \Lang::get('jcareer.fair');
        } else {
            $rs = \Lang::get('common.no_data');
        }
        return $rs;
    }

}
