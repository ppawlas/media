<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ElectricityCharge
 *
 * @property int $id
 * @property int $user_id
 * @property float $component_c
 * @property float $component_ssvn
 * @property float $component_szvnk
 * @property float $component_sop
 * @property float $component_sosj
 * @property float $component_os
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
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
 */
class ElectricityCharge extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'component_c', 'component_ssvn', 'component_szvnk', 'component_sop', 'component_sosj', 'component_os'
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
     * Get the user's electricity charge.
     * If there is none, create it.
     *
     * @param User $user
     * @return ElectricityCharge|static
     */
    public static function get(User $user)
    {
        // attempt to get the user's electricity charge
        $electricityCharge = $user->electricityCharge;

        // if there is no electricity charge yet, create it with default parameters
        if ($electricityCharge === null) {
            $electricityCharge = ElectricityCharge::create(['user_id' => $user->id]);
        }

        return $electricityCharge;
    }

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
