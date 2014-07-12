@extends('frontend.layouts.theme.preciso.master')
@section('content')
<div class="row">
    <div class="span9">

        <!-- Breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
            <li><a href="{{ \URL::to('/post'); }}">Post</a> <span class="divider">/</span></li>
            <li class="active">{{ $page['item']->name; }}</li>
        </ul>

        <!-- Single Post -->
<!--        <h1>Single <span>Post</span></h1>-->
        <h2 class="margin-top margin-bottom">{{ $page['item']->name; }}</h2>
        {{ $page['item']->detail; }}
        <div class="clearfix"></div>        
    </div>

    <!-- Sidebar -->
    <div class="span3 sidebar">
        <h3>Categories</h3>
        <ul class="nav nav-stacked">
            @foreach ($page['result_category'] as $item_cat)
            @if ($item_cat['front'] == 0)
            <li class="sub-menu">
                <a href="javascript:;">{{ $item_cat['title']; }}</a>
                @if ($item_cat['children'])                  
                <ul class="sub">
                    @foreach ($item_cat['children'] as $item2_cat)
                    <li>
                        <a href="javascript:;" class="getRel" rel="{{ \URL::to('/post/category/' . $item2_cat['id'] . ''); }}">{{ $item2_cat['title']; }}</a>
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endif
            @endforeach
        </ul>
        <h3>Archives</h3>
        <form action="http://www.angelomazzilli.com/Preciso/archives">
            <select class="span3">
                <option>April 2013</option>
                <option>March 2013</option>
                <option>February 2013</option>
                <option>January 2013</option>
                <option>December 2012</option>
            </select>
        </form>
        <h3>Widget Text</h3>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam <strong>nonummy nibh</strong> euismod tincidunt ut laoreet <a href="#">dolore magna</a> aliquam erat volutpat.</p>
    </div>
</div>
@stop
@section('small_banner')
{{ $page['small_banner']; }}
@stop
@section('brands_list')
{{ $page['brands_list']; }}
@stop
@section('seo_title')
{{ ': ' . $page['seo']['title']; }}
@stop
@section('seo_description')
{{ $page['seo']['description']; }}
@stop
@section('seo_keywords')
{{ $page['seo']['keywords']; }}
@stop
@section('script_page_code')
<script type="text/javascript">
    $('#btnSave').click(function() {
        var data = {
            url: 'post/comment/add',
            v: $('#submit-comment, textarea input:not(#btnSave)').serializeArray(),
            form: 'submit-comment'
        };
        saveData(data);
    });
</script>
@stop