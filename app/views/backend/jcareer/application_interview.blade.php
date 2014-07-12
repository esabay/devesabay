@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('theme/backend/default/css/bootstrap-wysihtml5-0.0.2.css')}}
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
                        <a href="{{URL::to('/backend/jcareer/jobdescription')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i> {{\Lang::get('jcareer.back')}}</a>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-success" id="btnSave"><i class="icon-save"></i> {{\Lang::get('jcareer.save')}}</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
{{ Form::open(array('class'=>'form-horizontal','role'=>'form','id'=>'form-add')) }}
<div class="row">
    <div class="col-lg-4">
        <!--widget start-->
        <aside class="profile-nav alt green-border">
            <section class="panel">
                <div class="user-heading alt green-bg">
                    <a href="#">
                        <img src="{{\URL::to(\Careerapplicationinfo::getPhoto($page['info']->id))}}" alt="">
                    </a>
                    <h1>{{$page['info']->firstname}} {{$page['info']->lastname}} @if($page['info']->nickname)({{$page['info']->nickname}})@endif</h1>
                    <p>{{$page['info']->email}}</p>
                </div>

                <ul class="nav nav-pills nav-stacked">
                    <li><a href="javascript:;"> <i class="icon-user"></i> {{\Lang::get('jcareer.sex')}} : {{\Careerapplicationinfo::getSex($page['info']->sex)}}</a></li>
                    <li><a href="javascript:;"> <i class="icon-calendar"></i> {{\Lang::get('jcareer.birthday')}} : {{$page['info']->birthday}} {{\Lang::get('jcareer.age')}} : {{\Careerapplicationinfo::getAge($page['info']->birthday)}} {{\Lang::get('jcareer.years')}}</a></li>
                    <li><a href="javascript:;"> <i class="icon-flag-checkered"></i> {{\Lang::get('jcareer.province')}} : {{\Province::getName($page['info']->PROVINCE_ID)}}</a></li>
                    <li><a href="javascript:;"> <i class="icon-phone"></i> {{\Lang::get('jcareer.mobile')}} : {{$page['info']->mobile}}</a></li>
                    <li><a href="javascript:;"> <i class="icon-location-arrow"></i> {{ \Careerapplicationinfo::getAddress($page['info']->id); }}</a></li>
                </ul>

            </section>
        </aside>
        <!--widget end-->
    </div>  
    <div class="col-lg-4">
        <section class="panel">
            <ul class="list-group">
                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jcareer.idcard')}}</h4>
                    <p class="list-group-item-text">{{$page['info']->idcard}}</p>
                </a>
                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jcareer.issue_card')}}</h4>
                    <p class="list-group-item-text">{{$page['info']->issue_card}}</p>
                </a>
                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jcareer.birthday')}}</h4>
                    <p class="list-group-item-text">{{$page['info']->birthday}}</p>
                </a>
                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jcareer.marital')}}</h4>
                    <p class="list-group-item-text">{{\Careerapplicationinfo::getMarital($page['info']->marital)}}</p>
                </a>
                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jcareer.telephone')}}</h4>
                    <p class="list-group-item-text">{{$page['info']->telephone}}</p>
                </a>
                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jcareer.mobile')}}</h4>
                    <p class="list-group-item-text">{{$page['info']->mobile}} {{\Lang::get('jcareer.smssvs')}} : {{ \Careerapplicationinfo::getSmssvs($page['info']->smssvs); }}</p>
                </a>
            </ul>
        </section>
    </div>
    <div class="col-lg-4">
        <section class="panel">
            <ul class="list-group">

                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jcareer.height')}}</h4>
                    <p class="list-group-item-text">{{$page['info']->height}} {{\Lang::get('jcareer.height_cm')}}</p>
                </a>
                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jcareer.weigth')}}</h4>
                    <p class="list-group-item-text">{{$page['info']->weigth}} {{\Lang::get('jcareer.weigth_kg')}}</p>
                </a>
                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jcareer.nationality')}}</h4>
                    <p class="list-group-item-text">{{\Country::getName($page['info']->nationality_id)}}</p>
                </a>
                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jcareer.religion')}}</h4>
                    <p class="list-group-item-text">{{\Careerapplicationinfo::getReligion($page['info']->religion_id)}}</p>
                </a>
                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jcareer.birthplace_city')}}</h4>
                    <p class="list-group-item-text">{{\Province::getName($page['info']->birthplace_city)}}</p>
                </a>               
                <a href="javascript:;" class="list-group-item ">
                    <h4 class="list-group-item-heading">{{\Lang::get('jcareer.military_status')}}</h4>
                    <p class="list-group-item-text">{{ \Careerapplicationinfo::getMilitary($page['info']->military_status); }}</p>
                </a>
            </ul>
        </section>
    </div>

</div>
<section class="panel">
    <header class="panel-heading tab-bg-dark-navy-blue">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#occupation-2" data-toggle="tab">
                    <i class="icon-user">
                        {{\Lang::get('jcareer.occupation')}}
                    </i>
                </a>
            </li>
            <li class="">
                <a href="#education-2" data-toggle="tab">
                    <i class="icon-briefcase"></i>
                    {{\Lang::get('jcareer.education')}}
                </a>
            </li>
            <li class="">
                <a href="#experience-2" data-toggle="tab">
                    <i class="icon-legal"></i>
                    {{\Lang::get('jcareer.experience')}}
                </a>
            </li>
            <li class="">
                <a href="#skill-2" data-toggle="tab">
                    <i class="icon-tags"></i>
                    {{\Lang::get('jcareer.skill_b')}}
                </a>
            </li>
            <li class="">
                <a href="#reference-2" data-toggle="tab">
                    <i class="icon-male"></i>
                    {{\Lang::get('jcareer.reference')}}
                </a>
            </li>
        </ul>
    </header>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane active" id="occupation-2">
                <div class="alert alert-success alert-block fade in">
                    <h4>
                        <i class="icon-ok-sign"></i>
                        {{\Lang::get('jcareer.position1')}}
                    </h4>
                    <p>{{ \Careerposition::getName($page['occupation']->position1); }}</p>
                </div>
                @if($page['occupation']->position2!=0)
                <div class="alert alert-info alert-block fade in">
                    <h4>
                        <i class="icon-ok-sign"></i>
                        {{\Lang::get('jcareer.position2')}}
                    </h4>
                    <p>{{ \Careerposition::getName($page['occupation']->position2); }}</p>
                </div>
                @endif
                @if($page['occupation']->position3!=0)
                <div class="alert alert-warning alert-block fade in">
                    <h4>
                        <i class="icon-ok-sign"></i>
                        {{\Lang::get('jcareer.position3')}}
                    </h4>
                    <p>{{ \Careerposition::getName($page['occupation']->position3); }}</p>
                </div>
                @endif
            </div>
            <div class="tab-pane" id="education-2">
                <div class="list-group">
                    @foreach($page['education'] as $education)                
                    <a href="javascript:;" class="list-group-item ">
                        <h4 class="list-group-item-heading">{{\Lang::get('jcareer.institute')}} {{$education->institute}}</h4>
                        <p class="list-group-item-text">{{\Lang::get('jcareer.level')}} : {{\Careerapplicationeducation::getLevel($education->level)}}</p>
                        <p class="list-group-item-text">{{\Lang::get('jcareer.faculty')}} : {{$education->faculty}}</p>
                        <p class="list-group-item-text">{{\Lang::get('jcareer.major')}} : {{$education->major}}</p>
                        <p class="list-group-item-text">{{\Lang::get('jcareer.gradyear')}} : {{$education->gradyear}}</p>
                        <p class="list-group-item-text">{{\Lang::get('jcareer.gpa')}} : {{$education->gpa}}</p>
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane" id="experience-2">
                <div class="list-group">
                    @foreach($page['experience'] as $experience)
                    @if($experience->position!='')
                    <a href="javascript:;" class="list-group-item ">
                        <h4 class="list-group-item-heading">{{$experience->company}}</h4>
                        <p class="list-group-item-text">{{\Lang::get('jcareer.duration')}} : {{$experience->ex_form}} - {{$experience->ex_to}}</p>
                        <p class="list-group-item-text">{{\Lang::get('jcareer.ex_address')}} : {{$experience->address}}</p>
                        <p class="list-group-item-text">{{\Lang::get('jcareer.ex_position')}} : {{$experience->position}}</p>
                        <p class="list-group-item-text">{{\Lang::get('jcareer.ex_salary')}} : {{$experience->salary}}</p>
                        <p class="list-group-item-text">{{\Lang::get('jcareer.ex_description')}} :</p> {{$experience->description}}
                    </a>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="tab-pane" id="skill-2">
                @if($page['skill'])
                <h4>{{\Lang::get('jcareer.skill_lang')}}</h4>
                <hr />
                <div class="row">
                    <div class="col-lg-3">
                        <section class="panel">
                            <div class="panel-body">
                                <label for="listen">{{\Lang::get('jcareer.listen')}}-{{\Lang::get('jcareer.lang_th')}}</label>
                                <div>                                            
                                    {{\Careerapplicationskill::getSkillLang($page['skill'][0]->listen_th)}}
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3">
                        <section class="panel">
                            <div class="panel-body">
                                <label for="speak">{{\Lang::get('jcareer.speak')}}-{{\Lang::get('jcareer.lang_th')}}</label>
                                <div>                                            
                                    {{\Careerapplicationskill::getSkillLang($page['skill'][0]->speak_th)}}
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3">
                        <section class="panel">
                            <div class="panel-body">
                                <label for="read">{{\Lang::get('jcareer.read')}}-{{\Lang::get('jcareer.lang_th')}}</label>
                                <div>                                            
                                    {{\Careerapplicationskill::getSkillLang($page['skill'][0]->read_th)}}
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3">
                        <section class="panel">
                            <div class="panel-body">
                                <label for="read">{{\Lang::get('jcareer.write')}}-{{\Lang::get('jcareer.lang_th')}}</label>
                                <div>                                            
                                    {{\Careerapplicationskill::getSkillLang($page['skill'][0]->write_th)}}
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
                                    {{\Careerapplicationskill::getSkillLang($page['skill'][0]->listen_en)}}
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3">
                        <section class="panel">
                            <div class="panel-body">
                                <label for="speak">{{\Lang::get('jcareer.speak')}}-{{\Lang::get('jcareer.lang_en')}}</label>
                                <div>                                            
                                    {{\Careerapplicationskill::getSkillLang($page['skill'][0]->speak_en)}}
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3">
                        <section class="panel">
                            <div class="panel-body">
                                <label for="read">{{\Lang::get('jcareer.read')}}-{{\Lang::get('jcareer.lang_en')}}</label>
                                <div>                                            
                                    {{\Careerapplicationskill::getSkillLang($page['skill'][0]->read_en)}}
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3">
                        <section class="panel">
                            <div class="panel-body">
                                <label for="read">{{\Lang::get('jcareer.write')}}-{{\Lang::get('jcareer.lang_en')}}</label>
                                <div>                                            
                                    {{\Careerapplicationskill::getSkillLang($page['skill'][0]->write_en)}}
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <hr />
                <h4>{{\Lang::get('jcareer.typing')}}</h4>
                <p>{{\Lang::get('jcareer.typing_thai')}} {{$page['skill'][0]->typing_thai}} {{\Lang::get('jcareer.typing_wor_min')}}  {{\Lang::get('jcareer.typing_english')}} {{$page['skill'][0]->typing_english}} {{\Lang::get('jcareer.typing_wor_min')}}</p>
                <hr />

                <div class="form-group">
                    {{Form::label('driving', \Lang::get('jcareer.driving'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-3">
                        <div>                                            
                            <label class="checkbox-inline radio-30">
                                {{Form::checkbox('driving_car', 0,($page['skill'][0]->driving_car == 0 ? true : false))}} 
                                {{\Lang::get('jcareer.driving_car')}}
                            </label>
                            <label class="checkbox-inline radio-30">
                                {{Form::checkbox('driving_motorcycle', 0,($page['skill'][0]->driving_motorcycle == 0 ? true : false))}} 
                                {{\Lang::get('jcareer.driving_motorcycle')}}
                            </label>
                            <label class="checkbox-inline radio-30">
                                {{Form::checkbox('driving_truck', 0,($page['skill'][0]->driving_truck == 0 ? true : false))}} 
                                {{\Lang::get('jcareer.driving_truck')}}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('own', \Lang::get('jcareer.own'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-3">
                        <div>                                            
                            <label class="checkbox-inline radio-30">
                                {{Form::checkbox('own_car', 0,($page['skill'][0]->own_car == 0 ? true : false))}} 
                                {{\Lang::get('jcareer.driving_car')}}
                            </label>
                            <label class="checkbox-inline radio-30">
                                {{Form::checkbox('own_motorcycle', 0,($page['skill'][0]->own_motorcycle == 0 ? true : false))}} 
                                {{\Lang::get('jcareer.driving_motorcycle')}}
                            </label>
                            <label class="checkbox-inline radio-30">
                                {{Form::checkbox('own_truck', 0,($page['skill'][0]->own_truck == 0 ? true : false))}} 
                                {{\Lang::get('jcareer.driving_truck')}}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('driving_li', \Lang::get('jcareer.driving_li'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-3">
                        <div>                                            
                            <label class="checkbox-inline radio-30">
                                {{Form::checkbox('licence_car', 0,($page['skill'][0]->licence_car == 0 ? true : false))}} 
                                {{\Lang::get('jcareer.licence_car')}}
                            </label>
                            <label class="checkbox-inline radio-30">
                                {{Form::checkbox('licence_motorcycle', 0,($page['skill'][0]->licence_motorcycle == 0 ? true : false))}} 
                                {{\Lang::get('jcareer.licence_motorcycle')}}
                            </label>
                            <label class="checkbox-inline radio-30">
                                {{Form::checkbox('licence_other', 0,($page['skill'][0]->licence_other == 0 ? true : false))}} 
                                {{\Lang::get('jcareer.licence_other')}}
                            </label>
                        </div>
                    </div>
                </div>                
                <hr />
                <h4>{{\Lang::get('jcareer.qualification')}}</h4>
                {{$page['skill'][0]->qualification}}
                <hr />
                <h4>{{\Lang::get('jcareer.project')}}</h4>
                {{$page['skill'][0]->project}}
                @endif
            </div>
            <div class="tab-pane" id="reference-2">
                <div class="alert alert-success alert-block fade in">
                    {{$page['skill'][0]->reference}}
                </div>                
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('jcareer.interview')}} {{\Lang::get('jcareer.info')}}
                <span class="tools pull-right">
                    <a href="javascript:;" class="icon-chevron-down"></a>                    
                </span>
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        {{ Form::textarea('interview_info', Input::old('interview_info'), array('id'=>'interview_info','class' => 'form-control', 'cols' => 100, 'rows' => 10,'style'=>'white-space:pre-wrap;')) }}
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('jcareer.interview')}} {{\Lang::get('jcareer.occupation')}}
                <span class="tools pull-right">
                    <a href="javascript:;" class="icon-chevron-down"></a>                    
                </span>
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        {{ Form::textarea('interview_occupation', Input::old('interview_occupation'), array('id'=>'interview_occupation','class' => 'form-control', 'cols' => 100, 'rows' => 10,'style'=>'white-space:pre-wrap;')) }}
                    </div>
                </div>
            </div>
        </section>
    </div> 
</div>
<div class="row">
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('jcareer.interview')}} {{\Lang::get('jcareer.education')}}
                <span class="tools pull-right">
                    <a href="javascript:;" class="icon-chevron-down"></a>                    
                </span>
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        {{ Form::textarea('interview_education', Input::old('interview_education'), array('id'=>'interview_education','class' => 'form-control', 'cols' => 100, 'rows' => 10,'style'=>'white-space:pre-wrap;')) }}
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('jcareer.interview')}} {{\Lang::get('jcareer.experience')}}
                <span class="tools pull-right">
                    <a href="javascript:;" class="icon-chevron-down"></a>                    
                </span>
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        {{ Form::textarea('interview_experience', Input::old('interview_experience'), array('id'=>'interview_experience','class' => 'form-control', 'cols' => 100, 'rows' => 10,'style'=>'white-space:pre-wrap;')) }}
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('jcareer.interview')}} {{\Lang::get('jcareer.skill_b')}}
                <span class="tools pull-right">
                    <a href="javascript:;" class="icon-chevron-down"></a>                    
                </span>
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        {{ Form::textarea('interview_skill', Input::old('interview_skill'), array('id'=>'interview_skill','class' => 'form-control', 'cols' => 100, 'rows' => 10,'style'=>'white-space:pre-wrap;')) }}
                    </div>
                </div>
            </div>
        </section>
    </div>    
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('jcareer.interview')}} {{\Lang::get('jcareer.other')}}
                <span class="tools pull-right">
                    <a href="javascript:;" class="icon-chevron-down"></a>

                </span>
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        {{ Form::textarea('interview_other', Input::old('interview_other'), array('id'=>'interview_other','class' => 'form-control', 'cols' => 100, 'rows' => 10,'style'=>'white-space:pre-wrap;')) }}
                    </div>
                </div>
            </div>
        </section>
    </div>   
</div>
<div class="row">
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('jcareer.interview_summary')}}
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        {{ Form::textarea('interview_summary', Input::old('interview_summary'), array('id'=>'interview_summary','class' => 'form-control', 'cols' => 100, 'rows' => 10,'style'=>'white-space:pre-wrap;')) }}
                    </div>
                </div>
            </div>
        </section>
    </div> 
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('jcareer.job_receive')}}
            </header>
            <div class="panel-body">
                <div class="col-lg-6">
                    <div class="col-xs-12">
                        <!--follower start-->
                        <section class="panel">
                            <div class="follower">
                                <div class="panel-body">
                                    <h4>{{$page['info']->firstname}} {{$page['info']->lastname}} @if($page['info']->nickname)({{$page['info']->nickname}})@endif</h4>
                                    <div class="follow-ava">
                                        <img src="{{\URL::to(\Careerapplicationinfo::getPhoto($page['info']->id))}}" alt="">
                                    </div>
                                </div>
                            </div>

                            <footer class="follower-foot">
                                <p></p>
                            </footer>
                        </section>
                        <!--follower end-->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="col-xs-12">
                        <!--follower start-->
                        <section class="panel">
                            <div class="follower">
                                <div class="panel-body">
                                    <h4>{{$page['info']->firstname}} {{$page['info']->lastname}} @if($page['info']->nickname)({{$page['info']->nickname}})@endif</h4>
                                    <div class="follow-ava">
                                        <img src="{{\URL::to(\Careerapplicationinfo::getPhoto($page['info']->id))}}" alt="">
                                    </div>
                                </div>
                            </div>

                            <footer class="follower-foot">
                                <p></p>
                            </footer>
                        </section>
                        <!--follower end-->
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

{{ Form::close() }}
@stop
@section('script_page_only')
{{HTML::script('theme/backend/default/js/wysihtml5-0.3.0_rc2.js')}}
{{HTML::script('theme/backend/default/js/bootstrap-wysihtml5-0.0.2.js')}}
{{HTML::script('theme/backend/default/js/jquery.form.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $(function() {
        $('#interview_info, #interview_occupation, #interview_education, #interview_experience, #interview_skill, #interview_other, #interview_summary').wysihtml5({
            "link": false,
            "image": false
        });

        var options = {
            url: base_url  + 'backend/jcareer/application/interview/add',
            success: showResponse
        };
        $('#btnSave').click(function() {
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
                    window.location.replace(base_url  + 'backend/jcareer/jobdescription');
                });
            }, 3000);
        }
    }
</script>
@stop