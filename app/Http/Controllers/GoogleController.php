<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    /**
     * Redirect ke Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback dari Google
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cari user berdasarkan google_id
            $user = User::where('google_id', $googleUser->getId())->first();

            if ($user) {
                // User sudah ada, cek status
                if ($user->status === 'active') {
                    Auth::login($user);
                    return redirect()->intended('/dashboard');
                } else {
                    // User tidak aktif, redirect ke login dengan error
                    $statusText = $user->status === 'inactive' ? 'dinonaktifkan' : 'dinonaktifkan permanen';
                    return redirect()->route('login')
                        ->with('error', 'Akun Anda telah ' . $statusText . '. Silakan hubungi administrator untuk akses kembali.');
                }
            } else {
                // Cek apakah email sudah terdaftar
                $existingUser = User::where('email', $googleUser->getEmail())->first();

                if ($existingUser) {
                    // Link akun Google ke user yang sudah ada, tapi cek status dulu
                    if ($existingUser->status === 'active') {
                        $existingUser->google_id = $googleUser->getId();
                        $existingUser->avatar = $googleUser->getAvatar();
                        $existingUser->save();
                        Auth::login($existingUser);
                        return redirect()->intended('/dashboard');
                    } else {
                        // User tidak aktif, redirect ke login dengan error
                        $statusText = $existingUser->status === 'inactive' ? 'dinonaktifkan' : 'dinonaktifkan permanen';
                        return redirect()->route('login')
                            ->with('error', 'Akun Anda telah ' . $statusText . '. Silakan hubungi administrator untuk akses kembali.');
                    }
                } else {
                    // Buat user baru (default status = active)
                    $newUser = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                        'password' => bcrypt(Str::random(24)), // Random password
                        'email_verified_at' => now(),
                        'status' => 'active', // New users default to active
                    ]);

                    Auth::login($newUser);
                    return redirect()->intended('/dashboard');
                }
            }

        } catch (\Exception $e) {
            // Log error dan redirect dengan pesan
            \Log::error('Google OAuth Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login dengan Google. Silakan coba lagi.');
        }
    }
}
