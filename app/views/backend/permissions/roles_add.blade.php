{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    {{Form::label('name', \Lang::get('permissions.name'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('name', Input::old('name'), array('class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('description', \Lang::get('permissions.description'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('description', Input::old('description'), array('class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('level', \Lang::get('permissions.level'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-3">
        {{ Form::text('level', Input::old('level'), array('class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('permissions',\Lang::get('permissions.permissions'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-offset-2 col-lg-10">
        @foreach($page['result_permissions'] as $permissions)
        <label class="checkbox-inline">
            {{Form::checkbox('per_id[]', $permissions->id)}} {{$permissions->name}}
        </label>
        @endforeach
    </div>
</div>
<div class="form-group">
    {{Form::label('menu', \Lang::get('permissions.menu'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-offset-2 col-lg-10">
        @foreach($page['result_menu'] as $menu)

        <div class="checkbox">
            <label>
                {{Form::checkbox('menu_id[]', $menu->id)}} {{$menu->name}}
            </label>
        </div>

        @foreach(DB::table('menu')->where('sub_id', $menu->id)->get() as $item)
        <label class="checkbox-inline col-lg-offset-1">
            {{Form::checkbox('menu_id[]', $item->id)}} {{$item->name}}
        </label>
        @endforeach

        @endforeach
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        {{ Form::button( \Lang::get('common.save'),array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::close() }}
<script type="text/javascript">

    function formSave()
    {
        var fields = $('#form-add input:not(#btnDialogSave)').serializeArray();
        var data = {
            url: 'backend/setting/permissions/roles/add',
            v: fields,
            redirect: 'backend/setting/permissions'
        };
        saveData(data);
    }

    $('#btnDialogSave').click(function() {
        formSave();
    });
    $("form input").keyup(function(event) {
        if (event.keyCode === 13) {
            formSave();
        }
    });
</script>