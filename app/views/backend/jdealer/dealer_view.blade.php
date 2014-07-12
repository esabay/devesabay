@extends('backend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
            @foreach ($page['breadcrumbs'] as $key => $val)
            @if ($val === reset($page['breadcrumbs']))
            <li><a href="{{URL::to($val)}}"><i class="icon-home"></i> {{$key}}</a></li>
            @elseif ($val === end($page['breadcrumbs']))
            <li class="active">{{$key}}</li>
            @else
            <li><a href="{{URL::to($val)}}"> {{$key}}</a></li>
            @endif
            @endforeach
        </ul>
        <!--breadcrumbs end -->
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <!--                
                -->
                <div class="form-actions">
                    <div class="pull-left">
                        <a href="{{URL::to('/backend/jdealer/dealer')}}" class="btn btn-mini btn-info"><i class="icon-arrow-left"></i>  {{\Lang::get('common.back')}}</a>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-success" id="btnSave"><i class="icon-save"></i>  {{\Lang::get('common.save')}}</button>                        
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
{{ Form::open(array('class'=>'form-horizontal','id'=>'form-edit','role'=>'form')) }}
<div class="row">
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                ข้อมูลร้าน
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">ประเภทธรุกิจ</label>
                    <div class="col-sm-3">
                        <p class="form-control-static">{{\User::getBizType($page['item']->biz_type)}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 col-sm-2 control-label">ชื่อร้าน/บริษัท</label>
                    <div class="col-lg-10">
                        <p class="form-control-static">{{$page['item']->company_name}}</p>
                    </div>
                </div>

            </div>
        </section>

        <section class="panel">
            <header class="panel-heading">
                ข้อมูลส่วนตัว
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">ชื่อ-นามสกุล</label>
                    <div class="col-sm-3">
                        <p class="form-control-static">{{$page['item']->firstname}} {{$page['item']->lastname}}</p>
                    </div>
                </div> 
                <div class="form-group">
                    <label class=" col-sm-4 control-label">หมายเลขประจำตัวประชาชน</label>
                    <div class="col-sm-3">
                        <p class="form-control-static">{{$page['item']->id_card}}</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="panel">
            <header class="panel-heading">
                ข้อมูลเข้าใช้ระบบ
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">ชื่อผู้ใช้</label>
                    <div class="col-sm-3">
                        <p class="form-control-static"> {{$page['item']->email}}</p>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dealer</label>
                    <div class="col-sm-3">
                        <div class="radio">
                            <label>
                                {{Form::checkbox('dealer', 0,($page['item']->dealer == 0 ? true : false))}} เปิดใช้งาน
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">เปิดใช้งาน</label>
                    <div class="col-sm-3">
                        <div class="radio">
                            <label>
                                {{Form::checkbox('disabled', 0,($page['item']->disabled == 0 ? true : false))}} เปิดใช้งาน
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="panel">
            <header class="panel-heading">
                ที่อยู่ในการจัดส่ง
            </header>
            <div class="panel-body">
                @if($page['item']->addresscopy==1)
                <address>
                    <strong>{{ \Shippingaddress::getFullName($page['item']->id); }}</strong><br>
                    {{ \Shippingaddress::getAddress($page['item']->id); }}<br>
                    <abbr title="Phone">P:</abbr> {{ \Shippingaddress::getMobile($page['item']->id); }}
                </address>
                @else
                <address>
                    <strong>{{ \User::getFullName($page['item']->id); }}</strong><br>
                    {{ \User::getAddress($page['item']->id); }}<br>
                    <abbr title="Phone">P:</abbr> {{ $page['item']->mobile; }}
                </address>
                @endif                    
            </div>
        </section>
    </div>
    <div class="col-lg-6">         
        <section class="panel">
            <header class="panel-heading">
                ที่อยู่ในการออกใบกำกับภาษี
            </header>
            <div class="panel-body">
                <address>
                    {{ \Shoppingtax::getTaxInformation($page['item']->id); }}<br>
                </address>         
            </div>
        </section>
        <section class="panel">
            <header class="panel-heading">
                ไฟล์เอกสารประกอบการสมัคร
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-sm-12">
                        {{\Common::genForm(array('type'=>'file','name'=>'file1','value'=>$page['file'][0]->file1,'help'=>'สำเนาบัตรประชาชาชนของกรรมการผู้มีอำนาจลงนามผูกพันบริษัทหรือเจ้าของกิจการ'))}}
                    </div>
                </div> 
                <div class="form-group">
                    <div class="col-sm-12">
                        {{\Common::genForm(array('type'=>'file','name'=>'file2','value'=>$page['file'][0]->file2,'help'=>'สำเนาทะเบียนบ้านของกรรมการผู้มีอำนาจลงนามผูกพันบริษัทหรือเจ้าของกิจการ'))}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        {{\Common::genForm(array('type'=>'file','name'=>'file3','value'=>$page['file'][0]->file3,'help'=>'ทะเบียนการค้า'))}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        {{\Common::genForm(array('type'=>'file','name'=>'file4','value'=>$page['file'][0]->file4,'help'=>'หนังสือรับรองบริษัทพร้อมวัตถุประสงค์ทุกข้อ หากเป็นร้านค้าสามารถใช้ทะเบียนการค้าแทนได้'))}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        {{\Common::genForm(array('type'=>'file','name'=>'file5','value'=>$page['file'][0]->file5,'help'=>'สำเนาเอกสาร ภพ. 20'))}}                </div>
                </div>
            </div>
        </section>
    </div>
</div>
{{ Form::close() }}
@stop
@section('script_page_code')
<script type="text/javascript">
    $('#btnSave').click(function() {
        var data = {
            url: 'backend/jdealer/dealer/view/{{\Request::segment(5)}}',
            v: $('#form-edit').serializeArray(),
            redirect: 'backend/jdealer/dealer'
        };
        saveData(data);
    });
</script>
@stop