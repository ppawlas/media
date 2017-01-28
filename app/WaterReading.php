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
 */
class WaterReading extends Model
{
    //
}
