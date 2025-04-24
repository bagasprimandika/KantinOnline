<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Cari user berdasarkan email
        $user = User::where('email', $googleUser->getEmail())->first();

        // Kalau belum ada, bikin baru
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt('google_login'), // Atau random string
            ]);
        }

        Auth::login($user);

        return redirect('/home'); // Arahkan ke halaman setelah login
    }
}
