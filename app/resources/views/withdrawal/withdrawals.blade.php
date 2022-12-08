@extends('layouts.app')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="row g-gs">
                        
                        <div class="col-12 col-md-5">
                            <form method="post" action="{{ route('web.withdrawals.requests') }}">
                                @csrf
                            <div class="buysell wide-xs m-auto">
                                
                                 <div class="card card-bordered pricing">
                                 <div class="pricing-head">
                                    <div class="pricing-title">
                                     <h6 class="">New Withdrawals</h6>
                                 </div>
                                 @if(!$withdrawals_account)
                                 <p style="color:brown; font-size:12px" class="alert alert-danger"> You have not added any withdraw account yet in your account.
                         
                                     Please add the personal or company accounts that you'd like to withdraw funds. <a href="{{route('web.withdrawals.account')}}" class="btn-warning btn-sm"> Add Account</a></p>
                                 @else
                                 <p style="color:#000; font-size:12px" class="alert alert-info"> 
                         
                                     You have {{count($withdrawals_account)}} withdrawal account(s) &nbsp;&nbsp;&nbsp;  <a href="{{route('web.withdrawals.account')}}" class="btn-primary btn-sm"> View  Accounts</a></p>
                                 @endif
                                     
                                    <div class="pricing-bod">
                                         <div class="buysell-field form-group">
                                             <div class="form-label-group">
                                                 <label class="form-label">Amount</label>
                                             </div>
                                             <div class="dropdown buysell-cc-dropdown w-100">
                                             <input type="text" name="amount" value="{{ old('amount') }}" class="form-control {{ form_invalid('amount') }}" id="inputAmount" aria-describedby="AmountHelp" placeholder="Enter amount">
                                                </div>
                                                 <small  class="">
                                                    
                                                     @showError('amount')
                                                 </small>
                                                  
                                         </div>
                                     <div class="buysell-field form-group">
                                             <div class="form-label-group">
                                                 <label class="form-label">Select Withdrawal Account</label>
                                             </div>
                                             <div class="dropdown buysell-cc-dropdown w-100">
                                              <select type="text" class="form-control {{ form_invalid('payment_method') }}" name="payment_method" id="inputPaymentMethod" aria-describedby="paymentMethodHelp">
                                         @foreach($withdrawals_account as $accounts)
                                                 <option  value="{{ encrypt($accounts->id )}}">{{ $accounts->currency .' | '.$accounts->address }}</option>
                                         @endforeach
                                     </select>
                                             </div>
                                             <small id="paymentMethodHelp" class="form-text text-muted">
                                                
                                             </small>
                                             @showError('payment_method')<!-- .dropdown -->
                                           
                                         </div>
                                              <div class="buysell-field form-action">
                                         <button type="submit" class="btn btn-lg btn-block btn-primary">Proceed</button></div></div>
                                         </div>
                                 <!-- .buysell-block -->
                             </div><!-- .buysell -->


                        </div><!-- .col -->
                    </form>
                        </div>
                    
                        <div class="col-12 col-md-7 p">
                            <div class="card card-full">
                            <div class="nk-block-head-content p-3 pb-5">
                                <h6 class="nk-block-title ">Withdrawal Transaction</h6>
                                <div class="nk-block-des text-soft">
                                    <p>You have {{count($withdrawals)}} Withdrawals.</p>
                                    
                                </div>
                                
                            </div><!-- .nk-block-head-content -->
                         
                               
                                <div class="nk-tb-list mt-n2">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col"><span>#Ref</span></div>
                                        <div class="nk-tb-col"><span>Amount</span></div>
                                        <div class="nk-tb-col  tb-col-sm"><span>Method</span></div>
                                         <div class="nk-tb-col nk-tb-col-status"><span >Status</span></div>
                                        <div class="nk-tb-col  tb-col-sm"><span>Created At</span></div>
                                    </div>
                                    @forelse($withdrawals as $withdrawal )
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
                                
                                    @empty
                                    <div class="nk-tb-item">
                                        
                                        <div class="nk-tb-col tb-col-sm">
                                           No Records Found for this Campaign
                                        </div>
                                       
                                        
                                    </div>
                                    @endforelse
                                </div>
                            </div><!-- .card -->
                        </div>
                     
                     
                    </div><!-- .row -->
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


//alert(msg);
if(message != null){
toastr.clear();
    NioApp.Toast(message , msg, {
      position: 'top-right',
        timeOut: 5000,
    });
}

</script>
@endsection