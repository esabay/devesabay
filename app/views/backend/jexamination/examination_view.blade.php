@extends('backend.layouts.master')
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
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{$page['item']->title}} {{\Examination::getCountQuestion($page['item']->id)}}
            </header>
            <div class="panel-body">
                <div class="alert alert-info fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="icon-remove"></i>
                    </button>
                    <strong>คำชี้แจง</strong>
                    {{$page['item']->description}}
                </div>            
            </div>
        </section>

    </div>
</div>
<?php $in = 1; ?>
@foreach($page['result'] as $item)
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{$in.'. '}}{{$item->title}}
            </header>
            <div class="panel-body">
                @if(\Examinationchoice::where('question_id', $item->id)->count()>0)
                <div class="radios">
                    @foreach(\Examinationchoice::where('question_id', $item->id)->get() as $item2)
                    <input type="radio" {{($item2->status == 0 ? 'checked="checked"' : '')}} value="" name="choice[{{$item->id}}][]"> {{$item2->title}}<br />
                    @endforeach
                </div>
                @else
                {{$item->text_true}}
                @endif
            </div>
        </section>

    </div>
</div>
<?php $in++; ?>
@endforeach
@stop
@section('script_page_only')
{{HTML::script('js/form-component.js')}}
{{HTML::script('js/jquery.form.js')}}
@stop