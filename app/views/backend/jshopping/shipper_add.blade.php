{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.company_name'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('title',Input::old('title'), array('id'=>'title','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.contact_name'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('contact',Input::old('contact'), array('id'=>'contact','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.email'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-6">
        {{ Form::text('email',Input::old('email'), array('id'=>'email','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.phone'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-5">
        {{ Form::text('mobile',Input::old('mobile'), array('id'=>'mobile','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.fax'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-5">
        {{ Form::text('fax',Input::old('fax'), array('id'=>'fax','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.address'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('address', Input::old('address'), array('id'=>'address','class'=>'form-control','cols'=>50,'rows'=>5)) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.remark'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('desc', Input::old('desc'), array('id'=>'desc','class'=>'form-control','cols'=>30,'rows'=>3)) }}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-8">
        <div class="checkbox">
            <label>
                {{Form::checkbox('disabled', 0,null)}} Publish
            </label>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-8">
        {{ Form::button(\Lang::get('common.save'),array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::close() }}
<script type="text/javascript">

    function formSave()
    {
        var fields = $('#form-add, textarea input:not(#btnDialogSave)').serializeArray();
        var data = {
            url: 'backend/jshopping/shipper/add',
            v: fields,
            redirect: 'backend/jshopping/shipper'
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