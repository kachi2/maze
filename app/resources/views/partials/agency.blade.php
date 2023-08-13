    <body>
        <!-- Left Sidenav -->
        <div class="left-sidenav">
            <!-- LOGO -->
            <div class="brand">
                <a href="{{route('affiliates.index')}}" class="logo">
                    <span>
                        <img src="{{asset('/logo.png')}}" alt="logo-small" class="logo-sm">
                    </span>
                    {{-- <span>
                        <img src="{{asset('/logo.png')}}" alt="logo-large" class="logo-lg logo-light">
                        <img src="{{asset('/logo.png')}}" alt="logo-large" class="logo-lg logo-dark">
                    </span> --}}
                </a>
            </div>
            <!--end logo-->
            <div class="menu-content h-100" data-simplebar style="background:#0c213a">
                <ul class="metismenu left-sidenav-menu">
                    <li class="menu-label mt-0">Main</li>
                    <li>
                        <a href="{{route('agency.index')}}"> <i data-feather="home" class="align-self-center menu-icon"></i><span>Dashboard</span></a>
                        
                    </li>
                    <li>
                        <a href="{{route('agent.referral')}}"><i data-feather="lock" class="align-self-center menu-icon"></i><span>My Referrals</span></a>
                    </li> 
                    <li>
                        <a href="{{route('agency.task')}}"><i data-feather="lock" class="align-self-center menu-icon"></i><span>My Task</span></a>
                    </li>
    
                    <hr class="hr-dashed hr-menu">
                    <li class="menu-label my-2">Income and Bonus</li>
    
                   
    
                    <li>
                        <a href="{{route('agency.payment')}}"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Payments</span></a>
                    </li>     
                    <li>
                        <a href="{{route('agency.salary')}}"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Salary</span></a>
                    </li> 
                    <hr class="hr-dashed hr-menu">
                    <li class="menu-label my-2">Manage Account</li>   
                    <li>
                        <a href="widgets.html"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Account</span></a>
                    </li>   
                    <li>
                        <a href="{{route('agency.register')}}"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Add Agent</span></a>
                    </li>   
                    <li>
                        <a href="widgets.html"><i data-feather="layers" class="align-self-center menu-icon"></i><span>Logout</span><span class="badge badge-soft-success menu-arrow">New</span></a>
                    </li>       
                </ul>
            </div>
        </div>
        <!-- end left-sidenav-->
        

        <div class="page-wrapper">
            <!-- Top Bar Start -->
            <div class="topbar">            
                <!-- Navbar -->
                <nav class="navbar-custom">    
                    <ul class="list-unstyled topbar-nav float-end mb-0">  
                         <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-bs-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <i data-feather="bell" class="align-self-center topbar-icon"></i>
                                <span class="badge bg-danger rounded-pill noti-icon-badge">2</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-lg pt-0">
                            
                                <h6 class="dropdown-item-text font-15 m-0 py-3 border-bottom d-flex justify-content-between align-items-center">
                                    Notifications <span class="badge bg-primary rounded-pill">2</span>
                                </h6> 
                                <div class="notification-menu" data-simplebar>
                                    <!-- item-->
                                    <a href="#" class="dropdown-item py-3">
                                        <small class="float-end text-muted ps-2">2 min ago</small>
                                        <div class="media">
                                            <div class="avatar-md bg-soft-primary">
                                                <i data-feather="shopping-cart" class="align-self-center icon-xs"></i>
                                            </div>
                                            <div class="media-body align-self-center ms-2 text-truncate">
                                                <h6 class="my-0 fw-normal text-dark">Your order is placed</h6>
                                                <small class="text-muted mb-0">Dummy text of the printing and industry.</small>
                                            </div><!--end media-body-->
                                        </div><!--end media-->
                                    </a><!--end-item-->
                                </div>
                            </div>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-bs-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <span class="ms-1 nav-user-name hidden-sm">@if(auth('agent')) {{auth('agent')->user()->name}} @endif</span>
                                <img src="assets/images/users/user-5.jpg" alt="profile-user" class="rounded-circle thumb-xs" />                                 
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i data-feather="user" class="align-self-center icon-xs icon-dual me-1"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i data-feather="settings" class="align-self-center icon-xs icon-dual me-1"></i> Settings</a>
                                <div class="dropdown-divider mb-0"></div>
                                <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('form1').submit()"><i data-feather="power" class="align-self-center icon-xs icon-dual me-1"></i> Logout</a>
                                <form id="form1" method="post" action="{{route('logout')}}">
                                @csrf
                                </form>
                            </div>
                        </li>
                    </ul><!--end topbar-nav-->
        
                    <ul class="list-unstyled topbar-nav mb-0">                        
                        <li>
                            <button class="nav-link button-menu-mobile">
                                <i data-feather="menu" class="align-self-center topbar-icon"></i>
                            </button>
                        </li> 
                        <li class="creat-btn">
                            <div class="nav-link">
                     <span id="info">      Click on Process payment once the countdown completes. Your Next payment </span>   <span id="countdowns"> </span> 
                     &nbsp;   &nbsp;   &nbsp;
                     <span style="float:right"> 

                        <form method="post" action="{{route('agentProcess.payment')}}">
                            @csrf
                            <button class="btn btn-primary" id="processPay" hidden> Process Payment </button>
                        
                    </form>
                </span>  
                            </div>       
                                            
                        </li>                           
                    </ul>
                </nav>
                <!-- end navbar-->
            </div>
            <!-- Top Bar End -->



