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
                <a href="{{\URL::to('backend/jcareer/position/add')}}" class="btn btn-mini btn-primary"><i class="icon-plus"></i> {{\Lang::get('jcareer.add')}}</a>
                @endif
                @if (User::find(Auth::user()->id)->can('edit'))
                <a href="javascript:;" class="btn btn-mini btn-success" id="btnEdit"><i class="icon-edit"></i> {{\Lang::get('jcareer.edit')}}</a>
                <a href="javascript:;" class="btn btn-mini btn-info" id="btnView"><i class="icon-eye-open"></i> {{\Lang::get('common.view')}}</a>
                @endif
                @if (User::find(Auth::user()->id)->can('delete'))
                <button type="button" class="btn btn-danger" id='btnDelete'><i class="icon-trash"></i> {{\Lang::get('jcareer.delete')}}</button>
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
                    {{Form::label('name', \Lang::get('jcareer.name'), array('class' => 'col-lg-1 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('s_title', \Input::get('s_title'), array('id'=>'s_title','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-1">&nbsp;</label>
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-success"><?php echo \Lang::get('jcareer.search'); ?></button>
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
                        <th>{{\Lang::get('jcareer.position')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jcareer.amount')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jcareer.job_type')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jcareer.salary')}}</th>
                        <th><i class=" icon-edit"></i> {{\Lang::get('jcareer.status')}}</th>
                        <th class="hidden-phone">{{\Lang::get('common.created_user')}}</th>
                        <th class="hidden-phone">{{\Lang::get('common.created')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page['result'] as $item)
                    <tr class="odd gradeX">
                        <td><input type="radio" class="radio-inline checkboxes" name="id" id="id" value="{{$item->id}}" /></td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->amount}}</td>
                        <td>{{\Careerposition::getType($item->type)}}</td>
                        <td>{{$item->salary}}</td>
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
                        <?php echo $page['result']->appends(array('s_title' => \Input::get('s_title')))->links(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script_page_code')
<script type="text/javascript">
    $('#btnEdit').click(function() {
        if ($(".checkboxes:checked").val())
        {
            window.open(base_url  + 'backend/jcareer/position/edit/' + $(".checkboxes:checked").val(), '_self');
        } else {
            alert('กรุณาเลือกรายการ !');
        }
    });

    $('#btnView').click(function() {
        if ($(".checkboxes:checked").val())
        {
            window.open(base_url  + 'backend/jcareer/position/view/' + $(".checkboxes:checked").val(), '_blank');
        } else {
            alert('กรุณาเลือกรายการ !');
        }
    });

    $('#btnDelete').click(function() {
        var data = {
            url: 'backend/jcareer/position/delete',
            title: 'Delete Position',
            redirect: 'backend/jcareer/position',
            table_id: '#sample_1'
        };
        deleteData(data);
    });
</script>
@stop