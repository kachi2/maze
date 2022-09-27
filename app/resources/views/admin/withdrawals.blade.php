@extends('layouts.admin', ['page_title' => 'Withdrawals'])
@section('content')

    <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="components-preview wide-md mx-auto">
                                 <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title fw-normal">Users List</h5>
                                        
                                    </div>
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                            <li class="order-md-last">
                                                   <a href="{{ route('admin.withdrawals.add') }}" class="btn btn-primary"><i
                                                    class='uil uil-plus mr-1'></i>Add Withdrawals</a> </li>
                                       </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                                
                                <div class="nk-block nk-block-lg">
                                    <div class="card card-preview">
                                        <div class="card-inner">
                                            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="true">
                                                <thead>
                                                    <tr class="nk-tb-item nk-tb-head">
                                                         <th class="nk-tb-col "><span class="sub-text">Id</th>
                                                        <th class="nk-tb-col "><span class="sub-text">#Ref</th>
                                                       <th class="nk-tb-col "><span class="sub-text">User</th>
                                                       <th class="nk-tb-col "><span class="sub-text">Amount</th>
                                                        <th class="nk-tb-col "><span class="sub-text">Wallet</th>
                                                        <th class="nk-tb-col "><span class="sub-text">Method</th>
                                                        <th class="nk-tb-col "><span class="sub-text">Status</th>
                                                        <th class="nk-tb-col "><span class="sub-text">Date</th>
                                                    
                                                        
                                                        <th class="nk-tb-col nk-tb-col-tools text-right"> 
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($withdrawals as $withdrawal)
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col " >
                                                            <span class="tb-amount">{{ $withdrawal->id }} </span>
                                                        </td>
                                                        <td class="nk-tb-col " >
                                                            <span class="tb-amount">{{ $withdrawal->ref }} </span>
                                                        </td>
                                                        <td class="nk-tb-col ">
                                                            <span> <a href="{{ route('admin.users.show', ['id' => $withdrawal->user->id]) }}">
                                                        {{ $withdrawal->user->username }}
                                                    </a></span>
                                                        </td>
                                                        <td class="nk-tb-col " >
                                                             <span>{{ moneyFormat($withdrawal->amount, 'USD') }}</span>      
                                                        </td>
                                                        <td class="nk-tb-col ">
                                                            <span>{{ $withdrawal->wallet_address }}</span>
                                                        </td>
                                                         <td class="nk-tb-col ">
                                                            <span>{{ $withdrawal->formatted_payment_method }}</span>
                                                        </td>
                                                            <td class="nk-tb-col ">
                                                            @if( $withdrawal->status == \App\Models\Withdrawal::STATUS_PAID)
                                                                <span class="tb-status text-success">Completed</span>
                                                             @elseif ($withdrawal->status == \App\Models\Withdrawal::STATUS_CANCELED)
                                                                <span class="tb-status text-danger">Cancelled</span>
                                                            @else
                                                                <span class="tb-status text-success">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td class="nk-tb-col">
                                                            <span>{{ $withdrawal->created_at }}</span>
                                                        </td>
                                                        <td class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1"> 
                                                                <li>
                                                                    <div class="drodown">
                                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <ul class="link-list-opt no-bdr">
                                                                            @if($withdrawal->status == \App\Models\Withdrawal::STATUS_PENDING)
                                                                                 <form id="formCancel" action="{{ route('admin.withdrawals.cancel', ['id' => $withdrawal->id]) }}" method="post">
                                                                                @csrf
                                                                                <li><button type="submit" style="border:none" onclick="return confirm('Are you Sure')">
                                                                                <em class="icon ni ni-shield-off"></em><span>Cancel</span></button></li>
                                                                                 </form>
                                                                                 @if(!$withdrawal->paid)
                                                                                 <form id="formMark" action="{{ route('admin.withdrawals.mark_paid', ['id' => $withdrawal->id]) }}" method="post">
                                                                                @csrf
                                                                                <li><button  type="submit" style="border:none" onclick="return confirm('Are you Sure')"><em class="icon ni ni-na"></em><span>Mark Paid</span></a></li>
                                                                                <li class="divider"></li>
                                                                                 </form>
                                                                                  @endif
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
    
          function cancelWithdrawal() {
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, do it!'
            }).then((result) => {
                if(result.value) {
                   document.getElementById('formCancel').submit();
                }
            })
        }
        
        function markWithdrawalAsPaid(url) {
            Swal.fire({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, mark paid!',
                cancelButtonText: 'No, cancel!'
            }).then(function (result) {
                if (result.value) {
                    document.getElementById('formMark').submit();
                }
            });
        }
        
        function markWithdrawalPaid(url) {
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, mark paid!',
                cancelButtonText: 'No, cancel!'
            }).then(function (result) {
                if (result.value) {
                    this.postDummy(url)
                }
            });
        }
    </script>
@endsection
