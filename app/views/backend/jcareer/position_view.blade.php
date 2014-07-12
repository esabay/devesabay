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
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{$page['item']->title}}
            </header>
        </section>

    </div>
</div>
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
@if(\Careerposition::where('department_id',$page['item']->department_id)->count()>0)
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('jcareer.job_position_other')}}
            </header>
            <table class="table table-striped border-top" id="sample_1">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{\Lang::get('jcareer.position')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jcareer.amount')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jcareer.job_type')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jcareer.salary')}}</th>
                        <th><i class=" icon-edit"></i> {{\Lang::get('jcareer.status')}}</th>
                        <th class="hidden-phone">{{\Lang::get('common.created_user')}}</th>
                        <th class="hidden-phone">{{\Lang::get('common.created')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (\Careerposition::where('department_id',$page['item']->department_id)->where('id','!=',$page['item']->id)->get() as $item)
                    <tr class="odd gradeX">
                        <td><a href="{{\URL::to('backend/jcareer/position/view/'.$item->id)}}" target="_blank" class="btn btn-mini btn-primary"><i class="icon-eye-open"></i></a></td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->amount}}</td>
                        <td>{{\Careerposition::getType($item->type)}}</td>
                        <td>{{$item->salary}}</td>
                        <td>
                            @if($item->disabled == 0)
                            <span class="label label-success label-mini">Show</span>
                            @else
                            <span class="label label-warning label-mini">hidden</span>
                            @endif
                        </td>
                        <td>
                            {{\User::getUsername($item->created_user)}}
                        </td>
                        <td>
                            {{$item->created_at}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
</div>
@endif
@stop