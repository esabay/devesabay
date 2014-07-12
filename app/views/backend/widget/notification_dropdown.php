<a data-toggle="dropdown" class="dropdown-toggle" id="notification_show" href="#">
    <i class="icon-bell-alt"></i>
    <?php if ($page['count'] > 0) { ?>
        <span class="badge bg-warning"><?php echo $page['count']; ?></span>
<?php } ?>
</a>
<ul class="dropdown-menu extended notification">
    <div class="notify-arrow notify-arrow-yellow"></div>
    <li>
        <p class="yellow">คุณมี <?php echo $page['count']; ?> รายการแจ้งเตื่อนใหม่</p>
    </li>
<?php foreach ($page['result'] as $item) { ?>    
        <li>
            <a href="<?php echo \URL::to($item->url); ?>">
                <span class="label <?php echo $item->label; ?>"><i class="<?php echo $item->icon; ?>"></i></span>
    <?php echo $item->title; ?>
                <span class="small italic">
                    <?php echo \Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans() ?>
                </span>
            </a>
        </li>
<?php } ?>
    <li>
        <a href="<?php echo \URL::to('backend/common/notification'); ?>">แสดงรายการแจ้งเตือนทั้งหมด</a>
    </li>
</ul>