<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        // Jika request bukan untuk halaman utama dan bukan JSON
        if (!$request->expectsJson() && !$request->is('/') && !$request->is('login')) {
            return route('login');
        }
    }
}
