<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>{{ config('app.name', 'LocaFlex') }}</title>
    <!-- Stylesheets -->
    <link href="{{asset('bloxic/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('bloxic/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('bloxic/css/responsive.css')}}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="{{asset('bloxic/images/favicon.png')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('bloxic/images/favicon.png')}}" type="image/x-icon">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

</head>

<body>

    <div class="page-wrapper">

        <!-- Preloader -->
        <div class="loader-wrap">
            <div class="preloader">
                <div class="preloader-close">x</div>
                <div id="handle-preloader" class="handle-preloader">
                    <div class="animation-preloader">
                        <div class="spinner"></div>
                        <div class="txt-loading">
                            <span data-text-preloader="L" class="letters-loading">
                                L
                            </span>
                            <span data-text-preloader="O" class="letters-loading">
                                O
                            </span>
                            <span data-text-preloader="C" class="letters-loading">
                                C
                            </span>
                            <span data-text-preloader="A" class="letters-loading">
                                A
                            </span>
                            <span data-text-preloader="F" class="letters-loading">
                                F
                            </span>
                            <span data-text-preloader="L" class="letters-loading">
                                L
                            </span>
                            <span data-text-preloader="E" class="letters-loading">
                                E
                            </span>
                            <span data-text-preloader="X" class="letters-loading">
                                X
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Preloader End -->
        @include('layouts.partials.client.header')

        @yield('content')

        @include('layouts.partials.client.footer')

        <script src="{{asset('bloxic/js/jquery.js')}}"></script>
        <script src="{{asset('bloxic/js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('bloxic/js/magnific-popup.min.js')}}"></script>
        <script src="{{asset('bloxic/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
        <script src="{{asset('bloxic/js/appear.js')}}"></script>
        <script src="{{asset('bloxic/js/parallax.min.js')}}"></script>
        <script src="{{asset('bloxic/js/tilt.jquery.min.js')}}"></script>
        <script src="{{asset('bloxic/js/jquery.paroller.min.js')}}"></script>
        <script src="{{asset('bloxic/js/owl.js')}}"></script>
        <script src="{{asset('bloxic/js/wow.js')}}"></script>
        <script src="{{asset('bloxic/js/mixitup.js')}}"></script>
        <script src="{{asset('bloxic/js/touchspin.js')}}"></script>
        <script src="{{asset('bloxic/js/odometer.js')}}"></script>
        <script src="{{asset('bloxic/js/backToTop.js')}}"></script>
        <script src="{{asset('bloxic/js/jquery.countdown.js')}}"></script>
        <script src="{{asset('bloxic/js/jquery.marquee.min.js')}}"></script>
        <script src="{{asset('bloxic/js/nav-tool.js')}}"></script>
        <script src="{{asset('bloxic/js/jquery-ui.js')}}"></script>
        <script src="{{asset('bloxic/js/script.js')}}"></script>

        <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
        <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->

</body>

</html>
