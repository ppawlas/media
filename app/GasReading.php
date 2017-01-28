<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\GasReading
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
 * @method static \Illuminate\Database\Query\Builder|\App\GasReading whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasReading whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasReading whereFixedUsage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasReading whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasReading wherePreviousId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasReading whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasReading whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasReading whereUsage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GasReading whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\GasReading $next
 * @property-read \App\GasReading $previous
 * @property-read \App\User $user
 */
class GasReading extends Model
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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user',
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
        return $this->belongsTo('App\GasReading');
    }

    /**
     * Get the next reading.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function next()
    {
        return $this->hasOne('App\GasReading', 'previous_id');
    }
}
