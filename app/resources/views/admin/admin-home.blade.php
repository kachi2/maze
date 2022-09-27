@extends('layouts.admin')

@section('content')


 <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Welcome, Admin!</h3>
                                            <div class="nk-block-des text-soft">
                                                <p>At a glance summary of your account. </p>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                
                                <div class="nk-block">
                                    <div class="row g-gs">
                                    <div class="col-md-6">
                                            <div class="card card card-bordered text-light is-dark h-100">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start mb-0">
                                                        <div class="card-title">
                                                            <h6 class="subtitle text-light ">Accumulated Balance</h6>
                                                        </div>
                                                        <div class="card-tools">
                                                            <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Overview of your deposits and investments"></em>
                                                        </div>
                                                    </div>
                                                    <div class="card-amount ">
                                                        <span class="amount text-light"> <span class="currency currency-usd text-light">{{ moneyFormat(get_admin_stats()['wallet_balance'], 'USD') }}</span>
                                                        </span>
                                                    </div>
                                                    <div class="invest-data">
                                                        <div class="invest-data-amount g-2">
                                                            <div class="invest-data-history">
                                                                <div class="title text-light ">Accumulated Bonus</div>
                                                                <div class="amount text-light "><span class="currency currency-ng text-light ">{{ moneyFormat(get_admin_stats()['bonus'], 'USD') }}</span></div>
                                                            </div>
                                                            <div class="invest-data-history">
                                                                <div class="title text-light ">Accumulated Referrals Bonus</div>
                                                                <div class="amount text-light "> <span class="currency currency-NG text-light ">{{ moneyFormat(get_admin_stats()['referral_bonus'], 'USD') }}</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="invest-data-ck">
                                                            <canvas class="iv-data-chart" id="totalDeposit"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card card card-bordered text-light is-dark h-100">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start mb-0">
                                                        <div class="card-title">
                                                            <h6 class="subtitle text-light ">Total Deposits</h6>
                                                        </div>
                                                        <div class="card-tools">
                                                            <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Overview of your deposits and investments"></em>
                                                        </div>
                                                    </div>
                                                    <div class="card-amount ">
                                                        <span class="amount text-light"> <span class="currency currency-usd text-light">{{ moneyFormat($total_deposits, 'USD') }}</span>
                                                        </span>
                                                    </div>
                                                    <div class="invest-data">
                                                        <div class="invest-data-amount g-2">
                                                            <div class="invest-data-history">
                                                                <div class="title text-light ">Active Deposits</div>
                                                                <div class="amount text-light "><span class="currency currency-ng text-light ">{{ moneyFormat($active_deposits, 'USD') }}</span></div>
                                                            </div>
                                                            <div class="invest-data-history">
                                                                <div class="title text-light ">Last Deposit</div>
                                                                <div class="amount text-light "> <span class="currency currency-NG text-light ">{{ moneyFormat($last_deposit, 'USD') }}</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="invest-data-ck">
                                                            <canvas class="iv-data-chart" id="totalDeposit"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card card card-bordered text-light is-dark h-100">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start mb-0">
                                                        <div class="card-title">
                                                            <h6 class="subtitle text-light ">Total Withdrawals</h6>
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
                                                                <div class="title text-light ">Pending Withdrawals</div>
                                                                <div class="amount text-light "> <span class="currency currency-usd text-light ">{{ moneyFormat($pending_withdrawals, 'USD') }}</span></div>
                                                            </div>
                                                             <div class="invest-data-history">
                                                                <div class="title text-light ">Last Withdrawals</div>
                                                                <div class="amount text-light "> <span class="currency currency-usd text-light ">{{ moneyFormat($last_withdrawal, 'USD') }}</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="invest-data-ck">
                                                            <canvas class="iv-data-chart" id="totalDeposit"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card card card-bordered text-light is-dark h-100">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start mb-0">
                                                        <div class="card-title">
                                                            <h6 class="subtitle text-light ">Total Users</h6>
                                                        </div>
                                                        <div class="card-tools">
                                                            <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Users"></em>
                                                        </div>
                                                    </div>
                                                    <div class="card-amount ">
                                                        <span class="amount text-light"> <span class="currency currency-NG text-light ">{{ $total_users }} Registered Users</span>
                                                        </span>
                                                    </div>
                                                    <div class="invest-data">
                                                        <div class="invest-data-amount g-2">
                                                            
                                                            <div class="invest-data-history">
                                                                <div class="title text-light ">Total Admin</div>
                                                                <div class="amount text-light "> <span class="currency currency-usd text-light ">2 Admin Accounts</span></div>
                                                            </div>
                                                              <div class="invest-data-history">
                                                                <div class="title text-light ">Today Users</div>
                                                                <div class="amount text-light "> <span class="currency currency-NG text-light ">{{ $today_users }} Users Registered</span></div>
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
                                       <div class="container-xl wide-lg">
                        <div class="nk-content-body">
            <!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="card card-bordered card-stretch">
                                    <div class="card-inner-group">
                                        <div class="card-inner">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h5 class="title">Recent Activities</h5>
                                                </div>
                                              <!-- .card-search -->
                                            </div><!-- .card-title-group -->
                                        </div><!-- .card-inner -->
                                        <div class="card-inner p-0">
                                            <div class="nk-tb-list nk-tb-tnx">
                                                <div class="nk-tb-item nk-tb-head">
                                                    <div class="nk-tb-col"><span>Activity</span></div>
                                                    <div class="nk-tb-col "><span>User</span></div>
                                                    <div class="nk-tb-col tb-col-lg"><span>Info</span></div>
                                                    <div class="nk-tb-col nk-tb-col-status"><span class="sub-text d-none d-md-block">Status</span></div>
                                                    
                                                </div><!-- .nk-tb-item -->
                                                @if(count($users)> 0 || count($login) > 0 || count($depo) > 0)
                                                @foreach ($users as $uu)
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="nk-tnx-type">
                                                            <div class="nk-tnx-type-icon bg-success-dim text-success">
                                                                <em class="icon ni ni-arrow-right"></em>
                                                            </div>
                                                            <div class="nk-tnx-type-text">
                                                                <span class="tb-lead">New Registration</span>
                                                                <span class="tb-date">{{$uu->created_at->DiffForHumans()}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col ">
                                                        <span class="tb-lead-sub">{{$uu->username}}</span>
                                                        <span class="tb-sub">{{$uu->first_name." ".$uu->last_name}}</span>
                                                    </div>
                                                    <div class="nk-tb-col ">
                                                        <span class="tb-lead-sub">{{$uu->email}}</span>
                                                        <span class="badge badge-dot badge-success">@if($uu->email_verified_at == null) Email Unverified @else Verified @endif</span>
                                                    </div>
                                                   
                                                    <div class="nk-tb-col nk-tb-col-status">
                                                        <div class="dot dot-success d-md-none"></div>
                                                        <span class="badge badge-sm badge-dim badge-outline-success d-none d-md-inline-flex">Active</span>
                                                    </div>
                                                    
                                                </div>
                                                  @endforeach
                                                        @foreach ($login as $ll)
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="nk-tnx-type">
                                                            <div class="nk-tnx-type-icon bg-success-dim text-success">
                                                                <em class="icon ni ni-arrow-right"></em>
                                                            </div>
                                                            <div class="nk-tnx-type-text">
                                                                <span class="tb-lead">Recent Login Users</span>
                                                                <span class="tb-date">{{$ll->created_at->DiffForHumans()}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col ">
                                                        <span class="tb-lead-sub">{{$ll->user->username}}</span>
                                                        <span class="tb-sub">{{$ll->user->email}}</span>
                                                    </div>
                                                    <div class="nk-tb-col ">
                                                        <span class="tb-lead-sub">{{$user->updated_at}}</span>
                                                        <span class="badge badge-dot badge-success">{{$ll->created_at->DiffForHumans()}}</span>
                                                    </div>
                                                   
                                                    <div class="nk-tb-col nk-tb-col-status">
                                                        <div class="dot dot-success d-md-none"></div>
                                                        <span class="badge badge-sm badge-dim badge-outline-success d-none d-md-inline-flex">Completed</span>
                                                    </div>
                                                    
                                                </div>
                                                  @endforeach
                                                        @foreach ($depo as $dd)
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="nk-tnx-type">
                                                            <div class="nk-tnx-type-icon bg-success-dim text-success">
                                                                <em class="icon ni ni-arrow-right"></em>
                                                            </div>
                                                            <div class="nk-tnx-type-text">
                                                                <span class="tb-lead">New Deposit</span>
                                                                <span class="tb-date">{{$dd->created_at->DiffForHumans()}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col ">
                                                        <span class="tb-lead-sub">{{$dd->user->username}}</span>
                                                        <span class="tb-sub">{{ moneyFormat($dd->amount, 'USD') }}</span>
                                                    </div>
                                                    <div class="nk-tb-col ">
                                                        <span class="tb-lead-sub">{{$dd->created_at}}</span>
                                                        <span class="badge badge-dot badge-success">{{$dd->created_at->DiffForHumans()}}</span>
                                                    </div>
                                                   
                                                    <div class="nk-tb-col nk-tb-col-status">
                                                        <div class="dot dot-success d-md-none"></div>
                                                        <span class="badge badge-sm badge-dim badge-outline-success d-none d-md-inline-flex">@if($dd->status == 0) Active @elseif($dd->status == 1) Completed @else Cancelled @endif</span>
                                                    </div>
                                                    
                                                </div>
                                                  @endforeach
                                                      @foreach ($withdw as $ww)
                                                <div class="nk-tb-item">
                                                    <div class="nk-tb-col">
                                                        <div class="nk-tnx-type">
                                                            <div class="nk-tnx-type-icon bg-success-dim text-success">
                                                                <em class="icon ni ni-arrow-right"></em>
                                                            </div>
                                                            <div class="nk-tnx-type-text">
                                                                <span class="tb-lead">New Withdrawal</span>
                                                                <span class="tb-date">{{$ww->created_at->DiffForHumans()}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col ">
                                                        <span class="tb-lead-sub">{{$ww->user->username}}</span>
                                                        <span class="tb-sub">{{ moneyFormat($dd->amount, 'USD') }}</span>
                                                    </div>
                                                    <div class="nk-tb-col ">
                                                        <span class="tb-lead-sub">{{$ww->created_at}}</span>
                                                        <span class="badge badge-dot badge-success">{{$ww->created_at->DiffForHumans()}}</span>
                                                    </div>
                                                   
                                                    <div class="nk-tb-col nk-tb-col-status">
                                                        <div class="dot dot-success d-md-none"></div>
                                                        <span class="badge badge-sm badge-dim badge-outline-success d-none d-md-inline-flex">@if($ww->status == 0) Active @elseif($ww->status == 1) Completed @else Cancelled @endif</span>
                                                    </div>
                                                    
                                                </div>
                                                  @endforeach

                                                @endif<!-- .nk-tb-item -->
                                            <!-- .nk-tb-item -->
                                            </div><!-- .nk-tb-list -->
                                        </div><!-- .card-inner -->
                                        <div class="card-inner">
                                           
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- .card -->
                            </div><!-- .nk-block -->
                        </div>
                    </div>
                                    </div>
                                </div>

                               
                            </div>
                        </div>
                    </div>
                </div>
@endsection
