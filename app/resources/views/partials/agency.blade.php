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
                    <li class="menu-label mt-0" style="color:#fff" >Main</li>
                    <li>
                        <a style="color:#fff" href="{{route('affiliates.index')}}"> <i data-feather="home" style="color:#fff"  class="align-self-center menu-icon"></i><span>Dashboard</span></a>
                        
                    </li>
                    <li>
                        <a style="color:#fff" href="{{route('affiliates.ref.index')}}"><i data-feather="lock" style="color:#fff"  class="align-self-center menu-icon"></i><span>Referrals</span></a>
                    </li> 
                    <li>
                        <a style="color:#fff" href="{{route('affiliates.downliner')}}"><i data-feather="lock" style="color:#fff"  class="align-self-center menu-icon"></i><span>Downliner</span></a>
                    </li> 
                   
    
                    <hr class="hr-dashed hr-menu">
                    <li class="menu-label my-2" style="color:#fff" >Income and Bonus</li>
    
                   
                    <li>
                        <a style="color:#fff" href="{{route('affiliates.commissions')}}"><i data-feather="layers" style="color:#fff"  class="align-self-center menu-icon"></i><span>Commission</span></a>
                    </li>  
                    <li>
                        <a style="color:#fff" href="{{route('affiliates.payment')}}"><i data-feather="layers" style="color:#fff"  class="align-self-center menu-icon"></i><span>Payment</span></a>
                    </li>  
                    <hr class="hr-dashed hr-menu">
                    <li class="menu-label my-2" style="color:#fff"  >Manage Account</li>   
                    <li>
                        <a style="color:#fff" href="{{route('affiliates.account')}}"><i data-feather="user" style="color:#fff"  class="align-self-center menu-icon"></i><span>Account</span></a>
                    </li>  
                    <li>
                        <a  style="color:#fff" class="dropdown-item" href="{{route('affiliates.logout')}}" onclick="event.preventDefault(); document.getElementById('form1').submit()"><i data-feather="power" style="color:#fff"  class="align-self-center icon-xs icon-dual me-1"></i> Logout</a>
                        <form id="form1" method="post" action="{{route('affiliates.logout')}}">
                        @csrf
                        </form>
                      
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
                     

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-bs-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <span class="ms-1 nav-user-name hidden-sm">@if(auth('agent')) {{strtoupper(auth('agent')->user()->name)}} @endif</span>
                                <i   class="fa fa-users rounded-circle thumb-xs" >  </i>                                
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{route('affiliates.account')}}"><i data-feather="user" class="align-self-center icon-xs icon-dual me-1"></i> Profile</a>
                                <a class="dropdown-item" href="{{route('affiliates.account')}}"><i data-feather="settings" class="align-self-center icon-xs icon-dual me-1"></i> Settings</a>
                                <div class="dropdown-divider mb-0"></div>
                                <a class="dropdown-item" href="{{route('affiliates.logout')}}" onclick="event.preventDefault(); document.getElementById('form1').submit()"><i data-feather="power" class="align-self-center icon-xs icon-dual me-1"></i> Logout</a>
                                <form id="form1" method="post" action="{{route('affiliates.logout')}}">
                                @csrf
                                </form>
                            </div>
                        </li>
                    </ul><!--end topbar-nav-->
        
                    {{-- <ul class="list-unstyled topbar-nav mb-0">                        
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

                        <form method="post" action="{{route('affiliatesProcess.payment')}}">
                            @csrf
                            <button class="btn btn-primary" id="processPay" hidden> Process Payment </button>
                        
                    </form>
                </span>  
                            </div>       
                                            
                        </li>                           
                    </ul> --}}
                </nav>
                <!-- end navbar-->
            </div>
            <!-- Top Bar End -->



