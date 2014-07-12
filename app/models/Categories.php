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
class Categories extends Eloquent {

    protected $table = 'categories';
    protected $fillable = array('type', 'title', 'description', 'disabled', 'front');

    protected function getName($param) {
        $cat = \Categories::find($param);
        if ($cat) {
            return $cat->title;
        } else {
            return 'No data !';
        }
    }

    protected function getRootName($param) {
        $parent = \Categorize::getCategoryProvider()->findById($param);
        return $parent->title;
    }

    protected function getSub($param) {
        $prod = \Products::find($param);
        if ($prod->sub1 > 0) {

            if ($prod->sub5 > 0) {
                $txt = ($prod->sub1 > 0 ? $this->getName($prod->sub1) . ' >' : '') . ($prod->sub2 > 0 ? $this->getName($prod->sub2) . ' >' : '') . ($prod->sub3 > 0 ? $this->getName($prod->sub3) . ' >' : '') . ($prod->sub4 > 0 ? $this->getName($prod->sub4) . ' >' : '') . ($prod->sub5 > 0 ? $this->getName($prod->sub5) : '');
            } elseif ($prod->sub4 > 0) {
                $txt = ($prod->sub1 > 0 ? $this->getName($prod->sub1) . ' >' : '') . ($prod->sub2 > 0 ? $this->getName($prod->sub2) . ' >' : '') . ($prod->sub3 > 0 ? $this->getName($prod->sub3) . ' >' : '') . ($prod->sub4 > 0 ? $this->getName($prod->sub4) : '');
            } elseif ($prod->sub3 > 0) {
                $txt = ($prod->sub1 > 0 ? $this->getName($prod->sub1) . ' >' : '') . ($prod->sub2 > 0 ? $this->getName($prod->sub2) . ' >' : '') . ($prod->sub3 > 0 ? $this->getName($prod->sub3) : '');
            } elseif ($prod->sub2 > 0) {
                $txt = ($prod->sub1 > 0 ? $this->getName($prod->sub1) . ' >' : '') . ($prod->sub2 > 0 ? $this->getName($prod->sub2) : '');
            } else {
                $txt = ($prod->sub1 > 0 ? $this->getName($prod->sub1) . ' >' : '');
            }
        } else {
            $txt = '';
        }
        return $txt;
    }

}
