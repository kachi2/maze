<?php
/**
 * Created by PhpStorm.
 * User: billi
 * Date: 6/2/19
 * Time: 2:05 AM
 */

namespace App\modules;


use Illuminate\Http\Request;

class PerfectMoney
{
    protected $account_id;
    protected $passphrase;
    protected $alt_passphrase;
    protected $marchant_id;
    protected $httpClient;

    function __construct()
    {
        $this->account_id = config('perfectmoney.account_id');
        $this->passphrase = config('perfectmoney.passphrase');
        $this->alt_passphrase = config('perfectmoney.alternate_passphrase');
        $this->marchant_id = config('perfectmoney.marchant_id');
    }

    /**
     * Render form
     *
     * @param   array $data
     *
     * @return string
     */
    public function makePayment($data = [])
    {
        # Generate form to do payment
        $hiddenFields = '';
        foreach ($this->getPaymentFormData($data) as $key => $value) {
            $hiddenFields .= sprintf(
                    '<input type="hidden" name="%1$s" value="%2$s" />',
                    htmlentities($key, ENT_QUOTES, 'UTF-8', false),
                    htmlentities($value, ENT_QUOTES, 'UTF-8', false)
                )."\n";
        }

        $output = '<form action="%1$s" method="post"> %2$s <input type="submit" class="btn btn-primary" value="Proceed Investment" /></form>';
        $output = sprintf(
            $output,
            htmlentities('https://perfectmoney.is/api/step1.asp', ENT_QUOTES, 'UTF-8', false),
            $hiddenFields
        );

        return $output;
    }

    protected function getPaymentFormData($data)
    {
        $requestData = [
            'PAYEE_ACCOUNT' => (isset($data['PAYEE_ACCOUNT']) ? $data['PAYEE_ACCOUNT'] : config('perfectmoney.marchant_id')),
            'PAYEE_NAME' => (isset($data['PAYEE_NAME']) ? $data['PAYEE_NAME'] : config('perfectmoney.marchant_name')),
            'PAYMENT_AMOUNT' => (isset($data['PAYMENT_AMOUNT']) ? $data['PAYMENT_AMOUNT'] : ''),
            'PAYMENT_UNITS' => (isset($data['PAYMENT_UNITS']) ? $data['PAYMENT_UNITS'] : config('perfectmoney.units')),
            'PAYMENT_ID' => (isset($data['PAYMENT_ID']) ? $data['PAYMENT_ID'] : null),
            'PAYMENT_URL' => (isset($data['PAYMENT_URL']) ? $data['PAYMENT_URL'] : config('perfectmoney.payment_url')),
            'NOPAYMENT_URL' => (isset($data['NOPAYMENT_URL']) ? $data['NOPAYMENT_URL'] : config('perfectmoney.nopayment_url')),
        ];

        // Status URL
        $requestData['STATUS_URL'] = null;
        if (config('perfectmoney.status_url') || isset($data['STATUS_URL'])) {
            $requestData['STATUS_URL'] = (isset($data['STATUS_URL']) ? $data['STATUS_URL'] : config('perfectmoney.status_url'));
        }

        // Payment URL Method
        $requestData['PAYMENT_URL_METHOD'] = null;
        if (config('perfectmoney.payment_url_method') || isset($data['PAYMENT_URL_METHOD'])) {
            $requestData['PAYMENT_URL_METHOD'] = (isset($data['PAYMENT_URL_METHOD']) ? $data['PAYMENT_URL_METHOD'] : config('perfectmoney.payment_url_method'));
        }

        // No Payment URL Method
        $requestData['NOPAYMENT_URL_METHOD'] = null;
        if (config('perfectmoney.nopayment_url_method') || isset($data['NOPAYMENT_URL_METHOD'])) {
            $requestData['NOPAYMENT_URL_METHOD'] = (isset($data['NOPAYMENT_URL_METHOD']) ? $data['NOPAYMENT_URL_METHOD'] : config('perfectmoney.nopayment_url_method'));
        }

        // Memo
        $requestData['SUGGESTED_MEMO'] = null;
        if (config('perfectmoney.suggested_memo') || isset($data['SUGGESTED_MEMO'])) {
            $requestData['SUGGESTED_MEMO'] = (isset($data['SUGGESTED_MEMO']) ? $data['SUGGESTED_MEMO'] : config('perfectmoney.suggested_memo'));

        }

        return $requestData;
    }

    public function validatePurchase(Request $request, $amount)
    {
        $theirHash = (string)$request->input('V2_HASH');
        $ourHash = $this->generateHash($request);
        $paymountId = (string)$request->input('PAYMENT_ID');
        if($theirHash !== $ourHash || config('perfectmoney.units') !== (string)$request->input('PAYMENT_UNITS') || ((double)$request->input('PAYMENT_AMOUNT')) !== (double)$amount) {
            return false;
        }

        return ($request->input('PAYMENT_BATCH_NUM') != 0) ? true : false;
    }

    public function generateHash(Request $request)
    {
        $string = '';
        $string .= $request->input('PAYMENT_ID') . ':';
        $string .= $request->input('PAYEE_ACCOUNT') . ':';
        $string .= $request->input('PAYMENT_AMOUNT') . ':';
        $string .= $request->input('PAYMENT_UNITS') . ':';
        $string .= $request->input('PAYMENT_BATCH_NUM') . ':';
        $string .= $request->input('PAYER_ACCOUNT') . ':';
        $string .= strtoupper(md5($this->alt_passphrase)) . ':';
        $string .= $request->input('TIMESTAMPGMT');
        return strtoupper(md5($string));
    }

}
