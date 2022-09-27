
       @extends('layouts.auth')
       @section('content')
       <!-- Appbar -->
        <div class="fixed-top">
            <div class="appbar-area sticky-black">
                <div class="container">
                    <div class="appbar-container">
                        <div class="appbar-item appbar-actions">
                            <div class="appbar-action-item">
                              
                            </div>
                        </div>
                        <div class="appbar-item appbar-page-title mx-auto">
                            <h3>Sign In</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Appbar -->
        
        <!-- Body-content -->
       
        <div class="body-content">
            <div class="container">
                <center>
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('logo.png') }}" alt="" width="80"/>                                            
                    </a>
                </center>
                <!-- Page-header -->

                <!-- Authentication-section -->
                <div style="height:50px"></div>
                <div class="authentication-form pb-15">
                      <form class="text-left" method="post" action="{{ route('login') }}">
                        @csrf     <div class="form-group pb-15">
                            <label>Email</label>
                            <div class="input-group">
                                <input type="text" name="email"  value="{{old('email')}}" class="form-control form-control-lg {{ form_invalid('email') }}" id="default-01" placeholder="Enter your email address">
                                @showError('email')
                                 <span class="input-group-text"><i class="flaticon-user-picture"></i></span>
                            </div>
                        </div>
                        <div class="form-group pb-15">
                            <label>Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control password" required placeholder="**********">
                                <span class="input-group-text reveal">
                                    <i class="flaticon-invisible pass-close"></i>
                                    <i class="flaticon-visibility pass-view"></i>
                                </span>
                            </div>
                        </div>
                        <div class="authentication-account-access pb-15">
                            <div class="authentication-account-access-item">
                                <div class="input-checkbox">
                                    <input type="checkbox" id="check1">
                                    <label for="check1">Remember Me!</label>
                                </div>
                            </div>
                            <div class="authentication-account-access-item">
                                <div class="authentication-link">
                                    @if (Route::has('password.request'))
                                    <a class="link link-primary link-sm" tabindex="-1" href="{{ route('password.request') }}">Forgot Password?</a>
                                    @endif</div>
                            </div>
                        </div>
                        <button class="btn main-btn main-btn-lg full-width mb-10">Sign In</button>
                    </form>
                    <div class="form-desc">Don’t have an account? <a href="{{route('register')}}">Sign Up Now!</a></div>
                </div>
                <!-- Authentication-section -->
            </div>
        </div>
        <!-- Body-content -->

       

    @endsection