@extends('layouts.app')
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">About Us</h1>
                        <ol class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li class="active">about us</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-responsive" src="{{ asset('images/shop/kc.png') }}">
                </div>
                <div class="col-md-6">
                    <h2 class="mt-40">Tentang KOMA Collection</h2>
                    <p><a href="{{ url('/') }}">KOMA Collection</a> adalah sebuah toko penjualan baju yang mengusung
                        tema santai, dimana kualitas produk yang baik adalah prioritas utama bagi kami.</p>
                    <p>Toko ini sudah berjalan sekitar 1 tahun berjalan dengan konsistenitas produksi dengan kualitas yang
                        baik dari segi bahan, jahitan maupun model.</p>
                    <p>Produk - produk unggulan yang kami jual bisa langsung dilihat di halaman <a
                            href="{{ url('/shop') }}">Shop</a>.</p>
                    <a href="" class="btn btn-main mt-20">Download Company Profile</a>
                </div>
            </div>
            <div class="row mt-40">
                <div class="col-md-3 text-center">
                    <img src="{{ asset('images/shop/category/category-1.jpg') }}" width="100%">
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{ asset('images/shop/category/category-2.jpg') }}" width="100%">
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{ asset('images/shop/category/category-3.jpg') }}" width="100%">
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{ asset('images/shop/category/category-4.jpg') }}" width="100%">
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="team-members ">
        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>Team Members</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="team-member text-center">
                        <img class="img-circle" src="images/team/team-1.jpg">
                        <h4>Jonathon Andrew</h4>
                        <p>Founder</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="team-member text-center">
                        <img class="img-circle" src="images/team/team-2.jpg">
                        <h4>Adipisci Velit</h4>
                        <p>Developer</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="team-member text-center">
                        <img class="img-circle" src="images/team/team-3.jpg">
                        <h4>John Fexit</h4>
                        <p>Shop Manager</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="team-member text-center">
                        <img class="img-circle" src="images/team/team-1.jpg">
                        <h4>John Fexit</h4>
                        <p>Shop Manager</p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    <div class="section video-testimonial bg-1 overly-white text-center mt-50" style="margin-bottom: 40px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Video presentation</h2>
                    <a class="play-icon" href="https://www.youtube.com/watch?v=oyEuk8j8imI&amp;rel=0"
                        data-toggle="lightbox">
                        <i class="tf-ion-ios-play"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
