<?php

namespace App\Observers;

use App\GasInvoice;
use Log;

class GasInvoiceObserver
{
    /**
     * Listen to the GasInvoice creating event.
     *
     * @param GasInvoice $gasInvoice
     * @return bool
     */
    public function creating(GasInvoice $gasInvoice)
    {
        Log::info('Attempt to create new gas invoice', ['attributes' => $gasInvoice->getAttributes()]);

        // get the user's last gas invoice
        $lastInvoice = $gasInvoice->user->gasInvoices->last();

        // if there is any invoice found
        if ($lastInvoice !== null) {
            // set the last user's invoice as a previous invoice
            $gasInvoice->previous_id = $lastInvoice->id;

            // check if the usage should be calculated
            if ($gasInvoice->fixed_usage !== true) {
                // usage is the difference of the current and last state
                $gasInvoice->usage = $gasInvoice->state - $lastInvoice->state;
            }
        }

        // confirm preserving object in the database
        return true;
    }

    /**
     * Listen to the GasInvoice updating event.
     *
     * @param GasInvoice $gasInvoice
     * @return bool
     */
    public function updating(GasInvoice $gasInvoice)
    {
        // get the original object
        $original = $gasInvoice->getOriginal();

        Log::info('Attempt to update gas invoice', [
            'original' => $original,
            'updating' => $gasInvoice->getAttributes(),
        ]);

        // if the state has changed
        if ($gasInvoice->state !== $original['state']) {
            // if there is a next invoice with not fixed usage, recalculate it
            if (($gasInvoice->next !== null) and ($gasInvoice->next->fixed_usage !== true)) {
                $gasInvoice->next->usage = $gasInvoice->next->state - $gasInvoice->state;
                // persist the changes in the next invoice
                $gasInvoice->next->save();
            }
        }

        // if current invoice has no fixed usage and usage has not been updated manually
        if (($gasInvoice->fixed_usage !== true) and ($gasInvoice->usage === $original['usage'])) {
            if ($gasInvoice->previous !== null) {
                // if there is a previous invoice, recalculate the usage
                $gasInvoice->usage = $gasInvoice->state - $gasInvoice->previous->state;
            } else {
                // if there is no previous invoice, nullify the usage
                $gasInvoice->usage = null;
            }
        }

        // confirm preserving changes in the database
        return true;
    }

    /**
     * Listen to the GasInvoice deleting event.
     *
     * @param GasInvoice $gasInvoice
     * @return bool
     */
    public function deleting(GasInvoice $gasInvoice)
    {
        Log::info('Attempt to delete gas invoice', ['attributes' => $gasInvoice->getAttributes()]);

        if (($gasInvoice->next !== null) and ($gasInvoice->previous !== null)) {
            // if the next and the previous invoices are defined, fill the gap
            $gasInvoice->next->previous_id = $gasInvoice->previous->id;
            // persist the changes in the next invoice
            $gasInvoice->next->save();
        } else if (($gasInvoice->next !== null) and ($gasInvoice->previous === null)) {
            // if there is a next invoice but no previous one, set the next as the first one
            $gasInvoice->next->previous_id = null;
            // persist the changes in the next invoice
            $gasInvoice->next->save();
        }

        // confirm preserving changes in the database
        return true;
    }
}