<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User; // Laravel 7 default
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite; 

class BackpackGoogleController extends Controller
{
    /**
     * Redirect ke halaman login Google.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->scopes(['openid', 'email', 'profile'])
            ->redirect();
    }

    /**
     * Callback dari Google setelah user login.
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('backpack.auth.login')
                ->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }

        $email = $googleUser->getEmail();

        // Pastikan hanya email @polije.ac.id yang boleh
        if (! Str::endsWith($email, '@polije.ac.id')) {
            return redirect()->route('backpack.auth.login')
                ->with('error', 'Hanya akun @polije.ac.id yang diizinkan untuk login.');
        }

        // Cari user berdasarkan email
        $user = User::where('email', $email)->first();

        // Jika belum ada, otomatis buat user baru (opsional)
        if (! $user) {
            return redirect()->route('backpack.auth.login')
        ->with('error', 'Email Anda belum terdaftar sebagai admin.');

            // Kalau pakai Backpack PermissionManager, di sini bisa assign role admin
            // $user->assignRole('admin');
        }

        // Login-kan user ke guard Backpack
        $guard = config('backpack.base.guard');

        Auth::guard($guard)->login($user, true);

        // Redirect ke dashboard Backpack
        return redirect(backpack_url());
    }
}
