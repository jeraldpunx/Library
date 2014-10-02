<!DOCTYPE html>
<html>
    <head>
        {{ HTML::style('css/bootstrap.css') }}
        {{ HTML::style('css/flat-ui.css') }}
        {{ HTML::style('css/icon-font.css') }}
        {{ HTML::style('css/animations.css') }}
        {{ HTML::style('css/notifIt.css') }}
        {{ HTML::style('css/font-awesome.css') }}
        {{ HTML::style('css/style.css') }}
        {{ HTML::style('css/admin/ionicons.min.css') }}
        {{ HTML::style('css/admin/datepicker3.css' )}}
        {{ HTML::style('css/admin/daterangepicker-bs3.css' )}}
        {{ HTML::style('css/admin/bootstrap3-wysihtml5.min.css' )}}
        {{ HTML::style('css/admin/AdminLTE.css' )}}
    </head>
    <body class="skin-blue">
        @yield('content')
        
         <script src="{{ URL::asset('js/jquery-1.10.2.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('js/modernizr.custom.js') }}"></script>
        <script src="{{ URL::asset('js/page-transitions.js') }}"></script>
        <script src="{{ URL::asset('js/startup-kit.js') }}"></script>
        <script src="{{ URL::asset('js/notifIt.js') }}"></script>

        <!--<script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>-->
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline 
        <!--<script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap 
        <!--<script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <!--<script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
         <!-- <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        // datepicker
        // <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script> -->
        <!-- Bootstrap WYSIHTML5 -->
        <!--<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
       <!-- <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="{{ URL::asset('js/admin/app.js') }}"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) 
        <!--<script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
       <!-- <script src="js/AdminLTE/demo.js" type="text/javascript"></script>-->

    </body>
</html>