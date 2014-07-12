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
                <button type="button" class="btn btn-primary" id="btnAdd"><i class="icon-plus"></i> {{\Lang::get('post.add')}}</button>
                @endif
                @if (User::find(Auth::user()->id)->can('edit'))
                <button type="button" class="btn btn-success" id='btnEdit'><i class="icon-edit"></i> {{\Lang::get('post.edit')}}</button>
                @endif
                @if (User::find(Auth::user()->id)->can('delete'))
                <button type="button" class="btn btn-danger" id='btnDelete'><i class="icon-trash"></i> {{\Lang::get('post.delete')}}</button>
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
                        <th>{{\Lang::get('post.title')}}</th>
                        <th>{{\Lang::get('post.description')}}</th>
                        <th><i class=" icon-edit"></i> {{\Lang::get('post.status')}}</th>
                        <th>{{\Lang::get('post.create')}}</th>
                        <th>{{\Lang::get('post.update')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page['result'] as $item)
                    <tr>
                        <td><li class="icon-caret-right"></li>&nbsp;{{Form::checkbox('id[]', $item['id'],null,array('class'=>'checkboxes','id'=>'id'))}} {{$item['title']}}</td>
                <td>{{$item['description']}}</td>
                <td>
                    @if($item['disabled']== 0)
                    <span class="label label-success label-mini">Show</span>
                    @else
                    <span class="label label-warning label-mini">hidden</span>
                    @endif
                </td>
                <td>{{$item['created_at']}}</td>
                <td>{{$item['updated_at']}}</td>
                </tr>
                @foreach ($item['children'] as $item2)
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;<li class="icon-caret-right"></li>&nbsp;{{Form::checkbox('id[]', $item2['id'],null,array('class'=>'checkboxes','id'=>'id'))}} {{$item2['title']}}</td>
                <td>{{$item2['description']}}</td>
                <td>
                    @if($item2['disabled']== 0)
                    <span class="label label-success label-mini">Show</span>
                    @else
                    <span class="label label-warning label-mini">hidden</span>
                    @endif
                </td>
                <td>{{$item2['created_at']}}</td>
                <td>{{$item2['updated_at']}}</td>
                </tr>
                @foreach ($item2['children'] as $item3)
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li class="icon-caret-right"></li>&nbsp;{{Form::checkbox('id[]', $item3['id'],null,array('class'=>'checkboxes','id'=>'id'))}} {{$item3['title']}}</td>
                <td>{{$item3['description']}}</td>
                <td>
                    @if($item3['disabled']== 0)
                    <span class="label label-success label-mini">Show</span>
                    @else
                    <span class="label label-warning label-mini">hidden</span>
                    @endif
                </td>
                <td>{{$item3['created_at']}}</td>
                <td>{{$item3['updated_at']}}</td>
                </tr>
                @endforeach                       
                @endforeach                    
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
            url: 'backend/jgallery/group/add',
            title: 'Add Group'
        };
        genModal(data);
    });

    $('#btnAddSub').click(function() {
        if ($(".checkboxes:checked").val())
        {
            var data = {
                url: 'backend/jgallery/group/sub/add',
                title: 'Add Sub Group',
                v: {id: $(".checkboxes:checked").val()}
            };
            genModal(data);
        }
    });

    $('#btnEdit').click(function() {
        if ($(".checkboxes:checked").val())
        {
            var data = {
                url: 'backend/jgallery/group/edit',
                title: 'Edit Group',
                v: {id: $(".checkboxes:checked").val()}
            };
            genModal(data);
        }

    });

    $('#btnDelete').click(function() {
        var data = {
            url: 'backend/jgallery/group/delete',
            title: 'Delete Group',
            redirect: 'backend/jgallery/group',
            table_id: '#sample_1'
        };
        deleteData(data);
    });

</script>
@stop