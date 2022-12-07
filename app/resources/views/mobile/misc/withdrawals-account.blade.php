<div class="modal fade" id="withdrawalAccounts" tabindex="-1" aria-labelledby="passwordModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container">
                <div class="modal-header">
                    <div class="modal-header-title">
                        <h5 class="modal-title">Withdraw Accounts</h5>
                        
                    </div>
                   <div style="float:right"> 
                   <div style="width:13rem"> </div>
                   <a href="#"  style="float:right;" data-bs-toggle="modal" data-bs-target="#alertModal" class="btn-info btn-sm">Add New</a>
                   </div>  
                </div>
                <div class="modal-body">
                    @foreach ($Waccounts as  $accounts)
                    <div class="transaction-card mb-15">
                        <a href="#">
                            <div class="transaction-card-info">
                                <div class="transaction-info-text">
                                    <p style="font-weight:bold">{{$accounts->account_type}}</p>
                                    <p>{{$accounts->address}}</p>
                                    <p>{{$accounts->created_at}}</p>
                                </div>
                            </div>
                            <div class="transaction-card-det ">
                                <span style="color:green">{{$accounts->currency}}</span><br> 
                            </div>
                            <div class="transaction-card-det ">
                                <form method="get" action="{{route('wDeleteAddress', encrypt($accounts->id))}}"> 
                                <button  class=" btn btn-outline-none" style="color:rgb(210, 36, 13)">Delete</button><br> 
                            </div>
                        </form>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</form>