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
                <a href="javascript:;" class="btn btn-mini btn-info" id="btnView"><i class="icon-eye-open"></i> {{\Lang::get('common.view')}}</a>
                <a href="javascript:;" class="btn btn-mini btn-info" id="btnInterview"><i class="icon-file-text"></i> {{\Lang::get('jcareer.interview')}}</a>
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
                        <th>{{\Lang::get('jcareer.fullname')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jcareer.age')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jcareer.sex')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jcareer.province')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jcareer.mobile')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jcareer.position_ex')}}</th>
                        <th><i class=" icon-edit"></i> {{\Lang::get('jcareer.status')}}</th>
                        <th class="hidden-phone">{{\Lang::get('jcareer.interviewer')}}</th>
                        <th class="hidden-phone">{{\Lang::get('common.created')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($page['result'] as $item)
                    <tr class="odd gradeX">
                        <td><input type="radio" class="radio-inline checkboxes" name="id" id="id" value="{{$item->id}}" /></td>
                        <td>{{$item->firstname}} {{$item->lastname}}</td>
                        <td>{{\Careerapplicationinfo::getAge($item->birthday)}}</td>
                        <td>{{\Careerapplicationinfo::getSex($item->sex)}}</td>
                        <td>{{\Province::getName($item->PROVINCE_ID)}}</td>
                        <td>{{$item->mobile}}</td>
                        <td>{{\Careerapplicationoccupation::getPositionFirst($item->id)}}</td>
                        <td>
                            {{\Careerinterview::getStatus($item->status)}}
                        </td>
                        <td>
                            {{\Careerinterview::getInterviewer($item->id)}}      
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
    $('#btnView').click(function() {
        if ($(".checkboxes:checked").val())
        {
            window.open(base_url + 'backend/jcareer/application/view/' + $(".checkboxes:checked").val(), '_newtab');
        } else {
            alert('กรุณาเลือกรายการ !');
        }
    });

    $('#btnDelete').click(function() {
        var data = {
            url: 'backend/jcareer/application/delete',
            title: 'Delete Examination',
            redirect: 'backend/jcareer/application',
            table_id: '#sample_1'
        };
        deleteData(data);
    });

    $('#btnInterview').click(function() {
        if ($(".checkboxes:checked").val())
        {
            var data3 = {
                url: 'backend/jcareer/interview/check',
                v: {id: $(".checkboxes:checked").val()}
            };
            var rs = getData(data3);
            var obj = $.parseJSON(rs);
            if (obj.error.status === true)
            {
                if (obj.error.new === 0)
                {
                    var data = {
                        title: 'Confirm',
                        type: 'confirm',
                        text: '<?php echo \Lang::get('jcareer.confirm_interview'); ?>'
                    };
                    genModal(data);
                    $("#myModal #button-confirm").removeAttr('class');
                    $('#myModal #button-confirm').addClass('btn btn-warning confirmInterview');
                } else {
                    var data = {
                        title: 'Confirm',
                        type: 'confirm',
                        text: '<?php echo \Lang::get('jcareer.interviewer_select'); ?>'
                    };
                    genModal(data);
                    $("#myModal #button-confirm").removeAttr('class');
                    $('#myModal .modal-footer #button-close').hide();
                    $('#myModal .modal-footer #button-ok').show();
                    $('#myModal #button-confirm').addClass('btn btn-warning cancelInterview');
                    $('#myModal .modal-footer #button-ok').addClass('btn btn-warning selectInterview');
                }
            } else {
                window.open(base_url  + 'backend/jcareer/interview/' + $(".checkboxes:checked").val() + '', '_newtab');
            }
        } else {
            alert('กรุณาเลือกรายการ !');
        }
    });


    $('body').on('click', '.selectInterview', function() {
        window.open(base_url  + 'backend/jcareer/interview/' + $(".checkboxes:checked").val() + '', '_newtab');
    });

    $('body').on('click', '.confirmInterview', function() {
        $.ajax({
            type: "post",
            url: base_url  + 'backend/jcareer/interview/confirm',
            data: {id: $(".checkboxes:checked").val()},
            cache: false,
            dataType: 'json',
            success: function(result) {
                try {
                    if (result.error.status === true)
                    {
                        window.open(base_url  + 'backend/jcareer/interview/' + $(".checkboxes:checked").val() + '', '_self');
                    }
                } catch (e) {
                    alert('Exception while request..');
                }
            },
            error: function(e) {
                alert('Error while request..');
            }
        });

    });

    $('body').on('click', '.cancelInterview', function() {
        $.ajax({
            type: "post",
            url: base_url  + 'backend/jcareer/interview/cancel',
            data: {id: $(".checkboxes:checked").val()},
            cache: false,
            dataType: 'json',
            success: function(result) {
                try {
                    if (result.error.status === true)
                    {
                        window.open(base_url  + 'backend/jcareer/application', '_self');
                    }
                } catch (e) {
                    alert('Exception while request..');
                }
            },
            error: function(e) {
                alert('Error while request..');
            }
        });

    });
</script>
@stop