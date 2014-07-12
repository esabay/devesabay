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
            <h3>ลูกค้าที่ลงทะเบียนแล้ว</h3>
            <p class="clear"></p>
            {{ Form::open(array('class' => 'form-horizontal', 'id' => 'frmLogin', 'role' => 'form')); }}
            <div class="span5 auth">
                <div class="form-group">
                    {{ \Form::label('username_login', 'ชื่อผู้ใช้ / อีเมล์');}}
                    {{ \Form::text('username_login', Input::old('username_login'), array('id' => 'username_login', 'class' => 'form-control')); }}
                </div>
                <div class="form-group">
                    {{ \Form::label('password_login', 'รหัสผ่าน');}}
                    {{ \Form::password('password_login', Input::old('password_login'), array('id' => 'password_login', 'class' => 'form-control')); }}
                </div>
                <div class="form-group">
                    <p class="clearfix"></p>
                    <input type="button" name="btnLogin" id="btnLogin" class="btn auth" value=" เข้าสู่ระบบ " />
                </div>  
            </div>
            {{ Form::close(); }}
            <p class="clearfix"></p>
            <div class="login-social-link">
                <a href="#" class="facebook">
                    <i class="icon-facebook"></i>
                    Facebook
                </a>
                <a href="#" class="twitter">
                    <i class="icon-twitter"></i>
                    Twitter
                </a>
            </div>
            </form>
        </diV>
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
    function formLogin()
    {
        var data = {
            url: 'login',
            v: $('#frmLogin input:not(#btnLogin)').serializeArray(),
            form: 'frmLogin',
            redirect: ''
        };
        checkLogin(data);
    }

    $('#btnLogin').click(function() {
        formLogin();
    });

    $("#btnLogin, #password_login").keyup(function(event) {
        if (event.keyCode === 13) {
            formLogin();
        }
    });
</script>
@stop