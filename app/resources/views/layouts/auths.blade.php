<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="">
    <meta charset="utf-8">
      <meta name="author" content="Zenith Capital">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="keywords" content="crypto, Trading, Cryptocurrency, Cryptocurrency Trading, Investments, Trading comapany, Brokers, Bitcoin, Bitcoin trading">
    <meta name="description" content="{{config('app.name')}} is a highly trusted crypto Trading comapany, helping millions of individuals and firms across the globe to safely Trade and earn more with crypto currency.">
  <!-- Fav Icon  -->
 <link rel="shortcut icon" href="{{asset('/fav.png')}}">
    <!-- Page Title  -->
   <title>
        @section('title')
            {{ config('app.name') }} {{ isset($page_title) ? ' - ' . $page_title : '' }}
        @show
    </title>
    
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{asset('/asset/css/dashlite.css?ver=2.2.0')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('/asset/css/theme.css?ver=2.2.0')}}">
    
     
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
 
</head>

<body class="nk-body npc-crypto bg-white pg-auth">
    <!-- app body @s -->
   


    @yield('content')
    <!-- JavaScript -->
       <script src="{{asset('/asset/bundle.js?ver=2.2.0')}}"></script>
    <script src="{{asset('/asset/scripts.js?ver=2.2.0')}}"></script>
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

</body>

</html>