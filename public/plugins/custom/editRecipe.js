function addEditIngredients(intRecipeId, intIngredientId) {
    $('#commonTitle').html('Loading...');
    $('#commonBody').html('<div class="text-center">Please wait... <i class="fa fa-spinner fa-spin"></i><div>');
    $('#commonBox').modal('show');
    $.post(base_url + "/addIngredient", {intRecipeId: intRecipeId, intIngredientId: intIngredientId}, function (result) {
        $('#commonTitle').html(result['modal_title']);
        $('#commonBody').html(result['modal_body']);
    });
}

function deleteIngredients(intRecipeId, intIngredientId) {
    var flag = confirm("Are you sure want to delete this ingredient?");
    if (flag) {
        $.post(base_url + "/deleteIngredient", {intRecipeId: intRecipeId, intIngredientId: intIngredientId}, function (result) {
            $('#ingredient_list').html(result);
        });
    }
}

function deleteInstructions(intRecipeId, intInstructionId) {
    var flag = confirm("Are you sure want to delete this instruction?");
    if (flag) {
        $.post(base_url + "/deleteInstruction", {intRecipeId: intRecipeId, intInstructionId: intInstructionId}, function (result) {
            $('#instruction_list').html(result);
        });
    }
}

function addEditInstruction(intRecipeId, intInstructionId) {
    $('#commonTitle').html('Loading...');
    $('#commonBody').html('<div class="text-center">Please wait... <i class="fa fa-spinner fa-spin"></i><div>');
    $('#commonBox').modal('show');
    $.post(base_url + "/addInstruction", {intRecipeId: intRecipeId, intInstructionId: intInstructionId}, function (result) {
        $('#commonTitle').html(result['modal_title']);
        $('#commonBody').html(result['modal_body']);
    });
}

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
        cooking_method: "Please choose cooking method",
        cuisine: "Please choose cuisine type",
        prepare_time: "Please enter preparation time"
    },
    submitHandler: function (form) {
        form.submit();
        return false;
    }
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
