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
                <a href="javascript:;" id="btnAdd01" class="btn btn-mini btn-primary"><i class="icon-plus"></i>{{\Lang::get('jproject.add_iT_service_request_form')}}</a>
                <a href="#" class="btn btn-mini btn-success" id="btnEdit01"><i class="icon-edit"></i>  {{\Lang::get('common.edit')}}</a>
                <button type="button" class="btn btn-danger" id='btnDelete'><i class="icon-trash"></i> {{\Lang::get('common.delete')}} </button>
                <button type="button" class="btn btn-info" id='btnView01'><i class="icon-eye-open"></i>{{\Lang::get('common.view')}} </button>                
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
                        <th>{{\Lang::get('jproject.code')}}</th>
                        <th>{{\Lang::get('jproject.name')}}</th>
                        <th>{{\Lang::get('jproject.project')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jproject.completion_date')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jproject.status')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jproject.created_date')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jproject.updated_date')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page['result'] as $item)
                    <tr class="odd gradeX">
                        <td><input type="checkbox" class="checkboxes" name="id" id="id" value="{{$item->id}}" /></td>
                        <td>{{$item->code}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->projectname}}</td>
                        <td>{{$item->required_completion_date}}</td>
                        <td>
                            @if($item->status == 0)
                            <span class="label label-warning label-mini">Pending</span>
                            @elseif($item->status == 1)
                            <span class="label label-danger label-mini">Cancel</span>
                            @else
                            <span class="label label-success label-mini">Success</span>
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
{{HTML::script('/assets/data-tables/jquery.dataTables.js')}}
{{HTML::script('/assets/data-tables/DT_bootstrap.js')}}
@stop
@section('script_page_only')
{{HTML::script('/js/dynamic-table.js')}}
@stop

@section('script_page_code')
<script type="text/javascript">
    $('#btnAdd01').click(function() {
        window.location.replace(base_url + index_page + 'backend/jproject/document/add/01');
    });

    $('#btnEdit01').click(function() {
        if ($(".checkboxes:checked").val())
        {
            window.location.replace(base_url + index_page + 'backend/jproject/document/edit/01/' + $(".checkboxes:checked").val() + '');
        }
    });

    $('#btnView01').click(function() {
        if ($(".checkboxes:checked").val())
        {
            window.location.replace(base_url + index_page + 'backend/jproject/document/view/01/' + $(".checkboxes:checked").val() + '');
        }
    });



    $('#btnDelete').click(function() {
        var data = {
            url: 'backend/jproject/document/delete/01',
            title: 'Delete Document',
            redirect: 'backend/jproject/document',
            table_id: '#sample_1'
        };
        deleteData(data);
    });
</script>
@stop