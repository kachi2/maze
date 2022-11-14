@extends('layouts.app')
@section('content')

     <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                           <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title fw-normal">Request Withdrawal</h5>
                                        
                                    </div>
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                            <li class="order-md-last">
                                            <a href="{{ route('web.withdrawals') }}" class="btn btn-primary"><span>My Withdrawal</span> <em class="icon ni ni-arrow-long-right"></em></a></li>
                                       </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="buysell wide-xs m-auto">
                               
                              <form method="post" action="{{ route('web.withdrawals.request', ['tab' => 'crypto']) }}">
                                        @csrf
                                <div class="card card-bordered pricing ">
                                        <div class="pricing-body">
                                        <div class="buysell-field ">
                                            <div class="form-label-group">
                                                <label class="form-label">Payment Method</label>
                                            </div>
                                            <div class=" buysell-cc-dropdown">
                                                <select type="text" class="form-control {{ form_invalid('payment_method') }}" name="payment_method" id="inputPaymentMethod" aria-describedby="paymentMethodHelp">
                                                @foreach(get_withdrawal_methods() as $oKey => $oValue)
                                                    @if($oKey == 'wallet')
                                                            <option style="display: none;" {{ old('payment_method') == $oKey ? 'selected' : '' }} value="{{ $oKey }}">{{ $oValue }}</option>
                                                    @else
                                                        <option {{ old('payment_method') == $oKey ? 'selected' : '' }} value="{{ $oKey }}">{{ $oValue }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            </div>
                                            <small id="paymentMethodHelp" class="form-text text-muted">
                                                Select Withdrawal payment method
                                            </small>
                                            @showError('payment_method')<!-- .dropdown -->
                                        </div><!-- .buysell-field -->
                                        
                                           <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label class="form-label">Wallet Address</label>
                                            </div>
                                            <div class=" buysell-cc-dropdown">
                                           <input type="text" name="wallet_address"
                                                   value="{{ old('wallet_address') }}"
                                                   class="form-control {{ form_invalid('wallet_address') }}" id="inputWalletAddress" aria-describedby="walletAddressHelp" placeholder="Enter address">
                                                   </div>
                                            <small id="paymentMethodHelp" class="form-text text-muted">
                                                   your wallet address
                                            </small>
                                               @showError('wallet_address')<!-- .dropdown -->
                                        </div><!-- .buysell-field -->
                                <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label class="form-label">Amount</label>
                                            </div>
                                            <div class=" buysell-cc-dropdown">
                                             <input type="number" name="amount"
                                                   value="{{ old('amount') }}"
                                                   class="form-control {{ is_tab('bitcoin', true) ? form_invalid('amount') : '' }}" id="inputBitcoinAmount" aria-describedby="BitcoinAmountHelp" placeholder="Enter amount" step="0.01">
                                           </div>
                                            <small id="BitcoinAmountHelp" class="form-text text-muted">
                                                withdrawal amount in USD
                                             </small>
                                            
                                            @if(is_tab('bitcoin', true))
                                                @showError('amount')
                                            @endif<!-- .dropdown -->
                                            </div> <!-- .buysell-field -->
                                        <div class="buysell-field form-action">
                                        <button type="submit" class="btn btn-lg btn-block btn-primary">Submit</button>
                                    </div>
                                     </div><!-- .buysell-field -->
                                   </form><!-- .buysell-form -->
                                </div>
                              
                            </div><!-- .buysell -->
                        </div>
                    </div>
                </div>
      
@endsection
