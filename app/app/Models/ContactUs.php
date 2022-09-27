<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ContactUs
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContactUs whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ContactUs extends Model
{
    public $table = 'contact_us';

    public $fillable = [
        'name',
        'email',
        'message'
    ];
}
