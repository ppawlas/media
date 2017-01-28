<?php

namespace App\Observers;

use App\ElectricityReading;
use Log;

class ElectricityReadingObserver
{
    /**
     * Listen to the ElectricityReading creating event.
     *
     * @param ElectricityReading $electricityReading
     * @return bool
     */
    public function creating(ElectricityReading $electricityReading)
    {
        Log::info('Attempt to create new electricity reading', ['attributes' => $electricityReading->getAttributes()]);

        // get the user's last electricity reading
        $lastReading = $electricityReading->user->electricityReadings->last();

        // if there is any reading found
        if ($lastReading !== null) {
            // set the last user's reading as a previous reading
            $electricityReading->previous_id = $lastReading->id;

            // check if the usage should be calculated
            if ($electricityReading->fixed_usage !== true) {
                // usage is the difference of the current and last state
                $electricityReading->usage = $electricityReading->state - $lastReading->state;
            }
        }

        // confirm preserving object in the database
        return true;
    }

    /**
     * Listen to the ElectricityReading updating event.
     *
     * @param ElectricityReading $electricityReading
     * @return bool
     */
    public function updating(ElectricityReading $electricityReading)
    {
        // get the original object
        $original = $electricityReading->getOriginal();

        Log::info('Attempt to update electricity reading', [
            'original' => $original,
            'updating' => $electricityReading->getAttributes(),
        ]);

        // if the state has changed
        if ($electricityReading->state !== $original['state']) {
            // if there is a next reading with not fixed usage, recalculate it
            if (($electricityReading->next !== null) and ($electricityReading->next->fixed_usage !== true)) {
                $electricityReading->next->usage = $electricityReading->next->state - $electricityReading->state;
                // persist the changes in the next reading
                $electricityReading->next->save();
            }
        }

        // if current reading has no fixed usage and usage has not been updated manually
        if (($electricityReading->fixed_usage !== true) and ($electricityReading->usage === $original['usage'])) {
            if ($electricityReading->previous !== null) {
                // if there is a previous reading, recalculate the usage
                $electricityReading->usage = $electricityReading->state - $electricityReading->previous->state;
            } else {
                // if there is no previous reading, nullify the usage
                $electricityReading->usage = null;
            }
        }

        // confirm preserving changes in the database
        return true;
    }

    /**
     * Listen to the ElectricityReading deleting event.
     *
     * @param ElectricityReading $electricityReading
     * @return bool
     */
    public function deleting(ElectricityReading $electricityReading)
    {
        Log::info('Attempt to delete electricity reading', ['attributes' => $electricityReading->getAttributes()]);

        if (($electricityReading->next !== null) and ($electricityReading->previous !== null)) {
            // if the next and the previous readings are defined, fill the gap
            $electricityReading->next->previous_id = $electricityReading->previous->id;
            // persist the changes in the next reading
            $electricityReading->next->save();
        } else if (($electricityReading->next !== null) and ($electricityReading->previous === null)) {
            // if there is a next reading but no previous one, set the next as the first one
            $electricityReading->next->previous_id = null;
            // persist the changes in the next reading
            $electricityReading->next->save();
        }

        // confirm preserving changes in the database
        return true;
    }
}