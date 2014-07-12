<div class="container">
    <div class="row">
        <div class="span12">
            <!-- Services List -->
            <ul class="thumbnails about-list">

                <?php
                foreach (\Post::where('frontend', 0)
                        ->where('disabled', 0)
                        ->orderBy('id', 'desc')
                        ->take(4)
                        ->get()
                as $item) {
                    ?>
                    <li class="span3">
                        <div class="thumbnail" style="height: 300px;">

                            <?php if ($item->imgcover != '') { ?>
                                <a href="<?php echo \URL::to('/post/' . $item->id); ?>" target="_new"><img src="<?php echo URL::to(json_decode(trim($item->imgcover))->{'front'}); ?>" alt="<?php echo $item->name; ?>" class="folio"></a>              
                            <?php } else { ?>
                                <img src="http://www.placehold.it/370x250/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                            <?php } ?>
                            <div class="caption">
                                <em><?php echo $item->name; ?></em>
                                <div class="clearfix"></div>
                                <p style="text-align: left;"><?php echo \Str::limit($item->shortdetail, 255); ?></p>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <hr />

            <!-- Portfolio Columns -->
            <div class="products-list products-list-simple">
                <ul class="thumbnails">
                    <?php
                    foreach (\Gallery::where('frontend', 0)
                            ->where('disabled', 0)
                            ->orderBy('id', 'desc')
                            ->take(8)
                            ->get()
                    as $item2) {
                        ?>
                        <li class="span3">
                            <div class="thumbnail" style="height: 230px;">
                                <?php if ($item2->imgcover != '') { ?>
                                    <img src="<?php echo URL::to(json_decode(trim($item2->imgcover))->{'cover'}); ?>" alt="<?php echo $item2->name; ?>" class="folio">         
                                <?php } else { ?>
                                    <img src="http://www.placehold.it/250x170/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                <?php } ?>
                                <div class="folio-detail">
                                    <a href="<?php echo \URL::to('gallery/' . $item2->id . '') ?>" class="view-fancybox" rel="tag" target="_new">
                                        <i class="icon-camera"></i>
                                    </a>
                                </div>
                                <div class="caption">
                                    <em><?php echo $item2->name; ?></em>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>