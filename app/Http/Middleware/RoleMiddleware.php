<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika user belum login, redirect ke login
        if (!Auth::check()) {
            return Redirect::route('login');
        }

        // Check role user
        $user = Auth::user();

        // List route yang hanya boleh diakses oleh admin
        $adminRoutes = [
            'admin.dashboard',
            'admin.users.index',
            'admin.users.create',
            'admin.users.edit',
            'admin.users.destroy',
            'admin.settings',
            'user-management',
        ];

        // List route yang hanya boleh diakses oleh admin atau user yang bersangkutan
        $restrictedRoutes = [
            'users.index',
            'users.create',
            'users.edit',
            'users.destroy',
        ];

        $currentRoute = $request->route()->getName();

        // Cek jika route memerlukan admin access
        if (in_array($currentRoute, $adminRoutes)) {
            if (!$user || !$user->isAdmin()) {
                abort(403, 'Unauthorized access. Admin only.');
            }
        }

        // Cek jika route memerlukan restricted access (hanya user yang bersangkutan atau admin)
        if (in_array($currentRoute, $restrictedRoutes)) {
            if (!$user || (!$user->isAdmin() && !$this->isOwnerOrAdmin($request, $user))) {
                abort(403, 'Unauthorized access. Owner or admin only.');
            }
        }

        return $next($request);
    }

    /**
     * Cek apakah user adalah owner dari resource atau admin
     */
    private function isOwnerOrAdmin(Request $request, $user)
    {
        // Untuk TautanController, cek ownership
        if ($request->route()->getName() === 'tautan.destroy') {
            $tautanId = $request->route('tautan');
            $tautan = \App\Models\Tautan::find($tautanId);

            if ($tautan && $tautan->user_id === $user->id) {
                return true;
            }
        }

        // Untuk EditTautanController, cek ownership
        if ($request->route()->getName() === 'tautan.update') {
            $tautanId = $request->route('tautan');
            $tautan = \App\Models\Tautan::find($tautanId);

            if ($tautan && $tautan->user_id === $user->id) {
                return true;
            }
        }

        // Untuk TautanController, cek ownership untuk store
        if ($request->route()->getName() === 'tautan.store') {
            return true; // User yang sudah login bisa buat tautan
        }

        return $user->isAdmin();
    }
}