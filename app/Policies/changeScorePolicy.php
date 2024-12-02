<?php

namespace App\Policies;

use App\Models\User;
use App\Models\changeScore;
use Illuminate\Auth\Access\Response;

class changeScorePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin==true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, changeScore $changeScore): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, changeScore $changeScore): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, changeScore $changeScore): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, changeScore $changeScore): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, changeScore $changeScore): bool
    {
        //
    }

    /**
     * Determine whether the user can approve the changes.
     */
    public function approve(User $user, changeScore $changeScore): response
    {
        return $user->is_admin==true
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}
