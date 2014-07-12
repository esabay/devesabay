@extends('frontend.layouts.theme.preciso.master')
@section('content')
<div class="row">
    <!-- Full Width -->
    <div class="span12"> 
        <!-- Breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
            <li><a href="{{ \URL::to('post'); }}">Post</a> <span class="divider">/</span></li>
            <li class="active">{{ $page['item']->name; }}</li>
        </ul>
        <em class="date">On <span>{{ date("d F Y", strtotime($page['item']->created_at)); }}</span></em>
        <h2 class="margin-top margin-bottom">{{ $page['item']->name; }}</h2>
        {{ $page['item']->detail; }}
    </div>
</div>
@stop
@section('small_banner')
{{ $page['small_banner']; }}
@stop
@section('brands_list')
{{ $page['brands_list']; }}
@stop