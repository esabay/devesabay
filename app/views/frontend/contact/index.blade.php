@extends('frontend.layouts.theme.preciso.master')
@section('content')
<div class="row"> 

    <!-- Contact Page-->
    <div class="span12"> 

        <!-- Breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Home</a> <span class="divider">/</span></li>
            <li class="active">Contact</li>
        </ul>
        <h1 class="margin-bottom">ติดต่อ<span>เรา</span></h1>
    </div>
</div>
<div class="row"> 
    <!-- Contact Map -->
    <div class="span12 margin-bottom">
        <iframe width="100%" height="360" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=13.958561,100.622948&amp;num=1&amp;ie=UTF8&amp;t=m&amp;z=18&amp;ll=13.958552,100.622935&amp;output=embed"></iframe>
    </div>
    <div class="span6">        
        <address>
            <strong>สำนักงานใหญ่</strong>
            เลขที่ 801/70-72 ม.8 ถนนพหลโยธิน ต.คูคต อ.ลำลูกกา จ.ปทุมธานี 12130
        </address>
        <address>
            <strong>เบอร์ติดต่อ</strong><br>
            02-992-5000, 094-480-1851, 094-480-1852, 094-480-1853
        </address>
        <address>
            <strong>แฟกซ์</strong><br>
            02-992-5300
        </address>
        <address>
            <strong>อีเมล์</strong><br>
            <a href="#">sale.inside.it@gmail.com</a>
        </address>
    </div>
    <div class="span6">
        <form action="#" id="form-add" class="map-form" method="post">
            <div class="control-group">
                <div class="controls">
                    <input type="text" name="name" id="name" placeholder="ชื่อ-นามสกุล">
                    <input type="text" name="phone" id="phone" placeholder="เบอร์ติดต่อ">
                    <input type="email" name="email" id="email" placeholder="อีเมล์">
                    {{\Form::select('group_id', array('' => \Lang::get('common.please_select')) + \Contactgroup::lists('title','id'), 1, array( 'id' => 'group_id'))}}
                    <input type="text" name="title" id="title" placeholder="หัวข้อ">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">รายละเอียด</label>
                <div class="controls">
                    <textarea rows="5" name="message" id="message"></textarea>
                </div>
            </div>
            <div class="control-group">
                {{ \Form::captcha(); }}
            </div>
            <div class="control-group no-margin">
                <div class="controls">
                    <input type="button" id="btnSave" class="btn" value="Send" />
                </div>
            </div>
        </form>
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
{{HTML::script('theme/backend/default/js/jquery.form.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $('#btnSave').click(function() {
        $('form #btnSave').after('&nbsp;&nbsp;<img id="imgload" src="' + base_url + 'theme/backend/default/img/ajax-loader.gif" />');
        var options = {
            url: base_url + 'contact',
            success: showResponse
        };
        $('#form-add').ajaxSubmit(options);
        return false;
    });

    function showResponse(response, statusText, xhr, $form) {
        $('form .form-group').removeClass('has-error');
        $('form .help-block').remove();
        if (response.error.status === false) {
            $('#imgload').remove();
            $.each(response.error.message, function(key, value) {
                if (key != 'recaptcha_response_field') {
                    $('#' + key).parent().parent().addClass('has-error');
                    $('#' + key).after('<p class="help-block">' + value + '</p>');
                } else {
                    alert(value);
                }

            });
        } else {
            setTimeout(function() {
                var data = {
                    title: 'Message',
                    text: '<div class="text-center">' + response.error.message + '</div>',
                    type: 'info'
                };
                genModal(data);
                $('#myModal').on('hidden.bs.modal', function() {
                    window.location.href = base_url + 'contact';
                });
            }, 3000);
        }
    }
</script>
@stop