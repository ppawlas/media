<?php

namespace App\Observers;

use App\GasReading;
use Log;

class GasReadingObserver
{
    /**
     * Listen to the GasReading creating event.
     *
     * @param GasReading $gasReading
     * @return bool
     */
    public function creating(GasReading $gasReading)
    {
        Log::info('Attempt to create new gas reading', ['attributes' => $gasReading->getAttributes()]);

        // get the user's last gas reading
        $lastReading = $gasReading->user->gasReadings->last();

        // if there is any reading found
        if ($lastReading !== null) {
            // set the last user's reading as a previous reading
            $gasReading->previous_id = $lastReading->id;

            // check if the usage should be calculated
            if ($gasReading->fixed_usage !== true) {
                // usage is the difference of the current and last state
                $gasReading->usage = $gasReading->state - $lastReading->state;
            }
        }

        // confirm preserving object in the database
        return true;
    }

    /**
     * Listen to the GasReading updating event.
     *
     * @param GasReading $gasReading
     * @return bool
     */
    public function updating(GasReading $gasReading)
    {
        // get the original object
        $original = $gasReading->getOriginal();

        Log::info('Attempt to update gas reading', [
            'original' => $original,
            'updating' => $gasReading->getAttributes(),
        ]);

        // if the state has changed
        if ($gasReading->state !== $original['state']) {
            // if there is a next reading with not fixed usage, recalculate it
            if (($gasReading->next !== null) and ($gasReading->next->fixed_usage !== true)) {
                $gasReading->next->usage = $gasReading->next->state - $gasReading->state;
                // persist the changes in the next reading
                $gasReading->next->save();
            }
        }

        // if current reading has no fixed usage and usage has not been updated manually
        if (($gasReading->fixed_usage !== true) and ($gasReading->usage === $original['usage'])) {
            if ($gasReading->previous !== null) {
                // if there is a previous reading, recalculate the usage
                $gasReading->usage = $gasReading->state - $gasReading->previous->state;
            } else {
                // if there is no previous reading, nullify the usage
                $gasReading->usage = null;
            }
        }

        // confirm preserving changes in the database
        return true;
    }

    /**
     * Listen to the GasReading deleting event.
     *
     * @param GasReading $gasReading
     * @return bool
     */
    public function deleting(GasReading $gasReading)
    {
        Log::info('Attempt to delete gas reading', ['attributes' => $gasReading->getAttributes()]);

        if (($gasReading->next !== null) and ($gasReading->previous !== null)) {
            // if the next and the previous readings are defined, fill the gap
            $gasReading->next->previous_id = $gasReading->previous->id;
            // persist the changes in the next reading
            $gasReading->next->save();
        } else if (($gasReading->next !== null) and ($gasReading->previous === null)) {
            // if there is a next reading but no previous one, set the next as the first one
            $gasReading->next->previous_id = null;
            // persist the changes in the next reading
            $gasReading->next->save();
        }

        // confirm preserving changes in the database
        return true;
    }
}