
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
                        <p class="">Mazeoptions is a fully lincensed company, supervised by the UK Company House(GOV.UK) and Uk Financial Conduct Authority(FCA), with company number 13594472, providing a comprehensive investment services internationally. 

                            Mazeoptions work in the field of real estate and financing promising developments on cryptocurrency market with blockchain technology. According to experts, blockchain technologies currently have great opportunity. Lots of business ideas related to blockchain technologies become more successful and every day by day it bring high profits to their creator
                            
                            We track and analyze most business ideas. It allows us to get high profits. For our investor do not need to research independently in which project it is more profitable. So our investor can invest their capital and then receive an interest on the profit.
                            
                            We want to provide each client with the best trading opportunities in multiple trading sectors such as Forex, Shares, Commodities and/or Indices offering innumerable financial instruments. The beginners among investors will value pleasant and comprehensive trading environment of the MT5 platform that also includes highly-developed and interactive trading tools for professionals. Mazeoptions gives you special trading opportunities in a dynamic financial environment
                            
                            Investment
                            We invest in projects at an early stage, in particular, it can be business ideas, investing in startups at various stages of their development, ICO (Initial Coin Offering), IEO (Initial Exchange Offering).</div>
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


