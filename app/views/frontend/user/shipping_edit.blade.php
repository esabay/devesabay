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
            <li class="active">ที่อยู่จัดส่งสินค้า</li>
        </ul>
        {{ \Form::open(array('name'=>'form-add','id'=>'form-add','role'=>'form')) }}        
        <div class="bs-callout bs-callout-warning">
            <h4>ที่อยู่จัดส่งสินค้า</h4>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                            {{\Form::checkbox('addresscopy', 0,(\Auth::user()->addresscopy == 0 ? true : false))}} {{ \Lang::get('theme_preciso.addresscopy'); }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{\Form::label('firstname2',\Lang::get('theme_preciso.firstname'), array('class' => 'control-label'));}}
                {{ \Form::text('firstname2',$page['item']->firstname, array('id'=>'firstname2','class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{\Form::label('lastname',\Lang::get('theme_preciso.lastname'), array('class' => 'control-label'));}}
                {{ \Form::text('lastname2',$page['item']->lastname, array('id'=>'lastname2','class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{\Form::label('mobile',\Lang::get('theme_preciso.phone'), array('class' => 'control-label'));}}
                {{ \Form::text('mobile2',$page['item']->mobile, array('id'=>'mobile2','class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{\Form::label('address',\Lang::get('theme_preciso.address'), array('class' => 'control-label'));}}
                {{ \Form::text('address2',$page['item']->address, array('id'=>'address2','class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{\Form::label('province',\Lang::get('theme_preciso.province'), array('class' => 'control-label'));}}
                {{ \Form::select('province2', array('' => \Lang::get('common.please_select')) + DB::table('province')
                                ->orderBy('PROVINCE_NAME', 'asc')
                                ->lists('PROVINCE_NAME', 'PROVINCE_ID'), $page['item']->province, array('class' => 'form-control', 'id' => 'province2'));}}
            </div>
            <div class="form-group">
                {{\Form::label('amphur',\Lang::get('theme_preciso.amphur'), array('class' => 'control-label'));}}
                <select class="form-control" id="amphur2" name="amphur2">
                    <option value="">{{ \Lang::get('common.please_select'); }}</option>
                </select>
            </div>
            <div class="form-group">
                {{\Form::label('district',\Lang::get('theme_preciso.district'), array('class' => 'control-label'));}}
                <select class="form-control" id="district2" name="district2">
                    <option value="">{{ \Lang::get('common.please_select'); }}</option>
                </select>
            </div>
            <div class="form-group">
                {{\Form::label('zipcode',\Lang::get('theme_preciso.zipcode'), array('class' => 'control-label'));}}
                {{ \Form::text('zipcode2',$page['item']->zipcode, array('id'=>'zipcode2','class'=>'form-control')) }}
            </div>
        </div>
        {{ \Form::button(\Lang::get('common.save'),array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
        {{ \Form::close() }}
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
@section('script_page_only')
{{HTML::script('theme/frontend/preciso/js/jquery.form.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $(function() {
        var edit_province2 = <?php echo $page['item']->province; ?>;
        var edit_amphur2 = <?php echo $page['item']->amphur; ?>;
        var edit_district2 = <?php echo $page['item']->district; ?>;
        if (edit_province2 > 0) {
            $.get("{{ url('get/amphur')}}",
                    {option: edit_province2},
            function(data) {
                var amphur2 = $('#amphur2');
                amphur2.empty();
                $.each(data, function(index, element) {
                    var amphur_select2 = (element.AMPHUR_ID === '' + edit_amphur2 + '' ? "selected" : "");
                    amphur2.append("<option value='" + element.AMPHUR_ID + "' " + amphur_select2 + ">" + element.AMPHUR_NAME + "</option>");
                });
            });

            $.get("{{ url('get/district')}}",
                    {option: edit_amphur2},
            function(data) {
                var district2 = $('#district2');
                district2.empty();
                $.each(data, function(index, element) {
                    var district_select2 = (element.DISTRICT_ID === '' + edit_district2 + '' ? "selected" : "");
                    district2.append("<option value='" + element.DISTRICT_ID + "' " + district_select2 + ">" + element.DISTRICT_NAME + "</option>");
                });
            });
        }

        $('#province2').change(function() {
            $.get("{{ url('get/amphur')}}",
                    {option: $(this).val()},
            function(data) {
                var amphur2 = $('#amphur2');
                amphur2.empty();
                amphur2.append("<option value=''><?php echo \Lang::get('common.please_select'); ?></option>");
                $.each(data, function(index, element) {
                    amphur2.append("<option value='" + element.AMPHUR_ID + "'>" + element.AMPHUR_NAME + "</option>");
                });
            });
        });

        $('#amphur2').change(function() {
            $.get("{{ url('get/district')}}",
                    {option: $(this).val()},
            function(data) {
                var district2 = $('#district2');
                district2.empty();
                district2.append("<option value=''><?php echo \Lang::get('common.please_select'); ?></option>");
                $.each(data, function(index, element) {
                    district2.append("<option value='" + element.DISTRICT_ID + "'>" + element.DISTRICT_NAME + "</option>");
                });
            });
        });

        $('#amphur2').change(function() {
            $.get("{{ url('get/zipcode')}}",
                    {option: $(this).val()},
            function(data) {
                var zipcode2 = $('#zipcode2');
                zipcode2.val('');
                $.each(data, function(index, element) {
                    zipcode2.val(element.POST_CODE);
                });
            });
        });
    });

    function formSave()
    {
        var data = {
            url: 'user/shopping/shipping/edit',
            v: $('#form-add, select input:not(#btnDialogSave)').serializeArray(),
            redirect: 'user/dashboard'
        };
        saveData(data);
    }

    $('#btnDialogSave').click(function() {
        formSave();
    });
</script>
@stop