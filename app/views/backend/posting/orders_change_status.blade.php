{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
<div class="form-group">
    <div class="col-lg-12">
        {{\Form::select('status', array('' => \Lang::get('common.please_select')) + \Shoppingorderstatus::where('disabled',0)->lists('title2','id'), null, array('class' => 'form-control', 'id' => 'status'))}}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-offset-4 col-lg-12">
        {{ Form::button(\Lang::get('common.save'),array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('order_id', \Request::segment(6)) }}
{{ Form::close() }}
<script type="text/javascript">
    $('#btnDialogSave').click(function() {
        var data = {
            url: 'backend/jshopping/orders/change/status',
            v: $('#form-add, select input:not(#btnDialogSave)').serializeArray(),
            redirect: 'backend/jshopping/orders/view/<?php echo \Request::segment(6); ?>'
        };
        saveData(data);
    });
</script>