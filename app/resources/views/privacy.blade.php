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
                            <h3>Privacy Policy</h3>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><i class="fa fa-angle-right"></i></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- End breadcumb Area -->
        <!-- about-area start -->
        
        <div class="about-area">
            <div class="container">
                <div class="row">
                    <!-- column end -->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="about-content">
							<h3>Privacy Policy</h3>
                            <p style="text-align:left">This Privacy Notice describes how Mazeoptions collects and processes your personal information through the Mazeoptions websites and applications that reference this Privacy Notice. Mazeoptions refers to an ecosystem comprising Mazeoptions websites (whose domain names include but are not limited to www.Mazeoptions.com/).
                                This Privacy Policy applies to all platforms, websites, and departments of Mazeoptions and Mazeoptions Operators. By using Mazeoptions Services, you are consenting to the collection, storage, processing and transfer of your personal information as described in this Privacy Policy.
                               </p>
                            <p style="font-weight:bold; text-align:left">What Personal Information does Mazeoptions collect and process? Why does Mazeoptions process my personal information ?</p>
                            <p style="text-align:left">Your information we collect includes the following</p>
                            <p style="text-align:left">mail address, name, gender,  home address, phone number, nationality, device ID, transactional information
                            </p>
                
                            <p style="font-weight:bold; text-align:left">Can Children Use Mazeoptions Services?</p>
                            <p style="text-align:left">Mazeoptions does not allow anyone under the age of 18 to use Mazeoptions Services.</p>
                               
                            <p style="font-weight:bold; text-align:left">What About Cookies and Other Identifiers?</p>
                            <p style=" text-align:left"> We use cookies and similar tools to enhance your user experience, provide our services, and understand how customers use our services so we can make improvements. Depending on applicable laws in the region you are located in, the cookie banner on your browser will tell you how to accept or refuse cookies.</p>
                          
                            <p style="font-weight:bold; text-align:left"> Does Mazeoptions Share My Personal Information?</p>
                            <p style=" text-align:left">Information about our users is an important part of our business and we are not in the business of selling our users' personal information to others.   Mazeoptions shares users' personal information only as described below and with the subsidiaries or affiliates of Mazeoptions that are either subject to this Privacy Notice or follow practices at least as protective as those described in this Privacy Notice..</p>
                          
                          
                            <p style="font-weight:bold; text-align:left">How Secure is My Information?.</p>
                            <p style="text-align:left">We design our systems with your security and privacy in mind.  We work to protect the security of your personal information during transmission by using encryption protocols and software.
                                We maintain physical, electronic and procedural safeguards in connection with the collection, storage and disclosure of your personal information. Our security procedures mean that we may ask you to verify your identity to protect you against unauthorised access to your account password. We recommend using a unique password for your Mazeoptions account that is not utilized for other online accounts and to sign off when you finish using a shared computer.</p>
                           
                                <p style="font-weight:bold; text-align:left">  What Rights Do I Have?</p>
                                <ol>
                                <li><strong> Right to access: </strong>you have the right to obtain confirmation that your Data are processed and to obtain a copy of it as well as certain information related to its processing</li>
                                    <li style="font-weight:bold;"><strong> Right to rectify:</strong> you can request the rectification of your Data which are inaccurate, and also add to it. You can also change your personal information in your Account at any time</li>
                                        <li style="font-weight:bold;"><strong> Right to delete:</strong> you can, in some cases, have your Data deleted</li>
                                            <li style="font-weight:bold;"><strong> Right to object: </strong>you can object, for reasons relating to your particular situation, to the processing of your Data. For instance, you have the right to object to commercial prospection</li>
                                            <li style="font-weight:bold;"><strong>Right to withdraw your consent:</strong> for processing requiring your consent, you have the right to withdraw your consent at any time. Exercising this right does not affect the lawfulness of the processing based on the consent given before the withdrawal of the latter;</li>
                            
                                        </ol> 
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
