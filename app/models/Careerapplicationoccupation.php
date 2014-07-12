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
class Careerapplicationoccupation extends Eloquent {

    protected $table = 'career_application_occupation';

    protected function getPositionFirst($param) {
        $occupation = Careerapplicationoccupation::where('info_id', $param)->first();
        if ($occupation->position1 != 0) {
            $oc = \Careerposition::getName($occupation->position1);
        } else {
            $oc = \Lang::get('common.no_data');
        }
        return $oc;
    }

}
