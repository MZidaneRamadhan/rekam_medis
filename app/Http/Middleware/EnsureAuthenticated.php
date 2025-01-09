<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Sesi Anda telah habis. Silakan login kembali.');
        }

        return $next($request);
    }
}
