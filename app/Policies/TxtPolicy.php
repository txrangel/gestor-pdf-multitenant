<?php

namespace App\Policies;

use App\Models\Txt;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TxtPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('txt.index');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Txt $txt): bool
    {
        return $user->hasPermission('txt.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('txt.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Txt $txt): bool
    {
        return $user->hasPermission('txt.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Txt $txt): bool
    {
        return $user->hasPermission('txt.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Txt $txt): bool
    {
        return $user->hasPermission('txt.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Txt $txt): bool
    {
        return $user->hasPermission('txt.delete.force');
    }
}
