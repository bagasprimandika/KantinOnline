@extends('layouts.shop')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg st-color container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Konfirmasi Pesanan</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__order mt-5">
                <h4>Detail Pesanan</h4>
                <div class="checkout__order__products">Items <span>Total</span></div>
                <ul>
                    @foreach ($items as $item)
                        <li>{{ $item->produk->nama_produk . ' (x' . $item->qty . ')' }}
                            <span>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="checkout__order__subtotal">Subtotal <span>Rp.
                        {{ number_format($pesanan->subtotal, 0, ',', '.') }}</span></div>
                <div class="checkout__order__subtotal mt-n3">Ongkir <span>Rp.
                        {{ number_format($pesanan->ongkir, 0, ',', '.') }}</span></div>
                <div class="checkout__order__total">Total <span>Rp. {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('midtrans.payment', $pesanan->no_pesanan) }}" class="btn site-btn mt-3">Lanjutkan
                    Pembayaran</a>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
