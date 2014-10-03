<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        {{ HTML::style('css/bootstrap.css') }}
        {{ HTML::style('css/flat-ui.css') }}
        {{ HTML::style('css/icon-font.css') }}
        {{ HTML::style('css/animations.css') }}
        {{ HTML::style('css/notifIt.css') }}
        {{ HTML::style('css/font-awesome.css') }}
        {{ HTML::style('css/jquery.dataTables.css') }}
        {{ HTML::style('css/style.css') }}
    </head>

    <body>
        <div class="page-wrapper">
            @yield('content')
            @yield('footer')
        </div>

        <!-- Placed at the end of the document so the pages load faster -->
        <script src="{{ URL::asset('js/jquery-1.10.2.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('js/modernizr.custom.js') }}"></script>
        <script src="{{ URL::asset('js/page-transitions.js') }}"></script>
        <script src="{{ URL::asset('js/startup-kit.js') }}"></script>
        <script src="{{ URL::asset('js/notifIt.js') }}"></script>
        <script src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
        @yield('script')  
    </body>
</html>