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
                    <h3>Main Wallet <br> {{ moneyFormat(auth()->user()->wallet->amount, 'USD') }}</h3>
                    
                </div>
                <div class="add-card-item add-balance" data-bs-toggle="modal" data-bs-target="#addBalance">
                   
                  <a href="#"  data-bs-toggle="modal" data-bs-target="#transfer">Transfer Funds</a>
                </div>
            </div>
        </div>
        <div class="feature-section mb-15">
            <div class="row gx-3">
                <div class="col-md-12 col-sm-12 pb-15">
                    <div class="feature-card feature-card-red">
                        <div class="feature-card-thumb">
                            <i class="flaticon-income"></i>
                        </div>
                        <div class="feature-card-details">
                            <p>Total Transferred</p>
                            <h3>{{ moneyFormat($sent, 'USD')}}</h3>
                        </div> &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;
                        <div class="feature-card-details">
                            <p>Total Received</p>
                            <h3>{{ moneyFormat($received, 'USD')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="transaction-section pb-15">
            <div class="section-header">
                <h2>Recent Transfers</h2>
            </div>
            @forelse ($transfers as $transfer )
            <div class="transaction-card mb-15">
                <a href="#">
                    <div class="transaction-card-info">
                        <div class="transaction-info-thumb" style="border-radius: 100%">
                            <span class="text-white" style="font-size:15px"><?php if(isset($transfer->receiver_id) &&  $transfer->receiver_id != auth()->user()->id){ echo strtoupper(substr($transfer->receiver->username,0,2));}else{echo strtoupper(substr($transfer->sender->username,0,2)) ;}?></span>
                        </div>
                        <div class="transaction-info-text">
                            <p><?php if(isset($transfer->receiver_id) && $transfer->receiver_id == auth()->user()->id){echo "Received from "."<small>".$transfer->sender->name. "<br>". $transfer->sender->email. "<br>". $transfer->sender->btc."</small>"; 
                         
                          }else{echo "Transferred  to "."<small>".$transfer->receiver->username."</small>";}   ?>
                            </p>
                            
                            <p><small class="positive-number">{{$transfer->created_at->format('d/m/y h:s A')}}<small></p>
                                <span style="color:green; font-size:12px"> completed</span>
                            
                        </div>
                    </div>
                    <div class="transaction-card-det ">
                        <?php if(isset($transfer->receiver_id) && $transfer->receiver_id != auth()->user()->id){ echo "<span style=\"color:#000\">".moneyFormat($transfer->amount, 'USD') ."</span>" ;}else{ echo "<span style=\"color:green\">".moneyFormat($transfer->amount, 'USD') ."</span>" ;}?> <br> 
                        <span class="negative-number">  <?php if(isset($transfer->receiver_id) && $transfer->receiver_id != auth()->user()->id){
                           echo moneyFormat($transfer->sender_balance, 'USD'); } ?></span><br>
                    </div>
                </a>
            </div>
            @empty
            <div class="transaction-card mb-15">
                <a href="#">
                    <div class="transaction-card-info">
                        <div class="transaction-info-thumb" style="border-radius: 100%">
                            <span class="text-white" style="font-size:15px"></span>
                        </div>
                        <div class="transaction-info-text">
                            <h3>No Transfer found</small>
                            </h3>
                            
                        </div>
                    </div>
                    
                </a>
            </div>
            @endforelse
        </div>

        <form method="post" action="{{ route('transfer') }}" id="transferForm">
            @csrf
        <div class="modal fade" id="transfer" tabindex="-1" aria-labelledby="passwordModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="container">
                        <div class="modal-header">
                            <div class="modal-header-title">
                                <h5 class="modal-title">Transfer funds</h5>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                                <div class="form-group pb-15">
                                    <label>Amount</label>
                                    <div class="input-group">
                                        <input   type="number" id="amount" name="amount"   value="{{ old('amount') }}"class="form-control {{  form_invalid('amount') }}" required placeholder="100">
                                    </div>
                                    
                                    @showError('amount')
                               
                                </div>
                                <div class="form-group pb-15">
                                    <label>Enter Mazeoptions Address</label>
                                    <div class="input-group">
                                        <input type="text" id="user_address" name="address" value="{{ old('address') }}"class="form-control {{ form_invalid('address') }}" required placeholder="Enter Address">
                                    </div>
                                    @showError('address')
                                </div>

                                <button type="submit" id="complete" class="btn main-btn main-btn-lg full-width">Initiate Transfer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<!-- end of container -->
    </div>
</div>




@endsection

@push('scripts')
<script src="{{asset('/mobile/js/custom.js')}}"></script>
@endpush
@push('scripts')
<script>
    var img_url = {!! json_encode(asset('/mobile/images/')) !!};
 
$('#user_address').on('change', function(){
    address = $('#user_address').val();
    amount = $('#amount').val();
                    $.ajaxSetup({
                        Headers:
                        {
                         'X-CRSF-TOKEN': $('meta[name="crsf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('verify-transfer')}}",
                        type:'get',
                        data:{
                        amount:amount,
                        address:address,
                         cache: false,
                        },
                        DataType:'json',
                        success:function(response){
                        swal({
                         type:response.name,
                         text: response.msg
                         }).then(function(){
                            if(response.success){
                                $('#complete').html("Complete Transfer")
                            }else{
                                $('#passwordModal').modal('hide')
                                $('#complete').html("Close Window")
                            }
                         });
                         $('#complete').html("Close Window")
                        },
                    });  
             });
 
 $('#transferForm').submit(function(e){
             e.preventDefault();
             var xhr = submit_form('#transferForm');
             xhr.done(function(result){
                 if(result){
                   console.log(result);
                     if(result.alert){
                         swal({
                         type:result.alert,
                         text: result.msg
                         }).then(function(){ 
                         location.reload();
                         });
                     // console.log(result);
                     }
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