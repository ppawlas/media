<?php

namespace App;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;
use Log;
use Storage;

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
 * @property-read \App\GasReading $next
 * @property-read \App\GasReading $previous
 * @property-read \App\User $user
 */
class GasReading extends Model
{
    use ReadingTrait;

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
        'user', 'previous'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['daily', 'monthly_prediction'];

    /**
     * Import gas readings from the storage.
     *
     * @param User $user
     */
    public static function import(User $user)
    {
        Log::info('Attempt to import gas readings for the user', ['user' => $user]);

        DB::transaction(function ($user) use ($user) {
            // delete previous readings
            static::whereUserId($user->id)->delete();

            // get the contents from the storage
            $contents = Storage::disk('dump')->get(static::getDumpPath($user));

            // parse the contents and iterate over parsed items
            collect(explode(PHP_EOL, $contents))->map(function ($item) {
                return explode(',', trim($item));
            })->each(function ($item) use ($user) {
                $reading = new static;
                $reading->user_id = $user->id;
                $reading->date = new Carbon($item[0]);
                $reading->state = $item[1];
                $reading->fixed_usage = $item[2] === 'true';
                $reading->usage = $item[3] ? $item[3] : null;
                $reading->save();
            });
        });

        Log::info('Gas readings have been successfully imported for the user', ['user' => $user]);
    }

    /**
     * Save the gas readings dump to the storage.
     *
     * @param User $user
     */
    public static function storeDump(User $user)
    {
        // generate the file contents
        $contents = join(PHP_EOL, static::whereUserId($user->id)->orderBy('id')->get()->map(function ($item) {
            return join(',', [$item->date, $item->state, $item->fixed_usage ? 'true' : 'false', $item->usage]);
        })->toArray());

        Log::info('Attempt to store the gas readings dump for the user', ['user' => $user]);
        Storage::disk('dump')->put(static::getDumpPath($user), $contents);
    }

    /**
     * Get the path to gas readings dump for the given user.
     *
     * @param User $user
     * @return string
     */
    public static function getDumpPath(User $user)
    {
        return 'gas-readings/' . $user->id . '.csv';
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
     * Get the previous reading.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function previous()
    {
        return $this->belongsTo('App\GasReading');
    }

    /**
     * Get the next reading.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function next()
    {
        return $this->hasOne('App\GasReading', 'previous_id');
    }
}
