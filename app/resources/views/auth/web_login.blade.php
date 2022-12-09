
@desktop
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
    <title>Mazeoptions | Register</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{asset('/asset/css/dashlite.css?ver=2.2.0 ')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('/assets/css/theme.css?ver=2.2.0 ')}}">
</head>

<body class="nk-body ui-rounder npc-default pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="" class="logo-link">
                                <img class="logo-light logo-img" src="{{asset('/logo.png')}}" srcset="{{asset('/logo.png')}} 2x" alt="logo">
                                <img class="logo-dark logo-img" src="{{asset('/logo.png')}}" srcset="{{asset('/logo.png')}} 2x" alt="logo-dark">
                            </a>
                        </div>
                       
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Login</h4>
                                        <div class="nk-block-des">
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                          
                                <form class="text-left" method="post" action="{{ route('web.login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email</label>
                                        </div>
                                        <input type="text" name="email" value="{{old('email')}}" class="form-control form-control-lg {{ form_invalid('email') }}" id="default-01" placeholder="Enter your email address">
                                        @showError('email')
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Password</label>
                                          
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                               
                                            </a>
                                            <input type="password" name="password" class="form-control form-control-lg {{ form_invalid('password') }}" id="password" placeholder="Enter your pasword">
                                            @showError('password')
                                        </div>
                                    </div>
                                    @if(Session::has('error_msg'))
                                  <p> <span class="alert alert-danger"> {{Session::get('error_msg')}} </span></p> 
                                    @endif
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Login</button>
                                    </div>
                                </form>
                                <div class="authentication-account-access-item">
                                    <div class="authentication-link">
                                        @if (Route::has('password.request'))
                                        <a class="link link-primary link-sm" tabindex="-1" href="{{ route('password.request') }}">Forgot Password?</a>
                                        @endif</div>
                                </div>
                                <div class="form-note-s2 text-center pt-4"> Don't have account? <a href="{{route('web.register')}}">Create an account</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6 order-lg-last">
                                    <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('terms')}}">Terms & Condition</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('about')}}">About Us</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('contact')}}">Contact Us</a>
                                        </li>
                                        <li class="nav-item dropup">
                                            <a class="dropdown-toggle nav-link" data-toggle="dropdown" data-offset="0,10"><span>English</span></a>
                                            <div class="dropdown-menu dropdown-menu-sm">
                                                <ul class="language-list">
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="" alt="" class="language-flag">
                                                            <span class="language-name">English</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">&copy; 2019 - 2022 Mazeoptions. All Rights Reserverd</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{asset('/asset/js/bundle.js?ver=2.2.0 ')}}"></script>
    <script src="{{asset('/asset/js/scripts.js?ver=2.2.0 ')}}"></script>

</html>
<!-- Smartsupp Live Chat script -->
<script src="//code.jivosite.com/widget/xEjM0sdDkF" async></script>
@elsedesktop
@include('auth.login')
@enddesktop