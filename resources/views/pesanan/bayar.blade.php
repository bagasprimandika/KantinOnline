@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Bayar Pesanan #{{ $pesanan->no_pesanan }}</h3>
        <p>Total: <strong>Rp {{ number_format($pesanan->total, 0, ',', '.') }}</strong></p>

        <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Pembayaran berhasil!");
                    console.log(result);
                    // redirect atau simpan status
                    window.location.href = "/pesanan/sukses";
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran...");
                    console.log(result);
                },
                onError: function(result) {
                    alert("Pembayaran gagal!");
                    console.log(result);
                },
                onClose: function() {
                    alert('Kamu menutup tanpa menyelesaikan pembayaran');
                }
            });
        });
    </script>
@endsection
