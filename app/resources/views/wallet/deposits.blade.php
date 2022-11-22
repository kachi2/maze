@extends('layouts.app')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-12 col-md-5">
                            <div class="buysell wide-xs m-auto">
                                <form method="post" action="{{route('web.wallet.deposits')}}">
                                 @csrf
                                 <div class="card card-bordered pricing">
                                 <div class="pricing-head">
                                    <div class="pricing-title">
                                     <h4 class="card-title ">Wallet Balances</h4>
                                    </div>
                                     
                                         </div>
                                         <div class="pricing-body"><ul class="pricing-features"><li><span class="w-50">Main Wallet</span> - <span class="ml-auto">{{moneyFormat(auth_user()->wallet->amount, 'USD')}}</span></li>
                                            <li><span class="w-50">Bonus Wallet</span> - <span class="ml-auto"> {{moneyFormat(auth_user()->wallet->bonus, 'USD')}}</span></li>
                                         <li><span class="w-50">Referral Wallet</span> - <span class="ml-auto">{{ moneyFormat(get_stats()['all_time_referral_bonus'], 'USD') }}</span></li>
                                       
                                         </ul>
                                         <hr>
                                         <div class="pricing-title">
                                            <h6 class="card-title title">Deposit Funds</h6>
                                           </div>
                                         <div class="buysell-field form-group ">
                                             <div class="form-label-group">
                                                 <label class="form-label">Amount</label>
                                             </div>
                                             <div class="dropdown buysell-cc-dropdown w-100">
                                             <input type="text" name="amount" value="" class="form-control {{ form_invalid('amount') }}" id="inputAmount" aria-describedby="AmountHelp" placeholder="Enter amount">
                                                </div>
                                                 <small id="AmountHelp" class="form-text text-muted">
                                                     Deposit amount in USD
                                                     @showError('amount')
                                                 </small>
                                                  
                                         </div>
                                     <div class="buysell-field form-group">
                                             <div class="form-label-group">
                                                 <label class="form-label">Payment Method</label>
                                             </div>
                                             <div class="dropdown buysell-cc-dropdown w-100">
                                              <select type="text" class="form-control {{ form_invalid('payment_method') }}" name="payment_method" id="inputPaymentMethod" aria-describedby="paymentMethodHelp">
                                         @foreach(get_payment_method() as $oKey => $oValue)
                                             @if($oKey == 'wallet')
                                                 @if(($balance + $bonus) >= $plan->min_deposit)
                                                     <option {{ old('payment_method') == $oKey ? 'selected' : '' }} value="{{ $oKey }}">{{ $oValue }}</option>
                                                 @endif
                                             @else
                                                 <option {{ old('payment_method') == $oKey ? 'selected' : '' }} value="{{ $oKey }}">{{ $oValue }}</option>
                                             @endif
                                         @endforeach
                                     </select>
                                             </div>
                                             <small id="paymentMethodHelp" class="form-text text-muted">
                                                 Select Deposit payment method
                                             </small>
                                             @showError('payment_method')<!-- .dropdown -->
                                           
                                         </div>
                                              <div class="buysell-field form-action">
                                         <button type="submit" class="btn btn-lg btn-block btn-primary">Proceed</button></div></div>
                                         </div>
                                 </form><!-- .buysell-block -->
                             </div><!-- .buysell -->


                        </div><!-- .col -->
                        <div class="col-12 col-md-7 ">
                            <div class="card card-full">
                                <div class="card-inner">
                                     <h6> Wallet Deposits</h6>
                                </div>
                                <div class="nk-tb-list mt-n2">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col"><span>Ref</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Payment Ref</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Amount</span></div>
                                        <div class="nk-tb-col"><span>Date Created</span></div>
                                        <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
                                        <div class="nk-tb-col"></div>
                                    </div>
                                    @forelse ($deposits as $invest)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-lead"><a href="#">#{{$invest->ref}}</a></span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-lead"><a href="#">{{$invest->hashNo}}</a></span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-lead">{{moneyFormat($invest->amount,'USD')}}</span>
                                            <span class="tb-date">{{number_format($invest->amount2,5)}} <small> {{$invest->currency2}}</small></span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span class="tb-sub">{{$invest->created_at}}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            @if($invest->status == 1)
                                            <span class="badge badge-dot badge-dot-xs badge-success">Approved</span>
                                            @elseif($invest->status == 3)
                                            <span class="badge badge-dot badge-dot-xs badge-danger">Cancelled</span>
                                            @else
                                            <span class="badge badge-dot badge-dot-xs badge-warning">Pending</span>
                                            @endif
                                        </div>
                                        
                                </div>
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