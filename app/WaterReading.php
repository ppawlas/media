<?php

namespace App;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Log;
use Storage;

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
 * @property-read mixed $daily
 * @property-read mixed $monthly_prediction
 * @property-read mixed $yearly_prediction
 * @property-read \App\WaterReading $next
 * @property-read \App\WaterReading $previous
 * @property-read \App\User $user
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
    use ReadingTrait;
    use DumpTrait;

    /**
     * Name of the backup file.
     *
     * @var string
     */
    protected static $fileName = 'water-readings';

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
    protected $appends = ['daily', 'monthly_prediction', 'yearly_prediction'];

    /**
     * Import water readings from the storage.
     *
     * @param User $user
     */
    public static function import(User $user)
    {
        Log::info('Attempt to import water readings for the user', ['user' => $user]);

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

        Log::info('Water readings have been successfully imported for the user', ['user' => $user]);
    }

    /**
     * Save the water readings dump to the storage.
     *
     * @param User $user
     */
    public static function storeDump(User $user)
    {
        // generate the file contents
        $contents = join(PHP_EOL, static::whereUserId($user->id)->orderBy('id')->get()->map(function ($item) {
            return join(',', [$item->date, $item->state, $item->fixed_usage ? 'true' : 'false', $item->usage]);
        })->toArray());

        Log::info('Attempt to store the water readings dump for the user', ['user' => $user]);
        Storage::disk('dump')->put(static::getDumpPath($user), $contents);
    }

    /**
     * Get average weekly water usage for each month.
     *
     * @param User $user
     * @return Collection
     */
    public static function getAggregates(User $user)
    {
        $readings = static::whereUserId($user->id)->orderBy('date')->get();

        return $readings->each(function ($reading) {
            $reading->key = substr($reading->date, 0, 7);
        })->groupBy('key')->map(function ($group) {
            /** @var Collection $group */
            return round($group->avg('daily') * 7, 2);
        });
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
        return $this->belongsTo('App\WaterReading');
    }

    /**
     * Get the next reading.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function next()
    {
        return $this->hasOne('App\WaterReading', 'previous_id');
    }

}
