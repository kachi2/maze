@extends('layouts.app')
@section('content')
    <div class="body-content row">
        <div class="col-lg-3 order-lg-last">
            <div class="card">
                <div class="card-body">
                    <div class="mail-list mt-4">
                        <a href="{{ route('setting.profile') }}" class="list-group-item border-0 {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'setting.profile' ? 'text-danger font-weight-bold' : '' }}">
                            <i class="uil uil-user font-size-15 mr-1"></i>Profile</a>
                        <a href="{{ route('setting.password') }}" class="list-group-item border-0 {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'setting.password' ? 'text-danger font-weight-bold' : '' }}"><i
                                class="uil uil-lock font-size-15 mr-1"></i>Password</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            @yield('form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
