@extends('layouts.auth', ['page_title' => 'Reset Password', 'heading' => 'Reset Password', 'sub_heading' => 'Enter your email address and we\'ll send you an email with instructions to reset your password.'])
@section('form')
    <p class="mb-5">
    </p>
    <form method="POST" action="{{ route('password.email') }}" class="authentication-form">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @csrf
        <div class="form-group mb-4">
            <label class="form-control-label" for="InputEmail">Email Address</label>
            <div class="input-group input-group-merge">
                <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="icon-dual" data-feather="mail"></i>
                        </span>
                </div>
                <input type="email" name="email"
                       value="{{ old('email') }}"
                       class="form-control {{ form_invalid('email') }}"
                       id="InputEmail"
                       placeholder="hello@example.com"
                       required>
                @showError('email')
            </div>
        </div>

        <div class="form-group mb-0 text-center">
            <button class="btn btn-primary btn-block" type="submit">Submit</button>
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
