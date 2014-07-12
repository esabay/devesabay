@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('theme/backend/default/assets/bootstrap-datepicker/css/datepicker.css')}}
{{HTML::style('theme/backend/default/assets/bootstrap-fileupload/bootstrap-fileupload.css')}}
{{HTML::style('theme/backend/default/css/bootstrap-wysihtml5-0.0.2.css')}}
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
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <!--                
                -->
                <div class="form-actions">
                    <div class="pull-left">
                        <a href="{{URL::to('/backend/jcareer/position')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i> {{\Lang::get('jcareer.back')}}</a>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-success" id="btnSave"><i class="icon-save"></i> {{\Lang::get('jcareer.save')}}</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{$page['title']}}
            </header>
            <div class="panel-body">

                <div class="form-group">
                    {{Form::label('title', \Lang::get('jcareer.position'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-5">
                        {{ Form::text('title', $page['item']->title, array('id'=>'title','class'=>'form-control')) }}
                    </div>
                </div> 
                <div class="form-group">
                    {{Form::label('name', \Lang::get('jcareer.department'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-3">
                        {{\Form::select('department_id', $page['department'], $page['item']->department_id, array('class' => 'form-control', 'id' => 'department_id'))}}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('amount', \Lang::get('jcareer.amount'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-1">
                        {{ Form::text('amount', $page['item']->amount, array('id'=>'amount','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('jcareer.job_type'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-3">
                        {{Form::select('type', array('' => \Lang::get('common.please_select')) + 
                                            array(
                                            '0' => \Lang::get('jcareer.job_type1'),
                                            '1' => \Lang::get('jcareer.job_type2'),
                                            '2' => \Lang::get('jcareer.job_type3'),
                                            '3' => \Lang::get('jcareer.job_type4')
                                            ), $page['item']->type,array('class' => 'form-control', 'id' => 'type'))}}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('salary', \Lang::get('jcareer.salary'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-2">
                        {{ Form::text('salary', $page['item']->salary, array('id'=>'salary','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('place', \Lang::get('jcareer.place'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('place', $page['item']->place, array('id'=>'place','class'=>'form-control')) }}
                    </div>
                </div> 
                <div class="form-group">
                    {{Form::label('job_qualification', \Lang::get('jcareer.job_qualification'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-8">
                        {{ Form::textarea('qualification', $page['item']->qualification, array('id'=>'qualification','class' => 'form-control', 'cols' => 50, 'rows' => 10,'style'=>'white-space:pre-wrap;')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('benefit', \Lang::get('jcareer.benefit'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-8">
                        {{ Form::textarea('benefit', $page['item']->benefit, array('id'=>'benefit','class' => 'form-control', 'cols' => 50, 'rows' => 10,'style'=>'white-space:pre-wrap;')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('job_description', \Lang::get('jcareer.job_description'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-8">
                        {{ Form::textarea('description', $page['item']->description, array('id'=>'description','class' => 'form-control', 'cols' => 50, 'rows' => 15,'style'=>'white-space:pre-wrap;')) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <div class="checkbox">
                            <label>
                                {{Form::checkbox('disabled', 0,($page['item']->disabled == 0 ? true : false))}} {{\Lang::get('post.publish')}}
                            </label>
                            <span class="label label-danger">NOTE!</span>
                            <span>
                                {{\Lang::get('jcareer.note_publish')}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>    
</div>
{{ Form::hidden('id', $page['item']->id) }}
{{ Form::close() }}
@stop
@section('script_page_only')
{{HTML::script('theme/backend/default/assets/ckeditor/ckeditor.js')}}
{{HTML::script('theme/backend/default/js/form-component.js')}}
{{HTML::script('theme/backend/default/assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
{{HTML::script('theme/backend/default/js/jquery.form.js')}}
{{HTML::script('theme/backend/default/js/wysihtml5-0.3.0_rc2.js')}}
{{HTML::script('theme/backend/default/js/bootstrap-wysihtml5-0.0.2.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $(document).ready(function() {
        $('#title').focus();
        $('#qualification, #benefit, #description').wysihtml5({
            "link": false,
            "image": false
        });
        var options = {
            url: base_url  + 'backend/jcareer/position/edit',
            success: showResponse
        };
        $('#btnSave').click(function() {
            $('#form-add').ajaxSubmit(options);
            return false;
        });
    });
    function showResponse(response, statusText, xhr, $form) {
        $('form .form-group').removeClass('has-error');
        $('form .help-block').remove();
        if (response.error.status === false) {
            $.each(response.error.message, function(key, value) {
                $('#' + key).parent().parent().addClass('has-error');
                $('#' + key).after('<p class="help-block">' + value + '</p>');
            });
        } else {
            var data = {
                title: 'Message',
                text: '<div class="text-center"><p><img src="' + base_url + 'img/ajax-loader.gif" /></p>' + response.error.message + '</div>',
                type: 'alert'
            };
            genModal(data);
            setTimeout(function() {
                $('#myModal').modal('hide');
                $('#myModal').on('hidden.bs.modal', function() {
                    window.location.replace(base_url  + 'backend/jcareer/position');
                });
            }, 3000);
        }
    }
</script>
@stop