<?php

namespace App\Models;

use App\Notifications\InvestmentCreated;
use App\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\PendingDeposit
 *
 * @property int $id
 * @property string $ref
 * @property int $user_id
 * @property int $plan_id
 * @property float $amount
 * @property float $fee
 * @property float $verifying_amount
 * @property int $profit_rate
 * @property string $payment_method
 * @property int $payment_period
 * @property int $duration
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $formatted_payment_method
 * @property-read \App\Models\Plan $plan
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit whereFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit wherePaymentPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit whereProfitRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit whereRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PendingDeposit whereVerifyingAmount($value)
 * @mixin \Eloquent
 */
class PendingDeposit extends Model
{
    const STATUS_PENDING = 0;
    const STATUS_VERIFIED = 1;
    const STATUS_CANCELED = -1;

    const PAYMENT_METHOD_PM = 'PM';
    const PAYMENT_METHOD_BTC = 'BTC';
    const PAYMENT_METHOD_DGB = 'DGB';
    const PAYMENT_METHOD_ETH = 'ETH';
    const PAYMENT_METHOD_LTC = 'LTC';
    const PAYMENT_METHOD_BCH = 'BCH';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ref',
        'amount',
        'fee',
        'verifying_amount',
        'profit_rate',
        'token',
        'user_id',
        'plan_id',
        'duration',
        'payment_period',
        'payment_method',
        'status',
        'hash_no',
        'currency1',
        'currency2',
        'amount2',
    ];

    /**
     * The attributes casts.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'double',
        //'verifying_amount' => 'double',
        'fee' => 'double',
        'duration' => 'int',
        'profit_rate' => 'double',
        'payment_period' => 'int',
        'status' => 'int'
    ];

    /**
     * Get the User for the deposit.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Plan for the deposit.
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * @return Deposit|Model
     */
    public function makeActive() {
        \Log::info('foo');
        $expireDate = Carbon::now();

        switch ($this->payment_period) {
            case Package::PERIOD_HOURLY:
            case Package::PERIOD_AFTER_SPECIFIED_HOURS:
                $expireDate->addHours($this->duration);
                break;
            case Package::PERIOD_DAILY:
            case Package::PERIOD_WEEKLY:
            case Package::PERIOD_MONTHLY:
            case Package::PERIOD_2_MONTHS:
            case Package::PERIOD_3_MONTHS:
            case Package::PERIOD_6_MONTHS:
            case Package::PERIOD_AFTER_SPECIFIED_DAYS:
                $expireDate->addDays($this->duration);
        }

        $trade =  Deposit::create([
            'ref' => generate_reference(),
            'user_id' => $this->user_id,
            'plan_id' => $this->plan_id,
            'payment_method' => $this->payment_method,
            'amount' => $this->amount,
            'profit_rate' => $this->profit_rate,
            'expires_at' => $expireDate,
            'duration' => $this->duration,
            'payment_period' => $this->payment_period
        ]);

        try {
            $this->user->notify(new InvestmentCreated($trade));
        } catch (Exception $exception) {

        }
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
}
