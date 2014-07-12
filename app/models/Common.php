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
class Common extends Eloquent {

    protected function getDiffTime($param) {
        \Carbon::
                $oDateNow = new DateTime();
        $oDateBirth = new DateTime($param);
        $oDateIntervall = $oDateNow->diff($oDateBirth);
        if ($param) {
            $age = $oDateIntervall->y;
        } else {
            $age = \Lang::get('common.no_data');
        }
        return $age;
    }

    protected function genForm($param = array()) {
        $label = (isset($param['label'])) ? $param['label'] : '&nbsp;';
        $value = (isset($param['value'])) ? trim($param['value']) : NULL;

        if ($param['type'] == 'file') {
            $rs = Form::label($param['name'], $label);
            if ($value) {
                $rs .= link_to($value, 'Download', array('class' => 'btn btn-default', 'target' => '_blank')) . ' ';
                $rs .= '<a href="javascript:;" class="btn btn-danger btnDelete" ref="' . $param['name'] . '">Delete</a>';
            } else {
                $rs .= Form::file($param['name']);
            }
            $rs .= (isset($param['help'])) ? '<p class="help-block">' . $param['help'] . '</p>' : NULL;
        } elseif ($param['type'] == 'text') {
            $rs = Form::label($param['name'], $label, array('class' => 'control-label'));
            $rs .= Form::text($param['name'], $value, array('id' => $param['name'], 'class' => 'form-control'));
            $rs .= (isset($param['help'])) ? '<p class="help-block">' . $param['help'] . '</p>' : NULL;
        }
        return $rs;
    }    

}
