@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('theme/backend/default/assets/bootstrap-fileupload/bootstrap-fileupload.css')}}
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            @foreach ($page['breadcrumbs'] as $key => $val)
            @if ($val === reset($page['breadcrumbs']))
            <li><a href="{{URL::to($val)}}"><i class="icon-home"></i> {{$key}}</a></li>
            @elseif ($val === end($page['breadcrumbs']))
            <li class="active">{{$key}}</li>
            @else
            <li><a href="{{URL::to($val)}}"> {{$key}}</a></li>
            @endif
            @endforeach
        </ul>
        <!--breadcrumbs end -->
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <!--                
                -->
                <div class="form-actions">
                    <div class="pull-left">
                        <a href="{{URL::to('/backend/jshopping/orders')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i> {{\Lang::get('common.back')}}</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <!--widget start-->
        <aside class="profile-nav alt green-border">
            <section class="panel">
                <div class="user-heading alt green-bg">
                    <a href="#">
                        <img src="{{\URL::to(\User::getAvatar($page['member']->id))}}" alt="">
                    </a>
                    <h1>{{$page['member']->firstname}} {{$page['member']->lastname}} @if($page['member']->nickname)({{$page['member']->nickname}})@endif</h1>
                    <p>{{$page['member']->email}}</p>
                </div>

                <ul class="nav nav-pills nav-stacked">
                    <li><a href="javascript:;"> <i class="icon-user"></i> {{ \User::getFullName($page['member']->id); }}</a></li>             
                    <li><a href="javascript:;"> <i class="icon-phone"></i> {{\Lang::get('jcareer.mobile')}} : {{$page['member']->mobile}}</a></li>
                    <li><a href="javascript:;"> <i class="icon-location-arrow"></i> {{ \User::getAddress($page['member']->id); }}</a></li>
                </ul>

            </section>
        </aside>
        <!--widget end-->
    </div> 
    <div class="col-lg-4">
        <section class="panel">
            <header class="panel-heading">
                {{$page['item']->code}}
            </header>
            <div class="list-group">
                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jshopping.order_total')}}</h4>
                    <p class="list-group-item-text">{{number_format($page['item']->total_price,2)}}</p>
                </a>
                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jshopping.order_payment')}}</h4>
                    <p class="list-group-item-text">
                        {{\Shoppingorder::getPaymentMedthod($page['item']->payment_id)}} - {{\Lang::get('jshopping.order_payment_status')}} : {{\Shoppingorderstatus::getStatusCp($page['item']->status)}} @if($page['item']->status>='2')<button class="btn btn-info btn-xs" type="button" id="btnViewSlip">{{\Lang::get('common.click')}}</button>@endif
                    </p>
                </a>
                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jshopping.order_date')}}</h4>
                    <p class="list-group-item-text">{{\Shoppingorder::DateThai($page['item']->created_at)}}</p>
                </a>
                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jshopping.order_status')}}</h4>
                    <p class="list-group-item-text">{{\Shoppingorder::getOrderStatus($page['item']->disabled)}}</p>
                </a>
                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jshopping.promotion_code')}}</h4>
                    <p class="list-group-item-text">{{\Lang::get('common.no_data')}}</p>
                </a>
            </div>
        </section>
    </div>
    <div class="col-lg-4">
        <!--progress bar start-->  
        <section class="panel">
            <header class="panel-heading">
                ที่อยู่มาตรฐานสำหรับจัดส่ง
            </header>
            <div class="panel-body">
                @if($page['member']->addresscopy==1)
                <address>
                    <strong>{{ \Shippingaddress::getFullName($page['member']->id); }}</strong><br>
                    {{ \Shippingaddress::getAddress($page['member']->id); }}<br>
                    <abbr title="Phone">P:</abbr> {{ \Shippingaddress::getMobile($page['member']->id); }}
                </address>
                @else
                <address>
                    <strong>{{ \User::getFullName($page['member']->id); }}</strong><br>
                    {{ \User::getAddress($page['member']->id); }}<br>
                    <abbr title="Phone">P:</abbr> {{ $page['member']->mobile; }}
                </address>
                @endif
                <strong>ประเภทการจัดส่ง</strong>
                <p>{{\Shoppingorder::getShippingType($page['item']->shipping_option_id)}}</p>
            </div>
        </section> 
    </div>
    <div class="col-lg-4">
        <!--progress bar start-->  
        <section class="panel">
            <header class="panel-heading">
                รายละเอียดใบกำกับภาษี
            </header>
            <div class="panel-body">
                @if($page['member']->tax_option==0)
                <address>
                    {{ \Shoppingtax::getTaxInformation($page['member']->id); }}<br>
                </address>
                @else
                <p>{{\Lang::get('common.no_data')}}</p>
                @endif
            </div>
        </section> 
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Order Items
            </header>
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> {{\Lang::get('jshopping.product_name')}}</th>
                            <th class="hidden-phone"> {{\Lang::get('jshopping.product_amount')}}</th>
                            <th> {{\Lang::get('jshopping.unit_price')}}</th>
                            <th> {{\Lang::get('jshopping.order_total')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($page['item_detail'] as $item)
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>{{\Products::getPopupCover($item->product_id)}} <a href="{{\URL::to('product/view/'.$item->product_id.'')}}" target="_blank">{{\Products::getName($item->product_id)}}</a></td>
                            <td class="hidden-phone">{{$item->qty}}</td>
                            <td>{{number_format($item->price,2)}}</td>
                            <td>{{number_format($item->price_after_vat,2)}}</td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach

                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-4 invoice-block pull-right">
                        <ul class="unstyled amounts">
                            <li><strong>{{\Lang::get('jshopping.total_price')}} :</strong> {{number_format($page['item']->total_price)}} {{\Lang::get('common.currency')}}</li>
                            <li><strong>{{\Lang::get('jshopping.discount')}} :</strong> 10%</li>
                            <li><strong>VAT :</strong> -----</li>
                            <li><strong>{{\Lang::get('jshopping.sum_price')}} :</strong> {{number_format($page['item']->sum_price)}} {{\Lang::get('common.currency')}}</li>
                        </ul>
                    </div>
                </div>
                <div class="text-center invoice-btn">
                    <a class="btn btn-danger btn-lg" id="btnChangeStatus"><i class="icon-check"></i> Change Status </a>
                    <a href="{{URL::to('backend/jshopping/orders/print/'.$page['item']->id)}}" class="btn btn-info btn-lg"><i class="icon-print"></i> Print </a>
                </div>
            </div>

        </section>
    </div>
</div>
<!--<div class="row">
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                Timeline
                <span class="tools pull-right">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                    <a href="javascript:;" class="icon-remove"></a>
                </span>
            </header>
            <div class="panel-body profile-activity">
                <h5 class="pull-right">12 August 2013</h5>
                <div class="activity terques">
                    <span>
                        <i class="icon-shopping-cart"></i>
                    </span>
                    <div class="activity-desk">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="arrow"></div>
                                <i class=" icon-time"></i>
                                <h4>10:45 AM</h4>
                                <p>Purchased new equipments for zonal office setup and stationaries.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="activity alt purple">
                    <span>
                        <i class="icon-rocket"></i>
                    </span>
                    <div class="activity-desk">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="arrow-alt"></div>
                                <i class=" icon-time"></i>
                                <h4>12:30 AM</h4>
                                <p>Lorem ipsum dolor sit amet consiquest dio</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="activity blue">
                    <span>
                        <i class="icon-bullhorn"></i>
                    </span>
                    <div class="activity-desk">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="arrow"></div>
                                <i class=" icon-time"></i>
                                <h4>10:45 AM</h4>
                                <p>Please note which location you will consider, or both. Reporting to the VP  you will be responsible for managing.. </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="activity alt green">
                    <span>
                        <i class="icon-beer"></i>
                    </span>
                    <div class="activity-desk">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="arrow-alt"></div>
                                <i class=" icon-time"></i>
                                <h4>12:30 AM</h4>
                                <p>Please note which location you will consider, or both.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                Chats
                <span class="tools pull-right">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                    <a href="javascript:;" class="icon-remove"></a>
                </span>
            </header>
            <div class="panel-body">
                <div class="timeline-messages">
                     Comment 
                    <div class="msg-time-chat">
                        <a class="message-img" href="#"><img alt="" src="{{\URL::to('img/chat-avatar.jpg')}}" class="avatar"></a>
                        <div class="message-body msg-in">
                            <span class="arrow"></span>
                            <div class="text">
                                <p class="attribution"><a href="#">Jhon Doe</a> at 1:55pm, 13th April 2013</p>
                                <p>Hello, How are you brother?</p>
                            </div>
                        </div>
                    </div>
                     /comment 

                     Comment 
                    <div class="msg-time-chat">
                        <a class="message-img" href="#"><img alt="" src="{{\URL::to('img/chat-avatar2.jpg')}}" class="avatar"></a>
                        <div class="message-body msg-out">
                            <span class="arrow"></span>
                            <div class="text">
                                <p class="attribution"> <a href="#">Jonathan Smith</a> at 2:01pm, 13th April 2013</p>
                                <p>I'm Fine, Thank you. What about you? How is going on?</p>
                            </div>
                        </div>
                    </div>
                     /comment 

                     Comment 
                    <div class="msg-time-chat">
                        <a class="message-img" href="#"><img alt="" src="{{\URL::to('img/chat-avatar.jpg')}}" class="avatar"></a>
                        <div class="message-body msg-in">
                            <span class="arrow"></span>
                            <div class="text">
                                <p class="attribution"><a href="#">Jhon Doe</a> at 2:03pm, 13th April 2013</p>
                                <p>Yeah I'm fine too. Everything is going fine here.</p>
                            </div>
                        </div>
                    </div>
                     /comment 

                     Comment 
                    <div class="msg-time-chat">
                        <a class="message-img" href="#"><img alt="" src="{{\URL::to('img/chat-avatar2.jpg')}}" class="avatar"></a>
                        <div class="message-body msg-out">
                            <span class="arrow"></span>
                            <div class="text">
                                <p class="attribution"><a href="#">Jonathan Smith</a> at 2:05pm, 13th April 2013</p>
                                <p>well good to know that. anyway how much time you need to done your task?</p>
                            </div>
                        </div>
                    </div>
                     /comment 
                     Comment 
                    <div class="msg-time-chat">
                        <a class="message-img" href="#"><img alt="" src="{{\URL::to('img/chat-avatar.jpg')}}" class="avatar"></a>
                        <div class="message-body msg-in">
                            <span class="arrow"></span>
                            <div class="text">
                                <p class="attribution"><a href="#">Jhon Doe</a> at 1:55pm, 13th April 2013</p>
                                <p>Hello, How are you brother?</p>
                            </div>
                        </div>
                    </div>
                     /comment 
                </div>
                <div class="chat-form">
                    <div class="input-cont ">
                        <input type="text" placeholder="Type a message here..." class="form-control col-lg-12">
                    </div>
                    <div class="form-group">
                        <div class="pull-right chat-features">
                            <a href="javascript:;">
                                <i class="icon-camera"></i>
                            </a>
                            <a href="javascript:;">
                                <i class="icon-link"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-danger">Send</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</div>-->
@stop
@section('script_page_only')

@stop
@section('script_page_code')
<script type="text/javascript">
    $('#btnViewSlip').click(function() {
        var data = {
            url: 'backend/jshopping/orders/notified/payment/<?php echo $page['item']->id; ?>',
            title: 'Payment'
        };
        genModal(data);
    });
    $('#btnChangeStatus').click(function() {
        var data = {
            url: 'backend/jshopping/orders/change/status/<?php echo $page['item']->id; ?>',
            title: 'Change Status'
        };
        genModal(data);
    });
</script>
@stop