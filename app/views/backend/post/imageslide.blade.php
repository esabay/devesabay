@extends('backend.layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                @if (User::find(Auth::user()->id)->can('add'))
                <a href="{{URL::to('/backend/post/add')}}" class="btn btn-mini btn-primary"><i class="icon-plus"></i> Add</a>
                @endif
                @if (User::find(Auth::user()->id)->can('edit'))
                <a href="#" class="btn btn-mini btn-success" id="btnEdit"><i class="icon-edit"></i> Edit</a>
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
                        <th></th>
                        <th>Title</th>
                        <th class="hidden-phone">Group</th>
                        <th><i class=" icon-edit"></i> Status</th>
                        <th class="hidden-phone">Create</th>
                        <th class="hidden-phone">Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page['result'] as $item)
                    <tr class="odd gradeX">
                        <td><input type="radio" class="radio-inline checkboxes" name="id" id="id" value="{{$item->id}}" /></td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->groupname}}</td>
                        <td>
                            @if($item->disabled == 0)
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
        window.location.replace(base_url  + 'backend/post/add');
    });

    $('#btnEdit').click(function() {
        if ($(".checkboxes:checked").val())
        {
            window.location.replace(base_url  + 'backend/post/edit/' + $(".checkboxes:checked").val());
        } else {
            alert('กรุณาเลือกรายการ !');
        }
    });

    $('#btnDelete').click(function() {
        var data = {
            url: 'backend/post/delete',
            title: 'Delete Post',
            redirect: 'backend/post',
            table_id: '#sample_1'
        };
        deleteData(data);
    });
</script>
@stop