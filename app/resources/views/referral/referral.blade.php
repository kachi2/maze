@extends('layouts.app')
@section('content')

    
     <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                           <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                      
                                    </div>
                                    <div class="nk-block-head-content">
                                      
                                    </div>
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

                            <!-- end of referral -->
                            <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                   
                                    <div class="nk-block-head-content">
                                     
                                    </div>
                                </div>
                            </div>
                        <div class="components-preview wide-md mx-auto">
                         <div class="nk-block nk-block-lg"> 
                                    <div class="card card-preview">
                                        <div class="card-inner">
                                            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                                <thead>
                                                    <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col"><span class="sub-text">Username</th>
                                                 <th class="nk-tb-col"><span class="sub-text">First Name</th>
                                                <th class="nk-tb-col"><span class="sub-text">Last Name</th>
                                                <th class="nk-tb-col"><span class="sub-text">Registered Date</th>
                                                <th class="nk-tb-col"><span class="sub-text">Deposit Status</th>
                                                <th class="nk-tb-col"><span class="sub-text">Last Deposit</th>            
                                                    </tr>
                                                </thead>
                                            @forelse($referrals as $referral)
                                        <tr>
                                             <td class="nk-tb-col">{{ $referral->user->username }}</td>
                                             <td class="nk-tb-col">{{ $referral->user->first_name }}</td>
                                            <td class="nk-tb-col">{{ $referral->user->last_name }}</td>
                                             <td class="nk-tb-col">{{ $referral->user->created_at->diffForHumans() }}</td>
                                             <td class="nk-tb-col">@if( $referral->has_deposit )
                                                    <span class="badge badge-pill badge-success">Deposit made</span>
                                                @else
                                                    <span class="badge badge-pill badge-warning">No deposit made yet</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($referral->deposit)
                                                    {{ moneyFormat($referral->deposit->amount, 'USD') }}
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td><span>No Referrals Yet</span>
                                            <td>
                                        </tr>
                                    @endforelse
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- .card-preview -->
                                </div> 
                                </div>
                         



                        </div>

     </div>
        </div>

@endsection
