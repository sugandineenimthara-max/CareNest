<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Check if the account is pending/rejected
        if ($user->status === 'pending') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your registration is currently awaiting administrator approval.');
        }

        if ($user->status === 'rejected') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account has been deactivated.');
        }

        // Admin has super-user access to everything
        if ($user->role === 'provider' || $user->role === 'admin') {
            return $next($request);
        }

        // Check if user has the specific role
        if ($user->role !== $role) {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
