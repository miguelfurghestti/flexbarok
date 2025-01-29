<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsShop
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário está autenticado e é shop
        if (Auth::check() && Auth::user()->level === 1) {
            return $next($request); // Permite o acesso
        }

        // Redireciona se não for shop
        return redirect()->route('login')->withErrors(['access' => 'Acesso não autorizado.']);
    }
}
