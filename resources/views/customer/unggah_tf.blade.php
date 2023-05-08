@extends('layouts.app')
@section('content')
    <section class="signin-page account">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="block text-center">
                        <h2 class="text-center">Unggah bukti pembayaran</h2>
                        <form class="text-left clearfix" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="text-center">
                                @foreach ($order as $item)
                                    <h5>ID Order : {{ $item->id_pesanan }}</h5>
                                @endforeach
                                <p>Status : {{ strtoupper($detail->status) }} </p>
                            </div>
                            @foreach ($order_product as $data)
                                <p style="margin-bottom: -1px">Nama Produk : {{ $data->product_name }}</p>
                                <p style="margin-bottom: -1px">Size : {{ $data->size }}</p>
                                <p style="margin-bottom: -1px">Price : IDR {{ number_format($data->price) }}</p>
                                <p>Quantity : {{ $data->qty }} Pcs</p>
                            @endforeach
                            <h5>Total : IDR {{ number_format($detail->total_price) }}</h5>
                            @php
                                $payment = $detail->payment_method;
                                
                                if ($payment == 'tf_mandiri') {
                                    $payment_text = 'Bank Transfer Mandiri';
                                } elseif ($payment == 'tf_bca') {
                                    $payment_text = 'Bank Transfer BCA';
                                } elseif ($payment == 'tf_bsi') {
                                    $payment_text = 'Bank Transfer BSI';
                                } else {
                                    $payment_text = 'Unknown Payment Method';
                                }
                            @endphp
                            <h6>Payment Method : {{ $payment_text }}</h6>
                            <div class="form-group">
                                <input type="file" name="bukti_pembayaran" class="form-control">
                            </div>
                            <p class="mt-20 text-center" style="color: red"> *Ukuran foto maksimal 2mb</p>
                            <p class="mt-20 text-center" style="color: red; margin-top: -20px; margin-bottom: -10px"> *File
                                yang diunggah berupa
                                foto atau screenshot
                            </p>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-main text-center"
                            style="margin-bottom: 30px; margin-top: -30px">Unggah</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
