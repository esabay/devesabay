<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="POND">
        <meta name="keyword" content="">
        <link rel="shortcut icon" href="{{URL::to('theme/backend/default/img/favicon.html')}}">

        <title>J-Office Management</title>

        <!-- Bootstrap core CSS -->
        {{HTML::style('theme/backend/default/css/bootstrap.min.css')}}
        {{HTML::style('theme/backend/default/css/bootstrap-reset.css')}}
        <!--external css-->
        {{HTML::style('theme/backend/default/assets/font-awesome/css/font-awesome.css')}}                
        <!-- Custom styles for this template -->
        {{HTML::style('theme/backend/default/css/style.css')}}
        {{HTML::style('theme/backend/default/css/style-responsive.css')}}
        @yield('stylesheet_page_only')

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          {{HTML::script('theme/backend/default/js/html5shiv.js')}}
          {{HTML::script('theme/backend/default/js/respond.min.js')}}
        <![endif]-->
    </head>

    <body class="full-width">

        <section id="container" class="">
            <!--header start-->
            <header class="header white-bg">
                <div class="navbar-header">
                    <!--logo start-->
                    <a href="#" class="logo">J-OFFICE<span> MANAGEMENT</span></a>
                    <!--logo end-->
                </div>

            </header>
            <!--header end-->
            <!--sidebar start-->

            <!--sidebar end-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper site-min-height">
                    <!-- page start-->
                    @yield('content')
                    <!-- page end-->
                </section>
            </section>
            <!--main content end-->
            <!--footer start-->
            <footer class="site-footer">
                <div class="text-center">
                    2014 &copy; Research & Development
                    <a href="#" class="go-top">
                        <i class="icon-angle-up"></i>
                    </a>
                </div>
            </footer>
            <!--footer end-->
        </section>

        <!-- js placed at the end of the document so the pages load faster -->
        {{HTML::script('theme/backend/default/js/jquery.js')}}
        {{HTML::script('theme/backend/default/js/main.js')}}
        {{HTML::script('theme/backend/default/js/bootstrap.min.js')}}
        {{HTML::script('theme/backend/default/js/jquery.dcjqaccordion.2.7.js')}}
        {{HTML::script('theme/backend/default/js/hover-dropdown.js')}}
        {{HTML::script('theme/backend/default/js/jquery.scrollTo.min.js')}}
        {{HTML::script('theme/backend/default/js/jquery.nicescroll.js')}}
        {{HTML::script('theme/backend/default/js/respond.min.js')}}

        <!--common script for all pages-->
        {{HTML::script('theme/backend/default/js/common-scripts.js')}}
        <!--script for this page-->
        @yield('script_page_only')
        @yield('script_page_code')
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Tittle</h4>
                    </div>
                    <div class="modal-body">

                        Body goes here...

                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button" id="button-close">Close</button>
                        <button class="btn btn-warning" type="button" id="button-confirm"> Confirm</button>
                        <button data-dismiss="modal" class="btn btn-danger" type="button" id="button-ok"> Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
    </body>
</html>
