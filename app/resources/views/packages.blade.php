@extends('layouts.app')
@section('content')
<div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                           <div class="nk-block-between g-3 p-2">
                               <div class="nk-block-head-content">
                                   <h3 class="nk-block-title page-title">Investment Package</h3>
                                   <div class="nk-block-des text-soft"><p>Select Investment Package and start enjoying our service.</p>
                                   </div></div></div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="card card-custom-s1 ">
                                    <div class="row no-gutters">
                                    @forelse($packages as $package)
                                        @foreach($package->plans as $plan)
                                      <div class="col-md-6 col-xxl-3"><div class="card card-bordered pricing">
                                <div class="pricing-head"><div class="pricing-title">
                                    <h4 class="card-title title">{{ $package->name }}({{ $plan->name }})</h4>
                                    <p class="sub-text">  invest  in {{ $plan->name }} &amp; earn {{ $plan->profit_rate }}% interest.</p></div>
                                    <div class="card-text"><div class="row"><div class="col-6">
                                        <span class="h4 fw-500">{{ $plan->profit_rate }}%</span><span class="sub-text">{{ $package->formatted_payment_period_alt2 }} Interest</span></div>
                                        <div class="col-6"><span class="h4 fw-500">7</span><span class="sub-text">Days</span></div></div></div>
                                        </div><div class="pricing-body"><ul class="pricing-features"><li><span class="w-50">Min Deposit</span> - <span class="ml-auto">{{ moneyFormat($plan->min_deposit, 'USD') }}</span></li>
                                        <li><span class="w-50">Max Deposit</span> - <span class="ml-auto">{{ moneyFormat($plan->max_deposit, 'USD') }}</span></li>
                                        <li ><span class="w-50">24x7 Support</span> - <span class="ml-auto">Yes</span></li>
                                        <li><span class="w-50">Automatic Withdrawal</span> - <span class="ml-auto">Yes</span></li>
                                        
                                        </ul>
                                        <div class="pricing-action">
                                            <a href="{{ route('deposits.invest', ['id' => encrypt($plan->id)]) }}" class="btn btn-primary">Choose this plan</a>
                                            </div></div></div></div>
                                     @endforeach
                                        @empty
                                         @endforelse 
                                        <!-- .col -->
                                        <!-- .col -->
                                    </div><!-- .row -->
                                </div><!-- .card -->
                            </div><!-- .nk-block -->
                           
                        </div>
                    </div>
                </div>

@endsection