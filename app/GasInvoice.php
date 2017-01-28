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
 */
class GasInvoice extends Model
{
    //
}
