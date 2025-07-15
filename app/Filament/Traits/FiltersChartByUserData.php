<?php

namespace App\Filament\Traits;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait FiltersChartByUserData
{
    /**
     * Aplica um filtro na consulta para mostrar apenas os dados do usuário logado,
     * a menos que ele tenha permissão para ver todos os registros.
     *
     * @param Builder $query
     * @return Builder
     */
    protected function applyUserFilter(Builder $query): Builder
    {
        $user = Auth::user();
        $model = $query->getModel();

        // Se o usuário pode ver todos os registros, não aplica nenhum filtro.
        if ($user->can('viewAny', get_class($model))) {
            return $query;
        }

        // Aplica o filtro de propriedade baseado no tipo de modelo.
        if ($model instanceof Order) {
            // Filtra Orders cujo Txt->Pdf pertence ao usuário.
            return $query->whereHas('txt.pdf', fn (Builder $q) => $q->where('user_id', $user->id));
        }

        if ($model instanceof OrderItem) {
            // Filtra OrderItems cujo Order->Txt->Pdf pertence ao usuário.
            return $query->whereHas('order.txt.pdf', fn (Builder $q) => $q->where('user_id', $user->id));
        }

        // Se o modelo não for reconhecido, retorna a consulta original por segurança.
        return $query;
    }
}