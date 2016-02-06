<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    </head>
    <body>

        <nav class="navbar navbar-dark bg-faded bg-primary">
            <a class="navbar-brand" href="#">AdvSystem</a>
            <ul class="nav navbar-nav  pull-xs-right">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('auth/login')}}">Login</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{url('auth/register')}}">Sign up</a>
                </li>
            </ul>
        </nav>
        <br>
        <div class="container-fluid">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">

                <?php foreach ($departments as $key => $dept) { ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($key == 0) ? 'active' : '' ?>" data-toggle="tab" href="#tab_<?php echo $key ?>" role="tab"><?php echo $dept['name']; ?></a>
                    </li>
                <?php } ?>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content"><br>
                <?php foreach ($departments as $key => $dept) { ?>
                    <div class="tab-pane <?php echo ($key == 0) ? 'active' : '' ?>" id="tab_<?php echo $key ?>" role="tabpanel">
                        <div class="card-columns">

                            <?php
                            foreach ($dept->Post as $post) {
                                if ($post->type == 0) {
                                    ?>
                                    <div class="card card-block">
                                        <h4 class="card-title"><?php echo $post->title ?></h4>
                                        <p class="card-text"><?php echo $post->description ?></p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                    </div>

                                <?php } elseif ($post->type == 1) {
                                    ?>
                                    <div class="card">
                                        <img class="card-img-top" style="width: 100%;" src="<?php echo $post->postImage() ?>" alt="Card image cap">
                                        <div class="card-block">
                                            <h4 class="card-title"><?php echo $post->title ?></h4>
                                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                        </div>
                                    </div>
                                <?php } elseif ($post->type == 2) {
                                    ?>
                                    <div class="card">
                                        <audio controls>
                                            <source src="<?php echo $post->postAudio ?>" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                        <div class="card-block">
                                            <h4 class="card-title"><?php echo $post->title ?></h4>
                                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                        </div>
                                    </div>
                                <?php } elseif ($post->type == 3) {
                                    ?>
                                    <div class="card">
                                        <video  controls>
                                            <source src="<?php echo $post->postVideo ?>" type="video/mp4">
                                            Your browser does not support HTML5 video.
                                        </video>
                                        <div class="card-block">
                                            <h4 class="card-title"><?php echo $post->title ?></h4>
                                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>


                        </div>  
                    </div>
                <?php } ?>
            </div>
        </div>



        <nav class="navbar navbar-dark bg-faded bg-primary">
            <a class="navbar-brand" href="#"><small>AdvSystem &copy 2016, All rights received</small></a>
        </nav>



        <!-- jQuery first, then Bootstrap JS. -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
    </body>
</html>