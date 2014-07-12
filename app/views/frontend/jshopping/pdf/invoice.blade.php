<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        {{HTML::style('theme/backend/default/css/bootstrap.min.css')}}
        {{HTML::style('theme/backend/default/css/bootstrap-reset.css')}}
        <!--external css-->
        {{HTML::style('theme/backend/default/assets/font-awesome/css/font-awesome.css')}}                
        <!-- Custom styles for this template -->
        {{HTML::style('theme/backend/default/css/style.css',array('media' => 'print'))}}
        {{HTML::style('theme/backend/default/css/style-responsive.css')}}
    </head>
    <body onload="window.print();">
        <section>
            <div class="panel panel-primary">
                <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                <div class="panel-body">
                    <div class="row invoice-list">
                        <div class="text-center corporate-id">
                            <img src="{{URL::to('theme/frontend/preciso/img/logo-web.png')}}" />
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <h4>BILLING ADDRESS</h4>
                            <address>
                                <strong>{{ \User::getFullName(\Auth::user()->id); }}</strong><br>
                                {{ \User::getAddress(\Auth::user()->id); }}<br>
                                Tel : {{ \Auth::user()->mobile; }}
                            </address>
                            <img src="{{\DNS1D::getBarcodePNGPath($page['item']->code, "C128")}}" alt="{{$page['item']->code}}" />
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <h4>SHIPPING ADDRESS</h4>
                            @if(\Auth::user()->addresscopy==1)
                            <address>
                                <strong>{{ \Shippingaddress::getFullName(\Auth::user()->id); }}</strong><br>
                                {{ \Shippingaddress::getAddress(\Auth::user()->id); }}<br>
                                Tel :  {{ \Shippingaddress::getMobile(\Auth::user()->id); }}
                            </address>
                            @else
                            <address>
                                <strong>{{ \User::getFullName(\Auth::user()->id); }}</strong><br>
                                {{ \User::getAddress(\Auth::user()->id); }}<br>
                                Tel :  {{ \Auth::user()->mobile; }}
                            </address>
                            @endif
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <h4>INVOICE INFO</h4>
                            <p>รหัสสั่งซื้อ : <strong>{{$page['item']->code}}</strong></p>                
                            <p>{{\Lang::get('jshopping.order_payment')}} : <strong>{{\Shoppingorder::getPaymentMedthod($page['item']->payment_id)}}</strong></p>
                            <p>{{\Lang::get('jshopping.order_date')}} : <strong>{{\Shoppingorder::DateThai($page['item']->created_at)}}</strong></p>
                            <p>{{\Lang::get('jshopping.order_expire_date')}} : <strong>{{\Shoppingorder::DateThai($page['item']->order_expire)}}</strong></p>
                            <p>{{\Lang::get('jshopping.order_status')}} : <strong>{{\Shoppingorder::getOrderStatus($page['item']->disabled,0)}}</strong></p>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> {{\Lang::get('jshopping.product_name')}}</th>
                                <th class="text-center"> {{\Lang::get('jshopping.product_amount')}}</th>
                                <th class="text-center"> {{\Lang::get('jshopping.unit_price')}}</th>
                                <th class="text-center"> {{\Lang::get('jshopping.order_total')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($page['item_detail'] as $item)
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><strong>{{\Products::getName($item->product_id)}}</strong></td>
                                <td class="text-center">{{$item->qty}}</td>
                                <td class="text-right">{{number_format($item->price)}}</td>
                                <td class="text-right">{{number_format($item->price_after_vat)}}</td>
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
                </div>
        </section>
    </div>
</body>
</html>
