@extends('backend.layouts.master_front')
@section('stylesheet_page_only')
{{HTML::style('/css/bootstrap-wysihtml5-0.0.2.css')}}
@stop
@section('content')
{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{\Lang::get('jexamination.title_test')}}
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-2">
                        <section class="panel">
                            <div class="panel-body">
                                <div class="form-group">
                                    <input class="form-control" id="firstname" name="firstname" placeholder="{{\Lang::get('jexamination.firstname')}}" type="text">
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-2">
                        <section class="panel">
                            <div class="panel-body">
                                <div class="form-group">
                                    <input class="form-control" id="lastname" name="lastname" placeholder="{{\Lang::get('jexamination.lastname')}}" type="text">
                                </div> 
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-2">
                        <section class="panel">
                            <div class="panel-body">
                                <div class="form-group">
                                    <input class="form-control" id="idcard" name="idcard" placeholder="{{\Lang::get('jexamination.idcard')}}" type="text">
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>

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
@foreach($page['result'] as $item)
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{$in.'. '}}{{$item->title}}
            </header>
            <div class="panel-body">
                @if($item->text_true=='')
                <div class="radios">
                    @foreach(\Examinationchoice::where('question_id', $item->id)->orderBy(DB::raw('RAND()'))->get() as $item2)                    
                    <input type="radio" value="{{$item2->rank}}" name="choice[{{$item->id}}][]" class="choice{{$item2->id}}" /> {{$item2->title}}<br />
                    <?php $cn++; ?>                    
                    @endforeach
                </div>
                @else
                <div class="form-group">
                    <div class="col-lg-6">
                        {{ Form::textarea('choice['.$item->id.'][]',null, array('id' => 'text_true'.$in.'', 'class' => 'form-control wysihtml', 'cols' => 50, 'rows' => 10,'style'=>'white-space:pre-wrap;')) }}
                    </div>
                </div>
                @endif
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
{{HTML::script('/js/wysihtml5-0.3.0_rc2.js')}}
{{HTML::script('/js/bootstrap-wysihtml5-0.0.2.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $(function() {
        $('.wysihtml').wysihtml5();
    });
    $('#btnSave').click(function() {
        var options = {
            url: base_url + index_page + 'examination/test',
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
                text: response.error.message,
                type: 'info'
            };
            genModal(data);
            $('#myModal').on('hidden.bs.modal', function() {
                window.open(base_url + 'careers', '_self');
            });
        }
    }

</script>
@stop