@extends('layouts.settings', ['page_title' => 'Password Settings'])
@section('form')
    <form method="post" action="{{ route('setting.password') }}">
        @csrf

        <div class="form-group">
            <label for="inputOldPassword">Current Password</label>
            <input type="password" name="old_password"
                   value="{{ old('old_password') }}"
                   class="form-control {{ form_invalid('old_password') }}" id="inputOldPassword" placeholder="Enter old password">
            @showError('old_password')
        </div>

        <div class="form-group">
            <label for="inputNewPassword">New Password</label>
            <input type="password" name="password"
                   value="{{ old('password') }}"
                   class="form-control {{ form_invalid('password') }}" id="inputNewPassword" placeholder="Enter new password">
            @showError('password')
        </div>

        <div class="form-group">
            <label for="inputRepeatPassword">Repeat Password</label>
            <input type="password" name="password_confirmation"
                   value="{{ old('password_confirmation') }}"
                   class="form-control {{ form_invalid('password_confirmation') }}" id="inputRepeatPassword" placeholder="Confirm password">
            @showError('password_confirmation')
        </div>

        <button type="submit" class="btn btn-primary">Update password</button>
    </form>
@endsection
