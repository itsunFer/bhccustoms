<?php

namespace App\Policies;

use App\Models\Picture;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PicturePolicy
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
    public function view(User $user, Picture $picture): bool
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
    public function update(User $user, Picture $picture): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Picture $picture): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Picture $picture): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Picture $picture): bool
    {
        //
    }

    /**
     * Determine whether the user can approve the changes.
     */
    public function approve(User $user, Picture $picture): response
    {
        return $user->is_admin==true
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    public function watch(User $user): response
    {
        return $user->is_admin==true
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}
