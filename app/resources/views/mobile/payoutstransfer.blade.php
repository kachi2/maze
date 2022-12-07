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
                    <h5>Payouts Transfer History</h5>
                </div>
            </div>
        </div>
      

        <div class="transaction-section pb-15">
            <div class="section-header">
               
            </div>
            @forelse ($payouts as $invst )
            <div class="transaction-card mb-15">
                <a href="#">
                    <div class="transaction-card-info">
                        <div class="transaction-info-text">
                            <p style="font-weight:bold">Ref: {{$invst->ref}}</p>
                            <p>Prev Bal:{{moneyFormat($invst->prev_balance, 'USD')}}</p>
                            <p>Avail Bal: {{moneyFormat($invst->avail_balance, 'USD')}}</p>
                            <p>Date: {{$invst->created_at->format('d/m/y h:m:ia')}}</p>
                        </div>
                    </div>
                    <div class="transaction-card-det ">
                        <span style="color:green">{{moneyFormat($invst->amount, 'USD')}}</span><br> 
                    </div>
                </a>
            </div>
            @empty
            <div class="transaction-card mb-15">
                <a href="transaction-details.html">
                    <div class="transaction-card-info">
                        <div class="transaction-info-text">
                            <p>No payouts record found</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforelse

        </div>
        
@endsection
