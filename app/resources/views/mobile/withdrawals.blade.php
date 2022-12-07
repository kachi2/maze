@extends('layouts.mobile')
@section('nav')
  @include('partials.mobile_nav')
  @endsection
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
                   
                  <a href="#"  data-bs-toggle="modal" data-bs-target="#withdrawal">Withdraw</a>
                </div>
            </div>
        </div>

        @if(!$withdrawals_account)
        <p style="color:brown; font-size:12px" class="alert alert-danger"> You have not added any withdraw account yet in your account.

            Please add the personal or company accounts that you'd like to withdraw funds. <a href="#" data-bs-toggle="modal" data-bs-target="#alertModal"class="btn-warning btn-sm"> Add Account</a></p>
        @else
        <p style="color:#000; font-size:12px" class="alert alert-info"> 

            You have {{count($withdrawals_account)}} withdrawal account(s) &nbsp;&nbsp;&nbsp;  <a href="#" data-bs-toggle="modal" data-bs-target="#withdrawalAccounts"class="btn-primary btn-sm"> View  Accounts</a></p>
        @endif

        @if(Session::has('alerts'))
        <p style="color:brown; font-size:12px" class="alert alert-{{Session::get('alerts')}}"> 
            {{Session::get('msg')}}
        </p>
        @endif
      
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
                        <div class="transaction-info-thumb" style="border-radius: 30%">
                            <span class="text-white" style="font-size:15px"> {{substr($withdrawal->payment_method,0,3)}}</span>
                        </div>
                        <div class="transaction-info-text" >
                            <p>#{{$withdrawal->ref}} 
                                <small> <br>{{$withdrawal->created_at->format('d/m/y h:s A')}}</small>
                            </p>
                            <p> <div class="dot dot-success d-md-none"></div>
                                @if( $withdrawal->status == \App\Models\Withdrawal::STATUS_PAID)
                               <span style="color:rgb(13, 137, 239); font-size: 14px" style="font-size:12px">Completed</span>
                               @elseif ($withdrawal->status == \App\Models\Withdrawal::STATUS_CANCELED)
                               <span style="color:rgb(246, 102, 76); font-size: 14px"  style="font-size:12px">Cancelled</span>
                               @else
                                <span style="color:rgb(7, 32, 53); font-size: 14px"  style="font-size:12px">Pending</span>
                               @endif </small>
                            </p>
                        </div>
                    </div>
                    <div class="transaction-card-det ">
                        <span class="positive-number">{{ moneyFormat($withdrawal->amount, 'USD') }}</span><br> 
                       <small style="color:rgb(10, 126, 130)">{{ $withdrawal->formatted_payment_method }}<small>
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
                                <label> Amount</label>
                                <div class="input-group">
                                    <input type="text"  type="number" name="amount"   value="{{ old('amount') }}"class="form-control {{ is_tab('bitcoin', true) ? form_invalid('amount') : '' }}" required placeholder="100">
                                </div>
                                @showError('amount')
                            </div>
                            <div class="form-group pb-15">
                                <label>Select Withdraw Account</label>
                                <div class="input-group">
                                    <select  class="form-control {{ form_invalid('payment_method') }}" name="payment_method" id="inputPaymentMethod" aria-describedby="paymentMethodHelp">
                                        @foreach($withdrawals_account  as $oValue)
                                                <option  value="{{encrypt($oValue->id)}}"> {{ $oValue->currency  }}  | {{ $oValue->address  }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                @showError('payment_method')
                            
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
@include('mobile.misc.withdraw')
@include('mobile.misc.withdrawals-account')
@php  $modal = "200" @endphp
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

@if(Session::has('alert'))

@else
    @section('preloader')
    @include('partials.preloader')
    @endsection
@endif
