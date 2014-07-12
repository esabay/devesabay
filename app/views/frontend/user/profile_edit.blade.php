@extends('frontend.layouts.theme.preciso.master')
@section('content')
<style type="text/css">
    input[type='text'],textarea{width: 50%;}
    #zipcode, #zipcode2, #mobile, #mobile2, #email,#id_card {width: 20%;}
    #firstname,#firstname2,#lastname,#lastname2 {width:30%;}
</style>
<div class="row">
    <div class="span9"> 
        <ul class="breadcrumb">
            <li><a href="#">หน้าหลัก</a> <span class="divider">/</span></li>
            <li><a href="#">ผู้ใช้งาน</a> <span class="divider">/</span></li>
            <li class="active">ข้อมูลบัญชี/ที่อยู่มาตรฐานสำหรับใบเสร็จ</li>
        </ul>
        {{ Form::open(array('name'=>'form-add','id'=>'form-add','role'=>'form','files'=>true)) }}
        <div class="bs-callout bs-callout-danger">
            <h4>ข้อมูลร้าน</h4>         
            <div class="form-group">
                {{Form::label('firstname','ประเภทธุรกิจ', array('class' => 'control-label'));}}
                {{Form::select('biz_type', array('' => \Lang::get('common.please_select')) + 
                                            array(
                                            '1' => \Lang::get('user.biz_type_1'),
                                            '2' => \Lang::get('user.biz_type_2'),
                                            '3' => \Lang::get('user.biz_type_3'),
                                            ), $page['item']->biz_type,array('class' => 'form-control', 'id' => 'biz_type'))}}
            </div>
            <div class="form-group">
                {{Form::label('company_name','ข้อมูลร้าน/บริษัท', array('class' => 'control-label'));}}
                {{ Form::text('company_name',$page['item']->company_name, array('id'=>'company_name','class'=>'form-control')) }}
            </div>
        </div>
        <div class="bs-callout bs-callout-info">
            <h4>ข้อมูลบัญชี/ที่อยู่มาตรฐานสำหรับใบเสร็จ</h4>            
            <div class="form-group">
                {{Form::label('firstname',\Lang::get('theme_preciso.firstname'), array('class' => 'control-label'));}}
                {{ Form::text('firstname',$page['item']->firstname, array('id'=>'firstname','class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{Form::label('lastname',\Lang::get('theme_preciso.lastname'), array('class' => 'control-label'));}}
                {{ Form::text('lastname',$page['item']->lastname, array('id'=>'lastname','class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{Form::label('id_card',\Lang::get('theme_preciso.id_card'), array('class' => 'control-label'));}}
                {{ Form::text('id_card',$page['item']->id_card, array('id'=>'id_card','class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{Form::label('email',\Lang::get('theme_preciso.email'), array('class' => 'control-label'));}}
                {{ Form::text('email',$page['item']->email, array('id'=>'email','class'=>'form-control','disabled')) }}
            </div>
            <div class="form-group">
                {{Form::label('mobile',\Lang::get('theme_preciso.phone'), array('class' => 'control-label'));}}
                {{ Form::text('mobile',$page['item']->mobile, array('id'=>'mobile','class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{Form::label('address',\Lang::get('theme_preciso.address'), array('class' => 'control-label'));}}
                {{ Form::text('address',$page['item']->address, array('id'=>'address','class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{Form::label('province',\Lang::get('theme_preciso.province'), array('class' => 'control-label'));}}
                {{ \Form::select('province', array('' => \Lang::get('common.please_select')) + DB::table('province')
                                ->orderBy('PROVINCE_NAME', 'asc')
                                ->lists('PROVINCE_NAME', 'PROVINCE_ID'), $page['item']->province, array('class' => 'form-control', 'id' => 'province')); }}
            </div>
            <div class="form-group">
                {{Form::label('amphur',\Lang::get('theme_preciso.amphur'), array('class' => 'control-label'));}}
                {{ \Form::select('amphur', array('' => \Lang::get('common.please_select')), $page['item']->amphur, array('class' => 'form-control', 'id' => 'amphur'));}}
            </div>
            <div class="form-group">
                {{Form::label('district',\Lang::get('theme_preciso.district'), array('class' => 'control-label'));}}
                {{ \Form::select('district', array('' => \Lang::get('common.please_select')), $page['item']->district, array('class' => 'form-control', 'id' => 'district'));}}
            </div>
            <div class="form-group">
                {{Form::label('zipcode',\Lang::get('theme_preciso.zipcode'), array('class' => 'control-label'));}}
                {{ Form::text('zipcode',$page['item']->zipcode, array('id'=>'zipcode','class'=>'form-control')) }}
            </div>
        </div>   
        <div class="bs-callout bs-callout-warning">
            <h4>ไฟล์เอกสารประกอบการสมัคร</h4>                     
            <div class="form-group">
                {{\Common::genForm(array('type'=>'file','name'=>'file1','value'=>$page['file'][0]->file1,'help'=>'สำเนาบัตรประชาชาชนของกรรมการผู้มีอำนาจลงนามผูกพันบริษัทหรือเจ้าของกิจการ'))}}
            </div>
            <div class="form-group">
                {{\Common::genForm(array('type'=>'file','name'=>'file2','value'=>$page['file'][0]->file2,'help'=>'สำเนาทะเบียนบ้านของกรรมการผู้มีอำนาจลงนามผูกพันบริษัทหรือเจ้าของกิจการ'))}}
            </div>
            <div class="form-group">
                {{\Common::genForm(array('type'=>'file','name'=>'file3','value'=>$page['file'][0]->file3,'help'=>'ทะเบียนการค้า'))}}
            </div>
            <div class="form-group">
                {{\Common::genForm(array('type'=>'file','name'=>'file4','value'=>$page['file'][0]->file4,'help'=>'หนังสือรับรองบริษัทพร้อมวัตถุประสงค์ทุกข้อ หากเป็นร้านค้าสามารถใช้ทะเบียนการค้าแทนได้'))}}
            </div>
            <div class="form-group">
                {{\Common::genForm(array('type'=>'file','name'=>'file5','value'=>$page['file'][0]->file5,'help'=>'สำเนาเอกสาร ภพ. 20'))}}                
            </div>
            <span class="label label-warning">คำแนะนำ</span>
            <span>ไฟล์เอกสารขนาดไฟล์ไม่ควรเกิน 1 M</span>
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
@section('script_page_only')
{{HTML::script('theme/frontend/preciso/js/jquery.form.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $(function() {
        var edit_province = <?php echo $page['item']->province; ?>;
        var edit_amphur = <?php echo $page['item']->amphur; ?>;
        var edit_district = <?php echo $page['item']->district; ?>;
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

            $.get("{{ url('get/district')}}",
                    {option: edit_amphur},
            function(data) {
                var district = $('#district');
                district.empty();
                $.each(data, function(index, element) {
                    var district_select = (element.DISTRICT_ID === '' + edit_district + '' ? "selected" : "");
                    district.append("<option value='" + element.DISTRICT_ID + "' " + district_select + ">" + element.DISTRICT_NAME + "</option>");
                });
            });
        }

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
            $.get("{{ url('get/district')}}",
                    {option: $(this).val()},
            function(data) {
                var district = $('#district');
                district.empty();
                district.append("<option value=''><?php echo \Lang::get('common.please_select'); ?></option>");
                $.each(data, function(index, element) {
                    district.append("<option value='" + element.DISTRICT_ID + "'>" + element.DISTRICT_NAME + "</option>");
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

    });

    $('#btnDialogSave').click(function() {
        var options = {
            url: base_url + 'user/profile/edit',
            success: showResponse
        };
        $('#form-add').ajaxSubmit(options);
    });

    function showResponse(response, statusText, xhr, $form) {
        var data = {
            title: 'Message',
            text: '<div class="text-center"><p><img src="' + base_url + 'theme/frontend/preciso/img/ajax-loader.gif" /></p>กำลังบันทึกข้อมูล กรุณารอสักครู่...</div>',
            type: 'alert'
        };
        genModal(data);
        $('form .form-group').removeClass('has-error');
        $('form .help-block').remove();
        if (response.error.status === false) {
            $('#myModal').modal('hide');
            $.each(response.error.message, function(key, value) {
                $('#' + key).parent().addClass('has-error');
                $('#' + key).after('<p class="help-block">' + value + '</p>');
            });
        } else {
            var data = {
                title: 'Message',
                text: '<div class="text-center">' + response.error.message + '</div>',
                type: 'info'
            };
            genModal(data);
            setTimeout(function() {
                $('#myModal').modal('hide');
                $('#myModal').on('hidden.bs.modal', function(e) {
                    window.location.href = base_url + 'user/dashboard';
                });
            }, 5000);
        }
    }

    $('.btnDelete').click(function() {
        var data = {
            title: 'Confirm',
            type: 'confirm',
            text: 'Confirm Delete file ?'
        };
        genModal(data);
        $('#myModal #button-confirm').attr('ref', $(this).attr('ref'));
        $('body').on('click', '#myModal #button-confirm', function() {
            $.ajax({
                type: "post",
                url: base_url + 'user/profile/edit/delete/att/' + $(this).attr('ref'),
                cache: false,
                dataType: 'json',
                success: function(result) {
                    try {
                        if (result.error.status === true)
                        {
                            $('#myModal .modal-footer').hide();
                            $('#myModal .modal-body').empty();
                            $('#myModal .modal-body').html('<div class="text-center">' + result.error.message + '</div>');
                            setTimeout(function() {
                                $('#myModal').modal('hide');
                                $('#myModal').on('hidden.bs.modal', function(e) {
                                    window.location.href = base_url + 'user/profile/edit';
                                });
                            }, 3000);
                        }
                    } catch (e) {
                        alert('Exception while request..');
                    }
                },
                error: function(e) {
                    alert('Error while request..');
                }
            });

        });
    });
</script>
@stop