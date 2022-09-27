@extends('layouts.mobile')
@section('content')


<div class="body-content body-content-lg"> <!-- "body-content-lg" add this class if any cards inside this div has "section-to-header" class -->
    <div class="container">
        <!-- Add-card -->
        <div class="add-card section-to-header mb-30">
            <div class="add-card-inner">
                <div class="add-card-item add-card-info">
                    <h3> Total Withdrawal {{moneyFormat($total, 'USD')}}</h3>
                    
                </div>
                <div class="add-card-item add-balance" data-bs-toggle="modal" data-bs-target="#addBalance">
                   
                  <a href="#"  data-bs-toggle="modal" data-bs-target="#withdrawal">Request Withdrawal</a>
                </div>
            </div>
        </div>
        <div class="feature-section mb-15">
            <div class="row gx-3">
                <h5>My Withdrawals</h5>
                <div class="col col-sm-6 pb-15">
                    <div class="feature-card feature-card-blue">
                        <div class="feature-card-thumb">
                            <i class="flaticon-expenses"></i>
                        </div>
                        <div class="feature-card-details">
                            <p>Pending Withdrawal</p>
                            <h3>{{moneyFormat($pending, 'USD')}}</h3>
                        </div>
                    </div>
                </div>
                <div class="col col-sm-6 pb-15">
                    <div class="feature-card feature-card-violet">
                        <div class="feature-card-thumb">
                            <i class="flaticon-invoice"></i>
                        </div>
                        <div class="feature-card-details">
                            <p>Approved Withdrawal</p>
                            <h3>{{moneyFormat($success, 'USD')}}</h3>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="transaction-section pb-15">
            <div class="section-header">
                <h2>Recent Withdrawals</h2>
            </div>
            @forelse ($withdrawals as $withdrawal )
            <div class="transaction-card mb-15">
                <a href="{{route('withdrawals.details', encrypt($withdrawal->id))}}">
                    <div class="transaction-card-info">
                        <div class="transaction-info-thumb" style="border-radius: 100%">
                            <span class="text-white" style="font-size:15px"></span>
                        </div>
                        <div class="transaction-info-text">
                            <h3>Ref:{{$withdrawal->ref}}<small> <br>{{$withdrawal->created_at->format('d/m/y h:s A')}}</small>
                            </h3>
                            <p> <div class="dot dot-success d-md-none"></div>
                                @if( $withdrawal->status == \App\Models\Withdrawal::STATUS_PAID)
                               <span class="btn-success p-1 " style="font-size:12px">Completed</span>
                               @elseif ($withdrawal->status == \App\Models\Withdrawal::STATUS_CANCELED)
                               <span class="btn-danger p-1" style="font-size:12px">Cancelled</span>
                               @else
                                <span class="btn-warning p-1" style="font-size:12px">Pending</span>
                               @endif </small></p>
                        </div>
                    </div>
                    <div class="transaction-card-det ">
                        <span class="positive-number">{{ moneyFormat($withdrawal->amount, 'USD') }}</span><br> 
                       <small class="negative-number">{{ $withdrawal->formatted_payment_method }}<small>
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
        </div>
      

    <!-- payment modal -->

    <form method="post" action="{{ route('withdrawals.request', ['tab' => 'crypto']) }}">
        @csrf
    <div class="modal fade" id="withdrawal" tabindex="-1" aria-labelledby="passwordModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container">
                    <div class="modal-header">
                        <div class="modal-header-title">
                            <h5 class="modal-title">Withdraw funds</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                            <div class="form-group pb-15">
                                <label>Deposit Amount</label>
                                <div class="input-group">
                                    <input type="text"  type="number" name="amount"   value="{{ old('amount') }}"class="form-control {{ is_tab('bitcoin', true) ? form_invalid('amount') : '' }}" required placeholder="100">
                                    
                                </div>
                                @if(is_tab('bitcoin', true))
                                @showError('amount')
                            @endif
                            </div>
                            
                            <div class="form-group pb-15">
                                <label>Select Payment Method</label>
                                <div class="input-group">
                         
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
                                @if(is_tab('bitcoin', true))
                                @showError('payment_method')
                            @endif
                            </div>
                            <div class="form-group pb-15">
                                <label>Wallet Address</label>
                                <div class="input-group">
                                    <input type="text" name="wallet_address" value="{{ old('wallet_address') }}"class="form-control {{ form_invalid('wallet_address') }}" required placeholder="wallet address">
                                    
                                </div>
                                @if(is_tab('bitcoin', true))
                                @showError('wallet_address')
                            @endif
                            </div>
                            <button type="submit" class="btn main-btn main-btn-lg full-width">Submit Request</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
   
    <!-- end of payment modal -->

<!-- end of wrapper -->
    </div>
</div>

@php  $modal = "200"@endphp
@endsection

@push('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="ajax-modal"></div>
@endpush

@push('scripts')
<script>




function copyText() {
    var copyText = document.getElementById("addresses");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy")
    }

    function confirmPay(){
var timeleft = 300;
var downloadTimer = setInterval(function () {
    if (timeleft <= 0) {
        clearInterval(downloadTimer);
     } else {
        document.getElementById("countdown").innerHTML = "<span style=\"color:red\"> Estimated Time  " + timeleft + "s </span>";
    }
    timeleft -= 1;
    /*console.log(downloadTimer);*/
}, 1000);
document.getElementById("payOne").hidden = false;
document.getElementById("payTwo").hidden = false;

}
</script>

@endpush