<h3>บัญชีของฉัน</h3>
<ul class="nav nav-stacked">
    <li class="{{(\Request::segment(2)=='dashboard' ? 'active' : '')}}"><a href="{{ \URL::to('user/dashboard'); }}">ส่วนควบคุมบัญชี</a></li>  
    <li class="{{(\Request::segment(2)=='profile' ? 'active' : '')}}"><a href="{{ \URL::to('user/profile/edit'); }}">ข้อมูลบัญชี</a></li>  
    <li class="{{(\Request::segment(3)=='tax' ? 'active' : '')}}"><a href="{{ \URL::to('user/shopping/tax/edit'); }}">รายละเอียดใบกำกับภาษี</a></li>
    <li class="{{(\Request::segment(3)=='shipping' ? 'active' : '')}}"><a href="{{ \URL::to('user/shopping/shipping/edit'); }}">ที่อยู่จัดส่งสินค้า</a></li>
    <li class="{{(\Request::segment(2)=='history' ? 'active' : '')}}"><a href="{{ \URL::to('shopping/history'); }}">ประวัติการสั่งซื้อ</a></li>
    <li><a href="javascript:;">รายการสินค้าที่ชอบ</a></li>
</ul>