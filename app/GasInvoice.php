<?php

namespace App;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;
use Log;
use Storage;

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
 * @property-read float $price
 * @property-read \App\GasInvoice $next
 * @property-read \App\GasInvoice $previous
 * @property-read \App\User $user
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
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'date', 'state', 'fixed_usage', 'usage', 'charge'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user', 'previous'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['price'];

    /**
     * Import gas invoices from the storage.
     *
     * @param User $user
     */
    public static function import(User $user)
    {
        Log::info('Attempt to import gas invoices for the user', ['user' => $user]);

        DB::transaction(function ($user) use ($user) {
            // delete previous invoices
            static::whereUserId($user->id)->delete();

            // get the contents from the storage
            $contents = Storage::disk('dump')->get(static::getDumpPath($user));

            // parse the contents and iterate over parsed items
            collect(explode(PHP_EOL, $contents))->map(function ($item) {
                return explode(',', trim($item));
            })->each(function ($item) use ($user) {
                $invoice = new static;
                $invoice->user_id = $user->id;
                $invoice->date = new Carbon($item[0]);
                $invoice->state = $item[1];
                $invoice->fixed_usage = $item[2] === 'true';
                $invoice->usage = $item[3] ? $item[3] : null;
                $invoice->charge = $item[4];
                $invoice->save();
            });
        });

        Log::info('Gas readings have been successfully imported for the user', ['user' => $user]);
    }

    /**
     * Save the gas invoices dump to the storage.
     *
     * @param User $user
     */
    public static function storeDump(User $user)
    {
        // generate the file contents
        $contents = join(PHP_EOL, static::whereUserId($user->id)->orderBy('id')->get()->map(function ($item) {
            return join(',', [$item->date, $item->state, $item->fixed_usage ? 'true' : 'false', $item->usage, $item->charge]);
        })->toArray());

        Log::info('Attempt to store the gas invoices dump for the user', ['user' => $user]);
        Storage::disk('dump')->put(static::getDumpPath($user), $contents);
    }

    /**
     * Get the path to gas invoices dump for the given user.
     *
     * @param User $user
     * @return string
     */
    public static function getDumpPath(User $user)
    {
        return 'gas-invoices/' . $user->id . '.csv';
    }

    /**
     * Get the gas invoices aggregates.
     *
     * @param User $user
     * @return array
     */
    public static function getAggregates(User $user)
    {
        $query = "
            SELECT
              year, cost, usage, round(cost / usage, 2) AS avg_price
            FROM (
                   SELECT
                     extract(YEAR FROM date) AS year,
                     sum(charge) AS cost,
                     sum(usage) AS usage
                   FROM gas_invoices
                   WHERE user_id = ?
                   GROUP BY extract(YEAR FROM date)
                   ORDER BY extract(YEAR FROM date) ASC
            ) AS aggregates
        ";

        return DB::select($query, [$user->id]);
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

    /**
     * Get the previous invoice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function previous()
    {
        return $this->belongsTo('App\GasInvoice');
    }

    /**
     * Get the next invoice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function next()
    {
        return $this->hasOne('App\GasInvoice', 'previous_id');
    }

    /**
     * Get price attribute.
     *
     * @return float
     */
    public function getPriceAttribute()
    {
        return $this->charge / $this->usage;
    }
}
