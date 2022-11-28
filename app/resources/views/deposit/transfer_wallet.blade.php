
<div class="modal fade" tabindex="-1" role="dialog" id="payoutsTransfer">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
    <div class="modal-body modal-body-lg">
        <p> <span class=" icon icon-circle icon-circle-sm ni ni-check bg-success"></span>
          <span class="nk-title " style="font-size:20px; color:#000">Transfer Funds to <span style="color:rgb(109, 194, 246)"> Main Wallet</span></span> 
          <span style="float:right"> 
         <span style="font-size: 15px">Balance: {{moneyFormat($payouts, 'USD')}} </span> 
        </span>
        </p>
       
    <form method="post" action="{{route('web.transferPayouts', encrypt($plan->id))}}">
    @csrf
    <div class="tab-content">
    <div class="tab-pane active" id="personal">
    <div class="row gy-4">
    <div class="col-md-6">
    <div class="form-group">
    <label class="form-label" for="tnxid">Amount</label> <br>
    <input type="text" name="amount" class="form-control"> 
    </div>
    </div>
    <div class="col-12">
    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
    <li>
    <button type="submit" class="btn btn-lg btn-primary">Complete Transfer</button>
    </li>
    </ul>
    </div>
    </div>
    </div><!-- .tab-pane -->
    
    </div><!-- .tab-content -->
</form>
    </div><!-- .modal-body -->
    </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
    </div> 