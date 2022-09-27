@extends('layouts.mobile')
@section('content')

<div class="body-content">
    <div class="container">
        <!-- Page-header -->
        <div class="page-header">
            <div style="width:100%">
            <div class="user-setting-thumb">
                    <div class="user-setting-thumb-up">
                        <img data-cfsrc="{{asset('images/'.auth()->user()->image_path)}}" alt="profile" src="{{asset('images/'.auth()->user()->image_path)}}">
                    </div>
                    <label for="upThumb">
                        <i class="flaticon-camera"></i>
                    </label>
                    <form action="{{route('Store.photo')}}" method="post" id="formImage"  enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image" id="upThumb" class="d-none">
                </form>
               
                @if(auth()->user()->email_verified_at != null) 
            <span style="font-size:13px; color:#117211; font-weight:bolder"> <i class="flaticon-check"> </i>  Verified</span>@else
                <span class="" style="font-size:12px; color:#c81508; font-weight:bolder">  Unverified</span>
            @endif
            </div>
            
        </div>
        <div style="text-align:center" >
            @if(auth()->user()->email_verified_at == null) 
                    <form method="POST" action="{{ route('verification.resend') }}" class="authentication-form" id="verify">
                       @csrf                                       
                    <em> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;
                        <button type="submit" class="icon btn-sm btn-outline-primary">Resend Verification link</button></em>
                     </form>
                     @endif
                 </div>
                </div>
          
        <!-- Page-header -->
        
        <!-- Payment-list -->
        <div class="payment-list pb-15 pt-5">
            <div class="payment-list-details">
                <div class="payment-list-item payment-list-title">Username</div>
                <div class="payment-list-item payment-list-info">{{$user->username}} </div>
            </div>
            <div class="payment-list-details">
                <div class="payment-list-item payment-list-title">Name</div>
                <div class="payment-list-item payment-list-info">{{$user->first_name .' '.$user->last_name }}</div>
            </div>
            <div class="payment-list-details">
                <div class="payment-list-item payment-list-title">Email</div>
                <div class="payment-list-item payment-list-info">{{$user->email}} </div>
            </div>
            <div class="payment-list-details">
                <div class="payment-list-item payment-list-title">Phone Number</div>
                <div class="payment-list-item payment-list-info">{{$user->phone}}</div>
            </div>
            <div class="payment-list-details">
                <div class="payment-list-item payment-list-title">City</div>
                <div class="payment-list-item payment-list-info">{{$user->city}}</div>
            </div>
            <div class="payment-list-details">
                <div class="payment-list-item payment-list-title">State</div>
                <div class="payment-list-item payment-list-info">{{$user->state}}</div>
            </div>
            <div class="payment-list-details">
                <div class="payment-list-item payment-list-title">Country</div>
                <div class="payment-list-item payment-list-info">{{$user->country}}</div>
            </div>
            <div class="payment-list-details">
                    <div class="payment-list-item payment-list-title"><a href="#"  class="btn btn-info" data-bs-toggle="modal" data-bs-target="#passwordModal">Change Password</a></div>
                    <div class="payment-list-item payment-list-info">  <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updatedetails">Update Details  </a></div>
                    </div>
            </div>
        </div>
        <form method="post" action="{{ route('setting.profile') }}" enctype="multipart/form-data">
            @csrf
        <div class="modal fade" id="updatedetails" tabindex="-1" aria-labelledby="addressModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="container">
                        <div class="modal-header">
                            <div class="modal-header-title">
                                <h5 class="modal-title">Update Details</h5>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group mb-15">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="{{$user->first_name}}" placeholder="Enter First name">
                                </div>
                                <div class="form-group mb-15">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="{{$user->last_name}}" placeholder="Enter last name">
                                </div>
                                <div class="form-group mb-15">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control"  value="{{$user->phone}} "placeholder="Enter Phone">
                                </div>
                                
                                <div class="form-group mb-15">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" class="form-control" value="{{$user->city}}" placeholder="Enter City">
                                </div>

                                <div class="form-group mb-15">
                                    <label class="form-label">State</label>
                                    <input type="text" name="state" class="form-control"  value="{{$user->state}}" placeholder="Enter State">
                                </div>
                                <div class="form-group mb-15">
                                    <label class="form-label">Country</label>
                                    <input type="text" name="country" class="form-control" value="{{$user->country}}" placeholder="Enter Country">
                                </div>
                                <button type="submit"  class="btn main-btn main-btn-lg full-width">Update Address</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         </form>
         <form method="post" action="{{ route('setting.password') }}">
            @csrf
         <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="container">
                        <div class="modal-header">
                            <div class="modal-header-title">
                                <h5 class="modal-title">Change Password</h5>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group pb-15">
                                    <label>Current Password</label>
                                    <div class="input-group">
                                        <input type="password" name="old_password"
                                        value="{{ old('old_password') }}"
                                        class="form-control {{ form_invalid('old_password') }} password" id="inputOldPassword" placeholder="Enter old password">
                                    @showError('old_password') 
                                       <span class="input-group-text reveal">
                                            <i class="flaticon-invisible pass-close"></i>
                                            <i class="flaticon-visibility pass-view"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group pb-15">
                                    <label>New Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password"
                                            value="{{ old('password') }}"
                                           class="form-control {{ form_invalid('password') }} passsword " id="inputNewPassword" placeholder="Enter new password">
                                            @showError('password')
                                            <span class="input-group-text reveal">
                                            <i class="flaticon-invisible pass-close"></i>
                                            <i class="flaticon-visibility pass-view"></i>
                                        </span>
                                    </div>
                                </div>
                                <button type="submit" class="btn main-btn main-btn-lg full-width">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         </form>
        <!-- Payment-list -->
    </div>
</div>

@endsection

@push('scripts')

<script>
   
   $('#formImage').on('change', function(){

    $('#formImage').submit();

   });
</script>
@endpush

