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
class Timeline extends Eloquent {

    protected $table = 'timeline';
    protected $fillable = array('pk_id', 'title', 'module', 'url', 'color', 'created_user');

    protected function setTimeline($param) {
        $strings = array('red', 'blue', 'green', 'purple', 'light-green');
        $key = array_rand($strings);
        $attributes = array(
            'color' => $strings[$key]            
        );
        $data = array_merge($param, $attributes);
        Timeline::create($data);
    }

}
