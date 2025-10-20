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
                // User sudah ada, login langsung
                Auth::login($user);
                return redirect()->intended('/dashboard');
            } else {
                // Cek apakah email sudah terdaftar
                $existingUser = User::where('email', $googleUser->getEmail())->first();

                if ($existingUser) {
                    // Link akun Google ke user yang sudah ada
                    $existingUser->google_id = $googleUser->getId();
                    $existingUser->avatar = $googleUser->getAvatar();
                    $existingUser->save();
                    Auth::login($existingUser);
                    return redirect()->intended('/dashboard');
                } else {
                    // Buat user baru
                    $newUser = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                        'password' => bcrypt(Str::random(24)), // Random password
                        'email_verified_at' => now(),
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
