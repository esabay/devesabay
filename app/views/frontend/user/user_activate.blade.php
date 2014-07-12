@extends('frontend.layouts.theme.preciso.master')
@section('content')
<div class="row">
    <div class="span12"> 

        <!-- Breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
            <li class="active">User</li>
        </ul>
        <p class="small-desc"></p>
        @if($page['ac_status']==0)        
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Success</strong> {{$page['msg']}}</div>    
        @else
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Warning</strong> {{$page['msg']}}</div> 
        @endif
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

@stop