@extends('layouts.admin', ['page_title' => 'Packages'])
@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Investment Plans</h3>
                            <div class="nk-block-des text-soft">
                                <p>Investment Plans.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                       
                                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd"><em class="icon ni ni-plus"></em><span>Add New Plan</span></a></li>
                                    </ul>
                                </div>
                            </div><!-- .toggle-wrap -->
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="row g-gs">
                        @forelse($packages as $package)
                        <div class="col-sm-6 col-lg-4 col-xxl-3">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="project">
                                        <div class="project-head">
                                            <a href="html/apps-kanban.html" class="project-title">
                                                <div class="user-avatar sq bg-purple"><span>{{strtoupper(substr($package->name,0,2))}}</span></div>
                                                <div class="project-info">
                                                    <h6 class="title">{{$package->plans[0]->name}}</h6>
                                                    <span class="sub-text">{{$package->plans[0]->profit.'%'}} {{$package->formatted_payment_period}} for {{$package->formatted_duration}}</span>
                                                </div>
                                            </a>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger mt-n1 mr-n1" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#" class="" data-toggle="modal" data-target="#modalForm{{$package->id}}"><em class="icon ni ni-edit"></em><span>Edit Plan</span></a></li>
                                                       
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="project-details">
                                            <p></p>
                                        </div>
                                        <div class="project-progress">
                                            <div class="project-progress-details">
                                                <div class="project-progress-task"><em class="icon ni ni-check-round-cut"></em><span> Max Deposit</span></div>
                                                <div class="project-progress-percent">{{moneyFormat($package->plans[0]->min_deposit,'USD')}}</div>
                                            </div>
                                            <div class="project-progress-details">
                                                <div class="project-progress-task"><em class="icon ni ni-check-round-cut"></em><span> Min Deposit</span></div>
                                                <div class="project-progress-percent">{{moneyFormat($package->plans[0]->max_deposit,'USD')}}</div>
                                            </div>
                                            <div class="project-progress-details">
                                                <div class="project-progress-task"><em class="icon ni ni-check-round-cut"></em><span> {{$package->formatted_payment_period}}  Payouts</span></div>
                                                <div class="project-progress-percent">{{$package->plans[0]->profit_rate,'USD'}}%</div>
                                            </div>
                                        
                                            <div class="project-progress-details">
                                                <div class="project-progress-task"><em class="icon ni ni-check-round-cut"></em><span> Profit Rate</span></div>
                                                <div class="project-progress-percent">{{$package->plans[0]->profit,'USD'}}%</div>
                                                
                                            </div>
                                        </div>
                                        <div class="project-meta">
                                            <span class="badge badge-dim badge-warning"><em class="icon ni ni-clock"></em><span>{{$package->plans[0]->updated_at}}</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @include('admin.misc.edit-package')
                        
                        @empty

                        @endforelse
                     
                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>

@include('admin.misc.add_plan')
@endsection
@section('scripts')

    <script>
let message = {!! json_encode(Session::get('message')) !!};
let msg = {!! json_encode(Session::get('alert')) !!};

if(message != null){
toastr.clear();
    NioApp.Toast(message , msg, {
      position: 'top-right',
        timeOut: 5000,
    });
}
    </script>
@endsection
