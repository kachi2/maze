<!DOCTYPE html>
<html lang="zxx">
<head>
        <meta charset="utf-8">
        <meta name="description" content="Oban">
        <meta name="keywords" content="HTML,CSS,JavaScript">
        <meta name="author" content="HiBootstrap">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
        <title></title>
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
        
        <!--[if IE]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>
        <!-- Preloader -->
        <div class="preloader">
            <div class="preloader-wrapper">
                <div class="preloader-content">
                    <img src="{{asset('/mobile/images/preloader-logo.png')}}" alt="logo">
                    <h3>Mazeoptions</h3>
                </div>
            </div>
        </div>
        <!-- Preloader -->

        <!-- Header-bg -->
        <div class="header-bg header-bg-1"></div>
        <!-- Header-bg -->

        <!-- Appbar -->
        <div class="fixed-top">
            <div class="appbar-area sticky-black">
                <div class="container">
                    <div class="appbar-container">
                        <div class="appbar-item appbar-actions">
                            <div class="appbar-action-item">
                              
                            </div>
                        </div>
                        <div class="appbar-item appbar-page-title mx-auto">
                            <h3>Reset Password</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Appbar -->
        
        <!-- Body-content -->
       
        <div class="body-content">
            <div class="container">
                <div style="padding-left:35%">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('logo.png') }}" alt="" width="80"/>                                            
                    </a>
                </div>
                <!-- Page-header -->

                <!-- Authentication-section -->
                <div style="height:50px"></div>
                <div class="authentication-form pb-15">
                    <form method="POST" action="{{ route('password.update') }}" class="authentication-form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group pb-15">
                            <label>Email</label>
                            <div class="input-group">
                                <input type="email" name="email"
                                value="{{ $email ?? old('email') }}"
                                class="form-control {{ form_invalid('email') }}"
                                id="InputEmail">
                         @showError('email')>
                                @showError('email')
                                 <span class="input-group-text"><i class="flaticon-user-picture"></i></span>
                            </div>
                        </div>
                        <div class="form-group pb-15">
                            <label>Password</label>
                            <div class="input-group">
                                <input  type="password"
                                value="{{ old('password') }}"
                                name="password"
                                class="form-control {{ form_invalid('password') }}"
                                id="InputPassword"
                                placeholder="Enter your password"
                                required>
                         @showError('password')>
                                <span class="input-group-text reveal">
                                    <i class="flaticon-invisible pass-close"></i>
                                    <i class="flaticon-visibility pass-view"></i>
                                </span>
                            </div>
                        </div>

                        <div class="form-group pb-15">
                            <label>Confirm Password</label>
                            <div class="input-group">
                                <input  type="password"
                                value="{{ old('password_confirmation') }}"
                                name="password_confirmation"
                                class="form-control {{ form_invalid('password_confirmation') }}"
                                id="InputPassword"
                                placeholder="Enter your password"
                                required>
                         @showError('password_confirmation')>
                        
                                <span class="input-group-text reveal">
                                    <i class="flaticon-invisible pass-close"></i>
                                    <i class="flaticon-visibility pass-view"></i>
                                </span>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
                    </form>
                    <div class="form-desc">Don’t have an account? <a href="{{route('register')}}">Sign Up Now!</a></div>
                </div>
                <!-- Authentication-section -->
            </div>
        </div>
        <!-- Body-content -->

       

    


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
      
    </body>
</html>