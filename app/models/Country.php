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
class Country extends Eloquent {

    protected $table = 'country_t';
    protected $primaryKey = 'country_id';

    protected function getName($param) {
        $country = \Country::find($param);
        return $country->short_name;
    }
}
