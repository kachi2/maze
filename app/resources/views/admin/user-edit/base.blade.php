@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-3 order-lg-last">
            <div class="card">
                <div class="card-body">
                    <div class="mail-list mt-4">
                        <a href="{{ tab_url('profile') }}" class="list-group-item border-0 {{ is_tab('profile', true) ? 'text-danger font-weight-bold' : '' }}">
                            <i class="uil uil-user font-size-15 mr-1"></i>Profile</a>
                        <a href="{{ tab_url('password') }}" class="list-group-item border-0 {{ is_tab('password') ? 'text-danger font-weight-bold' : '' }}"><i
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
