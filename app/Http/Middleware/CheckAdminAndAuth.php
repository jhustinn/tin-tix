<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminAndAuth
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
        // Check if the user is authenticated
        if (!Auth::check()) {
            // If not authenticated, redirect to login page
            return redirect()->route('home')->with('error', 'Oops! Please Login.');
        }

        // Check if the user is an admin
        if (!Auth::user()->isAdmin()) {
            // If not an admin, return a 403 Forbidden response
            return redirect()->route('home')->with('error', 'Oops! Not Your Area.');

        }

        // If the user is authenticated and an admin, proceed with the request
        return $next($request);
    }
}
