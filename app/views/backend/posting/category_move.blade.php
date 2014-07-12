{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}


@foreach ($page['result'] as $item)
<div class="col-lg-offset-1">
    <input type="radio" class="radio-inline" name="idm[]" id="idm" value="{{$item['id']}}" /> {{$item['title']}}
    @foreach ($item['children'] as $item2)
    <div class="col-lg-offset-1">
        <input type="radio" class="radio-inline" name="idm[]" id="idm" value="{{$item2['id']}}" /> {{$item2['title']}}
        @foreach ($item2['children'] as $item3)
        <div class="col-lg-offset-1">
            <input type="radio" class="radio-inline" name="idm[]" id="idm" value="{{$item3['id']}}" /> {{$item3['title']}}
        </div>
        @endforeach
    </div>
    @endforeach
</div>
@endforeach

<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        {{ Form::button('Save',array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('id', \Input::get('id')) }}
{{ Form::close() }}
<script type="text/javascript">

    function formSave()
    {
        var fields = $('#form-add input:not(#btnDialogSave)').serializeArray();
        var data = {
            url: 'backend/posting/category/move',
            v: fields,
            redirect: 'backend/posting/category'
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