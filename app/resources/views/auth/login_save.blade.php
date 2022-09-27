 
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
                                <img class="logo-light logo-img logo-img-lg"width="100px"  src="{{asset('/logo-dark.png')}}" srcset="{{asset('/logo-dark.png')}} 2x" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" width="100px" src="{{asset('logo-dark.png')}}" srcset="{{asset('/logo-dark.png')}} 2x" alt="logo-dark">
                            </a>
                            </center>
                                        <h4 class="nk-block-title">Sign-In</h4>
                                        <div class="nk-block-des">
                                            <p>Access your account using your email and password.</p>
                                        </div>
                                    </div>
                                </div>
                                <form class="text-left" method="post" action="{{ route('login') }}">
                            @csrf
                                     <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="default-01">Email</label>
                            </div>
                            <input type="text" name="email" class="form-control form-control-lg {{ form_invalid('email') }}" id="default-01" placeholder="Enter your email address">
                            @showError('email')
                        </div><!-- .foem-group -->
                                    <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password">Password</label>
                                @if (Route::has('password.request'))
                                <a class="link link-primary link-sm" tabindex="-1" href="{{ route('password.request') }}">Forgot Password?</a>
                                @endif
                            </div>
                                     <div class="form-control-wrap">
                                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                    <em onclick="showPass() " class="passcode-icon icon-show icon ni ni-eye"></em>
                                    <em onclick="hidePass()" class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                </a>
                                <input type="password" name="password" class="form-control form-control-lg {{ form_invalid('password') }}" id="password" placeholder="Enter your pasword">
                              @showError('password')
                            </div>
                            <script>
                                            function showPass() {
                                        var x = document.getElementById("passwordLogin");
                                        if (x.type === "password") {
                                            x.type = "text";
                                        } 
                                        }
                                             function hidePass() {
                                        var x = document.getElementById("passwordLogin");
                                        if (x.type === "text") {
                                            x.type = "password";
                                        } 
                                        
                                        }
                                        </script>
                                     </div><!-- .foem-group -->
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                                    </div>
                                </form><!-- form -->
                                <div class="form-note-s2 pt-4"> Don't have Account? <a href="{{route('register')}}">Create an account</a>
                                </div>
                            </div>
                        </div>
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