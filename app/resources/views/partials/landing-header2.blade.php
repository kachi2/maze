    <!-- Main Header-->
    <style type="text/css">
        
@media only screen and (max-width: 600px) {
    .mg-logo {
        margin-top: 10px;
    }
}


@media only screen and (min-width: 600px) {
    .mg-logo {
        margin-top: 10px;
    }
}


@media only screen and (min-width: 768px) {
    .mg-logo {
        margin-top: 60px;
    }
}


@media only screen and (min-width: 992px) {
    .mg-logo {
        margin-top: 60px;
    }
}


@media only screen and (min-width: 1200px) {
    .mg-logo {
        margin-top: 60px;
    }
}
    </style>
    <header class="main-header header-style-five five-alternate">
        
        
        <!--Header-Upper-->
        <div class="header-upper">
            <div class="auto-container">
                <div class="clearfix">
                    
                    <div class="pull-left logo-box">
                        <div class="logo"><a href="/"><img src="{{ asset('bitfarm-landing/images/bb.png') }}" alt="" style="width: 150px;" class="mg-logo"></a></div>
                    </div>
                    
                    <div class="nav-outer clearfix">
                    
                        <!-- Main Menu -->
                        <nav class="main-menu navbar-expand-md">
                            <div class="navbar-header">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="margin-top: 25px;">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li><a href="{{ route('index') }}">Home</a></li>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('faq') }}">FAQ</a></li>                                
                                @auth
                                    <li><a href="{{ route('home') }}">Dashboard</a></li>
                                @endauth
                                @guest
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li><a href="{{ route('register') }}">Register</a></li>
                                @endguest
                                </ul>
                            </div>
                            
                        </nav>
                                                
                        
                    </div>
                    
                </div>
            </div>
        </div>
        <!--End Header Upper-->
        
        <!--Sticky Header-->
        <div class="sticky-header">
            <div class="auto-container clearfix">
                <!--Logo-->
                <div class="logo pull-left">
                    <a href="/" class="img-responsive"><img src="{{ asset('bitfarm-landing/images/bb.png') }}" alt="" title="" style="margin-top: 100px !important;"></a>
                </div>
                
                <!--Right Col-->
                <div class="right-col pull-right">
                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-md">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        
                        <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent1">
                            <ul class="navigation clearfix">
                                <li><a href="{{ route('index') }}">Home</a></li>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('faq') }}">FAQ</a></li>                                
                                @auth
                                    <li><a href="{{ route('home') }}">Dashboard</a></li>
                                @endauth
                                @guest
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li><a href="{{ route('register') }}">Register</a></li>
                                @endguest
                            </ul>
                        </div>
                    </nav><!-- Main Menu End-->
                </div>
                
            </div>
        </div>
        <!--End Sticky Header-->
        
    </header>

    