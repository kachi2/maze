<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/11/2018
 * Time: 1:35 PM
 */

use App\Models\Deposit;
use App\Models\Package;
use App\Models\Referral;
use App\Models\UserWallet;
use App\Models\Withdrawal;
use App\User;
use App\Agent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;

if (!function_exists('is_tab')) {
    /**
     * @param string $tab
     * @param bool $default
     * @return bool
     */
    function is_tab($tab, $default = false)
    {
        if (strtolower(request('tab', $default ? $tab : '')) == strtolower($tab)) {
            return true;
        }

        return false;

    }
}

if (!function_exists('is_filter')) {
    /**
     * @param string $tab
     * @param bool $default
     * @return bool
     */
    function is_filter($tab, $default = false)
    {
        if (strtolower(request('filter_by', $default ? $tab : '')) == strtolower($tab)) {
            return true;
        }

        return false;

    }
}

if (!function_exists('sort_url')) {
    /**
     * @param string $sort
     * @return string
     */
    function sort_url($sort)
    {
        return replace_query_params(request()->fullUrl(), ['sort_by' => $sort]);
    }
}


if (!function_exists('filter_url')) {
    /**
     * @param string $filter
     * @return string
     */
    function filter_url($filter)
    {
        return replace_query_params(request()->fullUrl(), ['filter_by' => $filter]);
    }
}


if (!function_exists('tab_url')) {
    /**
     * @param $tab
     * @return string
     */
    function tab_url($tab)
    {
        return replace_query_params(request()->fullUrl(), ['tab' => $tab]);
    }
}

if (!function_exists('replace_query_params')) {

    /**
     * @param string $url
     * @param array $params \
     * @return string
     */
    function replace_query_params($url, array $params)
    {
        $query = parse_url($url, PHP_URL_QUERY);
        parse_str($query, $oldParams);

        if (empty($oldParams)) {
            return rtrim($url, '?') . '?' . http_build_query($params);
        }

        $params = array_merge($oldParams, $params);

        return preg_replace('#\?.*#', '?' . http_build_query($params), $url);
    }
}


if (!function_exists('form_invalid')) {
    /**
     * @param $field
     * @return string
     */
    function form_invalid($field)
    {
        static $errors;
        if (!$errors) {
            $errors = session()->get('errors', new MessageBag());
        }

        return $errors->has($field) ? 'is-invalid' : '';
    }
}

if (!function_exists('getUsernameById')) {
    /**
     * @return string
     */
    function getUsernameById($id)
    {
        try {
            $name = User::whereId($id)->firstOrFail();
        } catch (Exception $e) {
            $name = 0;
        }

        return $name;
    }
}

if (!function_exists('active_route')) {
    function active_route($routePattern, $class = 'active')
    {
        $currentRouteName = Route::currentRouteName();

        if (!is_array($routePattern)) {
            $routePattern = explode(' ', $routePattern);
        }
        // Check the current route name
        foreach ((array)$routePattern as $i) {
            if (Str::is($i, $currentRouteName)) {
                return $class;
            }
        }

        return '';
    }
}

if (!function_exists('generate_reference')) {
    /**
     * @return string
     */
    function generate_reference()
    {
        return substr(md5(uniqid(time())), 0, 10);
    }
}


if (!function_exists('auth_user')) {
    /**
     * @return Authenticatable|User
     */
    function auth_user()
    {
        return auth()->user();
    }
}

if(!function_exists('agent_user')){

    /**
     * @return Athenticatable|Agent
     */

     function agent_user(){
        return auth('agent')->user();
     }
}

if (!function_exists('truncate')) {
    /**
     * Crop string to specific length (support unicode)
     *
     * @param string $string
     * @param int $length
     * @param string $etc
     * @return string
     */
    function truncate($string, $length = 80, $etc = '...')
    {
        if (Str::length($string) <= $length) {
            return $string;
        }
        $spacePos = strpos($string, ' ');

        if ($spacePos === false || $spacePos >= $length) {
            return Str::substr($string, 0, $length) . $etc;
        }

        $lastSpacePos = strrpos(Str::substr($string, 0, $length + 1), ' ');

        return Str::substr($string, 0, $lastSpacePos) . $etc;
    }
}

if (!function_exists('get_stats')) {
    /**
     * @return array
     */
    function get_stats()
    {
        static $stats;

        if (!$stats) {
            $user = request()->user();
            $stats = [];
            $stats['wallet_balance'] = $user->wallet->amount;
            $stats['referral_count'] = Referral::whereReferrerId($user->id)->count();
            $stats['all_time_referral_bonus'] = Referral::whereReferrerId($user->id)->sum('interest');
            $stats['referral_bonus'] = $user->wallet->referrals;
            $stats['withdrawals'] = Withdrawal::whereUserId($user->id)->sum('amount');;
            $stats['bonus'] = $user->wallet->referrals + $user->wallet->bonus;
        }

        return $stats;
    }
}


if (!function_exists('get_admin_stats')) {
    /**
     * @return array
     */
    function get_admin_stats()
    {
        static $adminStats;

        if (!$adminStats) {
            $adminStats = [];
            $adminStats['wallet_balance'] = UserWallet::sum('amount');
            $adminStats['referral_count'] = Referral::count();
            $adminStats['referral_bonus'] = UserWallet::sum('referrals');
            $adminStats['withdrawals'] = Withdrawal::whereStatus(Withdrawal::STATUS_PAID)->sum('amount');
            $adminStats['deposits'] = Deposit::sum('amount');
            $adminStats['bonus'] = UserWallet::sum('bonus');
        }

        return $adminStats;
    }
}


if (!function_exists('get_payment_periods')) {
    /**
     * @return array
     */
    function get_payment_periods()
    {
        return [
            Package::PERIOD_HOURLY => 'Hourly',
            Package::PERIOD_DAILY => 'Daily',
            Package::PERIOD_WEEKLY => 'Weekly',
            Package::PERIOD_MONTHLY => 'Monthly',
            Package::PERIOD_2_MONTHS => '2 Months',
            Package::PERIOD_3_MONTHS => '3 months',
            Package::PERIOD_6_MONTHS => '6 Months',
            Package::PERIOD_AFTER_SPECIFIED_HOURS => 'After the specified hours',
            Package::PERIOD_AFTER_SPECIFIED_DAYS => 'After the specified days'
        ];
    }
}


if (!function_exists('get_payment_period_name')) {
    /**
     * @param int $paymentPeriod
     * @return string
     */
    function get_payment_period_name(int $paymentPeriod)
    {
        switch ($paymentPeriod) {
            case Package::PERIOD_HOURLY:
                return 'Hourly';
            case Package::PERIOD_DAILY:
                return 'Daily';
            case Package::PERIOD_WEEKLY:
                return 'Weekly';
            case Package::PERIOD_MONTHLY:
                return 'Monthly';
            case Package::PERIOD_2_MONTHS:
                return '2 Months';
            case Package::PERIOD_3_MONTHS:
                return '3 months';
            case Package::PERIOD_6_MONTHS:
                return '6 Months';
            case Package::PERIOD_AFTER_SPECIFIED_HOURS:
                return 'After the specified hours';
            case Package::PERIOD_AFTER_SPECIFIED_DAYS:
                return 'After the specified days';
        }
    }
}


if (!function_exists('get_payment_period_name_alt')) {
    /**
     * @param int $paymentPeriod
     * @param int $duration
     * @return string
     */
    function get_payment_period_name_alt(int $paymentPeriod, int $duration)
    {
        switch ($paymentPeriod) {
            case Package::PERIOD_HOURLY:
                return 'Hourly';
            case Package::PERIOD_DAILY:
                return 'Daily';
            case Package::PERIOD_WEEKLY:
                return 'Weekly';
            case Package::PERIOD_MONTHLY:
                return 'Monthly';
            case Package::PERIOD_2_MONTHS:
                return 'Every 2 Months';
            case Package::PERIOD_3_MONTHS:
                return 'Every 3 months';
            case Package::PERIOD_6_MONTHS:
                return 'Every 6 Months';
            case Package::PERIOD_AFTER_SPECIFIED_HOURS:
                return 'In ' . $duration . ' Hours';
            case Package::PERIOD_AFTER_SPECIFIED_DAYS:
                return 'In ' . $duration . ' Days';
        }
    }
}


if (!function_exists('get_payment_period_name_alt2')) {
    /**
     * @param int $paymentPeriod
     * @param int $duration
     * @return string
     */
    function get_payment_period_name_alt2(int $paymentPeriod, int $duration)
    {
        switch ($paymentPeriod) {
            case Package::PERIOD_HOURLY:
                return 'Per Hour';
            case Package::PERIOD_DAILY:
                return 'Per Day';
            case Package::PERIOD_WEEKLY:
                return 'Per Week';
            case Package::PERIOD_MONTHLY:
                return 'per Month';
            case Package::PERIOD_2_MONTHS:
                return 'Per Every 2 Months';
            case Package::PERIOD_3_MONTHS:
                return 'Every 3 months';
            case Package::PERIOD_6_MONTHS:
                return 'Every 6 Months';
            case Package::PERIOD_AFTER_SPECIFIED_HOURS:
                return 'In ' . $duration . ' Hours';
            case Package::PERIOD_AFTER_SPECIFIED_DAYS:
                return 'In ' . $duration . ' Days';
        }
    }
}



if (!function_exists('get_payment_methods')) {
    /**
     * @return array
     */
    function get_payment_methods()
    {
        return [
            'wallet' => 'From Wallet',
            //Deposit::PAYMENT_METHOD_PM => 'Perfect Money',
            Deposit::PAYMENT_METHOD_BTC => 'BTC',
            Deposit::PAYMENT_METHOD_ETH => 'ETH',
            Deposit::PAYMENT_METHOD_LTC => 'LTC',
        ];
    }
}

if (!function_exists('get_payment_method')) {
    /**
     * @return array
     */
    function get_payment_method()
    {
        return [
            Deposit::PAYMENT_METHOD_BTC => 'BTC',
            Deposit::PAYMENT_METHOD_ETH => 'ETH',
            Deposit::PAYMENT_METHOD_LTC => 'LTC',
        ];
    }
}

if (!function_exists('get_withdrawal_methods')) {
    /**
     * @return array
     */
    function get_withdrawal_methods()
    {
        return [
            'wallet' => 'From Wallet',
            Deposit::PAYMENT_METHOD_BTC => 'BTC',
            Deposit::PAYMENT_METHOD_ETH => 'ETH',
            Deposit::PAYMENT_METHOD_LTC => 'LTC',
        ];
    }
}

if (!function_exists('generate_token')) {
    function generate_token($length = 15)
    {
        $secureRandom = function ($min, $max)
        {
            $range = $max - $min;
            if ($range < 1) return $min; // not so random...
            $log = ceil(log($range, 2));
            $bytes = (int)($log / 8) + 1; // length in bytes
            $bits = (int)$log + 1; // length in bits
            $filter = (int)(1 << $bits) - 1; // set all lower bits to 1
            do {
                $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
                $rnd = $rnd & $filter; // discard irrelevant bits
            } while ($rnd > $range);
            return $min + $rnd;
        };
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[$secureRandom(0, $max - 1)];
        }

        return $token;
    }
}


