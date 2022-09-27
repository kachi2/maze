 
 @extends('layouts.auths')
 @section('content')
  <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                    <center>
                                    <a href="{{route('index')}}" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" width="100px" src="{{asset('logo-dark.png')}} " srcset="{{asset('logo-dark.png')}}  2x" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" width="100px" src="{{asset('logo-dark.png')}} " srcset="{{asset('logo-dark.png')}}  2x" alt="logo-dark">
                            </a>
                            </center>
                                        <h4 class="nk-block-title">Register</h4>
                                        <div class="nk-block-des">
                                            <p>Complete Registeration</p>
                                        </div>
                                    </div>
                                </div>
                                 <form class="text-left" method="post" action="{{ route('complete_registration') }}">
                            @csrf
                                       <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="default-01">Username</label>
                            </div>
                            <input type="text" name="username" class="form-control form-control-lg {{ form_invalid('username') }}" id="default-01" placeholder="Enter username">
                            @showError('username')
                        </div><!-- .foem-group -->
                        <div class="form-group">
                              <label class="form-label" for="default-01">Phone</label>
                            <div class="form-control-wrap">
                                <input type="text" name="phone" class="form-control form-control-lg {{ form_invalid('phone') }}" id="password" placeholder="Enter phone">
                              @showError('phone')
                            </div>
                                    
                                    </div><!-- .foem-group -->
                         <!--<div class="form-group">-->
                         <!--     <label class="form-label" for="default-01">Country</label>-->
                         <!--   <div class="form-control-wrap">-->
                         <!--       <input type="text" name="country" class="form-control form-control-lg {{ form_invalid('country') }}" id="country" placeholder="Enter country">-->
                         <!--     @showError('country')-->
                         <!--   </div>-->
                                    
                         <!--           </div>-->
                                    <!-- .foem-group -->
                        <!--<div class="form-group">-->
                        <!--      <label class="form-label" for="default-01">State</label>-->
                        <!--    <div class="form-control-wrap">-->
                        <!--        <input type="text" name="state" class="form-control form-control-lg {{ form_invalid('state') }}" id="state" placeholder="Enter State">-->
                        <!--      @showError('state')-->
                        <!--    </div>-->
                                    
                        <!--            </div>-->
                                    <!-- .foem-group -->
                        <div class="form-group">
                            <button class="btn btn-lg btn-primary btn-block">Complete Registration</button>
                        </div>
                    </form><!-- form -->
                    <div class="form-note-s2 pt-4"> Already have Account? <a href="{{route('login')}}">Login</a>
                    </div>
                </div><!-- .nk-block -->
              <!-- .nk-block -->
            </div><!-- .nk-split-content -->
            </div>
                    <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6 order-lg-last">
                                    <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('terms')}}">Terms & Condition</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('faq')}}">FAQ</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('contact')}}">Help?</a>
                                        </li>
                                      
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">&copy; {{date('Y')}} Zenithcapital. All Rights Reserved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>

    @endsection