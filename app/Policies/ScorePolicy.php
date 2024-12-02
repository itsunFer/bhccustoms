<?php

namespace App\Policies;

use App\Models\Score;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ScorePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): response
    {
        return $user->is_admin==true
        ? Response::allow()
        : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Score $score): bool
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
    public function update(User $user, Score $score): response
    {
        return $user->id === $score->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can approve the changes.
     */
    public function approve(User $user, Score $score): response
    {
        return $user->is_admin==true
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Score $score): response
    {
        return $user->is_admin == true
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Score $score): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Score $score): bool
    {
        //
    }
}
