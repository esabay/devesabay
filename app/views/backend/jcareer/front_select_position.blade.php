{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    <div class="col-lg-12">
        {{\Form::select('position', array('' => \Lang::get('jcareer.please_select_position')) + \Careerposition::where('disabled',0)->lists('title','id'), null, array('class' => 'form-control', 'id' => 'position'))}}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-12">
        {{ \Form::select('test', array('' => \Lang::get('jcareer.please_select_test')), null, array('class' => 'form-control', 'id' => 'test'));}}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-4 col-lg-12">
        {{ Form::button(\Lang::get('jcareer.testing'),array('class'=>'btn btn-default','id'=>'btnSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::close() }}
<script type="text/javascript">
    $('#position').change(function() {
        $.get("{{ url('get/test')}}",
                {option: $(this).val()},
        function(data) {
            var test = $('#test');
            test.empty();
            test.append("<option value=''><?php echo \Lang::get('jcareer.please_select_test'); ?></option>");
            $.each(data, function(index, element) {
                test.append("<option value='" + element.id + "'>" + element.title + "</option>");
            });
        });
    });

    $('#test').change(function() {
        var id_test = $("#test option:selected").val();
        $('#btnSave').click(function() {
            $('#myModal').modal('hide');
            $('#myModal').on('hidden.bs.modal', function(e) {
                window.open(base_url  + 'examination/test/' + id_test + '', '_self');
            });
        });
    });
</script>