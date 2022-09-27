      <body>
         <!-- Start Navbar Area -->
         <div class="navbar-area pakap-new-navbar-area">
            <div class="pakap-responsive-nav">
                <div class="container">
                    <div class="pakap-responsive-menu">
                        <div class="logo">
                            <a href="index.html"><img src="{{asset('/mobile/images/logo-hover.png')}}" width="70px" alt="logo"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pakap-nav">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light"> 
                        <a class="navbar-brand" href="{{route('index')}}"><img src="{{asset('/mobile/images/logo-hover.png')}}" width="100px" alt="logo"></a>
                        <div class="collapse navbar-collapse mean-menu">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a href="{{route('index')}}" class="nav-link active">Home</a>
                                  
                                </li>
                              
                                <li class="nav-item"><a href="{{route('about')}}" class="nav-link">About us</a></li>
                                <li class="nav-item"><a href="{{route('contact')}}" class="nav-link">Contact us</a></li>
                                <li class="nav-item"><a href="{{route('terms')}}" class="nav-link">Privacy</a></li>
                                {{-- <li class="nav-item"><a href="https://cryptonewsupdate24.com/"  target="_blank" class="nav-link">Blogs</a></li> --}}

                            </ul>
                            <div class="others-option">
                             <span> <a href="{{route('login')}}" style="font-size:14px; font-weight:bolder; color:blue"> LOGIN </a></span>   <span></span>  &nbsp;  <a href="{{route('register')}}" class="default-btn">Get Starterd</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>