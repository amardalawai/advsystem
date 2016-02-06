$(document).ready(function () {

    $('#frmAddRecipe').validate({
        rules: {
            name: "required",
            category: "required",
            is_vegetarian: "required",
            servings: "required",
            hour: "required",
            minite: "required",
            description: "required",
            ingredient_name: "required",
            unit: "required",
            quantity: "required",
            instruction: "required",
            recipe_image: "required",
            cooking_method: "required",
            cuisine: "required",
            prepare_time: "required"
        },
        messages: {
            name: "Please enter recipe name",
            category: "Please enter recipe category",
            is_vegetarian: "Please enter recipe type",
            servings: "Please enter recipe servings",
            hour: "Please enter hours required",
            minite: "Please enter minites required",
            description: "Please enter recipe description",
            ingredient_name: "Please enter ingredient name",
            unit: "Please enter unit",
            quantity: "Please enter quantity",
            instruction: "Please enter instruction",
            recipe_image: "Please choose recipe image",
            cooking_method: "Please choose cooking method",
            cuisine: "Please choose cuisine type",
            prepare_time: "Please enter preparation time"
        },
        submitHandler: function (form) {
            form.submit();
            return false;
        }
    });

    var uniqueId = 1;
    $(function () {
        $('#add_more_ingredients').click(function () {

            var ele_count = 0;
            $('#ingredient_list #ingredient_row').find('input, select').each(function () {
                var val = $(this).val();
                if (val != "" || val.length > 0) {
                    ele_count++;
                }
            });

            if (ele_count < 3) {
                alert("Please add first ingredent to add more");
            }
            else {

                var copy = $("#ingredient_row").clone(true).appendTo("#ingredient_list");
                var cosponsorDivId = 'ingredient_row_' + uniqueId;
                copy.attr('id', cosponsorDivId);

                var deleteLink = $("<a href='javascript:void(0)'><i class='fa fa-times text-danger'></i></a>");
                deleteLink.appendTo(copy);
                deleteLink.click(function () {
                    copy.remove();
                });



                $('#ingredient_list #ingredient_row_' + uniqueId).find('input, select').each(function () {
                    $(this).attr('id', $(this).attr('id') + '_' + uniqueId);
                    $(this).attr('name', $(this).attr('name') + '_' + uniqueId);
                    $(this).val("");

                    var str = $(this).data("role");
                    var res = str.replace("_", " ");
                    $(this).rules('add', {
                        required: true,
                        messages: {
                            required: "Please enter " + res
                        }
                    });
                });

                uniqueId++;
                $('#ingredient_count').val(uniqueId);
            }


        });
    });

});

var uniqueInstructionId = 1;
$(function () {
    $('#add_more_instructions').click(function () {

        var instruction = $("#instruction").val().trim();

        if (instruction.length == 0) {
            alert("Please enter first instruction to add more.");
        }
        else {
            var copy = $("#instruction_row").clone(true).appendTo("#instruction_list");
            var cosponsorDivId = 'instruction_row_' + uniqueInstructionId;
            copy.attr('id', cosponsorDivId);

            var deleteLink = $("<a href='javascript:void(0)'><i class='fa fa-times text-danger'></i></a>");
            deleteLink.appendTo(copy);
            deleteLink.click(function () {
                copy.remove();
            });



            $('#instruction_list #instruction_row_' + uniqueInstructionId).find('textarea').each(function () {
                $(this).attr('id', $(this).attr('id') + '_' + uniqueInstructionId);
                $(this).attr('name', $(this).attr('name') + '_' + uniqueInstructionId);
                $(this).val("");
                $(this).rules('add', {
                    required: true,
                    messages: {
                        required: "Please enter instruction"
                    }
                });
            });

            uniqueInstructionId++;
            $('#instruction_count').val(uniqueInstructionId);
        }
    });
});

$(document).ready(function () {
    $('#tags').tagsinput({
        typeahead: {
            source: ['Amsterdam', 'Washington', 'Sydney', 'Beijing', 'Cairo']
        },
        freeInput: true
    });
});

var loadFile = function (event) {
    var image_url = URL.createObjectURL(event.target.files[0]);
    var strImage = image_url;
    if (strImage != '') {
        $.post(base_url + "/imageCrop", {strImage: strImage}, function (result) {
            $('#commonTitle').html('Crop area of image');
            $('#commonBody').html(result);
        });
        $('#commonBox').modal('show');
    }
};
