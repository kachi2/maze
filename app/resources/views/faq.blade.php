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
                            <h3>FAQ</h3>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="#">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- Banner Area Ends -->
        <!-- Section FAQ Starts -->
           <div class="faq-area bg-color area-padding">
            <div class="container">
               <div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="section-headline text-center">
                            <h3>Most Frequently asked questions</h3>
                            <hr>
                       </div>
					</div>
				</div>
                <div class="row">
                    <!-- Start Column Start -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="company-faq">
                            <div class="faq-full">
								<div class="faq-details">
									<div class="panel-group" id="accordion">
										<!-- Panel Default -->
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="check-title">
													<a data-toggle="collapse" class="active" data-parent="#accordion" href="#check1">
														<span class="acc-icons"></span>HOW CAN I INVEST WITH ZENITHCAPITAL
													</a>
												</h4>
											</div>
											<div id="check1" class="panel-collapse collapse in">
												<div class="panel-body">
													     <p>To invest on our system, you must be a registered member . Once you are signed up, you can make your first deposit. You can login using the member username and password you receive when signup.</p>
								
												</div>
											</div>
										</div>
										<!-- End Panel Default -->
										<!-- Panel Default -->
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="check-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#check2">
														<span class="acc-icons"></span>I WISH TO INVEST WITH ZENITHCAPITAL BUT I DON'T HAVE AN ANY ECURRENCY ACCOUNT. WHAT SHOULD I DO?
													</a>
												</h4>
											</div>
											<div id="check2" class="panel-collapse collapse">
												<div class="panel-body">
													<p>
														You can open a free Bitcoin account here: www.coinbase.com
													</p>										
												</div>
											</div>
										</div>
										<!-- End Panel Default -->
										<!-- Panel Default -->
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="check-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#check3">
														<span class="acc-icons"></span>HOW CAN I WITHDRAW FUNDS? 
													</a>
												</h4>
											</div>
											<div id="check3" class="panel-collapse collapse ">
												<div class="panel-body">
													<p>
														Login to your account using your username and password and check the Withdrawal section.
													</p>	
												</div>
											</div>
										</div>
										<!-- End Panel Default -->	
										<!-- Panel Default -->
									
										<!-- End Panel Default -->
										<!-- Panel Default -->
										
										<!-- End Panel Default -->										
									</div>
								</div>
								<!-- End FAQ -->
							</div>
                        </div>
                    </div>
                    <!-- End Column -->
             
                    <!-- End Column -->
                </div>
            </div>
        </div>
        <!-- Section FAQ Ends -->
@include('partials.landing-footer')

@endsection
