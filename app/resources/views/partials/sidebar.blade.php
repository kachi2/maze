  <div class="nk-sidebar" data-content="sidebarMenu">
                    <div class="nk-sidebar-inner" data-simplebar>
                        <ul class="nk-menu nk-menu-md">
                            <li class="nk-menu-heading">
                                <h6 class="overline-title text-primary-alt">Dashboards</h6>
                            </li><!-- .nk-menu-heading -->
                            <li class="nk-menu-item">
                                <a href="{{ route('home') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                    <span class="nk-menu-text">Dashboard</span>
                                </a>
                            </li><!-- .nk-menu-item -->
                             <li class="nk-menu-item">
                                <a href="{{ route('account') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-user"></em></span>
                                    <span class="nk-menu-text">Manage Account</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('deposits') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2"></em></span>
                                    <span class="nk-menu-text">Manage Deposits</span>
                                </a>
                            </li>

                            <li class="nk-menu-item">
                                <a href="{{ route('withdrawals') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2"></em></span>
                                    <span class="nk-menu-text">Manage Withdrawal</span>
                                </a>
                            </li>
                            <!-- .nk-menu-item -->
                            <li class="nk-menu-heading">
                                <h6 class="overline-title text-primary-alt">Investment Packages</h6>
                            </li><!-- .nk-menu-heading -->
                            <li class="nk-menu-item ">
                                <a href="{{ route('user.packages') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                                    <span class="nk-menu-text">Packages</span>
                                </a><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->

                            <li class="nk-menu-heading">
                                <h6 class="overline-title text-primary-alt">Investment Returns</h6>
                            </li><!-- .nk-menu-heading -->
                            <li class="nk-menu-item ">
                                <a href="{{ route('payouts') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                                    <span class="nk-menu-text">View Payouts</span>
                                </a><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->

                            <li class="nk-menu-heading">
                                <h6 class="overline-title text-primary-alt">Fund Transfer</h6>
                            </li><!-- .nk-menu-heading -->
                            <li class="nk-menu-item ">
                                <a href="{{ route('transfer') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                                    <span class="nk-menu-text">Transfer Funds</span>
                                </a><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->
                              <li class="nk-menu-heading">
                                <h6 class="overline-title text-primary-alt">My Referrals</h6>
                            </li><!-- .nk-menu-heading -->
                            <li class="nk-menu-item ">
                                <a href="{{ route('referral') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                                    <span class="nk-menu-text">View Referrals</span>
                                </a><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-heading">
                                <h6 class="overline-title text-primary-alt">Settings</h6>
                            </li><!-- .nk-menu-heading -->
                            {{-- <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link ">
                                    <span class="nk-menu-icon"><em class="icon ni ni-signin"></em></span>
                                    <span class="nk-menu-text">Manage KYC</span>
                                </a><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item --> --}}
                            <li class="nk-menu-item has-sub">
                                <a href="{{ route('account') }}" class="nk-menu-link ">
                                    <span class="nk-menu-icon"><em class="icon ni ni-files"></em></span>
                                    <span class="nk-menu-text">Account Settings</span>
                                </a><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->
                            <!-- .nk-menu-heading -->
                            <li class="nk-menu-item">
                                <a href="mailto:support@zenithcapital.cc" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
                                    <span class="nk-menu-text">Support</span>
                                </a>
                            </li><!-- .nk-menu-item -->
                            @if(auth_user()->is_admin)
                             <li class="nk-menu-item">
                                <a href="{{ route('admin.home') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-repeat"></em></span>
                                    <span class="nk-menu-text">Switch to Admin</span>
                                </a>
                            </li><!-- .nk-menu-item -->
                            @endif
                        </ul><!-- .nk-menu -->
                    </div>
                </div>