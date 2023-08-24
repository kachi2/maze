@extends('layouts.landing', ['page_title' => 'Affiliates', 'heading' => 'Join Affiliates'])
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
                            <h3>Join the Mazeoptions <br> Affiliate Program</h3>
                            <br>
                            <ul>
                                <li style="font-size:18px">Monetize your traffic and earn crypto commissions 
                                    <br>when you share Mazeoptions with your audiences. 
                                    <br> You can earn commissions and special rewards on every referral
                                </li>
                               <br> 
                                
                            </ul>
                            <div class="p4"> 
                                 <a href="{{route('affiliates.register')}}"  style="width:15em; height:3em; margin-top:30px; background:#e9d16f; color:black" class="btn " >   Become an Affiliate</a></span>
                            </div>
                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    
    <section class="layout_padding">
        <div class="container">
           <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
           <h1 style="font-weight: 600">  How Does the Mazeoptions Affiliate Program Work?</h1> 
           <p style="float:left">Recommend Mazeoptions. Earn commission in crypto</p>
            </div>

              <div class="col-md-4 col-sm-6 col-xs-12 p-2">
                 <div class="full our_work_type">
                    <div class="left"><img width="50px"  height="10px" src="{{asset('/frontend_assets/images/f2.png')}}" alt="#" /></div>
                   
                    <div style="float: left">
                        <h4>Sign up to become an affiliate</h4>
                     </div>
                    <div style="float: left">
                     
                        Submit your application by filling the form below. Our team will evaluate your application and ensure you meet our affiliate criteria.
                       
                    </div>
                 </div>
                    <button style="width:10em; height:3em; border:0px; background:#e9d16f; color:black"> Submit Form</button>
            
                 
              </div>

              <div class="col-md-4 col-sm-6 col-xs-12 p-2">
                <div class="full our_work_type">
                   <div class="left"><img width="50px"  height="10px" src="{{asset('/frontend_assets/images/f3.png')}}" alt="#" /></div>
                  
                   <div style="float: left">
                       <h4>Create and share your affiliate link</h4>
                    </div>
                   <div style="float: left">
                    
                Create, manage and track the performance of your affiliate links right from your Mazeoptions account.
                      
                   </div>
                </div>
                   <button style="width:10em; height:3em; border:0px; background:#e9d16f; color:black"> Submit Form</button> 
             </div>

             <div class="col-md-4 col-sm-6 col-xs-12 p-2">
                <div class="full our_work_type">
                   <div class="left"><img width="50px"  height="10px" src="{{asset('/frontend_assets/images/f5.png')}}" alt="#" /></div>
                  
                   <div style="float: left">
                       <h4> Earn up to 20% commissions</h4>
                    </div>
                   <div style="float: left">
                   
                    When users create an account with your affiliate link, you’ll receive commission on every trade they make.
                      
                   </div>
                </div>
                   <button style="width:10em; height:3em; border:0px; background:#e9d16f; color:black"> Submit Form</button> 
             </div>


           </div>
           <div class="row">
              <div class="col-md-12">
                 <hr>
              </div>
           </div>
        </div>
     </section>



     <section class="" >
        <div class="container">
           <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
           <h1 style="font-weight: 600"> Mazeoptions Affiliate Program Commission Benefits</h1> 
           <p style="float:left">Recommend Mazeoptions. Earn commission in crypto</p>
            </div>

              <div class="col-md-4 col-sm-6 col-xs-12 p-2">
                    <button style="width:10em; height:3em; border:0px; background:#e9d16f; color:black"> Submit Form</button>
            
                 
              </div>

           



           </div>
           <div class="row">
              <div class="col-md-12">
                 <hr>
              </div>
           </div>
        </div>
     </section>
         
     <section class="">
        <div class="container" style="padding-top:20px">
           <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
           <h1 style="font-weight: 600">  Mazeoptions Affiliate Program Packages</h1> 
           <p style="float:left">Grow your affiliates and earn big</p>
            </div>

              <div class="col-md-12 col-sm-12 col-xs-12 p-2">
                <table class="table table-striped">
                    <thead>
                       <tr>
                          <th>Packages</th>
                          <th>Commissions</th>
                          <th>Number of Referrals</th>
                          <th>Notes</th>
                    
                       </tr>
                    </thead>
                    <tbody>
                   <tr>
                    <td>Starter</td>
                    <td>10%</td>
                    <td>1 - 10</td>
                    <td>You make 10% commission on each referral</td>
                   </tr>

                   <tr>
                    <td>Professional</td>
                    <td>20%</td>
                    <td>10 - 20</td>
                    <td>You make 20% commission on each referral</td>
                   </tr>

                   <tr>
                    <td>Premium</td>
                    <td>40%</td>
                    <td>20 - 1000</td>
                    <td>You make 40% commission on each referral</td>
                   </tr>
                     
                    </tbody>
                 </table>
                 
              </div>



           </div>
           <div class="row">
              <div class="col-md-12">
                 <hr>
              </div>
           </div>
        </div>
     </section>


     <section class="" style="padding-top:20px">
        <div class="container">
           <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
           <h1 style="font-weight: 600">  Additional Affiliate Program Benefits</h1> 
           <p style="float:left">We have alot more benefits for you</p>
            </div>

              <div class="col-md-3 col-sm-6 col-xs-12 p-2">
                 <div class="full our_work_type">
                    <div class="left"><img width="50px"  height="10px" src="{{asset('/frontend_assets/images/content.png')}}" alt="#" /></div>
                   
                    <div style="float: left">
                        <h4>Get More commissions</h4>
                     </div>
                    <div style="float: left">
                     
                        If the person you referred refers someone else, you will make commissions from both referrals
                       
                    </div>
                 </div>
                 
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12 p-2">
                <div class="full our_work_type">
                   <div class="left"><img width="50px"  height="10px" src="{{asset('/frontend_assets/images/f3.png')}}" alt="#" /></div>
                  
                   <div style="float: left">
                       <h4>More rewards</h4>
                    </div>
                   <div style="float: left">
                    
                    Earn a bonus reward of up to $5,000 every month based on the total fees paid by Futures referrals.
                      
                   </div>
                </div>
              </div>

             <div class="col-md-3 col-sm-6 col-xs-12 p-2">
                <div class="full our_work_type">
                   <div class="left"><img width="50px"  height="10px" src="{{asset('/frontend_assets/images/f5.png')}}" alt="#" /></div>
                  
                   <div style="float: left">
                       <h4> Convenient payments</h4>
                    </div>
                   <div style="float: left">
                   
                    Get paid for every first-time buyer, with no referral limit and a lifetime attribution for spot referrals.
                      
                   </div>
                </div>
            
             </div>

             <div class="col-md-3 col-sm-6 col-xs-12 p-2">
                <div class="full our_work_type">
                   <div class="left"><img width="50px"  height="10px" src="{{asset('/frontend_assets/images/f5.png')}}" alt="#" /></div>
                  
                   <div style="float: left">
                       <h4>Dedicated account manager</h4>
                    </div>
                   <div style="float: left">
                   
                    Gain access to professional support, tutorials, marketing material, and a dedicated Binance Affiliate manager.
                      
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


     <section class="">
        <div class="container">
            <div class="row">
                <!-- Start Column Start -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="section-headline text-left">
                        <h3>Affiliate FAQ</h3>
                        <hr>
                   </div>
                </div>
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
                                                    <span class="acc-icons"></span>What is the Mazeoptions Affiliate Program?
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="check1" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                     <p>The Mazeoptions Affiliate Program allows you to 
                                                        create unique referral links that invite your 
                                                        community to register and invest on Mazeoptions. 
                                                        If anyone clicks the link and registers, they’ll be 
                                                        automatically attributed as your referral. 
                                                        You’ll receive a commission on every 
                                                        trade they make.</p>
                            
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Panel Default -->
                                    <!-- Panel Default -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="check-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#check2">
                                                    <span class="acc-icons"></span>What are the requirements to be a Mazeoptions Affiliate?
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="check2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <p>
                                                    <ul>
                                                   <li>  You must be a register user on Mazeoptions. </li>
                                                   <li>  You must be above 16+ years old  </li>
                                                   <li>  Must have a means of identification (IDs) </li>
                                                </ul>
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
                                                    <span class="acc-icons"></span>HOW CAN I GET PAID 
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="check3" class="panel-collapse collapse ">
                                            <div class="panel-body">
                                                <p>
                                                 You wallet balance will always be displayed on your account dashboard, you can withdraw using any crypto wallet of your choice
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
     </section>
        <!-- End breadcumb Area -->
        <!-- about-area start -->
@include('partials.landing-footer')
@endsection
