@extends('layouts.mobile')
@section('content')
<div class="body-content">
    <div class="container">
      

       
        <div class="transaction-section pb-1" >
                <div class="section-header">
                    <h2>Coin Markets</h2>
                </div>
                @foreach ($coins as $coin )
            <div class="transaction-card mb-1">
                <a href="transaction-details.html">
                    <div class="transaction-card-info">
                        <div class="transaction-info-thumb">
                            <img src="{{$coin['image']}}" alt="user">
                        </div>
                        <div class="transaction-info-text" >
                            <p>{{$coin['name']}}</p>
                            <p> Market Cap: ${{number_format($coin['market_cap'])}}</p>
                        </div>
                    </div>
                    <div class="transaction-card-det" >
                        ${{number_format($coin['current_price'],2)}}<br>
                        @if($coin['price_change_24h'] < 0)
                        <span  style="color:red">{{number_format($coin['price_change_percentage_24h'],2)}}%</span>
                        @else 
                        <span  style="color:green">{{number_format($coin['price_change_percentage_24h'],2)}}%</span>
                        @endif
                    </div>
                    <div class="transaction-card-det negative-number">
                        
                        
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        

    </div>
</div>

@endsection

