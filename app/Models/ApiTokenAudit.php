<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

class ApiTokenAudit extends Model
{
    protected $fillable = [
        'user_id',
        'token_id',
        'action',
        'ip_address',
        'user_agent',
        'device_name',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function token(): BelongsTo
    {
        return $this->belongsTo(PersonalAccessToken::class, 'token_id');
    }

    public static function log($user, $token, $action, $request): self
    {
        return self::create([
            'user_id' => $user->id,
            'token_id' => $token->id,
            'action' => $action,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'device_name' => $token->name,
            'expires_at' => $token->expires_at,
        ]);
    }

    // Escopos para consultas comuns
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeForToken($query, $tokenId)
    {
        return $query->where('token_id', $tokenId);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopeAction($query, $action)
    {
        return $query->where('action', $action);
    }
}