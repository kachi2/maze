@extends('layouts.mobile')
@section('nav')
  @include('partials.mobile_nav')
  @endsection
@section('content')

<div class="body-content">
    <div class="container p-4">
        <!-- Page-header -->
        <div class="page-header ">
            <div class="page-header-title page-header-item">
                <h3>Withdrawal Details</h3>
            </div>
        </div>
        <!-- Page-header -->
        
        <!-- Payment-list -->
        <div class="payment-list pb-15">
            <div class="payment-list-details">
                <div class="payment-list-item payment-list-title">Withdrawal Ref</div>
                <div class="payment-list-item payment-list-info">{{$withdrawal->ref}}</div>
            </div>
            <div class="payment-list-details">
                <div class="payment-list-item payment-list-title">Wallet Address</div>
                <div class="payment-list-item payment-list-info">{{$withdrawal->wallet_address}}</div>
            </div>
            <div class="payment-list-details">
                <div class="payment-list-item payment-list-title">Amount</div>
                <div class="payment-list-item payment-list-info">{{moneyFormat($withdrawal->amount, 'USD')}}</div>
            </div>
            <div class="payment-list-details">
                <div class="payment-list-item payment-list-title">Payment Method</div>
                <div class="payment-list-item payment-list-info">{{$withdrawal->payment_method}}</div>
            </div>
           
            <div class="payment-list-details">
                <div class="payment-list-item payment-list-title">Status</div>
                @if($withdrawal->status == 1)
                <div class="payment-list-item payment-list-info" style="color:rgb(13, 137, 239); font-size: 14px" >Success</div>
                 @elseif($withdrawal->status == 0) 
                 <div class="payment-list-item payment-list-info" style="color:rgb(11, 19, 26); font-size: 14px" >Pending</div> 
                  @else
                <div class="payment-list-item payment-list-info" style="color:rgb(189, 27, 9); font-size: 14px">Cancelled</div> 
                @endif    
            </div>
            <div class="payment-list-details">
                <div class="payment-list-item payment-list-title">Date</div>
                <div class="payment-list-item payment-list-info">{{$withdrawal->created_at}}</div>
            </div>
    
        </div>

       <center> @if( $withdrawal->status == 0)
         <a type="submit" class=" btn btn-warning " href="{{route('withdrawals.cancel',encrypt($withdrawal->id))}}"> Cancel</a>  
         @endif <a href="{{route('withdrawals')}}" class="btn btn-primary"> return back</a></center>
        <!-- Payment-list -->
    </div>
</div>
@endsection