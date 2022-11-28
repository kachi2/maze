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
                                <form method="post" action="{{ route('web.deposits.invests', ['id' => encrypt($plan->id)]) }}">
                                 @csrf
                                 <div class="card card-bordered pricing">
                                 <div class="pricing-head"><div class="pricing-title">
                                     <h4 class="card-title title">{{ $plan->name }}</h4>
                                     <p class="sub-text">  Invest  in {{ $plan->name }} &amp; earn {{ $plan->profit_rate }}% interest.</p></div>
                                     <div class="card-text"><div class="row"><div class="col-6">
                                         <span class="h4 fw-500">{{ $plan->profit_rate }}%</span><span class="sub-text">{{ $plan->package->formatted_payment_period_alt2 }} Interest</span></div>
                                         <div class="col-6"><span class="h4 fw-500">{{ $plan->package->duration }}</span><span class="sub-text">{{$plan->package->formatted_duration}} </span></div></div></div>
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
                                    Total Payouts:  <button type="button" class="btn btn-outline-primary">{{moneyFormat($payouts, 'USD')}}</button>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#transfer" style="font-size:12px"> Transfer to Main Wallet</a> <br>
                                      
                                </div>
                                <div class="nk-tb-list mt-n2">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col"><span>Ref</span></div>
                                        
                                        <div class="nk-tb-col tb-col-sm"><span>Amount</span></div>
                                        <div class="nk-tb-col"><span>Total Return</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Payment Method</span></div>
                                        <div class="nk-tb-col"><span>Date Created</span></div>
                                        <div class="nk-tb-col"><span>Expiry Date</span></div>
                                        <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
                                        <div class="nk-tb-col"></div>
                                    </div>
                                    @forelse ($investment as $invest)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-lead"><a href="#">#{{$invest->ref}}</a></span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <div class="user-card">
                                                <div class="user-name">
                                                    <span class="tb-lead">{{moneyFormat($invest->amount, 'USD')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub tb-amount">{{moneyFormat($invest->paid_amount, 'USD')}}</span></span>
                                        </div>

                                        <div class="nk-tb-col">
                                            <span class="tb-sub tb-amount">{{$invest->payment_method}}</span></span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span class="tb-sub">{{$invest->created_at}}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub tb-amount">{{$invest->expires_at}}</span></span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="badge badge-dot badge-dot-xs badge-success">Completed</span>
                                        </div>
                                        <div class="nk-tb-col">
                                        
                                       <a href="{{route('web.payouts.details', encrypt($invest->id))}}"><small>View</small></a> 
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