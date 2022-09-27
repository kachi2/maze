<!-- Body-content -->
@extends('layouts.mobile')
@section('content')

<div class="body-content body-content-lg"> <!-- "body-content-lg" add this class if any cards inside this div has "section-to-header" class -->
    <div class="container">

<div class="monthly-bill-section pb-15">
    <div class="section-header">
        <h2>Available Plans
            <br>
            <small style="font-size:12px; font-weight:200">  Select the Plan that suits your savings plan</small>
        </h2>
        
    </div>
    <div class="row gx-3">

        @forelse($packages as $package)
        @foreach($package->plans as $plan)
        <div class="col-6 pb-15">
            <div class="monthly-bill-card monthly-bill-card-green">
                <div class="monthly-bill-thumb">
                    <img src="{{asset('/mobile/images/'.$plan->image)}}" alt="logo">
                </div>
                <div class="monthly-bill-body">
                    <h3><a href="{{ route('deposits.invest', ['id' => encrypt($plan->id)]) }}">{{ $plan->name }}</a></h3>
                    <p>invest  and earn {{ $plan->profit_rate }}% interest
                        <br> Daily for {{ $package->duration }} Days.</p>
                    <p>Min Deposit: {{ moneyFormat($plan->min_deposit, 'USD') }} </p>
                    <p>Max Deposit: {{ moneyFormat($plan->max_deposit, 'USD') }}.</p>
                </div>
                <div class="monthly-bill-footer monthly-bill-action">
                    <a href="{{ route('deposits.invest', ['id' => encrypt($plan->id)]) }}" class="btn main-btn">Select Plan</a>
                  
                </div>
            </div>
        </div>
        @endforeach
        @empty
         @endforelse 
        
        
    </div>
</div>

<div class="saving-goals-section pb-15">
    <div class="section-header">
        <h2>Top Invested Plans
            <br>
            <small style="font-size:12px; font-weight:200">  Weekly top Investment Plans</small>
        </h2>
    </div>
    <div class="progress-card progress-card-red mb-15">
        <div class="progress-card-info">
            <div class="circular-progress" data-note="{{count($data['basic'])+count($data['basic'])}}">
                <svg width="55" height="55" class="circle-svg">
                    <circle cx="28" cy="27" r="25" class="circle-progress circle-progress-path"></circle>
                    <circle cx="28" cy="27" r="25" class="circle-progress circle-progress-fill"></circle>
                </svg>
                <div class="percent">
                    <span class="percent-int">0</span>%
                </div>
            </div>
            <div class="progress-info-text">
                <h3>STARTER PLAN</h3>
                <p></p>
            </div>
        </div>
        <div class="progress-card-amount">{{number_format(count($data['basic']) * 100 + count($data['basic']))}} Active Investments</div>
    </div>
    <div class="progress-card progress-card-blue mb-15">
        <div class="progress-card-info">
            <div class="circular-progress" data-note="{{count($data['basic'])+count($data['basic'])}}">
                <svg width="55" height="55" class="circle-svg">
                    <circle cx="28" cy="27" r="25" class="circle-progress circle-progress-path"></circle>
                    <circle cx="28" cy="27" r="25" class="circle-progress circle-progress-fill"></circle>
                </svg>
                <div class="percent">
                    <span class="percent-int">0</span>%
                </div>
            </div>
            <div class="progress-info-text">
                <h3>PREMIUM PLAN</h3>
            </div>
        </div>
        <div class="progress-card-amount">{{number_format(count($data['standard']) * 100 + count($data['standard']) )}} Active Investments</div>
    </div>
    <div class="progress-card progress-card-yellow mb-15">
        <div class="progress-card-info">
            <div class="circular-progress" data-note="{{count($data['basic'])+count($data['basic'])}}">
                <svg width="55" height="55" class="circle-svg">
                    <circle cx="28" cy="27" r="25" class="circle-progress circle-progress-path"></circle>
                    <circle cx="28" cy="27" r="25" class="circle-progress circle-progress-fill"></circle>
                </svg>
                <div class="percent">
                    <span class="percent-int">0</span>%
                </div>
            </div>
            <div class="progress-info-text">
                <h3>PROFESSIONAL PLAN</h3>
            </div>
        </div>
        <div class="progress-card-amount">{{number_format(count($data['premium']) * 100 + count($data['premium']))}} Active Investments</div>
    </div>

    <div class="progress-card progress-card-green mb-15">
        <div class="progress-card-info">
            <div class="circular-progress" data-note="{{count($data['mega'])+60.1}}">
                <svg width="55" height="55" class="circle-svg">
                    <circle cx="28" cy="27" r="25" class="circle-progress circle-progress-path"></circle>
                    <circle cx="28" cy="27" r="25" class="circle-progress circle-progress-fill"></circle>
                </svg>
                <div class="percent">
                    <span class="percent-int">0</span>%
                </div>
            </div>
            <div class="progress-info-text">
                <h3>MEGA PLAN</h3>
            </div>
        </div>
        <div class="progress-card-amount">{{number_format(count($data['mega']) + 100 + count($data['mega']))}} Active Investments</div>
    </div>
</div>
</div>
</div>


@endsection