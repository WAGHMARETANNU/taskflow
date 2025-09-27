<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Check if admin session exists
        if (!session()->has('admin')) {
            return redirect()->route('signin')->with('error', 'Please login as admin to access this area.');
        }
        
        return $next($request);
    }
}
