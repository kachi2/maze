@extends('layouts.mobile')
@section('content')
<div class="body-content body-content-lg"> <!-- "body-content-lg" add this class if any cards inside this div has "section-to-header" class -->
    <div class="container">
        <!-- Add-card -->
        <div class="add-card section-to-header mb-30">
            <div class="add-card-inner">
                <div class="add-card-item add-card-info">
                    <h3>{{ $plan->name }}</h3>
                    <p>({{ $plan->profit_rate }}% interest Daily)</p>
                   
                    <p>Min Deposit - {{ moneyFormat($plan->min_deposit, 'USD') }} <br>
                     Max Deposit - {{ moneyFormat($plan->max_deposit, 'USD') }}</p>
                </div>
                <div class="add-card-item add-balance" data-bs-toggle="modal" data-bs-target="#addBalance">
                   
                  <a href="#"  data-bs-toggle="modal" data-bs-target="#DepositModal">Invest</a>
                </div>
            </div>
        </div>
        <div class="feature-section mb-15">
            <div class="row gx-3">
                <h5>Plan Details</h5>
              
                <div class="col col-sm-6 pb-15">
                    <div class="feature-card feature-card-blue">
                        <div class="feature-card-thumb">
                            <i class="flaticon-expenses"></i>
                        </div>
                        <div class="feature-card-details">
                            <p>Payouts Earned</p>
                            <h3>{{moneyFormat($payouts, 'USD')}}</h3>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#transfer" style="font-size:12px"> Transfer</a>
                            
                        </div>
                    </div>
                </div>
                <div class="col col-sm-6 pb-15">
                    <div class="feature-card feature-card-violet">
                        <div class="feature-card-thumb">
                            <i class="flaticon-invoice"></i>
                        </div>
                        <div class="feature-card-details">
                            <p>Active Deposits</p>
                            <h3>{{moneyFormat($total, 'USD')}} </h3>
                            <br>
                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="transaction-section pb-15">
            <div class="section-header">
                <h2>Investments</h2>
            </div>
            @forelse ($investment as $invst )
            <div class="transaction-card mb-15">
                <a href="{{route('payouts.details', encrypt($invst->id))}}">
                    <div class="transaction-card-info">
                        <div class="transaction-info-thumb" style="border-radius: 100%">
                            <span class="text-white" style="font-size:15px">{{substr($invst->plan->name,0,2)}}</span>
                        </div>
                        <div class="transaction-info-text">
                            <h3>{{$invst->ref}} - <small>Daily {{$invst->profit_rate}}% </small></h3>
                            <p> {{$invst->payment_method}} | Expires:<small>{{$invst->expires_at->diffForHumans()}} </small></p>
                            <small style="font-size: 10px; color:#999"> {{$invst->created_at}}</small><small style="font-size:12px"> view payouts</small>
                        </div>
                    </div>
                    <div class="transaction-card-det">
                        <span style="color:green">  </i>{{moneyFormat($invst->paid_amount, 'USD')}}</span><br> 
                       <small class="negative-number"> </i>{{moneyFormat($invst->amount, 'USD')}}<small>
                    </div>
                </a>
            </div>
            @empty
            <div class="transaction-card mb-15">
                <a href="transaction-details.html">
                    <div class="transaction-card-info">
                        <div class="transaction-info-text">
                            <p>No record found</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforelse
           <span style="font-size:14px"> {{$investment->links()}} </span>
        </div>
        <form method="post" action="{{ route('deposits.invests', ['id' => encrypt($plan->id)]) }}" id="DepositForm">
            @csrf
        <div class="modal fade" id="DepositModal" tabindex="-1" aria-labelledby="passwordModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="container">
                        <div class="modal-header">
                            <div class="modal-header-title">
                                <h5 class="modal-title">Start new Campaign</h5>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <div class="form-group pb-15">
                                    <label>Deposit Amount</label>
                                    <div class="input-group">
                                        <input type="text" name="amount"  id="amounts" class="form-control" required placeholder="100">   
                                    </div>
                                </div>
                                <div class="form-group pb-15">
                                    <label>Select Payment Method</label>
                                    <div class="input-group">
                                        <select type="text" class="form-control {{ form_invalid('payment_method') }}" name="payment_method" id="inputPaymentMethod" aria-describedby="paymentMethodHelp">
                                            @foreach(get_payment_methods() as $oKey => $oValue)
                                                @if($oKey == 'wallet')
                                                    @if(($balance + $bonus) >= $plan->min_deposit)
                                                        <option {{ old('payment_method') == $oKey ? 'selected' : '' }} value="{{ $oKey }}">{{ $oValue }}</option>
                                                    @endif
                                                @else
                                                    <option {{ old('payment_method') == $oKey ? 'selected' : '' }} value="{{ $oKey }}">{{ $oValue }}</option>
                                                @endif
                                            @endforeach <span class="processor"></span>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn main-btn main-btn-lg full-width" id="proceedPay" disabled>  <span class="preloader"> </span>Proceed to Payment </button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- payment modal -->
    
    <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container">
                    <div class="modal-header">
                        <div class="modal-header-title">
                            <h5 class="modal-title">Completed Payment</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p style="font-size:12px"> To complete this transaction, please send the exact amount of <span id="amount1"> </span> | <span id="amount2"> </span> to the address below</p>
                        
                        
                            <div class="monthly-bill-card monthly-bill-card-green">
                                <div class="monthly-bill-thumb">
                                    <img src="{{asset('/mobile/images/')}}"  id="barcode" alt="logo">
                                </div>
                                <div class="monthly-bill-body">
                                    <h6><span id="addName"></span> Address</h6>
                                </div>
                                <input type="text" class="form-control" data-bs-toggle="tooltip" data-bs-placement="top" title="click to copy" onclick="copyText()"  id="addresses" value="" placeholder="" readonly>    
                            </div>
                            
                      
                            <button type="button"  onclick="confirmPay()" class="btn main-btn main-btn-lg full-width">Confirm Payment</button>
                            <div class="countdown_code" style="text-align: center">
                               <p style="font-size:12px" class="btn-info" id="payOne" hidden> We are confirming your payment. </span>
                                <span id="countdown"  class="text_count"> .</span> <br>
                                <span id="payTwo" hidden>  You can close window, notification will be sent once payment is confirmed</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <!-- end of payment modal --> 
    <form method="post" action="{{ route('transfer.payouts', encrypt($plan->id)) }}">
        @csrf
    <div class="modal fade" id="transfer" tabindex="-1" aria-labelledby="passwordModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container">
                    <div class="modal-header">
                        <div class="modal-header-title">
                            <h5 class="modal-title">Transfer Payouts to Main Wallet</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="2" name="bonus">
                            <div class="form-group pb-15">
                                <label>Amount</label>
                                <div class="input-group">
                                    <input   type="number" name="amounts" id="transAmount"   value="{{ old('amount') }}"class="form-control {{  form_invalid('amount') }}" required placeholder="100">
                                </div>
                                @showError('amount')
                           
                            </div>
                            <button type="submit" id="transferBtn" class="btn main-btn main-btn-lg full-width" disabled>Transfer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end of wrapper -->
<form method="post" action="{{route('deposits.tnxHash',"")}}" id="hashNo">
    @csrf
<div class="modal fade" id="HashModal" tabindex="-1" aria-labelledby="passwordModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container">
                <div class="modal-header">
                    <div class="modal-header-title">
                        <h5 class="modal-title">Verify Payment</h5>
                        <p>Please provide your payment reference / Hash Id</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="form-group pb-15">
                            <label>Payment Reference</label>
                            <div class="input-group">
                                <input type="text" id="hashInput" name="hashNo" class="form-control" required placeholder="Enter Reference Id/Hash">   
                            </div>
                            <small>
                              Your account will be credited once payment is confirmed.</small>
                        </div>
                        <button type="submit" id="confirmPay" class="btn main-btn main-btn-lg full-width" disabled>  <span class="preloader"> </span>Confirm Payment</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

{{-- end of hash --}}
    </div>
</div>


@endsection
@push('scripts')
<script src="{{asset('/mobile/js/custom.js')}}"></script>
@endpush
@push('scripts')

<script>

    let alert = {!! json_encode(Session::get('alert')) !!}
    let msg = {!! json_encode(Session::get('message')) !!}
    if(alert != null){
        swal({
        type:alert,
        text: msg
        });
    }
      $('#amounts').on('change', function(){
         $('#proceedPay').attr('disabled', false);
        });
        $('#hashInput').on('change', function(){
         $('#confirmPay').attr('disabled', false);
        });
        $('#transAmount').on('change', function(){
         $('#transferBtn').attr('disabled', false);
        });
$('#proceedPay').on('click', function(){
        $('#proceedPay').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please wait...')
    });

    $('#confirmPay').on('click', function(){
        $('#confirmPay').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...')
    });
    $('#transferBtn').on('click', function(){
        $('#transferBtn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...')
    });

   var img_url = {!! json_encode(asset('/mobile/images/')) !!};
   url = {!! json_encode(route('deposits.tnxHash','')) !!}
$('#DepositForm').submit(function(e){
            e.preventDefault();
            var xhr = submit_form('#DepositForm');
            xhr.done(function(result){
                if(result){
                  //  console.log(result);
                    if(result.alert){
                        swal({
                        type:result.alert,
                        text: result.msg
                        }).then(function(){ 
                        location.reload();
                        });
                    // console.log(result);
                    }else{
                   $('#addresses').attr('value',result.wallet.address);
                  $('#barcode').attr('src',img_url+'/'+result.wallet.barcode);
                    $('#transactionModal').modal("toggle");
                    $('#DepositModal').modal('hide');
                    $('#addName').html(result.deposit.currency2);
                    $('#hashNo').attr('action', url +"/" + result.deposit.id);
                    $('#amount1').html(result.deposit.amount +' '+ result.deposit.currency1 );
                    $('#amount2').html(result.deposit.amount2 +' '+ result.deposit.currency2)
                }
                }else{
                    
                }
            });
        });


function copyText() {
    var copyText = document.getElementById("addresses");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy")
    }

  function confirmPay(){
        $('#HashModal').modal("toggle");
        $('#transactionModal').modal('hide');
}



$('#hashNo').submit(function(e){
            e.preventDefault();
            var xhr = submit_form('#hashNo');
            xhr.done(function(result){
                if(result){
                    if(result.alert){
                        swal({
                        type:result.alert,
                        text: result.msg
                        }).then(function(){ 
                            location.reload(true);
                        });
                    }
                }else{
                    
                }
            });
        });




</script>

@endpush

@if(Session::has('alert'))

@else
    @section('preloader')
    @include('partials.preloader')
    @endsection
@endif