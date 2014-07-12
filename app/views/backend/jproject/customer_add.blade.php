{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    {{Form::label('code',\Lang::get('jproject.code'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('code',Input::old('code'), array('id'=>'code','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jproject.name'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('name',Input::old('name'), array('id'=>'name','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('phone', \Lang::get('jproject.phone'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('phone',Input::old('phone'), array('id'=>'phone','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('email',\Lang::get('jproject.email'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('email',Input::old('email'), array('id'=>'email','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('address', \Lang::get('jproject.address'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::textarea('address', \Input::old('address'), array('id'=>'address','class'=>'form-control','cols'=>50,'rows'=>3)) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('description',\Lang::get('jproject.description'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::textarea('description', \Input::old('description'), array('id'=>'description','class'=>'form-control','cols'=>50,'rows'=>5)) }}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-8">
        {{ Form::button(\Lang::get('jproject.save'),array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('type', 'post') }}
{{ Form::close() }}
<script type="text/javascript">

    function formSave()
    {
        var data = {
            url: 'backend/jproject/customer/add',
            v: $('#form-add, textarea input:not(#btnDialogSave)').serializeArray(),
            redirect: 'backend/jproject/customer'
        };
        saveData(data);
    }

    $('#btnDialogSave').click(function() {
        formSave();
    });
</script>