{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    {{Form::label('name', \Lang::get('user.username'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('username', $page['item']->username, array('id'=>'username','placeholder' => 'Username','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name',  \Lang::get('user.email'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('email', $page['item']->email, array('id'=>'email','placeholder' => 'Email','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <div class="checkbox">
            <label>
                {{Form::checkbox('verified', 1,($page['item']->verified == 1 ? true : false))}} Verify
            </label>
        </div>
        <div class="checkbox">
            <label>
                {{Form::checkbox('disabled', 1,($page['item']->disabled == 1 ? true : false))}} Disable
            </label>
        </div>
    </div>
</div>
<div class="form-group">
    {{Form::label('role', \Lang::get('user.role'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-offset-2 col-lg-10">
        @foreach($page['result_roles'] as $item)
        <div class="checkbox">
            <label>
                <input type="checkbox" value="{{$item->id}}" name="role_id[]" @if(in_array($item->id,$page['result_user_role'])) checked @endif)> {{$item->name}}
            </label>
        </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        {{ Form::button('Save',array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('id', $page['item']->id) }}
{{ Form::close() }}
<script type="text/javascript">

    function formSave()
    {
        var fields = $('#form-add input:not(#btnDialogSave)').serializeArray();
        var data = {
            url: 'backend/setting/user/edit',
            v: fields,
            redirect: 'backend/setting/user'
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