<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsTeacher
{

    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user || $user->role !== 'teacher') {
            abort(403, 'Accès refusé. Vous devez être un formateur.');
        }

        return $next($request);
    }
}