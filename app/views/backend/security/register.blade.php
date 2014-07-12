<div class="alert alert-info fade in">
    <button type="button" class="close close-sm" data-dismiss="alert">
        <i class="icon-remove"></i>
    </button>
    <strong>แจ้งเตือน</strong> <p>หลังจากลงทะเบียนเสร็จ กรุณาแจ้งผู้ดูแลระบบเพื่อทำการเปิดใช้งานระบบ.</p>
</div>
{{ Form::open(array('class'=>'form-horizontal','id'=>'form-register','role'=>'form')) }}
<div class="login-wrap">
    <div class="form-group">
        {{Form::label('firstname', \Lang::get('security.first_name'), array('class' => 'col-lg-3 control-label'));}}
        <div class="col-lg-8">
            {{ Form::text('firstname', Input::old('firstname'), array('id'=>'firstname','class'=>'form-control')) }}
        </div>
    </div> 
    <div class="form-group">
        {{Form::label('lastname', \Lang::get('security.last_name'), array('class' => 'col-lg-3 control-label'));}}
        <div class="col-lg-8">
            {{ Form::text('lastname', Input::old('lastname'), array('id'=>'lastname','class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('phone', \Lang::get('security.phone'), array('class' => 'col-lg-3 control-label'));}}
        <div class="col-lg-8">
            {{ Form::text('phone', Input::old('phone'), array('id'=>'phone','class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('email', \Lang::get('security.email'), array('class' => 'col-lg-3 control-label'));}}
        <div class="col-lg-8">
            {{ Form::text('email', Input::old('email'), array('id'=>'email','class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('department_id', \Lang::get('security.department'), array('class' => 'col-lg-3 control-label'));}}
        <div class="col-lg-8">
            {{\Form::select('department_id', array('' => \Lang::get('user.please_select')) +$page['category'], null, array('class' => 'form-control', 'id' => 'department_id'))}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('username', \Lang::get('security.employee_id'), array('class' => 'col-lg-3 control-label'));}}
        <div class="col-lg-8">
            {{ Form::text('username', Input::old('username'), array('id'=>'username','class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('password', \Lang::get('security.password'), array('class' => 'col-lg-3 control-label'));}}
        <div class="col-lg-8">
            {{ Form::password('password', array('id'=>'password','class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label" for="password">&nbsp;</label>
        <div class="col-lg-4">
            {{ Form::button(\Lang::get('security.register'),array( 'class'=>'btn btn-lg btn-login btn-block','id'=>'btnDialogSave')) }}
        </div>
    </div>

</div>
{{ Form::close() }}
<script type="text/javascript">

    function formSave()
    {
        var data = {
            url: 'cp/register',
            v: $('#form-register,select input:not(#btnDialogSave)').serializeArray(),
            redirect: 'cp'
        };
        saveData(data);
    }
    $('body').on('click', '#btnDialogSave', function() {
        formSave();
    });
</script>