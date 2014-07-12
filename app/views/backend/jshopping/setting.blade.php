@extends('backend.layouts.master')
@section('stylesheet_page_only')
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
                        <a href="{{URL::to('/backend/jshopping')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i> Back</a>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-success" id="btnSave"><i class="icon-plus"></i> Save</button>
                        <button type="button" class="btn"><i class="icon-remove"></i> Cancel</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form','enctype'=>'multipart/form-data')) }}

{{ Form::close() }}
@stop
@section('script_page_only')
{{HTML::script('theme/backend/default/assets/ckeditor/ckeditor.js')}}
{{HTML::script('theme/backend/default/js/jquery.tagsinput.js')}}
{{HTML::script('theme/backend/default/js/form-component.js')}}
{{HTML::script('theme/backend/default/assets/bootstrap-fileupload/bootstrap-fileupload.js')}}
{{HTML::script('theme/backend/default/js/jquery.form.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $(".tags").tagsInput();
    $(document).ready(function() {
        var options = {
            url: base_url + 'backend/jshopping/product/add',
            success: showResponse
        };
        $('#btnSave').click(function() {
            for (instance in CKEDITOR.instances)
                CKEDITOR.instances.Detail.updateElement();
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
                text: '<div class="text-center"><p><img src="' + base_url + 'theme/backend/default/img/ajax-loader.gif" /></p>' + response.error.message + '</div>',
                type: 'alert'
            };
            genModal(data);
            setTimeout(function() {
                $('#myModal').modal('hide');
                $('#myModal').on('hidden.bs.modal', function() {
                    window.location.replace(base_url + 'backend/jshopping/product');
                });
            }, 3000);
        }
    }
</script>
@stop