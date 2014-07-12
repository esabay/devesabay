{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    {{Form::label('title', \Lang::get('jexamination.title'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::text('title',Input::old('title'), array('id'=>'title','class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jexamination.group'), array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        <select name="type_id" id="type_id" class="form-control">
            <option selected="selected" value=""><?php echo \Lang::get('common.please_select'); ?></option>
            @foreach ($page['category'] as $item)
            <option value = "{{$item['id']}}">{{$item['title']}}</option>
            @foreach ($item['children'] as $item2)
            <option value = "{{$item2['id']}}">&nbsp;
                &nbsp;
                &nbsp;
                {{$item2['title']}}</option>
            @foreach ($item2['children'] as $item3)
            <option value = "{{$item3['id']}}">&nbsp;
                &nbsp;
                &nbsp;
                &nbsp;
                &nbsp;
                &nbsp;
                {{$item3['title']}}</option>
            @endforeach
            @endforeach
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    {{Form::label('name', \Lang::get('jexamination.short_detail'), array('class' => 'col-lg-3 control-label'));
    }}
    <div class="col-lg-8">
        {{ Form::textarea('description', Input::old('description'), array('id' => 'description', 'class' => 'form-control', 'cols' => 50, 'rows' => 5)) }}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-8">
        {{ Form::button(\Lang::get('jexamination.save'), array('class' => 'btn btn-default', 'id' => 'btnDialogSave', 'data-style' => 'expand-right')) }}
    </div>
</div>
{{ Form::hidden('type', 'examination') }}
{{ Form::close() }}
<script type = "text/javascript">

    function formSave()
    {
        var fields = $('#form-add, select input:not(#btnDialogSave)').serializeArray();
        var data = {
            url: 'backend/jexamination/examination/add',
            v: fields,
            redirect: 'backend/jexamination/examination'
        };
        saveData(data);
    }

    $('#btnDialogSave').click(function() {
        formSave();
    });
</script>