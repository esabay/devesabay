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
class Productspec extends Eloquent {

//put your code here
    protected $table = 'productspec';
    protected $fillable = array('categories_id', 'spec1', 'spec2', 'spec3', 'spec4', 'spec5', 'spec6', 'spec7', 'spec8', 'spec9', 'spec10');

    protected function getSpec($id = 0, $str) {
        $spec = \DB::table('productspec')->where('categories_id', $id)->get();
        if ($spec) {
            $rs = $spec[0]->$str;
        } else {
            $rs = null;
        }
        return $rs;
    }

}
