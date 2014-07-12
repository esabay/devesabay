@extends('frontend.layouts.theme.preciso.master')
@section('content')
<div class="row">
    <!-- Sidebar Media Gallery -->
    <div class="span3">
        <ul class="media-gallery">
            @foreach ($page['gallery'] as $gallery)
            <li>
                <a href="{{ \URL::to(json_decode(trim($gallery->title))->{'photo'}); }}" class="view-fancybox" rel="group"><img src="{{ \URL::to(json_decode(trim($gallery->title))->{'thumbs'}); }}" alt="Product" /></a>
            </li>
            @endforeach
        </ul>
    </div>
    <!-- Products List -->
    <div class="span9"> 
        <!-- Breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="{{ \URL::to('/'); }}">Home</a> <span class="divider">/</span></li>
            <li>
                <a href="{{ \URL::to('product'); }}">Products</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="{{ \URL::to('product/category/' . $page['cat_id']); }}">
                    {{ $page['cat_parent']; }}
                </a> 
                <span class="divider">/</span>
            </li>
            <li class="active">{{ $page['title']; }}</li>
        </ul>
        <h1>{{ $page['item']->ProductName; }}</h1>
        <ul class="nav nav-stacked product-info">
            <li><strong>Stock</strong> : <span id="stockUpdate"></span>{{-- \Lang::get('theme_preciso.in_stock'); --}}</li>
            <li><strong>Brand</strong> : {{ $page['title']; }}</li>
            <li><strong>Product Code</strong> : {{ $page['item']->ProductCode; }}</li>
        </ul>
        <!-- Price -->
        <p class="main-price">
            <strong>{{(\Products::getPrice($page['item']->ProductID)!='' ? number_format(\Products::getPrice($page['item']->ProductID)).' '.\Lang::get('common.currency') : 'CALL')}}</strong>
        </p>
        <!-- Rating -->
        <p class="main-rating">
            <i class="icon-star"><span>1</span></i><i class="icon-star"><span>2</span></i><i class="icon-star"><span>3</span></i><i class="icon-star-half-empty"><span>4</span></i><i class="icon-star-empty"><span>5</span></i> 4 Reviews <a href="#">Write a Review</a></p>
        <!-- Add Buttons --> 
        <a href="javascript:;" class="add-list-detail" id="{{ $page['item']->ProductID; }}" title="{{ \Lang::get('theme_preciso.add_wishlist'); }}"><i class="icon-star"></i></a>
        <a href="javascript:;" class="add-comp-detail" id="{{ $page['item']->ProductID; }}" title="{{ \Lang::get('theme_preciso.add_compare'); }}"><i class="icon-tasks"></i></a>
        
        @if(\Products::getPrice($page['item']->ProductID)>0)
        <input type="button" value="{{ \Lang::get('theme_preciso.add_to_cart'); }}" id="{{ $page['item']->ProductID; }}" class="btn btn-add-cart btnAddCart" />        
        <input type="text" placeholder="Qty" id="prod_qty" value="1" class="input-quantity" />        
        <span class="input-quantity-text">{{ \Lang::get('theme_preciso.quantity'); }}</span>
        @endif
        <div class="clearfix"></div>

        <!-- Product Description -->
        <div class="accordion" id="accordion2">
            <div class="accordion-group">
                <div class="accordion-heading"> 
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne"> {{ \Lang::get('theme_preciso.descript_product'); }} </a> 
                </div>
                <div id="collapseOne" class="accordion-body collapse in">
                    <div class="accordion-inner">{{ $page['item']->Detail; }}</div>
                </div>
            </div>
            <div class="accordion-group">
                <div class="accordion-heading"> 
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo"> {{ \Lang::get('theme_preciso.specification_product'); }} </a> 
                </div>
                <div id="collapseTwo" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <ul class="nav nav-stacked product-info">
                            @foreach ($page['productspec_result'] as $item)
                            @if($item->spec1)
                            <li><strong>{{ $item->spec1; }}</strong> : {{ $page['productspecvalue_item']->spec1; }}</li>
                            @endif
                            @if($item->spec2)
                            <li><strong>{{ $item->spec2; }}</strong> : {{ $page['productspecvalue_item']->spec2; }}</li>
                            @endif
                            @if($item->spec3)
                            <li><strong>{{ $item->spec3; }}</strong> : {{ $page['productspecvalue_item']->spec3; }}</li>
                            @endif
                            @if($item->spec4)
                            <li><strong>{{ $item->spec4; }}</strong> : {{ $page['productspecvalue_item']->spec4; }}</li>
                            @endif
                            @if($item->spec5)
                            <li><strong>{{ $item->spec5; }}</strong> : {{ $page['productspecvalue_item']->spec5; }}</li>
                            @endif
                            @if($item->spec6)
                            <li><strong>{{ $item->spec6; }}</strong> : {{ $page['productspecvalue_item']->spec6; }}</li>
                            @endif
                            @if($item->spec7)
                            <li><strong>{{ $item->spec7; }}</strong> : {{ $page['productspecvalue_item']->spec7; }}</li>
                            @endif
                            @if($item->spec8)
                            <li><strong>{{ $item->spec8; }}</strong> : {{ $page['productspecvalue_item']->spec8; }}</li>
                            @endif
                            @if($item->spec9)
                            <li><strong>{{ $item->spec9; }}</strong> : {{ $page['productspecvalue_item']->spec9; }}</li>
                            @endif
                            @if($item->spec10)
                            <li><strong>{{ $item->spec10; }}</strong> : {{ $page['productspecvalue_item']->spec10; }}</li>
                            @endif
                            @if($item->spec11)
                            <li><strong>{{ $item->spec11; }}</strong> : {{ $page['productspecvalue_item']->spec11; }}</li>
                            @endif
                            @if($item->spec12)
                            <li><strong>{{ $item->spec12; }}</strong> : {{ $page['productspecvalue_item']->spec12; }}</li>
                            @endif
                            @if($item->spec13)
                            <li><strong>{{ $item->spec13; }}</strong> : {{ $page['productspecvalue_item']->spec13; }}</li>
                            @endif
                            @if($item->spec14)
                            <li><strong>{{ $item->spec14; }}</strong> : {{ $page['productspecvalue_item']->spec14; }}</li>
                            @endif
                            @if($item->spec15)
                            <li><strong>{{ $item->spec15; }}</strong> : {{ $page['productspecvalue_item']->spec15; }}</li>
                            @endif
                            @if($item->spec16)
                            <li><strong>{{ $item->spec16; }}</strong> : {{ $page['productspecvalue_item']->spec16; }}</li>
                            @endif
                            @if($item->spec17)
                            <li><strong>{{ $item->spec17; }}</strong> : {{ $page['productspecvalue_item']->spec17; }}</li>
                            @endif
                            @if($item->spec18)
                            <li><strong>{{ $item->spec18; }}</strong> : {{ $page['productspecvalue_item']->spec18; }}</li>
                            @endif
                            @if($item->spec19)
                            <li><strong>{{ $item->spec19; }}</strong> : {{ $page['productspecvalue_item']->spec19; }}</li>
                            @endif
                            @if($item->spec20)
                            <li><strong>{{ $item->spec20; }}</strong> : {{ $page['productspecvalue_item']->spec20; }}</li>
                            @endif
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
            <div class="accordion-group">
                <div class="accordion-heading"> 
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree"> {{ \Lang::get('theme_preciso.reviews_product'); }} ( {{ $page['comment_num']; }} ) </a> 
                </div>
                <div id="collapseThree" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <ul class="unstyled">
                            @foreach ($page['comment_result'] as $item_comment)
                            <li> 
                                <strong>{{ \Productcomment::getUsername($item_comment->id); }}</strong>
                                <p class="clearfix"></p>
                                <em>{{ date("d F Y", strtotime($item_comment->created_at)); }}</em>
                                <p>{{ $item_comment->message; }}</p>
                            </li>
                            @endforeach
                        </ul>

                        <!-- Write Review -->
                        <h5>Write a Review</h5>
                        {{ \Form::open(array('class' => 'form-horizontal write-review', 'id' => 'frmWrite-review', 'role' => 'form')); }}
                        <fieldset>
                            {{ \Form::text('name', Input::old('name'), array('id' => 'name', 'class' => 'span4 form-control', 'placeholder' => 'Name')); }}
                            <p class="clearfix"></p>
                            {{ Form::textarea('message', \Input::old('message'), array('id' => 'message', 'class' => 'form-control', 'cols' => 100, 'rows' => 5)); }}
                            <input type="hidden" name="product_id" value="{{ $page['item']->ProductID; }}" />
                            <input type="button" name="btnSend" id="btnSave" class="btn" value=" Send " />
                        </fieldset>
                        {{ Form::close(); }}
                    </div>
                </div>
            </div>
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
{{ $page['related_product']; }}
{{ $page['recommended_product']; }}
{{ $page['show_product']; }}
@stop
@section('seo_title')
{{ ': ' . $page['seo']['title']; }}
@stop
@section('seo_description')
{{ $page['seo']['description']; }}
@stop
@section('seo_keywords')
{{ $page['seo']['keywords']; }}
@stop
@section('script_page_code')
<script type="text/javascript">
    $(function() {
        $("#stockUpdate").append("<img src='/theme/backend/default/img/ajax-loader.gif' />");
        $.ajax({
            type: 'GET',
            url: 'http://wholesaledev.webthdesign.com/get/stock',
            data: {id:<?php echo \Request::segment(3); ?>},
            dataType: 'jsonp',
            jsonp: "callback",
            success: function(data) {
                var myid = "#" + data.id;
                $(myid).text(data.val);
            }
        });
    });
    $('#btnSave').click(function() {
        var data = {
            url: 'product/comment/add',
            v: $('#frmWrite-review, textarea input:not(#btnSave)').serializeArray(),
            form: 'frmWrite-review',
            redirect: 'product/view/<?php echo $page['item']->ProductID; ?>'
        };
        saveData(data);
    });
</script>
@stop