@extends('layouts.mobile')
@section('content')
<div class="body-content">
    <div class="container">
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
            @endforelse
            @if(count($notifications) > 0)
           <div class="notification-card-details">  
            <a href="{{route('create.notifications')}}">Clear Notification</a>
        </div>
        @endif
        </div>
        </div>
        <!-- Notification-section -->
    </div>
</div>
@endsection