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
                <button type="button" class="btn btn-primary" id='btnAdd'><i class="icon-plus"></i> {{\Lang::get('post.add')}}</button>
                <button type="button" class="btn btn-warning" id='btnAddGallery'><i class="icon-picture"></i> Gallery</button>
                @endif
                @if (User::find(Auth::user()->id)->can('edit'))
                <a href="#" class="btn btn-mini btn-success" id="btnEdit"><i class="icon-edit"></i> {{\Lang::get('post.edit')}}</a>
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
                        <th></th>
                        <th>{{\Lang::get('post.title')}}</th>
                        <th class="hidden-phone">{{\Lang::get('post.group')}}</th>
                        <th class="hidden-phone">{{\Lang::get('post.front')}}</th>
                        <th><i class=" icon-edit"></i> {{\Lang::get('post.status')}}</th>
<!--                        <th class="hidden-phone">Create</th>
                        <th class="hidden-phone">Update</th>-->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page['result'] as $item)
                    <tr class="odd gradeX">
                        <td><input type="radio" class="radio-inline checkboxes" name="id" id="id" value="{{$item->id}}" /></td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->groupname}}</td>
                        <td>
                            @if($item->frontend == 0)
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
<!--                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>-->
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
            url: 'backend/jgallery/add',
            title: 'Add Gallery'
        };
        genModal(data);
    });

    $('#btnAddGallery').click(function() {
        if ($(".checkboxes:checked").val())
        {
            window.location.replace(base_url + index_page + 'backend/jgallery/gallery/' + $(".checkboxes:checked").val());
        } else {
            alert('กรุณาเลือกรายการ !');
        }
    });

    $('#btnEdit').click(function() {
        if ($(".checkboxes:checked").val())
        {
            var data = {
                url: 'backend/jgallery/edit',
                title: 'Edit Gallery',
                v: {id: $(".checkboxes:checked").val()}
            };
            genModal(data);
        }

    });

    $('#btnDelete').click(function() {
        var data = {
            url: 'backend/jgallery/delete',
            title: 'Delete Gallery',
            redirect: 'backend/jgallery',
            table_id: '#sample_1'
        };
        deleteData(data);
    });
</script>
@stop