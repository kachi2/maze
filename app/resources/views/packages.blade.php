@extends('layouts.app')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Investment Plans</h3>
                            <div class="nk-block-des text-soft">
                                <p>Choose the Investment plan that suits you</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="row g-gs">
                        @forelse($packages as $package)
                        @foreach($package->plans as $plan)
                        <div class="col-sm-6 col-lg-4 col-xxl-3">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="project">
                                        <div class="project-head">
                                            <a href="html/apps-kanban.html" class="project-title">
                                                <div class="user-avatar sq bg-purple"><span>{{strtoupper(substr($package->name,0,2))}}</span></div>
                                                <div class="project-info">
                                                    <h6 class="title">{{$package->plans[0]->name}}</h6>
                                                    <span class="sub-text">{{$package->duration}} Days</span>
                                                </div>
                                            </a>
                                            
                                        </div>
                                        <div class="project-details">
                                            <p></p>
                                        </div>
                                        <div class="project-progress">
                                            <div class="project-progress-details">
                                                <div class="project-progress-task"><em class="icon ni ni-check-round-cut"></em><span> Max Deposit</span></div>
                                                <div class="project-progress-percent">{{moneyFormat($package->plans[0]->min_deposit,'USD')}}</div>
                                            </div>
                                            <div class="project-progress-details">
                                                <div class="project-progress-task"><em class="icon ni ni-check-round-cut"></em><span> Min Deposit</span></div>
                                                <div class="project-progress-percent">{{moneyFormat($package->plans[0]->max_deposit,'USD')}}</div>
                                            </div>
                                            <div class="project-progress-details">
                                                <div class="project-progress-task"><em class="icon ni ni-check-round-cut"></em><span>% {{$package->formatted_duration}} Payouts</span></div>
                                                <div class="project-progress-percent">{{$package->plans[0]->profit_rate,'USD'}}%</div>
                                            </div>
                                        
                                            <div class="project-progress-details">
                                                <div class="project-progress-task"><em class="icon ni ni-check-round-cut"></em><span> Profit Rate</span></div>
                                                <div class="project-progress-percent">{{$package->plans[0]->profit,'USD'}}%</div>
                                                
                                            </div>
                                        </div>
                                        <div class="project-meta">
                                            <a href="{{ route('web.deposits.invest', ['id' => encrypt($plan->id)]) }}" class="btn btn-outline-primary">Choose this plan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> @endforeach
                        @empty
                         @endforelse 
                     
                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>

@endsection