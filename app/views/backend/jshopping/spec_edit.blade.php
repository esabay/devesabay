{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    <label for="spec1" class="col-lg-2 control-label">Spec 1</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec1" id="spec1" type="text" value="{{$page['item']['spec1']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec2" class="col-lg-2 control-label">Spec 2</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec2" id="spec2" type="text" value="{{$page['item']['spec2']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec3" class="col-lg-2 control-label">Spec 3</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec3" id="spec3" type="text" value="{{$page['item']['spec3']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec4" class="col-lg-2 control-label">Spec 4</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec4" id="spec4" type="text" value="{{$page['item']['spec4']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec5" class="col-lg-2 control-label">Spec 5</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec5" id="spec5" type="text" value="{{$page['item']['spec5']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec6" class="col-lg-2 control-label">Spec 6</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec6" id="spec6" type="text" value="{{$page['item']['spec6']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec7" class="col-lg-2 control-label">Spec 7</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec7" id="spec7" type="text" value="{{$page['item']['spec7']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec8" class="col-lg-2 control-label">Spec 8</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec8" id="spec8" type="text" value="{{$page['item']['spec8']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec9" class="col-lg-2 control-label">Spec 9</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec9" id="spec9" type="text" value="{{$page['item']['spec9']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec10" class="col-lg-2 control-label">Spec 10</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec10" id="spec10" type="text" value="{{$page['item']['spec10']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec11" class="col-lg-2 control-label">Spec 11</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec11" id="spec11" type="text" value="{{$page['item']['spec11']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec12" class="col-lg-2 control-label">Spec 12</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec12" id="spec12" type="text" value="{{$page['item']['spec12']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec13" class="col-lg-2 control-label">Spec 13</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec13" id="spec13" type="text" value="{{$page['item']['spec13']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec14" class="col-lg-2 control-label">Spec 14</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec14" id="spec14" type="text" value="{{$page['item']['spec14']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec15" class="col-lg-2 control-label">Spec 15</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec15" id="spec15" type="text" value="{{$page['item']['spec15']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec16" class="col-lg-2 control-label">Spec 16</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec16" id="spec16" type="text" value="{{$page['item']['spec16']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec17" class="col-lg-2 control-label">Spec 17</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec17" id="spec17" type="text" value="{{$page['item']['spec17']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec18" class="col-lg-2 control-label">Spec 18</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec18" id="spec18" type="text" value="{{$page['item']['spec18']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec19" class="col-lg-2 control-label">Spec 19</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec19" id="spec19" type="text" value="{{$page['item']['spec19']}}">
    </div>
</div>
<div class="form-group">
    <label for="spec20" class="col-lg-2 control-label">Spec 20</label>
    <div class="col-lg-8">
        <input class="form-control" name="spec20" id="spec20" type="text" value="{{$page['item']['spec20']}}">
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-8">
        {{ Form::button('Save',array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('id', $page['item']['id']) }}
{{ Form::hidden('categories_id',\Input::get('id')) }}
{{ Form::close() }}
<script type="text/javascript">

    function formSave()
    {
        var fields = $('#form-add input:not(#btnDialogSave)').serializeArray();
        var data = {
            url: 'backend/jshopping/spec/edit',
            v: fields,
            redirect: 'backend/jshopping/spec'
        };
        saveData(data);
    }

    $('#btnDialogSave').click(function() {
        formSave();
    });
</script>