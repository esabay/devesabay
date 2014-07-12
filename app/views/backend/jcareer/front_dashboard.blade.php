@extends('backend.layouts.master_front')

@section('content')
<!--state overview end-->
<div class="row state-overview">
    <div class="col-lg-3 col-sm-6">
        <section class="panel">
            <div class="symbol terques">
                <i class="icon-file-text"></i>
            </div>
            <div class="value">
                <p>{{\Lang::get('jcareer.title_application')}}</p>
                <a href="{{\URL::to('careers/application/form')}}" target="_blank" class="btn btn-default btn-lg active" role="button">{{\Lang::get('common.click')}}</a>
            </div>
        </section>
    </div>
    <div class="col-lg-3 col-sm-6">
        <section class="panel">
            <div class="symbol red">
                <i class="icon-check"></i>
            </div>
            <div class="value">
                <p>{{\Lang::get('jcareer.title_test')}}</p>
                <a href="javascript:;" id="selectPos" class="btn btn-default btn-lg active" role="button">{{\Lang::get('common.click')}}</a>
            </div>
        </section>
    </div>
    <div class="col-lg-3 col-sm-6">
        <section class="panel">
            <div class="symbol yellow">
                <i class="icon-bullhorn"></i>
            </div>
            <div class="value">
                <p>{{\Lang::get('jcareer.title_career_notic')}}</p>
                <a href="{{\URL::to('careers/list')}}" target="_blank" class="btn btn-default btn-lg active" role="button">{{\Lang::get('common.click')}}</a>
            </div>
        </section>
    </div>
    <div class="col-lg-3 col-sm-6">
        <section class="panel">
            <div class="symbol blue">
                <i class="icon-bar-chart"></i>
            </div>
            <div class="value">
                <p></p>
            </div>
        </section>
    </div>
</div>
@stop
@section('script_page')

@stop
@section('script_page_only')

@stop

@section('script_page_code')
<script type="text/javascript">
    $('#selectPos').click(function() {
        var data = {
            url: 'careers/select/position',
            title: '<?php echo \Lang::get('jcareer.testing'); ?>'
        };
        genModal(data);
    });
</script>
@stop