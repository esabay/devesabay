@extends('frontend.layouts.theme.preciso.master')
@section('content')
<div class="row">
    <div class="span12"> 

        <!-- Breadcrumb -->
        <ul class="breadcrumb">
            <li><a href="#">Home</a> <span class="divider">/</span></li>
            <li class="active">Cart</li>
        </ul>
        <p class="small-desc"></p>

        @if(\Cart::totalItems() <= 0)
        <!-- Alert -->
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Warning</strong> empty cart</div>
        @else
        <!-- Cart -->
        <form action="#" method="post" name="frmCart" id="frmCart">
            <table class="table table-hover">
                <thead>
                    <tr>

                        <th></th>
                        <th class="p-name">ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคาต่อหน่วย</th>
                        <th>ราคารวม</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (\Cart::contents() as $item)
                    <tr>
                        <td class="thumb-cart">
                            <a href="javascript:;" rel="{{ \URL::to('/product/view/' . $item->id); }}" class="getRel">
                                <img src="{{ \URL::to(\Products::getImgCover($item->id)); }}" alt="{{ $item->name; }}" />
                            </a>
                        </td>
                        <td class="p-name">
                            <h5>
                                <a href="javascript:;" rel="{{ \URL::to('/product/view/' . $item->id); }}" class="getRel">
                                    {{ $item->name; }}
                                </a>
                            </h5>
                        </td>
                        <td><input type="text" name="qty[]" value="{{ $item->quantity; }}" class="input-quantity" /></td>
                        <td>{{ number_format($item->price); }}</td>
                        <td><strong>{{ number_format($item->total()); }}</strong></td>
                        <td>
                            <a href="javascript:;" rel="{{ $item->id; }}" class="btn btn-default btn-xs btnDeleteCart"><i class="icon-trash "></i></a><input type="hidden" name="prod_id[]" value="{{ $item->id; }}" />
                        </td>
                    </tr>  

                    @endforeach
                </tbody>
            </table>
        </form>
        <!-- Cart Total -->
        <div class="main-cart-total">
            <p class="total">Total <span> {{ number_format(\Cart::total()); }}</span> 
        </div>        
        <div class="main-checkout">
            <a href="{{ \URL::to('shopping/checkout'); }}" class="btn btn-checkout">Checkout</a>
            <a href="{{ \URL::to('product'); }}" class="btn">Shopping</a>                  
            <input type="button" value="Update Cart" class="btn btn-add-cart btnUpdateCart" />
        </div> 
        @endif
    </div>
</div>
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
    $('.btnDeleteCart').click(function() {
        var data = {
            title: 'Delete',
            type: 'confirm',
            text: 'คุณต้องการลบรายการนี้ใช่หรือไม่ ?'
        };
        genModal(data);
        $('#myModal #button-confirm').attr('value', $(this).attr('rel'));
        $('body').on('click', '#myModal #button-confirm', function() {
            $.ajax({
                type: "post",
                url: base_url + 'shopping/cart/delete',
                data: {id: $(this).val()},
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
                                    window.location.href = $(location).attr('href');
                                });
                            }, 2000);
                        } else {
                            $.fancybox(result.error.message);
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

    $('.btnUpdateCart').click(function() {
        $.ajax({
            type: "post",
            url: base_url + 'shopping/cart/update',
            data: $('#frmCart').serializeArray(),
            cache: false,
            dataType: 'json',
            success: function(result) {
                try {
                    if (result.error.status === true)
                    {
                        var data = {
                            title: 'Update Cart',
                            type: 'alert',
                            text: '<div class="text-center">' + result.error.message + '</div>'
                        };
                        genModal(data);
                        setTimeout(function() {
                            $('#myModal').modal('hide');
                            $('#myModal').on('hidden.bs.modal', function(e) {
                                window.location.href = $(location).attr('href');
                            });
                        }, 2000);
                    } else {
                        $.fancybox(result.error.message);
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
</script>
@stop