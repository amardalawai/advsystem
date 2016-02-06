$(document).ready(function () {
    $('#FrmuserEdit').validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            gender: "required",
            contact:  {
                number: true
            }
        },
        messages: {
            name: "Please enter user name",
            email: "Please enter valid email address",
            gender: "Please choose gender",
            contact: "Please enter valid contact number"
        },
        submitHandler: function (form) {
            form.submit();
            return false;
        }
    });
});

var loadFile = function (event) {
    var image_url = URL.createObjectURL(event.target.files[0]);
    var strImage = image_url;
    if (strImage != '') {
        $.post(base_url + "/imageCrop", {strImage: strImage, strSquare: '1'}, function (result) {
            $('#commonTitle').html('Crop area of image');
            $('#commonBody').html(result);
        });
        $('#commonBox').modal('show');
    }
};