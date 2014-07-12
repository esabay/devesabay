@extends('frontend.layouts.theme.preciso.master')
@section('content')
<style type="text/css">
    input[type='text'],textarea{width: 50%;}
    #zipcode, #zipcode2, #mobile, #mobile2, #email {width: 20%;}
    #firstname,#firstname2,#lastname,#lastname2 {width:30%;}
</style>
<div class="row">                        
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ \URL::to('/'); }}">Home</a> <span class="divider">/</span></li>
            <li class="active">Shopping</li>
        </ul>
        <p class="small-desc"></p>
        <div class="row">
            <div class="span3">
                <h4>ที่อยู่สำหรับใบเสร็จ</h4>
                <address>
                    <strong>{{ \User::getFullName(\Auth::user()->id); }}</strong><br>
                    {{ \User::getAddress(\Auth::user()->id); }}<br>
                    Tel : {{ \Auth::user()->mobile; }}
                </address>
                <p>{{\DNS1D::getBarcodeHTML($page['item']->code, "C128")}}</p>
            </div>
            <div class="span3">
                <h4>ที่อยู่สำหรับจัดส่งสินค้า</h4>
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
                    Tel : {{ \Auth::user()->mobile; }}
                </address>
                @endif
            </div>
            <div class="span3">
                <h4>รายการสั่งซื้อ</h4>
                <p>รหัสสั่งซื้อ : <strong>{{$page['item']->code}}</strong></p>                
                <p>{{\Lang::get('jshopping.order_payment')}} : <strong>{{\Shoppingorder::getPaymentMedthod($page['item']->payment_id)}}</strong></p>
                <p>{{\Lang::get('jshopping.order_date')}} : <strong>{{\Shoppingorder::DateThai($page['item']->created_at)}}</strong></p>
                <p>{{\Lang::get('jshopping.order_expire_date')}} : <strong>{{\Shoppingorder::DateThai($page['item']->order_expire)}}</strong></p>
                <p>{{\Lang::get('jshopping.order_status')}} : <strong>{{\Shoppingorder::getOrderStatus($page['item']->disabled)}}</strong></p>
                
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th class="p-name">{{\Lang::get('jshopping.product_name')}}</th>
                    <th>{{\Lang::get('jshopping.product_amount')}}</th>
                    <th>ราคาต่อหน่วย</th>
                    <th>{{\Lang::get('jshopping.order_total')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($page['item_detail'] as $item)
                <tr>
                    <td class = "thumb-cart">
                        <a href = "{{ \URL::to('/product/view/' . $item->product_id); }}">
                            <img src = "{{ \URL::to(\Products::getImgCover($item->product_id)); }}" alt = "{{\Products::getName($item->product_id)}}" />
                        </a>
                    </td>
                    <td class = "p-name">
                        <h5>
                            <a href = "{{ \URL::to('/product/view/' . $item->product_id); }}">{{\Products::getName($item->product_id)}}</a>
                        </h5>
                    </td>
                    <td>{{$item->qty}}</td>
                    <td>฿ {{number_format($item->price,2)}}</td>
                    <td><strong>฿ {{number_format($item->price_after_vat,2)}}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Cart Total -->
        <div class="main-cart-total">
            <p class="total">{{\Lang::get('jshopping.total_price')}} <span> {{number_format($page['item']->total_price)}} {{\Lang::get('common.currency')}}</span> 
        </div>
        <div class="main-cart-total">
            <p class="total">{{\Lang::get('jshopping.discount')}} <span> 10%</span> 
        </div>
        <div class="main-cart-total">
            <p class="total">{{\Lang::get('jshopping.sum_price')}} <span> {{number_format($page['item']->sum_price)}} {{\Lang::get('common.currency')}}</span> 
        </div>


        <div class="text-center invoice-btn">
            <a href="{{URL::to('shopping/orders/print/'.$page['item']->id)}}" target="_blank" class="btn btn-info btn-lg"><i class="icon-print"></i> Print </a>
        </div>
        <hr />
    </div>
    <!-- Sidebar -->
    <div class="span3 sidebar">
        @include('frontend.user.sidebar')
    </div>
</div>
@stop
@section('small_banner')
{{ $page['small_banner']; }}
@stop
@section('brands_list')
{{ $page['brands_list']; }}
@stop
@section('script_page_code')
<script type="text/javascript">
    function formSave()
    {
        var data = {
            url: 'user/shopping/tax/edit',
            v: $('#form-add input:not(#btnDialogSave)').serializeArray(),
            redirect: 'user/dashboard'
        };
        saveData(data);
    }

    $('#btnDialogSave').click(function() {
        formSave();
    });
</script>
@stop