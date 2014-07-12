{{HTML::style('theme/backend/default/assets/bootstrap-datepicker/css/datepicker.css')}}
<style type="text/css">
    .datepicker{z-index:1151;}
    .control-label {padding-right: 10px;}
    .form-group {margin-bottom: 10px;}
    .form-group-button {margin-left: 170px;}
    .control-text {width: 100px;}
    .help-block {margin-left: 170px;}
    #transfer_bank, #transfer_bank_branch, #transfer_date, #transfer_time  {width: 150px;}
</style>
<form class="form-horizontal" method="post" name="form-add" id="form-add" role="form" enctype="multipart/form-data">
    <div class="form-group">
        <label for="order_id" class="col-sm-2 control-label">รหัสสั่งซื้อ</label>
        <input type="text" class="form-control" id="order_id" name="order_id" value="<?php echo $page['code']; ?>" disabled="disabled" />
    </div>
    <div class="form-group">
        <label for="transfer_name" class="col-sm-2 control-label">ชื่อผู้โอนเงิน</label>
        <input type="text" class="form-control" id="transfer_name" value="<?php echo \User::getFullName(\Auth::user()->id) ?>" name="transfer_name" />
    </div>
    <div class="form-group">
        <label for="transfer_total" class="col-sm-2 control-label">จำนวนเงินที่โอน</label>
        <input type="text" class="form-control" id="transfer_total" value="<?php echo number_format($page['total']); ?>" name="transfer_total" />
    </div>
    <div class="form-group">
        <label for="transfer_date" class="col-sm-2 control-label">วันที่โอนเงิน</label>
        <input type="text" class="form-control" id="transfer_date" value="<?php echo date('Y-m-d'); ?>" name="transfer_date" />
    </div>
    <div class="form-group">
        <label for="transfer_time" class="col-sm-2 control-label">เวลาโอนเงิน</label>
        <input type="text" class="form-control" id="transfer_time" name="transfer_time" />
    </div>
    <div class="form-group">
        <label for="transfer_bank_label" class="col-sm-2 control-label">โอนเงินเข้าบัญชี</label>
        <input type="radio" value="1" name="transfer_in_bank" /> <img src="http://lotus.hostingdynamo.com/imgs/scb.gif" />  ธนาคารไทยพาณิชย์ สาขาเดอะมอลล์ งามวงศ์วาน ชื่อบัญชี บริษัท เจ.ไอ.บี คอมพิวเตอร์ กรุ๊ป จำกัด เลขที่บัญชี xx-xx-xxx

    </div>
    <div class="form-group">
        <label for="transfer_bank_label" class="col-sm-2 control-label">&nbsp;</label>
        <input type="radio" value="2" name="transfer_in_bank" /> <img src="http://lotus.hostingdynamo.com/imgs/kb.gif" />  ธนาคารกสิกรไทย สาขาเซียร์รังสิต ชื่อบัญชี บริษัท เจ.ไอ.บี คอมพิวเตอร์ กรุ๊ป จำกัด เลขที่บัญชี xx-xx-xxx
    </div>
    <div class="form-group">
        <label for="transfer_bank_label" class="col-sm-2 control-label">&nbsp;</label>
        <input type="radio" value="3" name="transfer_in_bank" /> <img src="http://lotus.hostingdynamo.com/imgs/bbl.gif" />  ธนาคารกรุงเทพ สาขาเซียร์รังสิต ชื่อบัญชี บริษัท เจ.ไอ.บี คอมพิวเตอร์ กรุ๊ป จำกัด เลขที่บัญชี xx-xx-xxx
    </div>
    <div class="form-group">
        <label for="transfer_bank" class="col-sm-2 control-label">โอนเงินผ่านธนาคาร</label>
        <input type="text" class="form-control" id="transfer_bank" name="transfer_out_bank" placeholder="ธนาคาร" /> <input type="text" class="form-control" id="transfer_bank_branch" name="transfer_bank_branch" placeholder="สาขา" />
    </div>
    <div class="form-group">
        <label for="transfer_slip" class="col-sm-2 control-label">หลักฐานการโอนเงิน (ถ้ามี)</label>
        <input type="file" class="form-control" id="transfer_slip" name="transfer_slip" />
    </div>
    <div class="form-group">
        <label for="transfer_slip" class="col-sm-2 control-label">หมายเหตุ</label>
        <textarea name="transfer_remark" id="transfer_remark" rows="5" ></textarea>
    </div>
    <div class="form-group-button">
        <input type="button" name="btnDialogSave" id="btnDialogSave" class="btn btn-default" value="ส่งข้อมูล" />
    </div>
    <input type="hidden" name="order_id" value="<?php echo $page['id']; ?>" id="order_id" />
</form>

{{HTML::script('theme/backend/default/assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}
{{HTML::script('theme/backend/default/js/jquery.form.js')}}
<script type="text/javascript">
    $('#transfer_date').datepicker({
        format: 'yyyy-mm-dd'
    });

    $('#btnDialogSave').click(function() {
        var options = {
            url: base_url + 'shopping/payment/add',
            success: showResponse
        };
        $('#form-add').ajaxSubmit(options);
    });

    function showResponse(response, statusText, xhr, $form) {
        $('form .form-group').removeClass('has-error');
        $('form .help-block').remove();
        if (response.error.status === false) {
            $.each(response.error.message, function(key, value) {
                $('#' + key).parent().addClass('has-error');
                $('#' + key).after('<p class="help-block">' + value + '</p>');
            });
        } else {
            var data = {
                title: 'Message',
                text: '<div class="text-center">' + response.error.message + '</div>',
                type: 'info'
            };
            genModal(data);
            setTimeout(function() {
                $('#myModal').modal('hide');
                $('#myModal').on('hidden.bs.modal', function(e) {
                    window.location.href = base_url + 'shopping/history';
                });
            }, 5000);
        }
    }
</script>