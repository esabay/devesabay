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
use Moltin\Cart\Facade as Cart;

class Products extends Eloquent {

    protected $table = 'products';
    protected $primaryKey = 'ProductID';

    public function price() {
        return $this->hasMany('Productprice', 'product_id');
    }

    protected function getImgCover($id) {
        $prod = \Products::find($id);
        if ($prod) {
            return json_decode(trim($prod->imgcover))->{'cover'};
        } else {
            return '';
        }
    }

    protected function getName($id) {
        $prod = \Products::find($id);
        if ($prod) {
            return $prod->ProductName;
        } else {
            return \Lang::get('common.no_data');
        }
    }

    protected function getCheckSale($id) {
        $prod = \Products::find($id);
        if ($prod) {
            if ($prod->SalePrice > 0) {
                $str = '<span> ' . number_format($prod->UnitPrice) . '</span>' . number_format($prod->SalePrice) . '';
                return $str;
            } else {
                return number_format($prod->UnitPrice);
            }
        } else {
            return '';
        }
    }

    protected function getPrice($id) {
        if (Auth::check()) {
            $user_auth = \User::find(\Auth::user()->id);
            if ($user_auth->is('Dealer')) {
                $prod = \Productprice::where('product_id', $id)
                        ->where('active2', 0)
                        ->first();
                if ($prod['price2'] > 0) {
                    $str = $prod['price2'];
                } elseif ($prod['price2'] == 0) {
                    $str = '';
                } else {
                    $str = '';
                }
            } else {
                $prod = \Productprice::where('product_id', $id)
                        ->where('active1', 0)
                        ->first();
                if ($prod['price1'] > 0) {
                    $str = $prod['price1'];
                } elseif ($prod['price1'] == 0) {
                    $str = '';
                } else {
                    $str = '';
                }
            }
        } else {
            $prod = \Productprice::where('product_id', $id)
                    ->where('active1', 0)
                    ->first();
            if ($prod['price1'] > 0) {
                $str = $prod['price1'];
            } elseif ($prod['price1'] == 0) {
                $str = '';
            } else {
                $str = '';
            }
        }

        return $str;
    }

    protected function getPriceCp($id) {
        $prod = \Products::find($id);
        if ($prod) {
            if ($prod->UnitPrice > 0 and $prod->SalePrice > 0) {
                $str = '<span class="amount-old"> ' . number_format($prod->UnitPrice) . '</span> <span class="pro-price">' . number_format($prod->SalePrice) . '</span> ' . \Lang::get('common.currency');
            } elseif ($prod->UnitPrice > 0 and $prod->SalePrice == 0) {
                $str = number_format($prod->UnitPrice) . ' ' . \Lang::get('common.currency');
            } elseif ($prod->UnitPrice == 0 and $prod->SalePrice == 0) {
                $str = 'CALL';
            } else {
                $str = '';
            }
        } else {
            $str = '';
        }
        return $str;
    }

    protected function getPopupCover($id) {
        $prod = \Products::find($id);
        if ($prod->imgcover != '') {
            if (file_exists(json_decode(trim($prod->imgcover))->{'cover'})) {
                $photo = \URL::to(json_decode(trim($prod->imgcover))->{'cover'});
            } else {
                $photo = \URL::to('http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image');
            }
        } else {
            $photo = \URL::to('http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image');
        }
        $rs = "<a data-img=\"" . $photo . "\" rel=\"popover_cover_product\" data-placement=\"top\"><i class=\"icon-picture\"></i></a>";
        return $rs;
    }

    protected function updateStock($param) {
        $order = \Shoppingorder::find($param)->detail;
        foreach ($order as $value) {
            $prod = Products::find($value->product_id);
            $prod->UnitsInStock = $prod->UnitsInStock - $value->qty;
            $prod->save();
        }        
    }

}
