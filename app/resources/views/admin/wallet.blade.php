@extends('layouts.admin')
@section('content')
     <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Wallet Addresses</h3>
                                           
                                        </div><!-- .nk-block-head-content -->
                                    
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                  
                                                </div>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="card card-bordered card-stretch">
                                        <div class="card-inner-group">
                                            <div class="card-inner">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h5 class="title">Wallets</h5>
                                                    </div>
                                                    <div class="card-tools mr-n1">
                                                        <ul class="btn-toolbar gx-1">
                                                            <li>
                                                                <a href="#" class="search-toggle toggle-search btn btn-icon" data-target="search"><em class="icon ni ni-search"></em></a>
                                                            </li><!-- li -->
                                                            <li class="btn-toolbar-sep"></li><!-- li -->
                                                            <li>
                                                          
                                                            </li><!-- li -->
                                                            <li>
                                                                
                                                            </li><!-- li -->
                                                        </ul><!-- .btn-toolbar -->
                                                    </div><!-- .card-tools -->
                                                    <div class="card-search search-wrap" data-search="search">
                                                        <form method="get">
                                                        <div class="search-content">
                                                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                            <input type="text" name="search" value="{{ request()->input('search') }}" 
                                                   placeholder="Search..."  class="form-control border-transparent form-focus-none" >
                                                            <button class="search-submit btn btn-icon" type="submit"><em class="icon ni ni-search"></em></button>
                                                        </div>
                                                        </form>
                                                    </div><!-- .card-search -->
                                                </div><!-- .card-title-group -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner p-0">
                                                <div class="nk-tb-list nk-tb-tnx">
                                                    <div class="nk-tb-item nk-tb-head">
                                                        <div class="nk-tb-col"><span>Name</span></div>
                                                        <div class="nk-tb-col"><span>Adress</span></div>
                                                        <div class="nk-tb-col"><span>Barcode</span></div>
                                                        <div class="nk-tb-col  "><span>Created At </span></div>
                                                            <div class="nk-tb-col  "></div>
                                                       
                                                    </div><!-- .nk-tb-item -->
                                                    @forelse($wallets as $wallet)
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col">
                                                            <div class="nk-tnx-type">
                                                                    <span class="tb-lead">{{$wallet->name}}</span>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="nk-tb-col ">
                                                            <span class="tb-amount"> {{ $wallet->address }}</span>
                                                        </div>
                                                        <div class="nk-tb-col ">
                                                            <span class="tb-amount"><img src="{{asset('/mobile/images/'.$wallet->barcode)}}" style="width:80px"> </span>
                                                        </div>

                                                         <div class="nk-tb-col tb-col-sm">
                                                            <span class="tb-amount">{{$wallet->created_at}}</span>
                                                        </div>

                                                        <div class="nk-tb-col tb-col-sm">
                                                            <span class="tb-amount"> <a href="{{route('wallet.address.delete',encrypt($wallet->id))}}">Delete</a></span>
                                                        </div>
                                                       
                                                    </div><!-- .nk-tb-item --> 
                                                @endforeach

                                                    
                                                </div><!-- .nk-tb-list -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner">
                                              
                                            </div><!-- .card-inner -->
                                        </div><!-- .card-inner-group -->
                                    </div><!-- .card -->
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                    </div>
                </div>
               
@endsection

@section('scripts')
    <script>

let message = {!! json_encode(Session::get('message')) !!};
let msg = {!! json_encode(Session::get('msg')) !!};

//alert(msg);
if(message != null){
toastr.clear();
    NioApp.Toast(message , msg, {
      position: 'top-right',
        timeOut: 5000,
    });
}

</script>
@endsection

