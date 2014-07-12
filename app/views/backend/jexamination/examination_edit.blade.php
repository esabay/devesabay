@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('/assets/bootstrap-datepicker/css/datepicker.css')}}
{{HTML::style('/assets/bootstrap-fileupload/bootstrap-fileupload.css')}}
{{HTML::style('/css/bootstrap-wysihtml5-0.0.2.css')}}
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
                        <a href="{{URL::to('/backend/jexamination/examination')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i> {{\Lang::get('jexamination.back')}}</a>
                        <button type="button" class="btn btn-primary" id='btnQuestionAdd'><i class="icon-plus"></i> Add Question</button>
                        <button type="button" class="btn btn-success" id='btnQuestionEdit'><i class="icon-edit"></i> Edit Question</button>
                        <button type="button" class="btn btn-danger" id='btnQuestionDelete'><i class="icon-trash"></i> Delete Question</button>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-success" id="btnSave"><i class="icon-save"></i> {{\Lang::get('jexamination.save')}}</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="row">
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                {{$page['title']}}
            </header>
            <div class="panel-body">

                <div class="form-group">
                    {{Form::label('name', \Lang::get('jexamination.title'), array('class' => 'col-lg-3 control-label'));}}
                    <div class="col-lg-8">
                        {{ Form::text('title',$page['item']->title, array('id'=>'title','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('jexamination.group'), array('class' => 'col-lg-3 control-label'));}}
                    <div class="col-lg-8">
                        {{\Form::select('type_id', array('' => 'Please Select.') + $page['category'], $page['item']->type_id, array('class' => 'form-control', 'id' => 'type_id'))}}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('jexamination.short_detail'), array('class' => 'col-lg-3 control-label'));}}
                    <div class="col-lg-8">
                        {{ Form::textarea('description', $page['item']->description, array('id'=>'description','class'=>'form-control','cols'=>50,'rows'=>10)) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-8">
                        <div class="checkbox">
                            <label>
                                {{Form::checkbox('disabled', 0,($page['item']->disabled == 0 ? true : false))}} {{\Lang::get('jexamination.publish')}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
{{ Form::hidden('id', $page['item']->id) }}
{{ Form::close() }}

<?php $in = 1; ?>
@foreach(\Examinationquestion::where('examination_id', $page['item']->id)->get() as $item)
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <input type="radio" value="{{$item->id}}" name="question[]" class="question"> {{$in.'. '}}{{$item->title}}
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
{{HTML::script('/js/form-component.js')}}
{{HTML::script('/assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
{{HTML::script('/js/jquery.form.js')}}
{{HTML::script('/js/wysihtml5-0.3.0_rc2.js')}}
{{HTML::script('/js/bootstrap-wysihtml5-0.0.2.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $('#btnQuestionAdd').click(function() {
        var data = {
            url: 'backend/jexamination/examination/question/add/<?php echo \Request::segment(5); ?>',
            title: 'Add Question'
        };
        genModal(data);
    });

    $('#btnQuestionEdit').click(function() {
        if ($(".question:checked").val())
        {
            var data = {
                url: 'backend/jexamination/examination/question/edit/' + $(".question:checked").val() + '',
                title: 'Edit Question'
            };
            genModal(data);
        } else {
            alert('กรุณาเลือกรายการ !');
        }
    });


    $('#btnSave').click(function() {
        var options = {
            url: base_url + index_page + 'backend/jexamination/examination/edit',
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
                text: '<div class="text-center"><p><img src="' + base_url + 'img/ajax-loader.gif" /></p>' + response.error.message + '</div>',
                type: 'alert'
            };
            genModal(data);
            setTimeout(function() {
                $('#myModal').modal('hide');
                $('#myModal').on('hidden.bs.modal', function() {
                    window.open(base_url + index_page + 'backend/jexamination/examination', '_self');
                });
            }, 3000);
        }
    }

    $('#btnQuestionDelete').click(function() {
        var data = {
            title: 'Delete',
            type: 'confirm',
            text: 'คุณต้องการลบรายการนี้ใช่หรือไม่ ?'
        };
        genModal(data);
        $('#myModal #button-confirm').attr('value', $(this).attr('rel'));
        $('body').on('click', '#myModal #button-confirm', function() {
            $.ajax({
                type: "post",
                url: base_url + index_page + 'backend/jexamination/examination/question/delete',
                data: {id: $(".question:checked").val()},
                cache: false,
                dataType: 'json',
                success: function(result) {
                    try {
                        if (result.error.status === true)
                        {
                            $('#myModal .modal-footer').hide();
                            $('#myModal .modal-body').empty();
                            $('#myModal .modal-body').html('<div class="text-center">' + result.error.message + '</div>');
                            setTimeout(function() {
                                $('#myModal').modal('hide');
                                $('#myModal').on('hidden.bs.modal', function(e) {
                                    window.open(base_url + index_page + 'backend/jexamination/examination/edit/<?php echo \Request::segment(5); ?>', '_self');
                                });
                            }, 3000);
                        } else {
                            $.fancybox(result.error.message);
                        }
                    } catch (e) {
                        alert('Exception while request..');
                    }
                },
                error: function(e) {
                    alert('Error while request..');
                }
            });
        });
    });
</script>
@stop