<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\DetPesanan;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Kirim totalCart ke header_shop
        View::composer('partials.header_shop', function ($view) {
            $totalCart = 0;
            if (Auth::check()) {
                $userId = Auth::id();
                $totalCart = DetPesanan::whereHas('pesanan', function ($q) use ($userId) {
                    $q->where('user_id', $userId)->where('status', 'unpaid');
                })->count();
            }
            $view->with('totalCart', $totalCart);
        });
    }

    public function register(): void
    {
        //
    }
}
