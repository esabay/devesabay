<div class="products-list">
    <div class="container">
        <ul class="thumbnails">
            <?php foreach ($page['result_featured_product'] as $featured_product) { ?>
                <li class="span3">
                    <div class="thumbnail">
                        <a href="<?php echo \URL::to('product/view/' . $featured_product->ProductID); ?>" class="thumb" target="_new">
                            <?php echo HTML::image(json_decode(trim($featured_product->imgcover))->{'front'}, $featured_product->ProductName); ?>
                        </a>
                        <p>
                            <a href="<?php echo \URL::to('product/view/' . $featured_product->ProductID); ?>" target="_new"><?php echo $featured_product->ProductName; ?></a>
                        </p>
                        <p class="price">
                            <strong><?php echo (\Products::getPrice($featured_product->ProductID)!='' ? number_format(\Products::getPrice($featured_product->ProductID)).' '.\Lang::get('common.currency') : 'CALL'); ?></strong>
                        </p>
                        <?php if (\Products::getPrice($featured_product->ProductID) != '') { ?>
                            <input type="button" value="<?php echo \Lang::get('theme_preciso.add_to_cart'); ?>" id="<?php echo $featured_product->ProductID; ?>" class="btn btnAddCart" />
                        <?php } ?>
                        <a href="javascript:;" class="add-list" id="<?php echo $featured_product->ProductID; ?>"><i class="icon-star"></i><?php echo \Lang::get('theme_preciso.add_wishlist'); ?></a>
                        <a href="javascript:;" class="add-comp" id="<?php echo $featured_product->ProductID; ?>"><i class="icon-tasks"></i><?php echo \Lang::get('theme_preciso.add_compare'); ?></a>
                            <?php
                            if ($featured_product->new == 0) {
                                echo '<span class="new">New</span>';
                            }
                            if ($featured_product->SalePrice > 0) {
                                echo '<span class="sale">Sale</span>';
                            }
                            ?>

                    </div>
                </li>
            <?php } ?>        
        </ul>
    </div>
</div>