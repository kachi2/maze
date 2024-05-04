/* ============== START: Helper Functions ======================= */
"use strict";

var error_msg = 'Oops! Couldn\'t connect to the server. Refresh page and try again';

// function my_notify (msg, type){
//     $.notify({
//         message: msg
//     }, {
//         type: type
//     });
// }

function bootstrap_alert($msg, $type){
    if($type === undefined) $type = 'danger';

    return '<div class="alert alert-'+ $type+ ' alert-rounded">'+ $msg+ '<button type="button" class="close"' +
    ' data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>';
}





function ajax_error(message) {
    if (!message) message = error_msg;
    var a = '<p style="color: #b60f0f"> failed </p>';
    return a;
}


function ajax_loader (){
    var a = 'loading';
    return a;
}





function submit_form(form_id, silent){
    if(silent === undefined) silent = false;

    var form = $(form_id);
    var form_data = form.serializeArray();
    var processor = $('.processor'); // <span></span> to hold loader image

    processor.html(ajax_loader());

    var url = form.attr('action'); 

    return $.post(url, form_data, function (result) {
        if(!silent) ajax_error(result)
       // console.log(result);
    });
}
