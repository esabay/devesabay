{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    {{Form::label('title', \Lang::get('post.title'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('title',Input::old('title'), array('id'=>'title','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('description', \Lang::get('post.description'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('description',Input::old('description'), array('id'=>'description','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-10">
        <div class="checkbox">
            <label>
                {{Form::checkbox('front', 0,null)}} {{\Lang::get('post.frontend')}}
            </label>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-8">
        {{ Form::button(\Lang::get('post.save'),array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('type', 'examination') }}
{{ Form::close() }}
<script type="text/javascript">

    function formSave()
    {
        var data = {
            url: 'backend/jexamination/group/add',
            v: $('#form-add input:not(#btnDialogSave)').serializeArray(),
            redirect: 'backend/jexamination/group'
        };
        saveData(data);
    }

    $('#btnDialogSave').click(function() {
        formSave();
    });
</script>