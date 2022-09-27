<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/8/2018
 * Time: 9:23 AM
 */

namespace App\Modules;


use App\Models\PendingDeposit;
use Blockchain\Exception\Error;
use Blockchain\Exception\HttpError;
use Blockchain\Exception\ParameterError;
use Blockchain\Wallet\PaymentResponse;
use Illuminate\Http\Request;

class BlockChain
{

    /**
     * The blockchain api key.
     *
     * @var array
     */
    protected $apiKey;

    /**
     * The blockchain xpub key.
     *
     * @var array
     */
    protected $xpubKey;

    /**
     * The blockchain secret key.
     *
     * @var array
     */
    protected $secret;

    /**
     * The blockchain instance.
     *
     * @var array
     */
    protected $blockchain;

    /**
     *  Class constructor.
     */
    public function __construct()
    {
        $this->apiKey = config('blockchain.api_key');
        $this->xpubKey = config('blockchain.xpub_key');
        $this->secret = 'ABCD!@#$HHHH^^%%@&%(';
        $this->blockchain = new \Blockchain\Blockchain(config('blockchain.api_key'));
    }

    /**
     * Create blockchain payment.
     *
     * @param int $orderId
     * @param int $amount
     * @return array
     * @throws Error
     * @throws HttpError
     */
    public function createPaymentAddress($orderId, $amount)
    {
        $response = $this->blockchain->ReceiveV2->generate($this->apiKey, $this->xpubKey, route('blockchain.callback', ['order_id' => $orderId, 'secret' => $this->secret]), 100);
        $amount = $this->usdToBtc($amount);
        return [
            'address' => $response->getReceiveAddress(),
            'amount' => $amount,
            'qrcode' => 'https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=bitcoin:' . $response->getReceiveAddress() . '?amount=' . $amount
        ];
    }

    /**
     * Create blockchain withdrawal.
     *
     * @param int $amount
     * @param $walletAddress
     * @return PaymentResponse
     * @throws HttpError
     * @throws ParameterError
     */
    public function createWithdrawal($amount, $walletAddress)
    {
        $this->blockchain->setServiceUrl("https://blockchain.info");
        $this->blockchain->Wallet->credentials(config('blockchain.guid'), config('blockchain.guid_password'), config('blockchain.guid_password2'));
        $amount = $this->usdToBtc($amount);
        return $this->blockchain->Wallet->send($walletAddress, $amount, null, null);
    }

    /**
     * Verify blockchain payment.
     *
     * @param Request $request
     * @param PendingDeposit $transaction
     * @return bool
     * @throws \Exception
     */
    public function verifyPayment(Request $request, PendingDeposit $transaction)
    {
        if ($request->input('address') != $transaction->token) {
            throw new \Exception('Invalid payment address');
        }

        if (bcdiv($request->input('value'), 100000000, 8) != $transaction->verifying_amount) {
            throw new \Exception('Invalid payment amount');
        }

        if ($request->input('secret') != $this->secret) {
            throw new \Exception('Invalid payment secrete');
        }

        return $request->input('confirmations') >= 1;
    }

    /**
     * Get the exchange rate from btc to usd.
     *
     * @param $amount
     * @return int
     */
    public function btcToUsd($amount)
    {
        $rates = $this->blockchain->Rates->get();

        return $amount * $rates['USD']->m15;
    }

    /**
     * Get the exchange rate from btc to usd.
     *
     * @param $amount
     * @return int
     */
    public function usdToBtc($amount)
    {
        return $this->blockchain->Rates->toBTC($amount, 'USD');
    }
}
