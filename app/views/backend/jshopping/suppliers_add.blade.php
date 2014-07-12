{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.company_name'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('CompanyName',Input::old('CompanyName'), array('id'=>'CompanyName','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.contact_name'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('ContactName',Input::old('ContactName'), array('id'=>'ContactName','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.contact_title'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('ContactTitle',Input::old('ContactTitle'), array('id'=>'ContactTitle','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.address'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('Address', Input::old('Address'), array('id'=>'Address','class'=>'form-control','cols'=>50,'rows'=>5)) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.email'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-6">
        {{ Form::text('Email',Input::old('Email'), array('id'=>'Email','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.phone'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-5">
        {{ Form::text('Phone',Input::old('Phone'), array('id'=>'Phone','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.fax'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-5">
        {{ Form::text('Fax',Input::old('Fax'), array('id'=>'Fax','class'=>'form-control')) }}
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
            url: 'backend/jshopping/suppliers/add',
            v: fields,
            redirect: 'backend/jshopping/suppliers'
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