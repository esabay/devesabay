<?php if ($page['result_last_product']) { ?>
    <div class="products-list products-list-small">
        <div class="container">
            <h3><?php echo \Lang::get('theme_preciso.last_products'); ?></h3>
            <ul class="thumbnails">
                <?php foreach ($page['result_last_product'] as $last_product) { ?>
                    <li class="span2">
                        <div class="thumbnail">
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
    </div>
<?php } ?>