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
                        <a href="{{URL::to('/backend/jshopping/product')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i>  {{\Lang::get('common.back')}}</a>
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
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                {{$page['title']}}
            </header>
            <div class="panel-body">

                <div class="form-group">
                    {{Form::label('ProductName', \Lang::get('jshopping.name'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-10">
                        {{ Form::text('ProductName', \Input::old('ProductName'), array('id'=>'ProductName','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('ProductCode', \Lang::get('jshopping.code'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('ProductCode', \Input::old('ProductCode'), array('id'=>'ProductCode','class'=>'form-control')) }}
                    </div>
                </div>                   
                <div class="form-group">
                    {{Form::label('ShortDetail', \Lang::get('jshopping.short_detail'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-10">
                        {{ Form::textarea('ShortDetail', \Input::old('ShortDetail'), array('id'=>'ShortDetail','class'=>'form-control','cols'=>50,'rows'=>10)) }}
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
                        <a href="#config2" data-toggle="tab">กำหนดราคา</a>
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
                                <select name="cat1" id="categories_id" class="form-control">
                                    <option selected="selected" value="">{{\Lang::get('common.please_select')}}</option>
                                    @foreach ($page['category'] as $item)
                                    <option value="{{$item['id']}}">{{$item['title']}}</option>                            
                                    @endforeach
                                </select>
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
                                {{Form::select('SupplierID',$page['suppliers'],null, array('class' => 'form-control','id'=>'group_id'))}}
                            </div>
                        </div>                        
                        <div class="form-group">
                            {{Form::label('name', \Lang::get('jshopping.units_in_stock'), array('class' => 'col-lg-3 control-label'));}}
                            <div class="col-lg-4">
                                {{ Form::text('UnitsInStock', \Input::old('UnitsInStock'), array('id'=>'UnitsInStock','class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('weight', \Lang::get('jshopping.weight'), array('class' => 'col-lg-3 control-label'));}}
                            <div class="col-lg-4">
                                {{ Form::text('weight', \Input::old('weight'), array('id'=>'weight','class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="col-lg-offset-3 col-lg-8">
                            <div class="checkbox">
                                <label>
                                    {{Form::checkbox('disabled', 0,null)}} {{\Lang::get('jshopping.publish')}}
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {{Form::checkbox('featured', 0,null)}} {{\Lang::get('jshopping.featured_product')}}
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {{Form::checkbox('new', 0,null)}} {{\Lang::get('jshopping.new_product')}}
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {{Form::checkbox('special', 0,null)}} {{\Lang::get('jshopping.special_product')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="config2">
                        <div class="form-group">
                            {{Form::label('name', \Lang::get('jshopping.cost_price'), array('class' => 'col-lg-2 control-label'));}}
                            <div class="col-lg-5">
                                {{ Form::text('UnitPrice',\Input::old('UnitPrice'), array('id'=>'UnitPrice','class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label col-lg-2" for="name">price 1</label>                            
                            <div class="col-lg-5">
                                <div class="input-group m-bot15">
                                    <span class="input-group-addon">
                                        <input type="radio" value="0" name="active0">                                    
                                    </span>
                                    <input type="text" name="price[]" class="form-control" id="price1"> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label col-lg-2" for="name">price 2</label>                            
                            <div class="col-lg-5">
                                <div class="input-group m-bot15">
                                    <span class="input-group-addon">
                                        <input type="radio" value="0" name="active1">                                    
                                    </span>
                                    <input type="text" name="price[]" class="form-control" id="price2"> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label col-lg-2" for="name">price 3</label>                            
                            <div class="col-lg-5">
                                <div class="input-group m-bot15">
                                    <span class="input-group-addon">
                                        <input type="radio" value="0" name="active2">                                    
                                    </span>
                                    <input type="text" name="price[]" class="form-control" id="price3"> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label col-lg-2" for="name">price 4</label>                            
                            <div class="col-lg-5">
                                <div class="input-group m-bot15">
                                    <span class="input-group-addon">
                                        <input type="radio" value="0" name="active3">                                    
                                    </span>
                                    <input type="text" name="price[]" class="form-control" id="price4"> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label col-lg-2" for="name">price 5</label>                            
                            <div class="col-lg-5">
                                <div class="input-group m-bot15">
                                    <span class="input-group-addon">
                                        <input type="radio" value="0" name="active4">                                    
                                    </span>
                                    <input type="text" name="price[]" class="form-control" id="price5"> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label col-lg-2" for="name">price 6</label>                            
                            <div class="col-lg-5">
                                <div class="input-group m-bot15">
                                    <span class="input-group-addon">
                                        <input type="radio" value="0" name="active5">                                    
                                    </span>
                                    <input type="text" name="price[]" class="form-control" id="price6"> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label col-lg-2" for="name">price 7</label>                            
                            <div class="col-lg-5">
                                <div class="input-group m-bot15">
                                    <span class="input-group-addon">
                                        <input type="radio" value="0" name="active6">                                    
                                    </span>
                                    <input type="text" name="price[]" class="form-control" id="price7"> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label col-lg-2" for="name">price 8</label>                            
                            <div class="col-lg-5">
                                <div class="input-group m-bot15">
                                    <span class="input-group-addon">
                                        <input type="radio" value="0" name="active7">                                    
                                    </span>
                                    <input type="text" name="price[]" class="form-control" id="price8"> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label col-lg-2" for="name">price 9</label>                            
                            <div class="col-lg-5">
                                <div class="input-group m-bot15">
                                    <span class="input-group-addon">
                                        <input type="radio" value="0" name="active8">                                    
                                    </span>
                                    <input type="text" name="price[]" class="form-control" id="price9"> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label col-lg-2" for="name">price 10</label>                            
                            <div class="col-lg-5">
                                <div class="input-group m-bot15">
                                    <span class="input-group-addon">
                                        <input type="radio" value="0" name="active9">                                    
                                    </span>
                                    <input type="text" name="price[]" class="form-control" id="price10"> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="config3">
                        <div class="form-group">
                            {{Form::label('seo_title', 'Title', array('class' => 'col-lg-2 control-label'));}}
                            <div class="col-lg-10">
                                {{ Form::text('seo_title', Input::old('seo_title'), array('id'=>'seo_title','class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('seo_keyword', 'Keyword', array('class' => 'col-lg-2 control-label'));}}
                            <div class="col-lg-10">
                                {{ Form::text('seo_keyword', Input::old('seo_keyword'), array('id'=>'seo_keyword','class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('seo_description', 'Description', array('class' => 'col-lg-2 control-label'));}}
                            <div class="col-lg-10">
                                {{ Form::textarea('seo_description', Input::old('seo_description'), array('id'=>'seo_description','class'=>'form-control','cols'=>50,'rows'=>3)) }}
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
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                    <span class="fileupload-new"><i class="icon-paper-clip"></i> {{\Lang::get('jshopping.select_image')}}</span>
                                    <span class="fileupload-exists"><i class="icon-undo"></i> {{\Lang::get('jshopping.change')}}</span>
                                    <input type="file" name="imgcover" id="imgcover" class="default" />
                                </span>
                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> {{\Lang::get('jshopping.ermove')}}</a>
                            </div>
                        </div>
                        <span class="label label-danger">NOTE!</span>
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
                        {{ Form::textarea('Detail', \Input::old('Detail'), array('id'=>'Detail','class'=>'form-control ckeditor','rows'=>10)) }}
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
{{HTML::script('theme/backend/default/js/jquery.tagsinput.js')}}
{{HTML::script('theme/backend/default/js/form-component.js')}}
{{HTML::script('theme/backend/default/assets/bootstrap-fileupload/bootstrap-fileupload.js')}}
{{HTML::script('theme/backend/default/js/jquery.form.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $(".tags, #seo_keyword, #recommended, #related").tagsInput();
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

    function showResponse(response, statusText, xhr, $form) {
        //var redirect = (response.error.redirect ? obj.error.delay : 'jshopping/product');
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
</script>
@stop