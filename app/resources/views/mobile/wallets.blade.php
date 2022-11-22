  <!-- Body-content -->
  @extends('layouts.mobile')
  
  @section('content')
        <div class="body-content body-content-lg"> <!-- "body-content-lg" add this class if any cards inside this div has "section-to-header" class -->
            <div class="container">
                <!-- Add-card -->
                <div class="add-card section-to-header mb-30">
                    <div class="add-card-inner">
                        <div class="add-card-item add-card-info">
                            <p>Main Wallet</p>
                            <h3>{{ moneyFormat(auth()->user()->wallet->amount, 'USD') }}</h3>
                        </div>
                        <div class="add-card-item add-balance" data-bs-toggle="modal" data-bs-target="#addBalance">
                            <a href="#"  data-bs-toggle="modal" data-bs-target="#DepositModal"><i class="flaticon-plus"></i></a>
                            <p>Deposit</p>
                        </div>
                    </div>
                </div>
                <div class="transaction-section pb-15">
                    <div class="section-header">
                        <h2>Wallet Deposits</h2>
                    </div>
                    @forelse ($deposits as $invst )
                    <div class="transaction-card mb-15">
                        <a href="#">
                            <div class="transaction-card-info">
                                <div class="transaction-info-thumb" style="border-radius: 100%">
                                    <span class="text-white" style="font-size:15px">{{substr($invst->ref,0,2)}}</span>
                                </div>
                                <div class="transaction-info-text">
                                    <h3><small>Ref: {{$invst->ref}}</small></h3>
                                    <p> {{$invst->currency2}} | {{substr($invst->amount2,0,8)}} </small></p>
                                    <p> <small>Hash No: {{$invst->hashNo}} </small> <br>
                                        <small> @if($invst->status == 0) <span class="alert-danger p-1"> Pending </span> @else  <span class=" alert-success p-1"> Success </span> @endif </small> 
                                    <small style="font-size: 10px; color:#999"> {{$invst->created_at}}</small>
                                </p>
                                </div>
                            </div>
                            <div class="transaction-card-det">
                                <span style="color:green">  </i>{{moneyFormat($invst->amount, 'USD')}}</span><br> 
                               <small class="negative-number"> </i>{{$invst->currency1}}<small>
                            </div>
                        </a>
                    </div>
                   
                    @empty
                    <div class="transaction-card mb-15">
                        <a href="#">
                            <div class="transaction-card-info">
                                <div class="transaction-info-text">
                                    <p>No record found</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforelse
                   <span style="float:right">{{$deposits->links()}}</span> 
                   <div class="p-2"></div>
                </div>
                  <form method="post" action="{{route('wallet.deposits')}}" id="DepositForm">
            @csrf
        <div class="modal fade" id="DepositModal" tabindex="-1" aria-labelledby="passwordModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="container">
                        <div class="modal-header">
                            <div class="modal-header-title">
                                <h5 class="modal-title">Add funds to wallet</h5>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <div class="form-group pb-15">
                                    <label>Deposit Amount</label>
                                    <div class="input-group">
                                        <input type="text" name="amount" class="form-control" required placeholder="100">   
                                    </div>
                                </div>
                                <div class="form-group pb-15">
                                    <label>Select Payment Method</label>
                                    <div class="input-group">
                                        <select type="text" class="form-control {{ form_invalid('payment_method') }}" name="payment_method" id="inputPaymentMethod" aria-describedby="paymentMethodHelp">
                                            @foreach(get_payment_method() as $oKey => $oValue)
                                                    <option {{ old('payment_method') == $oKey ? 'selected' : '' }} value="{{ $oKey }}">{{ $oValue }}</option>
                                            @endforeach
                                             <span class="processor"></span>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn main-btn main-btn-lg full-width">  <span class="preloader"> </span>Proceed to Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
    {{-- enter hash number  --}}
    <form method="post" action="{{route('update.tnxHash',"")}}" id="hashNo">
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
                                    <input type="text" name="hashNo" class="form-control" required placeholder="Enter Reference Id/Hash">   
                                </div>
                                <small>
                                  Your account will be credited once payment is confirmed.</small>
                            </div>
                            <button type="submit" class="btn main-btn main-btn-lg full-width">  <span class="preloader"> </span>Confirm Payment</button>
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
   var img_url = {!! json_encode(asset('/mobile/images/')) !!};

   url = {!! json_encode(route('update.tnxHash','')) !!}
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
                       // location.reload();
                        });
                     //console.log(result);
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
                           
                        });
                    }
                }else{
                    
                }
            });
        });
</script>
@endpush