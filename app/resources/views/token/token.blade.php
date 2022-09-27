@extends('layouts.app', ['page_title' => 'Token'])
@section('content')

        <div class="body-content row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body" style="border: 1px dashed #15d615;">

                    <div class="row">

                        <div class="col-lg-12 no-pl mt-30">
                        <h4 class="boldy mt-0">Mine Bitcoin from your BitWallet or Mycelium Wallet</h4>
                            <form method="post" action="{{ route('token') }}">
                                @csrf
                                <input name="type" hidden value="{{ \App\Models\Token::TYPE_BITWALLET }}">
                                <button type="submit" class="btn btn-primary btn-rounded right15 btn-block"
                                        style="font-size: 22px; border-radius: 10px;">
                                    <li class="fa fa-qrcode"></li>
                                    Generate
                                    New Token
                                </button>
                            </form>
                        </div>

                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-4" style="text-align: center;">
                            <div class="option-icon" style="text-align: center;">

                                @isset($token)
                                    <img src="{{ $token->qr_code }}"
                                         class="img-thumbnail" alt="QR-Code">
                                         <br><br>
                                         <div class="input-group input-group-sm">
                                            <input type="text" placeholder="Email" value="{{ $token->token }}" class="form-control" id="input-bitcoin-hash">
                                            <div class="input-group-append">
                                                <button onclick="copyToken()" class="btn btn-outline-secondary" type="button">Copy</button>
                                            </div>
                                        </div>
                                    
                                @endisset

                                @empty($token)
                                    <img src="{{ asset('ally-assets/dist/img/qr.jpg') }}" class="img-responsive img-thumbnail" alt="QR-Code">
                                        <br><br>
                                    
                                @endempty
                                    <br><br>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="scan-info left15">
                                <h5 class="bold">
                                    @if(isset($token))
                                        Scan the QR-Code address
                                    @else
                                        You don't have Mining Token, Click the "Generate New Token" button above.                                       
                                    @endif
                                </h5>
                                <p class="text-muted">
                                    Earn Extra Bitcoin while Mining Directly from your BitWallet or Mycelium Wallet, Scan the QR-Core or Click Generate New Token above to Proceed. 
                                    <br><br>
                                    Feel free to contact Support if you have any issues.</p>
                                <div class="col-lg-12 no-pl mt-10">

                                    <a href="https://apps.apple.com/us/app/bitwallet-bitcoin-wallet/id777634714"
                                       class="btn btn-warning btn-rounded right15 btn-block"
                                       style="font-size: 16px; border-radius: 10px;"><i class="cc BTC-alt"></i>
                                        Download BitWallet for iPhone Here</a> <br>

                                    <a href="https://play.google.com/store/apps/details?id=com.mycelium.wallet"
                                       class="btn btn-success btn-rounded right15 btn-block"
                                       style="font-size: 16px; background-color: #111; color: #4ada4a; border-radius: 10px;"><i class="cc BTC-alt"></i>
                                        Download Mycelium Wallet for Andriod/iOS Here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function copyToken() {
            var copyText = document.getElementById("input-bitcoin-hash");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Mining Token Copied!',
                showConfirmButton: false,
                timer: 40000
            })
        }
    </script>
@endpush