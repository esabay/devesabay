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
<?php
$in = 1;
$cn = 1;
?>
{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
@foreach($page['result'] as $item)
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{$in.'. '}}{{$item->title}}
            </header>
            <div class="panel-body">
                <div class="radios">
                    @foreach(\Examinationchoice::where('question_id', $item->id)->get() as $item2)
                    <input type="radio" value="{{$cn}}" name="choice[{{$item->id}}][]" class="choice{{$item2->id}}" /> {{$item2->title}}<br />
                    <?php $cn++; ?>
                    @endforeach
                </div>
            </div>
        </section>

    </div>
</div>
<?php $in++; ?>
<?php $cn = 1; ?>
@endforeach

<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <!--                
                -->
                <div class="form-actions">
                    <div class="pull-left">
                        <button type="button" class="btn btn-success" id="btnSave"><i class="icon-save"></i> {{\Lang::get('jexamination.save')}}</button>
                    </div>

                </div>
            </div>
        </section>
    </div>
</div>
{{ Form::hidden('id', $page['item']->id) }}
{{ Form::close() }}
@stop
@section('script_page_only')
{{HTML::script('js/form-component.js')}}
{{HTML::script('js/jquery.form.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $('#btnSave').click(function() {
        var options = {
            url: base_url + index_page + 'backend/jexamination/test/view/<?php echo $page['item']->id; ?>',
            success: showResponse
        };
        $('#form-add').ajaxSubmit(options);
        return false;
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
                text: '<strong>' + response.error.message + '</strong>',
                type: 'alert'
            };
            genModal(data);
        }
    }

    $('#myModal').on('hidden.bs.modal', function() {
        window.open(base_url + index_page + 'backend/jexamination/test', '_self');
    });
</script>
@stop