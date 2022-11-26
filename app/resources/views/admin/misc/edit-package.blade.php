<div class="modal fade" tabindex="-1" id="modalForm{{$package->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit {{$package->plans[0]->name}}</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
         
            <form method="post" action="{{ route('admin.plans.edit', ['id' => $package->plans[0]->id]) }}" enctype="multipart/form-data">
                @csrf
            <div class="modal-body">
                <form action="#" class="form-validate is-alter">
                    <div class="form-group">
                        <label class="form-label" for="full-name">Plan Name</label>
                        <div class="form-control-wrap">
                            <input type="text" name="name" class="form-control"  value="{{$package->plans[0]->name}}" id="full-name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email-address">Min Deposit</label>
                        <div class="form-control-wrap">
                            <input type="text" name="min_deposit"  class="form-control" value="{{$package->plans[0]->min_deposit}}"  id="email-address" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone-no">Max Deposit</label>
                        <div class="form-control-wrap">
                            <input type="text" name="max_deposit" class="form-control" value="{{$package->plans[0]->max_deposit}}"  id="phone-no">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pay-amount">Package Duration</label>
                        <div class="form-control-wrap">
                            <input type="text" name="duration"  class="form-control" value="{{$package->duration}}" id="pay-amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pay-amount">Profit Rate (%)</label>
                        <div class="form-control-wrap">
                            <input type="text" name="profit_rate"  class="form-control" value="{{$package->plans[0]->profit_rate}}" id="pay-amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pay-amount">Profit (%) </label>
                        <div class="form-control-wrap">
                            <input type="text" name="profit"  class="form-control" value="{{$package->plans[0]->profit}}" id="pay-amount">
                        </div>
                    </div>
                        <div class="form-group">
                            <label class="form-label" for="pay-amount">Image</label>
                            <div class="form-control-wrap">
                                <input type="file" name="image" class="form-control" id="pay-amount">
                            </div>
                        </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">Update Plan</button>
                    </div>
               
            </div>
        </form>
            <div class="modal-footer bg-light">
                <span class="sub-text"></span>
            </div>
        </div>
    </div>
</div>