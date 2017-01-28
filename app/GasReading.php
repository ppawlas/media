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
 */
class GasReading extends Model
{
    //
}
