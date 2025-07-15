<?php

namespace App\Policies;

use App\Models\Pdf;
use App\Models\User;

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
     * O usuário pode ver se for o dono OU se tiver a permissão para ver todos.
     */
    public function view(User $user, Pdf $pdf): bool
    {
        // Regra: O PDF pertence ao usuário? OU ele pode ver qualquer um?
        return ($pdf->user_id === $user->id) || $user->can('viewAny', Pdf::class);
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
     * Para atualizar, exigimos que ele tenha a permissão E seja o dono.
     */
    public function update(User $user, Pdf $pdf): bool
    {
        return $user->hasPermission('pdf.update') && $pdf->user_id === $user->id || $user->can('viewAny', Pdf::class);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Pdf $pdf): bool
    {
        return $user->hasPermission('pdf.delete') && $pdf->user_id === $user->id || $user->can('viewAny', Pdf::class);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Pdf $pdf): bool
    {
        return $user->hasPermission('pdf.restore') && $pdf->user_id === $user->id || $user->can('viewAny', Pdf::class);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Pdf $pdf): bool
    {
        return $user->hasPermission('pdf.delete.force') && $pdf->user_id === $user->id;
    }
}