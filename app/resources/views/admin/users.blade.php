@extends('layouts.admin', ['page_title' => 'Users'])
@section('content')

       <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Users Lists</h3>
                                            <div class="nk-block-des text-soft">
                                                <p>You have total {{count($userss)}} users.</p>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li class="nk-block-tools-opt">
                                                            <div class="drodown">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a href="#"><span>Add User</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!-- .toggle-wrap -->
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="card card-bordered card-stretch">
                                        <div class="card-inner-group">
                                            <div class="card-inner position-relative card-tools-toggle">
                                                <div class="card-title-group">
                                                    <div class="card-tools">
                                                        <div class="form-inline flex-nowrap gx-3">
                                                            <div class="form-wrap w-150px">
                                                                <select class="form-select form-select-sm" data-search="off" data-placeholder="Bulk Action">
                                                                    <option value="">Bulk Action</option>
                                                                </select>
                                                            </div>
                                                        </div><!-- .form-inline -->
                                                    </div><!-- .card-tools -->
                                                    <div class="card-tools mr-n1">
                                                        <ul class="btn-toolbar gx-1">
                                                            <li>
                                                                <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                                            </li><!-- li -->
                                                            <li class="btn-toolbar-sep"></li><!-- li -->
                                                            <li>
                                                               
                                                            </li><!-- li -->
                                                        </ul><!-- .btn-toolbar -->
                                                    </div><!-- .card-tools -->
                                                </div><!-- .card-title-group -->
                                                    <form method="get">
                                                <div class="card-search search-wrap" data-search="search">
                                                    <div class="card-body">
                                                        <div class="search-content">
                                                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                            <input type="text" value="{{ request()->input('search') }}" name="search" class="form-control border-transparent form-focus-none" placeholder="Search by user or email">
                                                            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                                        </div>
                                                    </div>
                                                </div><!-- .card-search -->
                                                 </form>
                                            </div><!-- .card-inner -->
                                            <div class="card-inner p-0">
                                                <div class="nk-tb-list nk-tb-ulist">
                                                    <div class="nk-tb-item nk-tb-head">
                                                        
                                                        <div class="nk-tb-col"><span class="sub-text">User</span></div>
                                                        <div class="nk-tb-col tb-col-mb"><span class="sub-text">Reg.Date</span></div>
                                                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Balance</span></div>
                                                        <div class="nk-tb-col tb-col-lg"><span class="sub-text">Deposits</span></div>
                                                        <div class="nk-tb-col tb-col-lg"><span class="sub-text">Withdrawals</span></div>
                                                         <div class="nk-tb-col tb-col-lg"><span class="sub-text">Payouts</span></div>
                                                         <div class="nk-tb-col tb-col-lg"><span class="sub-text">Active Deposits</span></div>
                                                        
                                                        <div class="nk-tb-col nk-tb-col-tools text-right">
                                                            <span class="sub-text">+</span>
                                                        </div>
                                                    </div><!-- .nk-tb-item -->
                                                     @forelse($users as $user)
                                                    <div class="nk-tb-item">
                                                       
                                                        <div class="nk-tb-col">
                                                            <div class="user-card">
                                                                <div class="user-avatar">
                                                                    {{substr($user->username,0,2) }}
                                                                </div>
                                                                <div class="user-info">
                                                                    <span class="tb-lead">{{ $user->username }} <span class="dot dot-warning d-md-none ml-1"></span></span>
                                                                    <span>{{ $user->email }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-mb">
                                                            <span class="tb-amount">{{ $user->created_at }} </span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>{{ moneyFormat($user->wallet->total_amount, 'USD') }}</span>
                                                        </div>
                                                         <div class="nk-tb-col tb-col-md">
                                                            <span>{{ moneyFormat($user->deposits()->sum('amount'), 'USD') }}</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>{{ moneyFormat($user->withdrawals()->sum('amount'), 'USD') }}</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>{{ moneyFormat($user->payouts()->sum('amount'), 'USD') }}</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>{{ moneyFormat($user->deposits()->where('status', \App\Models\Deposit::STATUS_ACTIVE)->sum('amount'), 'USD') }}</span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools">
                                                            <ul class="nk-tb-actions gx-1">
                                                                <li>
                                                                    <div class="drodown">
                                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <ul class="link-list-opt no-bdr">
                                                                                <li><a href="{{ route('admin.users.show', ['id' => $user->id]) }}"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                <li><a href="{{ route('admin.users.activity',  $user->id) }}"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .nk-tb-item -->
                                                     @empty

                                                     @endforelse
                                                </div><!-- .nk-tb-list -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner">
                                                <div class="nk-block-between-md g-3">
                                                    {{$users->links()}}
                                                </div><!-- .nk-block-between -->
                                            </div><!-- .card-inner -->
                                        </div><!-- .card-inner-group -->
                                    </div><!-- .card -->
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@push('scripts')
    <script>
        function deleteUser(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You wont be able to reveres this',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if(result.value) {
                    postDummy(url)
                }
            })
        }
    </script>
@endpush
