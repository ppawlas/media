<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ElectricityCharge
 *
 * @property int $id
 * @property int $user_id
 * @property string $applies_from
 * @property string $applies_to
 * @property float $component_c
 * @property float $component_ssvn
 * @property float $component_szvnk
 * @property float $component_sop
 * @property float $component_sosj
 * @property float $component_os
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityCharge whereAppliesFrom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityCharge whereAppliesTo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityCharge whereComponentC($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityCharge whereComponentOs($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityCharge whereComponentSop($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityCharge whereComponentSosj($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityCharge whereComponentSsvn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityCharge whereComponentSzvnk($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityCharge whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityCharge whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityCharge whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ElectricityCharge whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\User $user
 */
class ElectricityCharge extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'applies_from', 'applies_to', 'component_c', 'component_ssvn',
        'component_szvnk', 'component_sop', 'component_sosj', 'component_os'
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
}
