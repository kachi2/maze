@extends('layouts.mobile')

@section('content')

<div class="body-content body-content-lg"> <!-- "body-content-lg" add this class if any cards inside this div has "section-to-header" class -->
    <div class="container">
        <!-- Add-card -->
        <div class="add-card section-to-header mb-30">
            <div class="add-card-inner">
                <div class="add-card-item add-card-info">
                    <h3>Total Bonus <br> {{ moneyFormat(auth()->user()->wallet->bonus, 'USD') }}</h3>
                </div>
                <div class="add-card-item add-balance" data-bs-toggle="modal" data-bs-target="#addBalance">
                   
                  <a href="#"  data-bs-toggle="modal" data-bs-target="#transfer">Transfer Bonus</a>
                </div>
            </div>
        </div>
        <div class="transaction-section pb-15">
            <div class="section-header">
                <h2>Task Center
                    <hr style="width:100%; color:brown">
                </h2>
               
                <p><small>Once you receive the task, the deadline countdown starts. Complete your task within the deadline to get your reward</small></p>
            </div>

      <div class="feature-section mb-15">
          @forelse ($tasks as $task)
            <div class="row gx-3">
                <div class="col-md-12 col-sm-12">
                    <div  style="align-items:initial; box-shadow:none" class="feature-card feature-card-red">
                        <div class="feature-card-thumb">
                            <i class="flaticon-income"></i>
                        </div>
                        
                        <div class="feature-card-details">
                            <div class="col-md-6 col-sm-6">
                                <form action="{{route('bonus.initate', encrypt($task->plan_id))}}" method="get">
                                    @csrf
                            <p style=color:#000>{{$task->name}} 
                                @if($task->metrics >= 10 && $task->status != 0) 
                                <button type="button" data-bs-toggle="modal" data-bs-target="#awardModal{{$task->id}}" style="font-size:9px" class="btn-info p-1 float-end"> Claim Reward  </button>  
                                @elseif($task->metrics >= 10 && $task->metrics <= 100 && $task->status != 1 ) <button style="font-size:9px" class="btn-primary p-1 float-end"> running  </button> 
                                @elseif($task->metrics <= 0 && $task->status != 1)
                                <button type="submit" style="font-size:9px" class="btn-primary p-1 float-end">Start Task </button>
                                @else 
                                <span  style="font-size:9px" class="btn-danger p-1 float-end">Closed </span>
                                @endif 
                            <input type="hidden" name="task_id" value="{{$task->id}}">
                            </p> 
                                </form>
                            <p> <small> <a href="#" data-bs-toggle="modal" data-bs-target="#centerModal{{$task->id}}">View Rules</a></small></p>
                        </div>
                        <div class="progress" style="height: 5px; width:50%">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:@if($task->is_clicked){{$task->metrics}}% @else 0% @endif "></div>
                          </div><p>@if($task->metrics >= 10 && $task->metrics < 100) initiated @elseif($task->metrics >= 100)  completed @else pending @endif</p> 
                          
                            <p><span style=" btn-sm btn-warning"> Reward</span> <span class="btn-warning p-1"> {{$task->reward}} USD</span> </p>
                            <p> <small> Expires in {{$task->expires}}</small> <span class="float-end" style="color:green">@if($task->expires >= now())Active</span>@else <span class="p-1" style="color:rgb(165, 164, 164); background:rgb(234, 234, 237)">Expired</span> @endif</p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Centermodal -->
 <div class="modal fade" id="centerModal{{$task->id}}" tabindex="-1" aria-labelledby="centerModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="container">
                <div class="modal-header">
                    <div class="modal-header-title">
                        <h5 class="modal-title">Task Rule</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">{{$task->rules}}</p>
                </div>
            </div>
        </div>
    </div>
</div>   

<div class="modal fade" id="awardModal{{$task->id}}" tabindex="-1" aria-labelledby="centerModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="container">
                <div class="modal-header">
                    <div class="modal-header-title">
                        <h5 class="modal-title">Claim Bonus</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Thanks for completing {{$task->name}}, <span class="btn-info p-1"> {{moneyFormat($task->reward, 'USD')}}</span> will be sent to your bonus wallet within next 4hrs</p>
                   <center><button type="button"  class="btn btn-warning" data-bs-dismiss="modal" aria-label="Close"> Close Modal</button></center> 
                </div>
            </div>
        </div>
    </div>
</div> <hr>
<!-- end of container -->
            @empty

            <div class="row gx-3">
                <div class="col-md-12 col-sm-12">
                    <div  style="align-items:initial; box-shadow:none" class="feature-card feature-card-red">
                        <div class="feature-card-thumb">
                            <i class="flaticon-income"></i>
                        </div>
                        
                        <div class="feature-card-details">
                            <div class="col-md-6 col-sm-6">
                            <p style=color:#000>You dont have any task yet. check back later
                            </p> 
                         </div>
                    </div>
                </div>
            </div>
            </div>
                
            @endforelse
            {{-- ///////// --}}
         
        </div>
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
                            <input type="hidden" value="1" name="bonus">
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
                         location.reload();
                         });
                     // console.log(result);
                     }
                 }
             });
         });
 </script>

 @endpush
