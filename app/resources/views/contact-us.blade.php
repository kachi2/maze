@extends('layouts.landing', ['page_title' => 'About Us', 'heading' => 'About Us', 'sub_heading' => 'Enjoy real benefits and rewards on your accrue mining.'])
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
                            <h3>Contact Us</h3>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

          <section class="layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs">
                    <div class="full">
                        <div class="heading_main">
                            <h2><span>GET IN TOUCH</span></h2>
                            <p>We Provide High Quality Services</p>
                        </div>
                    </div>
                </div>
                <div class="contact_information">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 adress_cont">
                        <div class="information_bottom text_align_center">
                            <div class="icon_bottom">
                                <i class="fa fa-road" aria-hidden="true"></i>
                            </div>
                            <div class="info_cont">
                                <h4> ENGLAND, DN119QU </h4>
                                <p>1500 N LAMAR</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 adress_cont">
                        <div class="information_bottom text_align_center">
                            <div class="icon_bottom">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div>
                            <div class="info_cont">
                                <h4>Working Hours</h4>
                                <p>Mon-Sat 8:30am-6:30pm</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 adress_cont">
                        <div class="information_bottom text_align_center">
                            <div class="icon_bottom">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </div>
                            <div class="info_cont">
                                <h4>info@mazeoptions.com</h4>
                                <p>24/7 online support</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contact_form">
                    <div class="form_section">
                         <form class="form-contact" method="post" action="">
                         @csrf
                            <fieldset>
                                <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <input class="field_custom" name="firstname" id="firstname" placeholder="FIRST NAME"  type="text">
                                </div>
                                <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <input class="field_custom" name="lastname" id="lastname" placeholder="LAST NAME" type="text">
                                </div>
                                <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <input class="field_custom"name="email" id="email" placeholder="EMAIL" type="email">
                                </div>
                                <div class="field col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <input class="field_custom" name="text" id="subject" placeholder="SUBJECT" type="text">
                                </div>
                                <div class="field col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea class="field_custom"  id="message" name="message" placeholder="MESSAGE" required></textarea>
                                </div>
                                <div class="center"><button class="btn main_btn" >SUBMIT NOW</button></div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- End breadcumb Area -->
        <!-- about-area start -->
@include('partials.landing-footer')
@endsection
