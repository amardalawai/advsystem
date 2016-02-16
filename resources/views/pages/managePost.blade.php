@extends('pages.layout.master')
@section('title', 'Manage Post')
@section('title-info', '')
@section('content')
@parent

<table id="tblPost" class="table">
    <thead>
        <tr>
            <th>Manage Post</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($arrPost as $post)
        <tr id="post_{{$post->id}}">
            <td>
                <div class="card card-block">
                    <h4 class="card-title"><?php echo $post->title ?></h4>
                    <p class="card-text"><?php echo $post->description ?></p>
                    @if($post->type == 0 && !empty($post->image))
                    <img class="card-img-top img-fluid" style="max-width:300px" src="<?php echo $post->postImage(); ?>" alt="<?php echo $post->title ?>">
                    @elseif($post->type == 1)
                    <img class="card-img-top img-fluid" style="max-width:300px" src="<?php echo $post->postImage(); ?>" alt="<?php echo $post->title ?>">
                    @elseif($post->type == 2) 
                    <audio controls>
                        <source src="{{ $post->audio()}}" type="audio/ogg">
                        <source src="{{ $post->audio()}}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                    @elseif($post->type == 3)
                    <video id="my-video" class="video-js" controls preload="auto" width="380" data-setup="{}">
                        <source src="{{ $post->video()}}" type='video/mp4'>
                        <source src="{{ $post->video()}}" type='video/webm'>
                        <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a web browser that
                            <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
                    @endif
                    <p class="card-text"><small class="text-muted"> Posted on <?php echo date('d-M-y h:i a', strtotime($post->created_at)); ?></small></p>
                </div>
            </td>
            <td id="status_{{$post->id}}"><?php echo($post->active == 0) ? '<label class="label label-danger">In-Active</label>' : '<label class="label label-success">Active</label>' ?></td>
            <td>
                @if(Auth::user()->id==1)
                <select class="form-control" onchange="setStatus(this.value,{{$post->id}})">	
                    <option value="">--Choose--</option>
                    <option value="1">Active</option>
                    <option value="0">In-Active</option>
                </select>

                @endif

                <button class="btn btn-danger pull-right" onclick="deletePost({{$post->id}});"><i class="fa fa-trash-o"></i> Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop

@section('include_js')

<script>
    $(function () {
    $("#tblPost").DataTable();
    });
    function setStatus(intStatusId, intPostId){
    if (intPostId && intStatusId != ''){
    $.post('processSetStatus', {intStatusId:intStatusId, intPostId:intPostId}, function(result){

    var status = (intStatusId == 0)?'<label class="label label-danger">In-Active</label>':'<label class="label label-success">Active</label>'
            $('#status_' + intPostId).html(status);
    show_success('Post status updated successfully.');
    });
    }
    }

    function deletePost(intPostId){
    var r = confirm("Do you really want to delete this post");
    if (intPostId && r){
    $.post('processDeletePost', {intPostId:intPostId}, function(result){
    $('#post_' + intPostId).remove();
    show_success('Post deleted successfully.');
    });
    }
    }
</script>

@stop