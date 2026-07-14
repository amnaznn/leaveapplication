<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check if the user is logged in AND is the admin email
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        // 2. Fallback: Block everyone else with a 403 Forbidden page
        abort(403, 'Unauthorized access.');
    }
}