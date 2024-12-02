<?php

namespace App\Policies;

use App\Models\Gimnasta;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GimnastaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Gimnasta $gimnasta): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): response
    {
        return $user->is_admin == true
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Gimnasta $gimnasta): response
    {
        return $user->is_admin == true
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Gimnasta $gimnasta): response
    {
        return $user->is_admin == true
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Gimnasta $gimnasta): response
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Gimnasta $gimnasta): bool
    {
        //
    }
}
