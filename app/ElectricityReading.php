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
 */
class ElectricityReading extends Model
{
    //
}
