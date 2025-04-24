@extends('layouts.shop')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg st-color container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Hubungi Kami</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>No. Telp</h4>
                        <p>+62 8953 5852 5339 </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Alamat</h4>
                        <p>Karawang Timur - JABAR</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Jam Buka</h4>
                        <p>07:00 am to 17:00 pm</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>ptrimandikabagas28@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="map container mb-5">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.2650752394898!2d107.3590227757329!3d-6.359727262217243!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6976a1d0594fff%3A0xa96884c8bfe52960!2sGriya%20Budiman%20Asri!5e0!3m2!1sen!2sid!4v1744955767190!5m2!1sen!2sid"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>KANTIN ONLINE</h4>
                <ul>
                    <li>No Telp.: +62 8953 5852 5339</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
