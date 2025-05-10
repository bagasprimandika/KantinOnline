<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user(); //  Tanpa stateless() di production

            // Cek user berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();

            // Jika user tidak ditemukan, buat user baru
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(Str::random(40)), // Password random
                ]);
            }

            // Login user
            Auth::login($user);

            return redirect()->route('home'); // Arahkan setelah login

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login dengan Google gagal.');
        }
    }
}