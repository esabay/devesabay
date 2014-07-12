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
class Page extends Eloquent {

//put your code here
    protected $table = 'page';
    protected $fillable = array('id', 'group_id', 'name', 'shortdetail', 'detail', 'disabled', 'tagsinput', 'startdate');

    public function pages() {
        return $this->hasMany('Grouppage', 'id');
    }

}
