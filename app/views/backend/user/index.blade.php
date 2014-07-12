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
                <button type="button" class="btn btn-primary" id="btnAdd"><i class="icon-plus"></i> {{\Lang::get('common.add')}}</button>
                @endif
                @if (User::find(Auth::user()->id)->can('edit'))
                <button type="button" class="btn btn-success" id='btnEdit'><i class="icon-edit"></i> {{\Lang::get('common.edit')}} </button>
                @endif
                @if (User::find(Auth::user()->id)->can('delete'))
                <button type="button" class="btn btn-danger" id='btnDelete'><i class="icon-trash"></i> {{\Lang::get('common.delete')}} </button>
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
                        <th>{{\Lang::get('user.username')}}</th>
                        <th class="hidden-phone">{{\Lang::get('user.email')}} </th>
                        <th class="hidden-phone">{{\Lang::get('user.verified')}} </th>
                        <th class="hidden-phone">{{\Lang::get('user.disabled')}} </th>
                        <th class="hidden-phone">{{\Lang::get('user.create')}}</th>
                        <th class="hidden-phone">{{\Lang::get('user.update')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page['result'] as $item)
                    <tr class="odd gradeX">
                        <td><input type="radio" class="checkboxes radio-inline" name="id" id="id" value="{{$item->id}}" /></td>
                        <td>                            
                            @if($item->avatar!='')
                            @if(\File::exists(json_decode(trim($item->avatar))->{'small'}))
                            <img src="{{ URL::to(json_decode(trim($item->avatar))->{'small'}) }}" />
                            @else
                            <img src="http://www.placehold.it/30x30/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                            @endif                                
                            @else
                            <img src="http://www.placehold.it/30x30/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                            @endif
                            {{$item->username}}
                        </td>
                        <td>{{$item->email}}</td>
                        <td>
                            @if($item->verified == 0)
                            <span class="label label-warning label-mini">{{\Lang::get('user.no')}}</span>
                            @endif
                        </td>
                        <td>
                            @if($item->disabled == 1)
                            <span class="label label-warning label-mini">{{\Lang::get('user.yes')}}</span>
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
            url: 'backend/setting/user/add',
            title: 'Add User'
        };
        genModal(data);
    });

    $('#btnEdit').click(function() {
        var oTable = $('#sample_1').dataTable();
        var rowcollection = oTable.$(".checkboxes:checked", {"page": "all"});
        rowcollection.each(function(index, elem) {
            var checkbox_value = $(elem).val();
            if (checkbox_value)
            {
                var data = {
                    url: 'backend/setting/user/edit',
                    title: 'Edit User',
                    v: {id: checkbox_value}
                };
                genModal(data);
            }
        });
    });

    $('#btnDelete').click(function() {
        var data = {
            url: 'backend/setting/user/delete',
            title: 'Delete User',
            redirect: 'backend/setting/user',
            table_id: '#sample_1'
        };
        deleteData(data);
    });
</script>
@stop