<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
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
            <footer style="padding-top: 90px; background-color: transparent;">
                <div class="container" style="color: #1abc9c; border-bottom: 3px solid #1abc9c;">
                    <p class="pull-left text-left"><span class="fa fa-copyright"></span> 2014-2015 {{ $companyName }}, All rights reserved.</p>
                    <p class="pull-right text-right">Developed by: JC Mamitz - JeraldPunx - Kevz Tabadz</p>
                </div>
                <div class="container">
                    <p class="text-right" style="padding-top: 5px; color: #e74c3c;"><i>Penalty rate: ${{ Borrower::$perDayPenalty }}.00 / {{ Borrower::$daysExpired }} days.</i></p>
                </div>
            </footer>
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