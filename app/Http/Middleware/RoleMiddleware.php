<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (Auth::check() && in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        return redirect('/login')->withErrors(['access' => 'Unauthorized access!']);
    }
}
