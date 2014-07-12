@extends('frontend.layouts.theme.preciso.master')
@section('content')
<div class="row">
    <div class="span12"> 
        <!-- Breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('/'); }}">หน้าหลัก</a> <span class="divider">/</span></li>
            <li class="active">ผู้ใช้งาน</li>
        </ul>
        <p class="small-desc"></p>        
        <div class="span5">
            <h3>สมัครเป็นตัวแทนจำหน่าย (Dealer)</h3>
            <p class="half-margin">ยินดีต้อนรับลูกค้าใหม่ สามารถสมัครสมาชิกได้ที่นี่</p>
            <div id="validation-errors" style="display: none"></div>
            {{ \Form::open(array('class' => 'form-horizontal', 'id' => 'frmRegister', 'role' => 'form')); }}
            <div class="span5">
                <p class="clear"></p>
                <div class="form-group">
                    {{ \Form::label('firstname', 'ชื่อ'); }}
                    {{ \Form::text('firstname', Input::old('firstname'), array('id' => 'firstname', 'class' => 'span3 form-control')); }}
                </div>
                <div class="form-group">
                    {{ \Form::label('lastname', 'นามสกุล'); }}
                    {{ \Form::text('lastname', Input::old('lastname'), array('id' => 'lastname', 'class' => 'span3 form-control')); }}
                </div>
                <div class="form-group">
                    {{ \Form::label('mobile', 'เบอร์ติดต่อ'); }}
                    {{ \Form::text('mobile', Input::old('mobile'), array('id' => 'mobile', 'class' => 'span2 form-control')); }}
                </div>
                <div class="form-group">
                    {{ \Form::label('lastname', 'อีเมล์'); }}
                    {{ \Form::text('email', Input::old('email'), array('id' => 'email', 'class' => 'span3 form-control')); }}
                </div>
                <div class="form-group">
                    {{ \Form::label('password', 'รหัสผ่าน'); }}
                    {{ \Form::password('password', Input::old('password'), array('id' => 'password', 'class' => 'span2 form-control')); }}
                </div>
                <div class="form-group">
                    <label for="captcha">&nbsp;</label>
                    {{ \Form::captcha(); }}
                </div>
                <div class="form-group">
                    <p class="clearfix"></p>
                    <input type="button" name="btnRegister" id="btnDialogSave" class="btn" value=" ลงทะเบียน " />
                </div>   
            </div>   
            {{ \Form::close(); }}
        </diV>
        <div class="span6">
            {{\Post::getDetail(6)}}
        </div>
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
    $('#btnDialogSave').click(function() {
        var data = {
            url: 'register',
            v: $('#frmRegister input:not(#btnDialogSave)').serializeArray(),
            form: 'frmRegister',
            redirect: ''
        };
        saveData(data);
    });
</script>
@stop