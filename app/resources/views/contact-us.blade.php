@extends('layouts.landing', ['page_title' => 'Contact Us'])
@section('content')
<div class="p-5"></div>
<div class="contact-area ptb-100">
    <div class="container">
        <div class="section-title">
            <h2>Get in Touch</h2>
            <p>Please fill the form below and submit</p>
        </div>
        <div class="contact-form">
            <form id="contactForm" method="post" action="{{route('contact.store')}}">
                @csrf
                @if(Session::has('msg')) 
                
                <span class="alert btn-success" role="alert">{{Session::get('msg')}} </span>

                @endif
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="name" required data-error="Please enter your name" placeholder="Eg: Sarah Taylor">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" id="email" required data-error="Please enter your email" placeholder="hello@sarah.com">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="phone_number" class="form-control" id="phone_number" required data-error="Please enter your phone number" placeholder="Enter your phone number">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="msg_subject" class="form-control" id="msg_subject" placeholder="Enter your subject" required data-error="Please enter your subject">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <textarea name="message" id="message" class="form-control" cols="30" rows="6" required data-error="Please enter your message" placeholder="Enter message..."></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="submit" class="default-btn"><i class='bx bx-paper-plane'></i> Send Message</button>
                       
                        <div class="clearfix"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</div>
<!-- End Contact Area -->

<!-- Start Contact Info Area -->
<div class="contact-info-area pb-100">
    <div class="container">
        <div class="contact-info-inner">
            <h2>Have any question in mind please call or mail us</h2>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-contact-info-box">
                        <div class="icon bg1">
                            <i class="ri-customer-service-2-line"></i>
                        </div>
                        <h3><a href="tel:(+1) 631 285-0731">(+1) 631 285-0731</a></h3>
                        <h3><a href="tel:(+1) 814 217-7669">(+1) 814 217-7669</a></h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-contact-info-box">
                        <div class="icon">
                            <i class="ri-earth-line"></i>
                        </div>
                        <h3><a href="mailto:support@Mazeoptions.com"><span>support@Mazeoptions.com</span></a></h3>
                        <h3><a href="mailto"><span> billing@Mazeoptions.com</span></a></h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-contact-info-box">
                        <div class="icon bg2">
                            <i class="ri-map-pin-line"></i>
                        </div>
                        <h3>3718 S ISABELLA RD MT PLEASANT, MI 48858</h3>
                    </div>
                </div>
            </div>
            <div class="lines">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </div>
    </div>
</div>


@endsection
