@extends('layouts.landing', ['page_title' => 'Home', 'heading' => 'Home'])
@section('content')
  @include('partials.landing-header') 
   <section id="main-content" class="">
         <div id="demos">
            <h2 style="display:none;">heading</h2>
            <div id="carouselTicker" class="carouselTicker">
               <ul class="carouselTicker__list">
               @if(count($coins) > 0)
               @foreach ($coins as  $coin )
                  <li class="carouselTicker__item">
                     <div class="coin_info">
                        <div class="inner">
                           <div class="coin_name">
                              {{$coin['name']}}
                              @if($coin['market_cap_change_percentage_24h'] > 0)
                              <span class="update_change_plus">{{$coin['market_cap_change_percentage_24h']}}</span>
                              @else
                              <span class="update_change_minus">{{$coin['market_cap_change_percentage_24h']}}</span>
                              @endif
                           </div>
                           <div class="coin_price">
                             ${{number_format($coin['current_price'],2)}}
                             @if($coin['price_change_24h'] > 0) 
                             <span class="scsl__change_plus" style="color:lightgreen">{{$coin['price_change_24h']}}%</span>
                             @else
                             <span class="scsl__change_minus">{{$coin['price_change_24h']}}%</span>
                             @endif
                           </div>
                           <div class="coin_time">
                              ${{$coin['market_cap']}}
                           </div>
                        </div>
                     </div>
                  </li>  
               @endforeach
               @endif
               </ul>
            </div>
         </div>
      </section>
      <!-- market value slider end -->
      <!-- full slider parallax section -->
      <section id="full_slider" class="full_slider_inner padding_0">
         <div class="main_slider">
            <div id="bootstrap-touch-slider" class="carousel bs-slider slide  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000">
               <!-- Wrapper For Slides -->
               <div class="carousel-inner" role="listbox">
                  <!-- first Slide -->
                  <div class="item active">
                     <!-- Slide Background -->
                     <img src="{{asset('/frontend_assets/images/slider_img1.png')}}" alt="mazeoptions.com slider" class="slide-image"/>
                          
                     <div class="container">
                        <div class="row">
                            
                           <!-- Slide Text Layer -->
                           <div class="slide-text slide_style_left white_fonts">
                              <h2 data-animation="animated">Secured  and <span style="color: #e9d16f;"> Easy </span><br> Way to <span style="color: #e9d16f;"> Trade  </span><br> <span style="color: #e9d16f;">Crytocurrency</span></h2>
                              <a href="{{route('register')}}" class="btn btn-default active">Get started</a>
                                <span > <img style="margin-top:-30%; margin-left:48%; width:70%" src="{{asset('/images.png')}}"  ></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="item">
                     <!-- Slide Background -->
                     <img src="{{asset('/frontend_assets/images/slider_img1.png')}}" alt="Bootstrap Touch Slider" class="slide-image" />
                     <div class="container">
                        <div class="row">
                           <!-- Slide Text Layer -->
                           <div class="slide-text slide_style_left white_fonts">
                              <h2 data-animation="animated">Crypto <span style="color: #e9d16f;">Trading</span><br> Platform You can  <br><span style="color: #e9d16f;">Trust</span> Always</h2>
                              <a href="{{route('register')}}" class="btn btn-default active">Get started</a>
                               <span > <img style="margin-top:-30%; margin-left:48%; width:70%" src="{{asset('/ima.png')}}"  ></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- second of Slide -->
               </div>
               <!-- End of Wrapper For Slides -->
               <!-- Left Control -->
               <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
               <span class="fa fa-angle-left" aria-hidden="true"></span>
               <span class="sr-only">Previous</span>
               </a>
               <!-- Right Control -->
               <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
               <span class="fa fa-angle-right" aria-hidden="true"></span>
               <span class="sr-only">Next</span>
               </a>
            </div> 
            <!-- End  bootstrap-touch-slider Slider -->
         </div>
      </section>

      
       <section class="layout_padding">
         <div class="container">
            <div class="row">
            
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="full our_work_type">
                     <div class="center"><img src="{{asset('/frontend_assets/images/icon_1_b.png')}}" alt="#" /></div>
                     <div class="center">
                        <h4>Instant Trading</h4>
                     </div>
                     <div class="center">
                        <p>Very simple and easy to use</p>
                     </div>
                  </div>
               </div>
               
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="full our_work_type">
                     <div class="center"><img src="{{asset('/frontend_assets/images/icon_2_b.png')}}" alt="#" /></div>
                     <div class="center">
                        <h4>No Hidden Fees</h4>
                     </div>
                     <div class="center">
                        <p>We are operating a clearly 100% transparent system.</p>
                     </div>
                  </div>
               </div>
               
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="full our_work_type">
                     <div class="center"><img src="{{asset('/frontend_assets/images/icon_4_b.png')}}" alt="#" /></div>
                     <div class="center">
                        <h4>Secured and 24/7 Uptime</h4>
                     </div>
                     <div class="center">
                        <p>Your privacy is our top priority.</p>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="full our_work_type">
                     <div class="center"><img src="{{asset('/frontend_assets/images/icon_1_b.png')}}" alt="#" /></div>
                     <div class="center">
                        <h4>24/7 Customer Care Support</h4>
                     </div>
                     <div class="center">
                        <p>We are always here to assist you.</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <hr>
               </div>
            </div>
         </div>
      </section>
      <!-- end section -->
       <section class="layout_padding dark_bg">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="full">
                     <div class="heading_main">
                        <h2><span>Our Pricing Plan</span></h2>
                        <p>Choose a plan that fits your lifestyle</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
             @foreach($packages as $package)
            @foreach($package->plans as $plan)
               <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="full">
                     <div class="coin_selling_bt">
                        <ul>
                           <li><a class="active" href="#">{{ $plan->name }}</a></li>
                           
                        </ul>
                        <div class="coin_price_table">
                           <h4 style="color:#fff"> {{$package->plans[0]->profit.'%'}} {{$package->formatted_payment_period}} for {{$package->formatted_duration}}</h4>
                             <p>Min Investment: {{ moneyFormat($plan->min_deposit, 'USD') }}</p>
                           <p>MaxInvestment: {{ moneyFormat($plan->max_deposit, 'USD') }}</p>
                           <div class="center">
                              <a class="pay_btn" href="{{route('register')}}">Buy Now</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
               @endforeach
            </div>
         </div>
      </section>
      
      <section class="layout_padding ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="full">
                        <h6 class="heading_style2">Fast and Reliable withdrawal System</h6>
                        <hr>
                        <h3 class="">Withdrawals are 100% automated, you can withdraw anytime, any day you desires. </h3>
                     </div>
                </div>
                 <div class="col-md-6 col-sm-12 col-xs-12">
                 <img src="{{asset('/imas.png')}}" style=" width:100%">
                 </div>
            </div>
        </div>
    </section> 
           <hr style="background:#000; height:20px">
        
      <section class="layout_padding ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="full">
                        <h6 class="heading_style2"> 100% transparent system</h6>
                        <hr>
                        <h3 class="">You can cleary monitor your daily payouts, our system is trusted by over 5000 investors across the globe</h3>
                     </div>
                </div>
                 <div class="col-md-6 col-sm-12 col-xs-12">
                  <img src="{{asset('/pays.png')}}" style=" width:100%">
                 </div>
            </div>
        </div>
    </section>
      <!-- section -->
      <section class="layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="full">
                     <div class="heading_main">
                        <h2><span>Crypto Live Exchange Rates</span></h2>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="full table-responsive">
                     <table class="table table-striped">
                        <thead>
                           <tr>
                              <th>Symbol</th>
                              <th>Name</th>
                              <th>USD</th>
                              <th>Change 1h</th>
                              <th>Change 12h</th>
                              <th>Change 24h</th>
                           </tr>
                        </thead>
                        <tbody>
                        @foreach ($coins as $cc )
                           <tr class="active_table">
                              <td>{{strtoupper($cc['symbol'])}}</td>
                              <td>{{$cc['name']}}</td>
                              <td>{{number_format($cc['current_price'])}}</td>
                            @if($cc['price_change_percentage_24h'] > 0)  <td style="color:lightgreen">{{$cc['price_change_percentage_24h']}}%</td> @else
                            <td style="color:red">{{$cc['price_change_percentage_24h']}}%</td>
                            @endif

                             @if($cc['market_cap_change_percentage_24h'] > 0)  <td style="color:lightgreen">{{$cc['market_cap_change_percentage_24h']}}%</td> @else
                            <td style="color:red">{{$cc['market_cap_change_percentage_24h']}}%</td>
                            @endif

                             @if($cc['market_cap_change_percentage_24h'] > 0)  <td style="color:lightgreen">{{$cc['market_cap_change_percentage_24h']}}%</td> @else
                            <td style="color:red">{{$cc['market_cap_change_percentage_24h']}}%</td>
                            @endif
                           </tr>
                          @endforeach
                         
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end section -->
      <!-- section -->
      
      <section class="layout_padding dark_bg white_fonts">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="full">
                     <div class="heading_main">
                        <h2><span>Why Choose Mazeoptions?</span></h2>
                        <p> Join the revolution and start earning</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row" style="margin-top:20px;">
               <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="full">
                     <div class="cryto_feature">
                        <ul>
                           <li>
                              <div class="pull-left"><img src="{{asset('/frontend_assets/images/f2.png')}}" alt="#" /></div>
                              <div>
                                 <h3>Seamless Transaction</h3>
                                 <p>Providing 24/7 server uptime</p>
                              </div>
                           </li>
                           <li>
                              <div class="pull-left"><img src="{{asset('/frontend_assets/images/f3.png')}}" alt="#" /></div>
                              <div>
                                 <h3>Secure and Stable</h3>
                                 <p>Our user data and digital assets are secure with fully data encryption</p>
                              </div>
                           </li>
                           <li>
                              <div class="pull-left"><img src="{{asset('/frontend_assets/images/f4.png')}}" alt="#" /></div>
                              <div>
                                 <h3>Amazing Returns</h3>
                                 <p>We work with professional Bitcoin analysts with years of experience in Bitcoin trading to bring more returns to your Trading.</p>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="full digital_earth">
                     <img src="{{asset('/frontend_assets/images/bg3_new.png')}}" alt="#" />
                  </div>
               </div>
               <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="full">
                     <div class="cryto_feature right_text">
                        <ul>
                           <li>
                              <div>
                                 <h3>Cost Efficiency</h3>
                                 <p>Reasonable trading fees for takers and all market makers</p>
                              </div>
                              <div class="pull-right"><img src="{{asset('/frontend_assets/images/f5.png')}}" alt="#" /></div>
                           </li>
                           <li>
                              <div>
                                 <h3>24/7 Trading</h3>
                                 <p>Our Team are available 24h/7 to attend to your request</p>
                              </div>
                              <div class="pull-right"><img src="{{asset('/frontend_assets/images/f6.png')}}" alt="#" /></div>
                           </li>
                           <li>
                              <div>
                                 <h3>Free Consulting</h3>
                                 <p>No matter what the issues is, your account can never be charged for support rendered</p>
                              </div>
                              <div class="pull-right"><img src="{{asset('/frontend_assets/images/f1.png')}}" alt="#" /></div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end section -->
      <!-- section -->
      <section class="layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="full">
                     <div class="heading_main">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-2 col-sm-12 col-xs-12"></div>
            </div>
         </div>
      </section>
  @include('partials.landing-footer')
@endsection


