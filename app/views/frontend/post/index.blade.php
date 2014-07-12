@extends('frontend.layouts.theme.preciso.master')
@section('content')
<div class="row">
    <div class="span9" id="showcontent"> 
        <ul class="breadcrumb">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
            <li class="active">Blog</li>
        </ul>
        <h1>Activity <span> NEWS</span></h1>

        <!-- Blog List -->
        <ul class="blog-list">

            <!-- Single Blog -->
            @foreach ($page['result'] as $item) 
            <li>
                <div class="span4 thumbnail">
                    @if($item->imgcover != '') 
                    <img src="{{ URL::to(json_decode(trim($item->imgcover))->{'front'}); }}" alt="{{ $item->name; }}">              
                    @else
                    <img src="http://www.placehold.it/370x250/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                    @endif
                    <div class="blog-thumb">
                        <a href="{{ URL::to(json_decode(trim($item->imgcover))->{'front'}); }}" class="view-fancybox" rel="tag">
                            <i class="icon-camera"></i>
                        </a>
                    </div>
                </div>
                <em class="date">by <a href="#">{{ \User::getUsername($item->created_user); }}</a> on <span>{{ date("d F Y", strtotime($item->created_at)); }}</span></em>
                <h3><a href="{{ \URL::to('/post/' . $item->id); }}" target="_new">{{ $item->name; }}</a></h3>
                <p>{{ $item->shortdetail; }}</p>
                <a class="btn btn-primary" href="{{ \URL::to('/post/' . $item->id); }}" target="_new">Continue</a> 
            </li>
            @endforeach
        </ul>
        <div class="pagination pagination-centered">
            <ul class="pagination">
                {{  $page['result']->links(); }}
            </ul>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="span3 sidebar">
        <h3>Categories</h3>
        <ul class="nav nav-stacked">
            @foreach ($page['result_category'] as $item_cat) 
            @if($item_cat['front'] == 0) 
            <li class="sub-menu">
                <a href="javascript:;">{{ $item_cat['title']; }}</a>
                @if($item_cat['children'])                         
                <ul class="sub">
                    @foreach ($item_cat['children'] as $item2_cat) 
                    <li>
                        <a href="{{ \URL::to('/post/category/' . $item2_cat['id'] . ''); }}">{{ $item2_cat['title']; }}</a>
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endif
            @endforeach
        </ul>
        <h3>Archives</h3>
        <form action="http://www.angelomazzilli.com/Preciso/archives">
            <select class="span3">
                <option>April 2013</option>
                <option>March 2013</option>
                <option>February 2013</option>
                <option>January 2013</option>
                <option>December 2012</option>
            </select>
        </form>
        <h3>Widget Text</h3>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam <strong>nonummy nibh</strong> euismod tincidunt ut laoreet <a href="#">dolore magna</a> aliquam erat volutpat.</p>
    </div>
</div>
@stop
@section('small_banner')
{{ $page['small_banner']; }}
@stop
@section('brands_list')
{{ $page['brands_list']; }}
@stop