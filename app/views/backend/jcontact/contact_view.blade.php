@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('theme/backend/default/css/bootstrap-wysihtml5-0.0.2.css')}}
@stop
<!--
 @Auther : Adisorn Lamsombuth
 @Email : postyim@gmail.com
 @Website : esabay.com 
-->
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
                        <a href="{{URL::to('/backend/jcontact/contact')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i> {{\Lang::get('post.back')}}</a>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-success" id="btnSave"><i class="icon-save"></i> {{\Lang::get('post.save')}}</button>
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
                {{$page['title']}}
            </header>
            <div class="list-group">
                <a href="javascript:;" class="list-group-item">
                    <h4 class="list-group-item-heading">ชื่อ-นามสกุล</h4>
                    <p class="list-group-item-text">{{$page['item']->name}}</p>
                </a>
                <a href="javascript:;" class="list-group-item">
                    <h4 class="list-group-item-heading">เบอร์ติดต่อ</h4>
                    <p class="list-group-item-text">{{$page['item']->phone}}</p>
                </a>
                <a href="javascript:;" class="list-group-item">
                    <h4 class="list-group-item-heading">อีเมล์</h4>
                    <p class="list-group-item-text">{{$page['item']->email}}</p>
                </a>
                <a href="javascript:;" class="list-group-item">
                    <h4 class="list-group-item-heading">รายละเอียด</h4>
                    <p class="list-group-item-text">{{$page['item']->message}}</p>
                </a>
            </div>
        </section>       
    </div>
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                ตอบกลับลูกค้าผ่านอีเมล์
                <span class="tools pull-right">
                    <a class="icon-chevron-down" href="javascript:;"></a>
                    <a class="icon-remove" href="javascript:;"></a>
                </span>
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        {{ Form::textarea('message', Input::old('message'), array('id'=>'message','class' => 'form-control', 'cols' => 50, 'rows' => 10,'style'=>'white-space:pre-wrap;')) }}
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@stop
@section('script_page_only')
{{HTML::script('theme/backend/default/js/wysihtml5-0.3.0_rc2.js')}}
{{HTML::script('theme/backend/default/js/bootstrap-wysihtml5-0.0.2.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $(function() {
        $('#message').wysihtml5({
            "image": false
        });
    });
</script>
@stop