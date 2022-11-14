@extends('layouts.landing', ['page_title' => 'About Us', 'heading' => 'About Us', 'sub_heading' => 'Enjoy real benefits and rewards on your accrue mining.'])
@section('content')
  @include('partials.landing-header') 
     <!-- Banner Area Starts -->
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
                            <h3>Terms & Conditions</h3>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- End breadcumb Area -->
        <!-- about-area start -->
        
        <div class="about-area" style="padding-top:20px">
            <div class="container">
                <div class="row">
                    <!-- column end -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="about-content">
							<h3>Risk Notice</h3>
                            <p style="text-align:left">Cryptocurrencies is a not backed or value guaranteed by any financial institution; when purchasing coins the customer assumes all risk the coins may become worthless in value.
                            We at Acrabuscapital assumes this risk making it more safe for you to trade with us </p> </div>
                    </div>
                    <!-- column end -->
                </div>
            </div>
        </div>
  <div class="about-area ">
            <div class="container">
                <div class="row">
                   
                    <!-- column end -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="about-content">
							<h3>Severability</h3>
                             <p style="text-align:left">In the event any court shall declare any section or sections of this Agreement invalid or void, such declaration shall not invalidate the entire Agreement and all other paragraphs of the Agreement shall remain in full force and effect.</p>
                              
                        </div>
                    </div>
                    <!-- column end -->
                </div>
            </div>
        </div>

         <div class="about-area">
            <div class="container">
                <div class="row">
                   
                    <!-- column end -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="about-content">
							<h3>Customer input errors</h3>
                             <p style="text-align:left">It is the sole responsibility of the customer to check the accuracy of information entered and saved on the website. Account details displayed on the order summary webpage will be the final transfer destination. In the case that this information is incorrect, and funds are transferred to an unintended destination, the company shall not reimburse the customer and shall not transfer additional funds. As such customers must ensure the Bitcoin address and bank information they enter is completely correct.</p>
                              
                        </div>
                    </div>
                    <!-- column end -->
                </div>
            </div>
        </div>

        <div class="about-area ">
            <div class="container">
                <div class="row">
                   
                    <!-- column end -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="about-content">
							<h3>Binding Agreement</h3>
                             <p style="text-align:left">The terms and provisions of this Agreement are binding upon Your heirs, successors, assigns, and other representatives. This Agreement may be executed in counterparts, each of which shall be considered to be an original, but both of which constitute the same Agreement..</p>
                                                    
                        </div>
                    </div>
                    <!-- column end -->
                </div>
            </div>
        </div>

         <div class="about-area ">
            <div class="container">
                <div class="row">
                   
                    <!-- column end -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="about-content">
							<h3>Expired orders</h3>
                             <p style="text-align:left">If the company receives payment for an order that has already expired, the company reserves the right to recalculate the Bitcoin to Thai Baht exchange rate at the time of processing the transfer to the customer. This may result in the customer receiving less bitcoins or Thai Baht than the original ordered amount</p>
                              
                        </div>
                    </div>
                    <!-- column end -->
                </div>
            </div>
        </div>
         <div class="about-area ">
            <div class="container">
                <div class="row">
                   
                    <!-- column end -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="about-content">
							<h3>Choice of Law</h3>
                         <p style="text-align:left">This Agreement, and its application and interpretation, shall be governed exclusively by the laws of the State of Georgia, without regard to its conflict of law rules. You consent to the exclusive jurisdiction of the federal and state courts located in or near Atlanta, Georgia for any dispute arising under this Agreement.</p>
                              
                        </div>
                    </div>
                    <!-- column end -->
                </div>
            </div>
        </div>
        <!-- about-area end -->
        <!-- Start About Area -->
       
      
        <!-- facts Section Ends -->
  @include('partials.landing-footer')
@endsection
