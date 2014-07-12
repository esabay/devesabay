@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('theme/backend/default/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css')}}
@stop
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
<div class="row">
    <aside class="col-lg-3">
        <h4 class="drg-event-title"> Draggable Events</h4>
        <div id='external-events'>
            <div class='external-event label label-primary'>My Event 1</div>
            <div class='external-event label label-success'>My Event 2</div>
            <div class='external-event label label-info'>My Event 3</div>
            <div class='external-event label label-inverse'>My Event 4</div>
            <div class='external-event label label-warning'>My Event 5</div>
            <div class='external-event label label-danger'>My Event 6</div>
            <div class='external-event label label-default'>My Event 7</div>
            <div class='external-event label label-primary'>My Event 8</div>
            <div class='external-event label label-info'>My Event 9</div>
            <div class='external-event label label-success'>My Event 10</div>
            <p class="border-top drp-rmv">
                <input type='checkbox' id='drop-remove' />
                remove after drop
            </p>
        </div>
    </aside>
    <aside class="col-lg-9">
        <section class="panel">
            <div class="panel-body">
                <div id="calendar" class="has-toolbar"></div>
            </div>
        </section>
    </aside>
</div>
@stop
@section('script_page_only')
{{HTML::script('theme/backend/default/js/jquery-ui-1.9.2.custom.min.js')}}
{{HTML::script('theme/backend/default/assets/fullcalendar/fullcalendar/fullcalendar.min.js')}}
{{HTML::script('theme/backend/default/js/external-dragging-calendar.js')}}
@stop