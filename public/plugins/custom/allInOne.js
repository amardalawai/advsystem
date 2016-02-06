function follow(user_id) {
    $.post(base_url + "/follow", {user_id: user_id}, function (result) { console.log(result);
        $('#followBtn').html('<i class="fa fa fa-spinner fa-spin"></i>');
        if (result['following'] == 1) {
            $('#followBtn').html('<b><i class="fa fa-hand-o-right"></i> Following</b>');
            $('#followBtn').addClass('btn-success');
            $('#followBtn').removeClass('btn-primary');
        }
        else {
            $('#followBtn').html('<b><i class="fa fa-hand-o-up"></i> Follow</b>');
            $('#followBtn').addClass('btn-primary');
            $('#followBtn').removeClass('btn-success');
        }
        $('#following_count').html(result['following_count']);
    });
}


if (document.getElementById('searchFor')) {
    var autoFill = '';
    $.post(base_url + "/fetch_recipes", function (jsonString) {
      //  var jsonString = '[{"label":"System Administrator","value":"1"},{"label":"Software Tester","value":"3"},{"label":" Software Developer","value":"4"},{"label":"Senior Developer","value":"5"},{"label":"Cloud Developer","value":"6"},{"label":"Wordpress Designer","value":"7"}]';
 
        var jsonObj = $.parseJSON(jsonString);
        var sourceArr = [];

        for (var i = 0; i < jsonObj.length; i++) {
           sourceArr.push(jsonObj[i].label);
        }

        $("#searchFor").typeahead({
           source: sourceArr
        });
    });


}

if (document.getElementById('keyword')) {
    var autoFill = '';
    $.post(base_url + "/fetch_recipes", function (jsonString) {
      //  var jsonString = '[{"label":"System Administrator","value":"1"},{"label":"Software Tester","value":"3"},{"label":" Software Developer","value":"4"},{"label":"Senior Developer","value":"5"},{"label":"Cloud Developer","value":"6"},{"label":"Wordpress Designer","value":"7"}]';
 
        var jsonObj = $.parseJSON(jsonString);
        var sourceArr = [];

        for (var i = 0; i < jsonObj.length; i++) {
           sourceArr.push(jsonObj[i].label);
        }

        $("#keyword").typeahead({
           source: sourceArr
        });
    });


}



function show_success(msg) {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr.success(msg);
}

function show_error(msg) {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr.error(msg);
}

function show_warning(msg) {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr.warning(msg);
}

function show_info(msg) {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr.info(msg);
}

