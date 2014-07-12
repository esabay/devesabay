@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('theme/backend/default/assets/bootstrap-fileupload/bootstrap-fileupload.css')}}
{{HTML::style('theme/backend/default/css/bootstrap-wysihtml5-0.0.2.css')}}
{{HTML::style('theme/backend/default/assets/dropzone/css/dropzone.css')}}
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
                        <a href="{{URL::to('/backend/posting/post')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i>  {{\Lang::get('common.back')}}</a>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-success" id="btnSave"><i class="icon-save"></i>  {{\Lang::get('common.save')}}</button>                        
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form','enctype'=>'multipart/form-data')) }}
<div class="row">
    <div class="col-lg-7">
        <section class="panel">
            <header class="panel-heading">
                {{$page['title']}} {{$page['cat'][0]}}
            </header>
            <div class="panel-body">

                <div class="form-group">
                    {{Form::label('title', \Lang::get('posting.title'), array('class' => 'col-lg-3 control-label'));}}
                    <div class="col-lg-9">
                        {{ Form::text('title', $page['item']->title, array('id'=>'title','class'=>'form-control')) }}
                    </div>
                </div>                
                <div class="form-group">
                    {{Form::label('name', \Lang::get('posting.group'), array('class' => 'col-lg-3 control-label'));}}
                    <div class="col-lg-6">
                        {{\Form::select('categories_id[]', $page['category'], $page['cat'][0], array('class' => 'form-control', 'id' => 'categories_id'))}}
                    </div>
                </div>
                <div class="form-group" style="display: none;">
                    <label class="col-lg-3 control-label" for="price">&nbsp;</label>
                    <div class="col-lg-6">
                        <select name="categories_id[]" id="sub1" class="form-control">
                            <option selected="selected" value="">{{\Lang::get('common.please_select')}}</option>                            
                        </select>
                    </div>
                </div>
                <div class="form-group" style="display: none;">
                    <label class="col-lg-3 control-label" for="price">&nbsp;</label>
                    <div class="col-lg-6">
                        <select name="categories_id[]" id="sub2" class="form-control">
                            <option selected="selected" value="">{{\Lang::get('common.please_select')}}</option>                            
                        </select>
                    </div>
                </div>
                <div class="form-group" style="display: none;">
                    <label class="col-lg-3 control-label" for="price">&nbsp;</label>
                    <div class="col-lg-6">
                        <select name="categories_id[]" id="sub3" class="form-control">
                            <option selected="selected" value="">{{\Lang::get('common.please_select')}}</option>                            
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('price', \Lang::get('posting.price'), array('class' => 'col-lg-3 control-label'));}}
                    <div class="col-lg-3">
                        {{ Form::text('price', $page['item']->price, array('id'=>'price','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('description', \Lang::get('posting.description'), array('class' => 'col-lg-3 control-label'));}}
                    <div class="col-lg-9">
                        {{ Form::textarea('description', $page['item']->description, array('id'=>'description','class' => 'form-control', 'cols' => 50, 'rows' => 10,'style'=>'white-space:pre-wrap;')) }}
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-5">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('posting.posting_adds')}}
            </header>
            <div class="panel-body">
                <div class="form-group">
                    {{Form::label('province', \Lang::get('posting.province'), array('class' => 'col-lg-3 control-label'));}}
                    <div class="col-lg-6">
                        {{ \Form::select('province',DB::table('province')
                                ->orderBy('PROVINCE_NAME', 'asc')
                                ->lists('PROVINCE_NAME', 'PROVINCE_ID'), $page['item']->province, array('class' => 'form-control', 'id' => 'province')); }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('amphur', \Lang::get('posting.amphur'), array('class' => 'col-lg-3 control-label'));}}
                    <div class="col-lg-6">
                        {{ \Form::select('amphur', array('' => \Lang::get('common.please_select')), null, array('class' => 'form-control', 'id' => 'amphur'));}}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('zipcode', \Lang::get('posting.zipcode'), array('class' => 'col-lg-3 control-label'));}}
                    <div class="col-lg-3">
                        {{ Form::text('zipcode',$page['item']->zipcode, array('id'=>'zipcode','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('mobile', \Lang::get('posting.mobile'), array('class' => 'col-lg-3 control-label'));}}
                    <div class="col-lg-3">
                        {{ Form::text('mobile',$page['item']->mobile, array('id'=>'mobile','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('tags', \Lang::get('posting.tags'), array('class' => 'col-lg-3 control-label'));}}
                    <div class="col-lg-9">
                        {{ Form::text('tags',$page['item']->tags, array('id'=>'tags','class'=>'tags')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label" for="price">&nbsp;</label>
                    <div class="col-lg-8">
                        <span class="label label-danger">คำแนะนำ</span>
                        <span>
                            {{\Lang::get('posting.tags_help')}}
                        </span>
                    </div>
                </div>                
                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-8">
                        <div class="checkbox">
                            <label>
                                {{Form::checkbox('disabled', 0,($page['item']->disabled == 0 ? true : false))}} {{\Lang::get('common.publish')}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="row">
    @for ($i = 0; $i < 8; $i++)
    <div class="col-lg-3">
        <section class="panel">
            <div class="panel-body">
                <div class="form-group last">
                    {{Form::label('photo', \Lang::get('posting.photo'), array('class' => 'col-lg-3 control-label'));}} 
                    <?php
                    if (isset($page['photo'][$i])) {
                        $ph = isset($page['photo'][$i]) ? $page['photo'][$i]->path : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                        if (file_exists(json_decode(trim($ph))->{'cover'})) {
                            $photo = \URL::to(json_decode(trim($ph))->{'cover'});
                        } else {
                            $photo = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                        }
                    } else {
                        $photo = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                    }
                    ?>
                    <div class="col-md-9">
                        <div data-provides="fileupload" class="fileupload fileupload-new">
                            <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">                                
                                <img alt="" src="{{$photo}}">
                            </div>
                            <div style="max-width: 200px; max-height: 150px; line-height: 20px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                    <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                    <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                    <input type="file" name="photo{{$i}}" id="photo{{$i}}" class="default">
                                    <input type="hidden" name="photo_id{{$i}}" value="{{isset($page['photo'][$i]) ? $page['photo'][$i]->id :null;}}" />
                                </span>
                                <a data-dismiss="fileupload" class="btn btn-danger fileupload-exists" href="#"><i class="icon-trash"></i> Remove</a>                                                    <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="photo_delete[]" value="{{isset($page['photo'][$i]) ? $page['photo'][$i]->id :null;}}"> Delete
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @endfor
</div>
{{ Form::hidden('id', $page['item']->id) }}
{{ Form::close() }}
@stop
@section('script_page_only')
{{HTML::script('theme/backend/default/js/jquery.tagsinput.js')}}
{{HTML::script('theme/backend/default/js/form-component.js')}}
{{HTML::script('theme/backend/default/assets/bootstrap-fileupload/bootstrap-fileupload.js')}}
{{HTML::script('theme/backend/default/js/jquery.form.js')}}
{{HTML::script('theme/backend/default/js/wysihtml5-0.3.0_rc2.js')}}
{{HTML::script('theme/backend/default/js/bootstrap-wysihtml5-0.0.2.js')}}

{{HTML::script('theme/backend/default/assets/dropzone/dropzone.js')}}
{{HTML::script('theme/backend/default/js/modernizr.custom.js')}}
{{HTML::script('theme/backend/default/js/toucheffects.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $(".tags").tagsInput();
    $(document).ready(function() {
        var edit_province = <?php echo $page['item']->province; ?>;
        var edit_amphur = <?php echo $page['item']->amphur; ?>;
        var edit_category = <?php echo $page['cat'][0]; ?>;
        var edit_sub1 = <?php echo isset($page['cat'][1]) ? $page['cat'][1] : 0; ?>;
        var edit_sub2 = <?php echo isset($page['cat'][2]) ? $page['cat'][2] : 0; ?>;
        var edit_sub3 = <?php echo isset($page['cat'][3]) ? $page['cat'][3] : 0; ?>;
        if ($('#province').val()) {
            $.get("{{ url('get/amphur')}}",
                    {option: edit_province},
            function(data) {
                var amphur = $('#amphur');
                amphur.empty();
                $.each(data, function(index, element) {
                    var amphur_select = (element.AMPHUR_ID === '' + edit_amphur + '' ? "selected" : "");
                    amphur.append("<option value='" + element.AMPHUR_ID + "' " + amphur_select + ">" + element.AMPHUR_NAME + "</option>");
                });
            });
        }
        if ($('#categories_id').val()) {
            if (edit_sub1 > 0) {
                $('#sub1').parent().parent().show();
                $.get("{{ url('get/category/sub')}}",
                        {option: edit_category},
                function(data) {
                    var sub1 = $('#sub1');
                    sub1.empty();
                    $.each(data.children, function(index, element) {
                        var sub1_select = (element.id === '' + edit_sub1 + '' ? "selected" : "");
                        sub1.append("<option value='" + element.id + "' " + sub1_select + ">" + element.title + "</option>");
                    });
                });
            }
            if (edit_sub2 > 0) {
                $('#sub2').parent().parent().show();
                $.get("{{ url('get/category/sub')}}",
                        {option: edit_sub1},
                function(data) {
                    var sub2 = $('#sub2');
                    sub2.empty();
                    $.each(data.children, function(index, element) {
                        var sub2_select = (element.id === '' + edit_sub2 + '' ? "selected" : "");
                        sub2.append("<option value='" + element.id + "' " + sub2_select + ">" + element.title + "</option>");
                    });
                });
            }
            if (edit_sub3 > 0) {
                $('#sub3').parent().parent().show();
                $.get("{{ url('get/category/sub')}}",
                        {option: edit_sub2},
                function(data) {
                    var sub3 = $('#sub3');
                    sub3.empty();
                    $.each(data.children, function(index, element) {
                        var sub3_select = (element.id === '' + edit_sub3 + '' ? "selected" : "");
                        sub3.append("<option value='" + element.id + "' " + sub3_select + ">" + element.title + "</option>");
                    });
                });
            }
        }


        //######################################
        $('#description').wysihtml5({
            "link": false,
            "image": false
        });
        var options = {
            url: base_url  + 'backend/posting/post/edit',
            success: showResponse
        };
        $('#btnSave').click(function() {
            $('#form-add').ajaxSubmit(options);
            return false;
        });
    });
    $('#categories_id').change(function() {
        $('#sub2').parent().parent().hide();
        $('#sub2').empty();
        $('#sub3').parent().parent().hide();
        $('#sub3').empty();
        $.get("{{ url('get/category/sub')}}",
                {option: $(this).val()},
        function(data) {
            if (data.children.length > 0) {
                var sub1 = $('#sub1');
                sub1.parent().parent().show();
                sub1.empty();
                sub1.append("<option value=''><?php echo \Lang::get('common.please_select'); ?></option>");
                $.each(data.children, function(index, element) {
                    sub1.append("<option value='" + element.id + "'>" + element.title + "</option>");
                });
            }
        });
    });
    $('#sub1').change(function() {
        $('#sub2').parent().parent().hide();
        $('#sub2').empty();
        $('#sub3').parent().parent().hide();
        $('#sub3').empty();
        $.get("{{ url('get/category/sub')}}",
                {option: $(this).val()},
        function(data) {
            if (data.children.length > 0) {
                var sub2 = $('#sub2');
                sub2.parent().parent().show();
                sub2.empty();
                sub2.append("<option value=''><?php echo \Lang::get('common.please_select'); ?></option>");
                $.each(data.children, function(index, element) {
                    sub2.append("<option value='" + element.id + "'>" + element.title + "</option>");
                });
            }
        });
    });
    $('#sub2').change(function() {
        $.get("{{ url('get/category/sub')}}",
                {option: $(this).val()},
        function(data) {
            if (data.children.length > 0) {
                var sub3 = $('#sub3');
                sub3.parent().parent().show();
                sub3.empty();
                sub3.append("<option value=''><?php echo \Lang::get('common.please_select'); ?></option>");
                $.each(data.children, function(index, element) {
                    sub3.append("<option value='" + element.id + "'>" + element.title + "</option>");
                });
            }
        });
    });
    $('#province').change(function() {
        $.get("{{ url('get/amphur')}}",
                {option: $(this).val()},
        function(data) {
            var amphur = $('#amphur');
            amphur.empty();
            amphur.append("<option value=''><?php echo \Lang::get('common.please_select'); ?></option>");
            $.each(data, function(index, element) {
                amphur.append("<option value='" + element.AMPHUR_ID + "'>" + element.AMPHUR_NAME + "</option>");
            });
        });
    });
    $('#amphur').change(function() {
        $.get("{{ url('get/zipcode')}}",
                {option: $(this).val()},
        function(data) {
            var zipcode = $('#zipcode');
            zipcode.val('');
            $.each(data, function(index, element) {
                zipcode.val(element.POST_CODE);
            });
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
                    window.location.replace(base_url  + 'backend/posting/post/edit/<?php echo $page['item']->id; ?>');
                });
            }, 3000);
        }
    }
</script>
@stop