<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Tautan;

class CheckTautanStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the short code from the URL
        $shortCode = $request->route('short_code');

        if (!$shortCode) {
            return $next($request);
        }

        // Find the tautan by short code
        $tautan = Tautan::where('short_code', $shortCode)->first();

        if (!$tautan) {
            // Tautan not found, let the 404 handler take care of it
            return $next($request);
        }

        // Check if tautan is active
        if ($tautan->status !== 'active') {
            // Check if user is also inactive
            $userStatus = $tautan->user ? $tautan->user->status : 'unknown';

            if ($userStatus === 'inactive') {
                return response()->view('errors.link-inactive', [
                    'message' => 'Link ini tidak aktif karena pemilik akun telah dinonaktifkan.',
                    'reason' => 'user_inactive'
                ], 404);
            } elseif ($userStatus === 'disabled') {
                return response()->view('errors.link-inactive', [
                    'message' => 'Link ini tidak aktif karena pemilik akun telah dinonaktifkan permanen.',
                    'reason' => 'user_disabled'
                ], 404);
            } else {
                return response()->view('errors.link-inactive', [
                    'message' => 'Link ini tidak aktif. Silakan hubungi pemilik link.',
                    'reason' => 'link_inactive'
                ], 404);
            }
        }

        // Check if user is active
        if ($tautan->user && $tautan->user->status !== 'active') {
            if ($tautan->user->status === 'inactive') {
                return response()->view('errors.link-inactive', [
                    'message' => 'Link ini tidak aktif karena pemilik akun telah dinonaktifkan.',
                    'reason' => 'user_inactive'
                ], 404);
            } elseif ($tautan->user->status === 'disabled') {
                return response()->view('errors.link-inactive', [
                    'message' => 'Link ini tidak aktif karena pemilik akun telah dinonaktifkan permanen.',
                    'reason' => 'user_disabled'
                ], 404);
            }
        }

        return $next($request);
    }
}
