function doValidation(id, actionUrl, formName) {

    function showErrors(resp) {
        $("#" + id).parent().parent().find('.errors').html(' ');
        $("#" + id).parent().parent().find('.errors').html(getErrorHtml(resp[id]));
    }

    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: $("#" + formName).serialize(),
        dataType: 'json',
        success: showErrors
    });
}

function getErrorHtml(formErrors) {
    if ((typeof (formErrors) === 'undefined') || (formErrors.length < 1))
        return;

    var out = '<ul>';
    for (errorKey in formErrors) {
        out += '<li>' + formErrors[errorKey] + '</li>';
    }
    out += '</ul>';
    return out;
}


function striper() {
    $('table tr:nth-child(even)').addClass('striped');
}


function datepicker() {
    $("#fine").datepicker({dateFormat: 'yy-mm-dd'});
    $("input#inizio").datepicker({
        minDate: 0,
        dateFormat: 'yy-mm-dd',
        onSelect: function (dateText) {
            $("input#fine").datepicker('option', 'minDate', dateText);
        }
    });
}

function toggleFAQ() {
    $('div#desc').slideToggle();

    $('div#elemento').on('click', function () {

        if ($(this).find('div#desc').is(':hidden')) {
            $('div#desc').hide('slow');
            $(this).find('div#desc').slideToggle();
        } else {
            $(this).parent().find('div#desc').hide('slow');
        }
    });
}

function togglePromo() {

    $('div#elemento').slideToggle();

    $('div.divisoreOrd').on('click', function () {
        if ($(this).parent().find('div#elemento').is(':hidden')) {
            $('div#elemento').hide('slow');
            $(this).parent().find('div#elemento').slideToggle();
        } else {
            $(this).parent().find('div#elemento').hide('slow');
        }

    });
}

function stampaCoupon(){
     $('div#doppio').hide();
        $('div.btn_flayer').hide();
        
        window.print();    
        
        $('div.btn_flayer').show();
        $('div#doppio').show();
}