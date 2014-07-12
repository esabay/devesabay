{{ Form::open(array('class'=>'form-horizontal','id'=>'form-edit','role'=>'form')) }}
<div class="form-group">
    {{Form::label('name', \Lang::get('jshopping.cost_price'), array('class' => 'col-lg-2 control-label'));}}
    <div class="col-lg-10">
        {{ Form::text('UnitPrice',$page['item']->UnitPrice, array('id'=>'UnitPrice','class'=>'form-control')) }}
    </div>
</div>
<?php $i = 1; ?>
@foreach($page['result'] as $item)
<div class="form-group">
    <label class="col-sm-2 control-label col-lg-2" for="name">price {{$i}}</label>                            
    <div class="col-lg-5">
        <div class="input-group m-bot15">
            <span class="input-group-addon">
                {{Form::radio('active1', $i,($item->active1 == 0 ? true : false))}}
            </span>
            <input type="text" name="price1[]" class="form-control" value="{{($item->price1!=0 ? $item->price1 : '')}}" placeholder="ราคาขายปลีก">
        </div>
    </div>
    <div class="col-lg-5">
        <div class="input-group m-bot15">
            <span class="input-group-addon">
                {{Form::radio('active2', $i,($item->active2 == 0 ? true : false))}}
            </span>
            <input type="text" name="price2[]" class="form-control" value="{{($item->price2!=0 ? $item->price2 : '')}}" placeholder="ราคาขายส่ง">

        </div>
    </div>
</div>
<?php $i++; ?>
<input type="hidden" name="price_id[]" value="{{$item->id}}" />
@endforeach
<div class="form-group">
    <div class="col-lg-offset-5 col-lg-7">
        {{ Form::button(\Lang::get('common.save'),array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('product_id', $page['item']->ProductID) }}
{{ Form::close() }}
<script type="text/javascript">

    $('#btnDialogSave').click(function() {
        var data = {
            url: 'backend/jshopping/productprice/edit/<?php echo $page['item']->ProductID; ?>',
            v: $('#form-edit input:not(#btnDialogSave)').serializeArray(),
            redirect: 'backend/jshopping/product/edit/<?php echo $page['item']->ProductID; ?>',
            form : '#form-edit'
        };
        saveData(data);
    });

</script>