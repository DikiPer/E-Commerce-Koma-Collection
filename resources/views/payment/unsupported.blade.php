@extends('layouts.app')
@section('content')
    <h1>Clear Payment - Unsupport</h1>

    <p>Transfer ke rekening BCA:</p>
    <p>Nomor Rekening: 1234567890</p>

    <p>Jumlah yang harus dibayar: Rp {{ number_format($totalPrice) }}</p>
    <p>Jumlah pesanan: {{ $totalQty }}</p>

    <p>Produk yang dipesan:</p>
    <ul>
        @foreach ($products as $product)
            <li>{{ $product->product_name }} - {{ $product->qty }} x Rp {{ number_format($product->price) }}</li>
        @endforeach
    </ul>
@endsection
