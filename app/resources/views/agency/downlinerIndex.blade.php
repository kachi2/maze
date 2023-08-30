@extends('layouts.agency')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Analytics</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Downliner</li>
                            </ol>
                        </div><!--end col-->
                        <div class="col-auto align-self-center">
                            <a href="#" class="btn btn-sm btn-outline-primary" id="Dash_Date">
                                <span class="ay-name" id="Day_Name">Today:</span>&nbsp;
                                <span class="" id="Select_date">Jan 11</span>
                                <i data-feather="calendar" class="align-self-center icon-xs ms-1"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-outline-primary">
                                <i data-feather="download" class="align-self-center icon-xs"></i>
                            </a>
                        </div><!--end col-->  
                    </div><!--end row-->                                                              
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-lg-9">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="card report-card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col">
                                        <p class="text-dark mb-0 fw-semibold">Total Referrals</p>
                                        <h3 class="m-0">{{count($direct_ref) + count($indirect_ref) + count($sponsor_two)}}</h3>
                                        <p class="mb-0 text-truncate text-muted">
                                            <span class="text-success"> people referred this week</p>
                                    </div>
                                </div>
                            </div><!--end card-body--> 
                        </div><!--end card--> 
                    </div> <!--end col--> 
                    <div class="col-md-6 col-lg-4">
                        <div class="card report-card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">                                                
                                    <div class="col">
                                        <p class="text-dark mb-0 fw-semibold">Direct Referals</p>

                                        <h3 class="m-0">{{count($direct_ref)}}</h3>
                                        <p class="mb-0 text-truncate text-muted"><span class="text-success"> Direct Referals</p>
                                    </div>
                                </div>
                            </div><!--end card-body--> 
                        </div><!--end card--> 
                    </div> <!--end col--> 
                    <div class="col-md-6 col-lg-4">
                        <div class="card report-card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">                                                
                                    <div class="col">
                                        <p class="text-dark mb-0 fw-semibold">Indirect Referalss</p>
                                        <h3 class="m-0">{{count($indirect_ref) + count($sponsor_two) }}</h3>
                                        <p class="mb-0 text-truncate text-muted"><span class="text-success"> Indirect Referals</p>
                                  </div>
                                </div>
                            </div><!--end card-body--> 
                        </div><!--end card--> 
                    </div> <!--end col--> 
                                               
                </div><!--end row-->
            </div><!--end col-->
            <div class="col-lg-3">
                <div class="card overflow-hidden"> 
                    <div class="card-body">                                    
                        <div class="row">
                            <div class="col">
                                <div class="media">
                                    <img src="assets/images/money-beg.png" alt="" class="align-self-center" height="40">
                                    <div class="media-body align-self-center ms-3"> 
                                        <h6 class="m-0 font-20 badge bg-info p-1" >{{moneyFormat(agent_user()->wallets->payments, 'USD')}}</h6>
                                        <p class="text-muted mb-0">Available Balance</p>   
                                        <h6 class="m-0 font-20 badge bg-success p-1" >{{moneyFormat(agent_user()->wallets->salary_paid, 'USD')}}</h6>   
                                        <p class="text-muted mb-0">Total Amount Paid</p>                                                                                                                                           
                                    </div><!--end media body-->
                                </div><!--end media-->
                            </div><!--end col-->  
                                                                 
                        </div><!--end row-->
                    </div><!--end card-body-->
                   
                </div> <!--end card-->  
     
            </div><!-- end col-->    
        </div><!--end row-->

        <div class="row">
            <div class="col-12">                            
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Direct Referrals</h4>
                        <p class="text-muted mb-0">Direct Referals using your referral link</p>
                        <p class="text-muted mb-0">You get 0.40% on registration bonus and 0.20% on trade bonus</p>
                    </div><!--end card-header-->
                    <div class="card-body">        
                        <div class="row text-center">
                            @forelse($direct_ref as $direct)
                            <div class="col-sm-3"><span class="border py-2 d-block mb-2 mb-lg-0"><i class="fa fa-user"> </i> {{$direct->username}} <br> Date Joined: {{$direct->created_at->format('d/m/yy')}} 
                            <br><span class="badge bg-info"> @if($direct->deposits) Traded </span> @else <span class="badge bg-secondary"> Not Traded </span> @endif </span></div>
                            @empty 

                            <div class="col-sm-3"><span class="border py-2 d-block mb-2 mb-lg-0">No record Found </span></div>
                          
                             @endforelse  
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!-- end col -->   
            <div class="col-12">                            
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">In-direct Referrals</h4>
                        <h4 class="card-title">Level Two Referals</h4>
                        <p class="text-muted mb-0">Referals from top direct referrals</p>
                        <p class="text-muted mb-0">You get 0.20% on registration bonus and 0.10% on trade bonus</p>
                    </div><!--end card-header-->
                    <div class="card-body">        
                        <div class="row text-center">
                            @forelse ($indirect_ref as $indirect)
                            <div class="col-sm-3"><span class="border py-2 d-block mb-2 mb-lg-0"><i class="fa fa-user"> </i> {{$indirect->username}} <br> Date Joined: {{$indirect->created_at->format('d/m/yy')}} 
                            <br><span class="badge bg-info"> @if($indirect->deposits) Traded </span> @else <span class="badge bg-secondary"> Not Traded </span> @endif </span></div>
                            @empty 

                           <div class="col-sm-3"><span class="border py-2 d-block mb-2 mb-lg-0">No record Found </span></div>
                         
                            @endforelse                                                                                        
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!-- end col -->  


            <div class="col-12">                            
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">In-direct Referrals</h4>
                        <h4 class="card-title">Level Three Referals</h4>
                        <p class="text-muted mb-0">Referals from level two referrals</p>
                        <p class="text-muted mb-0">You get 0.20% on registration bonus and 0.10% on trade bonus</p>
                    </div><!--end card-header-->
                    <div class="card-body">        
                        <div class="row text-center">
                            @forelse($sponsor_two as $indirects)
                            <div class="col-sm-3"><span class="border py-2 d-block mb-2 mb-lg-0"><i class="fa fa-user"> </i> {{$indirects->username}} <br> Date Joined: {{$indirects->created_at->format('d/m/yy')}} 
                            <br><span class="badge bg-info"> @if($indirects->deposits) Traded </span> @else <span class="badge bg-secondary"> Not Traded </span> @endif </span></div>
                           @empty 

                           <div class="col-sm-3"><span class="border py-2 d-block mb-2 mb-lg-0">No record Found </span></div>
                         
                            @endforelse                                                                                      
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div> <!-- end col -->  
                
        </div>
    </div><!-- container -->
    
@endsection