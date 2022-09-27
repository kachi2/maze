@extends('layouts.admin', ['page_title' => 'Site settings'])
@section('content')
  <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="components-preview wide-md mx-auto">
                                 <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title fw-normal">System Settings</h5>
                                        
                                    </div>
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                           
                                       </ul>
                                    </div>
                                </div>
                            </div>
    <div class="body-content row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.setting') }}">
                    {{ csrf_field() }}
                        <div class="row  no-gutters mb-1">
                            <div class="col-5 col-sm-4">
                                Site Title:
                            </div><!-- col-4 -->
                            <div class="col-7 col-sm-8">
                                <input class="form-control {{ form_invalid('title') }}" type="text"
                                       name="title" placeholder="Title"
                                       value="{{ old('title', config('app.name')) }}">
                                @showError('title')
                            </div><!-- col-8 -->
                        </div><!-- row -->
                        <div class="row  no-gutters mb-1">
                            <div class="col-5 col-sm-4">
                                Site Description:
                            </div><!-- col-4 -->
                            <div class="col-7 col-sm-8">
                                <input class="form-control {{ form_invalid('description') }}"
                                       type="text" name="description"
                                       placeholder="Description"
                                       value="{{ old('description', config('app.description')) }}">
                                @showError('description')
                            </div><!-- col-8 -->
                        </div><!-- row -->
                        <div class="row  no-gutters mb-1">
                            <div class="col-5 col-sm-4">
                                Registration:
                            </div><!-- col-4 -->
                            <div class="col-7 col-sm-8">
                                <select id="select2-a"
                                        class="form-control {{ form_invalid('registration') }}"
                                        name="registration">
                                    <option
                                            value="1" {{ old('registration', config('app.registration', 1)) ? 'selected' : '' }}>
                                        On
                                    </option>
                                    <option
                                            value="0" {{ (!old('registration', config('app.registration', 1))) ? 'selected' : '' }}>
                                        Off
                                    </option>
                                </select>
                                @showError('registration')
                            </div><!-- col-8 -->
                        </div><!-- row -->
                        <div class="row  no-gutters mb-1">
                            <div class="col-5 col-sm-4">
                                Login:
                            </div><!-- col-4 -->
                            <div class="col-7 col-sm-8">
                                <select id="select2-a" class="form-control {{ form_invalid('login') }}"
                                        name="login">
                                    <option
                                            value="1" {{ old('login', config('app.login', 1)) ? 'selected' : '' }}>
                                        On
                                    </option>
                                    <option
                                            value="0" {{ (!old('login', config('app.login', 1))) ? 'selected' : '' }}>
                                        Off
                                    </option>
                                </select>
                                @showError('login')
                            </div><!-- col-8 -->
                        </div><!-- row -->
                        <div class="row  no-gutters mb-4">
                            <div class="col-5 col-sm-4">
                                Automatic Withdrawal:
                            </div><!-- col-4 -->
                            <div class="col-7 col-sm-8">
                                <select id="select2-a" class="form-control {{ form_invalid('automatic_withdrawal') }}"
                                        name="automatic_withdrawal">
                                    <option
                                            value="1" {{ old('automatic_withdrawal', config('app.automatic_withdrawal', 1)) ? 'selected' : '' }}>
                                        On
                                    </option>
                                    <option
                                            value="0" {{ (!old('automatic_withdrawal', config('app.automatic_withdrawal', 1))) ? 'selected' : '' }}>
                                        Off
                                    </option>
                                </select>
                                @showError('automatic_withdrawal')
                            </div><!-- col-8 -->
                        </div><!-- row -->


                        <div class="row  no-gutters mb-1">
                            <div class="col-5 col-sm-4">
                                Coinpayments Marchant ID:
                            </div><!-- col-4 -->
                            <div class="col-7 col-sm-8">
                                <input class="form-control {{ form_invalid('coinpayments_merchant_id') }}" type="text"
                                       name="coinpayments_merchant_id" placeholder="Coinpayments Marchant ID"
                                       value="{{ old('coinpayments_merchant_id', config('coinpayments.merchant_id')) }}">
                                @showError('coinpayments_merchant_id')
                            </div><!-- col-8 -->
                        </div><!-- row -->

                        <div class="row  no-gutters mb-1">
                            <div class="col-5 col-sm-4">
                                Coinpayments Public Key:
                            </div><!-- col-4 -->
                            <div class="col-7 col-sm-8">
                                <input class="form-control {{ form_invalid('coinpayments_public_key') }}" type="text"
                                       name="coinpayments_public_key" placeholder="Coinpayments Public Key"
                                       value="{{ old('coinpayments_public_key', config('coinpayments.public_key')) }}">
                                @showError('coinpayments_public_key')
                            </div><!-- col-8 -->
                        </div><!-- row -->

                        <div class="row  no-gutters mb-1">
                            <div class="col-5 col-sm-4">
                                Coinpayments Private Key:
                            </div><!-- col-4 -->
                            <div class="col-7 col-sm-8">
                                <input class="form-control {{ form_invalid('coinpayments_private_key') }}" type="text"
                                       name="coinpayments_private_key" placeholder="Coinpayments Private Key"
                                       value="{{ old('coinpayments_private_key', config('coinpayments.private_key')) }}">
                                @showError('coinpayments_private_key')
                            </div><!-- col-8 -->
                        </div><!-- row -->

                        <div class="row  no-gutters mb-4">
                            <div class="col-5 col-sm-4">
                                Coinpayments IPN Secrete:
                            </div><!-- col-4 -->
                            <div class="col-7 col-sm-8">
                                <input class="form-control {{ form_invalid('coinpayments_ipn_secret') }}" type="text"
                                       name="coinpayments_ipn_secret" placeholder="Coinpayments IPN Secrete"
                                       value="{{ old('coinpayments_ipn_secret', config('coinpayments.ipn_secret')) }}">
                                @showError('coinpayments_ipn_secret')
                            </div><!-- col-8 -->
                        </div><!-- row -->




                        <div class="row  no-gutters mb-1">
                            <div class="col-5 col-sm-4">
                                Perfectmoney Account ID:
                            </div><!-- col-4 -->
                            <div class="col-7 col-sm-8">
                                <input class="form-control {{ form_invalid('perfectmoney_account_id') }}" type="text"
                                       name="perfectmoney_account_id" placeholder="Perfectmoney Account ID"
                                       value="{{ old('perfectmoney_account_id', config('perfectmoney.account_id')) }}">
                                @showError('perfectmoney_account_id')
                            </div><!-- col-8 -->
                        </div><!-- row -->

                        <div class="row  no-gutters mb-1">
                            <div class="col-5 col-sm-4">
                                Perfectmoney Passphrase:
                            </div><!-- col-4 -->
                            <div class="col-7 col-sm-8">
                                <input class="form-control {{ form_invalid('perfectmoney_passphrase') }}" type="text"
                                       name="perfectmoney_passphrase" placeholder="Title"
                                       value="{{ old('perfectmoney_passphrase', config('perfectmoney.passphrase')) }}">
                                @showError('perfectmoney_passphrase')
                            </div><!-- col-8 -->
                        </div><!-- row -->

                        <div class="row  no-gutters mb-1">
                            <div class="col-5 col-sm-4">
                                Perfectmoney Marchant ID:
                            </div><!-- col-4 -->
                            <div class="col-7 col-sm-8">
                                <input class="form-control {{ form_invalid('perfectmoney_marchant_id') }}" type="text"
                                       name="perfectmoney_marchant_id" placeholder="Perfectmoney Marchant ID"
                                       value="{{ old('perfectmoney_marchant_id', config('perfectmoney.marchant_id')) }}">
                                @showError('perfectmoney_marchant_id')
                            </div><!-- col-8 -->
                        </div><!-- row -->

                        <div class="row  no-gutters mb-1">
                            <div class="col-5 col-sm-4">
                                Perfectmoney Alternate Passphrase:
                            </div><!-- col-4 -->
                            <div class="col-7 col-sm-8">
                                <input class="form-control {{ form_invalid('perfectmoney_alternate_passphrase') }}" type="text"
                                       name="perfectmoney_alternate_passphrase" placeholder="Perfectmoney Alternate Passphrase"
                                       value="{{ old('perfectmoney_alternate_passphrase', config('perfectmoney.alternate_passphrase')) }}">
                                @showError('perfectmoney_alternate_passphrase')
                            </div><!-- col-8 -->
                        </div><!-- row -->

                        <div class="row  no-gutters mb-1">
                            <div class="col-5 col-sm-4">
                                Referral Percentage Per Deposit:
                            </div><!-- col-4 -->
                            <div class="col-7 col-sm-8">
                                <input class="form-control {{ form_invalid('referral_interest_percent') }}" type="number"
                                       name="referral_interest_percent" placeholder="Referral Percentage Per Deposit"
                                       value="{{ old('referral_interest_percent', config('referral.interest_percent')) }}">
                                @showError('referral_interest_percent')
                            </div><!-- col-8 -->
                        </div><!-- row -->

                        <button type="submit" class="btn btn-block btn-primary mt-4">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
      </div>
            </div>
        </div>
    </div>
@endsection
