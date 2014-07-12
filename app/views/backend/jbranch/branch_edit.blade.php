@extends('backend.layouts.master')

@section('content')
<form method="get" class="form-horizontal tasi-form">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    ข้อมูลร้าน
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Default</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Static control</label>
                        <div class="col-lg-10">
                            <p class="form-control-static">email@example.com</p>
                        </div>
                    </div>

                </div>
            </section>

            <section class="panel">
                <header class="panel-heading">
                    ข้อมูลส่วนตัว
                </header>
                <div class="panel-body">
                    <form method="get" class="form-horizontal tasi-form">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Default</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control">
                            </div>
                        </div>


                </div>
            </section>

        </div>
    </div>
</form>
@stop