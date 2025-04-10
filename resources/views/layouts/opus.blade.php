<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Collab') }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Template/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Template/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Template/assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Template/assets/css/cursor.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Template/assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Template/assets/css/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Template/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Template/assets/css/vanilla-calendar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Template/assets/css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="page_wrapper">
        <div class="backtotop">
            <a href="#" class="scroll">
                <i class="far fa-arrow-up"></i>
            </a>
        </div>
        @include('layouts.partials.client.header')
        @yield('content')
    </div>
    <script src="{{ asset('Template/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('Template/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('Template/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Template/assets/js/bootstrap-dropdown-ml-hack.js') }}"></script>
    <script src="{{ asset('Template/assets/js/cursor.js') }}"></script>
    <script src="{{ asset('Template/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('Template/assets/js/tilt.min.js') }}"></script>
    <script src="{{ asset('Template/assets/js/parallax.min.js') }}"></script>
    <script src="{{ asset('Template/assets/js/parallax-scroll.js') }}"></script>
    <script src="{{ asset('Template/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('Template/assets/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('Template/assets/js/waypoint.js') }}"></script>
    <script src="{{ asset('Template/assets/js/counterup.min.js') }}"></script>
    <script src="{{ asset('Template/assets/js/countdown.js') }}"></script>
    <script src="{{ asset('Template/assets/js/vanilla-calendar.min.js') }}"></script>
    <script src="{{ asset('Template/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>