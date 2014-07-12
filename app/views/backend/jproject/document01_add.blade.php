@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('/assets/bootstrap-datepicker/css/datepicker.css')}}
{{HTML::style('/assets/bootstrap-fileupload/bootstrap-fileupload.css')}}
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
                        <a href="{{URL::to('/backend/jproject/document')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i>  {{\Lang::get('jproject.back')}}</a>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-success" id="btnSave"><i class="icon-save"></i>  {{\Lang::get('jproject.save')}}</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form','enctype'=>'multipart/form-data')) }}
<div class="row">
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                {{$page['title']}}
            </header>
            <div class="panel-body">
                <div class="form-group">
                    {{Form::label('code', \Lang::get('jproject.code'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('code', $page['code'], array('id'=>'code','class'=>'form-control','disabled')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('jproject.title'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-10">
                        {{ Form::text('name', Input::old('name'), array('id'=>'name','class'=>'form-control')) }}
                    </div>
                </div>

            </div>
        </section>
    </div> 
    <div class="col-lg-6">
        <section class="panel">
            <div class="panel-body">
                <div class="form-group">
                    {{Form::label('project_id', \Lang::get('jproject.project'), array('class' => 'col-lg-3 control-label'));}}
                    <div class="col-lg-8">
                        <select name="project_id" id="project_id" class="form-control">
                            <option selected="selected" value="">{{\Lang::get('common.please_select')}}</option>
                            @foreach (\Project::all() as $item)
                            <option value="{{$item['id']}}">{{$item['name']}}</option>                            
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('code', \Lang::get('jproject.required_completion_date'), array('class' => 'col-lg-3 control-label'));}}
                    <div class="col-lg-5">
                        {{ Form::text('required_completion_date', Input::old('required_completion_date'), array('id'=>'required_completion_date','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">{{\Lang::get('jproject.file_upload')}}</label>
                    <div class="controls col-md-9">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <span class="btn btn-white btn-file">
                                <span class="fileupload-new"><i class="icon-paper-clip"></i> {{\Lang::get('jproject.select_file')}}</span>
                                <span class="fileupload-exists"><i class="icon-undo"></i> {{\Lang::get('jproject.change')}}</span>
                                <input type="file" name="attachments" id="attachments" class="default" />
                            </span>
                            <span class="fileupload-preview" style="margin-left:5px;"></span>
                            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                        </div>
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
                {{\Lang::get('jproject.detail')}}
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label col-sm-2">{{\Lang::get('jproject.detail')}}</label>
                    <div class="col-lg-10">
                        {{ Form::textarea('description', Input::old('description'), array('id'=>'description','class'=>'form-control ckeditor','rows'=>10)) }}
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
{{ Form::hidden('code',$page['code'] ) }}
{{ Form::close() }}
@stop
@section('script_page_only')
{{HTML::script('/assets/ckeditor/ckeditor.js')}}
{{HTML::script('/assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
{{HTML::script('/js/jquery.form.js')}}
{{HTML::script('/assets/bootstrap-fileupload/bootstrap-fileupload.js')}}

@stop
@section('script_page_code')
<script type="text/javascript">
    $('#required_completion_date').datepicker({
        format: 'yyyy-mm-dd'
    });

    $(document).ready(function() {
        $('#code').focus();
        var options = {
            url: base_url + index_page + 'backend/jproject/document/add/01',
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
                    window.location.replace(base_url + index_page + 'backend/jproject/document');
                });
            }, 3000);
        }
    }
</script>
@stop