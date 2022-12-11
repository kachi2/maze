<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Mazeoptions Capital">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="keywords" content="crypto, Trading, Cryptocurrency, Cryptocurrency Trading, Investments, Trading comapany, Brokers, Bitcoin, Bitcoin trading">
    <meta name="description" content="{{config('app.name')}} is a highly trusted crypto Trading comapany, helping millions of individuals and firms across the globe to safely Trade and earn more with crypto currency.">
 <!-- Fav Icon  -->
 <link rel="icon" href="{{asset('/mobile/images/favicon.png')}}" type="image/png" sizes="16x16">
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
   
<!-- Smartsupp Live Chat script -->
<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
  var _smartsupp = _smartsupp || {};
  _smartsupp.key = '083302cfd8f6e17040e981b3e09637a72b5f551b';
  window.smartsupp||(function(d) {
    var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
    s=d.getElementsByTagName('script')[0];c=d.createElement('script');
    c.type='text/javascript';c.charset='utf-8';c.async=true;
    c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
  })(document);
  </script>
    @yield('scripts')
</html>