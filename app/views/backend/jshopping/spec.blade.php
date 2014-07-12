@extends('backend.layouts.master')
@section('stylesheet_page_only')

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
                @if (\User::find(\Auth::user()->id)->can('add'))
                <button type="button" class="btn btn-primary" id="btnAdd"><i class="icon-plus"></i> Add</button>
                @endif
                @if (\User::find(\Auth::user()->id)->can('edit'))
                <button type="button" class="btn btn-success" id='btnEdit'><i class="icon-edit"></i> Edit </button>
                @endif
                @if (\User::find(\Auth::user()->id)->can('delete'))
                <button type="button" class="btn btn-danger" id='btnDelete'><i class="icon-trash"></i> Delete </button>
                @endif
                <button type="button" class="btn btn-warning" id='btnMove'><i class="icon-move"></i> Move </button>
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
                        <th width="260">Title</th>
                        <th>spec 1</th>
                        <th>spec 2</th>
                        <th>spec 3</th>
                        <th>spec 4</th>
                        <th>spec 5</th>
                        <th>spec 6</th>
                        <th>spec 7</th>
                        <th>spec 8</th>
                        <th>spec 9</th>
                        <th>spec 10</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page['result'] as $item)
                    <tr>
                        <td><li class="icon-caret-right"></li>&nbsp;{{Form::radio('id[]', $item['id'],null,array('class'=>'radio-inline checkboxes','id'=>'id'))}} {{$item['title']}}</td>
                <td>{{\Productspec::getSpec($item['id'],'spec1')}}</td>
                <td>{{\Productspec::getSpec($item['id'],'spec2')}}</td>
                <td>{{\Productspec::getSpec($item['id'],'spec3')}}</td>
                <td>{{\Productspec::getSpec($item['id'],'spec4')}}</td>
                <td>{{\Productspec::getSpec($item['id'],'spec5')}}</td>
                <td>{{\Productspec::getSpec($item['id'],'spec6')}}</td>
                <td>{{\Productspec::getSpec($item['id'],'spec7')}}</td>
                <td>{{\Productspec::getSpec($item['id'],'spec8')}}</td>
                <td>{{\Productspec::getSpec($item['id'],'spec9')}}</td>
                <td>{{\Productspec::getSpec($item['id'],'spec10')}}</td>                
                </tr>                                  
                @endforeach
                </tbody>
            </table>
        </section>
    </div>
</div>
@stop
@section('script_page')
{{HTML::script('/assets/data-tables/jquery.dataTables.js')}}
{{HTML::script('/assets/data-tables/DT_bootstrap.js')}}
@stop
@section('script_page_only')
{{HTML::script('/js/dynamic-table.js')}}
@stop

@section('script_page_code')
<script type="text/javascript">
    $('#btnAdd').click(function() {
        if ($(".checkboxes:checked").val())
        {
            var data = {
                url: 'backend/jshopping/spec/add',
                title: 'Add Spec',
                v: {id: $(".checkboxes:checked").val()}
            };
            genModal(data);
        }
    });

    $('#btnEdit').click(function() {
        if ($(".checkboxes:checked").val())
        {
            var data = {
                url: 'backend/jshopping/spec/edit',
                title: 'Edit Spec',
                v: {id: $(".checkboxes:checked").val()}
            };
            genModal(data);
        }
    });

    $('#btnDelete').click(function() {
        var data = {
            url: 'backend/jshopping/spec/delete',
            title: 'Delete Spec',
            redirect: 'backend/jshopping/spec',
            table_id: '#sample_1'
        };
        deleteData(data);
    });

</script>
@stop