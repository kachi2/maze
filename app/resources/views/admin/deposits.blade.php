@extends('layouts.admin')
@section('content')
     <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Investment Transactions</h3>
                                           
                                        </div><!-- .nk-block-head-content -->
                                         
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                  
                                                </div>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="card card-bordered card-stretch">
                                        <div class="card-inner-group">
                                            <div class="card-inner">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h5 class="title">Investments</h5>
                                                    </div>
                                                    <div class="card-tools mr-n1">
                                                        <ul class="btn-toolbar gx-1">
                                                            <li>
                                                                <a href="#" class="search-toggle toggle-search btn btn-icon" data-target="search"><em class="icon ni ni-search"></em></a>
                                                            </li><!-- li -->
                                                            <li class="btn-toolbar-sep"></li><!-- li -->
                                                            <li>
                                                                <div class="dropdown">
                                                                    <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-toggle="dropdown">
                                                                        <div class="badge badge-circle badge-primary">3</div>
                                                                        <em class="icon ni ni-filter-alt"></em>
                                                                    </a>
                                                                    <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-right">
                                                                        <div class="dropdown-head">
                                                                            <span class="sub-title dropdown-title">Advance Filter</span>
                                                                            
                                                                        </div>
                                                                        <div class="dropdown-body dropdown-body-rg">
                                                                            <div class="row gx-6 gy-4">
                                                                               
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <ul class="link-check">
                                                                            <li><a  href="{{ filter_url('all') }}">All Investments</a></li>
                                                                            <li><a href="{{ filter_url('active') }}">Active Investments</a></li>
                                                                            <li><a href="{{ filter_url('completed') }}">Completed Investments</a></li>
                                                                   
                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div><!-- .filter-wg -->
                                                                </div><!-- .dropdown -->
                                                            </li><!-- li -->
                                                            <li>
                                                                
                                                            </li><!-- li -->
                                                        </ul><!-- .btn-toolbar -->
                                                    </div><!-- .card-tools -->
                                                    <div class="card-search search-wrap" data-search="search">
                                                        <form method="get">
                                                        <div class="search-content">
                                                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                            <input type="text" name="search" value="{{ request()->input('search') }}" 
                                                   placeholder="Search..."  class="form-control border-transparent form-focus-none" >
                                                            <button class="search-submit btn btn-icon" type="submit"><em class="icon ni ni-search"></em></button>
                                                        </div>
                                                        </form>
                                                    </div><!-- .card-search -->
                                                </div><!-- .card-title-group -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner p-0">
                                                <div class="nk-tb-list nk-tb-tnx">
                                                    <div class="nk-tb-item nk-tb-head">
                                                        <div class="nk-tb-col"><span>#Ref</span></div>
                                                        <div class="nk-tb-col"><span>User</span></div>
                                                        <div class="nk-tb-col"><span>Plan</span></div>
                                                        <div class="nk-tb-col tb-col-lg"><span>Paid</span></div>
                                                        <div class="nk-tb-col "><span>Profit</span></div>
                                                        <div class="nk-tb-col  tb-col-sm"><span>Method</span></div>
                                                         <div class="nk-tb-col nk-tb-col-status"><span >Status</span></div>
                                                        <div class="nk-tb-col  tb-col-sm"><span>Created At</span></div>
                                                        <div class="nk-tb-col  tb-col-sm"><span>Expires At</span></div>
                                                        <div class="nk-tb-col  tb-col-sm"><span> </span></div>
                                                       
                                                    </div><!-- .nk-tb-item -->
                                                @foreach ($deposits as $deposit )
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col">
                                                            <div class="nk-tnx-type">
                                                               
                                                                <div class="nk-tnx-type-text">
                                                                    <span class="tb-lead">{{$deposit->ref}}</span>
                                                               
                                                                    <span class="tb-date">{{$deposit->created_at->format('d/m/y h:s A')}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-lg">
                                                            <span class="tb-lead-sub">{{ $deposit->user->username }}</span>
                                                            <span class="badge badge-dot badge-info">{{ $deposit->user->email}}</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-lg">
                                                            <span class="tb-lead-sub">{{ $deposit->plan->name }}</span>
                                                            <span class="badge badge-dot badge-success">{{ $deposit->plan->profit}} {{$deposit->plan->package->formatted_payment_period}} for {{$deposit->plan->package->formatted_duration}}</span>
                                                        </div>
                                                        <div class="nk-tb-col ">
                                                            <span class="tb-amount">{{moneyFormat($deposit->amount,'USD')}}</span>
                                                        </div>
                                                        <div class="nk-tb-col  tb-col-sm">
                                                            <span class="tb-amount">{{moneyFormat($deposit->paid_amount,'USD')}}</span>
                                                        </div>
                                                        <div class="nk-tb-col  tb-col-sm">
                                                            <span class="tb-amount">{{$deposit->payment_method}}</span>
                                                        </div>
                                                       
                                                        <div class="nk-tb-col nk-tb-col-status">
                                                            <div class="dot dot-success d-md-none"></div>
                                                             @if( $deposit->status == 1)
                                                            <span class="badge badge-sm badge-dim badge-outline-success d-none d-md-inline-flex">Completed</span>
                                                            @elseif ($deposit->status == -1)
                                                            <span class="badge badge-sm badge-dim badge-outline-warning d-none d-md-inline-flex">Cancelled</span>
                                                            @else
                                                             <span class="badge badge-sm badge-dim badge-outline-primary d-none d-md-inline-flex">Active</span>
                                                            @endif
                                                        </div>

                                                         <div class="nk-tb-col tb-col-sm">
                                                            <span class="tb-amount">{{$deposit->created_at}}</span>
                                                        </div>
                                                         <div class="nk-tb-col  tb-col-sm">
                                                            <span class="tb-amount">{{$deposit->expires_at->diffForHumans()}}</span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <div class="drodown">
                                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <ul class="link-list-opt no-bdr">
                                                                               
                                                                                <li><a  class="data-item" data-toggle="modal" data-target="#deposit_id{{$deposit->id}}" href="javascript();"><em class="icon ni ni-user"></em><span >View Details</span></a></li>
                                                                                @if($deposit->status == 0)
                                                                                <form method="post" action="{{route('admin.users.terminate')}}" id="form{{$deposit->id}}">
                                                                                    @csrf
                                                                                <input type="hidden" name="id" value="{{encrypt($deposit->id)}}" class="depositId">
                                                                                <li><button type="submit"  class="btn btn-outline-none" ><em class="icon ni ni-pen"></em><span style="color:red">Terminate</span></button></li>
                                                                                 </form>
                                                                                @endif
                                                                                <li><a  href="{{ route('admin.users.show', ['id' => encrypt($deposit->user->id)]) }}"><em class="icon ni ni-eye"></em><span>View User</span></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .nk-tb-item --> 
                                                    @include('admin.misc.deposit-details')
                                                @endforeach          
                                                </div><!-- .nk-tb-list -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner">
                                               {{$deposits->links()}}
                                            </div><!-- .card-inner -->
                                        </div><!-- .card-inner-group -->
                                    </div><!-- .card -->
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                    </div>
                </div>
               
@endsection





@section('scripts')
    <script>
          function markDepositExpired() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Terminate',
                cancelButtonText: 'No, cancel!'
            }).then(function (result) {
                if (result.value) {
                    $('#formMark').submit();
                }
            });
        }
 
 

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