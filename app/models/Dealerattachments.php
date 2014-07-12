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
class Dealerattachments extends Eloquent {

    protected $table = 'dealer_attachments';
    protected $fillable = array('user_id', 'file1', 'file2', 'file3', 'file4', 'file5', 'disabled');

}
