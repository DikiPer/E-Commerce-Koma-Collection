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
                                                <th class="">Status</th>
                                                <th class="">Actions</th>
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
                                                    <td>{{ $detail->id_order }}</td>
                                                    <td class="">
                                                        <div class="product-info">
                                                            <a href="#!">{{ $detail->product_name }}</a>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        {{ $detail->qty }}
                                                        Pcs
                                                    </td>
                                                    <td class="">IDR {{ number_format($detail->price) }}</td>
                                                    <td class="">{{ $detail->size }} </td>
                                                    <td class="">
                                                        <a class="product-remove"
                                                            href="{{ route('detail.pesanan', $detail->id) }}">Remove</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Total</td>
                                                <td></td>
                                                <td>{{ $totalQuantity }} Pcs</td>
                                                <td>IDR {{ number_format($totalPrice) }}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
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
