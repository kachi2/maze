<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Plan
 *
 * @property int $id
 * @property int $package_id
 * @property string $name
 * @property float $min_deposit
 * @property float $max_deposit
 * @property int $profit_rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $formatted_name
 * @property-read string $formatted_profit_rate
 * @property-read \App\Models\Package $package
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereMaxDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereMinDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereProfitRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Plan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Plan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'profit_rate',
        'min_deposit',
        'max_deposit',
        'package_id',
    ];

    /**
     * The attributes casts.
     *
     * @var array
     */
    protected $casts = [
        'min_deposit' => 'double',
        'max_deposit' => 'double',
        'profit_rate' => 'double'
    ];

    /**
     * Get the Package for the resource.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the Resources for the package.
     */
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    /**
     * Get the active trades for the resource.
     */
    public function activeTrades()
    {
        return Deposit::wherePlanId($this->id)->where('expires_at', '>', Carbon::today());
    }

    /**
     * Get the user wallet attribute.
     *
     * @return string
     */
    public function getFormattedNameAttribute()
    {
        return $this->package->name . '(' . $this->profit_rate . '% ' . get_payment_period_name_alt2($this->package->payment_period, $this->package->duration) . ' For ' . $this->package->formatted_duration . ')';
    }

    /**
     * Get the user wallet attribute.
     *
     * @return string
     */
    public function getFormattedProfitRateAttribute()
    {
        return $this->profit_rate . '% ' . $this->package->getFormattedPaymentPeriodAltAttribute();
    }
}
