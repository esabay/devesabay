{{ Form::open(array('class'=>'form-horizontal','id'=>'form-add','role'=>'form')) }}
@foreach($page['result'] as $item)

@if($item->spec1)
<div class="form-group">
    {{Form::label('spec1', $item->spec1, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec1',$page['item']->spec1, array('id'=>'spec1','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec2)
<div class="form-group">
    {{Form::label('spec2', $item->spec2, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec2',$page['item']->spec2, array('id'=>'spec2','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec3)
<div class="form-group">
    {{Form::label('spec3', $item->spec3, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec3',$page['item']->spec3, array('id'=>'spec3','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec4)
<div class="form-group">
    {{Form::label('spec4', $item->spec4, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec4',$page['item']->spec4, array('id'=>'spec4','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec5)
<div class="form-group">
    {{Form::label('spec5', $item->spec5, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec5',$page['item']->spec5, array('id'=>'spec5','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec6)
<div class="form-group">
    {{Form::label('spec6', $item->spec6, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec6',$page['item']->spec6, array('id'=>'spec6','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif


@if($item->spec7)
<div class="form-group">
    {{Form::label('spec7', $item->spec7, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec7',$page['item']->spec7, array('id'=>'spec7','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec8)
<div class="form-group">
    {{Form::label('spec8', $item->spec8, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec8',$page['item']->spec8, array('id'=>'spec8','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec9)
<div class="form-group">
    {{Form::label('spec9', $item->spec9, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec9',$page['item']->spec9, array('id'=>'spec9','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec10)
<div class="form-group">
    {{Form::label('spec10', $item->spec10, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec10',$page['item']->spec10, array('id'=>'spec10','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec11)
<div class="form-group">
    {{Form::label('spec11', $item->spec11, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec11',$page['item']->spec11, array('id'=>'spec11','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec12)
<div class="form-group">
    {{Form::label('spec12', $item->spec12, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec12',$page['item']->spec12, array('id'=>'spec12','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec13)
<div class="form-group">
    {{Form::label('spec13', $item->spec13, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec13',$page['item']->spec13, array('id'=>'spec13','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec14)
<div class="form-group">
    {{Form::label('spec14', $item->spec14, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec14',$page['item']->spec14, array('id'=>'spec14','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec15)
<div class="form-group">
    {{Form::label('spec15', $item->spec15, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec15',$page['item']->spec15, array('id'=>'spec15','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec16)
<div class="form-group">
    {{Form::label('spec16', $item->spec16, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec16',$page['item']->spec16, array('id'=>'spec16','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec17)
<div class="form-group">
    {{Form::label('spec17', $item->spec17, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec17',$page['item']->spec17, array('id'=>'spec17','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec18)
<div class="form-group">
    {{Form::label('spec18', $item->spec18, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec18',$page['item']->spec18, array('id'=>'spec18','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec19)
<div class="form-group">
    {{Form::label('spec19', $item->spec19, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec19',$page['item']->spec19, array('id'=>'spec19','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@if($item->spec20)
<div class="form-group">
    {{Form::label('spec20', $item->spec20, array('class' => 'col-lg-3 control-label'));}}
    <div class="col-lg-8">
        {{ Form::textarea('spec20',$page['item']->spec20, array('id'=>'spec20','class'=>'form-control','cols'=>50,'rows'=>2)) }}
    </div>
</div>
@endif

@endforeach
<div class="form-group">
    <div class="col-lg-offset-3 col-lg-8">
        {{ Form::button('Save',array('class'=>'btn btn-default','id'=>'btnDialogSave','data-style'=>'expand-right')) }}
    </div>
</div>
{{ Form::hidden('product_id',$page['item']->product_id) }}
{{ Form::close() }}
<script type="text/javascript">
    $(function() {
    $('#spec1').focus();
    });
            function formSave()
            {
            var fields = $('#form-add, textarea input:not(#btnDialogSave)').serializeArray();
                    var data = {
                    url: 'backend/jshopping/productspec/edit',
                            v: fields,
                            redirect: 'backend/jshopping/product/edit/' + {{\Request::segment(5)}} + ''
                    };
                    saveData(data);
            }

    $('#btnDialogSave').click(function() {
    formSave();
    });
</script>