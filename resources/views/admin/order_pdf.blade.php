<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Pembelian</title>
    <style>
        body {}

        .resi {
            font-family: 'Times New Roman', Times, serif;
            margin-top: 30px;
            border: 1px solid black;
            max-width: 80%;
            height: 700px;
        }

        .heading {
            text-align: center;
        }

        .heading .barcode {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 40px;
            height: 17px;
        }

        .content {
            font-size: 13px;
            margin-left: 20px;
            width: 40%;
            float: left;
        }

        .content-2 {
            font-size: 13px;
            width: 60%;
            float: right;
        }

        .total {
            margin-left: 20px;
        }

        .total h4 {
            margin-bottom: -10px;
        }

        .thanks {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="resi">
        <div class="heading">
            <h3>KOMA COLLECTION</h3>
            <div class="barcode">
                {!! $barcode !!}
            </div>
            <h5>Nomor Invoice : {{ $order->id_pesanan }}</h5>
        </div>
        <div class="content">
            @foreach ($order_product as $item)
                <p>Nama Produk : {{ $item->product_name }}</p>
                <p>Ukuran : {{ $item->size }}</p>
                <p>Harga : IDR {{ number_format($item->price) }}</p>
                <p>Jumlah : {{ $item->qty }} Pcs</p>
            @endforeach
        </div>
        <div class="content-2">
            <p>Nama Penerima : {{ $order->name }}</p>
            <p>Alamat : {{ $order->shipto }}</p>
            <p>No Hp : {{ $order->contact }}</p>
            <p>Ekspedisi : {{ $order->shippingserve }}</p>
            @php
                $payment = $order->payment_method;
                
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
            <h3>Payment Method : {{ $payment_text }}</h3>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
        </div>
        <div class="total">
            <h4>Subtotal : IDR {{ number_format($order->subtotal) }}</h4>
            <h4>Ongkos Kirim : IDR {{ number_format($order->shippingcost) }}</h4>
            <h3>Total Harga : IDR {{ number_format($order->total_price) }}</h3>
        </div>
        <div class="thanks">
            <h2>Terima kasih telah berbelanja di </h2>
            <h2>KOMA Collection</h2>
        </div>
    </div>
</body>

</html>
