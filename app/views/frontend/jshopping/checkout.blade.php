@extends('frontend.layouts.theme.preciso.master')
@section('content')
<style type="text/css">
    #credit_valid{width: 100px;}
</style>

@if(\Auth::check())
<div class="row">
    <div class="span12"> 
        <!-- Breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="{{ \URL::to('/'); }}">Home</a> <span class="divider">/</span></li>
            <li class="active">Shopping</li>
        </ul>
        <p class="small-desc"></p>
        @if(\Cart::totalItems() <= 0)
        <!-- Alert -->
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Warning</strong> empty cart</div>
        @else
        <!-- Cart -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th class="p-name">Product Name</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach (\Cart::contents() as $item)
                <tr>
                    <td class = "thumb-cart">
                        <a href = "{{ \URL::to('/product/view/' . $item->id); }}">
                            <img src = "{{ \URL::to(\Products::getImgCover($item->id)); }}" alt = "{{ $item->name }}" />
                        </a>
                    </td>
                    <td class = "p-name">
                        <h5>
                            <a href = "{{ \URL::to('/product/view/' . $item->id); }}">{{ $item->name}}</a>
                        </h5>
                    </td>
                    <td>{{ $item->quantity}}</td>
                    <td>{{ number_format($item->price)}}</td>
                    <td><strong>{{ number_format($item->total())}}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Cart Total -->
        <div class="main-cart-total">
            <p class="total">Total <span> {{ number_format(\Cart::total()) }}</span> 
        </div>


        <div class="main-cart-total">
            <p class="total"> ส่วนลด : {{ Form::text('voucher_code',null, array('id'=>'voucher_code','style'=>'margin-bottom:0px;','placeholder'=>'กรอก Voucher ที่นี่')) }} {{ Form::button('ใช้ Voucher',array('class'=>'btn btn-default','id'=>'btnDialogVoucher','data-style'=>'expand-right')) }}  
        </div>
        @endif
    </div>
</div>
@if(\Cart::totalItems() >0)
{{ Form::open(array('name'=>'form-shopping','id'=>'form-shopping','role'=>'form')) }}   
<div class="row">
    <div class="span6">
        <div class="bs-callout bs-callout-info">
            <h4>ข้อมูลบัญชี/ที่อยู่มาตรฐานสำหรับใบเสร็จ</h4>
            <address>
                <strong>{{ \User::getFullName(\Auth::user()->id); }}</strong><br>
                {{ \User::getAddress(\Auth::user()->id); }}<br>
                <abbr title="Phone">P:</abbr> {{ \Auth::user()->mobile; }}
            </address>
            <a href="{{ \URL::to('user/profile/edit'); }}" class="btn btn-default btn-lg" role="button">{{\Lang::get('theme_preciso.change_address')}}</a>
        </div>

    </div>
    <div class="span6">
        <div class="bs-callout bs-callout-info">
            <h4>รายละเอียดใบกำกับภาษี</h4>
            <div class="radio">
                <label>
                    <input type="radio" name="tax_option" id="tax_option" value="0">
                    ใช้ใบกำกับภาษี
                </label>
            </div>
            <address>
                {{ \Shoppingtax::getTaxInformation(\Auth::user()->id); }}<br>
            </address>
            <a href="{{ \URL::to('user/shopping/tax/edit'); }}" class="btn btn-default btn-lg" role="button">{{\Lang::get('theme_preciso.change_taxinfomation')}}</a>
        </div>

    </div>
</div>
<div class="row">
    <div class="span6">
        <div class="bs-callout bs-callout-warning">
            <h4>ที่อยู่มาตรฐานสำหรับจัดส่ง</h4>
            @if(\Auth::user()->addresscopy==1)
            <input type="hidden" value="1" name="shipping_option" />
            <address>
                <strong>{{ \Shippingaddress::getFullName(\Auth::user()->id); }}</strong><br>
                {{ \Shippingaddress::getAddress(\Auth::user()->id); }}<br>
                <abbr title="Phone">P:</abbr> {{ \Shippingaddress::getMobile(\Auth::user()->id); }}
            </address>
            @else
            <input type="hidden" value="0" name="shipping_option" />
            <address>
                <strong>{{ \User::getFullName(\Auth::user()->id); }}</strong><br>
                {{ \User::getAddress(\Auth::user()->id); }}<br>
                <abbr title="Phone">P:</abbr> {{ \Auth::user()->mobile; }}
            </address>
            @endif
            <a href="{{ \URL::to('user/shopping/shipping/edit'); }}" class="btn btn-default btn-lg" role="button">{{\Lang::get('theme_preciso.change_address_shipping')}}</a>
        </div>
    </div>
    <div class="span6">
        <div class="bs-callout bs-callout-warning">
            <h4>ประเภทการจัดส่ง</h4>
            <div class="form-group">
                {{Form::label('name', \Lang::get('theme_preciso.shipper'), array('class' => 'col-lg-2 control-label'));}}
                <div class="col-lg-6">
                    {{\Form::select('shipper_id', array('' => \Lang::get('common.please_select')) +\DB::table('shipper')->lists('title','id'), 4, array('class' => 'form-control', 'id' => 'shipper_id'))}}
                </div>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="shipping_option_id" id="shipping_option_id" value="1" checked="checked">
                    ส่งแบบธรรมดา 4-5 วัน
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="shipping_option_id" id="shipping_option_id" value="2">
                    ส่งพิเศษ 1-2 วัน
                </label>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="span12">
        <div class="bs-callout bs-callout-danger">
            <h4>วิธีชำระเงิน ?</h4>
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#pay1" data-toggle="tab">โอนเงินผ่านธนาคาร/ATM</a></li>
                <li><a href="#pay2" data-toggle="tab">บัตรเครดิตหรือเดบิต</a></li>
                <li><a href="#pay3" data-toggle="tab">เก็บเงินปลายทางทั่วประเทศ</a></li>
                <li><a href="#pay4" data-toggle="tab">เคาน์เตอร์เซอร์วิส</a></li>
                <li><a href="#pay5" data-toggle="tab">Paypal</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="pay1">
                    <h4>คุณสามารถชำระเงินสดให้กับพนักงานจัดส่งสินค้าของเราเมื่อคุณได้รับสินค้าที่บ้าน</h4>
                    <div class="radio">
                        <label>
                            <input type="radio" name="payment_option" value="1" checked="checked" />
                            ใช้โอนเงินผ่านธนาคาร/ATM
                        </label>
                    </div>
                    <p><img src="http://lotus.hostingdynamo.com/imgs/scb.gif" />  ธนาคารไทยพาณิชย์ สาขาเดอะมอลล์ งามวงศ์วาน ชื่อบัญชี บริษัท เจ.ไอ.บี คอมพิวเตอร์ กรุ๊ป จำกัด เลขที่บัญชี xx-xx-xxx</p>
                    <p><img src="http://lotus.hostingdynamo.com/imgs/kb.gif" />  ธนาคารกสิกรไทย สาขาเซียร์รังสิต ชื่อบัญชี บริษัท เจ.ไอ.บี คอมพิวเตอร์ กรุ๊ป จำกัด เลขที่บัญชี xx-xx-xxx</p>
                    <p><img src="http://lotus.hostingdynamo.com/imgs/bbl.gif" />  ธนาคารกรุงเทพ สาขาเซียร์รังสิต ชื่อบัญชี บริษัท เจ.ไอ.บี คอมพิวเตอร์ กรุ๊ป จำกัด เลขที่บัญชี xx-xx-xxx</p>
                </div>
                <div class="tab-pane" id="pay2">
                    <h4>ชำระเงินผ่านบัตรเครดิตหรือบัตรเดบิต :</h4>
                    <img src="http://www.web2disk.com/images/CreditCards.png" />                    
                    <div class="radio">
                        <label>
                            <input type="radio" name="payment_option" value="2">
                            ใช้บัตรเดบิตหรือเครดิต
                        </label>
                    </div>
                    <div class="form-group">
                        {{ Form::text('credit_name',null, array('id'=>'credit_name','class'=>'form-control','placeholder'=>'ชื่อบนบัตร')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::text('credit_number',null, array('id'=>'credit_number','class'=>'form-control','placeholder'=>'เลขบนบัตร')) }}
                    </div>
                    <div class="form-group">
                        {{Form::label('credit_exp','บัตรเครดิตใช้ได้จนถึง', array('class' => 'control-label'));}}
                        {{ Form::selectMonth('month'); }} {{Form::selectRange('years', 2014, 2024)}}
                    </div>
                    <div class="form-group">
                        {{ Form::text('credit_valid',null, array('id'=>'credit_valid','class'=>'form-control','placeholder'=>'ตรวจสอบบัตรเครดิต')) }}
                    </div>
                </div>
                <div class="tab-pane" id="pay3">
                    <h4>คุณสามารถชำระเงินสดให้กับพนักงานจัดส่งสินค้าของเราเมื่อคุณได้รับสินค้าที่บ้าน</h4>
                    <div class="radio">
                        <label>
                            <input type="radio" name="payment_option" value="3" />
                            ใช้เก็บเงินปลายทางทั่วประเทศ
                        </label>
                    </div>
                </div>
                <div class="tab-pane" id="pay4">
                    <h4>ชำระเงิน ณ เคาน์เตอร์ที่ใกล้บ้านคุณ</h4>
                    <img src="http://www.itunesgiftcard.in.th/wp-content/uploads/2012/02/counterservice-7-11.png" />
                    <p>กรุณาชำระเงินภายใน 3 วันที่เคาน์เตอร์เซอร์วิส หลังจากที่ท่านได้รับอีเมลยืนยันคำสั่งซื้อ คำสั่งซื้่อของท่านจะหมดอายุลงโดยอัตโนมัติหากท่านไม่ได้ชำระเงินภายในระยะเวลาที่กำหนด
                    </p>
                    <div class="radio">
                        <label>
                            <input type="radio" name="payment_option" value="4">
                            ชำระโดยเคาน์เตอร์เซอร์วิส
                        </label>
                    </div>
                </div>
                <div class="tab-pane" id="pay5">
                    <h4>ชำระเงินโดยใช้บัญชี PayPal ของคุณ ระบบก็จะนำคุณไปสู่การเสร็จสิ้นกระบวนการการชำระเงินอย่างสมบูรณ์</h4>
                    <img src="http://www.inmotionhosting.com/support/images/stories/icons/ecommerce/64_64_paypal.png" />
                    <div class="radio">
                        <label>
                            <input type="radio" name="payment_option" value="5">
                            ชำระโดย Paypal
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-checkout">              
        <input type="button" value="ยืนยันการสั่งซื้อ" class="btn btn-add-cart" id="btnConfirm" />
    </div> 
</div>
{{ Form::close() }}
@endif
@else
<div class="row">
    <div class="span5">
        <h2>ลูกค้าที่ลงทะเบียนแล้ว</h2>
        <p class="clear"></p>
        {{ \Form::open(array('class' => 'form-horizontal', 'id' => 'frmLogin', 'role' => 'form')); }}
        <div class="span5 auth">
            <div class="form-group">
                {{ Form::label('username_login', 'ชื่อผู้ใช้ / อีเมล์'); }}
                {{ \Form::text('username_login', Input::old('username_login'), array('id' => 'username_login', 'class' => 'form-control')); }}
            </div>
            <div class="form-group">
                {{ \Form::label('password_login', 'รหัสผ่าน'); }}
                {{ \Form::password('password_login', Input::old('password_login'), array('id' => 'password_login', 'class' => 'form-control')); }}
            </div>
            <div class="form-group">
                <p class="clearfix"></p>
                <input type="button" name="btnLogin" id="btnLogin" class="btn auth" value=" เข้าสู่ระบบ " />
            </div>  
        </div>
        {{ Form::close(); }}
        <p class="clearfix"></p>
        <div class="login-social-link">
            <a href="#" class="facebook">
                <i class="icon-facebook"></i>
                Facebook
            </a>
            <a href="#" class="twitter">
                <i class="icon-twitter"></i>
                Twitter
            </a>
        </div>
        </form>
    </diV>
    <div class="span5">
        <h2>ยังไม่ลงทะเบียน</h2>
        <p class="half-margin">ยินดีต้อนรับลูกค้าใหม่ สามารถสมัครสมาชิกได้ที่นี่</p>
        {{ \Form::open(array('class' => 'form-horizontal', 'id' => 'frmRegister', 'role' => 'form')); }}
        <div class="span5">
            <p class="clear"></p>
            <div class="form-group">
                {{ \Form::label('firstname', 'ชื่อ');}}
                {{ \Form::text('firstname', Input::old('firstname'), array('id' => 'firstname', 'class' => 'span4 form-control')); }}
            </div>
            <div class="form-group">
                {{ \Form::label('lastname', 'นามสกุล');}}
                {{ \Form::text('lastname', Input::old('lastname'), array('id' => 'lastname', 'class' => 'span4 form-control')); }}
            </div>
            <div class="form-group">
                {{ \Form::label('lastname', 'อีเมล์');}}
                {{ \Form::text('email', Input::old('email'), array('id' => 'email', 'class' => 'span3 form-control')); }}
            </div>
            <div class="form-group">
                {{ \Form::label('lastname', 'หมายเลขโทรศัพท์');}}
                {{ \Form::text('mobile', Input::old('mobile'), array('id' => 'mobile', 'class' => 'span2 form-control')); }}
            </div>
            <div class="form-group">
                {{ \Form::label('password', 'รหัสผ่าน');}}
                {{ \Form::password('password', Input::old('password'), array('id' => 'password', 'class' => 'span2 form-control')); }}
            </div>
            <div class="form-group">
                <p class="clearfix"></p>
                <input type="button" name="btnRegister" id="btnSave" class="btn" value=" ลงทะเบียน " />
            </div>   
        </div>   
        {{ \Form::close(); }}
    </diV>

    @endif
    @stop
    @section('small_banner')
    {{ $page['small_banner']; }}
    @stop
    @section('brands_list')
    {{ $page['brands_list']; }}
    @stop
    @section('show_product')
    {{ $page['show_product']; }}
    @stop
    @section('script_page_code')
    <script type="text/javascript">
        $(function() {
            $('#myTab a[href="#pay0"]').tab('show');
        });
        $('#btnSave').click(function() {
            var data = {
                url: 'register',
                v: $('#frmRegister input:not(#btnSave)').serializeArray(),
                form: 'frmRegister',
                redirect: ''
            };
            saveData(data);
        });

        $('#btnLogin').click(function() {
            var data = {
                url: 'login',
                v: $('#frmLogin input:not(#btnLogin)').serializeArray(),
                form: 'frmLogin',
                redirect: ''
            };
            checkLogin(data);
        });

        $('#btnConfirm').click(function() {
            var data = {
                title: 'Confirm',
                type: 'confirm',
                text: 'ยืนยันการสั่งซื้อ ?'
            };
            genModal(data);
            $('#myModal #button-confirm').attr('value', $(this).attr('rel'));
            $('body').on('click', '#myModal #button-confirm', function() {
                var data = {
                    title: 'Message',
                    text: '<div class="text-center"><p><img src="' + base_url + 'theme/frontend/preciso/img/ajax-loader.gif" /></p>กำลังบันทึกข้อมูล กรุณารอสักครู่...</div>',
                    type: 'alert'
                };
                genModal(data);
                $.ajax({
                    type: "post",
                    url: base_url + 'shopping/cart/confirm',
                    data: $('#form-shopping, select input:not(#btnConfirm)').serializeArray(),
                    cache: false,
                    dataType: 'json',
                    success: function(result) {
                        try {
                            if (result.error.status === true)
                            {
                                $('#myModal .modal-footer').hide();
                                $('#myModal .modal-body').empty();
                                $('#myModal .modal-body').html('<div class="text-center">' + result.error.message + '</div>');
                                setTimeout(function() {
                                    $('#myModal').modal('hide');
                                    $('#myModal').on('hidden.bs.modal', function(e) {
                                        window.open(base_url + 'shopping/history', '_self');
                                    });
                                }, 5000);
                            } else {
                                var data = {
                                    title: 'Message',
                                    text: '<div class="text-center">' + result.error.message + '</div>',
                                    type: 'info'
                                };
                                genModal(data);
                            }
                        } catch (e) {
                            alert('Exception while request..');
                        }
                    },
                    error: function(e) {
                        alert('Error while request..');
                    }
                });

            });
        });
    </script>
    @stop