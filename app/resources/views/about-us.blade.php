
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
        <section id="inner_page_infor" class="innerpage_banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="full">
                        <div class="inner_page_info">
                            <h3>About Us</h3>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="#">About Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

      <section class="layout_padding ">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="full">
                        <h6 class="heading_style2">Looking for a First-Class Cryptocurrency Expert?</h6>
                        <p class="">mazeoptions.com is your partner for Trading online through our premium online brokerage. As a provider for online trading and investment services we offer you reliability that meets the highest standards.Mazeoptions offers you the entire spectrum of asset classes and financial instruments, including stocks, Indices, CFD’s, currencies and Cryptocurrencies. With more than 50 exchanges worldwide, more markets are now available to you than ever before.

Because that is important to us: that every investor - regardless of whether they are new or experienced traders - can find the right instrument for their investment</p>
                     </div>
                </div>
                 {{-- <div class="col-md-3 col-sm-12 col-xs-12">
                 <img src="{{asset('/frontend_assets/images/pr4.jpg')}}">
                 </div> --}}
            </div>
        </div>
    </section>

      <section class="layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="full">
                        <h6 class="heading_style2">EXCELLENT CUSTOMER SERVICE</h6>
                        <p class="left_text">Round-the-Clock Support.
                      <div style="padding-left:15px">  <ul style="list-style-type:circle">
                        <li  class="p-2"> 5 days a week and 24 hours a day easy accessibility by phone, email or live chat. Schedule a meeting with our trading professionals via our callback service.</li>
                         <li  class="p-2"> Our service is competent and certified. Experienced traders are available to answer your questions.</li>
                        <li  class="p-2"> Our staff will help you in a targeted manner even in tricky matters - if desired and required, for example by possible connection to your system.</li>
                        </ul>
                        </div>
                        </p>
                        <p class="left_text">Low Cost - Fair Trading Conditions and Transparency
                        <div style="padding-left:15px">  <ul style="list-style-type:circle">
                        <li  class="p-2"> Trade withMazeoptions at low costs.</li>
                         <li  class="p-2">We have received high customer satisfaction, among other things also thanks to the favorable Trading conditions..</li>
                        <li  class="p-2">The large product variety ofMazeoptions offers countless possibilities on the markets worldwide</li>
                        
                        </ul> </div>
                        </p></div>
                </div>
            </div>
        </div>
    </section>

  @include('partials.landing-footer')
@endsection


