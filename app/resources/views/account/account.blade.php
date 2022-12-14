

@extends('layouts.app')
@section('content')
           <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="nk-block">
                                <div class="card card-bordered">
                                    <div class="card-aside-wrap">
                                 
                                        <div class="card-inner card-inner-lg">
                                            <div class="nk-block-head nk-block-head-lg">
                                                <div class="nk-block-between">
                                                    <div class="nk-block-head-content">
                                                        <h4 class="nk-block-title">Personal Information</h4>
                                                        <div class="nk-block-des">
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-block-head -->
                                             
                                            <div class="nk-block">
                                                <div class="nk-data data-list">
                                                    <div class="data-head">
                                                  
                                                    </div>
                                                    <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                        <div class="data-col">
                                                            <span class="data-label">Full Name</span>
                                                            <span class="data-value">{{auth_user()->first_name." ".auth_user()->last_name}}</span>
                                                        </div>
                                                        <div class="data-col data-col-end"><span class="data-more"><em class=""></em></span></div>
                                                    </div><!-- data-item -->
                                                    <!-- data-item -->
                                                     <div class="data-item">
                                                        <div class="data-col">
                                                            <span class="data-label">Username</span>
                                                            <span class="data-value">{{auth_user()->username}}</span>
                                                        </div>
                                                        <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                                    </div>
                                                    <div class="data-item">
                                                        <div class="data-col">
                                                            <span class="data-label">Email</span>
                                                            <span class="data-value">{{auth_user()->email}}</span>
                                                        </div>
                                                        <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                                    </div><!-- data-item -->
                                                    <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                        <div class="data-col">
                                                            <span class="data-label">Phone Number</span>
                                                            <span class="data-value text-soft">{{auth_user()->phone}}</span>
                                                        </div>
                                                        <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                                    </div><!-- data-item -->
                                                    <!-- data-item -->
                                                    <div class="data-item" data-toggle="modal" data-target="#profile-edit" data-tab-target="#address">
                                                        <div class="data-col">
                                                            <span class="data-label">Address</span>
                                                            <span class="data-value">{{auth_user()->city}},<br>{{auth_user()->state}}</span>
                                                        </div>
                                                        <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                                    </div><!-- data-item -->
                                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit" data-tab-target="#address">
                                                    <div class="data-col">
                                                            <span class="data-label">Country</span>
                                                            <span class="data-value">{{auth_user()->country}}</span>
                                                        </div>
                                                        <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                                    </div>
                                                    
                                                    <div class="data-item" data-toggle="modal" data-target="#profile-edit" data-tab-target="#address">
                                                   <button type="button" class="btn btn-primary">Update Profile</button>
                                                       
                                                    </div>
                                                </div><!-- data-list -->
                                            <!-- data-list -->
                                            </div><!-- .nk-block -->
                                        </div>
                                        <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                            <div class="card-inner-group" data-simplebar>
                                                <div class="card-inner">
                                                    <div class="user-card">
                                                        <div class="user-avatar bg-primary">
                                                               <img src="{{auth_user()->photo_url }}"class="icon ni ni-user-alt">
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="lead-text">{{strtoupper(auth()->user()->username)}}</span>
                                                            <span class="sub-text">{{auth()->user()->email}}</span>
                                                            <span class="sub-text"> Wallet Address: {{auth()->user()->btc}}</span>
                                                        </div>
                                                        
                                                    </div><!-- .user-card -->
                                                </div><!-- .card-inner -->
                                                <!-- .card-inner -->
                                                <div class="card-inner p-0">
                                                    <ul class="link-list-menu">
                                                        <li><a class="active" href="{{ route('web.account') }}"><em class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a></li>
                                                        <li><a href="{{ route('web.account.activities') }}"><em class="icon ni ni-activity-round-fill"></em><span>Account Activity</span></a></li>
                                                        <li><a href="{{ route('web.setting.password') }}"><em class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span></a></li>
                                                    </ul>
                                                </div><!-- .card-inner -->
                                            </div><!-- .card-inner-group -->
                                        </div><!-- card-aside -->
                                    </div><!-- .card-aside-wrap -->
                                </div><!-- .card -->
                            </div><!-- .nk-block -->
                        </div>
                    </div>
                </div>
                    <!-- end container-fluid -->
                    <form method="post" action="{{ route('web.setting.profile') }}" enctype="multipart/form-data">
                                                @csrf
             <div class="modal fade" tabindex="-1" role="dialog" id="profile-edit">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-lg">
                    <h5 class="title">Update Profile</h5>
                    <ul class="nk-nav nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#personal">Personal</a>
                        </li>
                       
                    </ul><!-- .nav-tabs -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="personal">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="full-name">First Name</label>
                                        <input type="text" name="first_name" class="form-control form-control-lg {{ form_invalid('first_name') }}" id="full-name" value="{{auth_user()->first_name}}" placeholder="first name">
                                    </div>
                                     @showError('first_name')
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="display-name">Last Name</label>
                                        <input type="text" name="last_name" class="form-control form-control-lg {{ form_invalid('last_name') }}" id="display-name" value="{{auth_user()->last_name}}" placeholder="last name">
                                    </div>
                                      @showError('first_name')
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="phone-no">Phone Number</label>
                                        <input type="text" name="phone" class="form-control form-control-lg {{ form_invalid('phone') }}" id="phone-no" value="{{auth_user()->phone}}" placeholder="phone">
                                    </div>
                                      @showError('phone')
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="birth-day">City</label>
                                        <input type="text" name="city" class="form-control form-control-lg  {{ form_invalid('city') }}" value="{{auth_user()->city}}" placeholder="city">
                                    </div>
                                     @showError('city')
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="birth-day">State</label>
                                        <input type="text" name="state" class="form-control form-control-lg {{ form_invalid('state') }}"  value="{{auth_user()->state}}" placeholder="state">
                                    </div>
                                     @showError('state')
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="birth-day">Country</label>
                                        <input type="text" name="country" class="form-control form-control-lg {{ form_invalid('country') }}" value="{{auth_user()->country}}" id="birth-day" placeholder="country">
                                    </div>
                                     @showError('country')
                                </div>
                              
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <button type="submit" class="btn btn-lg btn-primary">Update Profile</button>
                                        </li>
                                        <li>
                                            <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .tab-pane -->
                       
                    </div><!-- .tab-content -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div>
    </form>     
@endsection
@section('scripts')
<script>

let message = {!! json_encode(Session::get('message')) !!};
let msg = {!! json_encode(Session::get('alert')) !!};


//alert(msg);
if(message != null){
toastr.clear();
    NioApp.Toast(message , msg, {
      position: 'top-right',
        timeOut: 5000,
    });
}
</script>
@endsection