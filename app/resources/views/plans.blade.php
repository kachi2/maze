@extends('layouts.landing', ['page_title' => 'Plans', 'heading' => 'Mining Pricing List', 'sub_heading' => 'Enjoy real benefits and rewards on your accrue mining.'])
@section('content')
@include('partials.landing-header')
 <!-- Banner Area Starts -->
        <section class="banner-area">
            <div class="banner-overlay">
                <div class="banner-text text-center">
                    <div class="container">
                        <!-- Section Title Starts -->
                        <div class="row text-center">
                            <div class="col-xs-12">
                                <!-- Title Starts -->
                                <h2 class="title-head">Investment <span>Plans</span></h2>
                                <!-- Title Ends -->
                                <hr>
                                <!-- Breadcrumb Starts -->
                                <ul class="breadcrumb">
                                    <li><a href="/"> home</a></li>
                                    <li>Plans</li>
                                </ul>
                                <!-- Breadcrumb Ends -->
                            </div>
                        </div>
                        <!-- Section Title Ends -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Banner Area Ends -->
       
        <!-- Pricing Starts -->
        <section class="pricing">
            <div class="container">
                <div class="row text-center">
                    <h2 class="title-head">affordable investment <span>packages</span></h2>
                    <div class="title-head-subtitle">
                        <p>Choose a plan that fits your life style</p>
                    </div>
                </div>

                <div class="row pricing-tables-content">
                    <div class="pricing-container">
                        <ul class="pricing-list bounce-invert">
                            @foreach($packages as $package)
                               @foreach($package->plans as $plan)
                            <li class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                <ul class="pricing-wrapper">
                                    <li data-type="buy" class="is-visible">
                                        <header class="pricing-header">
                                           <h6 style="color: #FD961A; font-weight: bolder;">{{ $package->name }}({{ $plan->name }})</h6>
                                            <div class="price">
                                            
                                                <span class="value">{{ $plan->profit_rate }}</span>
                                                <span class="currency">%</span>
                                                
                                            </div>
                                            <h2>{{ $package->formatted_payment_period_alt2 }}</h2>
                                            <br>
                                            <h6 style="color: #fff;">Minimum Investment: {{ moneyFormat($plan->min_deposit, 'USD') }}</h6>
                                            <h6 style="color: #fff;">Maximum Investment: {{ moneyFormat($plan->max_deposit, 'USD') }}</h6>
                                        </header>
                                        <footer class="pricing-footer">
                                            <a href="register" class="btn btn-primary">Select Plan</a>
                                        </footer>
                                    </li>
                                </ul>
                                @endforeach
                             @endforeach
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- Pricing Ends -->
        
@include('partials.landing-footer')
@endsection
