@extends('layouts.app')
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">Pesanan</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li class="active">Pesanan </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if ($orders->count() > 0)
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
                                                    <th class="">Date</th>
                                                    <th class="">Total Qty</th>
                                                    <th class="">Total Price</th>
                                                    <th class="">Status</th>
                                                    <th class="">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr class="">
                                                        <td class="">
                                                            <div class="product-info" style="font-size: 12px">
                                                                <p><strong>{{ $order->id_pesanan }}</strong></p>

                                                            </div>
                                                        </td>

                                                        <td class="">
                                                            {{ $order->created_at->format('d-M-Y') }}
                                                        </td>
                                                        <td>{{ $order->total_qty }} Pcs</td>
                                                        <td class="">IDR {{ number_format($order->total_price) }}</td>
                                                        <td class="">{{ $order->status }} </td>
                                                        <td class="">
                                                            <a class="product-remove"
                                                                href="{{ route('detail.pesanan', $order->id) }}">Detail</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                            </tfoot>
                                        </table>
                                        <a href="{{ url('/shop') }}" class="btn btn-main pull-right">Shop Now</a>

                                        <div class="text-right">
                                            {{ $orders->links() }}
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <section class="empty-cart page-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="block text-center">
                            <i class="tf-ion-bag"></i>
                            <h2 class="text-center">Belum ada pesanan.
                            </h2>
                            <p>Pesan sekarang dan dapatkan promo gratis ongkir disetiap pembelian pertama.</p>
                            <a href="{{ url('/shop') }}" class="btn btn-main mt-20">Shop now</a>
                        </div>
                    </div>
                </div>
        </section>
    @endif
@endsection
