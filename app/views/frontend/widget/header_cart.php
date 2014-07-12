<div class="cart <?php echo (\Cart::totalItems() > 0 ? 'on' : '') ?>">
    <?php if (\Cart::totalItems() > 0) { ?>
        <i class="icon-shopping-cart"></i>
        <p><?php echo number_format(\Cart::total()); ?> <span>( <?php echo \Cart::totalItems(true); ?> )</span></p>

        <!-- Header Cart Content -->
        <div class="cart-content">
            <div class="mini-cart-info">
                <h3>รายการสินค้าที่ซื้อ</h3>
                <ul>
                    <?php foreach (\Cart::contents() as $item) { ?>
                        <li>
                            <a href="<?php echo URL::to('/product/view/' . $item->id); ?>">
                                <img src="<?php echo \URL::to(\Products::getImgCover($item->id)); ?>" alt="<?php echo $item->name; ?>" />
                            </a>
                            <div class="mini-cart-detail">
                                <h5><a href="<?php echo URL::to('/product/view/' . $item->id); ?>"><?php echo \Str::limit($item->name, 20); ?></a></h5>
                                <em><?php echo $item->quantity; ?> item</em>
                                <p><strong><?php echo (\Products::getPrice($item->ProductID) != '' ? number_format(\Products::getPrice($item->ProductID)) . ' ' . \Lang::get('common.currency') : 'CALL'); ?></strong></p>
                            </div>                            
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="mini-cart-total">
                <p class="total">Total <span><?php echo number_format(\Cart::total()); ?></span> 
            </div>
            <div class="checkout">
                <a href="<?php echo \URL::to('shopping/cart'); ?>" class="btn">แสดงตะกร้าสินค้า</a>
                <a href="<?php echo \URL::to('shopping/checkout'); ?>" class="btn btn-checkout">สั่งซื้อ</a>
            </div>
        </div>
    <?php } else { ?>
        <i class="icon-shopping-cart"></i>
        <p>0,00 <span>( 0 )</span></p>
        <div class="cart-content">
            <div class="mini-cart-info">
                <h3>ตะกร้าสินค้า</h3>
                <p class="empty">ยังไม่มีรายการสินค้า</p>
            </div>
        </div>                        
    <?php } ?>
</div>