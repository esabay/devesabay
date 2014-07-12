@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('theme/backend/default/assets/bootstrap-datepicker/css/datepicker.css')}}
@stop
@section('content')
<div class="row">
    <aside class="profile-nav col-lg-3">
        <section class="panel">
            <div class="user-heading round">
                <a href="#">
                    <img src="{{ URL::to(json_decode(trim($page['item']->avatar))->{'medium'}) }}" alt="">
                </a>
                <h1>{{$page['item']->firstname." ".$page['item']->lastname}}</h1>
                <p>{{$page['item']->email}}</p>
            </div>

            <ul class="nav nav-pills nav-stacked">
                <li><a href="{{URL::to('backend/user/profile')}}"> <i class="icon-user"></i>  {{\Lang::get('user.profile')}}</a></li>
                <li><a href="profile-activity.html"> <i class="icon-calendar"></i> {{\Lang::get('user.recent_activity')}}<span class="label label-danger pull-right r-activity">9</span></a></li>
                <li  class="active"><a href="#"> <i class="icon-edit"></i>  {{\Lang::get('user.edit_profile')}}</a></li>
            </ul>

        </section>
    </aside>
    <aside class="profile-info col-lg-9">
        <section class="panel">
            <div class="bio-graph-heading">
                กรอกข้อมูลให้ครบเพื่อให้เพื่อนๆของคุณได้รู้จักคุณมากยิ่งขึ้น.
            </div>
            <div class="panel-body bio-graph-info">
                <h1> {{\Lang::get('user.profile_info')}}</h1>
                {{ Form::open(array('class'=>'form-horizontal','id'=>'form-profile-info','role'=>'form')) }}
                <div class="form-group">
                    {{Form::label('name', \Lang::get('user.about_me'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-10">
                        {{ Form::textarea('aboutme', $page['item']->aboutme, array('id'=>'aboutme','class'=>'form-control','cols'=>30,'rows'=>10)) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('user.first_name'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('firstname', $page['item']->firstname, array('id'=>'firstname','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('user.last_name'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('lastname', $page['item']->lastname, array('id'=>'lastname','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('nickname', \Lang::get('user.nickname'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('nickname', $page['item']->nickname, array('id'=>'nickname','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('user.country'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('country', $page['item']->country, array('id'=>'country','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('user.birthday'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('birthday', $page['item']->birthday, array('id'=>'birthday','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('user.occupation'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('occupation', $page['item']->occupation, array('id'=>'occupation','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('user.email'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('email', $page['item']->email, array('id'=>'email','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('user.mobile'), array('class' => 'col-lg-2 control-label'));}}                    
                    <div class="col-lg-6">
                        {{ Form::text('mobile', $page['item']->mobile, array('id'=>'mobile','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('user.website_url'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('website', $page['item']->website, array('id'=>'website','class'=>'form-control','placeholder' => 'http://')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('user.department'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-6">
                        {{\Form::select('department_id', array('' => \Lang::get('user.please_select')) +$page['category'], $page['item']->department_id, array('class' => 'form-control', 'id' => 'department_id'))}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        {{ Form::button(\Lang::get('user.update'),array('class'=>'btn btn-success','id'=>'button-add','data-style'=>'expand-right')) }}
                    </div>
                </div>
                {{ Form::hidden('id', $page['item']->id) }}
                {{ Form::close() }}
            </div>
        </section>
        <section>
            <div class="panel panel-primary">
                <div class="panel-heading"> {{\Lang::get('user.sets_new_password&avatar')}}</div>
                <div class="panel-body">
                    {{ Form::open(array('class'=>'form-horizontal','id'=>'form-profile-login','role'=>'form','enctype'=>'multipart/form-data')) }}
                    <div class="form-group">
                        {{Form::label('name',  \Lang::get('user.new_password'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-6">
                            {{ Form::password('password', array('id'=>'password','class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('name', \Lang::get('user.re-type_new_password'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-6">
                            {{ Form::password('password_confirmation', array('id'=>'password_confirmation','class'=>'form-control')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            {{ Form::button(\Lang::get('user.update'),array('class'=>'btn btn-info','id'=>'button-add','data-style'=>'expand-right')) }}
                        </div>
                    </div>
                    {{ Form::hidden('id', $page['item']->id) }}
                    {{ Form::close() }}
                </div>
            </div>
        </section>
        <section>
            <div class="panel panel-primary">
                <div class="panel-heading">{{\Lang::get('user.sets_avatar')}}</div>
                <div class="panel-body">
                    {{ Form::open(array('class'=>'form-horizontal','id'=>'form-profile-avatar','role'=>'form','enctype'=>'multipart/form-data')) }}

                    <div class="form-group">
                        {{Form::label('name', \Lang::get('user.change_avatar'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-6">
                            {{Form::file('avatar',array('class'=>'file-pos','id'=>'avatar'))}}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <div id="validation-errors"></div>
                            <div id="output" style="display:none"></div>
                        </div>
                    </div>
                    {{ Form::hidden('id', $page['item']->id) }}
                    {{ Form::close() }}
                </div>
            </div>
        </section>
    </aside>
</div>
@stop
@section('script_page')
{{HTML::script('theme/backend/default/assets/jquery-knob/js/jquery.knob.js')}}
{{HTML::script('theme/backend/default/assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
@stop
@section('script_page_only')
{{HTML::script('theme/backend/default/js/jquery.form.js')}}
@stop

@section('script_page_code')
<script type="text/javascript">
    $(".knob").knob();
    $('#birthday').datepicker({
        format: 'yyyy-mm-dd'
    });
    function formSave()
    {
        var fields = $('#form-profile-info, textarea input:not(#button-add)').serializeArray();
        var data = {
            url: 'backend/user/profile/edit',
            v: fields,
            redirect: 'backend/user/profile'
        };
        saveData(data);
    }

    $('#form-profile-info #button-add').click(function() {
        formSave();
    });
    $("#form-profile-info input").keyup(function(event) {
        if (event.keyCode === 13) {
            formSave();
        }
    });
    //#################
    function formSave2()
    {
        var fields = $('#form-profile-login input:not(#button-add)').serializeArray();
        var data = {
            url: 'backend/user/profile/edit/login',
            v: fields,
            redirect: 'backend/user/profile'
        };
        saveData(data);
    }

    $('#form-profile-login #button-add').click(function() {
        formSave2();
    });


    $(document).ready(function() {
        var options = {
            url: base_url + 'backend/user/profile/edit/avatar',
            beforeSubmit: showRequest,
            success: showResponse,
            dataType: 'json'
        };
        $('#form-profile-avatar').delegate('#avatar', 'change', function() {
            $('#form-profile-avatar').ajaxForm(options).submit();
        });
    });
    function showRequest(formData, jqForm, options) {

        $("#validation-errors").hide().empty();
        $("#output").css('display', 'none');
        return true;
    }
    function showResponse(response, statusText, xhr, $form) {
        if (response.error)
        {
            var arr = response.error;
            var msg;
            msg = '';
            $.each(arr.message.avatar, function(index, value)
            {
                if (value.length !== 0)
                {
                    msg += '<li>' + value + '</li>';
                }

            });
            $("#validation-errors").append('<div class="alert alert-block alert-danger fade in"><p>' + msg + '</p><div>');
            $("#validation-errors").show();
        } else {
            //$("#output").html("<img src='" + response.file + "' />");
            //$("#output").css('display', 'block');
            window.location.replace(base_url + 'backend/user/profile');
        }
    }
</script>
@stop