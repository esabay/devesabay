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
class Careerapplicationinfo extends Eloquent {

    protected $table = 'career_application_info';
    protected $fillable = array('firstname', 'lastname', 'nickname', 'nation_type', 'idcard', 'passport_no', 'issue_card', 'birthday', 'sex', 'marital', 'height', 'weigth', 'nationality_id', 'religion_id', 'birthplace_city', 'address', 'DISTRICT_ID', 'AMPHUR_ID', 'PROVINCE_ID', 'zipcode', 'telephone', 'mobile', 'email', 'smssvs', 'military_status', 'photo', 'status', 'disabled');

    protected function getFullName($param) {
        $info = Careerapplicationinfo::find($param);
        return $info->firstname . ' ' . $info->lastname;
    }

    protected function getPhoto($param) {
        $info = Careerapplicationinfo::find($param);
        if ($info->photo != null) {
            if (file_exists(json_decode(trim($info->photo))->{'small'})) {
                $photo = json_decode(trim($info->photo))->{'small'};
            } else {
                $photo = 'img/profile-avatar.jpg';
            }
        } else {
            $photo = 'img/profile-avatar.jpg';
        }
        return $photo;
    }

    protected function getMarital($param) {
        if ($param == 0) {
            $rs = \Lang::get('jcareer.marital_0');
        } elseif ($param == 1) {
            $rs = \Lang::get('jcareer.marital_1');
        } elseif ($param == 2) {
            $rs = \Lang::get('jcareer.marital_2');
        } elseif ($param == 3) {
            $rs = \Lang::get('jcareer.marital_3');
        } else {
            $rs = \Lang::get('common.no_data');
        }
        return $rs;
    }

    protected function getReligion($param) {
        if ($param == 0) {
            $rs = \Lang::get('jcareer.religion_0');
        } elseif ($param == 1) {
            $rs = \Lang::get('jcareer.religion_1');
        } elseif ($param == 2) {
            $rs = \Lang::get('jcareer.religion_2');
        } elseif ($param == 3) {
            $rs = \Lang::get('jcareer.religion_3');
        } elseif ($param == 4) {
            $rs = \Lang::get('jcareer.religion_4');
        } elseif ($param == 5) {
            $rs = \Lang::get('jcareer.religion_5');
        } elseif ($param == 6) {
            $rs = \Lang::get('jcareer.religion_6');
        } elseif ($param == 7) {
            $rs = \Lang::get('jcareer.religion_7');
        } elseif ($param == 8) {
            $rs = \Lang::get('jcareer.religion_8');
        } else {
            $rs = \Lang::get('common.no_data');
        }
        return $rs;
    }

    protected function getSex($param) {
        if ($param == 0) {
            $rs = \Lang::get('jcareer.sex_male');
        } else {
            $rs = \Lang::get('jcareer.sex_female');
        }
        return $rs;
    }

    protected function getNational($param) {
        if ($param == 0) {
            $rs = \Lang::get('jcareer.nation_type_th');
        } else {
            $rs = \Lang::get('jcareer.nation_type_other');
        }
        return $rs;
    }

    protected function getAge($param) {
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

    protected function getAddress($id) {
        $info = \DB::table('career_application_info')
                ->join('province', 'province.PROVINCE_ID', '=', 'career_application_info.PROVINCE_ID')
                ->join('amphur', 'amphur.AMPHUR_ID', '=', 'career_application_info.AMPHUR_ID')
                ->join('district', 'district.DISTRICT_ID', '=', 'career_application_info.DISTRICT_ID')
                ->join('amphur_postcode', 'amphur_postcode.AMPHUR_ID', '=', 'amphur.AMPHUR_ID')
                ->select(array('career_application_info.address', 'province.PROVINCE_NAME', 'amphur.AMPHUR_NAME', 'district.DISTRICT_NAME', 'amphur_postcode.POST_CODE'))
                ->where('career_application_info.id', $id)
                ->get();
        if ($info) {
            $address = $info[0];
            $rs = $address->address . ' ' . \Lang::get('jcareer.district') . $address->DISTRICT_NAME . ' ' . \Lang::get('jcareer.amphur') . $address->AMPHUR_NAME . ' ' . \Lang::get('jcareer.province') . $address->PROVINCE_NAME . ' ' . $address->POST_CODE;
        } else {
            $rs = \Lang::get('common.no_data');
        }

        return $rs;
    }

    protected function getSmssvs($param) {
        if ($param == 0) {
            $rs = \Lang::get('jcareer.smssvs_0');
        } elseif ($param == 1) {
            $rs = \Lang::get('jcareer.smssvs_1');
        } elseif ($param == 2) {
            $rs = \Lang::get('jcareer.smssvs_2');
        } elseif ($param == 3) {
            $rs = \Lang::get('jcareer.smssvs_3');
        } elseif ($param == 4) {
            $rs = \Lang::get('jcareer.smssvs_4');
        } else {
            $rs = '';
        }
        return $rs;
    }

    protected function getMilitary($param) {
        if ($param == 0) {
            $rs = \Lang::get('jcareer.military_0');
        } elseif ($param == 1) {
            $rs = \Lang::get('jcareer.military_1');
        } elseif ($param == 2) {
            $rs = \Lang::get('jcareer.military_2');
        } else {
            \Lang::get('common.no_data');
        }
        return $rs;
    }

}
