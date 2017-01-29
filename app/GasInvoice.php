<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\GasInvoice
 *
 * @property int $id
 * @property int $user_id
 * @property int $previous_id
 * @property string $date
 * @property float $state
 * @property bool $fixed_usage
 * @property float $usage
 * @property float $charge
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\GasInvoice whereCharge($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasInvoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasInvoice whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasInvoice whereFixedUsage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasInvoice whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasInvoice wherePreviousId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasInvoice whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasInvoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasInvoice whereUsage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasInvoice whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\GasInvoice $next
 * @property-read \App\GasInvoice $previous
 * @property-read \App\User $user
 */
class GasInvoice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'date', 'state', 'fixed_usage', 'usage', 'charge'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user', 'previous'
    ];

    /**
     * Get the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the previous invoice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function previous()
    {
        return $this->belongsTo('App\GasInvoice');
    }

    /**
     * Get the next invoice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function next()
    {
        return $this->hasOne('App\GasInvoice', 'previous_id');
    }
}
