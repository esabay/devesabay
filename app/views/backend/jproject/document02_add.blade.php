{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    {{Form::label('functions', 'Function', array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('functions', Input::old('functions'), array('id'=>'functions','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('brief_des', 'Grief Description', array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::textarea('brief_des', Input::old('brief_des'), array('id'=>'brief_des','class'=>'form-control','cols'=>50,'rows'=>5)) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('input', 'Input', array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('input', Input::old('input'), array('id'=>'input','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('source', 'Source', array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('source', Input::old('source'), array('id'=>'source','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('output', 'Output', array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('output', Input::old('output'), array('id'=>'output','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('requires', 'Requires', array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('requires', Input::old('requires'), array('id'=>'requires','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('stakeholder', 'Stakeholder', array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('stakeholder', Input::old('stakeholder'), array('id'=>'stakeholder','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('precondition', 'Precondition', array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('precondition', Input::old('precondition'), array('id'=>'precondition','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('postcondition', 'Postcondition', array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('postcondition', Input::old('postcondition'), array('id'=>'postcondition','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('main_flow', 'Main Flow', array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::textarea('main_flow1', Input::old('main_flow1'), array('id'=>'main_flow1','class'=>'form-control','cols'=>50,'rows'=>5)) }}
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2 control-label">&nbsp;</label>
    <div class="col-lg-10">
        {{ Form::textarea('main_flow2', Input::old('main_flow2'), array('id'=>'main_flow2','class'=>'form-control','cols'=>50,'rows'=>5)) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('exception_condition', 'Exception Condition', array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('exception_condition', Input::old('exception_condition'), array('id'=>'exception_condition','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-8">
        {{ Form::button('Save',array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('project_req_id', $page['project_req_id']) }}
{{ Form::close() }}

<script type="text/javascript">
    $(document).ready(function() {
        $('#function').focus();
    });

    function formSave()
    {
        var data = {
            url: 'backend/jproject/document/add/02',
            v: $('#form-add, textarea input:not(#btnDialogSave)').serializeArray(),
            redirect: 'backend/jproject/document/view/01/{{$page['project_req_id']}}'
        };
        saveData(data);
    }
    $('#btnDialogSave').click(function() {
        formSave();
    });
</script>