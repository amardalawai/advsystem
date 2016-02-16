<!DOCTYPE html>
<html>
    <head>
        <title>{{ env('PROJECT_NAME') }} -  @yield('title')</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('plugins/bootstrap/css/bootstrap.min.css') }}" />
        <!-- Theme style -->
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('plugins/dist/css/AdminLTE.min.css') }}" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('plugins/dist/css/skins/_all-skins.min.css') }}" />
        <!-- Font Awesome -->
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('plugins/fontawesome/css/font-awesome.min.css') }}" />
        <!-- Ionicons -->
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('plugins/ionicons/css/ionicons.min.css') }}" />
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('plugins/tagsinput/bootstrap-tagsinput.css') }}" />

        <link type="text/css" rel="stylesheet" href="{{ URL::asset('plugins/jcrop/css/jquery.Jcrop.css') }}"/>

        <link type="text/css" rel="stylesheet" href="{{ URL::asset('plugins/custom/style.css') }}"/>
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('plugins/toastr/toastr.min.css') }}"/>
        <link type="text/css" rel="stylesheet" href="{{ URL::asset('plugins/datatables/dataTables.bootstrap.css') }}"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <meta name="_token" content="{{ csrf_token() }}"/>
        <style>
            label.error{
                position: absolute;
                color:#f00;
                font-weight: 400;
            }

            .form-group {
                margin-bottom: 25px;
            }
        </style>
    </head>
    <body class="hold-transition skin-black-light sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="{{ url() }}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>S</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Adv</b>System</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">


                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{ Auth::User()->userImage() }}" class="user-image" alt="User Image">
                                    <span class="hidden-xs">Welcome : {{ Auth::user()->userName() }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="{{ Auth::User()->userImage() }}" class="img-circle" alt="User Image">
                                        <p>
                                            {{ Auth::user()->userName() }}
                                            <small>Member since {{ Auth::user()->getSinceDate() }}</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{ url('edit') }}" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ url('auth/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->

                        </ul>
                    </div>
                </nav>
            </header>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ Auth::User()->userImage() }}" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>{{ Auth::User()->userName() }}</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                   
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">MAIN NAVIGATION</li>
                        <li><a href="{{ url("home") }}"><i class="fa fa-home"></i> <span>Home</span></a></li>
						<li><a href="{{ url("addPost") }}"><i class="fa fa-plus"></i> <span>Add Post</span></a></li>
						<li><a href="{{ url("managePost") }}"><i class="fa fa-list"></i> <span>Manage Post</span></a></li>
						@if(Auth::user()->id==1)
                        <li><a href="{{ url("users") }}"><i class="fa fa-users"></i> <span>Manage Users</span></a></li>
						
						@endif
                        <li><a href="{{ url("auth/logout") }}"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
						
                       
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        @yield('title')
                        <small>@yield('title-info')</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">@yield('title')</li>
                    </ol>
                </section>
                <!-- Content Header (Page header) -->
                <section class="content">
                    @section('content')

                    @show
                </section>
            </div><!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright &copy; {{ date('Y') }} <a href="#">AdvSystem</a>.</strong> All rights reserved.
            </footer>

            <div class="control-sidebar-bg"></div>
        </div><!-- ./wrapper -->


        <!-- Modal -->
        <div class="modal fade" id="commentsBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static"  >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal_title">Modal title</h4>
                    </div>
                    <div class="modal-body" id="modal_body">
                        ...
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="commonBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="commonTitle">Modal title</h4>
                    </div>
                    <div class="modal-body" id="commonBody">
                        ...
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-lg" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="largeTitle">Modal title</h4>
                    </div>
                    <div class="modal-body" id="largeBody">
                        ...
                    </div>
                </div>
            </div>
        </div>


        <!-- jQuery 2.1.4 -->
        <script type="text/javascript" src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
        <!-- Bootstrap 3.3.5 -->
        <script type="text/javascript" src="{{ URL::asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- SlimScroll -->
        <script type="text/javascript" src="{{ URL::asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
        <!-- FastClick -->
        <script type="text/javascript" src="{{ URL::asset('plugins/fastclick/fastclick.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script type="text/javascript" src="{{ URL::asset('plugins/dist/js/app.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script type="text/javascript" src="{{ URL::asset('plugins/dist/js/demo.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('plugins/jquery.validate/jquery.validate.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('plugins/jquery.validate/additional-methods.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('plugins/tagsinput/bootstrap-tagsinput.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('plugins/tagsinput/typeahead.bundle.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('plugins/jcrop/js/jquery.Jcrop.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('plugins/toastr/toastr.min.js') }}"></script>
        <script type="text/javascript">
$.ajaxSetup({
    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
});
var base_url = "{{ url() }}";
        </script>

        <script type="text/javascript" src="{{ URL::asset('plugins/typeahead/bootstrap3-typeahead.min.js') }}" ></script>
        <script type="text/javascript" src="{{ URL::asset('plugins/custom/allInOne.js') }}"></script>
        <!-- DataTables -->
<script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

        @yield('include_js')

        <?php
        $success = Session::get('show_success');
        $warning = Session::get('show_warning');
        $error = Session::get('show_error');
        $info = Session::get('show_info');
        ?>
        <input type="hidden" id="show_success_hidden" value="<?php echo (isset($success)) ? $success : ""; ?>" />
        <input type="hidden" id="show_error_hidden" value="<?php echo (isset($error)) ? $error : ""; ?>"  />
        <input type="hidden" id="show_warning_hidden" value="<?php echo (isset($warning)) ? $warning : ""; ?>"  />
        <input type="hidden" id="show_info_hidden" value="<?php echo (isset($info)) ? $info : ""; ?>"  />
    </body>
</html>