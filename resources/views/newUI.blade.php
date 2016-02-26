<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
        <link href="{{ url('assets/css/video-js.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('plugins/lightbox/css/lightbox.min.css') }}">
		 <!-- Font Awesome -->
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('plugins/fontawesome/css/font-awesome.min.css') }}" />
        <style>
            *{
                border-radius:0px !important;
            }

        </style>
    </head>
    <body>

        <nav class="navbar navbar-dark bg-faded bg-primary">
            <a class="navbar-brand" href="#"><h4>AdvSystem</h4></a>
            <ul class="nav navbar-nav pull-xs-right">
				<li class="nav-item">
                    <a href="{{url('auth/login')}}" class="btn btn-secondary-outline">Login</a>
                </li>
                <li class="nav-item">
                    <a href="{{url('auth/register')}}" class="btn btn-secondary-outline">Sign Up</a>
                </li>
            </ul>
			<div class="row">
				<div class="col-md-4">
					<input id="search-headers" class="form-control" name="search" placeholder="Search keyword" type="text" data-list=".headers_list" data-nodata="No results found">
				</div>
			</div>
        </nav>
       
        <div class="container-fluid">
			<br>
            <div class="card-columns  headers_list">
                            @foreach($posts as $post)
                            @if($post->active==1 && !$post->expired())


                            <div class="card card-block 
                                 @if($post->type == 0)
                                 card-success-outline
                                 @elseif($post->type == 1)
                                 card-info-outline
                                 @elseif($post->type == 2)
                                 card-warning-outline
                                 @elseif($post->type == 3)
                                 card-danger-outline
                                 @endif
                                 ">

                                <h4 class="card-title"><?php echo $post->title ?></h4>
                                <p class="card-text"><?php echo $post->description ?></p>

                                @if($post->type == 0 && !empty($post->image))
                                <a href="<?php echo $post->postImage(); ?>" data-lightbox="example-2" data-title="<?php echo $post->title ?>">
                                    <img class="card-img-top img-fluid" src="<?php echo $post->postImage(); ?>" alt="<?php echo $post->title ?>">
                                </a>

                                @elseif($post->type == 1)
                                <a href="<?php echo $post->postImage(); ?>" data-lightbox="example-2" data-title="<?php echo $post->title ?>">
                                    <img class="card-img-top img-fluid" src="<?php echo $post->postImage(); ?>" alt="<?php echo $post->title ?>">
                                </a>
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
								
								<blockquote style="margin:0px">
									<i class="fa fa-user"></i> <?php echo $post->user->userName(); ?><br>
									<i class="fa fa-clock-o"></i> <small class="text-muted"> Posted on <?php echo date('d-M-y h:i a', strtotime($post->created_at)); ?>  | <?php  echo $post->deptName->name; ?></small>
								</blockquote>
                                
                            </div>
                            @endif
                            @endforeach

                        </div>  
        </div>



        <nav class="navbar navbar-dark bg-faded bg-primary">
            <a class="navbar-brand" href="#"><small>AdvSystem &copy 2016, All rights received</small></a>
        </nav>



        <!-- jQuery first, then Bootstrap JS. -->
        <script src="{{ url('assets/js/jquery.min.js') }}"></script>
        <script src="{{ url('assets/js/bootstrap.min.js') }}" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
        <script src="{{ url('assets/js/video.js') }}"></script>
        <script src="{{ url('plugins/lightbox/js/lightbox-plus-jquery.min.js') }}"></script>
		 <script type="text/javascript" src="{{ url('assets/js/jquery.hideseek.min.js') }}"></script>
		<script>
			$(document).ready(function() {
				$('#search-headers').hideseek({
				  nodata: 'No results found',
				  navigation: true
				});
			});
		</script>
    </body>
</html>