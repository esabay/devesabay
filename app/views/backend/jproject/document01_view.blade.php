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
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <!--                
                -->
                <div class="form-actions">
                    <div class="pull-left">
                        <a href="{{URL::to('/backend/jproject/document')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i> {{Lang::get('common.back')}}</a>
                    </div>
                    @if(\User::checkLevel())
                    <div class="pull-right">
                        <button type="button" class="btn btn-success {{($page['item3']!=NULL ? 'disabled' : '')}}" id="btnAdd02"><i class="icon-plus"></i> Add SRS Form</button>
                        @if($page['item3']!=NULL)
                        <button type="button" class="btn btn-warning" id="btnEdit02"><i class="icon-edit"></i> Edit SRS Form</button>
                        <button type="button" class="btn btn-info" id='btnPrint02'><i class="icon-print"></i> Print SRS Form</button>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <!--user info table start-->
        <section class="panel">
            <div class="panel-body">
                <a href="#" class="task-thumb">
                    <img src="{{\URL::to(\User::getAvatar($page['item']->contact_id))}}" width="90" alt="">
                </a>
                <div class="task-thumb-details">
                    <h1><a href="#">{{\User::getFullName($page['item']->contact_id)}}</a></h1>
                    <p>{{\Lang::get('user.position')}} : {{\User::getPosition($page['item']->contact_id)}}</p>
                </div>
            </div>
            <table class="table table-hover personal-task">
                <tbody>
                    <tr>
                        <td>{{Lang::get('security.department')}}</td>
                        <td> {{\User::getDepartment($page['item']->contact_id)}}</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <!--user info table end-->
    </div>
    <div class="col-lg-8">
        <section class="panel">
            <header class="panel-heading">
                {{$page['item']->code}}-{{$page['item']->name}}
            </header>
            <div class="panel-body">
                <ul>
                    <li>Project : {{$page['item']->projectname}}</li>
                    <li>Required Completion Date : {{date("d F Y", strtotime($page['item']->required_completion_date))}}</li>
                    @if($page['item2']!=NULL)
                    <li>Attachments File : <a href="{{\URL::to($page['item2'][0]->url)}}" target="_blank">Download</a></li>
                    @endif
                </ul>
                <hr />
                {{$page['item']->description}}
                <hr />
                Created : {{$page['item']->created_at}}
            </div>
        </section>
    </div>
</div>
@if($page['item3']!=NULL)
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading no-border">
                            System Requirements Specification Form
                        </header>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Function</td>
                                    <td colspan="2">{{$page['item3']->functions}}</td>
                                </tr>
                                <tr>
                                    <td>Brief Description</td>
                                    <td colspan="2">{{$page['item3']->brief_des}}</td>
                                </tr>
                                <tr>
                                    <td>Input</td>
                                    <td colspan="2">{{$page['item3']->input}}</td>
                                </tr>
                                <tr>
                                    <td>Source</td>
                                    <td colspan="2">{{$page['item3']->source}}</td>
                                </tr>
                                <tr>
                                    <td>Output</td>
                                    <td colspan="2">{{$page['item3']->output}}</td>
                                </tr>
                                <tr>
                                    <td>Requires</td>
                                    <td colspan="2">{{$page['item3']->requires}}</td>
                                </tr>
                                </tr>
                                <tr>
                                    <td>Stakeholder</td>
                                    <td colspan="2">{{$page['item3']->stakeholder}}</td>
                                </tr>
                                </tr>
                                <tr>
                                    <td>Precondition</td>
                                    <td colspan="2">{{$page['item3']->precondition}}</td>
                                </tr>
                                </tr>
                                <tr>
                                    <td>Postcondition</td>
                                    <td colspan="2">{{$page['item3']->postcondition}}</td>
                                </tr>
                                </tr>
                                <tr>
                                    <td>Main Flow</td>
                                    <td>
                                        {{$page['item3']->main_flow1}}
                                    </td>
                                    <td>
                                        {{$page['item3']->main_flow2}}
                                    </td>
                                </tr>
                                </tr>
                                <tr>
                                    <td>Exception Condition</td>
                                    <td colspan="2">{{$page['item3']->exception_condition}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </section>
    </div>
</div>
@endif
@stop
@section('script_page_code')
<script type="text/javascript">
    $('#btnAdd02').click(function() {
        var data = {
            url: 'backend/jproject/document/add/02/{{\Request::segment(6)}}',
            title: 'Add System Requirements Specification Form'
        };
        genModal(data);
    });

    $('#btnEdit02').click(function() {
        var data = {
            url: 'backend/jproject/document/edit/02/{{($page['item3']!=NULL ? $page['item3']->id : '')}}',
            title: 'Edit System Requirements Specification Form'
        };
        genModal(data);
    });
</script>
@stop