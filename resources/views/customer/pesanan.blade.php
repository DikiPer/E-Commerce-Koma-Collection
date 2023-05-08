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
                                                <th class="">Order Date</th>
                                                <th class="">Total Quantity</th>
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
                                                        {{ $order->created_at }}
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
                                    @if (session('cart'))
                                        @if (count(session('cart')) > 0)
                                            <!-- Tampilkan tombol checkout -->
                                            <a href="{{ url('/checkout') }}" class="btn btn-main pull-right">Checkout
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ url('/onsale') }}" class="btn btn-main pull-right">Shop Now</a>
                                    @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
