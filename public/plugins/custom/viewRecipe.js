function like(recipe_id) {
    $.post(base_url + "/like", {recipe_id: recipe_id}, function (result) {
        $('#likeRecipeBtn').html('<i class="fa fa fa-spinner fa-spin"></i>');
        if (result['liked'] == 1) {
            $('#likeRecipeBtn_' + recipe_id).addClass('like');
            $('#likeRecipeBtn_' + recipe_id).html('<i class="fa fa-thumbs-up"></i> Like</a>');
            $('#like_count_' + recipe_id).html(result['likes_count']);

            $('#likeRecipeBtn').html('<i class="fa fa fa-thumbs-up"></i> You liked this recipe <span class="badge bg-warning">' + result['likes_count'] + '</span>');
        }
        else {
            $('#likeRecipeBtn_' + recipe_id).removeClass('like');
            $('#likeRecipeBtn_' + recipe_id).html('<i class="fa fa-thumbs-o-up"></i> Like</a>');
            $('#like_count_' + recipe_id).html(result['likes_count']);

            $('#likeRecipeBtn').html('<i class="fa fa fa-thumbs-up"></i> Like <span class="badge bg-warning">' + result['likes_count'] + '</span>');
        }
    });
}

function cardlike(recipe_id) {
    $.post(base_url + "/like", {recipe_id: recipe_id}, function (result) {
        $('#like_count_').html('<i class="fa fa fa-spinner fa-spin"></i>');

        if (result['liked'] == 1) {
            $('#likeRecipeBtn_' + recipe_id).addClass('like');
            $('#likeRecipeBtn_' + recipe_id).html('<i class="fa fa-thumbs-up"></i> Like</a>');
            $('#like_count_' + recipe_id).html(result['likes_count']);
            $('#likeRecipeBtn').html('<i class="fa fa fa-thumbs-up"></i> You liked this recipe <span class="badge bg-warning">' + result['likes_count'] + '</span>');

        }
        else {
            $('#likeRecipeBtn_' + recipe_id).removeClass('like');
            $('#likeRecipeBtn_' + recipe_id).html('<i class="fa fa-thumbs-o-up"></i> Like</a>');
            $('#like_count_' + recipe_id).html(result['likes_count']);
            $('#likeRecipeBtn').html('<i class="fa fa fa-thumbs-up"></i> Like <span class="badge bg-warning">' + result['likes_count'] + '</span>');

        }
    });
}

function comments(recipe_id) {
    $('#modal_title').html('Loading...');
    $('#modal_body').html('<div class="text-center">Please wait... <i class="fa fa-spinner fa-spin"></i><div>');
    $('#commentsBox').modal('show');
    $.post(base_url + "/comments", {recipe_id: recipe_id}, function (result) {
        $('#modal_title').html(result['modal_title']);
        $('#modal_body').html(result['modal_body']);
        $('#comment_count').html(result['comment_count']);
    });
}

function commentInLine(recipe_id) {
    $('#comment_list').html('<div class="text-center">Please wait... <i class="fa fa-spinner fa-spin"></i><div>');
    $.post(base_url + "/comments_inline", {recipe_id: recipe_id}, function (result) {
        $('#comment_people').html(result['modal_title']);
        $('#comment_list').html(result['modal_body']);
        $('#comment_count').html(result['comment_count']);
    });
}

function getCountText() {
    var txt = $('#recipe_comment').val().trim();

    $('#text_count').html(txt.length);

    if (txt.length == 0) {
        document.getElementById("add_comment").disabled = true;
    }
    else {
        document.getElementById("add_comment").disabled = false;
    }
}


function saveComment() {
    var recipe_comment = $('#recipe_comment').val().trim();
    var recipe_id = $('#recipe_id').val();

    $.post(base_url + "/save_comment", {recipe_id: recipe_id, comment: recipe_comment}, function (result) {

        if (!document.getElementById("comment_list")) {
            comments(recipe_id);
        }
        else {
            commentInLine(recipe_id);
        }
    });
}


function deleteCommnt(intCommentId) {

    var flag = confirm("Are you sure you want to delete this post?");

    if (flag) {
        $('#comment_' + intCommentId).html('<div class="text-center">Please wait... <i class="fa fa-spinner fa-spin"></i><div>');
        $.post(base_url + "/delete_comment", {intCommentId: intCommentId}, function (result) {
            $('#comment_' + intCommentId).remove();

            var comment_count = $('#comment_count').html();
            comment_count = parseInt(comment_count) - 1;
            $('#comment_count').html(comment_count);
        });
    }

}

function deleteRecipe(intRecipeId) {
    var flag = confirm("Are you sure you want to delete this recipe?");
    if (flag) {
        $.post(base_url + "/delete_recipe", {intRecipeId: intRecipeId}, function (result) {
            console.log(result);
        });
    }
}



