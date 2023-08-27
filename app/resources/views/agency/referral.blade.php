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
                                <li class="breadcrumb-item active">Summary of Referrals</li>
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
                                        <h3 class="m-0">{{$refs->total_referrals}}</h3>
                                        <p class="mb-0 text-truncate text-muted">
                                            <span class="text-success">{{count($refer_weekly)}} people referred this week</p>
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
                                        <p class="text-dark mb-0 fw-semibold">Traded Referrals</p>

                                        <h3 class="m-0">{{$refs->traded_referrals}}</h3>
                                        <p class="mb-0 text-truncate text-muted"><span class="text-success">Number of Referrals that have invested</p>
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
                                        <p class="text-dark mb-0 fw-semibold">Referral Link</p>
                                        {{-- <h3 class="m-0"><a href="{{route('affiliates.referral').'/ref?='.$agent->ref_code}}"> Referral Link </a></h3> --}}
                                        <input  class="form-control" aria-describedby="button-addon2" value="{{route('affiliates.referral').'/ref?='.agent_user()->ref_code}}" id="clipboardInput" readonly> 
                                        {{-- <p class="mb-0 text-truncate text-muted">  </p> --}}
                                        <button class="btn btn-sm btn-outline-success" 
                                        type="button" id="button-addon2" data-clipboard-action="copy"
                                         data-clipboard-target="#clipboardInput"> <small> <i class="far fa-copy me-2"></i>Copy</small></button>
                                         
                                    </div>
                                </div>
                            </div><!--end card-body--> 
                        </div><!--end card--> 
                    </div> <!--end col--> 
                                               
                </div><!--end row-->
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">                      
                                <h4 class="card-title">Earnings Reports</h4>                      
                            </div><!--end col-->                                        
                        </div>  <!--end row-->                                  
                    </div><!--end card-header-->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-top-0">User</th>    
                                        <th class="border-top-0">Date Registered</th>
                                        <th class="border-top-0">Traded</th>
                                        <th class="border-top-0">Status</th>
                                    </tr><!--end tr-->
                                </thead>
                                <tbody>
                             
                                    @forelse ($referrals  as $refs )
                                    <tr>                                                                                                        
                                        <td>{{$refs->user->username}}</td>
                                        <td>{{ $refs->user->created_at->format('d/m/y h:m:i')}}</td>   
                                        <td>@if($refs->user->deposits) 
                                            <span class='badge bg-info'> Traded </span> 
                                             @else<span class='badge bg-warning'> Not Traded </span> @endif </td>
                                             <td>@if($refs->user->status == 0) 
                                                <span class='badge bg-success'> Active </span> 
                                                 @else<span class='badge bg-danger'> Not Active</span> @endif </td>
                                    </tr>    
                                    @empty 
                                    <tr> 
                                    <td>No Record found</td>
                                </tr>
                                    @endforelse
                                               
                                </tbody>
                            </table> <!--end table-->                                               
                        </div><!--end /div-->
                    </div><!--end card-body--> 
                </div><!--end card--> 
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
    </div><!-- container -->
    
@endsection