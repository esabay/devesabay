@extends('frontend.layouts.theme.preciso.master')
@section('content')
<style type="text/css">
    #form-search .input {width: 260px; float: left;}
</style>
<div class="row"> 
    <div class="span1 sidebar"></div>
    <div class="span11" style="margin-top:10px;">        
        {{ Form::open(array('class'=>'form-horizontal','id'=>'form-search','role'=>'form','method'=>'GET')) }}
        <div class="form-group input">
            {{Form::label('ProductName', \Lang::get('jshopping.product_name'));}}
            <div class="col-lg-6">
                {{ Form::text('s_ProductName', trim(\Input::get('s_ProductName')), array('id'=>'s_ProductName','class'=>'form-control')) }}
            </div>
        </div>
        <div class="form-group input">
            {{Form::label('ProductCode', \Lang::get('jshopping.code'));}}
            <div class="col-lg-4">
                {{ Form::text('s_ProductCode', trim(\Input::get('s_ProductCode')), array('id'=>'s_ProductCode','class'=>'form-control')) }}
            </div>
        </div>
        <div class="form-group input">
            {{Form::label('name', \Lang::get('jshopping.category'));}}
            <div class="col-lg-4">
                <div class="col-lg-6">
                    {{\Form::select('cat1', array('' => \Lang::get('common.please_select')) +$page['category'], \Input::get('cat1'), array('class' => 'form-control', 'id' => 'categories_id'))}}
                </div>

            </div>
        </div>
        <div class="form-group input" style="display: none;">
            <label class="col-lg-1 control-label" for="price">&nbsp;</label>
            <div class="col-lg-4">
                <select name="cat2" id="sub1" class="form-control">
                    <option selected="selected" value="">{{\Lang::get('common.please_select')}}</option>                            
                </select>
            </div>
        </div>
        <div class="form-group input" style="display: none;">
            <label class="col-lg-1 control-label" for="price">&nbsp;</label>
            <div class="col-lg-4">
                <select name="cat3" id="sub2" class="form-control">
                    <option selected="selected" value="">{{\Lang::get('common.please_select')}}</option>                            
                </select>
            </div>
        </div>
        <div class="form-group input" style="display: none;">
            <label class="col-lg-1 control-label" for="price">&nbsp;</label>
            <div class="col-lg-4">
                <select name="cat4" id="sub3" class="form-control">
                    <option selected="selected" value="">{{\Lang::get('common.please_select')}}</option>                            
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-1">&nbsp;</label>
            <div class="col-lg-4">
                <button type="submit" class="btn btn-success">Search</button>
            </div>
        </div>
        {{ Form::hidden('search', true) }}
        {{ Form::close() }}
    </div>    
</div>

<div class="row">    
    <div class="span12" id="showcontent">         
        <table class="table table-hover">
            <thead>
                <tr>

                    <th></th>
                    <th class="p-name">ชื่อสินค้า</th>
                    <th>ประกัน</th>
                    <th>ขายปลีก</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($page['result'] as $item_prod)
                <tr>
                    <td class="thumb-cart">
                        <a href="{{ \URL::to('/product/view/' . $item_prod->ProductID); }}" target="_blank">
                            <img src="{{ \URL::to(\Products::getImgCover($item_prod->ProductID)); }}" alt="{{ $item_prod->ProductName; }}" />
                        </a>
                    </td>
                    <td class="p-name">
                        <h5>
                            <a href="{{ \URL::to('/product/view/' . $item_prod->ProductID); }}" target="_blank">
                                {{ $item_prod->ProductName; }}
                            </a>
                        </h5>
                    </td>
                    <td>&nbsp;</td>
                    <td><strong>{{(\Products::getPrice($item_prod->ProductID)!='' ? number_format(\Products::getPrice($item_prod->ProductID)) : 'CALL')}}</strong></td>
                    <td>
                        <a href="javascript:;" id="{{ $item_prod->ProductID; }}" class="btn btn-default btn-xs btnAddCart"><i class="icon-shopping-cart"></i></a>
                    </td>
                </tr>  

                @endforeach
            </tbody>
        </table>
        <!-- Pagination -->

        <div class="text-center">
            Showing <?php echo $page['result']->getFrom(); ?> to <?php echo $page['result']->getTo(); ?> of <?php echo $page['result']->getTotal(); ?> entries
        </div>


        <div class="pagination text-center">
            <ul class="pagination pull-center">
                <?php echo $page['result']->appends(array('s_ProductName' => trim(\Input::get('s_ProductName')), 's_ProductCode' => trim(\Input::get('s_ProductCode')), 'cat1' => \Input::get('cat1'), 'cat2' => \Input::get('cat2'), 'search' => 1))->links(); ?>
            </ul>
        </div>
    </div>
</div>
@stop
@section('small_banner')
{{ $page['small_banner']; }}
@stop
@section('brands_list')
{{ $page['brands_list']; }}
@stop
@section('script_page_code')
<script type="text/javascript">
    $(function() {
        var edit_category = <?php echo (\Input::has('cat1') ? \Input::get('cat1') : 0); ?>;
        var edit_sub1 = <?php echo (\Input::has('cat2') ? \Input::get('cat2') : 0); ?>;
        if ($('#categories_id').val()) {
            $('#sub1').parent().parent().show();
            $.get("{{ url('get/category/sub')}}",
                    {option: edit_category},
            function(data) {
                var sub1 = $('#sub1');
                sub1.empty();
                $.each(data.children, function(index, element) {
                    var sub1_select = (element.id === '' + edit_sub1 + '' ? "selected" : "");
                    sub1.append("<option value='" + element.id + "' " + sub1_select + ">" + element.title + "</option>");
                });
            });
        }
    });

    $('#categories_id').change(function() {
        $('#sub2').parent().parent().hide();
        $('#sub2').empty();
        $('#sub3').parent().parent().hide();
        $('#sub3').empty();
        $.get("{{ url('get/category/sub')}}",
                {option: $(this).val()},
        function(data) {
            if (data.children.length > 0) {
                var sub1 = $('#sub1');
                sub1.parent().parent().show();
                sub1.empty();
                sub1.append("<option value=''><?php echo \Lang::get('common.please_select'); ?></option>");
                $.each(data.children, function(index, element) {
                    sub1.append("<option value='" + element.id + "'>" + element.title + "</option>");
                });
            }
        });
    });
    $('#sub1').change(function() {
        $('#sub2').parent().parent().hide();
        $('#sub2').empty();
        $('#sub3').parent().parent().hide();
        $('#sub3').empty();
        $.get("{{ url('get/category/sub')}}",
                {option: $(this).val()},
        function(data) {
            if (data.children.length > 0) {
                var sub2 = $('#sub2');
                sub2.parent().parent().show();
                sub2.empty();
                sub2.append("<option value=''><?php echo \Lang::get('common.please_select'); ?></option>");
                $.each(data.children, function(index, element) {
                    sub2.append("<option value='" + element.id + "'>" + element.title + "</option>");
                });
            }
        });
    });
    $('#sub2').change(function() {
        $.get("{{ url('get/category/sub')}}",
                {option: $(this).val()},
        function(data) {
            if (data.children.length > 0) {
                var sub3 = $('#sub3');
                sub3.parent().parent().show();
                sub3.empty();
                sub3.append("<option value=''><?php echo \Lang::get('common.please_select'); ?></option>");
                $.each(data.children, function(index, element) {
                    sub3.append("<option value='" + element.id + "'>" + element.title + "</option>");
                });
            }
        });
    });
    $(function() {
        $('#nav-accordion').dcAccordion({
            eventType: 'click',
            autoClose: true,
            saveState: true,
            disableLink: true,
            speed: 'slow',
            showCount: false,
            autoExpand: true,
            classExpand: 'dcjq-current-parent'
        });
    });
</script>
@stop
