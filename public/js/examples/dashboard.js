
$(function () {

    "use strict";

    //TOASTR NOTIFICATION
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    toastr.options = {
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "timeOut": 3500,
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "slideDown",
    "hideMethod": "fadeOut"
    };
    toastr.info('Enjoy it!', '<h5 style="margin-top: 0px; margin-bottom: 5px;"><b>Welcome to your dashboard!</b></h5>');
});