<body class="nk-body npc-default has-apps-sidebar has-sidebar ">
    <div class="nk-app-root">
        <div class="nk-apps-sidebar is-dark">
            <div class="nk-apps-brand">
                <a href="{{route('home')}}" class="logo-link">
                    <img class="logo-light logo-img" src="{{asset('/logo2.png')}}" srcset="{{asset('/logo2.png')}} 2x" alt="logo">
                    <img class="logo-dark logo-img" src="{{asset('/logo2.png')}}" srcset="{{asset('/logo2.png')}} 2x" alt="logo-dark">
                </a>
            </div>
            <div class="nk-sidebar-element">
                <div class="nk-sidebar-body">
                    <div class="nk-sidebar-content" data-simplebar>
                        <div class="nk-sidebar-menu">
                            <!-- Menu -->
                            <ul class="nk-menu apps-menu">
                                <li class="nk-menu-item">
                                    <a href="{{ route('home') }}" class="nk-menu-link" title="Dashboard">
                                        <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                    </a>
                                </li>
                                <li class="nk-menu-hr"></li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('account') }}" class="nk-menu-link" title="Manage Account">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user"></em></span>
                                    </a>
                                </li>
                               
                                <li class="nk-menu-item">
                                    <a href="{{ route('deposits') }}" class="nk-menu-link" title="View Deposits">
                                        <span class="nk-menu-icon"><em class="icon ni ni-invest"></em></span>
                                    </a>
                                </li>
                                <li class="nk-menu-hr"></li>
                               
                                
                                <li class="nk-menu-item">
                                    <a href="{{ route('transfer') }}" class="nk-menu-link" title="Transfer Funds">
                                        <span class="nk-menu-icon"><em class="icon ni ni-repeat"></em></span>
                                        
                                    </a>
                                </li>
                               
                                <li class="nk-menu-hr"></li>
                                <li class="nk-menu-item">
                                    <a href="{{ route('user.packages') }}" class="nk-menu-link" title="Packages">
                                        <span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                     
                    </div>
                    <div class="nk-sidebar-profile nk-sidebar-profile-fixed dropdown">
                        <a href="#" data-toggle="dropdown" data-offset="50,-60">
                            <div class="user-avatar">
                               <span>{{substr(strtoupper(auth()->user()->username),0,2)}}</span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md ml-4">
                            <div class="dropdown-inner user-card-wrap d-none d-md-block">
                                <div class="user-card">
                                     <div class="user-avatar">
                                    <span>{{substr(strtoupper(auth()->user()->username),0,2)}}</span>
                                </div>
                                <div class="user-info">
                                    <span class="lead-text">{{strtoupper(auth()->user()->username)}}</span>
                                    <span class="sub-text">{{auth()->user()->email}}</span>
                                </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                  <li><a href="{{ route('account') }}"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                    <li><a href="{{ route('account.activities') }}"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                    
                                                     <li>
                                                         @if(auth()->user()->email_verified_at == null)
                                                        <div class="user-status user-status-unverified"> <span style="color:#526484" >  Account Status:</span> Unverified </div> 
                                                        
                                                        <form method="POST" action="{{route('verification.resend')}}" class="authentication-form" id="verify">
                                               @csrf
                                           <em> <button type="submit" class="icon ni ni-external btn btn-primay">Resend Verification link</button></em>
                                            </form>
                                                     @else 
                                                        <div class="user-status user-status-verified"> <span style="color:#526484"  >  Account Status:</span> Verified </div>
                                                     @endif</li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                  <ul class="link-list">
                                                    <li> <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout4').submit();" class="nk-menu-link dropdown-indicator has-indicator" data-toggle="dropdown" data-offset="0,10">
                                                <span class="nk-menu-icon"><em class="icon ni ni-signout"></em></span>
                                                <span class="nk-menu-text">Sign Out</span>
                                                
                                            </a></li>
                                                </ul>
                                                  <form id="frm-logout4" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }}
                                                </form> 
                                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ml-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-app-name">
                                <div class="nk-header-app-logo">
                            
                                          <img class="logo-dark logo-img" src="{{asset('/logo2.png')}}" srcset="{{asset('/logo2.png')}} 2x" alt="logo-dark">
                                </div>
                                <div class="nk-header-app-info">
                                    <span class="sub-text">Think Richly</span>
                                    <span class="lead-text">Zenith Capital</span>
                                </div>
                            </div>
                            <div class="nk-header-menu is-light">
                                <div class="nk-header-menu-inner">
                                    <!-- Menu -->
                                    <ul class="nk-menu nk-menu-main">
                                        <li class="nk-menu-item">
                                            <a href="{{ route('deposits') }}" class="nk-menu-link">
                                                <span class="nk-menu-text btn-primary btn-sm">Deposit</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ route('withdrawals') }}" class="nk-menu-link">
                                                <span class="nk-menu-text btn-warning btn btn-sm">Withdraw</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link">
                                                <span class="nk-menu-text btn-outline-info btn btn-sm"> Wallet Balance: {{moneyFormat(auth()->user()->wallet->amount, 'USD')}}</span>
                                            </a>
                                        </li>

                                   <!-- .nk-menu-item -->
                                    </ul>
                                    <!-- Menu -->
                                </div>
                            </div>
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    
                                     <li class="dropdown notification-dropdown mr-n1">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                            <div class="icon-status icon-status-danger"><em class="icon ni ni-bell"></em></div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-head">
                                                <span class="sub-title nk-dropdown-title">Notifications</span>
                                            </div>
                                            <div class="dropdown-body">
                                                <div class="nk-notification">

                                                @forelse($notification as $notify)
                                                
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">{{$notify->message}}</span></div>
                                                            <div class="nk-notification-time">{{$notify->created_at->DiffForHumans()}}</div>
                                                        </div>
                                                    </div><!-- .dropdown-inner -->
                                                    @empty
                                                     <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">No notification yet</span></div>
                                                      
                                                        </div>
                                                    </div>

                                                    @endforelse

                                                 
                                                </div>
                                            </div><!-- .nk-dropdown-body -->
                                           @if(count($notification) > 0)
                                            <div class="dropdown-foot center">
                                                <a href="{{route('create.notifications')}}">Clear All</a>
                                            </div>
                                            @endif
                                        </div>
                                    </li>
                                
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle mr-n1" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                 <div class="user-info  d-md-block">
                                                    @if(auth()->user()->email_verified_at == null)<div class="user-status user-status-unverified"> Unverified</div>
                                                     @else 
                                                        <div class="user-status user-status-verified"> Verified </div>
                                                     @endif
                                                    <div class="user-name dropdown-indicator"> {{strtoupper(auth()->user()->username)}}</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                       <span>{{substr(strtoupper(auth()->user()->username),0,2)}}</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">{{strtoupper(auth()->user()->username)}}</span>
                                                        <span class="sub-text">{{auth()->user()->email}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                  <li><a href="{{ route('account') }}"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                    <li><a href="{{ route('account.activities') }}"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                    
                                                     <li>
                                                         @if(auth()->user()->email_verified_at == null)
                                                        <div class="user-status user-status-unverified"> <span style="color:#526484" >  Account Status:</span> Unverified </div> 
                                                        
                                                        <form method="POST" action="{{route('verification.resend')}}" class="authentication-form" id="verify">
                                               @csrf
                                           <em> <button type="submit" class="icon ni ni-external btn btn-primay">Resend Verification link</button></em>
                                            </form>
                                                     @else 
                                                        <div class="user-status user-status-verified"> <span style="color:#526484"  >  Account Status:</span> Verified </div>
                                                     @endif</li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                  <ul class="link-list">
                                                    <li> <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout4').submit();" class="nk-menu-link dropdown-indicator has-indicator" data-toggle="dropdown" data-offset="0,10">
                                                <span class="nk-menu-icon"><em class="icon ni ni-signout"></em></span>
                                                <span class="nk-menu-text">Sign Out</span>
                                                
                                            </a></li>
                                                </ul>
                                                  <form id="frm-logout4" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }}
                                                </form> 
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>