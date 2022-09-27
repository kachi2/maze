@extends('layouts.admin', ['page_title' => 'Payouts'])
@section('content')

    <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="components-preview wide-md mx-auto">
                                 <div class="nk-block-head">
                                <div class="nk-block-between-md g-4">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title fw-normal">Payouts</h5>
                                        
                                    </div>
                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools gx-3">
                                           
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
                                                    <th class="nk-tb-col "><span class="sub-text">Plan</th>
                                                    <th class="nk-tb-col "><span class="sub-text">Deposit</th>
                                                    <th class="nk-tb-col "><span class="sub-text">Amount</th>
                                                    <th class="nk-tb-col "><span class="sub-text">Profit</th>
                                                    <th class="nk-tb-col "><span class="sub-text">Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                       @forelse($payouts as $payout)
                                        <tr>
                                            <td class="nk-tb-col ">{{ $payout->id }}</td>
                                            <td class="nk-tb-col ">{{ $payout->ref }}</td>
                                             <td class="nk-tb-col ">
                                                <a href="{{ route('admin.users.show', ['id' => $payout->user->id]) }}">
                                                    {{ $payout->user->username }}
                                                </a>
                                            </td>
                                             <td class="nk-tb-col ">{{ $payout->plan->formatted_name }}</td>
                                            <td class="nk-tb-col "><a href="{{ $payout->deposit->url }}">{{ $payout->deposit->ref }}</a></td>
                                            <td class="nk-tb-col ">{{ moneyFormat($payout->amount, 'USD') }}</td>
                                            <td class="nk-tb-col ">{{ moneyFormat($payout->profit, 'USD') }}</td>
                                             <td class="nk-tb-col ">{{ $payout->created_at }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td><span>No Payouts Yet</span>
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
 
          function markDepositExpired(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve!',
                cancelButtonText: 'No, cancel!'
            }).then(function (result) {
                if (result.value) {
                  document.getElementById('formMark').submit();
                }
            });
        }
    </script>
@endsection
