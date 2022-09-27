@extends('layouts.mobile')
@section('content')

<div class="body-content body-content-lg"> <!-- "body-content-lg" add this class if any cards inside this div has "section-to-header" class -->
    <div class="container">
        <!-- Add-card -->
        <div class="add-card section-to-header mb-30">
            <div class="add-card-inner">
                <div class="add-card-item add-card-info">
                    <h3>Referral Earnings <br> {{ moneyFormat(get_stats()['all_time_referral_bonus'], 'USD') }}</h3>
                    <p> Total referrals: {{ get_stats()['referral_count'] }} user(s)</p>
                </div>
                <div class="add-card-item add-balance" data-bs-toggle="modal" data-bs-target="#addBalance">
                   
                  <a href="#"  data-bs-toggle="modal" data-bs-target="#transfer">Transfer Bonus</a>
                </div>
            </div>
        </div>
        <div class="transaction-section pb-15">
            <div class="section-header">
                
               
                <p><small>Copy referral link below, get up to $20 per referral and 5% bonus from their initial deposit</small></p>
                <input type="text" class="form-control" data-bs-toggle="tooltip" data-bs-placement="top" title="click to copy" onclick="copyText()"  id="addresses" value="{{ auth_user()->ref_url }}" placeholder="" readonly>    
                         
            </div>
        </div>

        <div class="transaction-section pb-15">
            <div class="section-header">
                <h2>My Referrals</h2>
            </div>
            @forelse($referrals as $referral)
            <div class="transaction-card mb-15">
                <a href="transaction-details.html">
                    <div class="transaction-card-info">
                        <div class="transaction-info-thumb">
                           <span style="color:aliceblue">{{strtoupper(substr($referral->user->username,0,2))}}</span> 
                        </div>
                        <div class="transaction-info-text">
                            <h3>{{ $referral->user->username }}</h3>
                            <p>Registered: {{ $referral->user->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @if( $referral->has_deposit )
                    <div class="transaction-card-det" style="color:green">
                        Deposit Made
                    </div>
                    @else
                    <div class="transaction-card-det negative-number">
                        No Deposit
                    </div>
                    @endif


                </a>
            </div>

            @empty
            <div class="transaction-card mb-15">
                <a href="transaction-details.html">
                    <div class="transaction-card-info">
                        
                        <div class="transaction-info-text">
                            <h3>No data found</h3>
                            
                        </div>
                    </div>
                </a>
            </div>
        @endforelse
        </div>


        <form method="post" action="{{ route('transfer.earnings') }}" id="transFrom">
            @csrf
        <div class="modal fade" id="transfer" tabindex="-1" aria-labelledby="passwordModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="container">
                        <div class="modal-header">
                            <div class="modal-header-title">
                                <h5 class="modal-title">Transfer bonus to main wallet</h5>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" value="2" name="bonus">
                                <div class="form-group pb-15">
                                    <label>Amount</label>
                                    <div class="input-group">
                                        <input   type="number" name="amounts"   value="{{ old('amount') }}"class="form-control {{  form_invalid('amount') }}" required placeholder="100">
                                    </div>
                                    @showError('amount')
                               
                                </div>
                                <button type="submit" class="btn main-btn main-btn-lg full-width">Transfer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>



@endsection
@push('scripts')
<script>
function copyText() {
    var copyText = document.getElementById("addresses");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy")
    }
</script>
@endpush


@push('scripts')
<script src="{{asset('/mobile/js/custom.js')}}"></script>
@endpush
@push('scripts')
<script>
    var img_url = {!! json_encode(asset('/mobile/images/')) !!};
 
 
 $('#transFrom').submit(function(e){
             e.preventDefault();
             var xhr = submit_form('#transFrom');
             xhr.done(function(result){
                 if(result){
                   console.log(result);
                     if(result.alert){
                         swal({
                         type:result.alert,
                         text: result.msg
                         }).then(function(){ 
                         //location.reload();
                         });
                     // console.log(result);
                     }
                 }
             });
         });
 </script>

 @endpush