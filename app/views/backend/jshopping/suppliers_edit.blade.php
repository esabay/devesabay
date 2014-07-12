{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.company_name'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('CompanyName',$page['item']['CompanyName'], array('id'=>'CompanyName','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.contact_name'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('ContactName',$page['item']['ContactName'], array('id'=>'ContactName','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.contact_title'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('ContactTitle',$page['item']['ContactTitle'], array('id'=>'ContactTitle','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.address'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('Address', $page['item']['Address'], array('id'=>'Address','class'=>'form-control','cols'=>50,'rows'=>5)) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.email'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-6">
        {{ Form::text('Email',$page['item']['Email'], array('id'=>'Email','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.phone'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-5">
        {{ Form::text('Phone',$page['item']['Phone'], array('id'=>'Phone','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.fax'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-5">
        {{ Form::text('Fax',$page['item']['Fax'], array('id'=>'Fax','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-8">
        <div class="checkbox">
            <label>
                {{Form::checkbox('disabled', 0,($page['item']->disabled == 0 ? true : false))}} Publish
            </label>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-8">
        {{ Form::button(\Lang::get('common.save'),array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('id', $page['item']['SupplierID']) }}
{{ Form::close() }}
<script type="text/javascript">

    function formSave()
    {
        var fields = $('#form-add, textarea input:not(#btnDialogSave)').serializeArray();
        var data = {
            url: 'backend/jshopping/suppliers/edit',
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