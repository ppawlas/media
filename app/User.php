<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $password
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\ElectricityCharge $electricityCharge
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ElectricityReading[] $electricityReadings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\GasInvoice[] $gasInvoices
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\GasReading[] $gasReadings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\WaterReading[] $waterReadings
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the user's water readings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function waterReadings()
    {
        return $this->hasMany('App\WaterReading');
    }

    /**
     * Get the user's gas readings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gasReadings()
    {
        return $this->hasMany('App\GasReading');
    }

    /**
     * Get the user's gas invoices.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gasInvoices()
    {
        return $this->hasMany('App\GasInvoice');
    }

    /**
     * Get the user's electricity charge.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function electricityCharge()
    {
        return $this->hasOne('App\ElectricityCharge');
    }

    /**
     * Get the user's electricity readings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function electricityReadings()
    {
        return $this->hasMany('App\ElectricityReading');
    }
}
