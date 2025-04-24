@extends('layouts.shop')

@section('content')
    <section class="related-blog spad mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mt-n5">
                    <div class="section-title related-blog-title">
                        <h2>TENTANG KAMI</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset('/dist/img/logo2.png') }}" alt="">
                        </div>

                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 text-justify">
                    <p class="text-dark">Makanan dan minuman merupakan kebutuhan pokok yang tidak hanya mengenyangkan,
                        tetapi juga menjadi bagian penting dari gaya hidup dan kesehatan. Kami percaya bahwa setiap orang
                        berhak mendapatkan akses mudah ke makanan dan minuman yang lezat, higienis, dan berkualitas.

                        Website kantin online ini hadir sebagai solusi modern untuk memudahkan pelaku UMKM dalam
                        mempromosikan serta menjual produk makanan dan minuman mereka. Di sisi lain, pelanggan juga
                        dimanjakan dengan kemudahan memesan makanan favorit tanpa harus keluar rumah atau antre panjang.

                        Dengan sistem yang praktis dan efisien, kami ingin menciptakan pengalaman belanja makanan dan
                        minuman yang lebih nyaman, cepat, dan terpercaya—langsung dari tangan para pelaku usaha lokal ke
                        meja makan Anda.

                        Mari dukung UMKM dan nikmati sajian terbaik dari kantin online kami!</p>
                    <div class="accordion mt-4" id="faqExample">
                        <div class="card">
                            <div class="card-header p-2 st-color" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-light" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Q: Apa itu Kantin Online?
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#faqExample">
                                <div class="card-body">
                                    <b>Answer:</b> Kantin Online adalah toko online yang dapat digunakan untuk memesan
                                    berbagai makanan dan minuman UMKM melalui aplikasi berbasis website
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-header p-2 st-color" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-light collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Q: Bagaimana Cara memesan Makanan dan Minuman?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqExample">
                                <div class="card-body text-left">
                                    <b>Answer:</b> <br>
                                    1. Customer dapat memilih makanan dan minuman yang diinginkan <br>
                                    2. Customer dapat melakukan konfirmasi pemesanan dan pembayaran <br>
                                    3. Customer dapat menunggu sampai pesanan diterima <br>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-header p-2 st-color" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-light collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Q. Bagaimana Makanan dan Minuman kami dapat diterima?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#faqExample">
                                <div class="card-body">
                                    <b>Answer:</b> Kantin Online menyediakan jasa pengiriman sesuai dengan harga dari
                                    masing-masing penjuan makanan dan minuman yang sudah ditentukan sesuai lokasi customer
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-header p-2 st-color" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-light collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Q. Jam Buka Pesanan Kantin Online?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqExample">
                                <div class="card-body">
                                    <b>Answer:</b> Kantin Online dapat menerima pesanan 24 jam, namun akan dikonfirmasi
                                    oleh admin dan penjual dari pukul 07.00 AM - 17.00 PM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
