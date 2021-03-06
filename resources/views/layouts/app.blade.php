<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Responsive admin dashboard and web application ui kit. ">
        <meta name="keywords" content="mail, email, conversation, mailbox">

        <title>LeanFITT</title>

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">
        <link rel="icon" href="assets/img/favicon.png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i" rel="stylesheet">
        {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}

        <!-- Styles -->
        <link href="{{ asset('assets/css/core.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    </head>
    <body class="#sidebar-folded">
        @include('layouts.partials.preloader')
        @include('layouts.partials.sidebar')
        @include('layouts.partials.header')

        <!-- Main container -->
        {{--<main>--}}
            {{--<div class="main-content">--}}
                @yield('content')
            {{--</div>--}}
        {{--</main>--}}

        @include('layouts.partials.footer')

        @include('layouts.partials.profile')

        <!-- Global quickview -->
        <div id="qv-global" class="quickview" data-url="assets/data/quickview-global.html">
            <div class="spinner-linear">
                <div class="line"></div>
            </div>
        </div>
        <!-- END Global quickview -->
    </body>

    <!-- Scripts  -->
    <script src="{{ asset('assets/js/core.min.js') }}" data-provide="chartjs"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <script>
        function submitForm(selector, method) {

            var $selector = $(selector);

            if($selector.length) {
                if (method) {
                    var $methodField = $selector.find('input[name="_method"]');
                    if ($methodField.length){
                        $methodField.val('method');
                    }else{
                        $selector.prepend('<input name="_method" value="' + method + '"');
                    }
                }
                $selector.submit();
            }
        }

        $(document).ready(function () {
            setTimeout(function () {
                $('table.dataTable').removeClass('dataTable');
            }, 1000);
        });
    </script>
</html>
