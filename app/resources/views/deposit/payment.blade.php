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
                                <form method="post" action="{{ route('deposits.invests', ['id' => encrypt($plan->id)]) }}">
                                 @csrf
                                 <div class="card card-bordered pricing">
                                 <div class="pricing-head"><div class="pricing-title">
                                     <h4 class="card-title title">{{ $plan->name }}</h4>
                                     <p class="sub-text">  Invest  in {{ $plan->name }} &amp; earn {{ $plan->profit_rate }}% interest.</p></div>
                                     <div class="card-text"><div class="row"><div class="col-6">
                                         <span class="h4 fw-500">{{ $plan->profit_rate }}%</span><span class="sub-text">{{ $plan->package->formatted_payment_period_alt2 }} Interest</span></div>
                                         <div class="col-6"><span class="h4 fw-500">{{ $plan->package->duration }}</span><span class="sub-text">Days</span></div></div></div>
                                         </div>
                                         <div class="pricing-body"><ul class="pricing-features"><li><span class="w-50">Min Deposit</span> - <span class="ml-auto">{{ moneyFormat($plan->min_deposit, 'USD') }}</span></li>
                                         <li><span class="w-50">Max Deposit</span> - <span class="ml-auto">{{ moneyFormat($plan->max_deposit, 'USD') }}</span></li>
                                         <li ><span class="w-50">Duration</span> - <span class="ml-auto">{{ $plan->package->formatted_duration }}</span>
                                         </ul>
                                         <div class="buysell-field form-group">
                                             <div class="form-label-group">
                                                 <label class="form-label">Amount</label>
                                             </div>
                                             <div class="dropdown buysell-cc-dropdown w-100">
                                             <input type="text" name="amount" value="{{ old('amount', $plan->min_deposit) }}" class="form-control {{ form_invalid('amount') }}" id="inputAmount" aria-describedby="AmountHelp" placeholder="Enter amount">
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
                                         @foreach(get_payment_methods() as $oKey => $oValue)
                                             @if($oKey == 'wallet')
                                                 @if((auth_user()->balance) >= $plan->min_deposit)
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
                                             @showError('payment_method')
                                           
                                         </div>
                                              <div class="buysell-field form-action">
                                         <button type="submit" class="btn btn-lg btn-block btn-primary">Proceed</button></div></div>
                                         </div>
                                 </form><!-- .buysell-block -->
                             </div><!-- .buysell -->


                        </div><!-- .col -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="nk-pps-apps">
                                <div class="nk-pps-title text-center">
                                    <h6 class="title">Make Your Payment</h6>
                                    <p class="caption-text p-2">To complete this transaction, please send the exact amount of <strong class="text-dark">{{number_format($transaction->amount,2)}} {{$transaction->currency1}} | {{$transaction->amount2}} {{$transaction->currency2}} </strong> to the address below.</p>
                                </div>
                                <div class="nk-pps-card card card-bordered popup-inside">
                                    <div class="card-inner-group">
                                        <div class="card-inner card-inner-sm">
                                            <div class="card-head mb-0">
                                                <h6 class="title mb-0 text-center">Pay {{$transaction->currency2}}</h6>
                                                                            </div>
                                        </div>
                                        <div class="card-inner">
                                            <div class="qr-media mx-auto mb-3 w-max-100px">
                                            <g transform="scale(3.03)"> <g transform="translate(0,0)">
                                            <img src="{{asset('/mobile/images/'.$wallet->barcode)}}"
                                            </g></g>
                                            </div>
                                            <div class="pay-info text-center">
                                                <h5 class="title text-dark mb-0 clipboard-init" data-clipboard-text=" {{$transaction->amount2}}">
                                                   {{number_format($transaction->amount,2)}} {{$transaction->currency2}} <em class="click-to-copy icon ni ni-copy-fill nk-tooltip" title="" data-original-title="Click to Copy"></em>
                                                </h5>
                                                    <p class="text-soft">{{number_format($transaction->amount,2)}} {{$transaction->currency1}}</p>
                                                     </div>
                                            <div class="form-group">
                                                <div class="form-label overline-title-alt lg text-center">{{$transaction->currency2}} Address</div>
                                                <div class="form-control-wrap">
                                                    <div class="form-clip clipboard-init nk-tooltip" data-clipboard-target="#wallet-address" title="" data-original-title="Copy">
                                                        <em class="click-to-copy icon ni ni-copy"></em>
                                                    </div>
                                                    <div class="form-icon"><em class="icon ni ni-sign-{{strtolower($transaction->currency2)}}-alt"></em></div>
                                                    <input readonly="" type="text" class="form-control form-control-lg" id="wallet-address" value="0xd5d4f313b28b5256a5bed2f00de3c4f9f1f7c3c0" readonly>
                                                </div>
                                                                            </div>
                
                                                                            <div class="nk-pps-action">
                                                </div>
                                                <div id="crypto-paid" class="popup">
                                                    <div class="popup-content">
                                                        <h6 class="mb-2">Confirm your payment</h6>
                                                        <p>If you already paid, please provide us your payment reference to speed up verification procces.</p>
                                                         <form  action="{{route('web.saveHashNo')}}" method="post">
                                                            @csrf 
                                                            <div class="form-group">
                                                                <div class="form-label">Payment Reference <span class="text-danger">*</span></div>
                                                                <div class="form-control-wrap">
                                                                    <input type="hidden" value="{{$transaction->ref}}" name="ref"> 
                                                                    <input name="hash" type="text" class="form-control "  @if(Session::has('done')) placeholder="Hash reference submitted" {{Session::get('done')}} @else placeholder="Enter your reference id / hash" @endif required>
                                                                </div>
                                                            </div>
                                                            <ul class="btn-group justify-between align-center gx-4">
                                                                @if(Session::has('done'))
                                                                <li><a href="{{route('web.deposits')}}" class="btn btn-primary btn-block">View Deposits</a></li>
                                                                 @else
                                                                 <li><button type="submit" class="btn btn-primary btn-block">Confirm Payment</button></li>
                                                                
                                                                @endif
                                                                <li><a href="{{route('web.home')}}" class="link link-btn link-secondary popup-close">Close</a></li>
                                                            </ul>
                                                            </form>
                                                        
                                                    </div>
                                                    <div class="popup-overlay"></div>
                                                </div>
                                                                    </div>
                                        
                                    </div>
                                </div>
                                
                                            </div>
                            </div>
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