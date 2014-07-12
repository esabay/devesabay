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
                <a href="{{URL::to('/backend/posting/post/add')}}" class="btn btn-mini btn-primary"><i class="icon-plus"></i> {{\Lang::get('common.add')}}</a>
                @endif
                @if (User::find(Auth::user()->id)->can('edit'))
                <a href="javascript:;" class="btn btn-mini btn-success" id="btnEdit"><i class="icon-edit"></i> {{\Lang::get('common.edit')}}</a>
                <a href="javascript:;" class="btn btn-mini btn-info" id="btnView"><i class="icon-eye-open"></i> {{\Lang::get('common.view')}}</a>
                @endif
                @if (User::find(Auth::user()->id)->can('delete'))
                <button type="button" class="btn btn-danger" id='btnDelete'><i class="icon-trash"></i> {{\Lang::get('common.delete')}}</button>
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
                    {{Form::label('title_search', \Lang::get('posting.title_search'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-6">
                        {{ Form::text('s_title', trim(\Input::get('s_title')), array('id'=>'s_title','class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('name', \Lang::get('posting.group'), array('class' => 'col-lg-2 control-label'));}}
                    <div class="col-lg-4">
                        <select name="s_CategoryID" id="s_CategoryID" class="form-control">
                            <option selected="selected" value="">{{\Lang::get('common.please_select')}}</option>
                            @foreach ($page['category'] as $item)
                            <option value="{{$item['id']}}">{{$item['title']}}</option>
                            @foreach ($item['children'] as $item2)
                            <option value="{{$item2['id']}}">&nbsp;&nbsp;&nbsp;{{$item2['title']}}</option>
                            @foreach ($item2['children'] as $item3)
                            <option value="{{$item3['id']}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item3['title']}}</option>
                            @endforeach
                            @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2">&nbsp;</label>
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-success">Search</button>
                    </div>
                </div>
                {{ Form::hidden('search', true) }}
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
                        <th>{{\Lang::get('posting.title_search')}}</th>
                        <th class="hidden-phone">{{\Lang::get('posting.group')}}</th>
                        <th class="hidden-phone">{{\Lang::get('posting.price')}}</th>                        
                        <th class="hidden-phone">{{\Lang::get('posting.status')}}</th>
                        <th class="hidden-phone">{{\Lang::get('posting.create')}}</th>
                        <th class="hidden-phone">{{\Lang::get('posting.update')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page['result'] as $item)
                    <tr class="odd gradeX">
                        <td><input type="radio" class="checkboxes radio-inline" name="id" id="id" value="{{$item->id}}" /></td>
                        <td>{{$item->title}}</td>
                        <td>{{\Categories::getSub($item->categories_id)}}</td>
                        <td>{{number_format($item->price)}}</td>                                               
                        <td>
                            @if($item->disabled == 0)
                            <span class="label label-success label-mini">Show</span>
                            @else
                            <span class="label label-warning label-mini">hidden</span>
                            @endif
                        </td>
                        <td>
                            {{$item->created_at}}
                        </td>
                        <td>
                            {{$item->updated_at}}
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
                        <?php echo $page['result']->appends(array('s_title' => trim(\Input::get('s_title')), 's_CategoryID' => \Input::get('s_CategoryID'), 'search' => 1))->links(); ?>
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
        window.open(base_url  + 'backend/posting/post/add', '_self');
    });

    $('#btnEdit').click(function() {
        if ($(".checkboxes:checked").val())
        {
            window.open(base_url  + 'backend/posting/post/edit/' + $(".checkboxes:checked").val(), '_self');
        } else {
            alert('กรุณาเลือกรายการ !');
        }
    });

    $('#btnView').click(function() {
        if ($(".checkboxes:checked").val())
        {
            window.open(base_url  + 'backend/posting/post/view/' + $(".checkboxes:checked").val(), '_newtab');
        } else {
            alert('กรุณาเลือกรายการ !');
        }
    });

    $('#btnDelete').click(function() {
        var data = {
            url: 'backend/posting/post/delete',
            title: 'Delete Post',
            redirect: 'backend/posting/post',
            table_id: '#sample_1'
        };
        deleteData(data);
    });
</script>
@stop