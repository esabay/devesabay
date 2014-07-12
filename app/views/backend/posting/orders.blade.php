@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('theme/backend/default/assets/bootstrap-datepicker/css/datepicker.css')}}
{{HTML::style('theme/backend/default/assets/bootstrap-datetimepicker/css/datetimepicker.css')}}
@stop
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
                @if (User::find(Auth::user()->id)->can('view'))
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
                    {{Form::label('order_code', \Lang::get('jshopping.order_code'), array('class' => 'col-lg-1 control-label'));}}
                    <div class="col-lg-2">
                        {{ Form::text('s_code', trim(\Input::get('s_code')), array('id'=>'s_code','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('order_customer', \Lang::get('jshopping.order_customer'), array('class' => 'col-lg-1 control-label'));}}
                    <div class="col-lg-4">
                        {{ Form::text('customer', trim(\Input::get('customer')), array('id'=>'customer','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('order_date', \Lang::get('jshopping.order_date'), array('class' => 'col-lg-1 control-label'));}}
                    <div class="col-lg-2">
                        <div data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="1964-01-01"  class="input-append date dpYears">
                            <input type="text" readonly="" value="0000-00-00" class="form-control" id="birthday" name="birthday">
                            <span class="input-group-btn add-on">
                                <button class="btn btn-danger" type="button"><i class="icon-calendar"></i></button>
                            </span>
                        </div>
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
                        <th>{{\Lang::get('jshopping.order_code')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jshopping.order_date')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jshopping.order_customer')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jshopping.order_payment')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jshopping.order_total')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jshopping.order_payment_status')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jshopping.order_status')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page['result'] as $item)
                    <tr class="odd gradeX">
                        <td><input type="radio" class="checkboxes radio-inline" name="id" id="id" value="{{$item->id}}" /></td>
                        <td>{{$item->code}}</td>
                        <td>{{\Shoppingorder::DateThai($item->created_at)}}</td>
                        <td>{{\User::getFullName($item->user_id)}}</td>
                        <td>{{\Shoppingorder::getPaymentMedthod($item->payment_id)}}</td>
                        <td>{{number_format($item->total_price)}}</td>
                        <td>{{\Shoppingorderstatus::getStatusCp($item->status)}}</td>
                        <td>{{\Shoppingorder::getOrderStatus($item->disabled)}}</td>                        
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
                        <?php echo $page['result']->appends(array('s_ProductName' => trim(\Input::get('s_ProductName')), 's_ProductCode' => trim(\Input::get('s_ProductCode')), 's_CategoryID' => \Input::get('s_CategoryID'), 'search' => 1))->links(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('script_page_only')
{{HTML::script('theme/backend/default/assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
{{HTML::script('theme/backend/default/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')}}
{{HTML::script('theme/backend/default/js/advanced-form-components.js')}}
@stop
@section('script_page_code')
<script type="text/javascript">
    $(function() {
        $('.form_datetime-component').datetimepicker();
    });
    $('#btnView').click(function() {
        window.open(base_url  + 'backend/jshopping/orders/view/' + $(".checkboxes:checked").val(), '_newtab');
    });
</script>
@stop