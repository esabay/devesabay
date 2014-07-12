{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    {{Form::label('title', \Lang::get('jshopping.title_name'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('title',Input::old('title'), array('id'=>'title','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('description', \Lang::get('jshopping.description'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('description',Input::old('description'), array('id'=>'description','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-8">
        {{ Form::button(\Lang::get('common.save'),array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('id', \Input::get('id')) }}
{{ Form::hidden('type', \Categorize::getCategoryProvider()->findById(\Input::get('id'))->type) }}
{{ Form::close() }}
<script type="text/javascript">

    function formSave()
    {
        var data = {
            url: 'backend/posting/category/sub/add',
            v: $('#form-add input:not(#btnDialogSave)').serializeArray(),
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