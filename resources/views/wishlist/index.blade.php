@extends('layouts.app')
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">Wishlist</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li class="active">wishlist</li>
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
                                                <th class="">Images | Item Name</th>
                                                <th class="">Quantity</th>
                                                <th class="">Item Price</th>
                                                <th class="">Weight</th>
                                                <th class="">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                                $totalQuantity = 0;
                                                $totalWeight = 0;
                                            @endphp
                                            @foreach ($wishlists as $id => $details)
                                                @php
                                                    $total += $details['price'] * $details['quantity'];
                                                    $totalQuantity += $details['quantity'];
                                                    $totalWeight += $details['berat'] * $details['quantity'];
                                                @endphp
                                                <tr class="">
                                                    <td class="">
                                                        <div class="product-info">
                                                            <img width="80"
                                                                src="{{ asset('storage/product/' . $details['images']) }}"
                                                                alt="" />
                                                            <a href="#!">{{ $details['name'] }}</a>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        {{ $details['quantity'] }}
                                                        Pcs
                                                    </td>
                                                    <td class="">IDR {{ number_format($details['price']) }}</td>
                                                    <td class="">{{ $details['berat'] }} Gram</td>
                                                    <td class="">
                                                        <form action="{{ route('wishlist.delete', $details->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn" title="delete"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>
                                                    <h4>Total</h4>
                                                </td>
                                                <td>{{ $totalQuantity }} Pcs</td>
                                                <td>
                                                    IDR {{ number_format($total) }}
                                                </td>
                                                <td>{{ number_format($totalWeight) }} Gram</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    @if ($wishlists !== null && count($wishlists) > 0)
                                        <!-- Tampilkan tombol checkout -->
                                        <a href="{{ url('/checkout') }}" class="btn btn-main pull-right">Checkout
                                        </a>
                                    @else
                                        <a href="{{ url('/on_sale') }}" class="btn btn-main pull-right">Shop Now</a>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
