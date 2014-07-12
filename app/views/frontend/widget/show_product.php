<div class="products-list products-list-small">
    <div class="container">
        <div class="tabbable">
            <div class="nav-tabs">
                <a href="#tab1" data-toggle="tab"><?php echo \Lang::get('theme_preciso.latest_products'); ?></a>
                <a href="#tab2" data-toggle="tab" class="active"><?php echo \Lang::get('theme_preciso.special_products'); ?></a>
                <a href="#tab3" data-toggle="tab"><?php echo \Lang::get('theme_preciso.most_popular'); ?></a>
            </div>
            <div class="tab-content">
                <div class="tab-pane" id="tab1">
                    <ul class="thumbnails">
                        <?php foreach ($page['result_last_product'] as $last_product) { ?>
                            <li class="span2">
                                <div class="thumbnail" style="height:220px;">
                                    <a href="<?php echo \URL::to('product/view/' . $last_product->ProductID); ?>" class="thumb" target="_new">
                                        <img src="<?php echo \URL::to(json_decode(trim($last_product->imgcover))->{'front'}); ?>" alt="<?php echo $last_product->ProductName; ?>">
                                    </a>
                                    <p>
                                        <a href="<?php echo \URL::to('product/view/' . $last_product->ProductID); ?>" target="_new">
                                            <?php echo $last_product->ProductName; ?>
                                        </a>
                                    </p>
                                    <p class="price">
                                        <strong><?php echo (\Products::getPrice($last_product->ProductID)!='' ? number_format(\Products::getPrice($last_product->ProductID)).' '.\Lang::get('common.currency') : 'CALL'); ?></strong>
                                    </p>                                                                    
                                    <?php
                                    if ($last_product->new == 0) {
                                        echo '<span class="new">New</span>';
                                    }
                                    if ($last_product->SalePrice > 0) {
                                        echo '<span class="sale">Sale</span>';
                                    }
                                    ?>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                    <hr />
                </div>
                <div class="tab-pane active" id="tab2">
                    <ul class="thumbnails">
                        <?php foreach ($page['result_spacial_product'] as $spacial_product) { ?>
                            <li class="span2">
                                <div class="thumbnail" style="height:220px;">
                                    <a href="<?php echo \URL::to('product/view/' . $spacial_product->ProductID); ?>" class="thumb" target="_new">
                                        <img src="<?php echo \URL::to(json_decode(trim($spacial_product->imgcover))->{'front'}); ?>" alt="<?php echo $spacial_product->ProductName; ?>">
                                    </a>
                                    <p><a href="<?php echo \URL::to('product/view/' . $spacial_product->ProductID); ?>" target="_new"><?php echo $spacial_product->ProductName; ?></a></p>
                                    <p class="price">
                                        <strong><?php echo (\Products::getPrice($spacial_product->ProductID)!='' ? number_format(\Products::getPrice($spacial_product->ProductID)).' '.\Lang::get('common.currency') : 'CALL'); ?></strong>
                                    </p>                                                                    
                                    <?php
                                    if ($spacial_product->new == 0) {
                                        echo '<span class="new">New</span>';
                                    }
                                    if ($spacial_product->SalePrice > 0) {
                                        echo '<span class="sale">Sale</span>';
                                    }
                                    ?>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                    <hr />
                </div>
                <div class="tab-pane" id="tab3">
                    <ul class="thumbnails">
                        <?php foreach ($page['result_popular_product'] as $popular_product) { ?>
                            <li class="span2">
                                <div class="thumbnail" style="height:220px;">
                                    <a href="<?php echo \URL::to('product/view/' . $popular_product->ProductID); ?>" class="thumb" target="_new">
                                        <img src="<?php echo \URL::to(json_decode(trim($popular_product->imgcover))->{'front'}); ?>" alt="<?php echo $popular_product->ProductName; ?>">
                                    </a>
                                    <p><a href="<?php echo \URL::to('product/view/' . $popular_product->ProductID); ?>" target="_new"><?php echo $popular_product->ProductName; ?></a></p>
                                    <p class="price">
                                        <strong><?php echo (\Products::getPrice($popular_product->ProductID)!='' ? number_format(\Products::getPrice($popular_product->ProductID)).' '.\Lang::get('common.currency') : 'CALL'); ?></strong>
                                    </p>                                                                   
                                    <?php
                                    if ($popular_product->new == 0) {
                                        echo '<span class="new">New</span>';
                                    }
                                    if ($popular_product->SalePrice > 0) {
                                        echo '<span class="sale">Sale</span>';
                                    }
                                    ?>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                    <hr />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="products-list products-list-small">
    <div class="container">        
        <div class="row">
            <div class="span9">
                <h3><?php echo \Lang::get('theme_preciso.notebook_pc'); ?></h3>
            </div>
            <div class="span3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs" style="margin-right:10px; width: 78px;">
                    <a class="left icon-chevron-left btn btn-success" href="#carousel1-example"
                       data-slide="prev"></a>
                    <a class="right icon-chevron-right btn btn-success" href="#carousel1-example"
                       data-slide="next"></a>
                </div>
            </div>
        </div>

        <div id="carousel1-example" class="carousel slide hidden-xs" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                for ($i = 0; $i <= 3; $i++) {
                    $rs_printer = \DB::table('products')
                            ->where('disabled', 0)
                            ->whereIn('CategoryID', array(37, 38, 39, 40, 41, 42, 43, 44, 45, 72, 73, 74, 75, 76))
                            ->orderBy(\DB::raw('RAND()'))
                            ->take(12)
                            ->get();
                    ?>

                    <div class="item <?php echo $i == 0 ? 'active' : ''; ?>">
                        <ul class="thumbnails">
                            <?php foreach ($rs_printer as $notebook_pc) { ?>
                                <li class="span2">
                                    <div class="thumbnail" style="height:220px;">
                                        <a href="<?php echo \URL::to('product/view/' . $notebook_pc->ProductID); ?>" class="thumb" target="_new">
                                            <img src="<?php echo \URL::to(json_decode(trim($notebook_pc->imgcover))->{'front'}); ?>" alt="<?php echo $notebook_pc->ProductName; ?>">
                                        </a>
                                        <p>
                                            <a href="<?php echo \URL::to('product/view/' . $notebook_pc->ProductID); ?>" target="_new">
                                                <?php echo $notebook_pc->ProductName; ?>
                                            </a>
                                        </p>
                                        <p class="price">
                                            <strong><?php echo (\Products::getPrice($notebook_pc->ProductID)!='' ? number_format(\Products::getPrice($notebook_pc->ProductID)).' '.\Lang::get('common.currency') : 'CALL'); ?></strong>
                                        </p>                                                                    
                                        <?php
                                        if ($notebook_pc->new == 0) {
                                            echo '<span class="new">New</span>';
                                        }
                                        if ($notebook_pc->SalePrice > 0) {
                                            echo '<span class="sale">Sale</span>';
                                        }
                                        ?>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="products-list products-list-small">
    <div class="container">

        <div class="row">
            <div class="span9">
                <h3><?php echo \Lang::get('theme_preciso.smart_phone'); ?></h3>
            </div>
            <div class="span3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs" style="margin-right:10px; width: 78px;">
                    <a class="left icon-chevron-left btn btn-success" href="#carousel2-example"
                       data-slide="prev"></a>
                    <a class="right icon-chevron-right btn btn-success" href="#carousel2-example"
                       data-slide="next"></a>
                </div>
            </div>
        </div>

        <div id="carousel2-example" class="carousel slide hidden-xs" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                for ($i = 0; $i <= 3; $i++) {
                    $rs_smartphone = \DB::table('products')
                            ->where('disabled', 0)
                            ->whereIn('CategoryID', array(62, 63, 64, 65, 66, 67, 68, 69, 70))
                            ->orderBy(\DB::raw('RAND()'))
                            ->take(12)
                            ->get();
                    ?>

                    <div class="item <?php echo $i == 0 ? 'active' : ''; ?>">
                        <ul class="thumbnails">
                            <?php foreach ($rs_smartphone as $smartphone) { ?>
                                <li class="span2">
                                    <div class="thumbnail" style="height:220px;">
                                        <a href="<?php echo \URL::to('product/view/' . $smartphone->ProductID); ?>" class="thumb" target="_new">
                                            <img src="<?php echo \URL::to(json_decode(trim($smartphone->imgcover))->{'front'}); ?>" alt="<?php echo $smartphone->ProductName; ?>">
                                        </a>
                                        <p>
                                            <a href="<?php echo \URL::to('product/view/' . $smartphone->ProductID); ?>" target="_new">
                                                <?php echo $smartphone->ProductName; ?>
                                            </a>
                                        </p>
                                        <p class="price">
                                            <strong><?php echo (\Products::getPrice($smartphone->ProductID)!='' ? number_format(\Products::getPrice($smartphone->ProductID)).' '.\Lang::get('common.currency') : 'CALL'); ?></strong>
                                        </p>                                                                    
                                        <?php
                                        if ($smartphone->new == 0) {
                                            echo '<span class="new">New</span>';
                                        }
                                        if ($smartphone->SalePrice > 0) {
                                            echo '<span class="sale">Sale</span>';
                                        }
                                        ?>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="products-list products-list-small">
    <div class="container">

        <div class="row">
            <div class="span9">
                <h3><?php echo \Lang::get('theme_preciso.printer'); ?></h3>
            </div>
            <div class="span3">
                <!-- Controls -->
                <div class="controls pull-right hidden-xs" style="margin-right:10px; width: 78px;">
                    <a class="left icon-chevron-left btn btn-success" href="#carousel3-example"
                       data-slide="prev"></a>
                    <a class="right icon-chevron-right btn btn-success" href="#carousel3-example"
                       data-slide="next"></a>
                </div>
            </div>
        </div>

        <div id="carousel3-example" class="carousel slide hidden-xs" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                for ($i = 0; $i <= 3; $i++) {
                    $rs_printer = \DB::table('products')
                            ->where('disabled', 0)
                            ->whereIn('CategoryID', array(172, 173, 174, 175, 176, 427))
                            ->orderBy(\DB::raw('RAND()'))
                            ->take(12)
                            ->get();
                    ?>

                    <div class="item <?php echo $i == 0 ? 'active' : ''; ?>">
                        <ul class="thumbnails">
                            <?php foreach ($rs_printer as $printer) { ?>
                                <li class="span2">
                                    <div class="thumbnail" style="height:220px;">
                                        <a href="<?php echo \URL::to('product/view/' . $printer->ProductID); ?>" class="thumb" target="_new">
                                            <img src="<?php echo \URL::to(json_decode(trim($printer->imgcover))->{'front'}); ?>" alt="<?php echo $printer->ProductName; ?>">
                                        </a>
                                        <p>
                                            <a href="<?php echo \URL::to('product/view/' . $printer->ProductID); ?>" target="_new">
                                                <?php echo $printer->ProductName; ?>
                                            </a>
                                        </p>
                                        <p class="price">
                                            <strong><?php echo (\Products::getPrice($printer->ProductID)!='' ? number_format(\Products::getPrice($printer->ProductID)).' '.\Lang::get('common.currency') : 'CALL'); ?></strong>
                                        </p>                                                                    
                                        <?php
                                        if ($printer->new == 0) {
                                            echo '<span class="new">New</span>';
                                        }
                                        if ($printer->SalePrice > 0) {
                                            echo '<span class="sale">Sale</span>';
                                        }
                                        ?>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


