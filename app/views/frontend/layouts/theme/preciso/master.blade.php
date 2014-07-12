<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>INSIDE IT DISTRIBUTION @yield('seo_title')</title>
        <meta name="description" content="@yield('seo_description')" />
        <meta name="keywords" content="@yield('seo_keywords')" />
        <!-- Stylesheet -->
        <link rel="shortcut icon" href="{{URL::to('theme/frontend/preciso/img/favicon.ico')}}" />
        {{HTML::style('theme/frontend/preciso/css/bootstrap.min.css')}}
        {{HTML::style('theme/frontend/preciso/css/bootstrap/css/bootstrap.css')}}
        {{HTML::style('theme/frontend/preciso/css/bootstrap-responsive.min.css')}}
        {{HTML::style('theme/frontend/preciso/css/font-awesome.min.css')}}
        {{HTML::style('theme/frontend/preciso/css/style.css')}}
        {{HTML::style('theme/frontend/preciso/css/color/red.css')}}
        {{HTML::style('theme/frontend/preciso/css/flexslider.css')}}
        {{HTML::style('theme/frontend/preciso/css/fancybox.css')}}
        {{HTML::style('theme/frontend/preciso/css/masonry.css')}}
        {{HTML::style('theme/frontend/preciso/css/docs.min.css')}}        
        {{HTML::style('http://fonts.googleapis.com/css?family=Roboto+Condensed')}}
    </head>
    <body>

        <!-- Header -->
        <div class="header">
            <div class="container">
                <div class="row"> 
                    <!-- Secondary Menu -->
                    <ul class="nav nav-pills span6">
                        <li class="active"><a href="{{\URL::to('/')}}">หน้าหลัก</a></li>
                        <li>
                            <a href="javascript:;" class="getRel">สินค้าที่ชอบ</a>
                        </li>
                        @if(\Auth::check())
                        <li><a href="<?php echo URL::to('user/dashboard'); ?>">บัญชี</a></li>
                        @endif
                        <li><a href="<?php echo URL::to('shopping/cart'); ?>">ตระกร้าสินค้า</a></li>
                        <li><a href="<?php echo URL::to('shopping/checkout'); ?>">สั่งซื้อ</a></li>
                    </ul>

                    <!-- Header Cart -->
                    <div id="header_cart"></div>

                    <!-- Currency -->
                    <ul class="nav nav-pills currency">
                        <li class="active"><a href="#">฿</a></li>
                    </ul>

                    <!-- Header Login -->
                    <p class="log-reg">
                        <?php if (\Auth::check()) { ?>
                            <a href="<?php echo URL::to('user/dashboard'); ?>"><span><?php echo \Lang::get('common.hello'); ?><?php echo \User::getFullName(\Auth::user()->id); ?></span></a>
                            <a href="javascript:;">ข้อความ
                                <span class="badge bg-info">6</span>
                            </a>

                            <a href="javascript:;" id="getLogout">ออกจากระบบ</a>
                        <?php } else { ?>
                            <a class="{{(\Request::segment(1)=='login' ? 'active' : '')}}" href="<?php echo URL::to('login'); ?>">เข้าสู่ระบบ</a>
                            <a class="{{(\Request::segment(1)=='register' ? 'active' : '')}}" href="<?php echo URL::to('register'); ?>">สมัครดีเลอร์</a>
                        <?php } ?>
                    </p>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="span5">
                    <a href="#" id="logo" title="Inside IT Distribution"><img src="{{URL::to('theme/frontend/preciso/img/logo-web.png')}}" alt="logo" /></a> 
                    <!--<h2 class="text-left">ศูนย์ขายส่งสินค้าไอทีครบวงจร</h2>-->
                </div>
                <div class="span7">
                    <!--<img src="http://www.insideit.co.th/web/images/header/open_now2.JPG" />-->
                </div>
            </div>
        </div>
        <!-- Main Navbar -->
        <hr class="bordered" />
        @include('frontend.layouts.theme.preciso.sidebar')
        <hr class="bordered" />
        <div class="container" id="webcontent">
            @yield('content')
        </div>
        @yield('show_product')
        @yield('news_gallery')
        @yield('small_banner')
        @yield('brands_list')
        <div class="footer">
            <div class="container">
                <div class="row"> 

                    <!-- Footer Info -->
                    <!--                    <div class="span3">
                                            <h5><i class="icon-globe"></i>J.I.B COMPUTER GROUP</h5>
                                            <img src="{{URL::to('http://www.jib.co.th/web/images/jib2.png')}}" alt="Store" /> </div>-->
                    <div class="span3">
                        <h5><i class="icon-globe"></i>About</h5>
                        <p>"บริษัท อินไซด์ ไอที ดิสทริบิวชั่น จำกัด" ศูนย์ขายส่งสินค้าไอทีและสมาร์ทโฟนครบวงจร ทางบริษัท ฯ พร้อมส่งมอบสินค้าดี มีคุณภาพ และราคาถูกที่สุด สะดวกสบายด้วยระบบการซื้อขายผ่านช่องทางออนไลน์ที่ทันสมัย</p>
                    </div>

                    <!-- Footer Contact -->
                    <div class="span6">
                        <h5><i class="icon-asterisk"></i>Contact Us</h5>
                        <ul class="footer-contact">
                            <li><i class="icon-map-marker"></i>เลขที่ 801/70-72 ม.8 ถนนพหลโยธิน ต.คูคต อ.ลำลูกกา จ.ปทุมธานี 12130</li>
                            <li><i class="icon-phone"></i>02-992-5000</li>
                            <li><i class="icon-mobile-phone"></i>094-480-1851</li>
                            <li><i class="icon-envelope-alt"></i><a href="#">sale.inside.it@gmail.com</a></li>
                        </ul>
                    </div>

                    <!-- Footer Social -->
                    <div class="span3">
                        <h5><i class="icon-rss"></i>Keep in touch</h5>
                        <div class="footer-social"> 
                            <a href="http://www.facebook.com/jibcomputergroup" class="icon-facebook"></a> 
                            <a href="https://www.twitter.com/jibcomputergrp" class="icon-twitter"></a> 
                            <a href="#" class="icon-google-plus"></a> 
                            <a href="#" class="icon-pinterest"></a> 
                            <a href="#" class="icon-linkedin"></a> </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Links -->
        <!--        <div class="footer-links">
                    <div class="container">
                        <div class="row">
                            <div class="span3">
                                <h5><i class="icon-info"></i>Information</h5>
                                <ul>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Delivery Information</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Terms &amp; Conditions</a></li>
                                </ul>
                            </div>
                            <div class="span3">
                                <h5><i class="icon-comment"></i>Customer Service</h5>
                                <ul>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Returns</a></li>
                                    <li><a href="#">Delivery</a></li>
                                    <li><a href="#">Site Map</a></li>
                                </ul>
                            </div>
                            <div class="span3">
                                <h5><i class="icon-folder-open"></i>Extras</h5>
                                <ul>
                                    <li><a href="#">Brands</a></li>
                                    <li><a href="#">Gift Vouchers</a></li>
                                    <li><a href="#">Affiliates</a></li>
                                    <li><a href="#">Specials</a></li>
                                </ul>
                            </div>
                            <div class="span3">
                                <h5><i class="icon-unlock-alt"></i>My Account</h5>
                                <ul>
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">Order History</a></li>
                                    <li><a href="#">Wish List</a></li>
                                    <li><a href="#">Newsletter</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr class="bordered" />
                </div>-->

        <!-- Copy -->
        <div class="copy">
            <div class="container">
                <div class="row">
                    <div class="span12"> 

                        <!-- Cards --> 
                        <img src="{{URL::to('theme/frontend/preciso/img/cards.png')}}" alt="Cards" />
                        <p class="text-center">Powered by <strong>J-Office</strong> - &copy; 2014 <a href="http://www.jib.co.th" target="_blank">JIB Group</a></p>
                        <p class="text-center">Engine by Laravel 4.2</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- to Top -->
        <div id="toTop"><i class="icon-chevron-up icon-white"></i></div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                        <h4 class="modal-title">Modal Tittle</h4>
                    </div>
                    <div class="modal-body">

                        Body goes here...

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button" id="button-close">Close</button>
                        <button class="btn btn-warning" type="button" id="button-confirm"> Confirm</button>
                        <button data-dismiss="modal" class="btn btn-danger" type="button" id="button-ok"> Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        {{HTML::script('http://code.jquery.com/jquery-1.9.1.min.js')}}
        {{HTML::script('theme/frontend/preciso/js/bootstrap.min.js')}}
        {{HTML::script('theme/frontend/preciso/js/jquery.nicescroll.min.js')}}
        {{HTML::script('theme/frontend/preciso/js/jquery.flexslider.min.js')}}
        {{HTML::script('theme/frontend/preciso/js/jquery.fancybox.min.js')}}
        {{HTML::script('theme/frontend/preciso/js/jquery.masonry.min.js')}}
        {{HTML::script('theme/frontend/preciso/js/docs.min.js')}}
        {{HTML::script('theme/frontend/preciso/js/jquery.dcjqaccordion.2.7.js')}}
        {{HTML::script('theme/frontend/preciso/js/functions.js')}}
        @yield('script_page_only')
        @yield('script_page_code')
    </body>    
</html>