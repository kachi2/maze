<form method="post" action="{{ route('setting.profile') }}" enctype="multipart/form-data">
    @csrf
<div class="modal fade" tabindex="-1" role="dialog" id="pending_deposit{{$deposit->id}}">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
<a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
<div class="modal-body modal-body-lg">
    <p> <span class=" icon icon-circle icon-circle-sm ni ni-check bg-success"></span>
      <span class="nk-title " style="font-size:20px; color:#000">Transaction <span style="color:rgb(109, 194, 246)"> #{{$deposit->ref}}</span></span> 
      <span style="float:right"> 
      @if($deposit->status == 1) <span class="badge badge-success">Confirmed </span> 
      @elseif($deposit->status == -1)
      <span class="badge badge-danger">Cancelled</span>
      @else
      <span class="badge badge-warning">Pending</span>
      @endif
    </span>
    </p>
     <p style="font-size:15px; font-weight:bolder"> {{moneyFormat($deposit->amount, 'USD')}}  
        <small>  {{$deposit->created_at->format('d M, y H:i:a')}}</small> </span> </p>
<ul class="nk-nav nav nav-tabs">
   
</ul><!-- .nav-tabs -->

<div class="tab-content">
<div class="tab-pane active" id="personal">
<div class="row gy-4">
<div class="col-md-6">
<div class="form-group">
<label class="form-label" for="tnxid">Reference / Hash</label> <br>
<span id="tnxid"> {{$deposit->hash_no?$deposit->hash_no : 'No hash number' }}</span>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label class="form-label" for="display-name">Ref</label><br>
<span id="tnxid" class="caption-text">{{$deposit->ref}}</span>
</div>

</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="form-label" for="display-name">Payment Method</label><br>
        <span id="tnxid" class="caption-text">{{$deposit->payment_method}}</span>
        </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="form-label" for="display-name">Exchange</label><br>
        <span id="tnxid" class="caption-text">{{$deposit->amount2}} {{$deposit->currency2}}</span>
        </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="form-label" for="display-name">User</label><br>
        <span id="tnxid" class="caption-text"> {{$deposit->user->email}}</span>
        </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="form-label" for="display-name">Created at</label><br>
        <span id="tnxid" class="caption-text">{{$deposit->created_at}} </span>
        </div>
</div>

<div class="col-12">
<ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
<li>
<button type="button" class="btn btn-lg btn-primary" data-dismiss="modal">Close</button>
</li>
</ul>
</div>
</div>
</div><!-- .tab-pane -->

</div><!-- .tab-content -->
</div><!-- .modal-body -->
</div><!-- .modal-content -->
</div><!-- .modal-dialog -->
</div>
</form>  