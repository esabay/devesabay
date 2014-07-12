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
                        <a href="{{URL::to('/backend/jshopping/product')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i> {{\Lang::get('common.back')}}</a>                            <button type="button" class="btn btn-success" id="btnSave"><i class="icon-save"></i> Save</button>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary" id='btnEditPrice'><i class="icon-edit"></i> {{\Lang::get('jshopping.edit_price')}}</button>
                        <button type="button" class="btn btn-primary" id='btnAddSpec'><i class="icon-plus"></i> {{\Lang::get('jshopping.add_spec')}}</button>
                        <button type="button" class="btn btn-primary" id='btnEditSpec'><i class="icon-edit"></i> {{\Lang::get('jshopping.edit_spec')}} </button>
                        <button type="button" class="btn btn-warning" id='btnProductGallery'><i class="icon-picture"></i> {{\Lang::get('jshopping.product_gallery')}} </button>
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
                    {{Form::label('ProductName', \Lang::get('jshopping.name'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-10">
                        {{ Form::text('ProductName', $page['item']->ProductName, array('id'=>'ProductName','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('ProductCode', \Lang::get('jshopping.code'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('ProductCode', $page['item']->ProductCode, array('id'=>'ProductCode','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('ShortDetail', \Lang::get('jshopping.short_detail'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-10">
                        {{ Form::textarea('ShortDetail', $page['item']->ShortDetail, array('id'=>'ShortDetail','class'=>'form-control','cols'=>50,'rows'=>10)) }}
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading tab-bg-dark-navy-blue">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#config1" data-toggle="tab">ตั้งค่าสินค้า</a>
                    </li>
                    <li class="">
                        <a href="#config3" data-toggle="tab">SEO Setting</a>
                    </li>
                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="config1">
                        <div class="form-group">
                            {{Form::label('name', \Lang::get('jshopping.category'), array('class' => 'col-lg-3 control-label'));}}
                            <div class="col-lg-6">
                                {{\Form::select('cat1', $page['category'], $page['item']->sub1, array('class' => 'form-control', 'id' => 'categories_id'))}}
                            </div>
                        </div>
                        <div class="form-group" style="display: none;">
                            <label class="col-lg-3 control-label" for="price">&nbsp;</label>
                            <div class="col-lg-6">
                                <select name="cat2" id="sub1" class="form-control">
                                    <option selected="selected" value="">{{\Lang::get('common.please_select')}}</option>                            
                                </select>
                            </div>
                        </div>
                        <div class="form-group" style="display: none;">
                            <label class="col-lg-3 control-label" for="price">&nbsp;</label>
                            <div class="col-lg-6">
                                <select name="cat3" id="sub2" class="form-control">
                                    <option selected="selected" value="">{{\Lang::get('common.please_select')}}</option>                            
                                </select>
                            </div>
                        </div>
                        <div class="form-group" style="display: none;">
                            <label class="col-lg-3 control-label" for="price">&nbsp;</label>
                            <div class="col-lg-6">
                                <select name="cat4" id="sub3" class="form-control">
                                    <option selected="selected" value="">{{\Lang::get('common.please_select')}}</option>                            
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('name', \Lang::get('jshopping.supplier'), array('class' => 'col-lg-3 control-label'));}}
                            <div class="col-lg-8">
                                {{Form::select('SupplierID',$page['suppliers'],$page['item']->SupplierID, array('class' => 'form-control','id'=>'group_id'))}}
                            </div>
                        </div>                        
                        <div class="form-group">
                            {{Form::label('name', \Lang::get('jshopping.units_in_stock'), array('class' => 'col-lg-3 control-label'));}}
                            <div class="col-lg-4">
                                {{ Form::text('UnitsInStock', $page['item']->UnitsInStock, array('id'=>'UnitsInStock','class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('weight', \Lang::get('jshopping.weight'), array('class' => 'col-lg-3 control-label'));}}
                            <div class="col-lg-4">
                                {{ Form::text('weight', $page['item']->weight, array('id'=>'weight','class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="col-lg-offset-3 col-lg-9">
                            <div class="checkbox">
                                <label>
                                    {{Form::checkbox('disabled', 0,($page['item']->disabled == 0 ? true : false))}} {{\Lang::get('jshopping.publish')}}
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {{Form::checkbox('featured', 0,($page['item']->featured == 0 ? true : false))}} {{\Lang::get('jshopping.featured')}}
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {{Form::checkbox('new', 0,($page['item']->new == 0 ? true : false))}} {{\Lang::get('jshopping.new_product')}}
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {{Form::checkbox('special', 0,($page['item']->special == 0 ? true : false))}} {{\Lang::get('jshopping.special_product')}}
                                </label>
                            </div>
                        </div>
                    </div>                    
                    <div class="tab-pane" id="config3">
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
                                {{ Form::textarea('seo_description', $page['item']->seo_description, array('id'=>'seo_description','class'=>'form-control','cols'=>50,'rows'=>3)) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('jshopping.image_cover')}}
            </header>
            <div class="panel-body">
                <div class="form-group last">
                    <label class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                    <div class="col-md-9">
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
                                    <span class="fileupload-new"><i class="icon-paper-clip"></i> {{\Lang::get('jshopping.select_image')}}</span>
                                    <span class="fileupload-exists"><i class="icon-undo"></i> {{\Lang::get('jshopping.change')}}</span>
                                    <input type="file" name="imgcover" id="imgcover" class="default" />
                                </span>
                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> {{\Lang::get('jshopping.remove')}}</a>
                            </div>
                        </div>
                        <span class="label label-danger">{{\Lang::get('jshopping.note')}}</span>
                        <span>
                            เพื่อความสวยงามควรทำรูปมาให้ขนาดพอดี
                        </span>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('jshopping.recommended')}}
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        {{ Form::text('recommended', \Input::old('recommended'), array('id'=>'recommended','class'=>'form-control')) }}
                    </div>
                </div>
                <span class="label label-danger">NOTE!</span>
                <span>
                    กรอกรหัสสินค้าแล้วคั่นด้วย (,)
                </span>
            </div>
        </section>
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('jshopping.related')}}
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        {{ Form::text('related', \Input::old('related'), array('id'=>'related','class'=>'form-control')) }}
                    </div>
                </div>
                <span class="label label-danger">NOTE!</span>
                <span>
                    กรอกรหัสสินค้าแล้วคั่นด้วย (,)
                </span>
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('jshopping.detail')}}
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label col-sm-2">{{\Lang::get('jshopping.editor')}}</label>
                    <div class="col-lg-10">
                        {{ Form::textarea('Detail', $page['item']->Detail, array('id'=>'Detail','class'=>'form-control ckeditor','rows'=>10)) }}                       
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

{{ Form::hidden('id', $page['item']->ProductID) }}
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
    $(".tags, #seo_keyword, #recommended, #related").tagsInput();
    $(document).ready(function() {
        var edit_category = <?php echo $page['item']->sub1; ?>;
        var edit_sub1 = <?php echo isset($page['item']->sub2) ? $page['item']->sub2 : 0; ?>;
        var edit_sub2 = <?php echo isset($page['item']->sub3) ? $page['item']->sub3 : 0; ?>;
        var edit_sub3 = <?php echo isset($page['item']->sub4) ? $page['item']->sub4 : 0; ?>;



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





        var options = {
            url: base_url + 'backend/jshopping/product/edit/<?php echo \Request::segment(5) ?>',
            success: showResponse, // post-submit callback 
            dataType: 'json'
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
                    getPageUrl(base_url + 'backend/jshopping/product');
                });
            }, 3000);
        }
    }

    $('#btnEditPrice').click(function() {
        var data = {
            url: 'backend/jshopping/productprice/edit/' + <?php echo \Request::segment(5) ?> + '',
            title: 'Edit Product Price'
        };
        genModal(data);
    });
    
    $('#btnAddSpec').click(function() {
        var data = {
            url: 'backend/jshopping/productspec/add/' + <?php echo \Request::segment(5) ?> + '',
            title: 'Add Product Spec'
        };
        genModal(data);
    });
    $('#btnEditSpec').click(function() {
        var data = {
            url: 'backend/jshopping/productspec/edit/' + <?php echo \Request::segment(5) ?> + '',
            title: 'Edit Product Spec'
        };
        genModal(data);
    });
    $('#btnProductGallery').click(function() {
        getPageUrl(base_url + 'backend/jshopping/product/gallery/' + <?php echo \Request::segment(5) ?> + '');
    });
</script>
@stop