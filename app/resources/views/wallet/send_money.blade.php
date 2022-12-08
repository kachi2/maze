@extends('layouts.app')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-12 col-md-5">
                            <div class="buysell wide-xs m-auto">
                                <form method="post" action="{{ route('web.transfers') }}" id="transferForm">
                                    @csrf
                                 <div class="card card-bordered pricing">
                                 <div class="pricing-head">
                                    <div class="pricing-title">
                                     <h4 class="card-title title">Send Money</h4>
                                    </div>
                                     
                                         </div>
                                        
                                         <div class="pricing-body">
                                          
                                           

                                            <div class="form-group">
                                                <label for="inputAmount">Amount</label>
                                                <input type="number" name="amount"
                                                       value="{{ old('amount') }}"
                                                       class="form-control {{ form_invalid('amount') }}" id="amount" aria-describedby="AmountHelp" placeholder="Enter amount">
                                                <small id="AmountHelp" class="form-text text-muted">
                                                    Transfer amount in USD
                                                </small>
                                                @showError('amount')
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAmount">Mazeoptions Address</label>
                                                <input type="text" name="address" 
                                                       value="{{ old('address') }}" 
                                                       class="form-control {{ form_invalid('address') }}" id="user_address" aria-describedby="AmountHelp" placeholder="Enter address">
                                                <small id="AmountHelp" class="form-text text-muted">
                                                 Your wallet address is located at the User Account Page
                                                </small>
                                                @showError('address')
                                            </div>
                                        
                                              <div class="buysell-field form-action">
                                                <button type="submit" id="complete" class="btn btn-primary">Transfer</button>
                                         </div>
                                 </form><!-- .buysell-block -->
                             </div><!-- .buysell -->


                        </div><!-- .col -->
                    </div><!-- .col -->
                </div><!-- .col -->
                        <div class="col-12 col-md-7 p">
                            <div class="card card-full">
                            <div class="nk-block-head-content p-3 pb-5">
                                <h6 class="nk-block-title ">Transactions</h6>
                               
                            </div><!-- .nk-block-head-content -->
                                <div class="nk-tb-list mt-n2">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col"><span>Type</span></div>
                                        <div class="nk-tb-col"><span>Amount</span></div>
                                        <div class="nk-tb-col"><span>Create At</span></div>
                                        <div class="nk-tb-col"></div>
                                    </div>
                                    @forelse ($transfers as $transfer )
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col tb-col-lg">
                                            <span class="tb-lead-sub">
                                                <p><?php if(isset($transfer->receiver_id) && $transfer->receiver_id == auth()->user()->id){echo "Received from "."<small>". $transfer->sender->email . $transfer->sender->btc ."</small>"; 
                         
                                                }else{echo "Transferred  to "."<small>".$transfer->receiver->email.  "<br>". $transfer->sender->btc ."</small>";}   ?>
                                                  </p>
                                            </span>
                                        </div>
                                        <div class="nk-tb-col tb-col-lg">
                                            <span class="tb-lead-sub">
                                                <?php if(isset($transfer->receiver_id) && $transfer->receiver_id != auth()->user()->id){ echo "<span style=\"color:#000\">".moneyFormat($transfer->amount, 'USD') ."</span>" ;}else{ echo "<span style=\"color:green\">".moneyFormat($transfer->amount, 'USD') ."</span>" ;}?> <br> 
                                                <span class="negative-number">  <?php if(isset($transfer->receiver_id) && $transfer->receiver_id != auth()->user()->id){
                                                   echo moneyFormat($transfer->sender_balance, 'USD'); } ?>
                                            </span>
                                        </div>
                                        <div class="nk-tb-col tb-col-lg">
                                            <span class="tb-lead-sub">{{ $transfer->created_at }}</span>
                                        </div>
                                    </div><!-- .nk-tb-item --> 
                                   
                                    @empty
                                    <div class="nk-tb-item">
                                        
                                        <div class="nk-tb-col tb-col-sm">
                                           No Records Found for this Campaign
                                        </div>
                                       
                                        
                                    </div>
                                    @endforelse
                                    @if(count($transfers) > 1)
                                    <div> {{$transfers->links()}}</div>

                                    @endif
                                </div>
                            </div><!-- .card -->
                        </div>
                     
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>

      
@endsection
@section('scripts')
<script src="{{asset('/mobile/js/custom.js')}}"></script>
<script>

let message = {!! json_encode(Session::get('message')) !!};
let msg = {!! json_encode(Session::get('alert')) !!};


//alert(msg);
if(message != null){
toastr.clear();
    NioApp.Toast(message , msg, {
      position: 'top-right',
        timeOut: 5000,
    });
}

</script>



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
                        url: "{{route('web.verify-transfer')}}",
                        type:'get',
                        data:{
                        amount:amount,
                        address:address,
                         cache: false,
                        },
                        DataType:'json',
                     
                        success:function(response){
                            Swal.fire({
                            text: response.msg,
                            icon: response.alert,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                            }).then((result) => {
                            if (response.success) {
                                $('#complete').html("Complete Transfer");
                            }else{
                                $('#complete').html("Close Window");
                                $('#complete').attr('type', 'button');
                            }
                            });
                         
                        },
                    });  
             });
 
 $('#transferForm').submit(function(e){
             e.preventDefault();
             var xhr = submit_form('#transferForm');
             xhr.done(function(result){
                 if(result){
                 //  console.log(result);
                     if(result.alert){
                         Swal.fire({
                         type:result.alert,
                         text: result.msg
                         }).then(function(){ 
                            if(result.success){
                                location.reload();
                            }
                      
                         });
                     // console.log(result);
                     }
                 }
             });
         });
 </script>

@endsection