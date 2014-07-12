{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    {{Form::label('name', \Lang::get('permissions.name'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('name', $page['item']->name, array('class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('description', \Lang::get('permissions.description'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('description', $page['item']->description, array('class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('level', \Lang::get('permissions.level'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-3">
        {{ Form::text('level', $page['item']->level, array('class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('permissions', \Lang::get('permissions.permissions'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-offset-2 col-lg-10">
        @foreach($page['result_permissions'] as $permissions)
        <div class="checkbox">
            <label>
                <input type="checkbox" value="{{$permissions->id}}" name="per_id[]" @if(in_array($permissions->id,$page['result_permissionrole'])) checked @endif)> {{$permissions->name}}
            </label>
        </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    {{Form::label('menu', \Lang::get('permissions.menu'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-offset-2 col-lg-10">
        @foreach($page['result_menu'] as $menu)

        <div class="checkbox">
            <label>
                <input type="checkbox" value="{{$menu->id}}" name="menu_id[]" @if(in_array($menu->id,$page['result_menurole'])) checked @endif)> {{$menu->name}}
            </label>
        </div>

        @foreach(DB::table('menu')->where('sub_id', $menu->id)->orderBy('rank', 'asc')->get() as $item)
        <label class="checkbox-inline col-lg-offset-1">
            <input type="checkbox" value="{{$item->id}}" name="menu_id[]" @if(in_array($item->id,$page['result_menurole'])) checked @endif)> {{$item->name}}
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
{{ Form::hidden('id', $page['item']->id) }}
{{ Form::close() }}
<script type="text/javascript">

    function formSave()
    {
        var fields = $('#form-add input:not(#btnDialogSave)').serializeArray();
        var data = {
            url: 'backend/setting/permissions/roles/edit',
            v: fields,
            redirect: 'backend/setting/permissions'
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