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
</head>

@include('partials.admin-navbar')
@include('partials.admin-sidebar')

@yield('content')

 <script src="{{asset('/asset/js/bundle.js?ver=2.2.0 ')}}"></script>
    <script src="{{asset('/asset/js/scripts.js?ver=2.2.0 ')}}"></script>
    <script src="{{asset('/asset/js/charts/chart-crypto.js?ver=2.2.0')}}"></script>
     <script src="{{asset('/asset/js/charts/gd-default.js?ver=2.2.0')}}"></script>
    <script src="{{asset('/asset/js/charts/gd-analytics.js?ver=2.2.0 ')}}"></script>
    <script src="{{asset('/asset/js/libs/jqvmap.js?ver=2.2.0 ')}}"></script>
   

    @yield('scripts')
</body>

</html>