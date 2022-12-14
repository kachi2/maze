@extends('layouts.app')
@section('content')
     <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Withdrawal Accounts</h3>
                                             
                                        </div><!-- .nk-block-head-content -->
                                       
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li><a href="{{ route('web.withdrawals.request') }}" class="btn btn-white btn-dim btn-outline-light"><em class="icon ni ni-arrow-up"></em><span>Withdrawals</span></a></li>
                         
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
                                                        <h5 class="title">Withdrawals Accounts</h5>
                                                    </div>
                                                    <div class="card-tools mr-n1">
                                                        <ul class="btn-toolbar gx-1">
                                                            <li>
                                                                <a href="#" class="search-toggle toggle-search btn btn-icon" data-target="search"><em class="icon ni ni-search"></em></a>
                                                            </li><!-- li -->
                                                            <li class="btn-toolbar-sep"></li><!-- li -->
                                                            <li>
                                                                <div class="dropdown">
                                                                    <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-toggle="dropdown">
                                                                        <div class="badge badge-circle badge-primary">3</div>
                                                                        <em class="icon ni ni-filter-alt"></em>
                                                                    </a>
                                                                    <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-right">
                                                                        <div class="dropdown-head">
                                                                            <span class="sub-title dropdown-title">Advance Filter</span>
                                                                            
                                                                        </div>
                                                                        <div class="dropdown-body dropdown-body-rg">
                                                                            <div class="row gx-6 gy-4">
                                                                               
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <ul class="link-check">
                                                                            <li><a href="{{ filter_url('all') }}">All Withdrawals</a></li>
                                                                            <li><a href="{{ filter_url('pending')}}">Pending Withdrawals</a></li>
                                                                            <li><a href="{{ filter_url('processed')}}">Processed Withdrawals</a></li>
                                                                              <li><a href="{{ filter_url('canceled') }}">Cancelled Withdrawals</a></li>
                                                                   
                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- .filter-wg -->
                                                                </div><!-- .dropdown -->
                                                            </li><!-- li -->
                                                            <li>
                                                                
                                                            </li><!-- li -->
                                                        </ul><!-- .btn-toolbar -->
                                                    </div><!-- .card-tools -->
                                                    <div class="card-search search-wrap" data-search="search">
                                                        <form method="get">
                                                        <div class="search-content">
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
                                                        <div class="nk-tb-col"><span>Amount</span></div>
                                                        <div class="nk-tb-col  tb-col-sm"><span>Method</span></div>
                                                         <div class="nk-tb-col nk-tb-col-status"><span >Status</span></div>
                                                        <div class="nk-tb-col  tb-col-sm"><span>Created At</span></div>
                                                       
                                                    </div><!-- .nk-tb-item -->
                                                @foreach($withdrawals as $withdrawal )
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col">
                                                            <div class="nk-tnx-type">
                                                               
                                                                <div class="nk-tnx-type-text">
                                                                    <span class="tb-lead">{{$withdrawal->ref}}</span>
                                                                    <span class="tb-date">{{$withdrawal->created_at->format('d/m/y h:s A')}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-lg">
                                                            <span class="tb-lead-sub">{{ moneyFormat($withdrawal->amount, 'USD') }}</span>
                                                        </div>
                                                        <div class="nk-tb-col ">
                                                            <span class="tb-amount">{{ $withdrawal->formatted_payment_method }}</span>
                                                        </div>
                                                       
                                                        <div class="nk-tb-col nk-tb-col-status">
                                                            <div class="dot dot-success d-md-none"></div>
                                                             @if( $withdrawal->status == \App\Models\Withdrawal::STATUS_PAID)
                                                            <span class="badge badge-sm badge-dim badge-outline-primary d-none d-md-inline-flex">Completed</span>
                                                            @elseif ($withdrawal->status == \App\Models\Withdrawal::STATUS_CANCELED)
                                                            <span class="badge badge-sm badge-dim badge-outline-warning d-none d-md-inline-flex">Cancelled</span>
                                                            @else
                                                             <span class="badge badge-sm badge-dim badge-outline-primary d-none d-md-inline-flex">Pending</span>
                                                            @endif
                                                        </div>

                                                         <div class="nk-tb-col tb-col-sm">
                                                            <span class="tb-amount">{{$withdrawal->created_at}}</span>
                                                        </div>
                                                        
                                                    </div><!-- .nk-tb-item --> 
                                                @endforeach

                                                    
                                                </div><!-- .nk-tb-list -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner">
                                               {{$withdrawals->links()}}
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