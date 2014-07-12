@extends('backend.layouts.master_front')
@section('stylesheet_page_only')
{{HTML::style('theme/backend/default/assets/bootstrap-datepicker/css/datepicker.css')}}
{{HTML::style('theme/backend/default/assets/bootstrap-daterangepicker/daterangepicker-bs3.css')}}
{{HTML::style('theme/backend/default/assets/bootstrap-datetimepicker/css/datetimepicker.css')}}
{{HTML::style('theme/backend/default/assets/bootstrap-fileupload/bootstrap-fileupload.css')}}
{{HTML::style('theme/backend/default/css/bootstrap-wysihtml5-0.0.2.css')}}
@stop
@section('content')
<style type="text/css">
    .radio-ln{width: 25%; float: left;}
    .radio-30{float: left;}
</style>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('jcareer.application')}}
            </header>
            <div class="panel-body">
                <div class="stepy-tab">
                    <ul id="default-titles" class="stepy-titles clearfix">
                        <li id="default-title-0" class="current-step">
                            <div>{{\Lang::get('jcareer.info')}}</div>
                        </li>
                        <li id="default-title-1" class="">
                            <div>{{\Lang::get('jcareer.occupation')}}</div>
                        </li>
                        <li id="default-title-2" class="">
                            <div>{{\Lang::get('jcareer.education')}}</div>
                        </li>
                        <li id="default-title-3" class="">
                            <div>{{\Lang::get('jcareer.experience')}}</div>
                        </li>
                        <li id="default-title-4" class="">
                            <div>{{\Lang::get('jcareer.training')}}</div>
                        </li>
                        <li id="default-title-5" class="">
                            <div>{{\Lang::get('jcareer.skill')}}</div>
                        </li>
                    </ul>
                </div>
                {{ Form::open(array('class'=>'form-horizontal','id'=>'default','role'=>'form','enctype'=>'multipart/form-data')) }}
                <fieldset title="{{\Lang::get('jcareer.info')}}" class="step" id="default-step-0">
                    <legend> </legend>
                    <div class="form-group">
                        {{Form::label('firstname', \Lang::get('jcareer.fullname'), array('class' => 'col-sm-2 control-label col-lg-2'));}}
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-lg-2">
                                    {{ Form::text('firstname', Input::old('firstname'), array('id'=>'firstname','class'=>'form-control','placeholder'=>\Lang::get('jcareer.firstname'))) }}
                                </div>
                                <div class="col-lg-2">
                                    {{ Form::text('lastname', Input::old('lastname'), array('id'=>'lastname','class'=>'form-control','placeholder'=>\Lang::get('jcareer.lastname'))) }}
                                </div>
                                <div class="col-lg-2">
                                    {{ Form::text('nickname', Input::old('nickname'), array('id'=>'nickname','class'=>'form-control','placeholder'=>\Lang::get('jcareer.nickname'))) }}
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('nation_type', \Lang::get('jcareer.nation_type'), array('class' => 'col-sm-2 control-label col-lg-2'));}}
                        <div class="col-lg-3">
                            <div class="radio">
                                <label>
                                    {{Form::radio('nation_type', 0,null,array('checked'))}} 
                                    {{\Lang::get('jcareer.nation_type_th')}}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    {{Form::radio('nation_type', 1,null)}} 
                                    {{\Lang::get('jcareer.nation_type_other')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('idcard', \Lang::get('jcareer.idcard'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('idcard', Input::old('idcard'), array('id'=>'idcard','class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('passport_no', \Lang::get('jcareer.passport_no'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('passport_no', Input::old('passport_no'), array('id'=>'passport_no','class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('issue_card', \Lang::get('jcareer.issue_card'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-md-2 col-xs-11">
                            <div data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="{{date('Y-m-d')}}"  class="input-append date dpYears">
                                <input type="text" readonly="" value="0000-00-00" class="form-control" id="issue_card" name="issue_card">
                                <span class="input-group-btn add-on">
                                    <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('birthday', \Lang::get('jcareer.birthday'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-md-2 col-xs-11">
                            <div data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="1964-01-01"  class="input-append date dpYears">
                                <input type="text" readonly="" value="0000-00-00" class="form-control" id="birthday" name="birthday">
                                <span class="input-group-btn add-on">
                                    <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('sex', \Lang::get('jcareer.sex'), array('class' => 'col-sm-2 control-label col-lg-2'));}}
                        <div class="col-lg-3">
                            <div class="radio">
                                <label>
                                    {{Form::radio('sex', 0,null,array('checked'))}} 
                                    {{\Lang::get('jcareer.sex_male')}}
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    {{Form::radio('sex', 1,null)}} 
                                    {{\Lang::get('jcareer.sex_female')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('name', \Lang::get('jcareer.marital'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{Form::select('marital', array('' => \Lang::get('common.please_select')) + 
                                            array(
                                            '0' => \Lang::get('jcareer.marital_0'),
                                            '1' => \Lang::get('jcareer.marital_1'),
                                            '2' => \Lang::get('jcareer.marital_2'),
                                            '3' => \Lang::get('jcareer.marital_3')
                                            ), null,array('class' => 'form-control', 'id' => 'marital'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('height', \Lang::get('jcareer.height'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{ Form::text('height', Input::old('height'), array('id'=>'height','class'=>'form-control')) }}
                        </div>
                        {{\Lang::get('jcareer.height_cm')}}
                    </div>
                    <div class="form-group">
                        {{Form::label('weigth', \Lang::get('jcareer.weigth'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{ Form::text('weigth', Input::old('weigth'), array('id'=>'weigth','class'=>'form-control')) }}
                        </div>
                        {{\Lang::get('jcareer.weigth_kg')}}
                    </div>
                    <div class="form-group">
                        {{Form::label('nationality_id', \Lang::get('jcareer.nationality'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{\Form::select('nationality_id', array('' => \Lang::get('common.please_select')) + \Country::lists('short_name','country_id'), '221', array('class' => 'form-control', 'id' => 'nationality_id'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('religion_id', \Lang::get('jcareer.religion'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{Form::select('religion_id',array('' => \Lang::get('common.please_select')) + 
                                            array(
                                            '0' => \Lang::get('jcareer.religion_0'),
                                            '1' => \Lang::get('jcareer.religion_1'),
                                            '2' => \Lang::get('jcareer.religion_2'),
                                            '3' => \Lang::get('jcareer.religion_3'),
                                            '4' => \Lang::get('jcareer.religion_4'),
                                            '5' => \Lang::get('jcareer.religion_5'),
                                            '6' => \Lang::get('jcareer.religion_6'),
                                            '7' => \Lang::get('jcareer.religion_7'),
                                            '8' => \Lang::get('jcareer.religion_8')
                                            ), null,array('class' => 'form-control', 'id' => 'religion_id'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('birthplace_city', \Lang::get('jcareer.birthplace_city'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{\Form::select('birthplace_city', array('' => \Lang::get('common.please_select')) + \Province::orderBy('PROVINCE_NAME','asc')->lists('PROVINCE_NAME','PROVINCE_ID'), null, array('class' => 'form-control', 'id' => 'birthplace_city'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('address', \Lang::get('jcareer.address'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-5">
                            {{ Form::text('address', Input::old('address'), array('id'=>'address','class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('province', \Lang::get('jcareer.province'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ \Form::select('province', array('' => \Lang::get('common.please_select')) + DB::table('province')
                                ->orderBy('PROVINCE_NAME', 'asc')
                                ->lists('PROVINCE_NAME', 'PROVINCE_ID'), null, array('class' => 'form-control', 'id' => 'province')); }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('amphur', \Lang::get('jcareer.amphur'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ \Form::select('amphur', array('' => \Lang::get('common.please_select')), null, array('class' => 'form-control', 'id' => 'amphur'));}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('district', \Lang::get('jcareer.district'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ \Form::select('district', array('' => \Lang::get('common.please_select')), null, array('class' => 'form-control', 'id' => 'district'));}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('zipcode', \Lang::get('jcareer.zipcode'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('zipcode',Input::old('zipcode'), array('id'=>'zipcode','class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('telephone', \Lang::get('jcareer.telephone'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{ Form::text('telephone', Input::old('telephone'), array('id'=>'telephone','class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('mobile', \Lang::get('jcareer.mobile'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{ Form::text('mobile', Input::old('mobile'), array('id'=>'mobile','class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('email', \Lang::get('jcareer.email'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{ Form::text('email', Input::old('email'), array('id'=>'email','class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('smssvs', \Lang::get('jcareer.smssvs'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{Form::select('smssvs',array('' => \Lang::get('common.please_select')) + 
                                            array(
                                            '0' => \Lang::get('jcareer.smssvs_0'),
                                            '1' => \Lang::get('jcareer.smssvs_1'),
                                            '2' => \Lang::get('jcareer.smssvs_2'),
                                            '3' => \Lang::get('jcareer.smssvs_3'),
                                            '4' => \Lang::get('jcareer.smssvs_4')
                                            ), null,array('class' => 'form-control', 'id' => 'smssvs'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('military_status', \Lang::get('jcareer.military_status'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{Form::select('military_status',array(
                                            '0' => \Lang::get('jcareer.military_0'),
                                            '1' => \Lang::get('jcareer.military_1'),
                                            '2' => \Lang::get('jcareer.military_2')
                                            ), '1',array('class' => 'form-control', 'id' => 'military_status'))}}
                        </div>
                    </div>
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
                                        <span class="fileupload-new"><i class="icon-paper-clip"></i> {{\Lang::get('jcareer.select_image')}}</span>
                                        <span class="fileupload-exists"><i class="icon-undo"></i> {{\Lang::get('jcareer.change')}}</span>
                                        <input type="file" name="photo" id="photo" class="default" />
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> {{\Lang::get('jcareer.remove')}}</a>
                                </div>
                            </div>
                            <span class="label label-danger">NOTE!</span>
                            <span>
                                เพื่อความสวยงามควรทำรูปมาให้ขนาดพอดี
                            </span>
                        </div>
                    </div>
                </fieldset>
                <fieldset title="{{\Lang::get('jcareer.occupation')}}" class="step" id="default-step-1" >
                    <legend> </legend>
                    <div class="form-group">
                        {{Form::label('position1', \Lang::get('jcareer.position1'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{\Form::select('position1', array('' => \Lang::get('common.please_select')) + \Careerposition::where('disabled',0)->lists('title','id'), null, array('class' => 'form-control', 'id' => 'position1'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('position2', \Lang::get('jcareer.position2'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{\Form::select('position2', array('' => \Lang::get('common.please_select')) + \Careerposition::where('disabled',0)->lists('title','id'), null, array('class' => 'form-control', 'id' => 'position2'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('position3', \Lang::get('jcareer.position3'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{\Form::select('position3', array('' => \Lang::get('common.please_select')) + \Careerposition::where('disabled',0)->lists('title','id'), null, array('class' => 'form-control', 'id' => 'position3'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('expect_salary', \Lang::get('jcareer.expect_salary'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{ Form::text('expect_salary', Input::old('expect_salary'), array('id'=>'expect_salary','class'=>'form-control')) }}
                        </div>
                    </div>
                </fieldset>
                <fieldset title="{{\Lang::get('jcareer.education')}}" class="step" id="default-step-2" >
                    <legend> </legend>
                    <div class="alert alert-info fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="icon-remove"></i>
                        </button>
                        <strong>Help.</strong> {{\Lang::get('jcareer.edu_help')}}
                    </div>
                    <h4>1)</h4>
                    <div class="form-group">
                        {{Form::label('province', \Lang::get('jcareer.province'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ \Form::select('edu_province[]', array('' => \Lang::get('common.please_select')) + DB::table('province')
                                ->orderBy('PROVINCE_NAME', 'asc')
                                ->lists('PROVINCE_NAME', 'PROVINCE_ID'), null, array('class' => 'form-control', 'id' => 'edu_province')); }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('level', \Lang::get('jcareer.level'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{Form::select('edu_level[]',array('' => \Lang::get('common.please_select')) + 
                                            array(
                                            '0' => \Lang::get('jcareer.level_0'),
                                            '1' => \Lang::get('jcareer.level_1'),
                                            '2' => \Lang::get('jcareer.level_2'),
                                            '3' => \Lang::get('jcareer.level_3'),
                                            '4' => \Lang::get('jcareer.level_4'),
                                            '5' => \Lang::get('jcareer.level_5'),
                                            '6' => \Lang::get('jcareer.level_6'),
                                            ), null,array('class' => 'form-control', 'id' => 'edu_level'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('institute', \Lang::get('jcareer.institute'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('edu_institute[]', Input::old('edu_institute'), array('id'=>'edu_institute','class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('faculty', \Lang::get('jcareer.faculty'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('edu_faculty[]', Input::old('edu_faculty'), array('id'=>'edu_faculty','class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('major', \Lang::get('jcareer.major'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('edu_major[]', Input::old('edu_major'), array('id'=>'edu_major','class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('gradyear', \Lang::get('jcareer.gradyear'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{ Form::text('edu_gradyear[]', Input::old('edu_gradyear'), array('id'=>'edu_gradyear','class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('gpa', \Lang::get('jcareer.gpa'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{ Form::text('edu_gpa[]', Input::old('edu_gpa'), array('id'=>'edu_gpa','class'=>'form-control')) }}
                        </div>
                    </div>
                    <hr />
                    <h4>2)</h4>
                    <div class="form-group">
                        {{Form::label('province', \Lang::get('jcareer.province'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ \Form::select('edu_province[]', array('' => \Lang::get('common.please_select')) + DB::table('province')
                                ->orderBy('PROVINCE_NAME', 'asc')
                                ->lists('PROVINCE_NAME', 'PROVINCE_ID'), null, array('class' => 'form-control', 'id' => 'edu_province')); }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('level', \Lang::get('jcareer.level'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{Form::select('edu_level[]',array('' => \Lang::get('common.please_select')) + 
                                            array(
                                            '0' => \Lang::get('jcareer.level_0'),
                                            '1' => \Lang::get('jcareer.level_1'),
                                            '2' => \Lang::get('jcareer.level_2'),
                                            '3' => \Lang::get('jcareer.level_3'),
                                            '4' => \Lang::get('jcareer.level_4'),
                                            '5' => \Lang::get('jcareer.level_5'),
                                            '6' => \Lang::get('jcareer.level_6'),
                                            ), null,array('class' => 'form-control', 'id' => 'edu_level'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('institute', \Lang::get('jcareer.institute'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('edu_institute[]', Input::old('edu_institute'), array('id'=>'edu_institute','class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('faculty', \Lang::get('jcareer.faculty'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('edu_faculty[]', Input::old('edu_faculty'), array('id'=>'edu_faculty','class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('major', \Lang::get('jcareer.major'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('edu_major[]', Input::old('edu_major'), array('id'=>'edu_major','class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('gradyear', \Lang::get('jcareer.gradyear'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{ Form::text('edu_gradyear[]', Input::old('edu_gradyear'), array('id'=>'edu_gradyear','class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('gpa', \Lang::get('jcareer.gpa'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-2">
                            {{ Form::text('edu_gpa[]', Input::old('edu_gpa'), array('id'=>'edu_gpa','class'=>'form-control')) }}
                        </div>
                    </div>
                </fieldset>
                <fieldset title="{{\Lang::get('jcareer.experience')}}" class="step" id="default-step-3">
                    <legend> </legend>
                    <div class="alert alert-info fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="icon-remove"></i>
                        </button>
                        <strong>Help.</strong> {{\Lang::get('jcareer.ex_help')}}
                    </div>
                    <h4>1)</h4>
                    <div class="form-group">
                        {{Form::label('duration', \Lang::get('jcareer.duration'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-md-1">
                                    <div data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="102/2012" class="input-append date dpMonths">
                                        <input readonly="" value="00/0000" size="16" class="form-control" type="text" name="ex_form[]">
                                        <span class="input-group-btn add-on">
                                            <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1">
                                    <div data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="102/2012" class="input-append date dpMonths">
                                        <input readonly="" value="00/0000" size="16" class="form-control" type="text" name="ex_to[]">
                                        <span class="input-group-btn add-on">
                                            <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>                                
                            </div>

                        </div>
                    </div>                    
                    <div class="form-group">
                        {{Form::label('ex_company', \Lang::get('jcareer.ex_company'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('ex_company[]', Input::old('ex_company'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('ex_address', \Lang::get('jcareer.ex_address'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-5">
                            {{ Form::text('ex_address[]', Input::old('ex_address'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('ex_position', \Lang::get('jcareer.ex_position'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('ex_position[]', Input::old('ex_position'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('ex_salary', \Lang::get('jcareer.ex_salary'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-1">
                            {{ Form::text('ex_salary[]', Input::old('ex_salary'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('ex_description', \Lang::get('jcareer.ex_description'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-6">
                            {{ Form::textarea('ex_description[]', Input::old('ex_description'), array('id'=>'ex_description1','class' => 'form-control', 'cols' => 50, 'rows' => 5,'style'=>'white-space:pre-wrap;')) }}
                        </div>
                    </div>
                    <hr />
                    <h4>2)</h4>
                    <div class="form-group">
                        {{Form::label('duration', \Lang::get('jcareer.duration'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-md-1">
                                    <div data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="102/2012" class="input-append date dpMonths">
                                        <input readonly="" value="00/0000" size="16" class="form-control" type="text" name="ex_form[]">
                                        <span class="input-group-btn add-on">
                                            <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1">
                                    <div data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="102/2012" class="input-append date dpMonths">
                                        <input readonly="" value="00/0000" size="16" class="form-control" type="text" name="ex_to[]">
                                        <span class="input-group-btn add-on">
                                            <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>                                
                            </div>

                        </div>
                    </div> 
                    <div class="form-group">
                        {{Form::label('ex_company', \Lang::get('jcareer.ex_company'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('ex_company[]', Input::old('ex_company'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('ex_address', \Lang::get('jcareer.ex_address'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-5">
                            {{ Form::text('ex_address[]', Input::old('ex_address'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('ex_position', \Lang::get('jcareer.ex_position'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('ex_position[]', Input::old('ex_position'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('ex_salary', \Lang::get('jcareer.ex_salary'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-1">
                            {{ Form::text('ex_salary[]', Input::old('ex_salary'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('ex_description', \Lang::get('jcareer.ex_description'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-6">
                            {{ Form::textarea('ex_description[]', Input::old('ex_description'), array('id'=>'ex_description2','class' => 'form-control', 'cols' => 50, 'rows' => 5,'style'=>'white-space:pre-wrap;')) }}
                        </div>
                    </div>
                    <hr />
                    <h4>3)</h4>
                    <div class="form-group">
                        {{Form::label('duration', \Lang::get('jcareer.duration'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-md-1">
                                    <div data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="102/2012" class="input-append date dpMonths">
                                        <input readonly="" value="00/0000" size="16" class="form-control" type="text" name="ex_form[]">
                                        <span class="input-group-btn add-on">
                                            <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1">
                                    <div data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="102/2012" class="input-append date dpMonths">
                                        <input readonly="" value="00/0000" size="16" class="form-control" type="text" name="ex_to[]">
                                        <span class="input-group-btn add-on">
                                            <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>                                
                            </div>

                        </div>
                    </div> 
                    <div class="form-group">
                        {{Form::label('ex_company', \Lang::get('jcareer.ex_company'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('ex_company[]', Input::old('ex_company'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('ex_address', \Lang::get('jcareer.ex_address'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-5">
                            {{ Form::text('ex_address[]', Input::old('ex_address'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('ex_position', \Lang::get('jcareer.ex_position'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('ex_position[]', Input::old('ex_position'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('ex_salary', \Lang::get('jcareer.ex_salary'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-1">
                            {{ Form::text('ex_salary[]', Input::old('ex_salary'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('ex_description', \Lang::get('jcareer.ex_description'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-6">
                            {{ Form::textarea('ex_description[]', Input::old('ex_description'), array('id'=>'ex_description3','class' => 'form-control', 'cols' => 50, 'rows' => 5,'style'=>'white-space:pre-wrap;')) }}
                        </div>
                    </div>
                </fieldset>
                <fieldset title="{{\Lang::get('jcareer.training')}}" class="step" id="default-step-4">
                    <legend> </legend>
                    <div class="alert alert-info fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="icon-remove"></i>
                        </button>
                        <strong>Help.</strong> {{\Lang::get('jcareer.tn_help')}}
                    </div>
                    <h4>1)</h4>
                    <div class="form-group">
                        {{Form::label('duration', \Lang::get('jcareer.duration'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-md-1">
                                    <div data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="102/2012" class="input-append date dpMonths">
                                        <input readonly="" value="00/0000" size="16" class="form-control" type="text" name="tn_form[]">
                                        <span class="input-group-btn add-on">
                                            <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1">
                                    <div data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="102/2012" class="input-append date dpMonths">
                                        <input readonly="" value="00/0000" size="16" class="form-control" type="text" name="tn_to[]">
                                        <span class="input-group-btn add-on">
                                            <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>                                
                            </div>

                        </div>
                    </div> 

                    <div class="form-group">
                        {{Form::label('tn_institute', \Lang::get('jcareer.tn_institute'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('tn_institute[]', Input::old('tn_institute'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('tn_subject', \Lang::get('jcareer.tn_subject'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-4">
                            {{ Form::text('tn_subject[]', Input::old('tn_subject'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <hr />
                    <h4>2)</h4>
                    <div class="form-group">
                        {{Form::label('duration', \Lang::get('jcareer.duration'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-md-1">
                                    <div data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="102/2012" class="input-append date dpMonths">
                                        <input readonly="" value="00/0000" size="16" class="form-control" type="text" name="tn_form[]">
                                        <span class="input-group-btn add-on">
                                            <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1">
                                    <div data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="102/2012" class="input-append date dpMonths">
                                        <input readonly="" value="00/0000" size="16" class="form-control" type="text" name="tn_to[]">
                                        <span class="input-group-btn add-on">
                                            <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>                                
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('tn_institute', \Lang::get('jcareer.tn_institute'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('tn_institute[]', Input::old('tn_institute'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('tn_subject', \Lang::get('jcareer.tn_subject'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-4">
                            {{ Form::text('tn_subject[]', Input::old('tn_subject'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <hr />
                    <h4>3)</h4>
                    <div class="form-group">
                        {{Form::label('duration', \Lang::get('jcareer.duration'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-md-1">
                                    <div data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="102/2012" class="input-append date dpMonths">
                                        <input readonly="" value="00/0000" size="16" class="form-control" type="text" name="tn_form[]">
                                        <span class="input-group-btn add-on">
                                            <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1">
                                    <div data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="102/2012" class="input-append date dpMonths">
                                        <input readonly="" value="00/0000" size="16" class="form-control" type="text" name="tn_to[]">
                                        <span class="input-group-btn add-on">
                                            <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>                                
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('tn_institute', \Lang::get('jcareer.tn_institute'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-3">
                            {{ Form::text('tn_institute[]', Input::old('tn_institute'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('tn_subject', \Lang::get('jcareer.tn_subject'), array('class' => 'col-lg-2 control-label'));}}
                        <div class="col-lg-4">
                            {{ Form::text('tn_subject[]', Input::old('tn_subject'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                </fieldset>
                <fieldset title="{{\Lang::get('jcareer.skill')}}" class="step" id="default-step-5">
                    <legend> </legend>
                    <div class="row">
                        <div class="col-lg-3">
                            <section class="panel">
                                <div class="panel-body">
                                    <label for="listen">{{\Lang::get('jcareer.listen')}}-{{\Lang::get('jcareer.lang_th')}}</label>
                                    <div>                                            
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('listen_th', 0,null)}} 
                                            {{\Lang::get('jcareer.verygood')}}
                                        </label>
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('listen_th', 1,null)}} 
                                            {{\Lang::get('jcareer.good')}}
                                        </label>
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('listen_th', 2,null)}} 
                                            {{\Lang::get('jcareer.fair')}}
                                        </label>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-3">
                            <section class="panel">
                                <div class="panel-body">
                                    <label for="speak">{{\Lang::get('jcareer.speak')}}-{{\Lang::get('jcareer.lang_th')}}</label>
                                    <div>                                            
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('speak_th', 0,null)}} 
                                            {{\Lang::get('jcareer.verygood')}}
                                        </label>
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('speak_th', 1,null)}} 
                                            {{\Lang::get('jcareer.good')}}
                                        </label>
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('speak_th', 2,null)}} 
                                            {{\Lang::get('jcareer.fair')}}
                                        </label>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-3">
                            <section class="panel">
                                <div class="panel-body">
                                    <label for="read">{{\Lang::get('jcareer.read')}}-{{\Lang::get('jcareer.lang_th')}}</label>
                                    <div>                                            
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('read_th', 0,null)}} 
                                            {{\Lang::get('jcareer.verygood')}}
                                        </label>
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('read_th', 1,null)}} 
                                            {{\Lang::get('jcareer.good')}}
                                        </label>
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('read_th', 2,null)}} 
                                            {{\Lang::get('jcareer.fair')}}
                                        </label>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-3">
                            <section class="panel">
                                <div class="panel-body">
                                    <label for="read">{{\Lang::get('jcareer.write')}}-{{\Lang::get('jcareer.lang_th')}}</label>
                                    <div>                                            
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('write_th', 0,null)}} 
                                            {{\Lang::get('jcareer.verygood')}}
                                        </label>
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('write_th', 1,null)}} 
                                            {{\Lang::get('jcareer.good')}}
                                        </label>
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('write_th', 2,null)}} 
                                            {{\Lang::get('jcareer.fair')}}
                                        </label>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <section class="panel">
                                <div class="panel-body">
                                    <label for="listen">{{\Lang::get('jcareer.listen')}}-{{\Lang::get('jcareer.lang_en')}}</label>
                                    <div>                                            
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('listen_en', 0,null)}} 
                                            {{\Lang::get('jcareer.verygood')}}
                                        </label>
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('listen_en', 1,null)}} 
                                            {{\Lang::get('jcareer.good')}}
                                        </label>
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('listen_en', 2,null)}} 
                                            {{\Lang::get('jcareer.fair')}}
                                        </label>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-3">
                            <section class="panel">
                                <div class="panel-body">
                                    <label for="speak">{{\Lang::get('jcareer.speak')}}-{{\Lang::get('jcareer.lang_en')}}</label>
                                    <div>                                            
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('speak_en', 0,null)}} 
                                            {{\Lang::get('jcareer.verygood')}}
                                        </label>
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('speak_en', 1,null)}} 
                                            {{\Lang::get('jcareer.good')}}
                                        </label>
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('speak_en', 2,null)}} 
                                            {{\Lang::get('jcareer.fair')}}
                                        </label>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-3">
                            <section class="panel">
                                <div class="panel-body">
                                    <label for="read">{{\Lang::get('jcareer.read')}}-{{\Lang::get('jcareer.lang_en')}}</label>
                                    <div>                                            
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('read_en', 0,null)}} 
                                            {{\Lang::get('jcareer.verygood')}}
                                        </label>
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('read_en', 1,null)}} 
                                            {{\Lang::get('jcareer.good')}}
                                        </label>
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('read_en', 2,null)}} 
                                            {{\Lang::get('jcareer.fair')}}
                                        </label>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-3">
                            <section class="panel">
                                <div class="panel-body">
                                    <label for="read">{{\Lang::get('jcareer.write')}}-{{\Lang::get('jcareer.lang_en')}}</label>
                                    <div>                                            
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('write_en', 0,null)}} 
                                            {{\Lang::get('jcareer.verygood')}}
                                        </label>
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('write_en', 1,null)}} 
                                            {{\Lang::get('jcareer.good')}}
                                        </label>
                                        <label class="checkbox-inline radio-ln">
                                            {{Form::radio('write_en', 2,null)}} 
                                            {{\Lang::get('jcareer.fair')}}
                                        </label>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <hr />
                    <div class="form-group">
                        {{Form::label('typing', \Lang::get('jcareer.typing'), array('class' => 'col-sm-3 control-label col-lg-3'));}}
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-3">
                                    {{ Form::text('typing_thai', Input::old('typing_thai'), array('class'=>'form-control','placeholder'=>\Lang::get('jcareer.typing_thai'))) }}
                                </div>
                                <div class="col-lg-3">
                                    {{ Form::text('typing_english', Input::old('typing_english'), array('class'=>'form-control','placeholder'=>\Lang::get('jcareer.typing_english'))) }}
                                </div>
                                <div class="col-lg-3">
                                    {{\Lang::get('jcareer.typing_wor_min')}}
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('driving', \Lang::get('jcareer.driving'), array('class' => 'col-lg-3 control-label'));}}
                        <div class="col-lg-6">
                            <div>                                            
                                <label class="checkbox-inline radio-30">
                                    {{Form::checkbox('driving_car', 0,null)}} 
                                    {{\Lang::get('jcareer.driving_car')}}
                                </label>
                                <label class="checkbox-inline radio-30">
                                    {{Form::checkbox('driving_motorcycle', 0,null)}} 
                                    {{\Lang::get('jcareer.driving_motorcycle')}}
                                </label>
                                <label class="checkbox-inline radio-30">
                                    {{Form::checkbox('driving_truck', 0,null)}} 
                                    {{\Lang::get('jcareer.driving_truck')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('own', \Lang::get('jcareer.own'), array('class' => 'col-lg-3 control-label'));}}
                        <div class="col-lg-6">
                            <div>                                            
                                <label class="checkbox-inline radio-30">
                                    {{Form::checkbox('own_car', 0,null)}} 
                                    {{\Lang::get('jcareer.driving_car')}}
                                </label>
                                <label class="checkbox-inline radio-30">
                                    {{Form::checkbox('own_motorcycle', 0,null)}} 
                                    {{\Lang::get('jcareer.driving_motorcycle')}}
                                </label>
                                <label class="checkbox-inline radio-30">
                                    {{Form::checkbox('own_truck', 0,null)}} 
                                    {{\Lang::get('jcareer.driving_truck')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('driving_li', \Lang::get('jcareer.driving_li'), array('class' => 'col-lg-3 control-label'));}}
                        <div class="col-lg-6">
                            <div>                                            
                                <label class="checkbox-inline radio-30">
                                    {{Form::checkbox('licence_car', 0,null)}} 
                                    {{\Lang::get('jcareer.licence_car')}}
                                </label>
                                <label class="checkbox-inline radio-30">
                                    {{Form::checkbox('licence_motorcycle', 0,null)}} 
                                    {{\Lang::get('jcareer.licence_motorcycle')}}
                                </label>
                                <label class="checkbox-inline radio-30">
                                    {{Form::checkbox('licence_other', 0,null)}} 
                                    {{\Lang::get('jcareer.licence_other')}}
                                </label>
                                <div class="col-lg-5">
                                    {{ Form::text('licence_other_name', Input::old('licence_other_name'), array('class'=>'form-control')) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('qualification', \Lang::get('jcareer.qualification'), array('class' => 'col-lg-3 control-label'));}}
                        <div class="col-lg-6">
                            {{ Form::textarea('qualification', Input::old('qualification'), array('id'=>'qualification','class' => 'form-control', 'cols' => 50, 'rows' => 5,'style'=>'white-space:pre-wrap;')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('project', \Lang::get('jcareer.project'), array('class' => 'col-lg-3 control-label'));}}
                        <div class="col-lg-6">
                            {{ Form::textarea('project', Input::old('project'), array('id'=>'project','class' => 'form-control', 'cols' => 50, 'rows' => 5,'style'=>'white-space:pre-wrap;')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('reference', \Lang::get('jcareer.reference'), array('class' => 'col-lg-3 control-label'));}}
                        <div class="col-lg-4">
                            {{ Form::text('reference', Input::old('reference'), array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <input type="button" class="finish btn btn-danger" id="btnSave" value="{{\Lang::get('jcareer.finish')}}" />
                </fieldset>

                {{ Form::close() }}
            </div>
        </section>
    </div>
</div>
@stop
@section('script_page_only')
{{HTML::script('theme/backend/default/js/jquery.stepy.js')}}
{{HTML::script('theme/backend/default/js/form-component.js')}}
{{HTML::script('theme/backend/default/assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
{{HTML::script('theme/backend/default/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')}}
{{HTML::script('theme/backend/default/assets/bootstrap-fileupload/bootstrap-fileupload.js')}}
{{HTML::script('theme/backend/default/js/wysihtml5-0.3.0_rc2.js')}}
{{HTML::script('theme/backend/default/js/bootstrap-wysihtml5-0.0.2.js')}}
{{HTML::script('theme/backend/default/js/jquery.form.js')}}
{{HTML::script('theme/backend/default/js/advanced-form-components.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">

    $(function() {
        $('.form_datetime-component').datetimepicker();
        $('#ex_description1, #ex_description2, #ex_description3, #qualification, #project').wysihtml5({
            "link": false,
            "image": false
        });
        $('#default').stepy({
            backLabel: '<?php echo \Lang::get('common.previous'); ?>',
            block: true,
            nextLabel: '<?php echo \Lang::get('common.next'); ?>',
            titleClick: true,
            titleTarget: '.stepy-tab',
            finishButton: false
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
                console.log(element.POST_CODE);
                zipcode.val(element.POST_CODE);
            });
        });
    });

    $('#btnSave').click(function() {
        var data = {
            title: 'Confirm',
            type: 'confirm',
            text: '<?php echo \Lang::get('jcareer.dl_info'); ?>'
        };
        genModal(data);
    });
    $('body').on('click', '#myModal #button-confirm', function() {
        var options = {
            url: base_url  + 'careers/application/form',
            success: showResponse
        };
        $('#default').ajaxSubmit(options);
    });


    function showResponse(response, statusText, xhr, $form) {
        $('form .form-group').removeClass('has-error');
        $('form .help-block').remove();
        if (response.error.status === false) {
            var data = {
                title: 'Message',
                text: '<div class="text-center"><?php echo \Lang::get('jcareer.msg_error'); ?></div>',
                type: 'info'
            };
            genModal(data);
            $.each(response.error.message, function(key, value) {
                $('#' + key).parent().parent().addClass('has-error');
                $('#' + key).after('<p class="help-block">' + value + '</p>');
            });
        } else {
            var data = {
                title: 'Message',
                text: '<div class="text-center">' + response.error.message + '</div>',
                type: 'alert'
            };
            genModal(data);
            setTimeout(function() {
                $('#myModal').modal('hide');
                $('#myModal').on('hidden.bs.modal', function() {
                    window.open(base_url  + 'career/application/form', '_self');
                });
            }, 5000);
        }
    }
</script>
@stop