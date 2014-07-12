<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ZurbPresenter
 *
 * @author R-D-6
 */
class ZurbPresenter extends \Illuminate\Pagination\Presenter {

    public function getActivePageWrapper($text) {
        return '<li class="active"><span>' . $text . '</span></li>';
    }

    public function getDisabledTextWrapper($text) {
        return '<li class="disabled"><span>' . $text . '</span></li>';
    }

    public function getPageLinkWrapper($url, $page) {
        return '<li><a href="' . $url . '">' . $page . '</a></li>';
    }

}
