<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Check if user exists
        if (!$user) {
            return $next($request);
        }

        // Check user status
        switch ($user->status) {
            case 'active':
                // User can access normally
                return $next($request);

            case 'inactive':
                // Log out the user and show message
                if (Auth::guard('web')->check()) {
                    Auth::guard('web')->logout();
                }

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // Redirect to login with error message
                return redirect()->route('login')
                    ->with('error', 'Akun Anda telah dinonaktifkan. Silakan hubungi administrator untuk aktivasi kembali.');

            case 'disabled':
                // Log out the user and show message
                if (Auth::guard('web')->check()) {
                    Auth::guard('web')->logout();
                }

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // Redirect to login with error message
                return redirect()->route('login')
                    ->with('error', 'Akun Anda telah dinonaktifkan permanen. Silakan hubungi administrator.');

            default:
                // Unknown status, treat as inactive
                if (Auth::guard('web')->check()) {
                    Auth::guard('web')->logout();
                }

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')
                    ->with('error', 'Status akun Anda tidak valid. Silakan hubungi administrator.');
        }
    }
}