<div class="nk-sidebar" data-content="sidebarMenu">
    <div class="nk-sidebar-inner" data-simplebar>
        <ul class="nk-menu nk-menu-md">
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">Dashboards</h6>
            </li><!-- .nk-menu-heading -->
            <li class="nk-menu-item">
                <a href="{{ route('web.home') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                    <span class="nk-menu-text">Dashboard</span>
                </a>
            </li><!-- .nk-menu-item -->
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">Wallet Balances</h6>
            </li><!-- .nk-menu-heading -->
            <li class="nk-menu-item ">
                <a href="{{route('web.wallets.deposit.index')}}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                    <span class="nk-menu-text">Manage Wallets</span>
                </a><!-- .nk-menu-sub -->
            </li><!-- .nk-menu-item -->
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">Investments</h6>
            </li><!-- .nk-menu-heading -->
            <li class="nk-menu-item">
                <a href="{{ route('web.deposits') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2"></em></span>
                    <span class="nk-menu-text">Manage Investments</span>
                </a>
            </li>

            <li class="nk-menu-item">
                <a href="{{ route('web.withdrawals') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2"></em></span>
                    <span class="nk-menu-text">Manage Withdrawal</span>
                </a>
            </li>
            <!-- .nk-menu-item -->
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">Packages</h6>
            </li><!-- .nk-menu-heading -->
            <li class="nk-menu-item ">
                <a href="{{ route('web.user.packages') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                    <span class="nk-menu-text">Investments Plans</span>
                </a><!-- .nk-menu-sub -->
            </li><!-- .nk-menu-item -->

           

            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">Fund Transfer</h6>
            </li><!-- .nk-menu-heading -->
            <li class="nk-menu-item ">
                <a href="{{ route('web.transfer') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                    <span class="nk-menu-text">Transfer Funds</span>
                </a><!-- .nk-menu-sub -->
            </li><!-- .nk-menu-item -->
              <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">My Referrals</h6>
            </li><!-- .nk-menu-heading -->
            <li class="nk-menu-item ">
                <a href="{{ route('web.referral') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                    <span class="nk-menu-text">Manage Referrals</span>
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
                <a href="{{ route('web.account') }}" class="nk-menu-link ">
                    <span class="nk-menu-icon"><em class="icon ni ni-files"></em></span>
                    <span class="nk-menu-text">Account Settings</span>
                </a><!-- .nk-menu-sub -->
            </li><!-- .nk-menu-item -->
            <!-- .nk-menu-heading -->
            <li class="nk-menu-item">
                <a target="_blank" href="mailto:support@Mazeoptions.com" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
                    <span class="nk-menu-text">Support</span>
                </a>
            </li><!-- .nk-menu-item -->
         
        </ul><!-- .nk-menu -->
    </div>
</div>