@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="cart shopping">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="block">
                            <div class="product-list">
                                <form method="post">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="">ID Order</th>
                                                <th class="">Product Name</th>
                                                <th class="">Quantity</th>
                                                <th class="">Item Price</th>
                                                <th class="">Size</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalQuantity = 0;
                                                $totalPrice = 0;
                                            @endphp
                                            @foreach ($data as $id => $detail)
                                                @php
                                                    $totalQuantity += $detail->qty;
                                                    $totalPrice += $detail->price;
                                                @endphp
                                                <tr class="">
                                                    <td>{{ $detail->id_pesanan }}</td>
                                                    <td class="">
                                                        <div class="product-info">
                                                            <strong>{{ $detail->product_name }}</strong>

                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        {{ $detail->qty }}
                                                        Pcs
                                                    </td>
                                                    <td class="">IDR {{ number_format($detail->price) }}</td>
                                                    <td class="">{{ $detail->size }} </td>
                                                    {{-- <td class="">
                                                        <a class="product-remove"
                                                            href="{{ route('detail.pesanan', $detail->id) }}">Remove</a>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td>Total</td>

                                                <td>{{ $totalQuantity }} Pcs</td>
                                                <td>IDR {{ number_format($totalPrice) }}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    @php
                                        $lastOrder = \App\Models\Order::where('id_user', Auth::id())
                                            ->latest()
                                            ->first();
                                    @endphp
                                    @if ($lastOrder && $lastOrder->status == 'paid')
                                        <!-- Tampilkan teks Kembali -->
                                        <p>Kembali</p>
                                    @else
                                        <!-- Tampilkan tombol Unggah Bukti Pembayaran -->
                                        <a href="{{ url('/unggah_bukti_bayar/edit', $id_order) }}"
                                            class="btn btn-main pull-right">Unggah
                                            Bukti
                                            Pembayaran</a>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
