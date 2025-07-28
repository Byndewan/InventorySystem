<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DoubleAuth
{
    public function handle(Request $request, Closure $next)
    {
        // First check
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Second check
        if (Auth::user()->status !== 'active') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is not active.');
        }

        return $next($request);
    }
}
