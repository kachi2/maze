<!DOCTYPE html>
<html lang="zxx">
<head>
        <meta charset="utf-8">
        <meta name="description" content="Mazeoptions">
        <meta name="keywords" content="Crypto trading">
        <meta name="author" content="Mazeoptions">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
        <title></title>
        <link rel="icon" href="{{asset('/mobile/images/favicon.png')}}" type="image/png" sizes="16x16">
        <link rel="stylesheet" href="{{asset('/mobile/css/bootstrap.min.css')}}" type="text/css" media="all" />
        <link rel="stylesheet" href="{{asset('/mobile/css/animate.min.css')}}" type="text/css" media="all" />
        <link rel="stylesheet" href="{{asset('/mobile/css/owl.carousel.min.css')}}"  type="text/css" media="all" />
        <link rel="stylesheet" href="{{asset('/mobile/css/owl.theme.default.min.css')}}"  type="text/css" media="all" />
        <link rel='stylesheet' href="{{asset('/mobile/css/icofont.min.css')}}" type="text/css" media="all" />
        <link rel='stylesheet' href="{{asset('/mobile/css/flaticon.css')}}" type="text/css" media="all" />
        <link rel="stylesheet" href="{{asset('/mobile/css/style.css')}}" type="text/css" media="all" />
        <link rel="stylesheet" href="{{asset('/mobile/css/responsive.css')}}" type="text/css" media="all" />
        <link rel="manifest" href="manifest.json">
        <script type="text/javascript">
            if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceworker.js', {
            scope: '.'
        }).then(function (registration) {
            console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
        }, function (err) {
            // registration failed :(
            console.log('Laravel PWA: ServiceWorker registration failed: ', err);
        });
    }
        </script>
        <!--[if IE]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="preloader">
            <div class="preloader-wrapper">
                <div class="preloader-content">
                    <img src="{{asset('/mobile/images/preloader-logo.png')}}" alt="logo">
                </div>
            </div>
        </div>
        <div class="header-bg header-bg-1"></div>
        @yield('content')
        <script src="{{asset('/mobile/js/jquery-3.5.1.min.js')}}"></script>
        <script src="{{asset('/mobile/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('/mobile/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('/mobile/js/jquery.ajaxchimp.min.js')}}"></script>
        <script src="{{asset('/mobile/js/form-validator.min.js')}}"></script>
        <script src="{{asset('/mobile/js/contact-form-script.js')}}"></script>
        <script src="{{asset('/mobile/js/script.js')}}"></script>
<!-- Smartsupp Live Chat script -->
<script src="//code.jivosite.com/widget/xEjM0sdDkF" async></script>
    </body>
</html>