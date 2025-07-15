<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('order.index');
    }

    public function view(User $user, Order $order): bool
    {
        return ($order->txt->pdf->user_id === $user->id) || $user->can('viewAny', Order::class);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('order.create');
    }

    public function update(User $user, Order $order): bool
    {
        return $user->hasPermission('order.update') && $order->txt->pdf->user_id === $user->id;
    }

    public function delete(User $user, Order $order): bool
    {
        return $user->hasPermission('order.delete') && $order->txt->pdf->user_id === $user->id;
    }

    public function restore(User $user, Order $order): bool
    {
        return $user->hasPermission('order.restore') && $order->txt->pdf->user_id === $user->id;
    }

    public function forceDelete(User $user, Order $order): bool
    {
        return $user->hasPermission('order.delete.force') && $order->txt->pdf->user_id === $user->id;
    }
}