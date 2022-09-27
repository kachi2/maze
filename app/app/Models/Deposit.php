<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Deposit
 *
 * @property int $id
 * @property string $ref
 * @property int $user_id
 * @property int $plan_id
 * @property float $amount
 * @property float $paid_amount
 * @property int $profit_rate
 * @property int $payment_period
 * @property string $payment_method
 * @property int $duration
 * @property \Illuminate\Support\Carbon $expires_at
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $formatted_payment_method
 * @property-read bool $has_expired
 * @property-read \App\Models\Plan $plan
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit wherePaymentPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit whereProfitRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit whereRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Deposit whereUserId($value)
 * @mixin \Eloquent
 */
class Deposit extends Model
{
    const STATUS_ACTIVE = 0;
    const STATUS_COMPLETED = 1;
    const STATUS_CANCELED = -1;

    const PAYMENT_METHOD_PM = 'PM';
    const PAYMENT_METHOD_BTC = 'BTC';
    const PAYMENT_METHOD_DGB = 'DGB';
    const PAYMENT_METHOD_ETH = 'ETH';
    const PAYMENT_METHOD_LTC = 'LTC';
    const PAYMENT_METHOD_BCH = 'BCH';
    const PAYMENT_METHOD_WALLET = 'WALLET';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ref',
        'amount',
        'profit_rate',
        'user_id',
        'plan_id',
        'duration',
        'payment_period',
        'payment_method',
        'paid_amount',
        'expires_at',
        'status',
        'hash_no'
    ];

    /**
     * The attributes casts.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'double',
        'paid_amount' => 'double',
        'duration' => 'int',
        'profit_rate' => 'double',
        'payment_period' => 'int',
        'expires_at' => 'datetime',
        'status' => 'int'
    ];

    /**
     * Get the User for the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the User for the order.
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * @return bool
     */
    public function getHasExpiredAttribute()
    {
        return $this->expires_at <= now();
    }

    public function getFormattedPaymentMethodAttribute()
    {
        switch ($this->payment_method) {
            case self::PAYMENT_METHOD_BTC:
                return 'BITCOIN';
            default:
                return $this->payment_method;
        }
    }

    public function getProfitAttribute()
    {
        switch ($this->payment_period) {
            case Package::PERIOD_HOURLY:
            case Package::PERIOD_DAILY:
            case Package::PERIOD_WEEKLY:
            case Package::PERIOD_MONTHLY:
            case Package::PERIOD_2_MONTHS:
            case Package::PERIOD_3_MONTHS:
            case Package::PERIOD_6_MONTHS:
            return ($this->amount * $this->profit_rate / 100) * $this->duration ;
            case Package::PERIOD_AFTER_SPECIFIED_HOURS:
            case Package::PERIOD_AFTER_SPECIFIED_DAYS:
            return $this->amount + ($this->amount * $this->profit_rate / 100);
        }
    }

    public function getProfitTodayAttribute()
    {
        switch ($this->payment_method) {
            case self::PAYMENT_METHOD_BTC:
                return 'BITCOIN';
            default:
                return $this->payment_method;
        }
    }

    /**
     * Get the user wallet attribute.
     *
     * @return string
     */
    public function getFormattedDurationAttribute()
    {
        switch ($this->payment_period) {
            case Package::PERIOD_HOURLY:
            case Package::PERIOD_AFTER_SPECIFIED_HOURS:
                return $this->duration . ' Hours';
            default:
                return $this->duration . ' Days';
        }
    }

    /**
     * Get the user wallet attribute.
     *
     * @return string
     */
    public function getFormattedPaymentPeriodAttribute()
    {
        return get_payment_period_name($this->payment_period);
    }

    /**
     * Get the user wallet attribute.
     *
     * @return string
     */
    public function getFormattedPaymentPeriodAltAttribute()
    {
        return get_payment_period_name_alt($this->payment_period, $this->duration);
    }

    /**
     * Get the user wallet attribute.
     *
     * @return string
     */
    public function getFormattedProfitRateAttribute()
    {
        return $this->profit_rate . '% ' . $this->getFormattedPaymentPeriodAltAttribute();
    }

    public function getUrlAttribute()
    {
        return route('deposit', ['ref' => $this->ref]);
    }

   
}
