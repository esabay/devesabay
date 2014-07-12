{{HTML::style('/assets/bootstrap-datepicker/css/datepicker.css')}}
<style type="text/css">
    .datepicker{z-index:1151;}
</style>
{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    {{Form::label('code', \Lang::get('jproject.code'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-5">
        {{ Form::text('code',Input::old('code'), array('id'=>'code','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name',\Lang::get('jproject.name') , array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('name',Input::old('name'), array('id'=>'name','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('category_id', \Lang::get('jproject.category'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        <select name="category_id" id="category_id" class="form-control">
            <option selected="selected" value="">{{\Lang::get('jproject.please_select')}}</option>
            @foreach ($page['category'] as $item)
            <option value="{{$item['id']}}">{{$item['name']}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    {{Form::label('client_id', \Lang::get('jproject.customer'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        <select name="client_id" id="client_id" class="form-control">
            <option selected="selected" value="">{{\Lang::get('jproject.please_select')}}</option>
            @foreach ($page['customer'] as $item)
            <option value="{{$item['id']}}">{{$item['name']}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    {{Form::label('assigned', \Lang::get('jproject.assigned'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{\Form::select('assigned',array('' => \Lang::get('jproject.please_select')) +$page['assigned'], null, array('class' => 'form-control', 'id' => 'assigned'))}}
    </div>
</div>
<div class="form-group">
    {{Form::label('progress', \Lang::get('jproject.progress'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-2">
        {{ Form::text('progress',Input::old('progress'), array('id'=>'code','class'=>'form-control','placeholder'=>'%')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('startdate', \Lang::get('jproject.start_date'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-4">
        {{ Form::text('startdate', Input::old('startdate'), array('id'=>'startdate','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('deadline', \Lang::get('jproject.deadline'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-4">
        {{ Form::text('deadline', Input::old('deadline'), array('id'=>'deadline','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('phases', \Lang::get('jproject.phases'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('phases',Input::old('phases'), array('id'=>'phases','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('description', \Lang::get('jproject.description'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('description', \Input::old('description'), array('id'=>'description','class'=>'form-control','cols'=>50,'rows'=>10)) }}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-8">
        {{ Form::button(\Lang::get('jproject.save'),array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('type', 'post') }}
{{ Form::close() }}
{{HTML::script('/assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
<script type="text/javascript">
    $('#startdate, #deadline').datepicker({
        format: 'yyyy-mm-dd'
    });
    function formSave()
    {
        var fields = $('#form-add, textarea input:not(#btnDialogSave)').serializeArray();
        var data = {
            url: 'backend/jproject/project/add',
            v: fields,
            redirect: 'backend/jproject/project'
        };
        saveData(data);
    }

    $('#btnDialogSave').click(function() {
        formSave();
    });
</script>