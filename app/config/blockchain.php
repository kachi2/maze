<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/20/2018
 * Time: 10:26 AM
 */
return [
    'payment_currency' => env('BLOCKCHAIN_PAYMENT_CURRENCY', 'USD'),
    'receive_currency' => env('BLOCKCHAIN_RECEIVE_CURRENCY', 'USD'),
    'api_key' => env('BLOCKCHAIN_API_KEY'),
    'xpub_key' => env('BLOCKCHAIN_XPUB_KEY'),
    'guid' => env('BLOCKCHAIN_GUID'),
    'guid_password' => env('BLOCKCHAIN_GUID_PASSWORD'),
    'guid_password2' => env('BLOCKCHAIN_GUID_PASSWORD2'),
];
