<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no">

    <title>
        @section('title')
            {{ config('app.name') }} {{ $page_title ? ' - ' . $page_title : '' }}
        @show
    </title>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('landing-assets/css/bootstrap.min.css') }}">
    <!-- fontawesome icon  -->
    <link rel="stylesheet" href="{{ asset('landing-assets/css/fontawesome.min.css') }}">
    <!-- flaticon css -->
    <link rel="stylesheet" href="{{ asset('landing-assets/fonts/flaticon.css') }}">
    <!-- animate.css -->
    <link rel="stylesheet" href="{{ asset('landing-assets/css/animate.css') }}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('landing-assets/css/owl.carousel.min.css') }}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('landing-assets/css/magnific-popup.css') }}">
    <!-- stylesheet -->
    <link rel="stylesheet" href="{{ asset('landing-assets/css/style.css') }}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{ asset('landing-assets/css/responsive.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">

    <link href="{{ asset('bitfarm-landing/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('bitfarm-landing/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('bitfarm-landing/css/responsive.css') }}" rel="stylesheet">

</head>

<body>


<!-- header begin-->
@include('partials.landing-header2')
<!-- header end -->

<!-- page title begin-->
<div class="page-title">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <h2 class="extra-margin">
                    {{ $heading }}
                </h2>
                <p>
                    {{ $sub_heading }}
                </p>
            </div>
        </div>
    </div>
</div>
<!-- page title end -->

<!-- page begin-->
@yield('content')
<!-- page end -->

<!-- footer begin -->
@include('partials.landing-footer')
<!-- footer end -->

<!-- scroll top button begin -->
<div class="scroll-to-top">
    <a><i class="fas fa-long-arrow-alt-up"></i></a>
</div>
<!-- scroll top button end -->

<!-- jquery -->
<script src="{{ asset('landing-assets/js/jquery.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('landing-assets/js/bootstrap.min.js') }}"></script>
<!-- owl carousel -->
<script src="{{ asset('landing-assets/js/owl.carousel.js') }}"></script>
<!-- magnific popup -->
<script src="{{ asset('landing-assets/js/jquery.magnific-popup.js') }}"></script>
<!-- way poin js-->
<script src="{{ asset('landing-assets/js/waypoints.min.js') }}"></script>
<!-- counter up js-->
<script src="{{ asset('landing-assets/js/jquery.counterup.min.js') }}"></script>
<!-- wow js-->
<script src="{{ asset('landing-assets/js/wow.min.html') }}"></script>
<!-- main -->
<script src="{{ asset('landing-assets/js/main.js') }}"></script>

<!--End of Tawk.to Script-->
</body>
</html>
