@extends('layouts.admin', ['page_title' => 'Add Withdrawal'])
@section('content')
<div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="components-preview wide-md mx-auto">
                                 <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title fw-normal">Add Package</h5>
                                        
                                    </div>
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                            <li class="order-md-last">
                                                   <a href="{{ route('admin.packages') }}" class="btn btn-primary"><i
                                                    class='uil uil-plus mr-1'></i>Package</a> </li>
                                       </ul>
                                    </div>
                                </div>
                            </div>
    <div class="body-content row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">

                    <dl class="row mb-4 mt-3">
                        <dt class="col-sm-9 font-weight-bold">Total Withdrawal :</dt>
                        <dd class="col-sm-3 font-weight-normal">{{ moneyFormat($total_withdrawals, 'USD') }}</dd>

                        <dt class="col-sm-9 font-weight-bold">Pending Withdrawals :</dt>
                        <dd class="col-sm-3 font-weight-normal">{{ moneyFormat($pending_withdrawals, 'USD') }}</dd>

                        <dt class="col-sm-9 font-weight-bold">Cancel Withdrawals :</dt>
                        <dd class="col-sm-3 font-weight-normal">{{ moneyFormat($canceled_withdrawals, 'USD') }}</dd>
                    </dl>

                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav nav-pills navtab-bg nav-justified">
                                <li class="nav-item">
                                    <a href="{{ tab_url('crypto') }}"
                                       class="nav-link {{ is_tab('crypto', true) ? 'active' : '' }}">
                                        <span>Crypto</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ tab_url('perfect-money') }}"
                                       class="nav-link {{ is_tab('perfect-money') ? 'active' : '' }}">
                                        <span>Perfect Money</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content text-muted">
                                <div class="tab-pane {{ is_tab('crypto', true) ? 'show active' : '' }}" id="crypto">
                                    <form method="post" action="{{ route('admin.withdrawals.add', ['tab' => 'crypto']) }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="inputBitcoinEmail">Email</label>
                                            <input type="email" name="email"
                                                   value="{{ old('email') }}"
                                                   class="form-control {{ form_invalid('email') }}" id="inputBitcoinEmail" placeholder="Enter email address">
                                            @showError('email')
                                        </div>

                                        <div class="form-group">
                                            <label for="inputBitcoinUserName">User Name</label>
                                            <input type="text" name="user_name"
                                                   value="{{ old('user_name') }}"
                                                   class="form-control {{ form_invalid('user_name') }}" id="inputBitcoinUserName" placeholder="Enter user name">
                                            @showError('user_name')
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPaymentMethod">Payment method</label>
                                            <select type="text" class="form-control {{ form_invalid('payment_method') }}" name="payment_method" id="inputPaymentMethod" aria-describedby="paymentMethodHelp">
                                                @foreach(get_withdrawal_methods() as $oKey => $oValue)
                                                    @if($oKey == 'wallet')
                                                            <option style="display: none;" {{ old('payment_method') == $oKey ? 'selected' : '' }} value="{{ $oKey }}">{{ $oValue }}</option>
                                                    @else
                                                        <option {{ old('payment_method') == $oKey ? 'selected' : '' }} value="{{ $oKey }}">{{ $oValue }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <small id="paymentMethodHelp" class="form-text text-muted">
                                                Select Withdrawal payment method
                                            </small>
                                            @showError('payment_method')
                                        </div>
                                        <div class="form-group">
                                            <label for="inputWalletAddress">Wallet address</label>
                                            <input type="text" name="wallet_address"
                                                   value="{{ old('wallet_address') }}"
                                                   class="form-control {{ form_invalid('wallet_address') }}" id="inputWalletAddress" aria-describedby="walletAddressHelp" placeholder="Enter address">
                                            <small id="walletAddressHelp" class="form-text text-muted">
                                                your crypto wallet address
                                            </small>
                                            @showError('wallet_address')
                                        </div>

                                        <div class="form-group">
                                            <label for="inputBitcoinAmount">Amount</label>
                                            <input type="number" name="amount"
                                                   value="{{ old('amount') }}"
                                                   class="form-control {{ is_tab('bitcoin', true) ? form_invalid('amount') : '' }}" id="inputBitcoinAmount" aria-describedby="BitcoinAmountHelp" placeholder="Enter amount">
                                            <small id="BitcoinAmountHelp" class="form-text text-muted">
                                                withdrawal amount in USD
                                            </small>
                                            @if(is_tab('bitcoin', true))
                                                @showError('amount')
                                            @endif
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                                <div class="tab-pane {{ is_tab('perfect-money') ? 'show active' : '' }}" id="perfect-money">
                                    <form method="post" action="{{ route('admin.withdrawals.add', ['tab' => 'perfect-money']) }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="inputPmEmail">Email</label>
                                            <input type="email" name="email"
                                                   value="{{ old('email') }}"
                                                   class="form-control {{ form_invalid('email') }}" id="inputPmEmail" placeholder="Enter email address">
                                            @showError('email')
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPmUserName">User Name</label>
                                            <input type="text" name="user_name"
                                                   value="{{ old('user_name') }}"
                                                   class="form-control {{ form_invalid('user_name') }}" id="inputPmUserName" placeholder="Enter user name">
                                            @showError('user_name')
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPmAccountId">PM Account ID</label>
                                            <input type="text" name="pm_account_id"
                                                   value="{{ old('pm_account_id') }}"
                                                   class="form-control {{ form_invalid('pm_account_id') }}" id="inputPmAccountId" aria-describedby="PmAccountIdHelp" placeholder="Enter Account Id">
                                            <small id="PmAccountIdHelp" class="form-text text-muted">
                                                your perfect money account id
                                            </small>
                                            @showError('pm_account_id')
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPmAmount">Amount</label>
                                            <input type="number" name="amount"
                                                   value="{{ old('amount') }}"
                                                   class="form-control {{ is_tab('perfect-money') ? form_invalid('amount') : '' }}" id="PmAmountHelp" aria-describedby="BitcoinAmountHelp" placeholder="Enter amount">
                                            <small id="PmAmountHelp" class="form-text text-muted">
                                                withdrawal amount in USD
                                            </small>
                                            @if(is_tab('perfect-money'))
                                                @showError('amount')
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
         </div>
            </div>
        </div>
    </div>
@endsection
