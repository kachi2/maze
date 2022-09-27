@extends('layouts.auth')
@section('content')
<!-- Appbar -->
        <div class="fixed-top">
            <div class="appbar-area sticky-black">
                <div class="container">
                    <div class="appbar-container">
                        <div class="appbar-item appbar-actions">
                            <div class="appbar-action-item">
                                <a href="#" class="back-page"><i class="flaticon-left-arrow"></i></a>
                            </div>
                        </div>
                        <div class="appbar-item appbar-page-title mx-auto">
                            <h3>Register</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Appbar -->
        
        <!-- Body-content -->
        <div class="body-content">
            <div class="container">
                <!-- Page-header -->
                <center>
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('logo.png') }}" alt="" width="80"/>                                            
                    </a>
                </center>
                <!-- Page-header -->

                <!-- Authentication-section -->
                <div style="height:50px"></div>
                <div class="authentication-form pb-15">
                    <form class="text-left" method="post" action="{{ route('register_user') }}">
                        @csrf
                        <div class="form-group pb-15">
                            <label>Username</label>
                            <div class="input-group">
                                <input type="text" name="username" value="{{old('username')}}" class="form-control form-control-lg {{ form_invalid('username') }}" id="default-01" placeholder="Enter username">
                                @showError('username')
                                 <span class="input-group-text"><i class="flaticon-user-picture"></i></span>
                            </div>
                        </div>
                        <div class="form-group pb-15">
                            <label>Email</label>
                            <div class="input-group">
                                <input type="text" name="email" value="{{old('email')}}" class="form-control form-control-lg {{ form_invalid('email') }}" id="default-01" placeholder="Enter your email address">
                                @showError('email')
                                  <span class="input-group-text"><i class="flaticon-email"></i></span>
                            </div>
                        </div>
                        <div class="form-group pb-15">
                            <label>Phone Number</label>
                            <div class="input-group">
                                <input type="text" name="phone" value="{{old('phone')}}" class="form-control form-control-lg {{ form_invalid('phone') }}" id="default-01" placeholder="Enter Phone Number">
                                @showError('phone')
                                  <span class="input-group-text"><i class="flaticon-call-center-agent"></i></span>
                            </div>
                        </div>
                        <div class="form-group pb-15">
                            <label>Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control form-control-lg {{ form_invalid('password') }}" id="password" placeholder="Enter your pasword">
                              @showError('password')
                               <span class="input-group-text reveal">
                                    <i class="flaticon-invisible pass-close"></i>
                                    <i class="flaticon-visibility pass-view"></i>
                                </span>
                            </div>
                        </div>
                        <div class="authentication-account-access pb-15">
                            <div class="authentication-account-access-item">
                                <div class="input-checkbox">
                                    <input type="checkbox" id="check1"required>
                                    <label for="check1">I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#centerModal">Privacy Policy</a></label>
                                </div>
                            </div>
                        </div>
                        <button class="btn main-btn main-btn-lg full-width mb-10">Register</button>
                    </form>
                    <div class="form-desc">Already have an account? <a href="{{route('login')}}">Sign In!</a></div>
                </div>
                <!-- Authentication-section -->
                   <!-- Centermodal -->
        <div class="modal fade" id="centerModal" tabindex="-1" aria-labelledby="centerModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="container">
                        <div class="modal-header">
                            <div class="modal-header-title">
                                <h5 class="modal-title">Mazeoptions Privacy Policy</h5>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           
                            <p class="mb-0">
                                 
            <p>This Privacy Notice describes how Mazeoptions collects and processes your personal information through the Mazeoptions websites and applications that reference this Privacy Notice. Mazeoptions refers to an ecosystem comprising Mazeoptions websites (whose domain names include but are not limited to www.Mazeoptions.com/).
                This Privacy Policy applies to all platforms, websites, and departments of Mazeoptions and Mazeoptions Operators. By using Mazeoptions Services, you are consenting to the collection, storage, processing and transfer of your personal information as described in this Privacy Policy.
               </p>
            <p style="font-weight:bold">What Personal Information does Mazeoptions collect and process? Why does Mazeoptions process my personal information ?</p>
            <p>Your information we collect includes the following</p>
            <p>mail address <br> name <br> gender<br>  home address <br> phone number<br> nationality <br> device ID <br> transactional information
            </p>

            <p style="font-weight:bold">Can Children Use Mazeoptions Services?</p>
            <p>Mazeoptions does not allow anyone under the age of 18 to use Mazeoptions Services.</p>
               
            <p style="font-weight:bold">What About Cookies and Other Identifiers?</p>
            <p>We use cookies and similar tools to enhance your user experience, provide our services, and understand how customers use our services so we can make improvements. Depending on applicable laws in the region you are located in, the cookie banner on your browser will tell you how to accept or refuse cookies.</p>
          
            <p style="font-weight:bold"> Does Mazeoptions Share My Personal Information?</p>
            <p>Information about our users is an important part of our business and we are not in the business of selling our users' personal information to others.   Mazeoptions shares users' personal information only as described below and with the subsidiaries or affiliates of Mazeoptions that are either subject to this Privacy Notice or follow practices at least as protective as those described in this Privacy Notice..</p>
          
          
            <p style="font-weight:bold">How Secure is My Information?.</p>
            <p>We design our systems with your security and privacy in mind.  We work to protect the security of your personal information during transmission by using encryption protocols and software.
                We maintain physical, electronic and procedural safeguards in connection with the collection, storage and disclosure of your personal information. Our security procedures mean that we may ask you to verify your identity to protect you against unauthorised access to your account password. We recommend using a unique password for your Mazeoptions account that is not utilized for other online accounts and to sign off when you finish using a shared computer.</p>
           
                <p style="font-weight:bold">  What Rights Do I Have?</p>
                <ol>
                <li><strong> Right to access: </strong>you have the right to obtain confirmation that your Data are processed and to obtain a copy of it as well as certain information related to its processing</li>
                    <li><strong> Right to rectify:</strong> you can request the rectification of your Data which are inaccurate, and also add to it. You can also change your personal information in your Account at any time</li>
                        <li><strong> Right to delete:</strong> you can, in some cases, have your Data deleted</li>
                            <li><strong> Right to object: </strong>you can object, for reasons relating to your particular situation, to the processing of your Data. For instance, you have the right to object to commercial prospection</li>
                            <li><strong>Right to withdraw your consent:</strong> for processing requiring your consent, you have the right to withdraw your consent at any time. Exercising this right does not affect the lawfulness of the processing based on the consent given before the withdrawal of the latter;</li>
            
                        </ol> </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
        <!-- Body-content -->


   

@endsection