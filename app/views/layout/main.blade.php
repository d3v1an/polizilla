<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Polizilla | Ga Comunicacion</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        {{ HTML::style('css/bootstrap.min.css') }}
        <!-- font Awesome -->
        {{ HTML::style('css/font-awesome.min.css') }}
        <!-- Ionicons -->
        {{ HTML::style('css/ionicons.min.css') }}
        <!-- Morris chart -->
        {{ HTML::style('css/morris/morris.css') }}
        <!-- jvectormap -->
        {{ HTML::style('css/jvectormap/jquery-jvectormap-1.2.2.css') }}
        <!-- Date Picker -->
        {{ HTML::style('css/datepicker/datepicker3.css') }}
        <!-- Daterange picker -->
        {{ HTML::style('css/daterangepicker/daterangepicker-bs3.css') }}
        <!-- bootstrap wysihtml5 - text editor -->
        {{ HTML::style('css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}
        <!-- Theme style -->
        {{ HTML::style('css/AdminLTE.css') }}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="{{ URL::to('/') }}" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Polizilla
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav"> 
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>{{ Auth::user()->name }} <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="{{ URL::to('logout') }}" class="btn btn-default btn-flat">Cerrar sesion</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="{{ URL::to('analytic/board/STPS') }}" class="btn-board" data-board="3">
                                <span>STPS</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('analytic/board/PEMEX') }}" class="btn-board" data-board="51"><!-- Buscar el de pemex -->
                                <span>PEMEX</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('analytic/board/Presidencia') }}" class="btn-board" data-board="6">
                                <span>Presidencia</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">

                @yield('content')

            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->

        <script type="text/javascript">
            var base_path       = '{{ URL::to("/") }}';
            var default_board   = 3;
        </script>

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        {{ HTML::script('js/jquery-ui-1.10.3.min.js') }}
        <!-- Bootstrap -->
        {{ HTML::script('js/bootstrap.min.js') }}
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        {{ HTML::script('js/plugins/morris/morris.min.js') }}
        <!-- Sparkline -->
        {{ HTML::script('js/plugins/sparkline/jquery.sparkline.min.js') }}
        <!-- jvectormap -->
        {{ HTML::script('js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}
        {{ HTML::script('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}
        <!-- jQuery Knob Chart -->
        {{ HTML::script('js/plugins/jqueryKnob/jquery.knob.js') }}
        <!-- daterangepicker -->
        {{ HTML::script('js/plugins/daterangepicker/daterangepicker.js') }}
        <!-- datepicker -->
        {{ HTML::script('js/plugins/datepicker/bootstrap-datepicker.js') }}
        <!-- Bootstrap WYSIHTML5 -->
        {{ HTML::script('js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}
        <!-- iCheck -->
        {{ HTML::script('js/plugins/iCheck/icheck.min.js') }}

        <!-- AdminLTE App -->
        <script src="js/" type="text/javascript"></script>
        {{ HTML::script('js/AdminLTE/app.js') }}
        <!-- AdminLTE for demo purposes -->
        {{ HTML::script('js/common.js') }}
        {{ HTML::script('js/main.js') }}

    </body>
</html>