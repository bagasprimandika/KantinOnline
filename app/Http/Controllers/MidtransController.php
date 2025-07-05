<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function pay($no_pesanan)
    {
        $pesanan = Pesanan::where('no_pesanan', $no_pesanan)->firstOrFail();

        // ⚡️ Atur konfigurasi Midtrans dari .env
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');

        // ⚡️ Buat payload transaksi
        $params = [
            'transaction_details' => [
                'order_id' => $pesanan->no_pesanan,
                'gross_amount' => $pesanan->total,
            ],
            'customer_details' => [
                'first_name' => $pesanan->user->name ?? 'Pelanggan',
                'email' => $pesanan->user->email ?? 'no_email@example.com',
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $pesanan->snap_token = $snapToken;

            $title = 'Pembayaran Midtrans';
            return view('main.payment_midtrans', compact('pesanan', 'snapToken', 'no_pesanan', 'title'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Gagal mendapatkan token pembayaran: ' . $e->getMessage()]);
        }
    }
}
