@extends('layouts.app')
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
               
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-12 col-md-12 ">
                            <div class="card card-full">
                                <div class="card-inner">
                                        <a href="javascript:history.back()"  class="btn btn-outline-primary"> << Back </a>    
                                </div>
                                <div class="nk-tb-list mt-n2">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col"><span>Ref</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Amount</span></div>
                                        <div class="nk-tb-col"><span>Date Created</span></div>
                                       
                                        <div class="nk-tb-col">Status</div>
                                    </div>
                                    @forelse ($payouts as $invest)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-lead"><a href="#">#{{$invest->ref}}</a></span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <div class="user-card">
                                                <div class="user-name">
                                                    <span class="tb-lead">{{moneyFormat($invest->amount, 'USD')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span class="tb-sub">{{$invest->created_at}}</span>
                                        </div>
                                       
                                        <div class="nk-tb-col">
                                            <span class="badge badge-dot badge-dot-xs badge-success">Completed</span>
                                        </div>
                                </div>
                                    @empty
                                    <div class="nk-tb-item">
                                        
                                        <div class="nk-tb-col tb-col-sm">
                                           No Records Found 
                                        </div>
                                       
                                        
                                    </div>
                                    @endforelse
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
@endsection