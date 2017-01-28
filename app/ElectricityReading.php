<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ElectricityReading
 *
 * @property int $id
 * @property int $user_id
 * @property int $previous_id
 * @property string $date
 * @property float $state
 * @property bool $fixed_usage
 * @property float $usage
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityReading whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityReading whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityReading whereFixedUsage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityReading whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityReading wherePreviousId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityReading whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityReading whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityReading whereUsage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityReading whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\ElectricityReading $next
 * @property-read \App\ElectricityReading $previous
 * @property-read \App\User $user
 */
class ElectricityReading extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'date', 'state', 'fixed_usage', 'usage'
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
     * Get the previous reading.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function previous()
    {
        return $this->belongsTo('App\ElectricityReading');
    }

    /**
     * Get the next reading.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function next()
    {
        return $this->hasOne('App\ElectricityReading', 'previous_id');
    }
}
