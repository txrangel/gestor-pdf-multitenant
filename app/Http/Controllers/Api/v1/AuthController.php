<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\ApiTokenAudit;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\NewAccessToken;

class AuthController extends Controller
{
    /**
     * Cria um novo token de acesso para o usuário
     */
    public function createToken(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required|string|max:255',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            // Registrar tentativa falha
            ApiTokenAudit::create([
                'user_id' => $user?->id ?? 0,
                'token_id' => 0,
                'action' => 'login_failed',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'device_name' => $request->device_name,
            ]);
            
            throw ValidationException::withMessages([
                'email' => ['Credenciais inválidas'],
            ]);
        }

        if (!$user->can('viewAny', Order::class)) {
            // Registrar tentativa sem permissão
            ApiTokenAudit::log($user, (object)[
                'id' => 0,
                'name' => $request->device_name,
                'expires_at' => null
            ], 'permission_denied', $request);
            
            return response()->json([
                'error' => 'Usuário não tem permissão para acessar pedidos'
            ], 403);
        }

        $user->tokens()->where('name', $request->device_name)->delete();

        $token = $user->createToken(
            $request->device_name,
            ['orders:read'],
            now()->addDays(30)
        );

        // Registrar criação do token
        ApiTokenAudit::log($user, $token->accessToken, 'create', $request);

        return response()->json([
            'token_type' => 'Bearer',
            'access_token' => $token->plainTextToken,
            'expires_at' => $token->accessToken->expires_at->toDateTimeString(),
        ]);
    }

    public function renewToken(Request $request): JsonResponse
    {
        $request->validate([
            'device_name' => 'required|string|max:255',
        ]);

        $user = $request->user();
        $currentToken = $user->currentAccessToken();

        if ($currentToken && $currentToken->expires_at && $currentToken->expires_at->isFuture()) {
            return response()->json([
                'error' => 'Token ainda não expirado'
            ], 400);
        }

        // Registrar tentativa de renovação
        ApiTokenAudit::log($user, $currentToken, 'renew_attempt', $request);

        $user->tokens()->where('id', $currentToken->id)->delete();

        $newToken = $user->createToken(
            $request->device_name,
            ['orders:read'],
            now()->addDays(30)
        );

        // Registrar renovação bem-sucedida
        ApiTokenAudit::log($user, $newToken->accessToken, 'renew', $request);

        return response()->json([
            'token_type' => 'Bearer',
            'access_token' => $newToken->plainTextToken,
            'expires_at' => $newToken->accessToken->expires_at->toDateTimeString(),
        ]);
    }

    /**
     * Revoga todos os tokens do usuário
     */
    public function revokeTokens(Request $request): JsonResponse
    {
        $user = $request->user();
        $tokens = $user->tokens()->get();

        // Registrar cada token revogado
        foreach ($tokens as $token) {
            ApiTokenAudit::log($user, $token, 'revoke', $request);
        }

        $user->tokens()->delete();

        return response()->json([
            'message' => "Todos os {$tokens->count()} tokens foram revogados com sucesso"
        ]);
    }

    public function listTokens(Request $request): JsonResponse
    {
        $user = $request->user();
        
        $tokens = $user->tokens()
            ->with(['audits' => function($query) {
                $query->latest()->take(3);
            }])
            ->select(['id', 'name', 'last_used_at', 'expires_at', 'created_at'])
            ->get();

        return response()->json([
            'data' => $tokens,
            'meta' => [
                'total' => $tokens->count(),
                'active' => $tokens->filter(fn($token) => !$token->expires_at || $token->expires_at->isFuture())->count(),
            ]
        ]);
    }

    public function listAudits(Request $request): JsonResponse
    {
        $audits = $request->user()->tokenAudits()
            ->latest()
            ->paginate(20);

        return response()->json($audits);
    }

    public function tokenAudits(Request $request, $tokenId): JsonResponse
    {
        $audits = $request->user()->tokenAudits()
            ->where('token_id', $tokenId)
            ->latest()
            ->paginate(20);

        return response()->json($audits);
    }

    /**
     * Retorna informações do usuário autenticado
     */
    public function user(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}