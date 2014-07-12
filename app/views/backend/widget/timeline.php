<div class="text-center mbot30">
    <h3 class="timeline-title" id="timeline">Timeline</h3>
</div>

<div class="timeline">
    <?php foreach($page['result'] as $timeline) { ?>
        <article class="timeline-item <?php echo ($timeline->id % 2 ? 'alt' : ''); ?>">
            <div class="timeline-desk">
                <div class="panel">
                    <div class="panel-body">
                        <span class="<?php echo ($timeline->id % 2 ? 'arrow-alt' : 'arrow'); ?>"></span>
                        <span class="timeline-icon <?php echo $timeline->color; ?>"></span>
                        <span class="timeline-date"><?php echo \Carbon::createFromTimeStamp(strtotime($timeline->created_at))->diffForHumans() ?></span>
                        <?php if ($timeline->module == 'jshopping') { ?>
                            <p>เพิ่มสินค้า <?php echo $timeline->title ?> <?php echo link_to('backend/jshopping/product/view/' . $timeline->pk_id, ' View', array('target' => '_new')); ?></p>
                            <div class="album">
                                <?php foreach (\Productimg::where('ProductID', $timeline->pk_id)->get() as $item) { ?>
                                    <a href="javascript:;">
                                        <img src="<?php echo URL::to(json_decode(trim($item->title))->{'thumbs'}); ?>" height="32">
                                    </a>     
                                <?php } ?>
                            </div>
                        <?php } elseif ($timeline->module == 'jproject') { ?>
                            <p>IT Service Request Form : <?php echo $timeline->title; ?></p>
                        <?php } elseif ($timeline->module == 'posting') { ?>
                            <p><?php echo $timeline->title ?> <?php echo link_to('backend/posting/view/' . $timeline->pk_id, ' View', array('target' => '_new')); ?></p>
                            <div class="album">
                                <?php foreach (\Postingimg::where('posting_id', $timeline->pk_id)->get() as $item) { ?>
                                    <a href="javascript:;">
                                        <img src="<?php echo URL::to(json_decode(trim($item->path))->{'cover'}); ?>" height="32">
                                    </a>     
                                <?php } ?>
                            </div>
                        <?php } elseif ($timeline->module == 'jgallery') { ?>
                            <p>เพิ่มอัลบั้มรูป : <?php echo $timeline->title; ?> <?php echo link_to('backend/' . $timeline->url, 'Click !', array('target' => '_new')); ?></p>                                    
                        <?php } else { ?>
                            <p><?php echo $timeline->title; ?> <?php echo link_to('backend/' . $timeline->url, 'Click !', array('class' => 'fancybox')); ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </article>
    <?php } ?>
</div>

<div class="clearfix">&nbsp;</div>