<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Ensure that the authenticated user can access only his own resources.
     *
     * @param User $authenticatedUser
     * @param User $user
     * @return bool
     */
    public function access(User $authenticatedUser, User $user)
    {
        return $authenticatedUser->id === $user->id;
    }
}
