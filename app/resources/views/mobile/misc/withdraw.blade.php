<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-animatezoom">
        <div class="modal-content">
            <div class="container">
                <div class="modal-header">
                    <div class="modal-header-title">
                        <h5 class="modal-title">Add Withdrawal Account</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('addWithdrawals') }}">
                    @csrf
                <div class="form-group pb-15">
                    <label>Select Account Type</label>
                    <div class="input-group">
                        <select type="text" class="form-control {{ form_invalid('account_type') }}" name="account_type" aria-describedby="paymentMethodHelp">
                        <option {{ old('account_type') }} value="crypto">Crypto Account</option>
                        </select>
                    </div>
                    @showError('account_type')
                </div>

                <div class="form-group pb-15">
                    <label>Withdrawal Address</label>
                    <div class="input-group">
                        <input type="text" name="address" value="{{ old('address') }}"class="form-control {{ form_invalid('address') }}" required placeholder=" Address">  
                    </div>
                    @showError('wallet_address')
                </div>

                <div class="form-group pb-15">
                    <label>Select Currency</label>
                    <div class="input-group">
                        <select type="text" class="form-control {{ form_invalid('payment_method') }}" name="payment_method" id="inputPaymentMethod" aria-describedby="paymentMethodHelp">
                            @foreach(get_payment_method() as $oKey => $oValue)
                                    <option {{ old('payment_method') == $oKey ? 'selected' : '' }} value="{{ $oKey }}">{{ $oValue }}</option>
                            @endforeach
                        </select>
                    </div>
                    @showError('payment_method')
                   
                </div>
                <div class="modal-body modal-body-center">
                    <div class="text-center">
                        <button type="submit" class="btn main-btn main-btn full-width">Add Account</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>