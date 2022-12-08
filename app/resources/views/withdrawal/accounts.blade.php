@extends('layouts.app')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="row g-gs">
                        
                        <div class="col-12 col-md-5">
                            <form method="post" action="{{ route('web.addWithdrawals') }}">
                                @csrf
                            <div class="buysell wide-xs m-auto">
                                
                                 <div class="card card-bordered pricing">
                                 <div class="pricing-head">
                                    <div class="pricing-title">
                                     <h6 class="">Add New Account</h6>
                                    </div>
                                     
                                    <div class="pricing-bod">
                                        <div class="buysell-field form-group">
                                            <div class="form-label-group">
                                                <label class="form-label">Payment Type</label>
                                            </div>
                                            <select type="text" class="form-control {{ form_invalid('account_type') }}" name="account_type" aria-describedby="paymentMethodHelp">
                                                <option {{ old('account_type') }} value="crypto">Crypto Account</option>
                                                </select>
                                            </div>
                                            @showError('account_type')
                                            
                                         <div class="buysell-field form-group">
                                             <div class="form-label-group">
                                                 <label class="form-label">Account Adress</label>
                                             </div>
                                             <div class="dropdown buysell-cc-dropdown w-100">
                                                <input type="text" name="address" value="{{ old('address') }}"class="form-control {{ form_invalid('address') }}" required placeholder=" Address">  
                                            </div>
                                            @showError('wallet_address')
                                         </div>

                                     <div class="buysell-field form-group">
                                             <div class="form-label-group">
                                                 <label class="form-label">Select currency</label>
                                             </div>
                                             <div class="dropdown buysell-cc-dropdown w-100">
                                                <select type="text" class="form-control {{ form_invalid('payment_method') }}" name="payment_method" id="inputPaymentMethod" aria-describedby="paymentMethodHelp">
                                                    @foreach(get_payment_method() as $oKey => $oValue)
                                                            <option {{ old('payment_method') == $oKey ? 'selected' : '' }} value="{{ $oKey }}">{{ $oValue }}</option>
                                                    @endforeach
                                                </select>
                                     </select>
                                             </div>
                                             <small id="paymentMethodHelp" class="form-text text-muted">
                                                
                                             </small>
                                             @showError('payment_method')<!-- .dropdown -->
                                           
                                         </div>
                                              <div class="buysell-field form-action">
                                         <button type="submit" class="btn btn-lg btn-block btn-primary">Proceed</button></div></div>
                                         </div>
                                        </div>
                                 <!-- .buysell-block -->
                             </div><!-- .buysell -->
                            </form>

                        </div><!-- .col -->
   
                        
                    
                        <div class="col-12 col-md-7 p">
                            <div class="card card-full">
                            <div class="nk-block-head-content p-3 pb-5">
                                <h6 class="nk-block-title ">Withdrawal Accounts</h6>
                               
                            </div><!-- .nk-block-head-content -->
                         
                               
                                <div class="nk-tb-list mt-n2">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col  tb-col-sm"><span>Type</span></div>
                                        <div class="nk-tb-col"><span>Account</span></div>
                                        <div class="nk-tb-col"><span>Currency</span></div>
                                        <div class="nk-tb-col"></div>
                                    </div>
                                    @forelse($Waccount as $acc )
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <div class="nk-tnx-type">
                                               
                                                <div class="nk-tnx-type-text">
                                                    <span class="tb-lead">{{$acc->type}}</span>
                                                    <span class="tb-date">{{$acc->created_at->format('d/m/y h:s A')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-lg">
                                            <span class="tb-lead-sub">{{ $acc->address }}</span>
                                        </div>
                                        <div class="nk-tb-col ">
                                            <span class="tb-amount">{{ $acc->currency }}</span>
                                        </div>
                                        <div class="nk-tb-col ">
                                            <form method="get" action="{{route('web.wDeleteAddress', encrypt($acc->id))}}"> 
                                                <button  class=" btn btn-outline-none" style="color:rgb(210, 36, 13)">Delete</button><br> 
                                            </form>
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