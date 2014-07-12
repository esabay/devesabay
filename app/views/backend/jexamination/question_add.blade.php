{{ Form::open(array('class'=>'form-horizontal','id'=>'form-question','role'=>'form')) }}

<div class="form-group">
    {{Form::label('title', \Lang::get('jexamination.title'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('question_title',Input::old('question_title'), array('id'=>'question_title','class'=>'form-control')) }}
    </div>
</div>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#choice" data-toggle="tab">Choice</a></li>
    <li><a href="#text" data-toggle="tab">Text</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="choice">
        <p>&nbsp;</p>
        <div class="form-group">
            <label class="col-sm-2 control-label col-lg-2">{{\Lang::get('jexamination.choice')}}</label>
            <div class="col-lg-10">

                <div class="input-group m-bot15">
                    <span class="input-group-addon">
                        <input type="radio" name="choice[status][]" value="1" checked="checked">
                    </span>
                    <input type="text" name="choice[title][]" class="form-control">
                </div>

                <div class="input-group m-bot15">
                    <span class="input-group-addon">
                        <input type="radio" name="choice[status][]" value="2">
                    </span>
                    <input type="text" name="choice[title][]" class="form-control">
                </div>

                <div class="input-group m-bot15">
                    <span class="input-group-addon">
                        <input type="radio" name="choice[status][]" value="3">
                    </span>
                    <input type="text" name="choice[title][]" class="form-control">
                </div>

                <div class="input-group m-bot15">
                    <span class="input-group-addon">
                        <input type="radio" name="choice[status][]" value="4">
                    </span>
                    <input type="text" name="choice[title][]" class="form-control">
                </div>

            </div>
        </div>
    </div>
    <div class="tab-pane" id="text">
        <p>&nbsp;</p>
        <div class="form-group">
            <div class="col-lg-12">
                {{ Form::textarea('text_true', Input::old('text_true'), array('id' => 'text_true', 'class' => 'form-control', 'cols' => 50, 'rows' => 5,'style'=>'white-space:pre-wrap;')) }}
            </div>
        </div>
    </div>    
</div>




<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        {{ Form::button(\Lang::get('jexamination.save'),array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('examination_id', \Request::segment(6)) }}
{{ Form::close() }}
<script type="text/javascript">
    $('#text_true').wysihtml5();
    function formSave()
    {
        var data = {
            url: 'backend/jexamination/examination/question/add',
            v: $('#form-question, textarea input:not(#btnDialogSave)').serializeArray(),
            redirect: 'backend/jexamination/examination/edit/<?php echo \Request::segment(6); ?>'
        };
        saveData(data);
    }

    $('#btnDialogSave').click(function() {
        formSave();
    });
</script>