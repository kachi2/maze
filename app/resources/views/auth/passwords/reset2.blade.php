@extends('layouts.auth', ['page_title' => 'Reset Password', 'heading' => 'Reset Password', 'sub_heading' => 'Enter your new password to reset password'])
@section('form')
    <form method="POST" action="{{ route('password.update') }}" class="authentication-form">
        @csrf
<input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <label class="form-control-label" for="InputEmail">Email Address</label>
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="icon-dual" data-feather="mail"></i>
                        </span>
                </div>
                <input type="email" name="email"
                       value="{{ $email ?? old('email') }}"
                       class="form-control {{ form_invalid('email') }}"
                       id="InputEmail">
                @showError('email')
            </div>
        </div>
        <div class="form-group">
            <label class="form-control-label" for="InputPassword">Password</label>
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="icon-dual" data-feather="lock"></i>
                        </span>
                </div>
                <input type="password"
                       value="{{ old('password') }}"
                       name="password"
                       class="form-control {{ form_invalid('password') }}"
                       id="InputPassword"
                       placeholder="Enter your password"
                       required>
                @showError('password')
            </div>
        </div>
        <div class="form-group mb-4">
            <label class="form-control-label" for="InputPassword">Confirm Password</label>
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="icon-dual" data-feather="lock"></i>
                        </span>
                </div>
                <input type="password"
                       value="{{ old('password_confirmation') }}"
                       name="password_confirmation"
                       class="form-control {{ form_invalid('password_confirmation') }}"
                       id="InputPassword"
                       placeholder="Enter your password"
                       required>
                @showError('password_confirmation')
            </div>
        </div>

        <div class="form-group mb-0 text-center">
            <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
        </div>
    </form>
@endsection
@section('footer')
    <div class="row mt-3">
        <div class="col-12 text-center">
            <p class="text-muted">Back to <a href="{{ route('login') }}"
                                                           class="text-primary font-weight-bold ml-1">Login</a></p>
        </div> <!-- end col -->
    </div>
@endsection
