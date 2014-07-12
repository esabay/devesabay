<?php if ($page['result_block_product']) { ?>
    <div class="products-list products-list-small">
        <div class="container">
            <h3><?php echo $page['block']['title']; ?></h3>
            <ul class="thumbnails">
                <?php foreach ($page['result_block_product'] as $block_product) { ?>
                    <li class="span2">
                        <div class="thumbnail" style="height:220px;">
                            <a href="<?php echo \URL::to('product/view/' . $block_product->ProductID); ?>" class="thumb" target="_new">
                                <img src="<?php echo \URL::to(json_decode(trim($block_product->imgcover))->{'front'}); ?>" alt="<?php echo $block_product->ProductName; ?>">
                            </a>
                            <p>
                                <a href="<?php echo \URL::to('product/view/' . $block_product->ProductID); ?>" target="_new">
                                    <?php echo $block_product->ProductName; ?>
                                </a>
                            </p>
                            <p class="price">
                                <strong><?php echo (\Products::getPrice($block_product->ProductID)!='' ? number_format(\Products::getPrice($block_product->ProductID)).' '.\Lang::get('common.currency') : 'CALL'); ?></strong>
                            </p>                                                                    
                            <?php
                            if ($block_product->new == 0) {
                                echo '<span class="new">New</span>';
                            }
                            if ($block_product->SalePrice > 0) {
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
