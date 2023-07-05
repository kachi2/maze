<body id="default_theme" class="home_page_1">
      <!-- loader -->
      <div class="bg_load">
         <img class="loader_animation" src="{{asset('/fav.png')}}" alt="#" />
      </div>
      <!-- end loader -->
      <!-- header -->
      <header id="default_header" class="header_style_1">
         <div class="header_top">
            <div class="container">
               <div class="row">
                  <div class="col-md-7 col-sm-7 col-xs-12">
                     <div class="full">
                        <ul class="pull-left header_top_menu cutomer_ser">
                           <li><a href="mailto:info@mazeoptions.com"><i class="fa fa-life-ring" aria-hidden="true"></i> 24/7 Customer Support</a></li>
                           <li><a href="mailto:info@mazeoptions.com"><i class="fa fa-envelope"></i>info@mazeoptions.com</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-md-5 col-sm-5 col-xs-12">
                     <div class="full">
                        <ul class="pull-right header_top_menu user_login">
                           <li><a href="{{route('web.logins')}}"><i class="fa fa-sign-in"></i> Login</a></li>
                           <li ><a href="{{route('web.register')}}"><i class="fa fa-lock"></i> Register</a></li>
                          <div style="margin-right:5px"></div>
                           <div id='google_translate_element'></div>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="container">
            <div class="row">
               <div class="full">
                  <div class="col-md-2 col-sm-3 col-xs-12">
                     <!-- logo -->
                     <div class="logo">
                        <a href="{{route('index')}}"><img class="img-responsive" src="{{asset('/logo2.png')}}" alt="logo" /></a>
                     </div>
                     <!-- end logo -->
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                     <!-- menu -->
                     <div class="main_menu">
                        <div id="cssmenu" class="dark_menu">
                           <ul>
                              <li><a href="{{route('index')}}">Home</a></li>
                              <li><a href="{{route('about')}}">About Us</a></li>
                              {{-- <li><a href="{{route('faq')}}">FAQ</a></li> --}}
                              <li><a href="{{route('contact')}}">Contact Us</a></li>
                              <li><a href="{{route('terms')}}">Terms & Conditions</a></li>
                              <li><a href="{{route('privacy')}}">Privacy Policy</a></li>
                              <li><a href="{{route('web.logins')}} " style="border-radius:10px;">Login</a></li>
                              <li><a href="{{route('web.register')}}"  style="border-radius:10px;">Register</a></li>
                               
                           </ul>
                        </div>
                     </div>
                     <!-- end menu -->
                  </div>
                  
               </div>
            </div>
         </div>
      </header>