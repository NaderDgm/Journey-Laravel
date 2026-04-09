<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EnsureUserIsAdmin
{

    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user || $user->role !== 'admin') {
            abort(403, 'Accès refusé. Vous devez être administrateur.');
        }

        return $next($request);
    }
}