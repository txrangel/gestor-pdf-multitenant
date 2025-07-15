<?php

namespace App\Policies;

use App\Models\OrderItem;
use App\Models\User;

class OrderItemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('order.index');
    }

    public function view(User $user, OrderItem $orderItem): bool
    {
        return ($orderItem->order->txt->pdf->user_id === $user->id) || $user->can('viewAny', OrderItem::class);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('order.create');
    }

    public function update(User $user, OrderItem $orderItem): bool
    {
        return $user->hasPermission('order.update') && $orderItem->order->txt->pdf->user_id === $user->id;
    }

    public function delete(User $user, OrderItem $orderItem): bool
    {
        return $user->hasPermission('order.delete') && $orderItem->order->txt->pdf->user_id === $user->id;
    }

    public function restore(User $user, OrderItem $orderItem): bool
    {
        return $user->hasPermission('order.restore') && $orderItem->order->txt->pdf->user_id === $user->id;
    }

    public function forceDelete(User $user, OrderItem $orderItem): bool
    {
        return $user->hasPermission('order.delete.force') && $orderItem->order->txt->pdf->user_id === $user->id;
    }
}