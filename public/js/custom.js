/*start....only for the right_sidebar , it should be removed finally...*/
/*$(document).on('click','.on-click',function(){
    var val=$(this).children('.hidden').html();
    alert(val);
});*/
/*end...only for the right_sidebar , it should be removed finally...*/

/* ............for delete and confirm button start...................*/
$(document).on('submit', '.confirm-form', function() {
    return confirm('Are you sure ?');
});
$(document).on('submit', '.delete-form', function() {
    return confirm('Are you sure you want to delete?');
});
/* ............for delete and confirm button end...................*/

$('#custom-alert').on('closed.bs.alert', function() {
    $('#alert-container').remove();
})
// $("#alert-container").fadeTo(2000, 500).slideUp(5000, function(){
//     $("#alert-container").slideUp(5000);
// });
var $form = $('form');
$form.on('submit', function() {
    var $btn = $(document.activeElement);
    if (
        /* there is an activeElement at all */
        $btn.length &&
        /* it's a child of the form */ 
        $form.has($btn) &&
        /* it's really a submit element */
        $btn.is('button[type="submit"], input[type="submit"], input[type="image"]') &&
        /* it has a "name" attribute */
        $btn.is('[name]')
    ) {
        $btn.before('<input type="hidden" name="'+$btn.attr("name")+'" value="'+$btn.val()+'">'); 
    }
    $btn.prop('disabled',true);
});

function readURL(input) {   
    var preview_location = $(input).parent().parent().find('.preview-div');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview_location.html('<img class="img-responsive" width="70" src="' + e.target.result + '">');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

/* -- start User role permission check box true false control -- */
function permission_select_deselect_child(selector) {
    var check;
    if ($(selector).is(':checked') === false) {
        check = false;
    } else {
        check = true;
    }
    if ($(selector).parent().parent().hasClass('controller') === true) {
        var action_ul = $(selector).parent().parent().next('div.action-wraper');
        $.each(action_ul.children('.actions'), function(ind, val) {
            var cur_check_box = $(val).children().children('input');
            $(cur_check_box).prop('checked', check);
        });
    }
}

function permission_select_parent(selector) {
    var check = $('.' + selector).is(':checked');
    $('.parent_' + selector).prop('checked', check);
}
/* -- End User role permission check box true false control -- */

jQuery.fn.ForceNumericOnly = function() {
    return this.each(function() {
        $(this).keydown(function(e) {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
                key == 8 ||
                key == 9 ||
                key == 13 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
    });
};

$('body').on('focus', "input[type='number']", function() {
    var tis = $(this);    
    tis.ForceNumericOnly();
    tis.on('mousewheel', function(e) { $(this).blur(); });
    tis.on('change', function(e) { 
        if (tis.val() < 0) {
            tis.val('0');
        }
    });    
});

// function putMinToZerro() {
//     $("input[type='number']").attr('min', '0');
// }
var tooltipArr = [
    { "className": "fa-edit", "title": "Edit" },
    { "className": "fa-eye", "title": "View" },
    { "className": "fa-remove", "title": "Delete" },
    { "className": "fa-plus", "title": "Add" },
    { "className": "fa-list", "title": "View List" },
    {"className": "fa-check-square-o", "title": "Receive" },
    {"className": "fa-minus", "title": "Untag" },
    {"className": "fa-upload", "title": "File Upload" },
    {"className": "fa-check-square", "title": "Approve" },
    {"className": "fa-times-circle", "title": "Cancel" },
    {"className": "fa-download", "title": "Download" },
    {"className": "fa-paper-plane", "title": "Resend" },
    {"className": "fa-key", "title": "Change Password" },
    {"className": "fa-book", "title": "Deed Paper" },
    {"className": "fa-file", "title": "View Documents" },
    
];
$(document).ready(function() {
    //putMinToZerro();
    tooltipArr.forEach(function(item, index) {
        var tis = $('.' + item.className).parent();
        var titleExist = tis.attr("title");
        if(!titleExist){
        	tis.attr("title", item.title);
        }
        
        tis.tooltip();
    });
});

// $('body').on('DOMNodeInserted', 'select', function () {
//     $(this).select2();
// });

//custom make function for get all form value in json
 $.fn.serializeObject = function() {
    var obj = {};
    var arr = this.serializeArray();
    arr.forEach(function(item, index) {
        if (obj[item.name] === undefined) { // New
            obj[item.name] = item.value || '';
        } else {                            // Existing
            if (!obj[item.name].push) {
                obj[item.name] = [obj[item.name]];
            }
            obj[item.name].push(item.value || '');
        }
    });
    return obj;
};

//multiple word replace from a string/url
String.prototype.replaceAll=function (mapObj) {
     var re = new RegExp(Object.keys(mapObj).join("|"),"gi");
     return this.replace(re, function(matched){
        return mapObj[matched];
    });
}