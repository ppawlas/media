<?php

namespace App\Observers;

use App\WaterReading;
use Log;

class WaterReadingObserver
{
    /**
     * Listen to the WaterReading creating event.
     *
     * @param WaterReading $waterReading
     * @return bool
     */
    public function creating(WaterReading $waterReading)
    {
        Log::info('Attempt to create new water reading', ['attributes' => $waterReading->getAttributes()]);

        // get the user's last water reading
        $lastReading = $waterReading->user->waterReadings->last();

        // if there is any reading found
        if ($lastReading !== null) {
            // set the last user's reading as a previous reading
            $waterReading->previous_id = $lastReading->id;

            // check if the usage should be calculated
            if ($waterReading->fixed_usage !== true) {
                // usage is the difference of the current and last state
                $waterReading->usage = $waterReading->state - $lastReading->state;
            }
        }

        // confirm preserving object in the database
        return true;
    }

    /**
     * Listen to the WaterReading updating event.
     *
     * @param WaterReading $waterReading
     * @return bool
     */
    public function updating(WaterReading $waterReading)
    {
        // get the original object
        $original = $waterReading->getOriginal();

        Log::info('Attempt to update water reading', [
            'original' => $original,
            'updating' => $waterReading->getAttributes(),
        ]);

        // if the state has changed
        if ($waterReading->state !== $original['state']) {
            // if there is a next reading with not fixed usage, recalculate it
            if (($waterReading->next !== null) and ($waterReading->next->fixed_usage !== true)) {
                $waterReading->next->usage = $waterReading->next->state - $waterReading->state;
                // persist the changes in the next reading
                $waterReading->next->save();
            }
        }

        // if current reading has no fixed usage and usage has not been updated manually
        if (($waterReading->fixed_usage !== true) and ($waterReading->usage === $original['usage'])) {
            if ($waterReading->previous !== null) {
                // if there is a previous reading, recalculate the usage
                $waterReading->usage = $waterReading->state - $waterReading->previous->state;
            } else {
                // if there is no previous reading, nullify the usage
                $waterReading->usage = null;
            }
        }

        // confirm preserving changes in the database
        return true;
    }

    /**
     * Listen to the WaterReading deleting event.
     *
     * @param WaterReading $waterReading
     * @return bool
     */
    public function deleting(WaterReading $waterReading)
    {
        Log::info('Attempt to delete water reading', ['attributes' => $waterReading->getAttributes()]);

        if (($waterReading->next !== null) and ($waterReading->previous !== null)) {
            // if the next and the previous readings are defined, fill the gap
            $waterReading->next->previous_id = $waterReading->previous->id;
            // persist the changes in the next reading
            $waterReading->next->save();
        } else if (($waterReading->next !== null) and ($waterReading->previous === null)) {
            // if there is a next reading but no previous one, set the next as the first one
            $waterReading->next->previous_id = null;
            // persist the changes in the next reading
            $waterReading->next->save();
        }

        // confirm preserving changes in the database
        return true;
    }
}