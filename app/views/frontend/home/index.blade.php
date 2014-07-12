@extends('frontend.layouts.theme.preciso.master')
@section('content')
{{ $page['content']; }}
@stop
@section('show_product')
{{ $page['show_product']; }}
@stop
@section('small_banner')
{{ $page['small_banner']; }}
@stop
@section('brands_list')
{{ $page['brands_list']; }}
@stop
@section('script_page_code')
<script type="text/javascript">
    $('.flexslider').flexslider({
        animation: "fade",
        slideshowSpeed: 3500,
        animationSpeed: 500,
        prevText: "<i class='icon-angle-left'></i>",
        nextText: "<i class='icon-angle-right'></i>"
    });
</script>
@stop