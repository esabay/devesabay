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
            <li><a href="#">หน้าหลัก</a> <span class="divider">/</span></li>
            <li><a href="#">ผู้ใช้งาน</a> <span class="divider">/</span></li>
            <li class="active">ประวัติการสั่งซื้อสินค้า</li>
        </ul>
        <p class="small-desc"></p>
        <h4>ประวัติการสั่งซื้อสินค้า</h4>  
        @foreach($page['result'] as $item)
        {{\Shoppingorder::setOrderExpire($item->id)}}
        @if($item->status==1)
        <div class="bs-callout bs-callout-warning">
            <p>
                <strong>รหัสสั่งซื้อ : </strong><code>{{$item->code}}</code><br /><strong>ราคารวม :</strong> <code>{{number_format($item->sum_price)}} บาท</code> <strong>ส่งซื้อวันที่ :</strong> <code>{{$item->created_at}}</code> <strong>สถานะ :</strong> <code>{{\Shoppingorderstatus::getStatus($item->status)}}</code>
            </p>
            <p>                
                <button class="btn btn-default btnViewOrder" type="button" value="{{$item->id}}">แสดงรายการสั่งซื้อนี้</button>
                <button class="btn btn-primary btnPayment" type="button" value="{{$item->code}}">แจ้งชำระเงิน</button>
                <button class="btn btn-danger btnCancelOrder" type="button" value="{{$item->id}}">ยกเลิกรายการสั่งซื้อ</button>
            </p>
        </div>
        @elseif($item->status==2)
        <div class="bs-callout bs-callout-info">
            <p>
                <strong>รหัสสั่งซื้อ : </strong><code>{{$item->code}}</code><br /><strong>ราคารวม :</strong> <code>{{number_format($item->sum_price)}} บาท</code> <strong>ส่งซื้อวันที่ :</strong> <code>{{$item->created_at}}</code> <strong>สถานะ :</strong> <code>{{\Shoppingorderstatus::getStatus($item->status)}}</code>
            </p>
            <p>                
                <button class="btn btn-default btnViewOrder" type="button" value="{{$item->id}}">แสดงรายการสั่งซื้อนี้</button>
                <button class="btn btn-danger btnCancelOrder" type="button" value="{{$item->id}}">ยกเลิกรายการสั่งซื้อ</button>
            </p>
        </div>
        @elseif($item->status==3 || $item->status==4 || $item->status==5)
        <div class="bs-callout bs-callout-info">
            <p>
                <strong>รหัสสั่งซื้อ : </strong><code>{{$item->code}}</code><br /><strong>ราคารวม :</strong> <code>{{number_format($item->sum_price)}} บาท</code> <strong>ส่งซื้อวันที่ :</strong> <code>{{$item->created_at}}</code> <strong>สถานะ :</strong> <code>{{\Shoppingorderstatus::getStatus($item->status)}}</code>
            </p>
            <p>                
                <button class="btn btn-default btnViewOrder" type="button" value="{{$item->id}}">แสดงรายการสั่งซื้อนี้</button>
            </p>
        </div>
        @elseif($item->status==6)
        <div class="bs-callout bs-callout-danger">
            <p>
                <strong>รหัสสั่งซื้อ : </strong><code>{{$item->code}}</code><br /><strong>ราคารวม :</strong> <code>{{number_format($item->sum_price)}} บาท</code> <strong>ส่งซื้อวันที่ :</strong> <code>{{$item->created_at}}</code> <strong>ยกเลิกรายการเมื่อ :</strong> <code>{{$item->updated_at}}</code> <strong>สถานะ :</strong> <code>{{\Shoppingorderstatus::getStatus($item->status)}}</code>
            </p>
            <p>                
                <button class="btn btn-default btnViewOrder" type="button" value="{{$item->id}}">แสดงรายการสั่งซื้อนี้</button>
            </p>
        </div>
        @elseif($item->status==7)
        <div class="bs-callout bs-callout-danger">
            <p>
                <strong>รหัสสั่งซื้อ : </strong><code>{{$item->code}}</code><br /><strong>ราคารวม :</strong> <code>{{number_format($item->sum_price)}} บาท</code> <strong>ส่งซื้อวันที่ :</strong> <code>{{$item->created_at}}</code> <strong>ยกเลิกรายการเมื่อ :</strong> <code>{{$item->updated_at}}</code> <strong>สถานะ :</strong> <code>{{\Shoppingorderstatus::getStatus($item->status)}}</code>
            </p>
            <p>                
                <button class="btn btn-default btnViewOrder" type="button" value="{{$item->id}}">แสดงรายการสั่งซื้อนี้</button>
            </p>
        </div>
        @else
        <p class="alert alert-success">
            <i class="fa fa-info-circle"></i> 
            {{$item->code}} {{$item->created_at}} {{$item->sum_price}} 
            <a href="javascript:;" rel="{{ $item->id; }}" class="btn btn-danger btnDeleteCart">ยกเลิก</a>
        </p>
        @endif
        @endforeach    
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
    $('.btnViewOrder').click(function() {
        getPageUrl(base_url + 'shopping/orders/view/' + $(this).val());
    });
    $('.btnPayment').click(function() {
        var data = {
            url: 'shopping/payment/add/' + $(this).val(),
            title: 'แจ้งชำระเงิน'
        };
        genModal(data);
    });
    $('.btnCancelOrder').click(function() {
        var data = {
            title: 'Confirm',
            type: 'confirm',
            text: 'คุณต้องการยกเลิกรายการสั่งซื้อนี้ใช่หรือไม่ ?'
        };
        genModal(data);
        $('#myModal #button-confirm').attr('value', $(this).val());
        $('body').on('click', '#myModal #button-confirm', function() {
            $.ajax({
                type: "post",
                url: base_url + 'shopping/order/cancel',
                data: {id: $(this).val()},
                cache: false,
                dataType: 'json',
                success: function(result) {
                    try {
                        if (result.error.status === true)
                        {
                            $('#myModal .modal-footer').hide();
                            $('#myModal .modal-body').empty();
                            $('#myModal .modal-body').html('<div class="text-center">' + result.error.message + '</div>');
                            setTimeout(function() {
                                $('#myModal').modal('hide');
                                $('#myModal').on('hidden.bs.modal', function(e) {
                                    window.open(base_url + 'shopping/history', '_self');
                                });
                            }, 5000);
                        } else {
                            $.fancybox(result.error.message);
                        }
                    } catch (e) {
                        alert('Exception while request..');
                    }
                },
                error: function(e) {
                    alert('Error while request..');
                }
            });
        });
    });
</script>
@stop