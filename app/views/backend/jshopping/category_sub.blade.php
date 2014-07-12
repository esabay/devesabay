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
                <div class="form-actions">
                    <div class="pull-left">
                        <a href="{{URL::to('/backend/jshopping/category')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i>  {{\Lang::get('common.back')}}</a>
                    </div>
                    <div class="pull-right">
                        @if (\User::find(\Auth::user()->id)->can('add'))
                        <button type="button" class="btn btn-primary" id="btnAdd"><i class="icon-plus"></i> {{\Lang::get('common.add')}}</button>
                        <button type="button" class="btn btn-primary" id="btnAddSub"><i class="icon-plus"></i> {{\Lang::get('common.add_sub')}}</button>
                        <button type="button" class="btn btn-primary" id="btnViewSub"><i class="icon-eye-open"></i> {{\Lang::get('common.view_sub')}}</button>
                        @endif
                        @if (\User::find(\Auth::user()->id)->can('edit'))
                        <button type="button" class="btn btn-success" id='btnEdit'><i class="icon-edit"></i> {{\Lang::get('common.edit')}}</button>
                        @endif
                        @if (\User::find(\Auth::user()->id)->can('delete'))
                        <button type="button" class="btn btn-danger" id='btnDelete'><i class="icon-trash"></i> {{\Lang::get('common.delete')}}</button>
                        @endif
                        <button type="button" class="btn btn-warning" id='btnMove'><i class="icon-move"></i> Move </button>
                    </div>
                </div>

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
                        <th>{{\Lang::get('jshopping.title')}}</th>
                        <th>{{\Lang::get('jshopping.description')}}</th>
                        <th><i class=" icon-edit"></i>{{\Lang::get('jshopping.status')}}</th>
                        <th>{{\Lang::get('common.created')}}</th>
                        <th>{{\Lang::get('common.updated')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page['result'] as $item)
                    <tr>
                        <td>{{Form::radio('id[]', $item->id,null,array('class'=>'radio-inline checkboxes','id'=>'id'))}} {{$item->title}}</td>
                <td>{{$item->description}}</td>
                <td>
                    @if($item->disabled== 0)
                    <span class="label label-success label-mini">Show</span>
                    @else
                    <span class="label label-warning label-mini">hidden</span>
                    @endif
                </td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->updated_at}}</td>
                </tr>    
                @endforeach
                </tbody>
            </table>
        </section>
    </div>
</div>
@stop
@section('script_page')
{{HTML::script('theme/backend/default/assets/data-tables/jquery.dataTables.js')}}
{{HTML::script('theme/backend/default/assets/data-tables/DT_bootstrap.js')}}
@stop
@section('script_page_only')
{{HTML::script('theme/backend/default/js/dynamic-table.js')}}
@stop

@section('script_page_code')
<script type="text/javascript">
    $('#btnAdd').click(function() {
        var data = {
            url: 'backend/jshopping/category/add',
            title: 'Add Category'
        };
        genModal(data);
    });

    $('#btnAddSub').click(function() {
        if ($(".checkboxes:checked").val())
        {
            var data = {
                url: 'backend/jshopping/category/sub/add',
                title: 'Add Sub Category',
                v: {id: $(".checkboxes:checked").val()}
            };
            genModal(data);
        }
    });

    $('#btnViewSub').click(function() {
        window.open(base_url + 'backend/jshopping/category/sub/' + $(".checkboxes:checked").val() + '', '_self');
    });

    $('#btnEdit').click(function() {
        if ($(".checkboxes:checked").val())
        {
            var data = {
                url: 'backend/jshopping/category/edit',
                title: 'Edit Category',
                v: {id: $(".checkboxes:checked").val()}
            };
            genModal(data);
        }
    });

    $('#btnMove').click(function() {
        if ($(".checkboxes:checked").val())
        {
            var data = {
                url: 'backend/jshopping/category/move',
                title: 'Move Category',
                v: {id: $(".checkboxes:checked").val()}
            };
            genModal(data);
        }
    });

    $('#btnDelete').click(function() {
        var data = {
            url: 'backend/jshopping/category/delete',
            title: 'Delete Category',
            redirect: 'backend/jshopping/category',
            table_id: '#sample_1'
        };
        deleteData(data);
    });

</script>
@stop