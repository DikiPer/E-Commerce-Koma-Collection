<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .head {
            text-align: center;
        }
    </style>
    <title>Export PDF</title>
</head>

<body>
    <div class="head">
        <h1>KOMA Collection</h1>
        <h3>Detail Order</h3>
        @foreach ($data as $item)
            <p>{{ $item->id_produk }}</p>
        @endforeach
    </div>
</body>

</html>
