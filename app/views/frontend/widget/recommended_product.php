<?php if ($page['result_recommended_product']) { ?>
    <div class="products-list products-list-small">
        <div class="container">
            <h3><?php echo \Lang::get('theme_preciso.recommended_products'); ?></h3>
            <ul class="thumbnails">
                <?php
                foreach ($page['result_recommended_product'] as $item) {
                    $prod = \DB::table('products')
                            ->where('ProductCode', trim($item))
                            ->first();
                    if ($prod) {
                        ?>      
                        <li class="span2">
                            <div class="thumbnail">
                                <a href="<?php echo \URL::to('product/view/' . $prod->ProductID); ?>" class="thumb" target="_new">
                                    <img src="<?php echo \URL::to(json_decode(trim($prod->imgcover))->{'front'}); ?>" alt="<?php echo $prod->ProductName; ?>">
                                </a>
                                <p>
                                    <a href="<?php echo \URL::to('product/view/' . $prod->ProductID); ?>" target="_new">
                                        <?php echo $prod->ProductName; ?>
                                    </a>
                                </p>
                                <p class="price">
                                    <strong><?php echo (\Products::getPrice($prod->ProductID)!='' ? number_format(\Products::getPrice($prod->ProductID)).' '.\Lang::get('common.currency') : 'CALL'); ?></strong>
                                </p>                                                        
                                <?php
                                if ($prod->new == 0) {
                                    echo '<span class="new">New</span>';
                                }
                                if ($prod->SalePrice > 0) {
                                    echo '<span class="sale">Sale</span>';
                                }
                                ?>
                            </div>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
            <hr />
        </div>
    </div>
<?php } ?>
