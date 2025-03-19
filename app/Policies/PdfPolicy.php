<?php

namespace App\Policies;

use App\Models\Pdf;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PdfPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('pdf.index');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Pdf $pdf): bool
    {
        return $user->hasPermission('pdf.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('pdf.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Pdf $pdf): bool
    {
        return $user->hasPermission('pdf.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pdf $pdf): bool
    {
        return $user->hasPermission('pdf.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pdf $pdf): bool
    {
        return $user->hasPermission('pdf.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pdf $pdf): bool
    {
        return $user->hasPermission('pdf.delete.force');
    }
}
