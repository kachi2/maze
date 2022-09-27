<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no">


    <!-- Main Page Title -->
    <title>
        @section('title')
            {{ config('app.name') }} {{ $page_title ? ' - ' . $page_title : '' }}
        @show
    </title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800" rel="stylesheet">


    <!-- Bootstrap 4 css -->
    <link rel="stylesheet" href="{{ asset('ally-landing-assets/css/bootstrap.min.css') }}">
    <!-- Font Awesome css -->
    <link rel="stylesheet" href="{{ asset('ally-landing-assets/css/all.css') }}">
    <!-- Animate css -->
    <link rel="stylesheet" href="{{ asset('ally-landing-assets/css/animate.css') }}">
    <!-- Owl carousel css  -->
    <link rel="stylesheet" href="{{ asset('ally-landing-assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ally-landing-assets/css/owl.theme.default.min.css') }}">
        <!-- Magnific css -->
    <link rel="stylesheet" href="{{ asset('ally-landing-assets/css/magnific-popup.css') }}">
    <!-- IconFont linea -->
    <link rel="stylesheet" href="{{ asset('ally-landing-assets/css/linea-basic.css') }}">
    <!-- IconFont pe-icon-7-stroke -->
    <link rel="stylesheet" href="{{ asset('ally-landing-assets/css/pe-icon-7-stroke.css') }}">
    <!-- Main style css -->
    <link rel="stylesheet" href="{{ asset('ally-landing-assets/css/main.css') }}">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('ally-landing-assets/css/responsive.css') }}"> 

    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai&display=swap" rel="stylesheet">


    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    
</head>

<body>

<div class="loading-screen">
    
    <div class="display-table">
        <div class="table-cell">
            <div class="spinner">

            </div>
        </div>
    
    </div>
    
</div>

<!-- header begin-->
@include('partials.landing-header')
<!-- header end -->


<section id="page" class="header-breadcrumb">   
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{ $heading }}</h1>
                
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('index') }}">Home</a>
                    </li>
                    <li><i class="fas fa-angle-right"></i></li>
                    <li>{{ $heading }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>


<!-- page begin-->
@yield('content')
<!-- page end -->

<!-- footer begin -->
@include('partials.landing-footer')
<!-- footer end -->

<div class="scroll-up">
    <i class="fas fa-angle-up"></i>
</div> 
    <!--==================================================================== 
                            End Section Content
    =====================================================================-->
   
    <!--====================================================================
                            Include All Js File 
     ====================================================================-->
     <!-- All Plugins -->
     <!--  jQuery js  -->
    <script src="{{ asset('ally-landing-assets/js/jquery-3.3.1.min.js') }}"></script>
    <!-- Popper Js  -->
    <script src="{{ asset('ally-landing-assets/js/popper.min.js') }}"></script>
    <!-- Bootstrap 4 Js  -->
    <script src="{{ asset('ally-landing-assets/js/bootstrap.min.js') }}"></script>
    <!-- OWL Carousel JS  -->
    <script src="{{ asset('ally-landing-assets/js/owl.carousel.min.js') }}"></script>
    <!-- filterizr JS file -->
    <script src="{{ asset('ally-landing-assets/js/jquery.filterizr.js') }}"></script>
    <!-- Magnific Popup JS  -->
    <script src="{{ asset('ally-landing-assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Counter To JS  -->
    <script src="{{ asset('ally-landing-assets/js/jquery.countTo.js') }}"></script>
    <!--  WOW Js  -->
    <script src="{{ asset('ally-landing-assets/js/wow.min.js') }}"></script>
    <!-- My Custom Js  -->
    <script src="{{ asset('ally-landing-assets/js/custom.js') }}"></script>


<!-- scroll top button begin -->
<div class="scroll-to-top">
    <a><i class="fas fa-long-arrow-alt-up"></i></a>
</div>
<!-- scroll top button end -->
</body>
</html>
