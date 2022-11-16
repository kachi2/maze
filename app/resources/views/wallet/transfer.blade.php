@extends('layouts.app', ['page_title' => 'Transfer Fund'])
@section('content')
       <div class="nk-content nk-content-fluid">
                     <div class="nk-content-body">
                            <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title fw-normal">Transfer Funds</h5>
                                        
                                    </div>
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                           
                                       </ul>
                                    </div>
                                </div>
                            </div>
                   
    <div class="body-content row">

      
        <div class="col-lg-10">
            <div class="card ml-5 ">
                <div class="card-body" style="border:1px solid #eee">
                   
                    <dl class="row mb-4 mt-3">
                        <dt class="col-sm-12 font-weight-bold"> Transfer Earnings to Wallet</dt>
                        
                    </dl>

                    <div class="row">
                        <div class="col-sm-12">
                            <form method="post" action="{{ route('web.transfer.earnings') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="inputUsername">Select Earnings Type</label>
                                    <select class="form-control" name="bonus">
                                    <option value="1">Bonus Earnings: {{moneyFormat(auth()->user()->wallet->bonus, 'USD')}}</option>
                                    <option value="2">Referral Earnings {{moneyFormat(auth()->user()->wallet->referrals, 'USD')}}</option>
                                    </select>
                                    <small id="AmountHelp" class="form-text text-muted">
                                        Select Earnings Type
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="inputAmount">Amount</label>
                                    <input type="number" name="amounts"
                                           value="{{ old('amounts') }}"
                                           class="form-control {{ form_invalid('amounts') }}" id="inputAmount" aria-describedby="AmountHelp" placeholder="Enter amount">
                                    <small id="AmountHelp" class="form-text text-muted">
                                        Transfer amount in USD
                                    </small>
                                    @showError('amounts')
                                </div>

                                <button type="submit" class="btn btn-primary">Transfer</button>
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