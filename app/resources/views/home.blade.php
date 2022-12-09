



@extends('layouts.app')
@section('content')
 <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        @if($profile == 100)
                                        <div class="nk-block-head-content">
                                            <h6 class="nk-block-title page-title">Howdy!, {{strtoupper(auth()->user()->first_name)}}!</h6>
                                            <div class="nk-block-des text-soft">
                                                <p> @php $timeOfDay = date('a');
                                                    if($timeOfDay == 'am'){
                                                        echo 'Good Morning, Welcome back';
                                                    }else{
                                                        echo 'Good Day, Welcome back';
                                                    }
                                                    @endphp </p>
                                            </div>
                                        </div><!-- .nk-block-head-content -->   
                                               @else
                                                <div class="alert alert-primary alert-thick alert-plain">
                                                <div class="alert-cta flex-wrap flex-md-nowrap g-2">
                                                    <div class="alert-text has-icon">
                                                        <em class="icon ni ni-info-fill text-primary"></em>
                                                        <span style="color:#000">Update your account information from your profile to complete account setup.</span>
                                                        <div class="progress" style="height: 15px;">
                                                          <div class="progress-bar" role="progressbar" style="width: {{$profile}}%;" aria-valuenow="{{$profile}}" aria-valuemin="0" aria-valuemax="100">{{$profile}}% Completed</div>
                                                        </div>
                                                    </div>
                                                    <div class="alert-actions my-1 my-md-0">
                                                        <a href="{{route('web.account')}}"  class="link link-primary">Update Profile</a>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        @endif
                                      <!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                
                                <div class="nk-block">
                                    <div class="row g-gs">
                                    <div class="col-md-4">
                                            <div class="card card card-bordered text-light is-dark h-100">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start mb-0">
                                                        <div class="card-title">
                                                            <h6 class="subtitle text-light ">AVAILABLE BALANCE</h6>
                                                        </div>
                                                        <div class="card-tools">
                                                            <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Overview of your deposits and investments"></em>
                                                        </div>
                                                    </div>
                                                    <div class="card-amount ">
                                                        <span class="amount text-light"> <span class="currency currency-usd text-light">{{ moneyFormat(auth()->user()->wallet->amount, 'USD') }}</span>
                                                        </span>
                                                    </div>
                                                    <div class="invest-data">
                                                        <div class="invest-data-amount g-2">
                                                            <div class="invest-data-history">
                                                                <div class="title text-light ">Bonus Balance</div>
                                                                <div class="amount text-light "><span class="currency currency-ng text-light ">{{ moneyFormat(auth()->user()->wallet->bonus, 'USD')}}</span></div>
                                                            </div>
                                                            <div class="invest-data-history">
                                                                <div class="title text-light ">Payouts Balance</div>
                                                                <div class="amount text-light "> <span class="currency currency-NG text-light ">{{ moneyFormat($payouts, 'USD')}}</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="invest-data-ck">
                                                            <canvas class="iv-data-chart" id="totalDeposit"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card card card-bordered text-light is-dark h-100">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start mb-0">
                                                        <div class="card-title">
                                                            <h6 class="subtitle text-light ">TOTAL DEPOSITS</h6>
                                                        </div>
                                                        <div class="card-tools">
                                                            <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Overview of your deposits and investments"></em>
                                                        </div>
                                                    </div>
                                                    <div class="card-amount ">
                                                        <span class="amount text-light"> <span class="currency currency-usd text-light"> {{ moneyFormat($total_deposits, 'USD') }}</span>
                                                        </span>
                                                    </div>
                                                    <div class="invest-data">
                                                        <div class="invest-data-amount g-2">
                                                            <div class="invest-data-history">
                                                                <div class="title text-light ">Amount Invested</div>
                                                                <div class="amount text-light "><span class="currency currency-ng text-light ">{{ moneyFormat($total_invest, 'USD') }}</span></div>
                                                            </div>
                                                            <div class="invest-data-history">
                                                                <div class="title text-light ">Active Investment</div>
                                                                <div class="amount text-light "> <span class="currency currency-NG text-light ">{{ moneyFormat($active_deposits, 'USD') }}</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="invest-data-ck">
                                                            <canvas class="iv-data-chart" id="totalDeposit"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card card card-bordered text-light is-dark h-100">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start mb-0">
                                                        <div class="card-title">
                                                            <h6 class="subtitle text-light ">TOTAL WITHDRAWALS</h6>
                                                        </div>
                                                        <div class="card-tools">
                                                            <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Overview of your withdrawals"></em>
                                                        </div>
                                                    </div>
                                                    <div class="card-amount ">
                                                        <span class="amount text-light"> <span class="currency currency-NG text-light ">{{ moneyFormat($total_withdrawals, 'USD') }}</span>
                                                        </span>
                                                    </div>
                                                    <div class="invest-data">
                                                        <div class="invest-data-amount g-2">
                                                            <div class="invest-data-history">
                                                                <div class="title text-light ">Pending</div>
                                                                <div class="amount text-light "><span class="currency currency-usd text-light ">{{ moneyFormat($pending_withdrawals, 'USD') }}</span></div>
                                                            </div>
                                                            <div class="invest-data-history">
                                                                <div class="title text-light ">Approved Withdrawal</div>
                                                                <div class="amount text-light "> <span class="currency currency-usd text-light ">{{ moneyFormat($paid_withdrawal, 'USD') }}</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="invest-data-ck">
                                                            <canvas class="iv-data-chart" id="totalDeposit"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div>
                                        <!-- .col -->
                                        <!-- .col -->
                                       <div class="col-md-6 col-xxl-4">
                                            <div class="card card-bordered card-full">
                                                <div class="card-inner border-bottom">
                                                    <div class="card-title-group">
                                                        <div class="card-title">
                                                            <h6 class="title">Recent Activities</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="nk-activity">
                                                
                                                @forelse ($depo as $depos )
                                                    <li class="nk-activity-item">
                                                        <div class="nk-activity-media user-avatar bg-success"><img src="./images/avatar/c-sm.jpg" alt=""></div>
                                                        <div class="nk-activity-data">
                                                            <div class="label">You invested {{moneyFormat($depos->amount, 'USD')}} on {{$depos->plan->name}}</div>
                                                            <span class="time">{{$depos->created_at->DiffForHumans()}}</span>
                                                        </div>
                                                    </li>
                                             @empty
                                             <li class="nk-activity-item">
                                                        <div class="nk-activity-data">
                                                            <div class="label">No Activity recorded yet</div>
                                                         </div>
                                                    </li>
                                             @endforelse
                                                @forelse ($withdw as $act )
                                                    <li class="nk-activity-item">
                                                        <div class="nk-activity-media user-avatar bg-success"><img src="./images/avatar/c-sm.jpg" alt=""></div>
                                                        <div class="nk-activity-data">
                                                            <div class="label">You Requested for a withdrawals of {{moneyFormat($act->amount, 'USD')}}</div>
                                                            <span class="time">{{$act->created_at->DiffForHumans()}}</span>
                                                        </div>
                                                    </li>
                                             @empty
                                             @endforelse
                                                </ul>
                                            </div><!-- .card -->
                                        </div>
                                        
                                        <!-- .col -->
                                        <div class="col-md-6 col-xxl-4">
                                            <div class="card card-bordered card-full">
                                                <div class="card-inner d-flex flex-column h-100">
                                                    <div class="card-title-group mb-3">
                                                        <div class="card-title">
                                                            <h6 class="title">Top Invested Plan</h6>
                                                            <p>In last 7 days top invested schemes.</p>
                                                        </div>
                                                    </div>
                                                    <div class="progress-list gy-3">
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">Basic Plan</div>
                                                                <div class="progress-amount">{{count($basic)+60.1}}%</div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                <div class="progress-bar" data-progress="{{count($basic)+50}}"></div>
                                                            </div>
                                                        </div>
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">Standard Plan</div>
                                                                <div class="progress-amount">{{count($standard)+40}}%</div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                <div class="progress-bar bg-orange" data-progress="{{count($standard) + 40}}"></div>
                                                            </div>
                                                        </div>
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">Premium Plan</div>
                                                                <div class="progress-amount">{{count($premium) + 30}}%</div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                <div class="progress-bar bg-teal" data-progress="{{count($premium) + 30}}"></div>
                                                            </div>
                                                        </div>
                                                        <div class="progress-wrap">
                                                            <div class="progress-text">
                                                                <div class="progress-label">Mega Plan</div>
                                                                <div class="progress-amount">{{count($mega) + 35}}%</div>
                                                            </div>
                                                            <div class="progress progress-md">
                                                                <div class="progress-bar bg-pink" data-progress="{{count($mega) + 35}}"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="invest-top-ck mt-auto">
                                                        <canvas class="iv-plan-purchase" id="planPurchase"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-xl-12 col-xxl-8">
                                            <div class="card card-bordered card-full">
                                                <div class="card-inner border-bottom">
                                                    <div class="card-title-group">
                                                        <div class="card-title">
                                                            <h6 class="title">Recent Investment</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-list">
                                                    <div class="nk-tb-item nk-tb-head">
                                                        <div class="nk-tb-col"><span>Plan</span></div>
                                                        <div class="nk-tb-col"><span>Paid</span></div>
                                                        <div class="nk-tb-col tb-col-lg"><span>Total Return</span></div>
                                                        <div class="nk-tb-col"><span>Payment Method</span></div>
                                                        <div class="nk-tb-col tb-col-sm"><span>Status</span></div>
                                                        <div class="nk-tb-col"><span>Expires At</span></div>
                                                    </div>

                                            @forelse ($investment as $invst )
                                            <div class="nk-tb-item">
                                                        <div class="nk-tb-col">
                                                            <div class="align-center">
                                                                <div class="user-avatar user-avatar-sm bg-light">
                                                                    <span>{{substr($invst->plan->name,0,2)}}</span>
                                                                </div>
                                                                <span class="tb-sub ml-2">{{$invst->plan->name}} <span class="d-none d-md-inline">- Daily {{$invst->profit_rate}}% for {{$invst->duration}} Days</span></span>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <div class="user-card">
                                                                <div class="user-name">
                                                                    <span class="tb-lead">{{moneyFormat($invst->amount, 'USD')}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-lg">
                                                            <span class="tb-sub">{{moneyFormat($invst->paid_amount, 'USD')}}</span>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span class="tb-sub tb-amount"> <span>{{$invst->payment_method}}</span></span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-sm">
                                                            @if($invst->status == 1)
                                                                <small> completed</small>
                                                                    <div class="progress progress-sm w-80px">
                                                                <div class="progress-bar" data-progress="100" ></div>
                                                                </div>
                                                                @else
                                                                <small>Running</small>
                                                                <div class="progress progress-sm w-80px">
                                                                <div class="progress-bar progress-bar progress-bar-striped progress-bar-animated" data-progress="{{$invst->duration *10}}"></div>
                                                               </div>
                                                                @endif
                                                        </div>
                                                    <div class="nk-tb-col">
                                                            <span class="tb-sub">{{$invst->expires_at->DiffForHumans()}}</span>
                                                     </div>         
                                            </div>
                                             @empty

                                             <div class="nk-tb-col">
                                                            <div class="align-center">
                                                                <span class="tb-sub ml-2"> You don't have any investment recorded yet</span>
                                                            </div>
                                                        </div>

                                            @endforelse

                                                </div>
                                            </div><!-- .card -->
                                        </div><!-- .col -->
                           

                   


                                    </div>
                                </div>

                                 <div class="nk-block">
                                <div class="card card-bordered">
                                    <div class="nk-refwg">
                                        <div class="nk-refwg-invite card-inner">
                                            <div class="nk-refwg-head g-3">
                                                <div class="nk-refwg-title">
                                                    <h5 class="title">Refer Us & Earn</h5>
                                                    <div class="title-sub">Use the bellow link to invite your friends.</div>
                                                </div>
                                                
                                            </div>
                                            <div class="nk-refwg-url">
                                                <div class="form-control-wrap">
                                                    <div class="form-clip clipboard-init" data-clipboard-target="#refUrl" data-success="Copied" data-text="Copy Link"><em class="clipboard-icon icon ni ni-copy"></em> <span class="clipboard-text">Copy Link</span></div>
                                                    <div class="form-icon">
                                                        <em class="icon ni ni-link-alt"></em>
                                                    </div>
                                                    <input type="text" class="form-control copy-text" id="refUrl" value="{{ auth_user()->ref_url }}">
                                                </div>
                                            </div>
                                        </div><!-- .nk-refwg-invite -->
                                        <div class="nk-refwg-stats card-inner bg-lighter">
                                            <div class="nk-refwg-group g-3">
                                                <div class="nk-refwg-name">
                                                    <h6 class="title">My Referral <em class="icon ni ni-info" data-toggle="tooltip" data-placement="right" title="Referral Informations"></em></h6>
                                                </div>
                                                <div class="nk-refwg-info g-3">
                                                    <div class="nk-refwg-sub">
                                                        <div class="title">{{ get_stats()['referral_count'] }}</div>
                                                        <div class="sub-text">Total Referals</div>
                                                    </div>
                                                    <div class="nk-refwg-sub">
                                                        <div class="title">{{ moneyFormat(get_stats()['all_time_referral_bonus'], 'USD') }}</div>
                                                        <div class="sub-text">Referral Earn</div>
                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="nk-refwg-ck">
                                                <canvas class="chart-refer-stats" id="refBarChart"></canvas>
                                            </div>
                                        </div><!-- .nk-refwg-stats -->
                                    </div><!-- .nk-refwg -->
                                </div><!-- .card -->
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection

