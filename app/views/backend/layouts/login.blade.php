<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="POND">
        <meta name="keyword" content="">
        <link rel="shortcut icon" href="{{URL::to('theme/backend/default/img/favicon.html')}}">

        <title>J-Office Management</title>

        <!-- Bootstrap core CSS -->
        {{HTML::style('theme/backend/default/css/bootstrap.min.css')}}
        {{HTML::style('theme/backend/default/css/bootstrap-reset.css')}}
        <!--external css-->
        {{HTML::style('theme/backend/default/assets/font-awesome/css/font-awesome.css')}}         
        <!-- Custom styles for this template -->
        {{HTML::style('theme/backend/default/css/style.css')}}
        {{HTML::style('theme/backend/default/css/style-responsive.css')}}

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          {{HTML::script('theme/backend/default/js/html5shiv.js')}}
          {{HTML::script('theme/backend/default/js/respond.min.js')}}
        <![endif]-->
    </head>

    <body class="login-body">
        {{ Form::open(array('class'=>'form-signin','id'=>'form-signin')) }}
        <h2 class="form-signin-heading">J-OFFICE 2014</h2>
        <div class="login-wrap">
            <p class="help-block hidden"></p>
            <div class="form-group">
                {{ Form::text('username_login', Input::old('username_login'), array('id'=>'username_login','placeholder' => \Lang::get('security.employee_id_email'),'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::password('password_login', array('id'=>'password_login','placeholder' => \Lang::get('security.password'),'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::button(\Lang::get('security.login'),array( 'class'=>'btn btn-lg btn-login btn-block','id'=>'btnSave')) }}
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> {{\Lang::get('security.remember_me')}}
                <span class="pull-right"> <a href="#"> {{\Lang::get('security.forgot_password')}}</a></span>
            </label>
            <div class="registration">
                {{\Lang::get('security.dont_have_an_account_yet')}}
                <a class="getReg" href="javascript:;">
                    {{\Lang::get('security.register')}}
                </a>
            </div>
        </div>
        {{ Form::close() }}

    {{HTML::script('theme/backend/default/js/jquery.js')}}
    {{HTML::script('theme/backend/default/js/main.js')}}
    {{HTML::script('theme/backend/default/js/jquery-1.8.3.min.js')}}
    {{HTML::script('theme/backend/default/js/bootstrap.min.js')}}
    <script type="text/javascript">
        $(function() {
            $('#username_login').focus();
        });
        $('#btnSave').click(function() {
            chkLogin();
        });
        function chkLogin()
        {
            var fields = $('#form-signin input:not(#btnSave)').serializeArray();
            var data = {
                url: 'cp',
                v: fields,
                redirect: 'backend'
            };
            checkLogin(data);
        }
        $("#form-signin #password_login").keyup(function(event) {
            if (event.keyCode === 13) {
                chkLogin();
            }
        });

        $('.getReg').click(function() {
            var data = {
                url: 'cp/register',
                title: '{{\Lang::get('security.register')}}'
            };
            genModal(data);
        });
    </script>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modal Tittle</h4>
                </div>
                <div class="modal-body">

                    Body goes here...

                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button" id="button-close">Close</button>
                    <button class="btn btn-warning" type="button" id="button-confirm"> Confirm</button>
                    <button data-dismiss="modal" class="btn btn-danger" type="button" id="button-ok"> Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
</body>
</html>
