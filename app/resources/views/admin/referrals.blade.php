@extends('layouts.admin', ['page_title' => 'Referrals'])
@section('content')

    <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="components-preview wide-md mx-auto">
                                 <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title fw-normal">Referrals</h5>
                                        
                                    </div>
                                   
                                </div>
                            </div><!-- .nk-block-head -->
                               <div class="nk-block">
                                <div class="nk-block-head-sm">
                                    <div class="nk-block-head-content">
                                    </div>
                                </div>
                                <div class="row g-gs">
                                    <div class="col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="card card-bordered is-dark">
                                            <div class="nk-wgw">
                                                <div class="nk-wgw-inner">
                                                    <a class="nk-wgw-name" href="#">
                                                        <div class="nk-wgw-icon ">
                                                            <em class="icon ni ni-sign-usd"></em>
                                                        </div>
                                                        <h5 class="nk-wgw-title title">Total Referral Earnings</h5>
                                                    </a>
                                                    <div class="nk-wgw-balance">
                                                        <div class="amount">{{ moneyFormat(get_admin_stats()['referral_bonus'], 'USD') }}</div>
                                                      
                                                    </div>
                                                </div>
                                                <div class="nk-wgw-actions">
                                                    <ul>
                                                        <li><a href="#"><em class="icon ni ni-arrow-up-right"></em> <span>Total Referral Earnings</span></a></li>
                                                    </ul>
                                                </div>
                                                
                                            </div>
                                        </div><!-- .card -->
                                    </div>
                                    
                                     <div class="col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="card card-bordered is-dark">
                                            <div class="nk-wgw">
                                                <div class="nk-wgw-inner">
                                                    <a class="nk-wgw-name" href="#">
                                                        <div class="nk-wgw-icon ">
                                                            <em class="icon ni ni-user"></em>
                                                        </div>
                                                        <h5 class="nk-wgw-title title">Tdoay's Referral</h5>
                                                    </a>
                                                    <div class="nk-wgw-balance">
                                                        <div class="amount">{{ $today_referrals }}</div>
                                                      
                                                    </div>
                                                </div>
                                                <div class="nk-wgw-actions">
                                                    <ul>
                                                        <li><a href="#"><em class="icon ni ni-arrow-up-right"></em> <span>Today's Referrals</span></a></li>
                                                    </ul>
                                                </div>
                                                
                                            </div>
                                        </div><!-- .card -->
                                    </div>
                                    
                                     <div class="col-sm-4 col-lg-4 col-xl-4 col-xxl-4">
                                        <div class="card card-bordered is-dark">
                                            <div class="nk-wgw">
                                                <div class="nk-wgw-inner">
                                                    <a class="nk-wgw-name" href="#">
                                                        <div class="nk-wgw-icon ">
                                                            <em class="icon ni ni-user"></em>
                                                        </div>
                                                        <h5 class="nk-wgw-title title">Total Referrals</h5>
                                                    </a>
                                                    <div class="nk-wgw-balance">
                                                        <div class="amount">{{ $referral_count }}</div>
                                                     
                                                    </div>
                                                </div>
                                                <div class="nk-wgw-actions">
                                                    <ul>
                                                        <li><a href="#"><em class="icon ni ni-arrow-up-right"></em> <span>Total Referrals</span></a></li>
                                                    </ul>
                                                </div>
                                                
                                            </div>
                                        </div><!-- .card -->
                                    </div>
                                    
                                    <!-- .col -->
                                  <!-- .col -->
                                </div><!-- .row -->
                            </div>
                                
                                <div class="nk-block nk-block-lg">
                                    <div class="card card-preview">
                                        <div class="card-inner">
                                            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="true">
                                                <thead>
                                                    <tr class="nk-tb-item nk-tb-head">
                                                        
                                                     <th class="nk-tb-col "><span class="sub-text">Referrer</th>
                                                    <th class="nk-tb-col "><span class="sub-text">Username</th>
                                                    <th class="nk-tb-col "><span class="sub-text">First Name</th>
                                                    <th class="nk-tb-col "><span class="sub-text">Last Name</th>
                                                    <th class="nk-tb-col "><span class="sub-text">Registered Date</th>
                                                    <th class="nk-tb-col "><span class="sub-text">Deposit Status</th>
                                                    <th class="nk-tb-col "><span class="sub-text">Last Deposit</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                             @forelse($referrals as $referral)
                                            <tr>
                                            <td class="nk-tb-col">
                                                <a href="{{ route('admin.users.show', ['id' => $referral->referrer->id]) }}">
                                                    {{ $referral->referrer->username }}
                                                </a>
                                            </td>
                                             <td class="nk-tb-col">
                                                <a href="{{ route('admin.users.show', ['id' => $referral->user->id]) }}">
                                                    {{ $referral->user->username }}
                                                </a>
                                            </td>
                                             <td class="nk-tb-col">{{ $referral->user->first_name }}</th>
                                             <td class="nk-tb-col">{{ $referral->user->last_name }}</th>
                                           <td class="nk-tb-col">{{ $referral->user->created_at->diffForHumans() }}</td>
                                               <td class="nk-tb-col ">
                                                @if( $referral->has_deposit )
                                                <span class="tb-status text-success">Deposit Made</span>
                                                           
                                                @else
                                                    <span class="tb-status text-warning">No deposit made yet</span>
                                                @endif
                                             </td>
                                                      <td>
                                                @if($referral->deposit)
                                                    <a href="{{ $referral->deposit->url }}">{{ $referral->deposit->ref }}</a>
                                                @endif
                                            </td>  
                                                     
                                                    </tr>
                                        @empty
                                            <tr>
                                                <td><span>No Withdrawals Yet</span>
                                                <td>
                                            </tr>
                                        @endforelse


                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- .card-preview -->
                                </div> <!-- nk-block -->
                            </div><!-- .components-preview -->
                        </div>
                    </div>
                </div>


@endsection
@section('scripts')
    <script>
 
          function markDepositExpired(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve!',
                cancelButtonText: 'No, cancel!'
            }).then(function (result) {
                if (result.value) {
                  document.getElementById('formMark').submit();
                }
            });
        }
    </script>
@endsection
