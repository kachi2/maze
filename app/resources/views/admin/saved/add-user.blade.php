@extends('layouts.admin', ['page_title' => 'Add User'])
@section('content')
<div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="components-preview wide-md mx-auto">
                                 <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title fw-normal">Add User</h5>
                                        
                                    </div>
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                            <li class="order-md-last">
                                                   <a href="{{ route('admin.users') }}" class="btn btn-primary"><i
                                                    class='uil uil-plus mr-1'></i>User List</a> </li>
                                       </ul>
                                    </div>
                                </div>
                            </div>
    <div class="body-content row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <form method="post" action="{{ route('admin.users.add') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="inputUsername">Username *</label>
                                    <input type="text" name="username"
                                           value="{{ old('username') }}"
                                           placeholder="Enter  username"
                                           class="form-control {{ form_invalid('username') }}" id="inputUsername">
                                    @showError('username')
                                </div>

                                <div class="form-group">
                                    <label for="inputFirstName">First Name *</label>
                                    <input type="text" name="first_name"
                                           value="{{ old('first_name') }}"
                                           class="form-control {{ form_invalid('first_name') }}" id="inputFirstName" placeholder="Enter user first name">
                                    @showError('first_name')
                                </div>

                                <div class="form-group">
                                    <label for="inputLastName">Last Name *</label>
                                    <input type="text" name="last_name"
                                           value="{{ old('last_name') }}"
                                           class="form-control {{ form_invalid('last_name') }}" id="inputLastName" placeholder="Enter user last name">
                                    @showError('last_name')
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail">Email *</label>
                                    <input type="text" name="email"
                                           value="{{ old('email') }}"
                                           class="form-control {{ form_invalid('email') }}" id="inputEmail" placeholder="Enter email address">
                                    @showError('email')
                                </div>

                                <div class="form-group">
                                    <label for="inputNewPassword">Password *</label>
                                    <input type="password" name="password"
                                           value="{{ old('password') }}"
                                           class="form-control {{ form_invalid('password') }}" id="inputNewPassword" placeholder="Enter password">
                                    @showError('password')
                                </div>

                                <div class="form-group">
                                    <label for="inputRepeatPassword">Repeat Password *</label>
                                    <input type="password" name="password_confirmation"
                                           value="{{ old('password_confirmation') }}"
                                           class="form-control {{ form_invalid('password_confirmation') }}" id="inputRepeatPassword" placeholder="Confirm password">
                                    @showError('password_confirmation')
                                </div>

                                <div class="form-group">
                                    <label for="inputCountry">Country</label>
                                    <input type="text" name="country"
                                           value="{{ old('country') }}"
                                           class="form-control {{ form_invalid('country') }}" id="inputCountry" placeholder="Enter country name">
                                    @showError('country')
                                </div>

                                <div class="form-group">
                                    <label for="inputState">State</label>
                                    <input type="text" name="state"
                                           value="{{ old('state') }}"
                                           class="form-control {{ form_invalid('state') }}" id="inputState" placeholder="Enter state name">
                                    @showError('state')
                                </div>

                                <div class="form-group">
                                    <label for="inputCity">City</label>
                                    <input type="text" name="city"
                                           value="{{ old('city') }}"
                                           class="form-control {{ form_invalid('city') }}" id="inputCity" placeholder="Enter city name">
                                    @showError('city')
                                </div>

                                <div class="form-group">
                                    <label for="inputPhone">Phone Number</label>
                                    <input type="text" name="phone"
                                           value="{{ old('phone') }}"
                                           class="form-control {{ form_invalid('phone') }}" id="inputPhone" placeholder="Enter phone number">
                                    @showError('phone')
                                </div>

                                <button type="submit" class="btn btn-primary">Add User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
                                </div>
                            </div>
                            </div>
                              
    </div>
@endsection
