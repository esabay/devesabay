@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('/css/tasks.css')}}
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <section class="panel tasks-widget">
            <header class="panel-heading">
                Notification
            </header>
            <div class="panel-body">

                <div class="task-content">

                    <ul class="task-list">
                        @foreach ($page['result'] as $item)
                        <li>
                            <div class="task-title">
                                <span class="task-title-sp">{{$item->title}}</span>
                                <span class="badge badge-sm label-success">{{$item->created_at->diffForHumans()}}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>


@stop
@section('script_page_only')
{{HTML::script('/js/tasks.js')}}
@stop