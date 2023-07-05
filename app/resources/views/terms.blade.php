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
                            We at Mazeoptions assumes this risk making it more safe for you to trade with us </p> </div>
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
                             <p style="text-align:left">If the company receives payment for an order that has already expired, the company reserves the right to recalculate the Bitcoin to USDT exchange rate at the time of processing the transfer to the customer. This may result in the customer receiving less bitcoins or USDT than the original ordered amount</p>
                              
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
                         <p style="text-align:left">The following Choice of Law provision (the "Provision") shall govern any disputes or controversies arising out of or relating to the investment company named "MazeOptions", its operation, or any agreements, contracts, or transactions associated with the Company:

                            <strong> Governing Law:</strong> This Provision shall be governed by and construed in accordance with the laws of the jurisdiction specified below. <br>
                            <strong>  Jurisdiction: </strong> Any dispute, claim, or controversy arising out of or relating to the Company, its operation, or any agreements, contracts, or transactions associated with the Company shall be subject to the exclusive jurisdiction of the courts of the jurisdiction specified below. <br>
                            <strong>  Choice of Law: </strong> The laws shall govern the interpretation, validity, and enforcement of this Provision, as well as any disputes or controversies arising from or in connection with the Company and its operations. <br>
                            <strong> Exclusive Jurisdiction:  </strong> legal action, suit, or proceeding arising out of or relating to the Company, its operation, or any agreements, contracts, or transactions associated with the Company shall be instituted exclusively in the courts. Each party irrevocably submits to the exclusive jurisdiction of such courts in any such action, suit, or proceeding. <br>
                            <strong> Waiver of Other Jurisdictions: </strong> The parties agree to waive any objection to the jurisdiction of the courts as described in this Provision and agree not to seek a transfer or removal of any such action, suit, or proceeding to any other jurisdiction. <br>
                            <strong> Entire Agreement: </strong> This Provision constitutes the entire agreement between the parties regarding the choice of law and jurisdiction governing any disputes or controversies arising from or in connection with the Company, its operation, or any agreements, contracts, or transactions associated with the Company and supersedes any prior agreements or understandings, whether written or oral, relating to the same.
                            By participating in or engaging with the Company, all parties agree to be bound by this Choice of Law Provision and acknowledge that any disputes or controversies shall be subject to the laws and jurisdiction specified herein..</p>
                              
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
