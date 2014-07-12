@extends('backend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            @foreach ($page['breadcrumbs'] as $key => $val)
            @if ($val === reset($page['breadcrumbs']))
            <li><a href="{{URL::to($val)}}"><i class="icon-home"></i> {{$key}}</a></li>
            @elseif ($val === end($page['breadcrumbs']))
            <li class="active">{{$key}}</li>
            @else
            <li><a href="{{URL::to($val)}}"> {{$key}}</a></li>
            @endif
            @endforeach
        </ul>
        <!--breadcrumbs end -->
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                @if (User::find(Auth::user()->id)->can('add'))
                <a href="{{URL::to('/backend/jshopping/product/add')}}" class="btn btn-mini btn-primary"><i class="icon-plus"></i> {{\Lang::get('common.add')}}</a>
                @endif
                @if (User::find(Auth::user()->id)->can('edit'))
                <a href="javascript:;" class="btn btn-mini btn-success" id="btnEdit"><i class="icon-edit"></i> {{\Lang::get('common.edit')}}</a>
                <a href="javascript:;" class="btn btn-mini btn-info" id="btnView"><i class="icon-eye-open"></i> {{\Lang::get('common.view')}}</a>
                @endif
                @if (User::find(Auth::user()->id)->can('delete'))
                <button type="button" class="btn btn-danger" id='btnDelete'><i class="icon-trash"></i> {{\Lang::get('common.delete')}}</button>
                @endif
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                Search
                <span class="tools pull-right">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                    <a href="javascript:;" class="icon-remove"></a>
                </span>
            </header>
            <div class="panel-body">
                {{ Form::open(array('class'=>'form-horizontal','id'=>'form-search','role'=>'form','method'=>'GET')) }}
                <div class="form-group">
                    {{Form::label('ProductName', \Lang::get('jshopping.product_name'), array('class' => 'col-lg-1 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('s_ProductName', trim(\Input::get('s_ProductName')), array('id'=>'s_ProductName','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('ProductCode', \Lang::get('jshopping.code'), array('class' => 'col-lg-1 control-label'));}}
                    <div class="col-lg-4">
                        {{ Form::text('s_ProductCode', trim(\Input::get('s_ProductCode')), array('id'=>'s_ProductCode','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('jshopping.category'), array('class' => 'col-lg-1 control-label'));}}
                    <div class="col-lg-4">
                        <select name="cat1" id="categories_id" class="form-control">
                            <option selected="selected" value="">{{\Lang::get('common.please_select')}}</option>
                            @foreach ($page['category'] as $item)
                            <option value="{{$item['id']}}">{{$item['title']}}</option>                            
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group" style="display: none;">
                    <label class="col-lg-1 control-label" for="price">&nbsp;</label>
                    <div class="col-lg-4">
                        <select name="cat2" id="sub1" class="form-control">
                            <option selected="selected" value="">{{\Lang::get('common.please_select')}}</option>                            
                        </select>
                    </div>
                </div>
                <div class="form-group" style="display: none;">
                    <label class="col-lg-1 control-label" for="price">&nbsp;</label>
                    <div class="col-lg-4">
                        <select name="cat3" id="sub2" class="form-control">
                            <option selected="selected" value="">{{\Lang::get('common.please_select')}}</option>                            
                        </select>
                    </div>
                </div>
                <div class="form-group" style="display: none;">
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
        </section>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                {{$page['title']}}
            </header>
            <table class="table table-striped border-top" id="sample_1">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{\Lang::get('jshopping.title')}}</th>
                        <th>{{\Lang::get('jshopping.code')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jshopping.category')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jshopping.unit_price')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jshopping.units_in_stock')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jshopping.featured')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jshopping.new')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jshopping.special')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jshopping.status')}}</th>
                        <th class="hidden-phone">{{\Lang::get('common.created_user')}}</th>
                        <th class="hidden-phone">{{\Lang::get('common.created')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page['result'] as $item)
                    <tr class="odd gradeX">
                        <td><input type="radio" class="checkboxes radio-inline" name="id" id="id" value="{{$item->ProductID}}" /></td>
                        <td>{{\Products::getPopupCover($item->ProductID)}} {{$item->ProductName}}</td>
                        <td>{{$item->ProductCode}}</td>
                        <td>{{\Categories::getSub($item->ProductID)}}</td>
                        <td>{{number_format($item->UnitPrice)}}</td>
                        <td>{{$item->UnitsInStock}}</td>
                        <td>
                            @if($item->featured == 0)
                            <span class="label label-success label-mini">Show</span>
                            @endif
                        </td>
                        <td>
                            @if($item->new == 0)
                            <span class="label label-success label-mini">Show</span>
                            @endif
                        </td>
                        <td>
                            @if($item->special == 0)
                            <span class="label label-success label-mini">Show</span>
                            @endif
                        </td>                        
                        <td>
                            @if($item->disabled == 0)
                            <span class="label label-success label-mini">Show</span>
                            @else
                            <span class="label label-warning label-mini">hidden</span>
                            @endif
                        </td>
                        <td>
                            {{\User::getUsername($item->created_user)}}
                        </td>
                        <td>
                            {{$item->created_at}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    Showing <?php echo $page['result']->getFrom(); ?> to <?php echo $page['result']->getTo(); ?> of <?php echo $page['result']->getTotal(); ?> entries
                </div>
                <div class="text-center">
                    <ul class="pagination pull-center">
                        <?php echo $page['result']->appends(array('s_ProductName' => trim(\Input::get('s_ProductName')), 's_ProductCode' => trim(\Input::get('s_ProductCode')), 'cat1' => \Input::get('cat1'), 'cat2' => \Input::get('cat2'), 'search' => 1))->links(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('script_page_code')
<script type="text/javascript">
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

    $('#btnAdd').click(function() {
        getPageUrl(base_url + 'backend/jshopping/product/add')
    });

    $('#btnEdit').click(function() {
        if ($(".checkboxes:checked").val())
        {
            window.open(base_url + 'backend/jshopping/product/edit/' + $(".checkboxes:checked").val(), '_newtab');
        } else {
            alert('กรุณาเลือกรายการ !');
        }
    });

    $('#btnView').click(function() {
        if ($(".checkboxes:checked").val())
        {
            window.open(base_url + 'backend/jshopping/product/view/' + $(".checkboxes:checked").val(), '_newtab');

        } else {
            alert('กรุณาเลือกรายการ !');
        }
    });

    $('#btnDelete').click(function() {
        var data = {
            url: 'backend/jshopping/product/delete',
            title: 'Delete Product',
            redirect: 'backend/jshopping/product',
            table_id: '#sample_1'
        };
        deleteData(data);
    });
</script>
@stop