<?php

namespace App\Policies;

use App\Models\Txt;
use App\Models\User;

class TxtPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('txt.index');
    }

    public function view(User $user, Txt $txt): bool
    {
        // Regra: O PDF pai do TXT pertence ao usuário? OU ele pode ver qualquer um?
        return ($txt->pdf->user_id === $user->id) || $user->can('viewAny', Txt::class);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('txt.create');
    }

    public function update(User $user, Txt $txt): bool
    {
        return $user->hasPermission('txt.update') && $txt->pdf->user_id === $user->id || $user->can('viewAny', Txt::class);
    }

    public function delete(User $user, Txt $txt): bool
    {
        return $user->hasPermission('txt.delete') && $txt->pdf->user_id === $user->id || $user->can('viewAny', Txt::class);
    }

    public function restore(User $user, Txt $txt): bool
    {
        return $user->hasPermission('txt.restore') && $txt->pdf->user_id === $user->id || $user->can('viewAny', Txt::class);
    }

    public function forceDelete(User $user, Txt $txt): bool
    {
        return $user->hasPermission('txt.delete.force') && $txt->pdf->user_id === $user->id;
    }
}