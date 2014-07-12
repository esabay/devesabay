@extends('backend.layouts.master')

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
                <li class="active"><a href="{{URL::to('backend/user/profile')}}"> <i class="icon-user"></i> {{\Lang::get('user.profile')}}</a></li>
                <li><a href="profile-activity.html"> <i class="icon-calendar"></i>{{\Lang::get('user.recent_activity')}}<span class="label label-danger pull-right r-activity">9</span></a></li>
                <li><a href="{{URL::to('backend/user/profile/edit')}}"> <i class="icon-edit"></i> {{\Lang::get('user.edit_profile')}} </a></li>
            </ul>

        </section>
    </aside>
    <aside class="profile-info col-lg-9">
        <section class="panel">
            <form>
                <textarea placeholder="Whats in your mind today?" rows="2" class="form-control input-lg p-text-area"></textarea>
            </form>
            <footer class="panel-footer">
                <button class="btn btn-danger pull-right"> {{\Lang::get('user.post')}}</button>
                <ul class="nav nav-pills">
                    <li>
                        <a href="#"><i class="icon-map-marker"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-camera"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class=" icon-film"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="icon-microphone"></i></a>
                    </li>
                </ul>
            </footer>
        </section>
        <section class="panel">
            <div class="bio-graph-heading">
                Aliquam ac magna metus. Nam sed arcu non tellus fringilla fringilla ut vel ispum. Aliquam ac magna metus.
            </div>
            <div class="panel-body bio-graph-info">
                <h1>{{\Lang::get('user.bio_graph')}}</h1>
                <div class="row">
                    <div class="bio-row">
                        <p><span> {{\Lang::get('user.first_name')}} </span>: {{$page['item']->firstname}}</p>
                    </div>
                    <div class="bio-row">
                        <p><span>{{\Lang::get('user.last_name')}} </span>: {{$page['item']->lastname}}</p>
                    </div>
                    <div class="bio-row">
                        <p><span>{{\Lang::get('user.country')}} </span>: Australia</p>
                    </div>
                    <div class="bio-row">
                        <p><span>{{\Lang::get('user.birthday')}}</span>: {{$page['item']->birthday}}</p>
                    </div>
                    <div class="bio-row">
                        <p><span>{{\Lang::get('user.occupation')}} </span>: {{$page['item']->occupation}}</p>
                    </div>
                    <div class="bio-row">
                        <p><span>{{\Lang::get('user.email')}} </span>: {{$page['item']->email}}</p>
                    </div>
                    <div class="bio-row">
                        <p><span>{{\Lang::get('user.mobile')}} </span>: {{$page['item']->mobile}}</p>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="bio-chart">
                                <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="35" data-fgColor="#e06b7d" data-bgColor="#e8e8e8">
                            </div>
                            <div class="bio-desk">
                                <h4 class="red">Envato Website</h4>
                                <p>Started : 15 July</p>
                                <p>Deadline : 15 August</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="bio-chart">
                                <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="63" data-fgColor="#4CC5CD" data-bgColor="#e8e8e8">
                            </div>
                            <div class="bio-desk">
                                <h4 class="terques">ThemeForest CMS </h4>
                                <p>Started : 15 July</p>
                                <p>Deadline : 15 August</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="bio-chart">
                                <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="75" data-fgColor="#96be4b" data-bgColor="#e8e8e8">
                            </div>
                            <div class="bio-desk">
                                <h4 class="green">VectorLab Portfolio</h4>
                                <p>Started : 15 July</p>
                                <p>Deadline : 15 August</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="bio-chart">
                                <input class="knob" data-width="100" data-height="100" data-displayPrevious=true  data-thickness=".2" value="50" data-fgColor="#cba4db" data-bgColor="#e8e8e8">
                            </div>
                            <div class="bio-desk">
                                <h4 class="purple">Adobe Muse Template</h4>
                                <p>Started : 15 July</p>
                                <p>Deadline : 15 August</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </aside>
</div>
@stop
@section('script_page')
{{HTML::script('theme/backend/default/assets/jquery-knob/js/jquery.knob.js')}}
@stop
@section('script_page_only')
@stop

@section('script_page_code')
<script type="text/javascript">
    $(".knob").knob();
</script>
@stop