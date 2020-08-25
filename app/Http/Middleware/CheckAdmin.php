<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $tipoUsuarioId = Auth::user()->tipoUsuarioId;

        if ($tipoUsuarioId == 1) {
            return $next($request);
        }else {
            return redirect()->route('home')->with('error', 'Você não term permissão para acessar esse conteúdo');
        }
    }
}
