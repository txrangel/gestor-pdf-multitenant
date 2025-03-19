<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SessionDomainMiddleware
{
    /**
     * Manipula a requisição e define dinamicamente o domínio da sessão.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Obtém o domínio atual da requisição
        $domain = $request->getHost();

        // Define o SESSION_DOMAIN dinamicamente
        config(['session.domain' => '.' . $domain]);

        return $next($request);
    }
}