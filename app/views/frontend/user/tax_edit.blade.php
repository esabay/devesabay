@extends('frontend.layouts.theme.preciso.master')
@section('content')
<style type="text/css">
    input[type='text'],textarea{width: 50%;}
    #zipcode, #zipcode2, #mobile, #mobile2, #email {width: 20%;}
    #firstname,#firstname2,#lastname,#lastname2 {width:30%;}
</style>
<div class="row">
    <div class="span9"> 
        <ul class="breadcrumb">
            <li><a href="#">หน้าหลัก</a> <span class="divider">/</span></li>
            <li><a href="#">ผู้ใช้งาน</a> <span class="divider">/</span></li>
            <li class="active">รายละเอียดใบกำกับภาษี</li>
        </ul>
        {{ Form::open(array('name'=>'form-add','id'=>'form-add','role'=>'form')) }}
        <div class="bs-callout bs-callout-info">
            <h4>รายละเอียดใบกำกับภาษี</h4>            
            <div class="form-group">
                {{Form::label('companyname',\Lang::get('theme_preciso.companyname'), array('class' => 'control-label'));}}
                {{ Form::text('companyname',$page['item']->companyname, array('id'=>'companyname','class'=>'form-control')) }}
            </div>            
            <div class="form-group">
                {{Form::label('address',\Lang::get('theme_preciso.address'), array('class' => 'control-label'));}}
                {{ Form::text('address',$page['item']->address, array('id'=>'address','class'=>'form-control')) }}
            </div>            
            <div class="form-group">
                {{Form::label('taxcode',\Lang::get('theme_preciso.taxcode'), array('class' => 'control-label'));}}
                {{ Form::text('taxcode',$page['item']->taxcode, array('id'=>'taxcode','class'=>'form-control')) }}
            </div>
        </div>        
        {{ Form::button(\Lang::get('common.save'),array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
        {{ Form::close() }}
    </div>
    <!-- Sidebar -->
    <div class="span3 sidebar">
        @include('frontend.user.sidebar')
    </div>
</div>
@stop
@section('small_banner')
{{ $page['small_banner']; }}
@stop
@section('brands_list')
{{ $page['brands_list']; }}
@stop
@section('script_page_code')
<script type="text/javascript">
    function formSave()
    {
        var data = {
            url: 'user/shopping/tax/edit',
            v: $('#form-add input:not(#btnDialogSave)').serializeArray(),
            redirect: 'user/dashboard'
        };
        saveData(data);
    }

    $('#btnDialogSave').click(function() {
        formSave();
    });
</script>
@stop