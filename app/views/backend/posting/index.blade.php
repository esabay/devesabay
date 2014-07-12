@extends('backend.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-3">
        <section class="panel">
            <div class="panel-body">
                <input type="text" placeholder="Keyword Search" class="form-control">
            </div>
        </section>
        <section class="panel">
            <header class="panel-heading">
                Category
            </header>
            <div class="panel-body">
                <ul class="nav prod-cat">
                    <li>
                        <a href="#" class="active"><i class=" icon-angle-right"></i> Dress</a>
                        <ul class="nav">
                            <li class="active"><a href="#">- Shirt</a></li>
                            <li><a href="#">- Pant</a></li>
                            <li><a href="#">- Shoes</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class=" icon-angle-right"></i> Bags & Purses</a></li>
                    <li><a href="#"><i class=" icon-angle-right"></i> Beauty</a></li>
                    <li><a href="#"><i class=" icon-angle-right"></i> Coat & Jacket</a></li>
                    <li><a href="#"><i class=" icon-angle-right"></i> Jeans</a></li>
                    <li><a href="#"><i class=" icon-angle-right"></i> Jewellery</a></li>
                    <li><a href="#"><i class=" icon-angle-right"></i> Electronics</a></li>
                    <li><a href="#"><i class=" icon-angle-right"></i> Sports</a></li>
                    <li><a href="#"><i class=" icon-angle-right"></i> Technology</a></li>
                    <li><a href="#"><i class=" icon-angle-right"></i> Watches</a></li>
                    <li><a href="#"><i class=" icon-angle-right"></i> Accessories</a></li>
                </ul>
            </div>
        </section>
        <section class="panel">
            <header class="panel-heading">
                Best Seller
            </header>
            <div class="panel-body">
                <div class="best-seller">
                    <article class="media">
                        <a class="pull-left thumb p-thumb">
                            <img src="img/product1.jpg">
                        </a>
                        <div class="media-body">
                            <a href="#" class=" p-head">Item One Tittle</a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </article>
                    <article class="media">
                        <a class="pull-left thumb p-thumb">
                            <img src="img/product2.png">
                        </a>
                        <div class="media-body">
                            <a href="#" class=" p-head">Item Two Tittle</a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </article>
                    <article class="media">
                        <a class="pull-left thumb p-thumb">
                            <img src="img/product3.png">
                        </a>
                        <div class="media-body">
                            <a href="#" class=" p-head">Item Three Tittle</a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-9">
        <section class="panel">
            <div class="panel-body">
                <div class="pro-sort">
                    <label class="pro-lab">Sort By</label>
                    <select class="styled" >
                        <option>Default Sorting</option>
                        <option>Popularity</option>
                        <option>Average Rating</option>
                        <option>Newness</option>
                        <option>Price Low to High</option>
                        <option>Price High to Low</option>
                    </select>
                </div>
                <div class="pro-sort">
                    <label class="pro-lab">Show</label>
                    <select class="styled" >
                        <option>Result Per Page</option>
                        <option>2 Per Page</option>
                        <option>4 Per Page</option>
                        <option>6 Per Page</option>
                        <option>8 Per Page</option>
                        <option>10 Per Page</option>
                    </select>
                </div>

                <div class="pull-right">  
                    <ul class="pagination pagination-sm pro-page-list">
                        <?php echo $page['result']->appends(array('s_title' => trim(\Input::get('s_title')), 's_CategoryID' => \Input::get('s_CategoryID'), 'search' => 1))->links(); ?>
                    </ul>
                </div>
            </div>
        </section>

        <div class="row product-list">
            @foreach($page['result'] as $item)
            <?php
            $photo = \Postingimg::where('posting_id', $item->id)->first();

            if (isset($photo)) {
                if (file_exists(json_decode(trim($photo->path))->{'cover'})) {
                    $photo = \URL::to(json_decode(trim($photo->path))->{'cover'});
                } else {
                    $photo = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                }
            } else {
                $photo = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
            }
            ?>
            <div class="col-md-3" style="height: 320px;">
                <section class="panel">
                    <div class="pro-img-box">
                        <img src="{{$photo}}" alt="{{$item->title}}"/>
                        <a href="javascript:;" class="adtocart">
                            <i class="icon-shopping-cart"></i>
                        </a>
                    </div>

                    <div class="panel-body text-center">
                        <h4>
                            <a href="{{\URL::to('/backend/posting/view/'.$item->id.'')}}" target="_blank" class="pro-title">
                                {{$item->title}}
                            </a>
                        </h4>
                        <p class="price">{{number_format($item->price)}} ฿</p>
                    </div>
                </section>
            </div>
            @endforeach

        </div>
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
@section('script_page')

@stop
@section('script_page_only')
{{HTML::script('theme/backend/default/js/jquery.ui.touch-punch.min.js')}}
{{HTML::script('theme/backend/default/js/jquery.customSelect.min.js')}}
@stop

@section('script_page_code')
<script type="text/javascript">

</script>
@stop