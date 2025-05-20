<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Jika user sudah login dan mencoba mengakses halaman login
        if (Auth::guard($guard)->check() && $request->is('login')) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
