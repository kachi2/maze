@extends('layouts.mobile')

@section('content')
<div class="space-items"></div>

                    <div class="bg-white padding-5 ">
                        <div class="item-card-gradual shadow   bg-white  ">
                            <div class="head-card d-flex justify-content-between align-items-center">
                                <div class="creator-name">
                                    <div class="image-user">
                                        <picture>
                                            <img class="img-avatar" src="{{asset('/mobile/images/avatar/5.png')}}" alt="">
                                        </picture>
                                    </div>
                                    <h3 style="font-weight:bolder">Savest Campaign</h3>
                                </div>
                                  <div class="btn-like-click">
                                    <div class="btnLike">
                                        <input type="checkbox">
                                        <span class="count-likes btn-outline-primary btn ">28.0% P.A</span>
                                       
                                    </div>
                                </div>
                            </div>
                            <a href="page-collectibles-details.html" class="body-card py-0">
                                <div class="cover-nft">
                                    <picture>
                                        <img class="img-cover" src="{{asset('/mobile/images/other/2.jpg')}}" alt="image NFT">
                                    </picture>
                                    <div class="countdown-time" style="text-align:center; border-radius:20px; left:2px">
                                        <span >This is cash account for you to keep your funds. Receive funds, transfer and withdrawal for free</span>
                                    </div>
                                    
                                </div>
                                <div class="title-card-nft">
                                    <div class="side-one">
                                        <p style="color:green">$2.00 at (28.0% p.a)</p>
                                         <p>Interest in 21 Days</p>
                                    </div>
                                    <div class="side-other" >
                                        <span class="no-sales btn btn-outline-primary">Tranfer</span>
                                    </div>
                                </div>

                            </a>
                            <div class="footer-card">
                                <div class="starting-bad">
                                    <h4 style="color:green">$2,000.00</h4>
                                    <span>Avail Balance</span>
                                </div>
                                  <button type="button" class="btn btn-sm bg-primary text-white "
                                data-bs-toggle="modal" data-bs-target="#mdllAddETH">
                               Add Fund
                            </button>
                            </div>
                        </div>
                    </div>

                    <div class="space-items"></div>
            <section class="un-details-collectibles ">
                <!-- head -->
                <div class="head  ">
                    <div class=" bg-white title-card-text d-flex align-items-center justify-content-between">
                        <div class="text">
                            <h1>Withdraw Fund</h1>
                            <p>Fund will be transferred to main wallet</p>
                        </div>
                          <button type="button" class="btn btn-sm bg-primary text-white "
                                data-bs-toggle="modal" data-bs-target="#mdllEAddETH">
                               Withdraw
                            </button>
                    </div>
                    <div class="shadow  bg-white txt-price-coundown  d-flex justify-content-between">
                        <div class="price">
                            <h2>Total Deposit</h2>
                            <p>$8,350</p>
                        </div>
                        <div class="coundown">
                            <h3>Total Withdraw</h3>
                            <span>$8,350</span>
                        </div>
                    </div>
                </div>
                <!-- body -->
                <div class="space-items"></div>
                <div class="body shadow  mt-2 bg-white">
                    <div class="description">
                        <p>
                            Transactions
                        </p>
                    </div>
                    <ul class="nav nav-pills nav-pilled-tab" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-Info-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Info" type="button" role="tab" aria-controls="pills-Info"
                                aria-selected="true">Deposits</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-Owner-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Owner" type="button" role="tab" aria-controls="pills-Owner"
                                aria-selected="false">Withdrawals</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-History-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-History" type="button" role="tab" aria-controls="pills-History"
                                aria-selected="false">Profits</button>
                        </li>
                    </ul>
                    <div class="tab-content content-custome-data" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-Info" role="tabpanel"
                            aria-labelledby="pills-Info-tab">
                            <ul class="nav flex-column nav-users-profile margin-t-20">
                             <li class="nav-item">
                            <a class="nav-link" href="page-creator-profile.html">
                                <div class="item-user-img">
                                    <picture>
                                  <div class="text-white rounded-pill debit" style=""></div>
                                    </picture>
                                    <div class="txt-user" >
                                        <p>Withdraw made</p>
                                        <p>Date: 22/2/2022 8:3pm</p>
                                    </div>
                                </div>
                                <div class="other-option">
                                
                                    <div class="color-text rounded-pill font-size-12" > <span class="debit_text">$2,000.00  </span><br>
                                    
                                    $3,500
                                    </div>
                                </div>
                            </a>
                        </li>
                                 <li class="nav-item">
                            <a class="nav-link" href="page-creator-profile.html">
                                <div class="item-user-img">
                                    <picture>
                                  <div class="text-white rounded-pill debit" style=""></div>
                                    </picture>
                                    <div class="txt-user">
                                        <p>Withdraw made</p>
                                        <p>Date: 22/2/2022 8:3pm</p>
                                    </div>
                                </div>
                                <div class="other-option">
                                
                                    <div class="color-text rounded-pill font-size-12" > <span class="debit_text">$2,000.00  </span><br>
                                    
                                    $3,500
                                    </div>
                                </div>
                            </a>
                        </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="pills-Owner" role="tabpanel" aria-labelledby="pills-Owner-tab">
                            <ul class="nav flex-column nav-users-profile margin-t-20">
                                 <li class="nav-item">
                            <a class="nav-link" href="page-creator-profile.html">
                                <div class="item-user-img">
                                    <picture>
                                        <div class="text-white rounded-pill credit"></div>
                                    </picture>
                                    <div class="txt-user" style="font-weight:0px; font-size:13px">
                                        <p>Interest Payment on your savest deposit
                                        <small> (Calculated daily) </small></p>
                                        <p>Date: Tues, 2/22/2022 23:36:18</p>
                                    </div>
                                </div>
                                <div class="other-option">
                                <div class="color-text rounded-pill font-size-12" > <span class="credit_text">$2,000.00  </span><br>
                                    
                                     $3,500
                                    </div>

                                </div>
                            </a>
                        </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="pills-History" role="tabpanel"
                            aria-labelledby="pills-History-tab">
                            <ul class="nav flex-column nav-users-profile margin-t-20">
                            <li class="nav-item">
                                <a class="nav-link" href="page-creator-profile.html">
                                    <div class="item-user-img">
                                        <picture>
                                            <div class="text-white rounded-pill credit"></div>
                                        </picture>
                                        <div class="txt-user">
                                            <p>Interest Payment on your savest deposit
                                            <small> (Calculated daily) </small></p>
                                            <p>Date: Tues, 2/22/2022 23:36:18</p>
                                        </div>
                                    </div>
                                    <div class="other-option">
                                    <div class="color-text rounded-pill font-size-12" > <span class="credit_text">$2,000.00  </span><br>
                                        
                                        $3,500
                                        </div>

                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="page-creator-profile.html">
                                    <div class="item-user-img">
                                        <picture>
                                            <div class="text-white rounded-pill credit"></div>
                                        </picture>
                                        <div class="txt-user">
                                            <p>Interest Payment on your savest deposit
                                            <small> (Calculated daily) </small></p>
                                            <p>Date: Tues, 2/22/2022 23:36:18</p>
                                        </div>
                                    </div>
                                    <div class="other-option">
                                    <div class="color-text rounded-pill font-size-12" > <span class="credit_text">$2,000.00  </span><br>
                                        
                                        $3,500
                                        </div>

                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="page-creator-profile.html">
                                    <div class="item-user-img">
                                        <picture>
                                            <div class="text-white rounded-pill credit"></div>
                                        </picture>
                                        <div class="txt-user">
                                            <p>Interest Payment on your savest deposit
                                            <small> (Calculated daily) </small></p>
                                            <p>Date: Tues, 2/22/2022 23:36:18</p>
                                        </div>
                                    </div>
                                    <div class="other-option">
                                    <div class="color-text rounded-pill font-size-12" > <span class="credit_text">$2,000.00  </span><br>
                                        
                                        $3,500
                                        </div>

                                    </div>
                                </a>
                            </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </section>

    <div class="modal transition-bottom screenFull defaultModal mdlladd__rate fade" id="mdllEAddETH" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="title-modal">Add  Fund</h1>
                    <button type="button" class="btn btnClose" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ri-close-fill"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="content-upload-item">
                        <div class="un-navMenu-default margin-t-30 p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item mb-3">
                                    <a class="nav-link effect-click" href="javascript: void(0)">
                                        <div class="item-content-link">
                                            <div class="icon color-text w-auto">
                                                <i class="ri-money-dollar-circle-fill"></i>
                                            </div>
                                            <input  class="form-control"  type="number" name="amount" placeholder="Enter Amount"> 
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item mb-0">
                                    <a class="nav-link effect-click" href="javascript: void(0)">
                                        <div class="item-content-link">
                                            <div class="icon color-text w-auto">
                                                <i class="ri-bank-card-line"></i>
                                            </div>
                                           <select class=" nav-link " class="form-control"> 
                                           <option> Select Payment Method</option>
                                              <option> BTC</option>
                                                 <option> LTE</option>
                                                  <option> ETH</option>
                                           </select>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <div class="env-pb"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal transition-bottom screenFull defaultModal mdlladd__rate fade" id="mdllAddETH" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="title-modal" style="font-size:12px">To complete this transaction, please send the exact amount of 100.05 USD | 0.00237000 BTC to the address below</h1>
                    <button type="button" class="btn btnClose" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ri-close-fill"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="content-upload-item">
                        <div class="un-navMenu-default  p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item " style="margin:auto ">
                                    <span class="" href="javascript: void(0)">
                                        <div class="item-content-link" >
                                            <picture>
                                            <img  style="max-width: 100px !important" src="{{asset('/mobile/images/hh.jpg')}}" alt="">
                                        </picture> 
                                       
                                        </div>
                                        <p style="text-decoration: none; color:#000">
                                            0.002500 BTC 
                                        </p>
                                    </span>
                                </li>
                                    

                                <div class="form-group with_icon">
                                    <label>BTC Address</label>
                                    <div class="input_group">
                                        <input type="text" class="form-control"  id="addresses" value="1Kmtc9KGygUcYcW8RSBCKXCxuecmrRhtY3" placeholder="" readonly> 
                                        <i class="ri-file-copy-2-line" onclick="copyText() "></i>
                                        
                                        <div class="icon">
                                            <i class="ri-twitter-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                  <li class="nav-item mb-3">
                                           <center> 
                                            <button class=" btn btn-outline-primary p-2 " type="button" onclick="confirmPay()" > Confirm Payment </button>
                                        </center>
                                </li>
                                <div class="countdown_code" style="text-align: center">
                                    <p id="payOne" hidden>We are confirming your payment</p>
                                    <p id="countdown" class="text_count"> </p>
                                    <p id="payTwo" hidden>  you can close window, notification will be sent once payment is confirmed</p>
                                </div>
                            </ul>
                           
                        </div>

                    </div>

                </div>
                <div class="modal-footer border-0">
                    <div class="env-pb"></div>
                </div>
            </div>
        </div>
    </div>

    
@endsection


@section('scripts')
<script>

function copyText() {
  var copyText = document.getElementById("addresses");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy")
  }

  </script>

<script>
    function confirmPay(){

  
    var timeleft = 1000;
    var downloadTimer = setInterval(function () {
        if (timeleft <= 0) {
            clearInterval(downloadTimer);
         } else {
            document.getElementById("countdown").innerHTML = "Estimated Time " + timeleft + "s";
        }
        timeleft -= 1;
        /*console.log(downloadTimer);*/
    }, 1000);
    document.getElementById("payOne").hidden = false;
    document.getElementById("payTwo").hidden = false;

  }
    /*==================================
      START VERIFICATIOS CODE INPUT
    ==================================*/

    const form = document.querySelector('.form-verification-code')
    const inputs = form.querySelectorAll('input')
    const KEYBOARDS = {
        backspace: 8,
        arrowLeft: 37,
        arrowRight: 39,
    }

    function handleInput(e) {
        const input = e.target
        const nextInput = input.nextElementSibling
        if (nextInput && input.value) {
            nextInput.focus()
            if (nextInput.value) {
                nextInput.select()
            }
        }
    }

    function handlePaste(e) {
        e.preventDefault()
        const paste = e.clipboardData.getData('text')
        inputs.forEach((input, i) => {
            input.value = paste[i] || ''
        })
    }

    function handleBackspace(e) {
        const input = e.target
        if (input.value) {
            input.value = ''
            return
        }

        input.previousElementSibling.focus()
    }

    function handleArrowLeft(e) {
        const previousInput = e.target.previousElementSibling
        if (!previousInput) return
        previousInput.focus()
    }

    function handleArrowRight(e) {
        const nextInput = e.target.nextElementSibling
        if (!nextInput) return
        nextInput.focus()
    }

    form.addEventListener('input', handleInput)
    inputs[0].addEventListener('paste', handlePaste)

    inputs.forEach(input => {
        input.addEventListener('focus', e => {
            setTimeout(() => {
                e.target.select()
            }, 0)
        })

        input.addEventListener('keydown', e => {
            switch (e.keyCode) {
                case KEYBOARDS.backspace:
                    handleBackspace(e)
                    break
                case KEYBOARDS.arrowLeft:
                    handleArrowLeft(e)
                    break
                case KEYBOARDS.arrowRight:
                    handleArrowRight(e)
                    break
                default:
            }
        })
    })
</script>
@endsection