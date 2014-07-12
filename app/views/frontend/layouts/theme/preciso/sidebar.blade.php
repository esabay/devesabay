<div class="navbar-cont">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="navbar">
                    <div class="navbar-inner">
                        <div class="container"><a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse"><i class="icon-align-justify"></i></a>
                            <div class="nav-collapse collapse navbar-responsive-collapse">
                                <ul class="nav">
                                    <li class="{{(\Request::segment(1)=='' ? 'active' : '')}}"><a href="{{\URL::to('/')}}">หน้าหลัก</a></li>
                                    <li class="dropdown {{(\Request::segment(1)=='about' ? 'active' : '')}}">
                                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">เกี่ยวกับบริษัท<i class="icon-angle-down"></i></a> 

                                        <!-- Dropdown Navbar -->
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo URL::to('post/4'); ?>">ประวัติ</a></li>
                                            <li><a href="<?php echo URL::to('post'); ?>">บริการ</a></li>
                                        </ul>
                                    </li>
                                    <li class="{{(\Request::segment(1)=='product' ? 'active' : '')}}">
                                        <a href="<?php echo URL::to('product'); ?>">สินค้า</a>
                                    </li>
                                    <li class="{{((\Request::segment(1)=='post') && (\Request::segment(2)==1) ? 'active' : '')}}">
                                        <a href="<?php echo URL::to('post/1'); ?>">วิธีสั่งซื้อ</a>
                                    </li>
                                    <li class="{{((\Request::segment(1)=='post') && (\Request::segment(2)==2) ? 'active' : '')}}">
                                        <a href="<?php echo URL::to('post/2'); ?>">วิธีชำระเงิน </a>
                                    </li>
                                    <li class="{{((\Request::segment(1)=='post') && (\Request::segment(2)==3) ? 'active' : '')}}">
                                        <a href="<?php echo URL::to('post/3'); ?>">วิธีจัดส่งสินค้า</a>
                                    </li>
                                    <li class="{{(\Request::segment(1)=='clame' ? 'active' : '')}}">
                                        <a href="javascript:;">เคลมสินค้า</a>
                                    </li>
                                    <li class="{{(\Request::segment(1)=='contact' ? 'active' : '')}}">
                                        <a href="<?php echo URL::to('contact'); ?>">ติดต่อเรา</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>