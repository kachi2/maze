@extends('layouts.app')
@section('content')
     <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">My Payouts</h3>
                                            <div class="nk-block-des text-soft">
                                                <p>You have total {{count($payouts)}} Transactions.</p>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                       <li class="order-md-last">
                                                   <a href="{{ route('user.packages') }}" class="btn btn-primary"><i
                                                    class='uil uil-plus mr-1'></i>Make Deposit</a>
                                            <a href="{{ route('deposits') }}" class="btn btn-primary ml-2"><i
                                                    class='uil uil-chart mr-1'></i>View Deposits</a>
                                        
                                            </li>
                                            </ul>
                                                </div>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="card card-bordered card-stretch">
                                        <div class="card-inner-group">
                                            <div class="card-inner">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h5 class="title">Daily Payouts</h5>
                                                    </div>
                                                    <div class="card-search search-wrap" data-search="search">
                                                        <form method="get">
                                                        <div class="search-content">
                                                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                            <input type="text" name="search" value="{{ request()->input('search') }}" 
                                                   placeholder="Search..."  class="form-control border-transparent form-focus-none" >
                                                            <button class="search-submit btn btn-icon" type="submit"><em class="icon ni ni-search"></em></button>
                                                        </div>
                                                        </form>
                                                    </div><!-- .card-search -->
                                                </div><!-- .card-title-group -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner p-0">
                                                <div class="nk-tb-list nk-tb-tnx">
                                                    <div class="nk-tb-item nk-tb-head">
                                                        <div class="nk-tb-col"><span>#Ref</span></div>
                                                        <div class="nk-tb-col "><span>Plan</span></div>
                                                        <div class="nk-tb-col "><span>Amount</span></div>
                                                        <div class="nk-tb-col  tb-col-sm"><span>Date</span></div>
                                                       
                                                    </div><!-- .nk-tb-item -->
                                                @forelse($payouts as $payout)
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col">
                                                            <div class="nk-tnx-type">
                                                               
                                                                <div class="nk-tnx-type-text">
                                                                    <span class="tb-lead">{{$payout->ref}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-lg">
                                                            <span class="tb-lead-sub">{{ $payout->plan->name }}</span>
                                                            <span class="badge badge-dot badge-success">{{ $payout->plan->profit_rate}}% Daily for {{ $payout->plan->package->duration}} Days</span>
                                                        </div>
                                                        <div class="nk-tb-col ">
                                                            <span class="tb-amount">{{moneyFormat($payout->amount,'USD')}}</span>
                                                        </div>

                                                         <div class="nk-tb-col tb-col-sm">
                                                            <span class="tb-amount">{{$payout->created_at}}</span>
                                                        </div>
                                                    </div><!-- .nk-tb-item --> 
                                                  @empty
                                                    <div class="nk-tb-col  tb-col-sm">
                                                            <span class="tb-amount">No Payouts Yet</span>
                                                        </div>
                                                  @endforelse

                                                    
                                                </div><!-- .nk-tb-list -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner">
                                               {{$payouts->links()}}
                                            </div><!-- .card-inner -->
                                        </div><!-- .card-inner-group -->
                                    </div><!-- .card -->
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                    </div>
                </div>
               
@endsection
@section('scripts')
    <script>

let message = {!! json_encode(Session::get('message')) !!};
let msg = {!! json_encode(Session::get('alert')) !!};


if(message != null){
toastr.clear();
    NioApp.Toast(message , msg, {
      position: 'top-right',
        timeOut: 5000,
    });
}

</script>
@endsection





