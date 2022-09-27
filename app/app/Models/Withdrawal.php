<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Withdrawal
 *
 * @property int $id
 * @property string $ref
 * @property int $user_id
 * @property float $amount
 * @property string $wallet_address
 * @property string $payment_method
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $formatted_payment_method
 * @property-read string $is_paid
 * @property-read string $is_pending
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Withdrawal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Withdrawal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Withdrawal query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Withdrawal whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Withdrawal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Withdrawal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Withdrawal wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Withdrawal whereRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Withdrawal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Withdrawal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Withdrawal whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Withdrawal whereWalletAddress($value)
 * @mixin \Eloquent
 */
class Withdrawal extends Model
{
    const STATUS_PAID = 1;
    const STATUS_PENDING = 0;
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
        'amount',
        'ref',
        'wallet_address',
        'user_id',
        'payment_method',
        'status',
    ];

    /**
     * The attributes casts.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'double',
        'status' => 'int'

    ];

    /**
     * Get the User for the model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the is paid attribute.
     *
     * @return string
     */
    public function getIsPaidAttribute()
    {
        return $this->status == self::STATUS_PAID;
    }

    /**
     * Get the is pending attribute.
     *
     * @return string
     */
    public function getIsPendingAttribute()
    {
        return $this->status == self::STATUS_PENDING;
    }

    /**
     * Get the formatted payment method attribute.
     *
     * @return string
     */
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
