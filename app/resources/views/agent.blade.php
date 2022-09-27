@extends('layouts.landing', ['page_title' => 'Agent Network'])
@section('content')

<div class="p-5"></div>
<div class="contact-area ptb-100">
    <div class="container">
        <div class="section-title">
            <h2>Join our Agent Network</h2>
            <p>Please fill the form below and submit, our team will contact you as soon as possible.</p>
        </div>
        <div class="contact-form">
            <form id="contactForm" method="post" action="{{route('contact.store')}}">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="name" required data-error="Enter your name" placeholder="Eg: Sarah Taylor">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" id="email" required data-error="Enter your email" placeholder="hello@sarah.com">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="phone_number" class="form-control" id="phone_number" required data-error="Enter your phone number" placeholder="Enter your phone number">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" id="msg_subject" placeholder="Enter City" required data-error="Enter City">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="submit" class="default-btn"><i class='bx bx-paper-plane'></i>Submit</button>
                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</div>
<!-- End Contact Area -->




@endsection
