<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <!-- Favicon -->
	<link rel="shortcut icon" type="image/png" href="ico/favicon-16x16.png"/>

	<!-- Libs CSS -->
    <link rel="stylesheet" href="{{asset('front/assets/css/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('front/assets/css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/js/datetimepicker/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/js/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/css/themecss/lib.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/js/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/js/minicolors/miniColors.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/js/slick-slider/slick.css')}}" rel="stylesheet">

	<!-- Theme CSS -->
    <link href="{{asset('front/assets/css/themecss/so_sociallogin.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/css/themecss/so_searchpro.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/css/themecss/so_megamenu.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/css/themecss/so-categories.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/css/themecss/so-listing-tabs.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/css/themecss/so-category-slider.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/css/themecss/so-newletter-popup.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/css/footer/footer3.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/css/header/header1.css')}}" rel="stylesheet">
    @stack('main-layout')
    @if(request()->route()->getName()=='/')
        <link id="color_scheme" href="{{asset('front/assets/css/home3.css')}}" rel="stylesheet">
    @else
        <link id="color_scheme" href="{{asset('front/assets/css/theme.css')}}" rel="stylesheet">
    @endif    

    <link href="{{asset('front/assets/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('front/assets/css/quickview/quickview.css')}}" rel="stylesheet">
	<!-- Google web fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" type="text/css">
    <style type="text/css">
            body{font-family: Roboto, sans-serif;}
    </style>
    @livewireStyles
</head>
<body class="@if(request()->route()->getName()=='login') account-login account res layout-1 @else common-home ltr layout-3 @endif">
    <div id="wrapper" class="wrapper-full banners-effect-10">
        <x-front.header/>
        {{$slot}}
        <x-front.footer/>
    </div>
    <div class="back-to-top" id="scroll-top"><i class="fa fa-angle-up"></i></div>  
    
    <script>
        var scroll = document.getElementById("scroll-top");
        scroll.style.display = "none";
        window.onscroll = function() {scrollFunction()};
        function scrollFunction() {
            if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
                scroll.style.display = "block";
            } else {
                scroll.style.display = "none";
            }
        }
    </script>
    
    <!-- Placed at the end of the document so the pages load faster -->
	<script type="text/javascript" src="{{asset('front/assets/js/jquery-2.2.4.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/themejs/so_megamenu.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/owl-carousel/owl.carousel.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/slick-slider/slick.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/themejs/libs.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/unveil/jquery.unveil.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/countdown/jquery.countdown.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/datetimepicker/moment.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/jquery-ui/jquery-ui.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/modernizr/modernizr-2.6.2.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/minicolors/jquery.miniColors.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/jquery.nav.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/quickview/jquery.magnific-popup.min.js')}}"></script>

	<!-- Theme files-->
	<script type="text/javascript" src="{{asset('front/assets/js/themejs/application.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/themejs/homepage.js')}}"></script>
    <script type="text/javascript" src="{{asset('front/assets/js/themejs/custom_h3.js')}}"></script>
    <script type="text/javascript" src="{{asset('front/assets/js/themejs/custom_h1.js')}}"></script>
	<script type="text/javascript" src="{{asset('front/assets/js/themejs/addtocart.js')}}"></script>
    <script type="text/javascript" src="{{asset('front/assets/js/themejs/nouislider.js')}}"></script>
   @livewireScripts
</body>
</html>
