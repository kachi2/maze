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
                                <form method="post" action="{{ route('web.transfer.earnings') }}">
                                    @csrf
                                 <div class="card card-bordered pricing">
                                 <div class="pricing-head">
                                    <div class="pricing-title">
                                     <h4 class="card-title title">Transfer Bonus</h4>
                                    </div>
                                     
                                         </div>
                                        
                                         <div class="pricing-body">
                                          
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
                                        
                                              <div class="buysell-field form-action">
                                                <button type="submit" class="btn btn-primary">Transfer</button>
                                         </div>
                                 </form><!-- .buysell-block -->
                             </div><!-- .buysell -->


                        </div><!-- .col -->
                    </div><!-- .col -->
                </div><!-- .col -->
                        <div class="col-12 col-md-7 p">
                            <div class="card card-full">
                            <div class="nk-block-head-content p-3 pb-5">
                                <h6 class="nk-block-title ">Bonus Transfer</h6>
                               
                            </div><!-- .nk-block-head-content -->
                                <div class="nk-tb-list mt-n2">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col  tb-col-sm"><span>#ref</span></div>
                                        <div class="nk-tb-col  tb-col-sm"><span>#type</span></div>
                                        <div class="nk-tb-col"><span>Amount</span></div>
                                        <div class="nk-tb-col"><span>Prev Balance</span></div>
                                        <div class="nk-tb-col"><span>Avail Balance</span></div>
                                        <div class="nk-tb-col"><span>Create At</span></div>
                                        <div class="nk-tb-col"></div>
                                    </div>
                                    @forelse($transfer as $acc )
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <div class="nk-tnx-type">
                                               
                                                <div class="nk-tnx-type-text">
                                                    <span class="tb-lead">#{{$acc->ref}}</span>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-lg">
                                            <span class="tb-lead-sub">{{ $acc->type }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-lg">
                                            <span class="tb-lead-sub">{{ moneyFormat($acc->amount,'USD') }}</span>
                                        </div>

                                        <div class="nk-tb-col tb-col-lg">
                                            <span class="tb-lead-sub">{{ moneyFormat($acc->prev_balance,'USD') }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-lg">
                                            <span class="tb-lead-sub">{{ moneyFormat($acc->avail_balance,'USD') }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-lg">
                                            <span class="tb-lead-sub">{{ $acc->created_at }}</span>
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