@extends('layouts.mobile')
@section('content')



<div class="body-content">
    <!-- Inbox -->
    <div class="message-full-area">
        <!-- Inbox-area -->

        
        <div class="inbox-area">
            <div class="container">
                @forelse ($message as  $msg)
                @if($msg->receiver_id == auth()->user()->id)
                <div class="inbox-area-item inbox-area-item-sender"> <!-- "inbox-area-item" class is used for the coversation which is started from a time. "inbox-area-item-sender" class is used for the sender message. -->
                    <div class="message-time"></div> <!-- "message-time" class is used for the time that the message has been sent or received. -->
                    <div class="inbox-message-item"> <!-- "inbox-message-item" class is used for individual message. -->
                        <div class="inbox-message-thumb">
                            <img src="{{asset('/mobile/images/profile.png')}}"alt="profile">
                        </div>
                        <div class="inbox-message-text-item">
                            <div class="inbox-message-text">
                               {{$msg->message}} <br> <small>{{$msg->created_at->format('d/m/yy h:sa')}}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($msg->sender_id == auth()->user()->id)
                <div class="inbox-area-item inbox-area-item-me" > <!-- "inbox-area-item" class is used for the coversation which is started from a time. "inbox-area-item-me" class is used for the self message. -->
                    <div class="inbox-message-item">
                        <div class="inbox-message-thumb">
                            <img src="{{asset('/mobile/images/profile.png')}}"alt="profile">
                        </div> <!-- "inbox-message-item" class is used for individual message. -->
                        <div class="inbox-message-text-item">
                            <div class="inbox-message-text">
                                {{$msg->message}}
                           <br> <small> {{$msg->created_at->format('d/m/yy h:sa')}}</small></div>
                        </div>
                    </div>
                </div>
                @endif
                @empty
                @endforelse
            </div>
        </div>
        <!-- Inbox-area -->
        <!-- Inbox-compose-area -->
        <div class="inbox-compose-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="inbox-compose-item">
                            <form action="{{route('users.send.message')}}" method="post"> 
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="message" class="form-control" placeholder="Type Your Message">
                                    <button type="submit"><i class="flaticon-send"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           
            </div>
        </div>
        <!-- Inbox-compose-area -->
    </div>
    <!-- Inbox -->
</div>


@endsection