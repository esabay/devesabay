@extends('frontend.layouts.theme.preciso.master')
@section('content')
<div class="row">
    <div class="span9"> 
        <ul class="breadcrumb">
            <li><a href="#">หน้าหลัก</a> <span class="divider">/</span></li>
            <li><a href="#">ผู้ใช้งาน</a> <span class="divider">/</span></li>
            <li class="active">บัญชี</li>
        </ul>
        <div class="bs-callout bs-callout-info">
            <h4>ข้อมูลบัญชี/ที่อยู่มาตรฐานสำหรับใบเสร็จ</h4>
            <address>
                <strong>{{ \User::getFullName(\Auth::user()->id); }}</strong><br>
                {{ \User::getAddress(\Auth::user()->id); }}<br>
                <abbr title="Phone">P:</abbr> {{ \Auth::user()->mobile; }}
            </address>
        </div>
        <div class="bs-callout bs-callout-danger">
            <h4>รายละเอียดใบกำกับภาษี</h4>
            <address>
                {{ \Shoppingtax::getTaxInformation(\Auth::user()->id); }}<br>
            </address>
        </div>
        <div class="bs-callout bs-callout-warning">
            <h4>ที่อยู่มาตรฐานสำหรับจัดส่ง</h4>
            @if(\Auth::user()->addresscopy==1)
            <address>
                <strong>{{ \Shippingaddress::getFullName(\Auth::user()->id); }}</strong><br>
                {{ \Shippingaddress::getAddress(\Auth::user()->id); }}<br>
                <abbr title="Phone">P:</abbr> {{ \Shippingaddress::getMobile(\Auth::user()->id); }}
            </address>
            @else
            <address>
                <strong>{{ \User::getFullName(\Auth::user()->id); }}</strong><br>
                {{ \User::getAddress(\Auth::user()->id); }}<br>
                <abbr title="Phone">P:</abbr> {{ \Auth::user()->mobile; }}
            </address>
            @endif
        </div>
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