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
class Shoppingorder extends Eloquent {

    protected $table = 'shopping_order';

    public function detail() {
        return $this->hasMany('Shoppingorderdetail', 'shopping_order_id');
    }

    protected function getPaymentMedthod($param) {
        if ($param == 1) {
            $rs = \Lang::get('jshopping.order_payment_method1');
        } elseif ($param == 2) {
            $rs = \Lang::get('jshopping.order_payment_method2');
        } elseif ($param == 3) {
            $rs = \Lang::get('jshopping.order_payment_method3');
        } elseif ($param == 4) {
            $rs = \Lang::get('jshopping.order_payment_method4');
        } elseif ($param == 5) {
            $rs = \Lang::get('jshopping.order_payment_method5');
        } else {
            $rs = \Lang::get('common.no_data');
        }
        return $rs;
    }

    protected function getOrderStatus($param, $type = 1) {
        if ($param == 0) {
            if ($type == 0) {
                $rs = \Lang::get('common.status_active');
            } else {
                $rs = '<span class="label label-success">' . \Lang::get('common.status_active') . '</span>';
            }
        } elseif ($param == 1) {
            if ($type == 0) {
                $rs = \Lang::get('common.status_pending');
            } else {
                $rs = '<span class="label label-warning">' . \Lang::get('common.status_pending') . '</span>';
            }
        } else {
            $rs = \Lang::get('common.no_data');
        }
        return $rs;
    }

    protected function DateThai($strDate) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }

    protected function getShippingType($param) {
        if ($param == 1) {
            $rs = \Lang::get('jshopping.shipping_type1');
        } elseif ($param == 2) {
            $rs = \Lang::get('jshopping.shipping_type2');
        } else {
            $rs = \Lang::get('common.no_data');
        }
        return $rs;
    }

    protected function setOrderExpire($param) {
        $order = \Shoppingorder::find($param);
        $dt = \Carbon::createFromTimeStamp(strtotime($order->order_expire));
        if (($dt->diffInDays(\Carbon::now(), false) >= 1) and ( $order->status == 1)) {
            $order->status = 7;
            $order->save();
        }
    }

}
