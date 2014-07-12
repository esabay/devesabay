@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('/css/tasks.css')}}
@stop
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
                <a href="javascript:;" id="btnAdd" class="btn btn-mini btn-primary"><i class="icon-plus"></i>  {{\Lang::get('common.add')}}</a>
                @endif
                @if (User::find(Auth::user()->id)->can('edit'))
                <a href="#" class="btn btn-mini btn-success" id="btnEdit"><i class="icon-edit"></i> {{\Lang::get('common.edit')}}</a>
                @endif
                @if (User::find(Auth::user()->id)->can('delete'))
                <button type="button" class="btn btn-danger" id='btnDelete'><i class="icon-trash"></i> {{\Lang::get('common.delete')}}</button>
                @endif
                @if (User::find(Auth::user()->id)->can('view'))
                <button type="button" class="btn btn-info" id='btnView'><i class="icon-eye-open"></i>  {{\Lang::get('common.view')}}</button>
                @endif
            </div>
        </section>
    </div>
</div>
<!--state overview end-->
<div class="row">
    <div class="col-lg-4">

        <!--user info table start-->
        <section class="panel">
            <div class="panel-body">
                <a href="#" class="task-thumb">
                    <img src="{{ \URL::to(\User::getAvatar($page['item']['assigned'])) }}" width="90" alt="">
                </a>
                <div class="task-thumb-details">
                    <h1><a href="#">{{\User::getFullName($page['item']['assigned'])}}</a></h1>
                    <p>Project Lead</p>
                </div>
            </div>
            <table class="table table-hover personal-task">
                <tbody>
                    <tr>
                        <td>
                            <i class=" icon-tasks"></i>
                        </td>
                        <td>New Task Issued</td>
                        <td> 02</td>
                    </tr>
                    <tr>
                        <td>
                            <i class="icon-warning-sign"></i>
                        </td>
                        <td>Task Pending</td>
                        <td> 14</td>
                    </tr>
                    <tr>
                        <td>
                            <i class="icon-envelope"></i>
                        </td>
                        <td>Inbox</td>
                        <td> 45</td>
                    </tr>
                    <tr>
                        <td>
                            <i class=" icon-bell-alt"></i>
                        </td>
                        <td>New Notification</td>
                        <td> 09</td>
                    </tr>
                </tbody>
            </table>
        </section>
        <!--user info table end-->        
    </div>
    <div class="col-lg-8">
        <!--work progress start-->
        <section class="panel">
            <div class="panel-body progress-panel">
                <div class="task-progress">
                    <h1>Work Progress</h1>
                    <p>Anjelina Joli</p>
                </div>
                <div class="task-option">
                    <select class="styled">
                        <option>Anjelina Joli</option>
                        <option>Tom Crouse</option>
                        <option>Jhon Due</option>
                    </select>
                </div>
            </div>
            <table class="table table-hover personal-task">
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            Target Sell
                        </td>
                        <td>
                            <span class="badge bg-important">75%</span>
                        </td>
                        <td>
                            <div id="work-progress1"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>
                            Product Delivery
                        </td>
                        <td>
                            <span class="badge bg-success">43%</span>
                        </td>
                        <td>
                            <div id="work-progress2"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>
                            Payment Collection
                        </td>
                        <td>
                            <span class="badge bg-info">67%</span>
                        </td>
                        <td>
                            <div id="work-progress3"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>
                            Work Progress
                        </td>
                        <td>
                            <span class="badge bg-warning">30%</span>
                        </td>
                        <td>
                            <div id="work-progress4"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>
                            Delivery Pending
                        </td>
                        <td>
                            <span class="badge bg-primary">15%</span>
                        </td>
                        <td>
                            <div id="work-progress5"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        <!--work progress end-->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <section class="panel tasks-widget">
            <header class="panel-heading">
                Todo list
            </header>
            <div class="panel-body">

                <div class="task-content">

                    <ul class="task-list">
                        <li>
                            <div class="task-checkbox">
                                <input type="checkbox" class="list-child" value=""  />
                            </div>
                            <div class="task-title">
                                <span class="task-title-sp">Flatlab is Modern Dashboard</span>
                                <span class="badge badge-sm label-success">2 Days</span>
                                <div class="pull-right hidden-phone">
                                    <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                    <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="task-checkbox">
                                <input type="checkbox" class="list-child" value=""  />
                            </div>
                            <div class="task-title">
                                <span class="task-title-sp">Fully Responsive & Bootstrap 3.0.2 Compatible</span>
                                <span class="badge badge-sm label-danger">Done</span>
                                <div class="pull-right hidden-phone">
                                    <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                    <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="task-checkbox">
                                <input type="checkbox" class="list-child" value=""  />
                            </div>
                            <div class="task-title">
                                <span class="task-title-sp">Daily Standup Meeting</span>
                                <span class="badge badge-sm label-warning">Company</span>
                                <div class="pull-right hidden-phone">
                                    <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                    <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="task-checkbox">
                                <input type="checkbox" class="list-child" value=""  />
                            </div>
                            <div class="task-title">
                                <span class="task-title-sp">Write well documentation for this theme</span>
                                <span class="badge badge-sm label-primary">3 Days</span>
                                <div class="pull-right hidden-phone">
                                    <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                    <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="task-checkbox">
                                <input type="checkbox" class="list-child" value=""  />
                            </div>
                            <div class="task-title">
                                <span class="task-title-sp">We have a plan to include more features in future update</span>
                                <span class="badge badge-sm label-info">Tomorrow</span>
                                <div class="pull-right hidden-phone">
                                    <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                    <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="task-checkbox">
                                <input type="checkbox" class="list-child" value=""  />
                            </div>
                            <div class="task-title">
                                <span class="task-title-sp">Don't be hesitate to purchase this Dashbord</span>
                                <span class="badge badge-sm label-inverse">Now</span>
                                <div class="pull-right">
                                    <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                    <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="task-checkbox">
                                <input type="checkbox" class="list-child" value=""  />
                            </div>
                            <div class="task-title">
                                <span class="task-title-sp">Code compile and upload</span>
                                <span class="badge badge-sm label-success">2 Days</span>
                                <div class="pull-right hidden-phone">
                                    <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                    <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="task-checkbox">
                                <input type="checkbox" class="list-child" value=""  />
                            </div>
                            <div class="task-title">
                                <span class="task-title-sp">Tell your friends to buy this dashboad</span>
                                <span class="badge badge-sm label-danger">Now</span>
                                <div class="pull-right hidden-phone">
                                    <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                    <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                    <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>

                <div class=" add-task-row">
                    <a class="btn btn-success btn-sm pull-left" href="#">Add New Tasks</a>
                    <a class="btn btn-default btn-sm pull-right" href="#">See All Tasks</a>
                </div>
            </div>
        </section>
    </div>
</div>
@stop
@section('script_page')

@stop
@section('script_page_only')
{{HTML::script('/js/jquery.sparkline.js')}}
{{HTML::script('/js/sparkline-chart.js')}}
{{HTML::script('/js/count.js')}}
{{HTML::script('/assets/jquery-knob/js/jquery.knob.js')}}
@stop

@section('script_page_code')
<script type="text/javascript">
    $(".knob").knob();
</script>
@stop