{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    {{Form::label('name', 'Group Name', array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('name',$page['item']->name, array('id'=>'name','placeholder' => 'Group Name','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        {{ Form::button('Update',array('class'=>'btn btn-default','id'=>'btnSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('id', $page['item']->id) }}
{{ Form::close() }}
<script type="text/javascript">

    function formSave()
    {
        var fields = $('#form-add input:not(#btnSave)').serializeArray();
        var data = {
            url: 'backend/article/group/edit',
            v: fields,
            redirect: 'backend/article/group'
        };
        saveData(data);
    }

    $('#btnSave').click(function() {
        formSave();
    });
</script>