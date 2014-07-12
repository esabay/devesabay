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
class Province extends Eloquent {

//put your code here
    protected $table = 'province';
    protected $fillable = array('PROVINCE_CODE', 'PROVINCE_NAME', 'GEO_ID');
    protected $primaryKey = 'PROVINCE_ID';

    protected function getName($param) {
        $prov = \Province::find($param);
        return $prov->PROVINCE_NAME;
    }

}
