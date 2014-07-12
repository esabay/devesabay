@extends('backend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            @foreach ($page['breadcrumbs'] as $key => $val)
            @if ($val === reset($page['breadcrumbs']))
            <li><a href="{{URL::to($val)}}"><i class="icon-home"></i> {{$key}}</a></li>
            @elseif ($val === end($page['breadcrumbs']))
            <li class="active">{{$key}}</li>
            @else
            <li><a href="{{URL::to($val)}}"> {{$key}}</a></li>
            @endif
            @endforeach
        </ul>
        <!--breadcrumbs end -->
    </div>
</div>
<!--state overview start-->
<div class="row state-overview">
    <div id="state_newuser"></div>
    <div id="state_sale"></div>
    <div id="state_neworder"></div>
    <div id="state_totalprofit"></div>
</div>
<!--state overview end-->
<div class="row">
    <div class="col-lg-8">
        <!--custom chart start-->
        <div class="border-head">
            <h3>สถิติยอดขายประจำเดือน</h3>
        </div>
        <div class="custom-bar-chart">
            <ul class="y-axis">
                <li><span>100</span></li>
                <li><span>80</span></li>
                <li><span>60</span></li>
                <li><span>40</span></li>
                <li><span>20</span></li>
                <li><span>0</span></li>
            </ul>
            <div class="bar">
                <div class="title">JAN</div>
                <div class="value tooltips" data-original-title="80%" data-toggle="tooltip" data-placement="top">80%</div>
            </div>
            <div class="bar ">
                <div class="title">FEB</div>
                <div class="value tooltips" data-original-title="50%" data-toggle="tooltip" data-placement="top">50%</div>
            </div>
            <div class="bar ">
                <div class="title">MAR</div>
                <div class="value tooltips" data-original-title="40%" data-toggle="tooltip" data-placement="top">40%</div>
            </div>
            <div class="bar ">
                <div class="title">APR</div>
                <div class="value tooltips" data-original-title="55%" data-toggle="tooltip" data-placement="top">55%</div>
            </div>
            <div class="bar">
                <div class="title">MAY</div>
                <div class="value tooltips" data-original-title="20%" data-toggle="tooltip" data-placement="top">20%</div>
            </div>
            <div class="bar ">
                <div class="title">JUN</div>
                <div class="value tooltips" data-original-title="39%" data-toggle="tooltip" data-placement="top">39%</div>
            </div>
            <div class="bar">
                <div class="title">JUL</div>
                <div class="value tooltips" data-original-title="75%" data-toggle="tooltip" data-placement="top">75%</div>
            </div>
            <div class="bar ">
                <div class="title">AUG</div>
                <div class="value tooltips" data-original-title="45%" data-toggle="tooltip" data-placement="top">45%</div>
            </div>
            <div class="bar ">
                <div class="title">SEP</div>
                <div class="value tooltips" data-original-title="50%" data-toggle="tooltip" data-placement="top">50%</div>
            </div>
            <div class="bar ">
                <div class="title">OCT</div>
                <div class="value tooltips" data-original-title="42%" data-toggle="tooltip" data-placement="top">42%</div>
            </div>
            <div class="bar ">
                <div class="title">NOV</div>
                <div class="value tooltips" data-original-title="60%" data-toggle="tooltip" data-placement="top">60%</div>
            </div>
            <div class="bar ">
                <div class="title">DEC</div>
                <div class="value tooltips" data-original-title="90%" data-toggle="tooltip" data-placement="top">90%</div>
            </div>
        </div>
        <!--custom chart end-->
    </div>
    <div class="col-lg-4">
        <!--new earning start-->
        <div class="panel terques-chart">
            <div class="panel-body chart-texture">
                <div class="chart">
                    <div class="heading">
                        <span>Friday</span>
                        <strong>$ 57,00 | 15%</strong>
                    </div>
                    <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,564,455]"></div>
                </div>
            </div>
            <div class="chart-tittle">
                <span class="title">New Earning</span>
                <span class="value">
                    <a href="#" class="active">Market</a>
                    |
                    <a href="#">Referal</a>
                    |
                    <a href="#">Online</a>
                </span>
            </div>
        </div>
        <!--new earning end-->

        <!--total earning start-->
        <div class="panel green-chart">
            <div class="panel-body">
                <div class="chart">
                    <div class="heading">
                        <span>June</span>
                        <strong>23 Days | 65%</strong>
                    </div>
                    <div id="barchart"></div>
                </div>
            </div>
            <div class="chart-tittle">
                <span class="title">Total Earning</span>
                <span class="value">$, 76,54,678</span>
            </div>
        </div>
        <!--total earning end-->
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <!--widget start-->
        <section class="panel">
            <header class="panel-heading tab-bg-dark-navy-blue">
                <ul class="nav nav-tabs nav-justified ">
                    <li class="active">
                        <a href="#popular" data-toggle="tab">
                            Popular
                        </a>
                    </li>
                    <li>
                        <a href="#comments" data-toggle="tab">
                            Comments
                        </a>
                    </li>
                    <li class="">
                        <a href="#recent" data-toggle="tab">
                            Recents
                        </a>
                    </li>
                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content tasi-tab">
                    <div class="tab-pane active" id="popular">
                        <article class="media">
                            <a class="pull-left thumb p-thumb">
                                <img src="{{URL::to('theme/backend/default/img/product1.jpg')}}">
                            </a>
                            <div class="media-body">
                                <a class=" p-head" href="#">Item One Tittle</a>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </article>
                        <article class="media">
                            <a class="pull-left thumb p-thumb">
                                <img src="{{URL::to('theme/backend/default/img/product2.png')}}">
                            </a>
                            <div class="media-body">
                                <a class=" p-head" href="#">Item Two Tittle</a>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </article>
                        <article class="media">
                            <a class="pull-left thumb p-thumb">
                                <img src="{{URL::to('theme/backend/default/img/product3.png')}}">
                            </a>
                            <div class="media-body">
                                <a class=" p-head" href="#">Item Three Tittle</a>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </article>
                    </div>
                    <div class="tab-pane" id="comments">
                        <article class="media">
                            <a class="pull-left thumb p-thumb">
                                <img src="{{URL::to('theme/backend/default/img/avatar-mini.jpg')}}">
                            </a>
                            <div class="media-body">
                                <a class="cmt-head" href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                <p> <i class="icon-time"></i> 1 hours ago</p>
                            </div>
                        </article>
                        <article class="media">
                            <a class="pull-left thumb p-thumb">
                                <img src="{{URL::to('theme/backend/default/img/avatar-mini2.jpg')}}">
                            </a>
                            <div class="media-body">
                                <a class="cmt-head" href="#">Nulla vel metus scelerisque ante sollicitudin commodo</a>
                                <p> <i class="icon-time"></i> 23 mins ago</p>
                            </div>
                        </article>
                        <article class="media">
                            <a class="pull-left thumb p-thumb">
                                <img src="{{URL::to('theme/backend/default/img/avatar-mini3.jpg')}}">
                            </a>
                            <div class="media-body">
                                <a class="cmt-head" href="#">Donec lacinia congue felis in faucibus. </a>
                                <p> <i class="icon-time"></i> 15 mins ago</p>
                            </div>
                        </article>
                    </div>
                    <div class="tab-pane " id="recent">
                        Recent Item goes here
                    </div>
                </div>
            </div>
        </section>
        <!--widget end-->

        <!--widget start-->
        <div class=" state-overview">
            <section class="panel">
                <div class="symbol red">
                    <i class="icon-tags"></i>
                </div>
                <div class="value">
                    <h1>140</h1>
                    <p>Sales</p>
                </div>
            </section>
        </div>
        <!--widget end-->
    </div>
</div>
@stop
@section('script_page')

@stop
@section('script_page_only')
{{HTML::script('theme/backend/default/js/jquery.sparkline.js')}}
{{HTML::script('theme/backend/default/js/sparkline-chart.js')}}
{{HTML::script('theme/backend/default/js/count.js')}}
@stop

@section('script_page_code')
<script type="text/javascript">
    $(function() {
        widget({wd: 'state_newuser', selector: '#state_newuser'});
        widget({wd: 'state_sale', selector: '#state_sale'});
        widget({wd: 'state_neworder', selector: '#state_neworder'});
        widget({wd: 'state_totalprofit', selector: '#state_totalprofit'});
    });
</script>
@stop