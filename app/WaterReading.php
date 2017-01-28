<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\WaterReading
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
 * @method static \Illuminate\Database\Query\Builder|\App\WaterReading whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WaterReading whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WaterReading whereFixedUsage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WaterReading whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WaterReading wherePreviousId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WaterReading whereState($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WaterReading whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WaterReading whereUsage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\WaterReading whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\WaterReading $next
 * @property-read \App\WaterReading $previous
 * @property-read \App\User $user
 */
class WaterReading extends Model
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
        return $this->belongsTo('App\WaterReading');
    }

    /**
     * Get the next reading.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function next()
    {
        return $this->hasOne('App\WaterReading', 'previous_id');
    }
}
