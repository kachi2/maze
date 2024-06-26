  <div class="nk-sidebar" data-content="sidebarMenu">
                    <div class="nk-sidebar-inner" data-simplebar>
                        <ul class="nk-menu nk-menu-md">
                            <li class="nk-menu-heading">
                                <h6 class="overline-title text-primary-alt">Dashboards</h6>
                            </li><!-- .nk-menu-heading -->
                            <li class="nk-menu-item">
                                <a href="{{ route('admin.home') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                    <span class="nk-menu-text">Admin Dashboard</span>
                                </a>
                            </li><!-- .nk-menu-item -->
                             <li class="nk-menu-item">
                                <a href="{{ route('admin.users') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-user"></em></span>
                                    <span class="nk-menu-text">Manage Users</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('admin.deposits') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2"></em></span>
                                    <span class="nk-menu-text">Manage Investments</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('admin.wallet.deposit') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2"></em></span>
                                    <span class="nk-menu-text">Wallet Deposits</span>
                                </a>
                            </li>

                            <li class="nk-menu-item">
                                <a href="{{ route('admin.withdrawals') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2"></em></span>
                                    <span class="nk-menu-text">Manage Withdrawal</span>
                                </a>
                            </li>
                            <!-- .nk-menu-item -->
                            <li class="nk-menu-heading">
                                <h6 class="overline-title text-primary-alt">Investment Packages</h6>
                            </li><!-- .nk-menu-heading -->
                            <li class="nk-menu-item ">
                                <a href="{{ route('admin.packages') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                                    <span class="nk-menu-text">Packages</span>
                                </a><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item ">
                                <a href="{{ route('admin.payment_request') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                                    <span class="nk-menu-text">Direct Deposit</span>
                                </a><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item ">
                                <a href="{{ route('admin.payment_request') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                                    <span class="nk-menu-text"> Reward Center </span>
                                </a><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->

                            {{-- <li class="nk-menu-heading">
                                <h6 class="overline-title text-primary-alt">Send Bonus</h6>
                            </li> --}}
                            <!-- .nk-menu-heading -->
                            {{-- <li class="nk-menu-item ">
                                <a href="{{ route('admin.users.send_users_bonus') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                                    <span class="nk-menu-text">Send Bonus</span>
                                </a><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item --> --}}
                              <li class="nk-menu-heading">
                                <h6 class="overline-title text-primary-alt">Daily Payouts</h6>
                            </li><!-- .nk-menu-heading -->
                            <li class="nk-menu-item ">
                                <a href="{{ route('admin.payouts') }}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                                    <span class="nk-menu-text">Payouts</span>
                                </a><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-heading">
                                <h6 class="overline-title text-primary-alt">Settings</h6>
                            </li><!-- .nk-menu-heading -->
                            <li class="nk-menu-item has-sub">
                                <a href="{{route('admin.message_users')}}" class="nk-menu-link ">
                                    <span class="nk-menu-icon"><em class="icon ni ni-mail"></em></span>
                                    <span class="nk-menu-text">Send Bulk Email</span>
                                </a><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item has-sub">
                                <a href="{{route('admin.wallet.addresses')}}" class="nk-menu-link ">
                                    <span class="nk-menu-icon"><em class="icon ni ni-signin"></em></span>
                                    <span class="nk-menu-text">Wallet Address</span>
                                </a><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item has-sub">
                                <a href="{{ route('admin.setting') }}" class="nk-menu-link ">
                                    <span class="nk-menu-icon"><em class="icon ni ni-files"></em></span>
                                    <span class="nk-menu-text">Account Settings</span>
                                </a><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->
                            <!-- .nk-menu-heading -->
                            {{-- <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
                                    <span class="nk-menu-text">Support</span>
                                </a>
                            </li><!-- .nk-menu-item --> --}}
                          
                        </ul><!-- .nk-menu -->
                    </div>
                </div>