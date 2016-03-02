<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ env('PROJECT_NAME') }}</title>

        <meta charset="utf-8">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}" />
        <!-- Theme style -->
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/video-js.css') }}" />

        <!-- Font Awesome -->
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('plugins/fontawesome/css/font-awesome.min.css') }}" />

        <style>
            .carousel-control.right, .carousel-control.left {
                background-image: linear-gradient(to right,rgba(0,0,0,.0001) 0,rgba(68, 53, 53, 0) 100%);
            }
            .carousel-control {
                width: 5%;
            }
            *{
                border-radius: 0px !important;
            }
            .navbar-inverse .navbar-brand {
                color: #FFFFFF;
            }

            .carousel-indicators li {
                border: 1px solid #080808;
            }

            .carousel-indicators {
                bottom: 0px;
            }
			
			.carousel-caption {
				position: absolute;
				right: 0% !important;
				bottom: -18px !important;
				left: 0% !important;
				z-index: 10;
				padding: 10px !important;
				color: #fff;
				text-align: left; 
				text-shadow: 0 1px 2px rgba(0,0,0,.6);
				background-color: rgba(0, 0, 0, 0.4);
			}
			body{
				background-color:#DEDEDE;
			}
        </style>
    </head>
    <body>

        <div class="container-fluid" style="padding:0px">
            <nav id="navbar-example" class="navbar navbar-inverse navbar-static" style="margin-bottom: 0px;"> 
                <div class="container-fluid"> 

                    <div class="navbar-header"> 
                        <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-example-js-navbar-collapse"> 
                            <span class="sr-only">Toggle navigation</span> 
                            <span class="icon-bar"></span> 
                            <span class="icon-bar"></span> 
                            <span class="icon-bar"></span> 
                        </button> 
                        <a class="navbar-brand" href="#"><b>Adv</b>System</a> 
                    </div> 
                    <div class="collapse navbar-collapse bs-example-js-navbar-collapse"> 
							<div class="col-md-8">
								<marquee> <h4 style="color: #FFFFFF; padding-top: 5px;">Advertising here its free, Please contact 9888888888 or Sign in a Free Account today...</h4>
								</marquee>
							</div>
                        <ul class="nav navbar-nav navbar-right"> 
							
                            <li class="nav-item">
                                <a href="{{url('auth/login')}}"><i class="fa fa-key"></i> Login</a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{url('auth/register')}}"><i class="fa fa-sign-in"></i> Sign Up</a>
                            </li>
                        </ul> 
                    </div>
                </div> 
            </nav>
            <div class="col-md-6" style="padding:0px">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php $i = 0; ?>
                        @foreach($posts as $post)
                        @if($post->active==1 && !$post->expired()  && !empty($post->image))
                        <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 0) ? 'active' : '' ?>"></li>
                        <?php $i++; ?>
                        @endif
                        @endforeach
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php $j = 0; ?>
                        @foreach($posts as $post)
                        @if($post->active==1 && !$post->expired() && !empty($post->image))
                        <div class="item <?php echo ($j == 0) ? 'active' : '' ?>">
                            <div class="text-center">
                                <img src="<?php echo $post->postImage(); ?>" class="img-responsive" style="width:100%; height:360px" alt="<?php echo $post->title ?>">
                            </div>
                            <div class="carousel-caption">
								<h3 style="margin: 0px;"><?php echo $post->title ?></h3>
                                <p><?php echo $post->description ?>
                                    <br>
                                    <i class="fa fa-user"></i> <?php echo $post->user->userName(); ?><br>
                                    <i class="fa fa-clock-o"></i> <small > Posted on <?php echo date('d-M-y h:i a', strtotime($post->created_at)); ?>  | <?php echo $post->deptName->name; ?></small>
                                </p>
                            </div>
                        </div>
                        <?php $j++; ?>
                        @endif
                        @endforeach

                    </div>

                    <!-- Left and right controls 
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>-->
                    </a>
                </div>
            </div>
            <div class="clearfix visible-xs"><br></div>
            <div class="col-md-6"  style="padding:0px">
                <div id="vidSlider" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php $j = 0; ?>
                        @foreach($posts as $post)
                        @if($post->active==1 && !$post->expired() && $post->type == 3)
                        <div class="item <?php echo ($j == 0) ? 'active' : '' ?>">
                            <video id="my-video" class="video-js" controls preload="auto" style="width: 100%" height="360px" data-setup='{"loop": "true"}'>
                                <source src="{{ $post->video()}}" type='video/mp4'>
                                <source src="{{ $post->video()}}" type='video/webm'>
                                <p class="vjs-no-js">
                                    To view this video please enable JavaScript, and consider upgrading to a web browser that
                                    <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                                </p>
                            </video>
                            <div class="carousel-caption" style="top: 0%;height: 60px;">
                                <h3 style="margin: 0px;"><?php echo $post->title ?></h3>
                                <p>
                                    <i class="fa fa-user"></i> <?php echo $post->user->userName(); ?> | 
                                    <i class="fa fa-clock-o"></i> <small> Posted on <?php echo date('d-M-y h:i a', strtotime($post->created_at)); ?>  | <?php echo $post->deptName->name; ?></small>
                                </p>
                            </div>
                        </div>
                        <?php $j++; ?>
                        @endif
                        @endforeach

                    </div>

                    <!-- Left and right controls 
                    <a class="left carousel-control" href="#vidSlider" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#vidSlider" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>--> 
                </div>
            </div>
            <div class="clearfix visible-xs"><br></div>
            <div class="col-md-12">
                <div id="txtSlider" class="carousel slide" data-ride="carousel">
                    <!-- Indicators
                    <ol class="carousel-indicators">
                        <?php $j = 0;
                        for ($i = 0; $i <=count($allTxt); $i=$i+3) {
						?>
                        <li data-target="#txtSlider" data-slide-to="<?php echo  $j; ?>" class="<?php echo ( $j == 0) ? 'active' : '' ?>"></li>
                        <?php $j++; }   ?>
                        
                    </ol> -->
					
					<div class="carousel-inner" role="listbox">
                    <?php
                    for ($i = 0; $i <=count($allTxt); $i=$i+3) {
						$j=0;
						$active = ($i==0)?'active':'';
							echo ' <div class="item '.$active.'">';
							while($j<3){
								$index = $i+$j;
									if(!empty($allTxt[$index])){
										echo '
										<div class="col-md-4">
											<h3>'.$allTxt[$index]['title'].'</h3>
											<p style="min-height: 100px">'.$allTxt[$index]['description'].'</p>
											<br>
											<i class="fa fa-user"></i> '.$allTxt[$index]['uname'].'<br>
											<i class="fa fa-clock-o"></i> <small > Posted on '.$allTxt[$index]['dateon'].'  | '.$allTxt[$index]['deptname'].'</small>
										</div>';
									}
								$j++;
							}
							echo '</div>';
                    }
                    ?>
					</div>
                  
                    <a class="left carousel-control" href="#txtSlider" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#txtSlider" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>


        <!-- jQuery 2.1.4 -->
        <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
        <!-- Bootstrap 3.3.5 -->
        <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
        <!-- SlimScroll -->
        <script type="text/javascript" src="{{ URL::asset('assets/js/video.js') }}"></script>



        <script>
var player = videojs('my-video');
player.play();
        </script>
    </body>
</html>
