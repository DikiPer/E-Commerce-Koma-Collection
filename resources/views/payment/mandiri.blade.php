@extends('layouts.app')
@section('content')
    <!-- Page Wrapper -->
    <section class="page-wrapper success-msg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="block text-center" style="margin-top: -30px">
                        <div id="copy-feedback" style="color: red"></div>
                        <h2 class="text-center mb-3">Payment Pages</h2>
                        <img src="{{ asset('/img/bank/mandiri.jpg') }}" alt="" width="50%"
                            style="margin-bottom: 20px">

                        <p>Nomor Rekening : <strong>1180012501010 </strong><button id="copy-btn"
                                class="fa fa-copy"></i></button></p>
                        <p>Atas Nama : <strong> Diki Permana </strong></p>
                        <p>Jumlah yang harus dibayar : <strong>IDR {{ number_format($totalPrice) }}</strong></p>
                        <a href="{{ route('cek.pesanan') }}" class="btn btn-main mt-20">Cek Pesanan</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.page-warpper -->
    <script>
        const copyBtn = document.querySelector('#copy-btn');
        const textToCopy = '1180012501010';
        const copyFeedback = document.querySelector('#copy-feedback');

        copyBtn.addEventListener('click', () => {
            navigator.clipboard.writeText(textToCopy)
                .then(() => {
                    // Tampilkan feedback dengan menambahkan sebuah div
                    copyFeedback.textContent = 'Teks berhasil disalin ke clipboard.';

                    console.log('Teks berhasil disalin');
                })
                .catch((error) => {
                    console.error('Terjadi kesalahan saat menyalin teks:', error);
                });
        });
    </script>
@endsection
