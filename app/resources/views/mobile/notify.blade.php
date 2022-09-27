@extends('layouts.mobile')
@section('content')

<div class="body-content">
    <div class="container">
        <!-- Notification-section -->
        <div class="notification-section pb-15">

            @forelse($notifications as $notify)
            <div class="notification-item">
                <div class="notification-card">
                    <a href="#">
                        <div class="notification-card-thumb">
                            <i class="flaticon-bell"></i>
                        </div>
                        <div class="notification-card-details">
                            <p>{{$notify->message}}</p>         
                            <p>{{$notify->created_at->DiffForHumans()}}</p>
                        </div>
                    </a>
                </div>
            </div>
           @empty
           <div class="notification-item">
            <div class="notification-card">
                <a href="#" >
                    <div class="notification-card-thumb">
                        <i class="flaticon-bell"></i>
                    </div>
                    <div class="notification-card-details">
                        <h3>No notifications at the moment</h3>
                  
                    </div>
                </a>
            </div>
        </div>
           @endforelse

        </div>
        <!-- Notification-section -->
    </div>
</div>



@endsection