@extends('layouts.app')
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">How to order</h1>
                        <ol class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li class="active">How to order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>Cara bertransaksi di web KOMA Collection</h2>
                    <p>Pesan dan saran bisa dikirim ke email <a href="{{ url('/') }}">KOMA Collection</a> atau bisa
                        akses halaman <a href="{{ url('/contact') }}">contact us.</a> </p>
                    <p>collectionkoma@gmail.com</p>
                </div>
                <div class="col-md-8">
                    <h4>Masuk kedalam aplikasi web <a href="{{ url('/') }}">KOMA Collection</a></h4>
                    <p>Setelah mengakses halaman, anda bisa langsung melihat laman beranda dari web ini yang dimana
                        ditampilkan beberapa produk yang dijual kami.</p>
                    <h4>Login atau registrasi
                    </h4>
                    <p>Halaman login atau register bisa diakses dengan cara klik icon user dibagian pojok kanan atas pada
                        bagian halaman.</p>
                    <p>Ketika sudah masuk bisa langsung melihat berbagai jenis produk yang kami jual, mulai dari pakaian
                        atasan maupun bawahan.</p>
                    <h4>Pilih produk</h4>
                    <p>Setelah melihat dan memilih produk mana yang ingin dibeli bisa langsung klik icon cart atau keranjang
                        pada bagian foto produk yang kalian pilih.</p>
                    <p>Dengan begitu produk akan masuk kedalam keranjang belanja. Produk yang sudah masuk kedalam keranjang
                        belanja bisa dilihat pada bagian halaman cart dengan cara klik bagian icon keranjang yang berada
                        dibagaian atas halaman.</p>
                    <h4>Checkout</h4>
                    <p>Setelah memilih produk dan memasukannya ke dalam cart, anda bisa langsung melakukan checkout di dalam
                        halaman checkout yang bisa diakses dengan cara klik bagian icon user pada bagian atas halaman dan
                        pilih tombol checkout.</p>
                    <p>Di halaman checkout anda harus memasukan beberapa data termasuk nama, kontak, dan alamat yang akan
                        dituju untuk pengiriman barang.</p>
                    <h4>Detail informasi</h4>
                    <p>Ketika sudah memasukan beberapa data dihalaman checkout, anda bisa melanjutkannya ke dalam halaman
                        information detail ketika sudah memasukan data dihalaman checkout dan menyimpan data tersebut.</p>
                    <p>Pada halaman ini anda akan memilih ingin bertansaksi menggunakan apa dan memilih ekspedisi untuk
                        pengiriman produk yang akan dibeli.</p>
                    <h4>Pembayaran</h4>
                    <p>Setelah memilih anda akan ditujukan pada halaman pembayaran yang dimana isi dari halaman ini adalah
                        informasi mengenai pembayaran mulai dari informasi pelanggan, id pesanan, detail pesanan,
                        pengiriman, jumlah yang harus dibayar dan metode pembayaran.</p>
                    <p>Pada halaman ini juga terdapat tombol untuk melihat data pesanan yang telah selesai dibuat.</p>
                    <h4>Pesanan</h4>
                    <p>Pada halaman pesanan ini terdapat data dari pesanan - pesanan anda yang dimana bisa dilihat secara
                        detail dengan klik tombol detail pada data pesanan yang dipilih.</p>
                    <h4>Detail pesanan</h4>
                    <p>Halaman ini akan menampilkan detail pembelian.</p>
                    <p>Bagi pembeli yang sudah melakukan pembelian di Web ini diharuskan mengirimkan bukti transfer, dengan
                        cara melakukan pengunggahan file berupa foto struk atau screenshot bukti transfer.</p>
                    <p style="color: red">Unggah foto atau screenshot bukti pembayaran kedalam halaman detail pesanan.</p>
                    <h5>Selesai, dan admin kami akan melakukan verifikasi pembelian dan status pembayaran bisa dilihat pada
                        halaman pesanan.</h5>
                    <p>*waktu verifikasi 1x24 jam</p>
                    <p>*pengiriman produk pada hari yang sama ketika order</p>
                </div>
            </div>
        </div>
    </section>
@endsection
