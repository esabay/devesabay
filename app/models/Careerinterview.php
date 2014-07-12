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
class Careerinterview extends Eloquent {

    protected $table = 'career_interview';
    protected $fillable = array('info_id', 'info', 'occupation', 'education', 'experience', 'skill', 'other', 'summary', 'accept1', 'remark1', 'accept2', 'remark2', 'accept3', 'remark3', 'status', 'disabled', 'created_user', 'updated_user');

    protected function getStatus($param) {
        if ($param == 1) {
            $txt = '<span class="label label-default label-mini">' . \Lang::get('jcareer.interview_status_1') . '</span>';
        } elseif ($param == 2) {
            $txt = '<span class="label label-warning label-mini">' . \Lang::get('jcareer.interview_status_2') . '</span>';
        } elseif ($param == 3) {
            $txt = '<span class="label label-warning label-mini">' . \Lang::get('jcareer.interview_status_3') . '</span>';
        } elseif ($param == 4) {
            $txt = '<span class="label label-primary label-mini">' . \Lang::get('jcareer.interview_status_4') . '</span>';
        } elseif ($param == 5) {
            $txt = '<span class="label label-primary label-mini">' . \Lang::get('jcareer.interview_status_5') . '</span>';
        } elseif ($param == 6) {
            $txt = '<span class="label label-info label-mini">' . \Lang::get('jcareer.interview_status_6') . '</span>';
        } elseif ($param == 7) {
            $txt = '<span class="label label-danger label-mini">' . \Lang::get('jcareer.interview_status_7') . '</span>';
        } elseif ($param == 8) {
            $txt = '<span class="label label-success label-mini">' . \Lang::get('jcareer.interview_status_8') . '</span>';
        }else{
            $txt = '';
        }
        return $txt;
    }

    protected function getInterviewer($param) {
        $interv = \DB::table('career_interview')->where('info_id', $param)->get();
        if ($interv) {
            $rs = \User::getUsername($interv[0]->created_user);
        } else {
            $rs = '';
        }
        return $rs;
    }

}
