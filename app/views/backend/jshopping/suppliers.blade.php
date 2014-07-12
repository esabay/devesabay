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
                <button type="button" class="btn btn-primary" id="btnAdd"><i class="icon-plus"></i> Add</button>
                @endif
                @if (User::find(Auth::user()->id)->can('edit'))
                <button type="button" class="btn btn-success" id='btnEdit'><i class="icon-edit"></i> Edit </button>
                @endif
                @if (User::find(Auth::user()->id)->can('delete'))
                <button type="button" class="btn btn-danger" id='btnDelete'><i class="icon-trash"></i> Delete </button>
                @endif
                @if (User::find(Auth::user()->id)->can('save'))
                <button type="button" class="btn btn-info" id='btnExport'><i class="icon-save"></i> Save</button>
                @endif
                @if (User::find(Auth::user()->id)->can('print'))
                <button type="button" class="btn btn-info" id='btnPrint'><i class="icon-print"></i> Print</button>
                @endif
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
                        <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                        <th>CompanyName</th>
                        <th>ContactName</th>
                        <th>ContactTitle</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Fax</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page['result'] as $item)
                    <tr class="odd gradeX">
                        <td><input type="checkbox" class="checkboxes" name="id" id="id" value="{{$item->SupplierID}}" /></td>
                        <td>{{$item->CompanyName}}</td>
                        <td>{{$item->ContactName}}</td>
                        <td>{{$item->ContactTitle}}</td>
                        <td>{{$item->Address}}</td>
                        <td>{{$item->Phone}}</td>
                        <td>{{$item->Fax}}</td>
                        <td>
                            @if($item->disabled == 0)
                            <span class="label label-success label-mini">Show</span>
                            @else
                            <span class="label label-warning label-mini">hidden</span>
                            @endif
                        </td>
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
            url: 'backend/jshopping/suppliers/add',
            title: 'Add Suppliers'
        };
        genModal(data);
    });

    $('#btnEdit').click(function() {
        if ($(".checkboxes:checked").val())
        {
            var data = {
                url: 'backend/jshopping/suppliers/edit',
                title: 'Edit Suppliers',
                v: {id: $(".checkboxes:checked").val()}
            };
            genModal(data);
        }
    });

    $('#btnDelete').click(function() {
        var data = {
            url: 'backend/jshopping/suppliers/delete',
            title: 'Delete Suppliers',
            redirect: 'backend/jshopping/suppliers',
            table_id: '#sample_1'
        };
        deleteData(data);
    });

</script>
@stop