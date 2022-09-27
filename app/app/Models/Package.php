<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Package
 *
 * @property int $id
 * @property string $name
 * @property int $payment_period
 * @property int $duration
 * @property string|null $desc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $formatted_duration
 * @property-read string $formatted_payment_period_alt
 * @property-read string $formatted_payment_period
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Plan[] $plans
 * @property-read int|null $plans_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Package newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Package query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Package whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Package whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Package whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Package whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Package whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Package wherePaymentPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Package whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Package extends Model
{
    const PERIOD_HOURLY = 1;
    const PERIOD_DAILY = 2;
    const PERIOD_WEEKLY = 3;
    const PERIOD_MONTHLY = 4;
    const PERIOD_2_MONTHS = 5;
    const PERIOD_3_MONTHS = 6;
    const PERIOD_6_MONTHS = 7;
    const PERIOD_AFTER_SPECIFIED_HOURS = 8;
    const PERIOD_AFTER_SPECIFIED_DAYS = 9;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'desc',
        'payment_period',
        'duration'
    ];

    /**
     * Get the Resources for the package.
     */
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    /**
     * Get the user wallet attribute.
     *
     * @return string
     */
    public function getFormattedDurationAttribute()
    {
        switch ($this->payment_period) {
            case self::PERIOD_HOURLY:
            case self::PERIOD_AFTER_SPECIFIED_HOURS:
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
    public function getFormattedPaymentPeriodAlt2Attribute()
    {
        return get_payment_period_name_alt2($this->payment_period, $this->duration);
    }
}
