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
                <a href="{{URL::to('/backend/post/add')}}" class="btn btn-mini btn-primary"><i class="icon-plus"></i> {{\Lang::get('post.add')}}</a>
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
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                Search
                <span class="tools pull-right">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                    <a href="javascript:;" class="icon-remove"></a>
                </span>
            </header>
            <div class="panel-body">
                {{ Form::open(array('class'=>'form-horizontal','id'=>'form-search','role'=>'form','method'=>'GET')) }}
                <div class="form-group">
                    {{Form::label('name', \Lang::get('post.name'), array('class' => 'col-lg-1 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('s_name', \Input::get('s_name'), array('id'=>'s_name','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-1">&nbsp;</label>
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-success"><?php echo \Lang::get('post.search'); ?></button>
                    </div>
                </div>
                {{ Form::close() }}
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
                        <th class="hidden-phone">{{\Lang::get('common.created_user')}}</th>
                        <th class="hidden-phone">{{\Lang::get('common.created')}}</th>
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
                        <td>
                            {{\User::getUsername($item->created_user)}}
                        </td>
                        <td>
                            {{$item->created_at}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    Showing <?php echo $page['result']->getFrom(); ?> to <?php echo $page['result']->getTo(); ?> of <?php echo $page['result']->getTotal(); ?> entries
                </div>
                <div class="text-center">
                    <ul class="pagination pull-center"> 
                        <?php echo $page['result']->appends(array('s_name' => \Input::get('s_name')))->links(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
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