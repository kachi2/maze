<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Zenith Capital">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="keywords" content="crypto, Trading, Cryptocurrency, Cryptocurrency Trading, Investments, Trading comapany, Brokers, Bitcoin, Bitcoin trading">
    <meta name="description" content="{{config('app.name')}} is a highly trusted crypto Trading comapany, helping millions of individuals and firms across the globe to safely Trade and earn more with crypto currency.">
 <!-- Fav Icon  -->
    <link rel="shortcut icon" href="/fav.png">
    <!-- Page Title  -->
    <title> @if(isset($title)) {{$title}} @else Home  @endif | {{config('app.name')}}</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{asset('/asset/css/dashlite.css?ver=2.2.0 ')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('/assets/css/theme.css?ver=2.2.0 ')}}">
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

@include('partials.navbar')
@include('partials.sidebar')

@yield('content')

 <script src="{{asset('/asset/js/bundle.js?ver=2.2.0 ')}}"></script>
    <script src="{{asset('/asset/js/scripts.js?ver=2.2.0 ')}}"></script>
    <script src="{{asset('/asset/js/charts/chart-crypto.js?ver=2.2.0')}}"></script>
     <script src="{{asset('/asset/js/charts/gd-default.js?ver=2.2.0')}}"></script>
    <script src="{{asset('/asset/js/charts/gd-analytics.js?ver=2.2.0 ')}}"></script>
    <script src="{{asset('/asset/js/libs/jqvmap.js?ver=2.2.0 ')}}"></script>
   

    @yield('scripts')
 <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/61e72346b84f7301d32bb46b/1fpne3jo7';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
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


  <!--End of Tawk.to Script-->
<!--End of Tawk.to Script-->
</html>