@extends('layouts.auth', ['page_title' => 'Verify Your Email Address', 'heading' => 'Confirm your email', 'sub_heading' => 'Your account has been successfully registered. To
                                    complete the verification process, please check your email for a validation request.'])
@section('form')
    <form method="POST" action="{{ route('verification.resend') }}" class="authentication-form">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif
        @csrf
        <div class="form-group mb-0 text-center">
            <button class="btn btn-primary btn-block" type="submit">Resend email confirmation</button>
        </div>
    </form>
@endsection
@section('footer')
    <div class="row mt-3">
        <div class="col-12 text-center">
            <p class="text-muted">Back to <a href="{{ route('login') }}" class="text-primary font-weight-bold ml-1">Login</a></p>
        </div> <!-- end col -->
    </div>
@endsection
