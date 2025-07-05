@extends('layouts.shop')


@section('title', 'Pembayaran Sukses')
@section('content')

    <div class="container text-center mt-5">
        <h2 class="text-success">✅ Pembayaran Berhasil!</h2>
        <p>Pesananmu sedang kami proses. Terima kasih telah berbelanja!</p>
        <a href="{{ route('home') }}" class="btn site-btn mt-3">Kembali ke Beranda</a>
    </div>
@endsection
