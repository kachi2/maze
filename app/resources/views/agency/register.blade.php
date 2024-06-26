@extends('layouts.agency_auth')
@section('content')

    <!-- Log In page -->
    <div class="container account-body accountbg">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="card">

                            @if(Session::has('msg'))
                           <span class="alert alert-success"> {{Session::get('msg')}} </span> 
                            @endif
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <p class="text-muted  mb-0">Affiliates Register</p>  
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="nav-border nav nav-pills" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#Register_Tab" role="tab">Register</a>
                                    </li>
                                </ul>
                                 <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active px-3 pt-3" id="Register_Tab" role="tabpanel">
                                        <form class="form-horizontal auth-form" action="{{route('affiliates.registers')}}" method="post">
                                            @csrf
                                            <div class="form-group mb-2">
                                                <label class="form-label" for="useremail">Full Name</label>
                                                <div class="input-group">                                                                                         
                                                    <input type="text" class="form-control {{ form_invalid('name') }}" value="{{old('name')}}" name="name" placeholder="Enter Full Name">
                                                    @showError('email')
                                                </div>                                    
                                            </div><!--end form-group-->
                                            <div class="form-group mb-2">
                                                <label class="form-label" for="useremail">Email</label>
                                                <div class="input-group">                                                                                         
                                                    <input type="email" class="form-control {{ form_invalid('email') }}" value="{{old('email')}}" name="email" id="useremail" placeholder="Enter Email">
                                                    @showError('email')
                                                </div>                                    
                                            </div><!--end form-group-->
                                            <div class="form-group mb-2">
                                                <label class="form-label" for="mo_number">Mobile Number</label>                                            
                                                <div class="input-group">                                 
                                                    <input type="text" class="form-control {{ form_invalid('phone')}}" name="phone" value="{{old('phone')}}" id="mo_number" placeholder="Enter Phone Number">
                                                    @showError('phone')
                                                </div>                               
                                            </div><!--end form-group-->  
                                            
                                            <div class="form-group mb-0 row">
                                                <div class="col-12">
                                                    <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Register <i class="fas fa-sign-in-alt ms-1"></i></button>
                                                </div><!--end col--> 
                                            </div> <!--end form-group-->  
                                            <div class="form-desc p-2">Already have an account? <a href="{{route('affiliates.loginform')}}" class="btn btn-outline-primary">Sign In!</a></div>
                                        </form>              
                                    </div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
    <!-- End Log In page -->
@endsection