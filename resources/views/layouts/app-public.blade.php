<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="home furniture, furniture">
    <meta name="author" content="422021005-Yohanes Handoyo">
    
    <title>@yield('title') | 422021005-Yohanes Handoyo</title>

    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    
    
    <link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/linearicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/animation.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/slick.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/easyzoom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    @yield('addition_css')
</head>
<body class="box-home">
    <div class="page-box">
        @include('components.header')
        <div id="main-wrapper">
            @yield('content')
            @include('components.footer')
        </div>
    </div>

    <script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/axios.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/fullpage.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/slick.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/magnific-popup.js')}}"></script>
    <script src="{{asset('assets/js/plugins/easyzoom.js')}}"></script>
    <script src="{{asset('assets/js/plugins/images-loaded.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/isotope.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/YTplayer.js')}}"></script>
    <script src="{{asset('assets/js/plugins/ajax.mail.js')}}"></script>
    <script src="{{asset('assets/js/plugins/wow.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0"></script>
    <script src="{{asset('pages/js/app.js')}}"></script>
    @yield('addition_script')
</body>
</html>