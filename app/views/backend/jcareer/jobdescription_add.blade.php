@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('theme/backend/default/assets/bootstrap-datepicker/css/datepicker.css')}}
{{HTML::style('theme/backend/default/assets/bootstrap-fileupload/bootstrap-fileupload.css')}}
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
                        <a href="{{URL::to('/backend/jcareer/jobdescription')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i> {{\Lang::get('jcareer.back')}}</a>
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
                    {{Form::label('title', \Lang::get('jcareer.name'), array('class' => 'col-lg-1 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('title', Input::old('title'), array('id'=>'title','class'=>'form-control')) }}
                    </div>
                </div>  
                <div class="form-group">
                    {{Form::label('name', \Lang::get('jcareer.department'), array('class' => 'col-lg-1 control-label'));}}
                    <div class="col-lg-3">
                        {{\Form::select('department_id', array('' => \Lang::get('common.please_select')) +$page['category'], null, array('class' => 'form-control', 'id' => 'department_id'))}}
                    </div>
                </div>
            </div>
        </section>
    </div>    
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('jcareer.detail')}}
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-1 control-label col-sm-1">{{\Lang::get('jcareer.editor')}}</label>
                    <div class="col-lg-10">
                        {{ Form::textarea('description', Input::old('description'), array('id'=>'description','class'=>'form-control ckeditor','rows'=>10)) }}
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
{{ Form::close() }}
@stop
@section('script_page_only')
{{HTML::script('theme/backend/default/assets/ckeditor/ckeditor.js')}}
{{HTML::script('theme/backend/default/js/form-component.js')}}
{{HTML::script('theme/backend/default/assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
{{HTML::script('theme/backend/default/js/jquery.form.js')}}

@stop
@section('script_page_code')
<script type="text/javascript">
    $(document).ready(function() {
        $('#title').focus();
        var options = {
            url: base_url  + 'backend/jcareer/jobdescription/add',
            success: showResponse
        };
        $('#btnSave').click(function() {
            for (instance in CKEDITOR.instances)
                CKEDITOR.instances.description.updateElement();
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
                    window.location.replace(base_url  + 'backend/jcareer/jobdescription');
                });
            }, 3000);
        }
    }
</script>
@stop