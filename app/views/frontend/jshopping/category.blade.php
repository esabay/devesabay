@extends('frontend.layouts.theme.preciso.master')
@section('content')
<div class="row"> 
    <div class="span3 sidebar"><img src="{{ URL::to('theme/frontend/preciso/products/category-preview.jpg'); }}" alt="Category" /></div>
    <div class="span9">        
        <ul class="breadcrumb">
            <li><a href="{{ URL::to('/'); }}">Home</a> <span class="divider">/</span></li>
            <a href="{{ URL::to('/product'); }}">Products</a> <span class="divider">/</span>
            <li>
                <a href="#">{{ $page['cat_parent']; }}</a> <span class="divider">/</span>
            </li>
            <li class="active">{{ $page['title']; }}</li>
        </ul>
        <h1>{{ $page['title']; }}</h1>
        <p class="small-desc">{{ $page['description']; }}</p>
    </div>
</div>
<div class="row">
    <div class="span3 sidebar">
        <h3>Categories</h3>
        <ul class="nav-stacked" id="nav-accordion">
            @foreach ($page['result_category'] as $item_cat)
            <li class="sub-menu">
                <a href="javascript:;" class="{{($item_cat['id'] == $page['cat_active'] ? 'active' : '')}}">{{ $item_cat['title']; }}</a>
                @if ($item_cat['children'])                       
                <ul class="sub">
                    @foreach ($item_cat['children'] as $item2_cat)
                    <li class="{{($item2_cat['id'] == $page['cat_sub_active'] ? 'active' : '')}}">                        
                        @if ($item2_cat['children'])   
                        <a href="javascript:;">{{ $item2_cat['title']; }}</a>                 
                        <ul class="sub">
                            @foreach ($item2_cat['children'] as $item3_cat)
                            <li>
                                <a href="{{ \URL::to('/product/category/' . $item3_cat['id'] . ''); }}">{{ $item3_cat['title']; }}</a>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <a href="{{ \URL::to('/product/category/' . $item2_cat['id'] . ''); }}">{{ $item2_cat['title']; }}</a>
                        @endif
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>

    </div>
    <div class="span9" id="showcontent"> 

        <div class="products-list products-list-simple">
            <ul class="thumbnails">

                @foreach ($page['result'] as $item_prod)           
                <li class="span3">
                    <div class="thumbnail" style="height: 270px;">
                        <a href="{{ \URL::to('product/view/' . $item_prod->ProductID); }}" class="thumb" target="_new">
                            {{ HTML::image(json_decode(trim($item_prod->imgcover))->{'front'}, $item_prod->ProductName); }}
                        </a>
                        <p>
                            {{ link_to('product/view/' . $item_prod->ProductID, $item_prod->ProductName,array('target'=>'_new')); }}
                        </p>
                        <p class="price">
                            {{ \Products::getPrice($item_prod->ProductID); }}
                        </p>
                        @if($item_prod->UnitPrice!=0)
                        <input type="button" value="{{ \Lang::get('theme_preciso.add_to_cart'); }}" id="{{ $item_prod->ProductID; }}" class="btn btnAddCart" />
                        @endif
                        <a href="javascript:;" class="add-list"><i class="icon-star"></i>Wish List</a>
                        <a href="javascript:;" class="add-comp"><i class="icon-tasks"></i>Compare</a>
                        @if ($item_prod->new == 0)
                        <span class="new">New</span>
                        @endif
                        @if ($item_prod->SalePrice > 0)
                        <span class="sale">Sale</span>
                        @endif
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
@section('show_product')
{{ $page['show_product']; }}
@stop
@section('script_page_code')
<script type="text/javascript">
    $(function() {
        $('#nav-accordion').dcAccordion({
            eventType: 'click',
            autoClose: true,
            saveState: true,
            disableLink: true,
            speed: 'slow',
            showCount: false,
            autoExpand: true,
            classExpand: 'dcjq-current-parent'
        });
    });
</script>
@stop
