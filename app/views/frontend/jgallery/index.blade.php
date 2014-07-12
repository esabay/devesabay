@extends('frontend.layouts.theme.preciso.master')
@section('content')
<div class="row">
    <div class="span12" id="showcontent"> 

        <!-- Breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="{{  \URL::to('/') }}">Home</a> <span class="divider">/</span></li>
            <li class="active">Gallery</li>
        </ul>
        <h1>{{  $page['title'] }}</h1>

        <!-- Portfolio Columns -->
        <div class="products-list products-list-simple">
            <ul class="thumbnails">
                @foreach($page['result'] as $item2)
                <!-- Products Single Box -->
                <li class="span3">
                    <div class="thumbnail" style="height: 230px;">
                        @if ($item2->imgcover != '')
                        <img src="{{  \URL::to(json_decode(trim($item2->imgcover))->{'cover'}); }}" alt="{{  $item2->name; }}" class="folio">         
                        @else
                        <img src="http://www.placehold.it/250x170/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                        @endif
                        <div class="folio-detail">
                            <a href="{{  \URL::to('gallery/' . $item2->id . '') }}" class="view-fancybox" rel="tag">
                                <i class="icon-camera"></i>
                            </a>
                        </div>
                        <div class="caption">
                            <em>{{  $item2->name; }}</em>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <!-- Pagination -->
        <div class="pagination pagination-right">
            <ul class="pagination">
                {{  $page['result']->links(); }}
            </ul>
        </div>
    </div>
</div>
@stop
@section('small_banner')
{{ $page['small_banner']; }}
@stop
@section('brands_list')
{{ $page['brands_list']; }}
@stop
@section('script_page_code')
<script type="text/javascript">
    $(function() {
        loadContent({url: 'widget/small_banner', div: '#small_banner'});
        loadContent({url: 'widget/brands_list', div: '#brands_list'});
    });
</script>
@stop