<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsStudent
{

    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user || $user->role !== 'student') {
            abort(403, 'Accès refusé. Vous devez être un stagiaire.');
        }

        return $next($request);
    }
}