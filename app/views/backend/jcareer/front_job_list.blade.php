@extends('backend.layouts.master_front')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{$page['title']}}
            </header>
            <div class="panel-body">
                <div class="alert alert-info fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="icon-remove"></i>
                    </button>
                    <strong>คำชี้แจง</strong>
                </div>            
            </div>
        </section>

    </div>
</div>
@foreach($page['result'] as $item)
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{$item->title}} {{\Lang::get('jcareer.amount')}} {{$item->amount}} {{\Lang::get('jcareer.job_amount')}}
            </header>
            <div class="panel-body">
                <h4>{{\Lang::get('jcareer.job_qualification')}}</h4>
                {{$item->qualification}}
                <a href="{{\URL::to('careers/list/view/'.$item->id.'')}}" target="_blank" class="btn btn-info active" role="button">{{\Lang::get('common.more')}}</a>
            </div>
        </section>

    </div>
</div>
@endforeach
@stop