@extends('frontend.layouts.theme.preciso.master')
@section('content')
<div class="row">
    <div class="span12"> 

        <!-- Breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="{{ \URL::to('/') }}">Home</a> <span class="divider">/</span></li>
            <li><a href="{{ \URL::to('/gallery') }}">Gallery</a> <span class="divider">/</span> </li>
            <li class="active">{{ $page['title'] }}</li>
        </ul>
        <h1>{{ $page['title'] }}</h1>
        <p class="small-desc">{{ $page['shortdetail'] }}</p>

        <!-- Portfolio Masonry -->
        <div id="isotope">
            @foreach ($page['result'] as $item2)
            <div class="item">
                @if ($item2->url != '')
                <img src="{{ URL::to(json_decode(trim($item2->url))->{'thumbs'}); }}" alt="{{ $item2->name; }}" class="folio" />         
                @else
                <img src="http://www.placehold.it/250x170/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                @endif
                <div class="folio-detail">
                    <a href="{{ URL::to(json_decode(trim($item2->url))->{'photo'}); }}" class="view-fancybox" rel="tag">
                        <i class="icon-camera"></i>
                    </a>
                </div>
            </div>
            @endforeach
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
    /* --- Masonry --- */
    var $container = $('#isotope');
    $container.imagesLoaded(function() {
        $container.isotope({
            itemSelector: '.item'
        });
    });
    $('#filters a').click(function() {
        var selector = $(this).attr('data-filter');
        $container.isotope({
            filter: selector
        });
        return false;
    });
    $(function() {
        loadContent({url: 'widget/small_banner', div: '#small_banner'});
        loadContent({url: 'widget/brands_list', div: '#brands_list'});
    });
</script>
@stop