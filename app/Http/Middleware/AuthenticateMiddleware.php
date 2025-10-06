<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if ($request->wantsJson() && !$request->user()) {
            return response()->json(['error' => 'Não autenticado'], 401);
        }

        if (!$request->wantsJson() && !$request->user()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
