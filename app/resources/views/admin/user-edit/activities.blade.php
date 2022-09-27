
@extends('layouts.admin')
@section('content')              
            <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="nk-block">
                                <div class="card card-bordered">
                                    <div class="card-aside-wrap">
                                        <div class="card-inner card-inner-lg">
                                            <div class="nk-block-head nk-block-head-lg">
                                                <div class="nk-block-between">
                                                    <div class="nk-block-head-content">
                                                        <h4 class="nk-block-title">Login Activity</h4>
                                                        <div class="nk-block-des">
                                                            <p>Here is your login activities log. <span class="text-soft"><em class="icon ni ni-info"></em></span></p>
                                                        </div>
                                                    </div>
                                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-block-head -->
                                            <div class="nk-block card card-bordered">
                                                <table class="table table-ulogs">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th class="tb-col-os"><span class="overline-title">Location<span class="d-sm-none">/ IP</span></span></th>
                                                            <th class="tb-col-ip"><span class="overline-title">IP</span></th>
                                                            <th class="tb-col-time"><span class="overline-title">Time</span></th>
                                                            <th class="tb-col-action"><span class="overline-title">&nbsp;</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       @if(count($users) > 0)
                                                      @foreach ($users as $uu )
                                                        <tr>
                                                            <td class="tb-col-os">
                                                             @php $details = json_decode(file_get_contents("http://ipinfo.io/$uu->login_ip/json"));
                                                            echo $details->city.", ".$details->country;
                                                            @endphp</td>
                                                            <td class="tb-col-ip"><span class="sub-text">{{$uu->login_ip}}</span></td>
                                                            <td class="tb-col-time"><span class="sub-text">{{$uu->created_at->format('d M Y h:s')}}<span class="d-none d-sm-inline-block">10:34 PM</span></span></td>
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div><!-- .nk-block-head -->
                                        </div><!-- .card-inner -->
                                    <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                            <div class="card-inner-group" data-simplebar>
                                                <div class="card-inner">
                                                    <div class="user-card">
                                                        <div class="user-avatar bg-primary">
                                                               <img src="{{$user->photo_url }}"class="icon ni ni-user-alt">
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="lead-text">{{strtoupper($user->username)}}</span>
                                                            <span class="sub-text">{{$user->email}}</span>
                                                        </div>
                                                        
                                                    </div><!-- .user-card -->
                                                </div><!-- .card-inner -->
                                                <div class="card-inner">
                                                    <div class="user-account-info py-0">
                                                        <h6 class="overline-title-alt">Wallet Balance</h6>
                                                        <div class="user-balance">{{moneyFormat($user->wallet->amount, 'USD')}} </div>
                                                    </div>
                                                </div><!-- .card-inner -->
                                                <div class="card-inner p-0">
                                                    <ul class="link-list-menu">
                                                      <li><a class="active" href="{{ route('admin.users.show', ['id' => $user->id]) }}"><em class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a></li>
                                                        <li><a href="{{ route('admin.users.activity',  $user->id) }}"><em class="icon ni ni-activity-round-fill"></em><span>Account Activity</span></a></li>
                                                        <li><a href="{{ route('admin.users.settings',  $user->id) }}"><em class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span></a></li>
                                                    </ul>
                                                </div><!-- .card-inner -->
                                            </div><!-- .card-inner-group -->
                                        </div>><!-- card-aside -->
                                    </div><!-- card-aside-wrap -->
                                </div><!-- .card -->
                            </div><!-- .nk-block -->
                        </div>
                    </div>
                </div>
                    <!-- end container-fluid -->
                
@endsection
