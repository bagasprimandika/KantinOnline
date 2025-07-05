<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\MidtransCallbackController; // jika pakai callback

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Di sini kita mendefinisikan semua route web untuk aplikasi.
| Setiap route dikategorikan berdasarkan role & fitur seperti:
| - Guest/Public
| - Customer (Pembeli)
| - Seller (Penjual)
| - Admin
| - Midtrans (Pembayaran)
|--------------------------------------------------------------------------
*/


// ---------------------------
// ✅ ROUTE GUEST & PUBLIC
// ---------------------------

// Halaman verifikasi email
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware(['auth', 'verified'])->name('verification.notice');

// Login dengan Google
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Route login, register, dll.
Auth::routes(['verify' => true]);

// ---------------------------
// ✅ ROUTE UMUM (Cache untuk pengunjung dan user login)
// ---------------------------
Route::group(['middleware' => ['cache']], function () {
    Route::get('/', [HomeController::class, 'home']);
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::match(['get', 'post'], '/shop/{store:id}/sayuran', [ShopController::class, 'index'])->name('detail_shop');
    Route::get('/shop/detail-produk/{produk:id}', [ShopController::class, 'detail_produk'])->name('detail_produk');
    Route::get('/shop/modal/{produk:id}', [ShopController::class, 'produk_modal']);
    Route::match(['get', 'post'], '/shop', [ShopController::class, 'shop_list'])->name('shop');
});

// ---------------------------
// ✅ ROUTE CUSTOMER (User yang login & role "customer")
// ---------------------------
Route::group(['middleware' => ['auth', 'customer']], function () {

    Route::group(['middleware' => ['verified']], function () {
        // Profil & update password
        Route::match(['get', 'post'], '/profile', [HomeController::class, 'profile'])->name('profile');
        Route::match(['get', 'post'], '/update-password', [HomeController::class, 'update_password'])->name('update_password');

        // Keranjang & Checkout
        Route::get('/shop/keranjang', [ShopController::class, 'keranjang'])->name('keranjang');
        Route::get('/shop/konfirmasi-pesanan', [ShopController::class, 'konfirmasi_pesanan']);
        Route::post('/shop/proses_pesanan', [ShopController::class, 'proses_pesanan']);
        Route::post('/kec_checkout', [ShopController::class, 'kec_checkout']);
        Route::post('/shop/detail_ongkir', [ShopController::class, 'detail_ongkir']);
        Route::post('/shop/tambah_keranjang/{produk:id}', [ShopController::class, 'tambah_keranjang'])->name('tambah_keranjang');
        Route::post('/keranjang/{detpesanan:id}', [ShopController::class, 'update_qty'])->name('update_qty');
        Route::delete('/keranjang/{detpesanan:id}', [ShopController::class, 'delete_qty'])->name('delete_qty');
        Route::post('/shop/cek_produk', [ShopController::class, 'cek_produk']);

        // Pesanan
        Route::get('/pesanan-saya', [ShopController::class, 'pesanan_saya'])->name('pesanan_saya');
        Route::post('/pesanan/{pesanan:no_pesanan}', [ShopController::class, 'pesanan_selesai'])->name('pesanan_selesai');

        // Halaman pembayaran
        Route::match(['get', 'post'], '/pembayaran/{pesanan:no_pesanan}', [ShopController::class, 'pembayaran'])->name('pembayaran');

        // Register Seller
        Route::match(['get', 'post'], '/register-seller', [HomeController::class, 'register_seller'])->name('register_seller');

        // ✅ Route Pembayaran via Midtrans (Snap Token)
        Route::prefix('midtrans')->group(function () {
            Route::get('pay/{no_pesanan}', [MidtransController::class, 'pay'])->name('midtrans.payment');
        });

        // ✅ Halaman sukses setelah pembayaran
        Route::get('/pesanan/success', function () {
            return view('main.success')->with('title', 'Pembayaran Sukses');
        })->name('pesanan.success');

        // Callback dari Midtrans (jika menggunakan callback)
        Route::post('/midtrans/callback', [MidtransCallbackController::class, 'receive']);
    });
});

// ---------------------------
// ✅ ROUTE SELLER (Penjual)
// ---------------------------
Route::group(['middleware' => ['auth', 'seller', 'cache']], function () {
    Route::get('/seller', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::resource('/produk', ProdukController::class)->except('show');
    Route::resource('/ongkir', OngkirController::class)->except(['edit', 'create']);

    // Stock produk
    Route::post('/stock/{produk:id}', [ProdukController::class, 'update_stock'])->name('update_stock');
    Route::post('/get_kecamatan', [OngkirController::class, 'get_kecamatan']);

    // Pesanan dan invoice
    Route::get('/pesanan', [PesananController::class, 'index'])->name('seller.pesanan');
    Route::get('/pesanan/konfirmasi', [PesananController::class, 'konfirmasi_seller'])->name('seller.konfirmasi');
    Route::get('/pesanan/kirim', [PesananController::class, 'kirim'])->name('kirim');
    Route::get('/pesanan/{pesanan:no_pesanan}', [PesananController::class, 'detail'])->name('seller.detpes');
    Route::put('/pesanan/konfirmasi_seller/{pesanan:id}', [PesananController::class, 'proses_konfirmasi']);
    Route::put('/pesanan/kirim/{pesanan:no_pesanan}', [PesananController::class, 'kirim_pesanan'])->name('kirim_pesanan');

    Route::get('/invoice', [InvoiceController::class, 'index'])->name('seller.invoice');
    Route::get('/invoice/{invoice:no_invoice}', [InvoiceController::class, 'detail'])->name('seller.detinv');
    Route::get('/pesanan_invoice/{pesanan:id}', [PesananController::class, 'pesanan_invoice']);
    Route::get('/invoice/pdf/{pesanan:id}', [PesananController::class, 'pdf'])->name('invoice.pdf');
    Route::post('/laporan/pdf', [InvoiceController::class, 'pdf'])->name('seller.laporan.pdf');

    // Profil Seller
    Route::match(['get', 'post'], '/seller/profile', [SellerController::class, 'profile'])->name('seller.profile');
});

// ---------------------------
// ✅ ROUTE ADMIN (Admin Panel)
// ---------------------------
Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'admin', 'cache']], function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Manajemen produk & user
    Route::get('/produk', [AdminController::class, 'produk'])->name('admin.produk');
    Route::get('/user/customer', [AdminController::class, 'customer'])->name('admin.user');
    Route::get('/user/seller', [AdminController::class, 'seller'])->name('admin.seller');
    Route::get('/user/admin', [AdminController::class, 'admin'])->name('admin.admin');
    Route::delete('/user/{user:id}', [AdminController::class, 'delete_user'])->name('delete_user');

    // Approve / Reject Seller
    Route::put('/user/seller/approve/{store:id}', [HomeController::class, 'approve_seller'])->name('approve_seller');
    Route::put('/user/seller/reject/{store:id}', [HomeController::class, 'reject_seller'])->name('reject_seller');

    // Pesanan
    Route::get('/pesanan', [PesananController::class, 'index'])->name('admin.pesanan');
    Route::get('/pesanan/konfirmasi', [PesananController::class, 'konfirmasi'])->name('admin.konfirmasi');
    Route::get('/pesanan/{pesanan:no_pesanan}', [PesananController::class, 'detail'])->name('admin.detpes');
    Route::put('/pesanan/konfirmasi/{pesanan:no_pesanan}', [PesananController::class, 'konfirmasi_bayar'])->name('konfirmasi_pembayaran');

    // Invoice dan laporan
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('admin.invoice');
    Route::get('/invoice/{invoice:no_invoice}', [InvoiceController::class, 'detail'])->name('admin.detinv');
    Route::post('/laporan/pdf', [InvoiceController::class, 'pdf'])->name('admin.laporan.pdf');

    // Admin profil & tambah admin baru
    Route::match(['get', 'post'], '/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::match(['get', 'post'], '/user/admin/tambah', [AdminController::class, 'tambah_admin'])->name('tambah_admin');
});
