{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    {{Form::label('title', \Lang::get('posting.group'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('title',Input::old('title'), array('id'=>'title','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('description', \Lang::get('posting.label_desc'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('description', \Input::old('description'), array('id'=>'description','class'=>'form-control','cols'=>50,'rows'=>5)) }}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-10">
        <div class="checkbox">
            <label>
                {{Form::checkbox('disabled', 0,null)}} {{\Lang::get('common.disabled')}}
            </label>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-8">
        {{ Form::button(\Lang::get('common.save'),array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('type', 'posting') }}
{{ Form::close() }}
<script type="text/javascript">

    function formSave()
    {
        var data = {
            url: 'backend/posting/category/add',
            v: $('#form-add, textarea input:not(#btnDialogSave)').serializeArray(),
            redirect: 'backend/posting/category'
        };
        saveData(data);
    }

    $('#btnDialogSave').click(function() {
        formSave();
    });
    $("#form-add input").keyup(function(event) {
        if (event.keyCode === 13) {
            formSave();
        }
    });
</script>