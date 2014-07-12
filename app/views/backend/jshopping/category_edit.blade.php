{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    {{Form::label('title', \Lang::get('jshopping.title_name'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('title',$page['item']['title'], array('id'=>'title','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('description', \Lang::get('jshopping.description'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('description',$page['item']['description'], array('id'=>'description','class'=>'form-control','cols'=>50,'rows'=>5)) }}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-8">
        {{ Form::button(\Lang::get('common.save'),array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('id', $page['item']['id']) }}
{{ Form::close() }}
<script type="text/javascript">

    function formSave()
    {
        var fields = $('#form-add, textarea input:not(#btnDialogSave)').serializeArray();
        var data = {
            url: 'backend/jshopping/category/edit',
            v: fields,
            redirect: 'backend/jshopping/category'
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