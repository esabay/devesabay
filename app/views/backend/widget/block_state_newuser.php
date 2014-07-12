<div class="col-lg-3 col-sm-6">
    <section class="panel">
        <div class="symbol terques">
            <i class="icon-user"></i>
        </div>
        <div class="value">
            <h1 class="count">
                0
            </h1>
            <p>ลูกค้าใหม่</p>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(function() {
        countUp(<?php echo $page['count'][0]->{'c_user'}; ?>);
    });
</script>