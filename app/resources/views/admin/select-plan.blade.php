@extends('layouts.admin', ['page_title' => 'Select Plan'])
@section('content')
    <div class="row">
        @forelse($packages as $package)
            @foreach($package->plans as $plan)

                <div class="col-md-3 col-sm-12" style="margin-bottom: 10px;">
                  <div class="pricingTable">
                      <div class="pricingTable-header">
                          <h3 class="title">{{ $plan->package->name }} ({{ $plan->name }})</h3>
                          <span class="duration">{{ $plan->profit_rate }}% / {{ $plan->package->formatted_payment_period_alt }}</span>
                      </div>
                      <div class="pricing-content">
                          <div class="price-value">
                              <span class="amount">{{ $plan->profit_rate }}%</span>
                          </div>
                          <ul class="inner-content">
                            <li class="text-black">Minimum Deposit: {{ moneyFormat($plan->min_deposit, 'USD') }}</li>
                            <li class="text-black">Maximum Deposit: {{ moneyFormat($plan->max_deposit, 'USD') }}</li>
                            <li class="text-black"><i class="fa fa-check"></i> Automatic Withdrawal</li>
                            <li class="text-black"><i class="fa fa-check"></i> 24x7 Support</li>              
                          </ul>
                          <div class="pricingTable-signup">
                              <a href="{{ route('admin.deposits.add', ['id' => $plan->id]) }}" class="pricing_action">Choose plan</a>
                          </div>
                      </div>
                  </div>
              </div>
                
            @endforeach
        @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-4">
                        No Package yet
                    </div>
                </div>
            </div>
        @endforelse        
    </div>
@endsection
