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
                <a href="javascript:;" id="btnAdd" class="btn btn-mini btn-primary"><i class="icon-plus"></i> {{\Lang::get('common.add')}}</a>
                @endif
                @if (User::find(Auth::user()->id)->can('edit'))
                <a href="#" class="btn btn-mini btn-success" id="btnEdit"><i class="icon-edit"></i>{{\Lang::get('common.edit')}}</a>
                @endif
                @if (User::find(Auth::user()->id)->can('delete'))
                <button type="button" class="btn btn-danger" id='btnDelete'><i class="icon-trash"></i> {{\Lang::get('common.delete')}}</button>
                @endif
                <a href="javascript:;" id="btnAddContact" class="btn btn-mini btn-info"><i class="icon-plus"></i>  {{\Lang::get('jproject.add_contact')}}</a>
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
                        <th>{{\Lang::get('jproject.name')}}</th>
                        <th>{{\Lang::get('jproject.phone')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jproject.email')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jproject.description')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page['result'] as $item)
                    <tr class="odd gradeX">
                        <td><input type="checkbox" class="checkboxes" name="id" id="id" value="{{$item->id}}" /></td>
                        <td>{{$item->code}}-{{$item->name}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->description}}</td>
                        <td></td>
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
        var data = {
            url: 'backend/jproject/customer/add',
            title: 'Add Customer'
        };
        genModal(data);
    });
    $('#btnEdit').click(function() {
        if ($(".checkboxes:checked").val())
        {
            var data = {
                url: 'backend/jproject/customer/edit',
                title: 'Edit Customer',
                v: {id: $(".checkboxes:checked").val()}
            };
            genModal(data);
        }
    });



    $('#btnDelete').click(function() {
        var data = {
            url: 'backend/jproject/customer/delete',
            title: 'Delete Customer',
            redirect: 'backend/jproject/customer',
            table_id: '#sample_1'
        };
        deleteData(data);
    });
</script>
@stop