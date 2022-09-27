@extends('layouts.admin', ['page_title' => 'Withdrawals'])
@section('content')

    <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="components-preview wide-md mx-auto">
                                 <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title fw-normal">Deposits</h5>
                                        
                                    </div>
                                    <div class="nk-block-head-content">
                                      
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                                
                                <div class="nk-block nk-block-lg">
                                    <div class="card card-preview">
                                        <div class="card-inner">
                                            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="true">
                                                <thead>
                                                    <tr class="nk-tb-item nk-tb-head">
                                                       <th class="nk-tb-col "><span class="sub-text">ID</th>
                                                          <th class="nk-tb-col "><span class="sub-text">#Ref</th>
                                                          <th class="nk-tb-col "><span class="sub-text">User</th>
                                                          <th class="nk-tb-col "><span class="sub-text">Plan</th>
                                                         <th class="nk-tb-col "><span class="sub-text">Amount</th>
                                                          <th class="nk-tb-col "><span class="sub-text">Profit</th>
                                                           <th class="nk-tb-col "><span class="sub-text">Paid</th>
                                                           <th class="nk-tb-col "><span class="sub-text">Method</th>
                                                           <th class="nk-tb-col "><span class="sub-text">Status</th>
                                                         <th class="nk-tb-col "><span class="sub-text">Date</th>
                                                          <th class="nk-tb-col "><span class="sub-text">Expires_At</th>
                                                         
                                                          <th class="nk-tb-col nk-tb-col-tools text-right"> 
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                             @forelse($deposits as $deposit)
                                                    <tr class="nk-tb-item">
                                                        <th scope="row">{{ $deposit->id }}</th>
                                                        <th scope="row">{{ $deposit->ref }}</th>
                                                       <td class="nk-tb-col ">
                                                            <a href="{{ route('admin.users.show', ['id' => $deposit->user->id]) }}">
                                                                {{ $deposit->user->username }}
                                                            </a>
                                                        </td>
                                                        <td class="nk-tb-col ">{{ $deposit->plan->formatted_name }}</td>
                                                        <td class="nk-tb-col ">{{ moneyFormat($deposit->amount, 'USD') }}</td>
                                                       <td class="nk-tb-col ">{{ moneyFormat($deposit->profit, 'USD') }}</td>
                                                        <td class="nk-tb-col ">{{ moneyFormat($deposit->paid_amount, 'USD') }}</td>
                                                       <td class="nk-tb-col ">{{ $deposit->formatted_payment_method }}</td>
                                                            <td class="nk-tb-col ">
                                                            @if( $deposit->status == \App\Models\Deposit::STATUS_COMPLETED)
                                                                <span class="tb-status text-success">Completed</span>
                                                               @elseif ($deposit->status == \App\Models\Deposit::STATUS_CANCELED)
                                                                <span class="tb-status text-danger">Cancelled</span>
                                                            @else
                                                                <span class="tb-status text-success">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td class="nk-tb-col">{{ $deposit->created_at }}</td>
                                                        <td class="nk-tb-col">{{ $deposit->expires_at->diffForHumans() }}</td>
                                                        <td class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1"> 
                                                                <li>
                                                                    <div class="drodown">
                                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <ul class="link-list-opt no-bdr">
                                                                         @if(!$deposit->has_expired)
                                                                                <form id="formMark" action="{{ route('admin.deposits.mark_expired', ['id' => $deposit->id]) }}" method="post">
                                                                                @csrf
                                                                                <li><button type="submit" style="border:none" onclick="return confirm('Are you Sure')">
                                                                                <em class="icon ni ni-shield-off"></em><span>Mark Expired</span></button></li>
                                                                                </form>
                                                                                 @endif
                                                                                 
                                                                          @if($deposit->status == 0)
                                                                                <form id="formMark" action="{{ route('admin.deposits.mark_completed', ['id' => $deposit->id]) }}" method="post">
                                                                                @csrf
                                                                                <li><button type="submit" style="border:none" onclick="return confirm('Are you Sure')">
                                                                                <em class="icon ni ni-shield-off"></em><span>Mark as Completed</span></button></li>
                                                                                </form>
                                                                                 @endif
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                        @empty
                                            <tr>
                                                <td><span>No Withdrawals Yet</span>
                                                <td>
                                            </tr>
                                        @endforelse


                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- .card-preview -->
                                </div> <!-- nk-block -->
                            </div><!-- .components-preview -->
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
                confirmButtonText: 'Yes, mark expired!',
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