<?php foreach ($page['result'] as $timeline) { ?>
    <section class="panel">
        <header class="panel-heading">
            <?php echo $timeline->name; ?>
        </header>
        <div class="panel-body">
            <?php echo $timeline->shortdetail; ?>
            <hr />
            <i class="icon-time text-primary"></i>
            <span><?php echo \Carbon::createFromTimeStamp(strtotime($timeline->created_at))->diffForHumans() ?></span>            
            <button class="btn btn-sm btn-white" data-toggle="button">
                <i class="icon-thumbs-up text-primary"></i>
                55
            </button>
        </div>
    </section>
<?php } ?>