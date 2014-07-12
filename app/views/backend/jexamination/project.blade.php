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
                <a href="javascript:;" id="btnAdd" class="btn btn-mini btn-primary"><i class="icon-plus"></i>  {{\Lang::get('common.add')}}</a>
                @endif
                @if (User::find(Auth::user()->id)->can('edit'))
                <a href="#" class="btn btn-mini btn-success" id="btnEdit"><i class="icon-edit"></i>  {{\Lang::get('common.edit')}}</a>
                @endif
                @if (User::find(Auth::user()->id)->can('delete'))
                <button type="button" class="btn btn-danger" id='btnDelete'><i class="icon-trash"></i>  {{\Lang::get('common.delete')}} </button>
                @endif
                @if (User::find(Auth::user()->id)->can('view'))
                <button type="button" class="btn btn-info" id='btnView'><i class="icon-eye-open"></i>  {{\Lang::get('common.view')}}</button>
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
                        <th></th>
                        <th> {{\Lang::get('jproject.code')}}</th>
                        <th>{{\Lang::get('jproject.project')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jproject.customer')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jproject.deadline')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jproject.progress')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jproject.active')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page['result'] as $item)
                    <tr class="odd gradeX">
                        <td><input type="checkbox" class="checkboxes" name="id" id="id" value="{{$item->id}}" /></td>
                        <td>{{$item->code}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->customer}}</td>
                        <td>{{$item->deadline}}</td>
                        <td>
                            <div class="progress progress-striped active progress-sm">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$item->progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$item->progress}}%">
                                    <span class="sr-only">{{$item->progress}}% Complete (success)</span>
                                </div>
                            </div>
                        </td>
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
            url: 'backend/jproject/project/add',
            title: 'Add Project'
        };
        genModal(data);
    });

    $('#btnEdit').click(function() {
        if ($(".checkboxes:checked").val())
        {
            var data = {
                url: 'backend/jproject/project/edit',
                title: 'Edit Project',
                v: {id: $(".checkboxes:checked").val()}
            };
            genModal(data);
        }
    });

    $('#btnView').click(function() {
        if ($(".checkboxes:checked").val())
        {
            window.location.replace(base_url + index_page + 'backend/jproject/project/view/' + $(".checkboxes:checked").val() + '');
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