@extends('backend.layouts.master_front')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <h1>{{$page['item']->title}}</h1>
                <hr />
                <h4>{{\Lang::get('jcareer.amount')}}</h4>
                {{$page['item']->amount}} {{\Lang::get('jcareer.job_amount')}}
                <h4>{{\Lang::get('jcareer.job_type')}}</h4>
                {{\Careerposition::getType($page['item']->type)}}
                <h4>{{\Lang::get('jcareer.job_qualification')}}</h4>
                {{$page['item']->qualification}}

                @if($page['item']->place)
                <h4>{{\Lang::get('jcareer.place')}}</h4>
                {{$page['item']->place}}
                @endif
                <h4>{{\Lang::get('jcareer.job_description')}}</h4>
                {{$page['item']->description}}
                @if($page['item']->salary)
                <h4>{{\Lang::get('jcareer.salary')}}</h4>
                {{$page['item']->salary}}
                @endif
                @if($page['item']->benefit)
                <h4>{{\Lang::get('jcareer.benefit')}}</h4>
                {{$page['item']->benefit}}
                @endif
            </div>
        </section>

    </div>
</div>
@stop