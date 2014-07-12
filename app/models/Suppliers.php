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
class Suppliers extends Eloquent {

    protected $table = 'suppliers';
    protected $fillable = array('CompanyName', 'ContactName', 'ContactTitle', 'Address', 'Phone', 'Fax', 'Email','disabled');
    protected $primaryKey = 'SupplierID';

}
