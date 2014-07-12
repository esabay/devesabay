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
                        <a href="{{URL::to('/backend/post')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i> {{\Lang::get('post.back')}}</a>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-success" id="btnSave"><i class="icon-save"></i> {{\Lang::get('post.save')}}</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="row">
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                {{$page['title']}}
            </header>
            <div class="panel-body">

                <div class="form-group">
                    {{Form::label('name', \Lang::get('post.title'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-10">
                        {{ Form::text('name',$page['item']->name, array('id'=>'name','placeholder' => 'Page Name','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('post.group'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-10">
                        {{\Form::select('categories_id', array('' => 'Please Select.') + $page['category'], $page['item']->categories_id, array('class' => 'form-control', 'id' => 'categories_id'))}}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('post.short_detail'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-10">
                        {{ Form::textarea('shortdetail', $page['item']->shortdetail, array('id'=>'shortdetail','class'=>'form-control','cols'=>50,'rows'=>10)) }}
                    </div>
                </div>
                <span class="label label-danger">คำแนะนำ</span>
                <span>ถ้าต้องการแจ้ง <strong>ข่าวสารแบบสั้น</strong> กรุณากรอกเฉพาะ รายละเอียดแบบย่อ</span>          
            </div>
        </section>
    </div>
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('post.setting_page')}}
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label col-md-2">{{\Lang::get('post.image_cover')}}</label>
                    <div class="col-md-8">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                @if($page['item']->imgcover=='')
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                @else
                                <img src="{{ URL::to(json_decode(trim($page['item']->imgcover))->{'cover'}) }}" alt="">
                                @endif
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                    <span class="fileupload-new"><i class="icon-paper-clip"></i> {{\Lang::get('post.select_image')}}</span>
                                    <span class="fileupload-exists"><i class="icon-undo"></i> {{\Lang::get('post.chang')}}</span>
                                    <input type="file" name="imgcover" id="imgcover" class="default" />
                                </span>
                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> {{\Lang::get('post.remove')}}</a>
                            </div>
                        </div>
                        <span class="label label-danger">NOTE!</span>
                        <span>
                            ขนาดที่เหมาะสมคือ 370x200 px
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <div class="checkbox">
                            <label>
                                {{Form::checkbox('disabled', 0,($page['item']->disabled == 0 ? true : false))}} {{\Lang::get('post.publish')}}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <div class="checkbox">
                            <label>
                                {{Form::checkbox('frontend', 0,($page['item']->frontend == 0 ? true : false))}} {{\Lang::get('post.frontend')}}
                            </label>
                        </div>
                    </div>
                </div> 
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <div class="checkbox">
                            <label>
                                {{Form::checkbox('stylepage', 0,($page['item']->stylepage == 0 ? true : false))}} {{\Lang::get('post.full_page')}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                SEO Setting
            </header>
            <div class="panel-body">
                <div class="form-group">
                    {{Form::label('seo_title', 'Title', array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-10">
                        {{ Form::text('seo_title', $page['item']->seo_title, array('id'=>'seo_title','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('seo_keyword', 'Keyword', array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-10">
                        {{ Form::text('seo_keyword', $page['item']->seo_keyword, array('id'=>'seo_keyword','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('seo_description', 'Description', array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-10">
                        {{ Form::textarea('seo_description',$page['item']->seo_description, array('id'=>'seo_description','class'=>'form-control','cols'=>50,'rows'=>3)) }}
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('post.tags')}}
            </header>
            <div class="panel-body">
                <div class="form-group">
                    {{Form::label('name', \Lang::get('post.tags'), array('class' => 'col-lg-2 col-sm-2 control-label'));}}
                    <div class="col-lg-10">
                        {{ Form::text('tagsinput', $page['item']->tagsinput, array('id'=>'tagsinput','class'=>'tagsinput')) }}
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    {{Form::label('name', \Lang::get('post.start_view'), array('class' => 'col-lg-2 col-sm-2 control-label'));}}
                    <div class="col-lg-10">
                        {{ Form::text('startdate', $page['item']->startdate, array('id'=>'startdate','class'=>'form-control')) }}
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
                {{\Lang::get('post.detail')}}
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label col-sm-2">{{\Lang::get('post.editor')}}</label>
                    <div class="col-lg-10">
                        {{ Form::textarea('detail', $page['item']->detail, array('id'=>'detail','class'=>'form-control ckeditor','rows'=>10)) }}
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
{{HTML::script('theme/backend/default/js/jquery.tagsinput.js')}}
{{HTML::script('theme/backend/default/js/form-component.js')}}
{{HTML::script('theme/backend/default/assets/bootstrap-fileupload/bootstrap-fileupload.js')}}
{{HTML::script('theme/backend/default/assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
{{HTML::script('theme/backend/default/js/jquery.form.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $('#startdate').datepicker({
        format: 'yyyy-mm-dd'
    });
    $(".tagsinput, #seo_keyword").tagsInput();
    $(document).ready(function() {
        var options = {
            url: base_url  + 'backend/post/edit',
            success: showResponse,
            dataType: 'json'
        };
        $('#btnSave').click(function() {
            for (instance in CKEDITOR.instances)
                CKEDITOR.instances.detail.updateElement();
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
                    window.location.replace(base_url  + 'backend/post');
                });
            }, 3000);
        }
    }
</script>
@stop