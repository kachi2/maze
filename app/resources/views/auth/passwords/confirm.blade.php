@extends('layouts.auth', ['page_title' => 'Confirm Password', 'heading' => 'Confirm Password!', 'sub_heading' => 'Please confirm your password before continuing.'])
@section('form')
    <form method="POST" action="{{ route('password.confirm') }}" class="authentication-form">
        @csrf
        <div class="form-group mb-4">
            <label class="form-control-label" for="InputPassword">Password</label>
            <a href="{{ route('password.request') }}" class="float-right text-muted text-unline-dashed ml-1">Forgot your password?</a>
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

        <div class="form-group mb-0 text-center">
            <button class="btn btn-primary btn-block" type="submit">Confirm Password</button>
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
