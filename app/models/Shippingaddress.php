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
class Shippingaddress extends Eloquent {

    protected $table = 'shopping_shipping_address';

    protected function getFullName($id) {
        $user = \DB::table('shopping_shipping_address')
                ->where('users_id', $id)
                ->get();
        if ($user) {
            $shipping = $user[0];
            return $shipping->firstname . ' ' . $shipping->lastname;
        } else {
            return 'No data.';
        }
    }

    protected function getMobile($id) {
        $user = \DB::table('shopping_shipping_address')
                ->where('users_id', $id)
                ->get();
        if ($user) {
            $shipping = $user[0];
            return $shipping->mobile;
        } else {
            return '';
        }
    }

    protected function getAddress($id) {
        $users = \DB::table('shopping_shipping_address')
                ->join('province', 'province.PROVINCE_ID', '=', 'shopping_shipping_address.province')
                ->join('amphur', 'amphur.AMPHUR_ID', '=', 'shopping_shipping_address.amphur')
                ->join('district', 'district.DISTRICT_ID', '=', 'shopping_shipping_address.district')
                ->join('amphur_postcode', 'amphur_postcode.AMPHUR_ID', '=', 'amphur.AMPHUR_ID')
                ->select(array('shopping_shipping_address.address', 'province.PROVINCE_NAME', 'amphur.AMPHUR_NAME', 'district.DISTRICT_NAME', 'amphur_postcode.POST_CODE'))
                ->where('shopping_shipping_address.users_id', $id)
                ->get();
        if ($users) {
            $address = $users[0];
            return $address->address . ' ' . $address->DISTRICT_NAME . ' ' . $address->AMPHUR_NAME . ' ' . $address->PROVINCE_NAME . ' ' . $address->POST_CODE;
        } else {
            return 'No data.';
        }
    }

}
