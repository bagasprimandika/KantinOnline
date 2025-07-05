<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Notification;
use App\Models\Pesanan;

class MidtransCallbackController extends Controller
{
    public function receive(Request $request)
    {
        $notif = new Notification();

        $status = $notif->transaction_status;
        $order_id = $notif->order_id;

        $pesanan = Pesanan::where('no_pesanan', $order_id)->first();
        if (!$pesanan) return response()->json(['message' => 'Order not found'], 404);

        // Ubah status berdasarkan status transaksi
        if (in_array($status, ['settlement', 'capture'])) {
            $pesanan->status = 2; // Lunas
        } elseif ($status == 'pending') {
            $pesanan->status = 1; // Menunggu
        } elseif (in_array($status, ['cancel', 'expire', 'failure'])) {
            $pesanan->status = 5; // Gagal / Batal
        }

        $pesanan->save();

        return response()->json(['message' => 'Callback processed'], 200);
    }
}
