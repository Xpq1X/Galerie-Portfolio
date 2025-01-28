<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Ensure the user is authenticated
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);  // If admin, continue the request
        }

        // If not an admin, redirect to home or any other page
        return redirect('/');
    }
}
