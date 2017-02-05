<?php

namespace App;

use Storage;

trait DumpTrait
{
    /**
     * Get the path to the dump file for the given user.
     * If there is no dump directory for the user, create it.
     *
     * @param User $user
     * @return string
     */
    public static function getDumpPath(User $user)
    {
        // if there is no dump directory for the user, create it
        if (!Storage::disk('dump')->exists($user->id)) {
            Storage::disk('dump')->makeDirectory($user->id);
        };

        return $user->id . '/' . static::$fileName . '.csv';
    }
}