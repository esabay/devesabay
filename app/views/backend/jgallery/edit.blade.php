{{HTML::style('/assets/bootstrap-fileupload/bootstrap-fileupload.css')}}
{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form','enctype'=>'multipart/form-data')) }}
<div class="form-group">
    {{Form::label('title', \Lang::get('post.title'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-9">
        {{ Form::text('name',$page['item']['name'], array('id'=>'name','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('categories_id', \Lang::get('post.group'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-9">
        {{\Form::select('categories_id', $page['category'], $page['item']['categories_id'], array('class' => 'form-control', 'id' => 'categories_id'))}}
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3">{{\Lang::get('post.image_cover')}}</label>
    <div class="controls col-md-9">
        <div data-provides="fileupload" class="fileupload fileupload-new">
            <span class="btn btn-white btn-file">
                <span class="fileupload-new"><i class="icon-paper-clip"></i> Select file</span>
                <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                <input type="file" name="imgcover" id="imgcover" class="default">
            </span>
            <span style="margin-left:5px;" class="fileupload-preview"></span>
            <a style="float: none; margin-left:5px;" data-dismiss="fileupload" class="close fileupload-exists" href="#"></a>
        </div>
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('post.short_detail'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-9">
        {{ Form::textarea('shortdetail',$page['item']['shortdetail'], array('id'=>'shortdetail','class'=>'form-control','cols'=>50,'rows'=>10)) }}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
        <div class="checkbox">
            <label>
                {{Form::checkbox('disabled', 0,($page['item']->disabled == 0 ? true : false))}} {{\Lang::get('post.publish')}}
            </label>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
        <div class="checkbox">
            <label>
                {{Form::checkbox('frontend', 0,($page['item']->frontend == 0 ? true : false))}} {{\Lang::get('post.frontend')}}
            </label>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
        {{ Form::button(\Lang::get('post.save'),array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('id', $page['item']['id']) }}
{{ Form::close() }}
{{HTML::script('/assets/bootstrap-fileupload/bootstrap-fileupload.js')}}
{{HTML::script('/js/jquery.form.js')}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#name').focus();
        var options = {
            url: base_url + index_page + 'backend/jgallery/edit',
            success: showResponse
        };
        $('#btnDialogSave').click(function() {
            $('#form-add').ajaxSubmit(options);
            return false;
        });
    });

    function showResponse(response, statusText, xhr, $form) {
        $('form .form-group').removeClass('has-error');
        $('form .help-block').remove();
        if (response.error.status === false) {
            $.each(response.error.message, function(key, value) {
                $('#' + key).parent().parent().addClass('has-error');
                $('#' + key).after('<p class="help-block">' + value + '</p>');
            });
        } else {
            $('form #btnDialogSave').after('&nbsp;&nbsp;<img id="imgload" src="' + base_url + 'img/ajax-loader.gif" />');
            setTimeout(function() {
                $('#myModal').modal('hide');
                $('#myModal').on('hidden.bs.modal', function() {
                    window.location.replace(base_url + index_page + 'backend/jgallery');
                });
            }, 3000);
        }
    }
</script>