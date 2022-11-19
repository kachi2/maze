@mobile
<!DOCTYPE html>
<html lang="zxx">
<head>
        <meta charset="utf-8">
        <meta name="description" content="Oban">
        <meta name="keywords" content="">
        <meta name="author" content="HiBootstrap">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
        <meta name="keywords" content="crypto, Trading, Cryptocurrency, Cryptocurrency Trading, Investments, Trading comapany, Brokers, Bitcoin, Bitcoin trading">
        <meta name="description" content="Mazeoptions is a highly trusted crypto Trading comapany, helping millions of individuals and firms across the globe to safely Trade and earn more with crypto currency.">
        <meta name="google-site-verification" content="google-site-verification=AwsJpw69QHn5NcP8hJK1Cnzn-SFq3xnnkcGGCtmQ88k" />
        <title> @if(isset($title)) {{$title}} @else Home  @endif | {{config('app.name')}}</title>
        <link rel="icon" href="{{asset('/mobile/images/favicon.png')}}" type="image/png" sizes="16x16">
        <!-- bootstrap css -->
        <link rel="stylesheet" href="{{asset('/mobile/css/bootstrap.min.css')}}" type="text/css" media="all" />
        <!-- animate css -->
        <link rel="stylesheet" href="{{asset('/mobile/css/animate.min.css')}}" type="text/css" media="all" />
        <!-- owl carousel css -->
        <link rel="stylesheet" href="{{asset('/mobile/css/owl.carousel.min.css')}}"  type="text/css" media="all" />
        <link rel="stylesheet" href="{{asset('/mobile/css/owl.theme.default.min.css')}}"  type="text/css" media="all" />
        <!-- boxicons css -->
        <link rel='stylesheet' href="{{asset('/mobile/css/icofont.min.css')}}" type="text/css" media="all" />
        <!-- flaticon css -->
        <link rel='stylesheet' href="{{asset('/mobile/css/flaticon.css')}}" type="text/css" media="all" />
        <!-- style css -->
        <link rel="stylesheet" href="{{asset('/mobile/css/style.css')}}" type="text/css" media="all" />
        <!-- responsive css -->
        <link rel="stylesheet" href="{{asset('/mobile/css/responsive.css')}}" type="text/css" media="all" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
      
         <!--[if IE]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <link rel="manifest" href="manifest.json">
        <script>
       if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('serviceworker.js', {
            scope: '.'
        }).then(function (registration) {
            // Registration was successful
            console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
        }, function (err) {
            // registration failed :(
            console.log('Laravel PWA: ServiceWorker registration failed: ', err);
        });
    }
        </script>
       
    </head>
<div class="body-content">
    <div class="container">
        <!-- Error-page-section -->
        <section class="error-page-section pb-15">
            <div class="container">
                <div class="error-page-content">
                    <img src="{{asset('/mobile/images/404.png')}}" alt="404">
                    <h2> Error Occured</h2>
                    <p>Seems this page is down</p>
                    <a href="{{route('home')}}" class="btn main-btn">Go To Homepage</a>
                </div>
            </div>
        </section>
        <!-- Error-page-section -->
    </div>
</div>

<script src="{{asset('/mobile/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('/mobile/js/bootstrap.bundle.min.js')}}"></script>
<!-- owl carousel js -->
<script src="{{asset('/mobile/js/owl.carousel.min.js')}}"></script>
<!-- form ajazchimp js -->
<script src="{{asset('/mobile/js/jquery.ajaxchimp.min.js')}}"></script>
<!-- form validator js  -->
<script src="{{asset('/mobile/js/form-validator.min.js')}}"></script>
<!-- contact form js -->
<script src="{{asset('/mobile/js/contact-form-script.js')}}"></script>
<!-- main js -->
<script src="{{asset('/mobile/js/script.js')}}"></script> 

@stack('scripts')

</body>
</html>

@elsemobile


<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content=".">
    <!-- Fav Icon  -->
       <link rel="shortcut icon" href="{{asset('/fav.png')}}">
    <!-- Page Title  -->
    <title>Errors | 500</title>
    <!-- StyleSheets  -->
      <link rel="stylesheet" href="{{asset('/asset/css/dashlite.css?ver=2.2.0')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('/asset/css/theme.css?ver=2.2.0')}}">
</head>

<body class="nk-body bg-white npc-general pg-error">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle wide-xs mx-auto">
                        <div class="nk-block-content nk-error-ld text-center">
                            <h3 class="nk-error-title">Error Occured</h3>
                            <h3 class="nk-error-title">Opps!, Seems this page is down</h3>
                            <a href="{{route('web.home')}}" class="btn btn-lg btn-success mt-2">Back To Home</a>
                        </div>
                    </div><!-- .nk-block -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
   <script src="{{asset('/asset/bundle.js?ver=2.2.0')}}"></script>
    <script src="{{asset('/asset/scripts.js?ver=2.2.0')}}"></script>

</html>

@endmobile