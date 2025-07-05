@extends('layouts.shop')
@section('content')
    <div class="container mt-5">
        <h2>Bayar Pesanan {{ $pesanan->no_pesanan }}</h2>
        <p>Total: Rp. {{ number_format($pesanan->total, 0, ',', '.') }}</p>

        <button id="pay-button" class="btn site-btn mt-3">Bayar Sekarang</button>
    </div>

    <!-- Midtrans JS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script>
        document.getElementById('pay-button').addEventListener('click', function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Pembayaran Berhasil!");
                    window.location.href = "{{ route('pesanan.success', $pesanan->no_pesanan) }}";
                    // Tambahkan logic setelah berhasil
                },
                onPending: function(result) {
                    alert("Menunggu Pembayaran");
                },
                onError: function(result) {
                    alert("Pembayaran Gagal");
                },
                onClose: function() {
                    alert("Anda menutup popup tanpa menyelesaikan pembayaran");
                }
            });
        });
    </script>
@endsection
