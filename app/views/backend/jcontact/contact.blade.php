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
                <button type="button" class="btn btn-success" id='btnView'><i class="icon-eye-open"></i> {{\Lang::get('common.view')}} </button>
                <button type="button" class="btn btn-danger" id='btnDelete'><i class="icon-trash"></i> {{\Lang::get('common.delete')}} </button>
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
                        <th style="width:8px;"></th>
                        <th>หัวข้อ</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th class="hidden-phone">อีเมล์</th>
                        <th class="hidden-phone">เบอร์โทร</th>
                        <th class="hidden-phone">ประเภทการติดต่อ</th>
                        <th class="hidden-phone">วันที่ติดต่อ</th>
                        <th class="hidden-phone">สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page['result'] as $item)
                    <tr class="odd gradeX">
                        <td><input type="radio" class="checkboxes radio-inline" name="id" id="id" value="{{$item->id}}" /></td>
                        <td>                                                        
                            {{$item->title}}
                        </td>
                        <td>                                                        
                            {{$item->name}}
                        </td>
                        <td>{{$item->email}}</td>
                        <td>
                            {{$item->phone}}
                        </td>
                        <td>
                            &nbsp;
                        </td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            @if($item->disabled == 1)
                            <span class="label label-warning label-mini">{{\Lang::get('user.yes')}}</span>
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
            url: 'backend/setting/user/add',
            title: 'Add User'
        };
        genModal(data);
    });

    $('#btnView').click(function() {
        if ($(".checkboxes:checked").val())
        {
            getPageUrl(base_url + 'backend/jcontact/contact/view/' + $(".checkboxes:checked").val());
        } else {
            alert('กรุณาเลือกรายการ !');
        }
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