<!doctype html>
<html class="no-js" lang="en">
<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		  <title>
        @section('title')
            {{ config('app.name') }} {{ $page_title ? ' - ' . $page_title : '' }}
        @show
    </title>
		 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=10;IE=edge">
    <meta name="keywords" content="crypto, Trading, Cryptocurrency, Cryptocurrency Trading, Investments, Trading comapany, Brokers, Bitcoin, Bitcoin trading">
    <meta name="description" content="{{config('app.name')}} is a highly trusted crypto Trading comapany, helping millions of individuals and firms across the globe to safely Trade and earn more with crypto currency.">
<meta name="google-site-verification" content="_cvnv3B2JCbGPq6_kmNxoIa_CisW_8P8S96-Bh2nN4Q" />
<link rel="icon" href="{{asset('/fav.png')}}" type="image/gif" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{asset('/frontend_assets/css/bootstrap.min.css')}}" />
      <!-- Site CSS -->
      <link rel="stylesheet" href="{{asset('/frontend_assets/css/style.css')}}" />
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{asset('/frontend_assets/css/responsive.css')}}" />
      <!-- Colors CSS -->
      <link rel="stylesheet" href="{{asset('/frontend_assets/css/colors.css')}}" />
      <!-- Custom CSS -->
      <link rel="stylesheet" href="{{asset('/frontend_assets/css/custom.css')}}" />
      <!-- Counter CSS -->
      <link rel="stylesheet" href="{{asset('/frontend_assets/css/jquery.countdown.css')}}" />
      <!-- Wow Animation CSS -->
      <link rel="stylesheet" href="{{asset('/frontend_assets/css/animate.css')}}" />
      <!-- Market value slider CSS -->
      <link rel="stylesheet" type="text/css" href="{{asset('/frontend_assets/css/carouselTicker.css')}}" media="screen" />
      <link href="{{asset('/frontend_assets/animate.css/3.5.2/animate.min.css')}}" rel="stylesheet" media="all">
      
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

        @yield('content')
        @stack('scripts')
		<!-- all js here -->

		<!-- jquery latest version -->
		<script src="{{asset('/frontend_assets/js/jquery.min.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('/frontend_assets/js/custom.js')}}"></script>

<!--Start of Tawk.to Script-->
<!-- Smartsupp Live Chat script -->
<script src="//code.tidio.co/yh3vbqayz74780fs7d4h2tvjorz0zr7l.js" async></script>
 
<!--End of Tawk.to Script-->	</body>
</html>