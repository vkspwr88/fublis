<?php

namespace App\Policies;

use App\Models\MediaKit;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MediaKitPolicy
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
    public function view(User $user, MediaKit $mediaKit): bool
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
    public function update(User $user, MediaKit $mediaKit): bool
    {
        return $user->id === $mediaKit->architect->user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MediaKit $mediaKit): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MediaKit $mediaKit): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MediaKit $mediaKit): bool
    {
        //
    }
}
