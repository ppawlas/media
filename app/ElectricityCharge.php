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
 */
class ElectricityCharge extends Model
{
    //
}
