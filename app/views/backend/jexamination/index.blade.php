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
<!--state overview end-->
<div class="row">
    <div class="col-lg-4">
        <!--user info table start-->
        <section class="panel">
            <div class="panel-body">
                <a href="#" class="task-thumb">
                    <img src="{{URL::to('/img/avatar1.jpg')}}" alt="">
                </a>
                <div class="task-thumb-details">
                    <h1><a href="#">Anjelina Joli</a></h1>
                    <p>Senior Architect</p>
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
@stop
@section('script_page')

@stop
@section('script_page_only')
{{HTML::script('/js/jquery.sparkline.js')}}
{{HTML::script('/js/sparkline-chart.js')}}
{{HTML::script('/js/count.js')}}
@stop

@section('script_page_code')
<script type="text/javascript">

</script>
@stop