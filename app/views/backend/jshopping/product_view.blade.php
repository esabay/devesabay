@extends('backend.layouts.master')
@section('stylesheet_page_only')
{{HTML::style('theme/backend/default/assets/bootstrap-fileupload/bootstrap-fileupload.css')}}
@stop
@section('content')
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <!--                
                -->
                <div class="form-actions">
                    <div class="pull-left">
                        <a href="{{URL::to('/backend/jshopping/product')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i> {{\Lang::get('common.back')}}</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="row">    
    <div class="col-md-12">
        <section class="panel">
            <div class="panel-body">
                <div class="col-md-6">
                    <div class="pro-img-details">
<!--                        <img src="img/product-list/pro-thumb-big.jpg" alt=""/>-->
                    </div>
                    <div class="pro-img-list">
                        @foreach($page['gallery'] as $item)
                        <a href="#">
                            <img src="{{ URL::to(json_decode(trim($item->title))->{'thumbs'}) }}" alt="" width="200">
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="pro-d-title">
                        <a href="#" class="">
                            {{$page['item']->ProductName}}
                        </a>
                    </h4>
                    {{$page['item']->ShortDetail}}
                    <div class="product_meta">
                        <span class="posted_in"> <strong>Categories:</strong> {{$page['cat_parent']}} / {{$page['category']}}</span>
                        <span class="tagged_as"><strong>Tags:</strong> {{$page['item']->tags}}</span>
                        <span class="tagged_as"><strong>Product Code :</strong> {{$page['item']->ProductCode}}</span>
                    </div>
                    <div class="m-bot15"> <strong>Price :</strong> {{ \Products::getPriceCp($page['item']->ProductID); }}</div>

                </div>
            </div>

        </section>

        <section class="panel">
            <header class="panel-heading tab-bg-dark-navy-blue">
                <ul class="nav nav-tabs ">
                    <li class="active">
                        <a data-toggle="tab" href="#description">
                            {{\Lang::get('jshopping.detail')}}
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#spec">
                            {{\Lang::get('jshopping.spec')}}
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#reviews">
                            {{\Lang::get('jshopping.reviews')}}
                        </a>
                    </li>

                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content tasi-tab">
                    <div id="description" class="tab-pane active">
                        {{$page['item']->Detail}}
                    </div>
                    <div id="spec" class="tab-pane">
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
                    <div id="reviews" class="tab-pane">
                        <article class="media">
                            <a class="pull-left thumb p-thumb">
                                <img src="img/avatar-mini.jpg">
                            </a>
                            <div class="media-body">
                                <a href="#" class="cmt-head">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                <p> <i class="icon-time"></i> 1 hours ago</p>
                            </div>
                        </article>

                    </div>
                </div>
            </div>
        </section>
        @if ($page['result_related_product'])
        <div class="row product-list">
            <h4 class="pro-d-head">{{\Lang::get('jshopping.related')}}</h4>
            <?php
            foreach ($page['result_related_product'] as $item2) {
                $prod2 = \DB::table('products')
                        ->where('ProductCode', trim($item2))
                        ->first();
                if ($prod2) {
                    ?> 
                    <div class="col-md-2">
                        <section class="panel">
                            <div class="pro-img-box">
                                <img src="<?php echo \URL::to(json_decode(trim($prod2->imgcover))->{'cover'}); ?>" alt="<?php echo $prod2->ProductName; ?>"/>
                            </div>

                            <div class="panel-body text-center">
                                <h4>
                                    <a href="{{\URL::to('backend/jshopping/product/view/'.$prod2->ProductID.'')}}" class="pro-title" target="_new">
                                        <?php echo $prod2->ProductName; ?>
                                    </a>
                                </h4>
                                <p class="price"><?php
                                    echo \Products::getPriceCp($prod2->ProductID);
                                    ;
                                    ?></p>
                            </div>

                        </section>
                    </div>

                    <?php
                }
            }
            ?>
        </div>
        @endif
        @if ($page['result_recommended_product'])
        <div class="row product-list">
            <h4 class="pro-d-head">{{\Lang::get('jshopping.recommended')}}</h4>
            <?php
            foreach ($page['result_recommended_product'] as $item) {
                $prod = \DB::table('products')
                        ->where('ProductCode', trim($item))
                        ->first();
                if ($prod) {
                    ?> 
                    <div class="col-md-2">
                        <section class="panel">
                            <div class="pro-img-box">
                                <img src="<?php echo \URL::to(json_decode(trim($prod->imgcover))->{'cover'}); ?>" alt="<?php echo $prod->ProductName; ?>"/>
                            </div>

                            <div class="panel-body text-center">
                                <h4>
                                    <a href="{{\URL::to('backend/jshopping/product/view/'.$prod->ProductID.'')}}" class="pro-title" target="_new">
                                        <?php echo $prod->ProductName; ?>
                                    </a>
                                </h4>
                                <p class="price">{{\Products::getPriceCp($prod->ProductID);}}</p>
                            </div>

                        </section>
                    </div>

                    <?php
                }
            }
            ?>
        </div>
        @endif        
    </div>
</div>
@stop
@section('script_page_only')

@stop
@section('script_page_code')
<script type="text/javascript">

</script>
@stop