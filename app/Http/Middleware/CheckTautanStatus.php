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
        // Get the slug from the URL
        $slug = $request->route('slug');

        if (!$slug) {
            return $next($request);
        }

        // Find the tautan by slug (gunakan kolom yang ada)
        $tautan = Tautan::where('slug', $slug)->first();

        if (!$tautan) {
            // Tautan not found, let the 404 handler take care of it
            return $next($request);
        }

        // Check if tautan status is NOT active
        if ($tautan->status !== 'active') {
            // Simple return 404 using correct view path
            return response()->view('tautan.404', [], 404);
        }

        return $next($request);
    }
}
