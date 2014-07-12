@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('/assets/fancybox/source/jquery.fancybox.css')}}
{{HTML::style('/css/gallery.css')}}
@stop
@section('content')
<!-- page start-->
<section class="panel">
    <header class="panel-heading">
        {{$page['title']}}
    </header>
    <div class="panel-body">
        <div class="alert alert-info fade in">
            <button type="button" class="close close-sm" data-dismiss="alert">
                <i class="icon-remove"></i>
            </button>
            {{$page['detail']}}
        </div>
        <ul class="grid cs-style-3">
            @foreach($page['result'] as $item)
            <li>
                <figure>
                    <img src="{{ URL::to(json_decode(trim($item['url']))->{'thumbs'}) }}" alt="{{$item['name']}}">                              
                    <figcaption>
                        <a class="fancybox" rel="group" href="{{ URL::to(json_decode(trim($item['url']))->{'photo'}) }}">Take a look</a>
                    </figcaption>
                </figure>
            </li>
            @endforeach
        </ul>

    </div>
</section>
<!-- page end-->
@stop
@section('script_page_only')
{{HTML::script('/assets/fancybox/source/jquery.fancybox.js')}}
{{HTML::script('/js/modernizr.custom.js')}}
{{HTML::script('js/toucheffects.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $(function() {
        //    fancybox
        jQuery(".fancybox").fancybox();
    });
</script>
@stop