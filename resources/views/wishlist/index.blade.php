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
                            @if (session('success'))
                                <div class="alert alert-success text-center">
                                    <strong>{{ session('success') }}</strong>
                                </div>
                            @endif
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if ($wishlists->count() > 0)
        <div class="page-wrapper">
            <div class="cart shopping">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="block">
                                <div class="product-list">
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
                                            @foreach ($wishlists as $details)
                                                @php
                                                    $total += $details->price * $details->quantity;
                                                    $totalQuantity += $details->quanity;
                                                    $totalWeight += $details->berat * $details->quantity;
                                                @endphp
                                                <tr class="">
                                                    <td class="">
                                                        <div class="product-info">
                                                            <img width="80"
                                                                src="{{ asset('storage/product/' . $details->images) }}"
                                                                alt="" />
                                                            <a href="#!">{{ $details->name }}</a>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        {{ $details->quantity }}
                                                        Pcs
                                                    </td>
                                                    <td class="">IDR {{ number_format($details->price) }}</td>
                                                    <td class="">{{ $details->berat }} Gram</td>
                                                    <td class="">
                                                        <a href="{{ route('wishlist.destroy', $details->id) }}"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="event.preventDefault();
                                                                     if(confirm('Anda yakin ingin menghapus wishlist ini?')){
                                                                       document.getElementById('delete-form-{{ $details->id }}').submit();
                                                                     }">
                                                            <i class="fa fa-trash"></i>
                                                        </a>

                                                        <!-- Form untuk method DELETE -->
                                                        <form id="delete-form-{{ $details->id }}"
                                                            action="{{ route('wishlist.destroy', $details->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
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
                                        <a href="{{ url('/cart') }}" class="btn btn-main pull-right">View Cart
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
    @else
        <section class="empty-cart page-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="block text-center">
                            <i class="tf-ion-ios-heart"></i>
                            <h2 class="text-center">Belum ada wishlist.
                            </h2>
                            <p>Tambah produk ke wishlist untuk menyimpan baran-barang favorit mu.</p>
                            <a href="{{ url('/shop') }}" class="btn btn-main mt-20">Shop now</a>
                        </div>
                    </div>
                </div>
        </section>
    @endif
@endsection
