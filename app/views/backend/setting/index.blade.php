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
                    <div class="pull-right">
                        <button type="button" class="btn btn-success" id="btnSave"><i class="icon-save"></i> {{\Lang::get('post.save')}}</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading tab-bg-dark-navy-blue ">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#general" data-toggle="tab">General</a>
                    </li>
                    <li class="">
                        <a href="#email" data-toggle="tab">Email</a>
                    </li>                    
                </ul>
            </header>
            {{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="general">
                        <h3>Site Settings</h3>
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label" for="inputEmail1">Site Name</label>
                            <div class="col-lg-5">
                                <input type="text" id="site_name" name="site_name" value="{{$page['item']->site_name}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label col-lg-2">Site Offline</label>
                            <div class="col-lg-6">
                                <div class="input-group m-bot15">
                                    <span class="input-group-addon">
                                        {{Form::checkbox('site_offline', 0,($page['item']->site_offline == 0 ? true : false))}}
                                    </span>
                                    <input type="text" placeholder="Offline Message" name="offline_message" value="{{$page['item']->offline_message}}" class="form-control">
                                </div>
                            </div>
                        </div>                           
                        <h3>Metadata Settings</h3>
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label" for="meta_description">Site Meta Description</label>
                            <div class="col-lg-6">
                                {{ Form::textarea('meta_description',$page['item']->description, array('id'=>'meta_description','class'=>'form-control','cols'=>20,'rows'=>8)) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label" for="meta_keywords">Site Meta Keywords</label>
                            <div class="col-lg-8">
                                <input type="text" id="meta_keywords" name="meta_keywords" value="{{$page['item']->keywords}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="email">
                        <h3>Email Settings</h3>
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label" for="driver">Driver</label>
                            <div class="col-lg-3">
                                <input type="text" id="driver" name="driver" value="{{$page['item']->driver}}" class="form-control">
                                <p class="help-block">Supported: "smtp", "mail", "sendmail"</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label" for="host">Host</label>
                            <div class="col-lg-3">
                                <input type="text" id="host" name="host" value="{{$page['item']->host}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label" for="port">Port</label>
                            <div class="col-lg-1">
                                <input type="text" id="port" name="port" value="{{$page['item']->port}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label" for="from_address">Form Address</label>
                            <div class="col-lg-3">
                                <input type="text" id="from_address" name="from_address" value="{{$page['item']->from_address}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label" for="form_name">Form Name</label>
                            <div class="col-lg-3">
                                <input type="text" id="form_name" name="form_name" value="{{$page['item']->form_name}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label" for="username">Username</label>
                            <div class="col-lg-3">
                                <input type="text" id="username" name="username" value="{{$page['item']->username}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label" for="password">Password</label>
                            <div class="col-lg-3">
                                <input type="text" id="password" name="password" value="{{$page['item']->password}}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::hidden('id', $page['item']->id) }}
            {{ Form::close() }}
        </section>
    </div>
</div>
@stop
@section('script_page')

@stop
@section('script_page_only')
{{HTML::script('/js/jquery.form.js')}}
{{HTML::script('/js/jquery.tagsinput.js')}}
@stop

@section('script_page_code')
<script type="text/javascript">
    $("#meta_keywords").tagsInput();

    $('#btnSave').click(function() {
        var options = {
            url: base_url + index_page + 'backend/setting',
            success: showResponse
        };
        $('#form-add').ajaxSubmit(options);
        return false;
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
                    window.location.href = base_url + index_page + 'backend/setting';
                });
            }, 3000);
        }
    }
</script>
@stop