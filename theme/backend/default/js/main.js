/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var base_url = "http://" + document.location.hostname + "/";
function getData(p)
{
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
        $('form .form-group').removeClass('has-error');
        $('form .help-block').remove();
        if (typeof p.error.message === 'string')
        {

            if (p.error.status !== true)
            {
                $('form .form-group button').before('<p class="help-block">' + p.error.message + '</p>');
            }
        } else {

            $.each(p.error.message, function(key, value) {
                $('#' + key).parent().parent().addClass('has-error');
                $('#' + key).after('<p class="help-block">' + value + '</p>');
            });
            $('#imgload').remove();
        }
        return false;
    } else {

        $('form .form-group').removeClass('has-error');
        $('form .help-block').remove();
        return true;
    }
}
$('#getLogout').click(function() {
    var data = {
        title: 'Logout',
        type: 'confirm',
        text: 'คุณต้องการออกจากระบบใช่หรือไม่ ?'
    };
    genModal(data);
    $("#myModal #button-confirm").removeAttr('class');
    $('#myModal #button-confirm').addClass('btn btn-warning logout');
});
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

function saveData(p)
{
    var fm = (typeof p.form !== 'undefined' ? p.form : "");
    console.log(fm);
    var rs = getData(p);
    var obj = $.parseJSON(rs);
    if (genValidForm(obj) === true || obj.error.status === true) {
        if ($("#myModal").is(":visible")) {
            $('form ' + fm + ' #btnDialogSave').after('&nbsp;&nbsp;<img id="imgload" src="' + base_url + 'theme/backend/default/img/ajax-loader.gif" />');
            setTimeout(function() {
                $('#myModal').modal('hide');
                $('#myModal').on('hidden.bs.modal', function() {
                    window.location.href = base_url + p.redirect;
                });
            }, 3000);
        } else {
            var data = {
                title: 'Message',
                text: '<div class="text-center">' + obj.error.message + '</div>',
                type: 'alert'
            };
            genModal(data);
            setTimeout(function() {
                $('#myModal').modal('hide');
                $('#myModal').on('hidden.bs.modal', function() {
                    window.location.href = base_url + p.redirect;
                });
            }, 3000);
        }

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

function deleteData(p)
{
    if (p.type === 'general')
    {
        var data = {
            title: p.title,
            type: 'confirm',
            text: 'คุณต้องการลบรายการนี้ใช่หรือไม่ ?'
        };
        genModal(data);

        $('body').on('click', '#myModal #button-confirm', function() {
            var data3 = {
                url: p.url,
                redirect: p.redirect
            };
            var rs = getDataUrl(data3);
            var obj = $.parseJSON(rs);
            if (obj.error.status === true)
            {
                $('#myModal .modal-footer').hide();
                $('#myModal .modal-body').empty();
                $('#myModal .modal-body').html('<div class="text-center"><p><img src="' + base_url + 'theme/backend/default/img/ajax-loader.gif" /></p>' + obj.error.message + '</div>');
                setTimeout(function() {
                    $('#myModal').modal('hide');
                    $('#myModal').on('hidden.bs.modal', function(e) {
                        window.location.href = base_url + p.redirect;
                    });
                }, 3000);
            } else {

                $('#myModal .modal-footer').show();
                $('#myModal .modal-footer #button-close, #button-confirm').hide();
                $('#myModal .modal-footer #button-ok').show();
                $('#myModal .modal-body').empty();
                $('#myModal .modal-body').html('<div class="text-center">' + obj.error.message + '</div>');
            }
        });
    } else {
        if ($(".checkboxes:checked").val())
        {
            var data = {
                title: p.title,
                type: 'confirm',
                text: 'คุณต้องการลบรายการนี้ใช่หรือไม่ ?'
            };
            genModal(data);

            $('body').on('click', '#myModal #button-confirm', function() {
                var data2 = {
                    url: p.url,
                    v: {id: $(".checkboxes:checked").val()},
                    redirect: p.redirect
                };
                var rs = getDataUrl(data2);
                var obj = $.parseJSON(rs);
                if (obj.error.status === true)
                {
                    $('#myModal .modal-footer').hide();
                    $('#myModal .modal-body').empty();
                    $('#myModal .modal-body').html('<div class="text-center"><p><img src="' + base_url + 'theme/backend/default/img/ajax-loader.gif" /></p>' + obj.error.message + '</div>');
                    setTimeout(function() {
                        $('#myModal').modal('hide');
                        $('#myModal').on('hidden.bs.modal', function(e) {
                            window.location.href = base_url + p.redirect;
                        });
                    }, 3000);
                } else {

                    $('#myModal .modal-footer').show();
                    $('#myModal .modal-footer #button-close, #button-confirm').hide();
                    $('#myModal .modal-footer #button-ok').show();
                    $('#myModal .modal-body').empty();
                    $('#myModal .modal-body').html('<div class="text-center">' + obj.error.message + '</div>');
                }
            });
        }
    }


}

$('body').on('click', '#myModal .logout', function() {
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
            window.location.href = base_url + 'cp';
        }, 3000);
    }
});

function widget(p)
{
    $.ajax({
        url: base_url + 'widget/' + p.wd,
        dataType: 'html',
        success: function(data) {
            $(p.selector).empty().html(data); // Load data into a <div> as HTML
        }
    });
}

function getPageUrl(p) {
    window.location.href = p;
}

var pusher = new Pusher('a68b1e7722913c756912');
var channel = pusher.subscribe('test_channel');
channel.bind('my_event', function(data) {
    $.gritter.add({
        title: 'Message',
        text: data.message,
        sticky: true,
        time: '',
        class_name: 'my-sticky-class'
    });
    $.titleAlert('New Message');
    widget({wd: 'notification_dd', selector: '#header_notification_bar'});
});