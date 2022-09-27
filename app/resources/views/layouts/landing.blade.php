<!doctype html>
<html class="no-js" lang="en">
<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		  <title>
        @section('title')
            {{ $page_title? $page_title:  config('app.name')  }}
        @show 
    </title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-230119602-1">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-230119602-1');
</script>
		 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=10;IE=edge">
    <meta name="keywords" content="crypto, Trading, Cryptocurrency, Cryptocurrency Trading, Investments, Trading comapany, Brokers, Bitcoin, Bitcoin trading">
    <meta name="description" content="{{config('app.name')}} is a highly trusted crypto Trading comapany, helping millions of individuals and firms across the globe to safely Trade and earn more with crypto currency.">
<meta name="google-site-verification" content="_cvnv3B2JCbGPq6_kmNxoIa_CisW_8P8S96-Bh2nN4Q" />
<link rel="icon" href="{{asset('/mobile/images/favicon.png')}}" type="image/png" sizes="16x16">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{asset('/frontend_assets/css/bootstrap.min.css')}}" />
      <link rel="stylesheet" href="{{asset('/frontend_assets/assets/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{asset('/frontend_assets/assets/css/aos.css')}}">
      <link rel="stylesheet" href="{{asset('/frontend_assets/assets/css/all.min.css')}}">
      <link rel="stylesheet" href="{{asset('/frontend_assets/assets/css/odometer.min.css')}}">
      <link rel="stylesheet" href="{{asset('/frontend_assets/assets/css/remixicon.css')}}">
      <link rel="stylesheet" href="{{asset('/frontend_assets/assets/css/magnific-popup.min.css')}}">
      <link rel="stylesheet" href="{{asset('/frontend_assets/assets/css/meanmenu.min.css')}}">
      <link rel="stylesheet" href="{{asset('/frontend_assets/assets/css/swiper-bundle.min.css')}}">
      <link rel="stylesheet" href="{{asset('/frontend_assets/assets/css/owl.carousel.min.css')}}">
      <link rel="stylesheet" href="{{asset('/frontend_assets/assets/css/owl.theme.default.min.css')}}">
      <link rel="stylesheet" href="{{asset('/frontend_assets/assets/css/style.css')}}">
      <style type="text/css">
 
 /*google translate Dropdown */
 
 #google_translate_element select{
 background:#f6edfd;
 color:#383ffa;
 border: none;
 border-radius:3px;
 padding: 3px;
 margin: 2px 2px 2px 8px;
 }
 
 /*google translate link | logo */
   .goog-logo-link{
   display:none!important;
   }
 .goog-te-gadget{
 color:transparent!important;
 }
 
 /* google translate banner-frame */
 
 .goog-te-banner-frame{
 display:none !important;
 }
 
 #goog-gt-tt, .goog-te-balloon-frame{display: none !important;}
.goog-text-highlight { background: none !important; box-shadow: none !important;}
 
 body{top:0!important;}
   </style>

   <script>
 function googleTranslateElementInit() {
 new google.translate.TranslateElement({
 pageLanguage: 'en',
 autoDisplay: 'true',
 layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
 }, 'google_translate_element');
 }
 </script>
 <script src='//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit'></script>

	</head>
		<body>
      @include('partials.landing-header') 
        @yield('content')
        @include('partials.landing-footer')
        @stack('scripts')
		<!-- all js here -->

		<!-- jquery latest version -->
    <script src="{{asset('/frontend_assets/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('/frontend_assets/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/frontend_assets/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('/frontend_assets/assets/js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('/frontend_assets/assets/js/magnific-popup.min.js')}}"></script>
    <script src="{{asset('/frontend_assets/assets/js/meanmenu.min.js')}}"></script>
    <script src="{{asset('/frontend_assets/assets/js/appear.min.js')}}"></script>
    <script src="{{asset('/frontend_assets/assets/js/odometer.min.js')}}"></script>
    <script src="{{asset('/frontend_assets/assets/js/form-validator.min.js')}}"></script>
    <script src="{{asset('/frontend_assets/assets/js/contact-form-script.js')}}"></script>
    <script src="{{asset('/frontend_assets/assets/js/ajaxchimp.min.js')}}"></script>
    <script src="{{asset('/frontend_assets/assets/js/aos.js')}}"></script>
    <script src="{{asset('/frontend_assets/assets/js/main.js')}}"></script>

<!--Start of Tawk.to Script-->

 <!--Start of Tawk.to Script-->

  <!--End of Tawk.to Script-->
<!--End of Tawk.to Script-->	</body>
</html>