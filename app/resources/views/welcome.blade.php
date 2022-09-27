@extends('layouts.landing',['page_title' => 'Home', 'heading' => 'Home'])
@section('content')

 <!-- Start New App Main Banner Wrap Area -->
 <div class="new-app-main-banner-wrap-area">
   <div class="container-fluid">
       <div class="row align-items-center">
           <div class="col-lg-6 col-md-12">
               <div class="new-app-main-banner-wrap-content">
                   <h1 style="font-size: 50px; font-weight:500">Deposit, Invest Cryptocurrencies and Earn Profits on Mazeoptions</h1>
                   <p></p>
                  
                   <div class="app-btn-box">
                       <a href="#" class="applestore-btn" target="_blank">
                           <img src="{{asset('/frontend_assets/assets/img/apple-store.png')}}" alt="image">
                           Available Soon
                           <span>Apple Store</span>
                       </a>

                       <a href="#" class="playstore-btn" target="_blank">
                           <img src="{{asset('/frontend_assets/assets/img/play-store.png')}}" alt="image">
                           Available Soon
                           <span>Google Play</span>
                       </a>
                   </div>
               </div>
           </div> 
           <div class="col-lg-6 col-md-12">
               <div class="new-app-main-banner-wrap-image" data-aos="fade-left" data-aos-duration="2000">
                   <img src="{{asset('/frontend_assets/assets/img/phone.png')}}" width="600px" alt="image">

                   <div class="wrap-image-shape-1">
                       <img src="{{asset('frontend_assets/assets/img/more-home/banner/shape-3.png')}}" alt="image">
                   </div>
                   <div class="wrap-image-shape-2">
                       <img src="{{asset('frontend_assets/assets/img/more-home/banner/shape-4.png')}}" alt="image">
                   </div>
                   <div class="banner-circle">
                       <img src="{{asset('frontend_assets/assets/img/more-home/banner/banner-circle.png')}}" alt="image">
                   </div>
               </div>
           </div>
       </div>
   </div>

   <div class="new-app-main-banner-wrap-shape">
       <img src="assets/img/more-home/banner/shape-5.png" alt="image">
   </div>
</div>
<!-- End New App Main Banner Wrap Area -->
<div class="features-area pt-100 pb-75">
   <div class="container">
       <div class="row align-items-center">
           <div class="col-lg-6 col-md-12">
               <div class="features-inner-content">
                   <span class="sub-title">Why Choose Us</span>
                   <h2>Most Probably Included Best Features Ever</h2>
                   <p>Here at Mazeoptions, we are committed to user protection with strict protocols and industry-leading technical measures.</p>
                   <div class="btn-box">
                     <a href="{{route('login')}}" class="default-btn">Get Started </a>
                 </div>
               </div>
           </div>
           <div class="col-lg-6 col-md-12 features-inner-list">
               <div class="row justify-content-center">
                   <div class="col-lg-6 col-sm-6">
                       <div class="features-inner-card">
                           <div class="icon">
                               <i class="ri-eye-line"></i>

                               <h3>Expertize Managment</h3>
                           </div>
                           <p>We understands that crypto investment is a highly risky business, our trained expertize and robot systems enable us to make decisions</p>
                       </div>
                   </div>

                   <div class="col-lg-6 col-sm-6">
                       <div class="features-inner-card with-box-shadow">
                           <div class="icon">
                               <i class="ri-stack-line"></i>
                               
                               <h3>Secured Investments</h3>
                           </div>
                           <p>Our user data and digital assets are secure stored in highly secured cloud system against DDoS attacks and our data are fully encrypted</p>
                       </div>
                   </div>

                   <div class="col-lg-6 col-sm-6">
                       <div class="features-inner-card with-box-shadow">
                           <div class="icon">
                               <i class="ri-cloud-line"></i>
                               
                               <h3>Automated Withdrawals</h3>
                           </div>
                           <p>Your payouts are automatically sent to your wallet at the completion your compaign without human intervention.</p>
                       </div>
                   </div>

                   <div class="col-lg-6 col-sm-6">
                       <div class="features-inner-card">
                           <div class="icon">
                               <i class="ri-leaf-line"></i>
                               
                               <h3>Advanced Data Encryption</h3>
                           </div>
                           <p>Your transaction data is secured via end-to-end encryption, ensuring that only you have access to your personal information.</p>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
<!-- Start Features Area -->

<!-- End Features Area -->


<!-- Start App About Area -->
<div class="app-about-area pb-100">
   <div class="container">
       <div class="row align-items-center">
           <div class="col-lg-6 col-md-12">
               <div class="app-about-image">
                   <img src="{{asset('/frontend_assets/assets/img/front.png')}}" alt="{{asset('/frontend_assets/assets/img/phone.png')}}">
               </div>
           </div>

           <div class="col-lg-6 col-md-12">
               <div class="app-about-content">
                   <h2>Build your Investments portfolio</h2>
                   <p>Start your first investment with these easy steps.</p>
                   <ul class="list">
                       <li>
                           <div class="icon bg-3">
                               <i class="ri-award-line"></i>
                           </div>
                           <h3>Create an Account</h3>
                           <p>Most provabily best you can trust on it, just log in with your mail account from play store and using whatever you want for your business.</p>
                       </li>
                       <li>
                           <div class="icon bg-3">
                               <i class="ri-download-cloud-2-line"></i>
                           </div>
                           <h3>Fund your account</h3>
                           <p>Add funds to your crypto account to start investing crypto. You can add funds with a variety of payment methods.</p>
                       </li>
                       <li>
                        <div class="icon bg-3">
                            <i class="ri-download-cloud-2-line"></i>
                        </div>
                        <h3>Start Investing</h3>
                        <p>You're good to go! Buy crypto, set up recurring investments on your account.</p>
                    </li>
                   </ul>
                   <div class="btn-box">
                       <a href="{{route('register')}}" class="default-btn">Get Started</a>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
<!-- End App About Area -->



<!-- Start Gradient Funfacts Area -->
<div class="gradient-funfacts-area pt-100 pb-75">
   <div class="container">
       <div class="row justify-content-center">
           <div class="col-lg-3 col-sm-6 col-md-6">
               <div class="single-funfacts-card">
                   <p>Registered Users</p>
                   <h3><span class="odometer" data-count="20">00</span><span class="sign">K</span></h3>
               </div>
           </div>
           <div class="col-lg-3 col-sm-6 col-md-6">
               <div class="single-funfacts-card">
                   <p>Paid Investments</p>
                   <h3>$<span class="odometer" data-count="2.5">00</span><span class="sign">M</span></h3>
               </div>
           </div>
           <div class="col-lg-3 col-sm-6 col-md-6">
               <div class="single-funfacts-card">
                   <p>Supported Cryptocurrencies</p>
                   <h3><span class="odometer" data-count="4">00</span><span class="sign">+</span></h3>
               </div>
           </div>
           <div class="col-lg-3 col-sm-6 col-md-6">
               <div class="single-funfacts-card">
                  
                   <p>Lowest transaction fees</p>
                   <h3><<span class="odometer" data-count="0.5">00</span><span class="sign">%</span></h3>
               </div>
           </div>
       </div>
   </div>
</div>
<!-- End Gradient Funfacts Area -->



<!-- Start Feedback Wrap Area -->
<div class="p-2"></div>
<div class="feedback-area bg-gradient-color pt-100" >
   <div class="container">
       <div class="row">
           <div class="col-lg-4 col-md-12">
               <div class="feedback-section-title">
                   <span class="sub-title">CLIENT REVIEWS</span>
                   <h2>What Our Customer Say About Us</h2>
               </div>
           </div>
           <div class="col-lg-8 col-md-12">
               <div class="feedback-slides-two owl-carousel owl-theme">
                   <div class="single-feedback-box">
                       <div class="client-info">
                           <div class="d-flex align-items-center">
                              
                               <div class="title">
                                   <h3>Henry Woods</h3>
                               </div>
                           </div>
                       </div>
                       <p>"I started using this platform over 3 years and i must confess, am glad am here."</p>
                       <i class="ri-facebook-fill"></i><a href="https://web.facebook.com/henry.woods.3956">Henry Woods </a>
                   </div>
                   <div class="single-feedback-box">
                       <div class="client-info">
                           <div class="d-flex align-items-center">
                               <div class="title">
                                   <h3>Arthur Rodriguez</h3> 
                               </div>
                           </div>
                       </div>
                       <p>"My friend James introduced me to Acrabuscapital last year, and since then, i have enjoyed my returns"</p>
                       <i class="ri-facebook-fill"></i><a href="https://web.facebook.com/arthur.rodriguez"> Arthur Rodriguez</a>
                   
                   </div>
                   <div class="single-feedback-box">
                       <div class="client-info">
                           <div class="d-flex align-items-center">
                               <div class="title">
                                   <h3>James Mills</h3>
                               </div>
                           </div>
                       </div>
                       <p>"I am so delighted to be part of this campaign, you help me grow my savings weekly, am so glad"</p>
                       <i class="ri-facebook-fill"></i><a href="https://web.facebook.com/james.mills.5832">James Mills </a>
                   
                     </div>
               </div>
           </div>
       </div>
   </div>
</div>
<!-- End Feedback Wrap Area -->

<!-- Start App Pricing Area -->
<div class="app-pricing-area pt-100 pb-75">
   <div class="container">
      
   </div>
</div>
<!-- End App Pricing Area -->

@endsection


