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
                            <li class="active">cart</li>
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
                                                <th class="">Quantity</th>
                                                <th class="">Item Price</th>
                                                <th class="">Status</th>
                                                <th class="">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr class="">
                                                    <td class="">
                                                        <div class="product-info">
                                                            <a href="#!">{{ $order->id_pesanan }}</a>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        {{ $order->total_qty }}
                                                        Pcs
                                                    </td>
                                                    <td class="">IDR {{ number_format($order->total_price) }}</td>
                                                    <td class="">{{ $order->status }} </td>
                                                    <td class="">
                                                        <a class="product-remove" href="" data-toggle="modal"
                                                            data-target="#product-modal-{{ $order->id }}">Detail</a>
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
                                    @foreach ($orders as $item)
                                        <div class="modal product-modal fade" id="product-modal-{{ $item->id }}">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="tf-ion-close"></i>
                                            </button>
                                            <div class="modal-dialog " role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-8 col-sm-6 col-xs-12">
                                                            </div>
                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <div class="product-short-details">
                                                                    <h2 class="product-title">{{ $item->product_name }}
                                                                    </h2>
                                                                    @if ($item->discount == 1)
                                                                        <s class="product-price">IDR
                                                                            {{ number_format($item->price) }}</s>
                                                                    @else
                                                                        <p class="product-price">IDR
                                                                            {{ number_format($item->price) }}
                                                                        </p>
                                                                    @endif
                                                                    @if ($item->discount == 1)
                                                                        <h4 class="product-short-description">
                                                                            IDR
                                                                            {{ number_format($item->price - $item->discount_price) }}
                                                                        </h4>
                                                                    @endif
                                                                    <h6 class="product-short-description">Size :
                                                                        {{ $item->size }}
                                                                    </h6>
                                                                    <h6 class="product-short-description">Size :
                                                                        {{ $item->id_produk }}
                                                                    </h6>
                                                                    {{-- <p class="product-short-description">
                                                                        {{ $item->description }}
                                                                    </p> --}}
                                                                    <a href="{{ route('detail.product', $item->id) }}"
                                                                        class="btn btn-main">View
                                                                        Product
                                                                        Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
