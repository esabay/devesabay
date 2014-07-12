@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('theme/backend/default/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css')}}
{{HTML::style('theme/backend/default/css/owl.carousel.css')}}
{{HTML::style('theme/backend/default/assets/fancybox/source/jquery.fancybox.css')}}
@stop
@section('content')
<!--state overview end-->
<section class="panel">
    <div class="carousel slide auto panel-body" id="c-slide">
        <ol class="carousel-indicators out">
            @for ($i = 0; $i < \Post::where('categories_id', 432)->where('disabled',0)->count(); $i++)
            <li data-target="#c-slide" data-slide-to="{{$i}}" class="{{($i == 0 ? 'active' : '')}}"></li>
            @endfor
        </ol>
        <div class="carousel-inner">
            @foreach(\Post::where('categories_id', 432)
            ->where('disabled',0)
            ->take(5)
            ->orderBy('id', 'desc')
            ->get() as $key => $shortnews)
            <div class="item text-center {{($key == 0 ? 'active' : '')}}">
                <h3>{{$shortnews->shortdetail}}</h3>
            </div> 
            @endforeach
        </div>
        <a class="left carousel-control" href="#c-slide" data-slide="prev">
            <i class="icon-angle-left"></i>
        </a>
        <a class="right carousel-control" href="#c-slide" data-slide="next">
            <i class="icon-angle-right"></i>
        </a>
    </div>
</section>
<div class="row">
    <div class="col-lg-6" id="dnews"></div>
    <div class="col-lg-6">
        <!--timeline start-->
        <section class="panel">
            <div class="panel-body">
                <div id="widget_timeline"></div>
            </div>
        </section>
        <!--timeline end-->
    </div>
</div>
@stop
@section('script_page')
{{HTML::script('theme/backend/default/js/jquery.sparkline.js')}}
{{HTML::script('theme/backend/default/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js')}}
{{HTML::script('theme/backend/default/js/owl.carousel.js')}}
{{HTML::script('theme/backend/default/js/jquery.customSelect.min.js')}}
@stop
@section('script_page_only')
{{HTML::script('theme/backend/default/js/sparkline-chart.js')}}
{{HTML::script('theme/backend/default/js/easy-pie-chart.js')}}
{{HTML::script('theme/backend/default/js/count.js')}}
{{HTML::script('theme/backend/default/assets/fancybox/source/jquery.fancybox.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $('.carousel').carousel();
    $(document).ready(function() {
        $(".fancybox").fancybox({
            'width': '75%',
            'height': '75%',
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'type': 'iframe'
        });
        widget({wd: 'dashboard_news', selector: '#dnews'});
        widget({wd: 'timeline', selector: '#widget_timeline'});
        setInterval(function() {
            widget({wd: 'dashboard_news', selector: '#dnews'});
            widget({wd: 'timeline', selector: '#widget_timeline'});
        }, 60000);
    });


</script>
@stop