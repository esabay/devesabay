// JavaScript Document
var base_url = location.protocol + "//" + location.host + '/';
$(document).ready(function() {
    headerCart();

    /* --- Active Switch --- */
    $('body').on('click', '.tabbable .nav-tabs a', function(e) {
        $(".tabbable .nav-tabs a, .products-filter a").removeClass("active");
        $(this).addClass("active");
        e.preventDefault();
    });

    /* --- Fancybox --- */
    $(".view-fancybox").fancybox({
        openEffect: 'elastic',
        closeEffect: 'elastic',
        next: 'left',
        prev: 'right'
    });

    /* --- Scrollbar --- */
    var nice = $("html").niceScroll();

    /* --- toTop --- */
    $(window).scroll(function() {
        if ($(this).scrollTop() !== 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });
    $('#toTop').click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 1000);
    });

    $('body').on('click', '.btnAddCart', function() {
        $.ajax({
            type: "post",
            url: base_url + 'shopping/cart/add',
            data: {id: $(this).attr('id'), qty: $('#prod_qty').val()},
            cache: false,
            dataType: 'json',
            success: function(result) {
                try {
                    if (result.error.status === true)
                    {
                        var data = {
                            title: 'Add to Cart',
                            type: 'alert',
                            text: '<div class="text-center">' + result.error.message + '</div>'
                        };
                        genModal(data);
                        setTimeout(function() {
                            $('#myModal').modal('hide');
                            $('#myModal').on('hidden.bs.modal', function(e) {
                                headerCart();
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

    $('#getLogout').click(function() {
        var data = {
            title: 'Logout',
            type: 'confirm',
            text: 'คุณต้องการออกจากระบบใช่หรือไม่ ?'
        };
        genModal(data);
        $('#myModal #button-confirm').addClass('weblogout');
    });

    $('body').on('click', '#myModal .weblogout', function() {
        var data = {
            url: 'logout'
        };
        var rs = getDataUrl(data);
        var obj = $.parseJSON(rs);
        if (obj.error.status === true)
        {
            $('#myModal .modal-footer').hide();
            $('#myModal .modal-body').empty();
            $('#myModal .modal-body').html('<div class="text-center">' + obj.error.message + '</div>');
            setTimeout(function() {
                window.location.href = base_url;
            }, 3000);
        }
    });

    $('body').on('click', '.getRel', function() {
        $('#featured_product').empty();
        $('#show_product').empty();
        $('.nav li').removeClass('active');
        $(this).parent().addClass('active');
        $('#webcontent').load($(this).attr("rel"), function() {
            $(this).unwrap().hide().fadeIn();
        });
    });

    $('body').on('click', 'a.add-list, a.add-list-detail', function() {
        if (getAuth() == 0) {
            $.ajax({
                type: "post",
                url: base_url + 'shopping/wishlist',
                data: {id: $(this).attr('id')},
                cache: false,
                dataType: 'json',
                success: function(result) {
                    try {
                        if (result.error.status === true)
                        {
                            var data = {
                                title: 'Add to Wish List',
                                type: 'alert',
                                text: '<div class="text-center">' + result.error.message + '</div>'
                            };
                            genModal(data);
                            setTimeout(function() {
                                $('#myModal').modal('hide');
                            }, 3000);
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
        } else {
            var data = {
                title: 'Message',
                type: 'info',
                text: '<div class="text-center">คุณต้องเป็นสมาชิกจึงจะสามารถเพิ่มสินค้าที่ชอบได้ !</div>'
            };
            genModal(data);
        }
    });
});

function getAuth()
{
    var jqXHR = $.ajax({
        type: "get",
        url: base_url + 'checkAuth',
        cache: false,
        async: false
    });
    return jqXHR.responseText;
}
;

function getData(p)
{
    $('form #btnDialogSave').after('&nbsp;&nbsp;<img id="imgload" src="' + base_url + 'theme/frontend/preciso/img/ajax-loader.gif" />');
    var jqXHR = $.ajax({
        type: "post",
        url: base_url + p.url,
        data: p.v,
        cache: false,
        async: false
    });
    return jqXHR.responseText;
}
;
function getDataUrl(p)
{
    var jqXHR = $.ajax({
        type: "get",
        url: base_url + p.url,
        data: p.v,
        cache: false,
        async: false
    });
    return jqXHR.responseText;
}
;
function genValidForm(p)
{
    if (p !== null)
    {
        $('#' + p.error.form + ' .form-group').removeClass('has-error');
        $('#' + p.error.form + ' .help-block').remove();

        if (typeof p.error.message === 'string')
        {
            $('form .auth').removeClass('has-error');
            $('form .help-block').remove();
            if (p.error.status !== true)
            {
                $('form .auth').addClass('has-error');
                $('.form-group .auth').before('<p class="help-block">' + p.error.message + '</p>');
            }
        } else {
            $.each(p.error.message, function(key, value) {
                if (key != 'recaptcha_response_field') {
                    $('#' + key).parent().addClass('has-error');
                    $('#' + key).after('<p class="help-block">' + value + '</p>');
                } else {
                    $('#' + key).before('<p class="help-block">' + value + '</p>');
                }
            });
            $('#imgload').remove();
        }
        return false;
    } else {

        $('#' + p.error.form + ' .form-group').removeClass('has-error');
        $('#' + p.error.form + ' .help-block').remove();
        return true;
    }
}

function saveData(p)
{
    var rs = getData(p);
    var obj = $.parseJSON(rs);
    if (genValidForm(obj) === true || obj.error.status === true) {
        var delay = (obj.error.delay ? obj.error.delay : 3000);
        $('#imgload').remove();
        setTimeout(function() {
            $('#myModal').modal('hide');
            $('#myModal').on('hidden.bs.modal', function() {
                window.location.href = base_url + p.redirect;
            });
        }, delay);
    }
}

function genModal(p)
{
    if (p.type === 'confirm')
    {
        $('#myModal .modal-footer').show();
        $('#myModal .modal-title, #myModal .modal-body').empty();
        $('#myModal .modal-footer #button-close, #button-confirm').show();
        $('#myModal .modal-footer #button-ok').hide();
        $('#myModal .modal-title').html(p.title);
        $('#myModal .modal-body').html('<div class="text-center">' + p.text + '</div>');
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: true
        });
    } else if (p.type === 'alert')
    {
        $('#myModal .modal-title, #myModal .modal-body').empty();
        $('#myModal .modal-footer').hide();
        $('#myModal .modal-title').html(p.title);
        $('#myModal .modal-body').html(p.text);
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: true
        });
    } else if (p.type === 'info')
    {
        $('#myModal .modal-title, #myModal .modal-body').empty();
        $('#myModal .modal-footer #button-close, #button-confirm').hide();
        $('#myModal .modal-footer #button-ok').show();
        $('#myModal .modal-title').html(p.title);
        $('#myModal .modal-body').html(p.text);
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: true
        });
    } else {
        $.ajax({
            type: "get",
            url: base_url + p.url,
            data: p.v,
            cache: false,
            dataType: 'html',
            success: function(result) {
                try {
                    $('#myModal .modal-title, #myModal .modal-body').empty();
                    $('#myModal .modal-footer').hide();
                    $('#myModal .modal-title').html(p.title);
                    $('#myModal .modal-body').html(result);
                    $('#myModal').modal({
                        backdrop: 'static',
                        keyboard: true,
                        width: '680px'
                    });
                } catch (e) {
                    alert('Exception while request..');
                }
            },
            error: function(e) {
                alert('Error while request..');
            }
        });
    }
}

function checkLogin(p)
{
    var rs = getData(p);
    var obj = $.parseJSON(rs);
    if (genValidForm(obj) === true || obj.error.status === true) {
        window.location.href = base_url + p.redirect;
    }
}

function loadContent(p)
{
    var div = (p.div ? p.div : '#webcontent');
    $.ajax({
        url: base_url + p.url,
        dataType: 'html',
        success: function(data) {
            $(div).html(data);
        }
    });
}

function headerCart()
{
    $.ajax({
        url: base_url + 'widget/headercart',
        dataType: 'html',
        success: function(data) {
            $('#header_cart').empty().html(data);
        }
    });
}

function getPageUrl(p) {
    window.location.href = p;
}