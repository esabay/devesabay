<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="POND">
        <meta name="keyword" content="">
        <link rel="shortcut icon" href="{{URL::to('theme/backend/default/img/favicon.html')}}">

        <title>Wholesale Management</title>

        <!-- Bootstrap core CSS -->
        {{HTML::style('theme/backend/default/css/bootstrap.min.css')}}
        {{HTML::style('theme/backend/default/css/bootstrap-reset.css')}}
        <!--external css-->
        {{HTML::style('theme/backend/default/assets/font-awesome/css/font-awesome.css')}}                
        <!-- Custom styles for this template -->
        {{HTML::style('theme/backend/default/css/style.css')}}
        {{HTML::style('theme/backend/default/css/style-responsive.css')}}
        {{HTML::style('theme/backend/default/assets/gritter/css/jquery.gritter.css')}}
        @yield('stylesheet_page_only')

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          {{HTML::script('theme/backend/default/js/html5shiv.js')}}
          {{HTML::script('theme/backend/default/js/respond.min.js')}}
        <![endif]-->
    </head>

    <body>

        <section id="container" class="">
            <!--header start-->
            @include('backend.layouts.header')
            <!--header end-->
            <!--sidebar start-->
            <aside>
                <div id="sidebar"  class="nav-collapse ">
                    @include('backend.layouts.sidebar')
                </div>
            </aside>
            <!--sidebar end-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    @yield('content')
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
        {{HTML::script('theme/backend/default/js/jquery-2.1.1.min.js')}}
        {{HTML::script('theme/backend/default/js/pusher.min.js')}}
        {{HTML::script('theme/backend/default/js/jquery.titlealert.min.js')}}
        {{HTML::script('theme/backend/default/js/main.js')}}
        {{HTML::script('theme/backend/default/js/bootstrap.min.js')}}
        {{HTML::script('theme/backend/default/js/jquery.dcjqaccordion.2.7.js')}}
        {{HTML::script('theme/backend/default/js/jquery.scrollTo.min.js')}}
        {{HTML::script('theme/backend/default/js/jquery.nicescroll.js')}}                
        {{HTML::script('theme/backend/default/assets/gritter/js/jquery.gritter.js')}}
        @yield('script_page')
        <!--common script for all pages-->
        {{HTML::script('theme/backend/default/js/common-scripts.js')}}
        {{HTML::script('theme/backend/default/js/respond.min.js')}}
        <!--script for this page-->
        @yield('script_page_only')
        @yield('script_page_code')
        <script type="text/javascript">
            $(function() {
                widget({wd: 'notification_dd', selector: '#header_notification_bar'});
//                setInterval(function() {
//                    widget({wd: 'notification_dd', selector: '#header_notification_bar'});
//                }, 60000);
            });

            $('body').on('click', '#notification_show', function() {
                $.ajax({
                    type: "get",
                    url: base_url + 'backend/common/read',
                    success: function() {
                        widget({wd: 'notification_dd', selector: '#header_notification_bar'});
                    }
                });

            });
        </script>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
