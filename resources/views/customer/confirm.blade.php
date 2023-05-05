@extends('layouts.app')
@section('content')
    <!-- Page Wrapper -->
    <section class="page-wrapper" style="margin-top: -40px">
        <div class="container">
            <div class="row">
                <h2 class="text-center mb-5">Checkout Page</h2>
                <div class="col-md-7">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="block billing-details">
                        <h4 class="widget-title">Information Details</h4>
                        <form action="{{ route('store.checkout') }}" method="POST" class="checkout-form">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Your Name" value="{{ $orders['name'] }}">
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" class="form-control" id="contact" placeholder="" name="contact"
                                    value="{{ $orders['no_tlp'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shipto">Ship to</label>
                                <input type="text" class="form-control" id="shipto" name="shipto"
                                    value="{{ $orders['alamat'] . ' , Kec.' . $orders['kecamatan'] . ' , Kota ' . $city->name . ', ' . $province->name . ' ' . $orders['kode_pos'] }}">
                            </div>
                            <p style="color: red">*Cek kembali data anda</p>

                    </div>
                    <div class="card d-none ongkir" style="margin-top: 30px">
                        <h4>Choose Shipping Method</h4>
                        <div class="card-body">
                            <ul class="list-group">
                                <div for="" id="ongkir"></div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="product-checkout-details">
                        <div class="block">
                            <h4 class="widget-title text-center">Order Summary</h4>
                            @php
                                $total = 0;
                                $totalQuantity = 0;
                            @endphp
                            @if (session('cart'))
                                @foreach ($cart as $id => $details)
                                    @php
                                        $total += $details['price'] * $details['quantity'];
                                        $totalQuantity += $details['quantity'];
                                    @endphp
                                    <div class="product-media">
                                        <div class="media product-card">

                                            <div class="media-body">
                                                <img src="{{ asset('storage/product/' . $details['images']) }}"
                                                    alt="" class="media-object" style="float: right">

                                                <input type="hidden" name="id_produk[]" value="{{ $id }}">

                                                <h5>
                                                    <span id="productName">{{ $details['name'] }}</span> <input
                                                        type="hidden" name="product_name[{{ $id }}]"
                                                        value="{{ $details['name'] }}">
                                                </h5>
                                                <p class="price" id="productQuantity">{{ $details['quantity'] }} Pcs</p>
                                                <input type="hidden" name="qty[{{ $id }}]"
                                                    value="{{ $details['quantity'] }}">
                                                <p class="price" id="productPrice">IDR
                                                    {{ number_format($details['price']) }}</p>
                                                <input type="hidden" name="price[{{ $id }}]"
                                                    value="{{ $details['price'] }}">
                                                <input type="hidden" name="size[{{ $id }}]"
                                                    value="{{ $details['size'] }}">
                                                <input type="hidden" name="discount" value="{{ $details['discount'] }}">
                                                <input type="hidden" name="disc_price" value="">
                                                <input type="hidden" name="total_qty" value="{{ $totalQuantity }}">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="discount-code">
                                <span>Total quantity : {{ $totalQuantity }} Pcs</span>
                            </div>
                            <ul class="summary-prices">
                                <li>
                                    <span>Subtotal:</span>
                                    <span class="price" id="subtotal">IDR {{ number_format($total) }}</span> <input
                                        type="hidden" name="subtotal" value="{{ $total }}">
                                </li>
                                <li>
                                    <span>Shipping:</span>
                                    <span id="shippingCost">0</span>
                                    <input type="hidden" name="shippingserve" id="shippingServiceInput" value="">
                                    <input type="hidden" name="shippingcost" id="shippingCostInput" value="">
                                    <input type="hidden" name="shippingcode" id="shippingCodeInput" value="">
                                </li>
                            </ul>
                            <div class="summary-total">
                                <span for="total">Total</span>
                                <span id="totalPrice">0</span>
                                <input type="hidden" name="total_price" id="totalPriceInput" value="">
                            </div>
                        </div>
                        <input type="hidden" name="status" value="open">
                        <button class="btn btn-main mt-20 btn-check" id="continueButton">Continue to Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.page-warpper -->
    <!-- AJAX ONGKIR                                                                                                  -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        // mengambil data hitung ongkir dari halaman sebelumnya yaitu checkout //
        // let ongkirData = JSON.parse(localStorage.getItem('ongkirData'));
        // if (ongkirData) {
        //     for (let i = 0; i < ongkirData.length; i++) {
        //         $('#ongkir').append('<input type="radio" name="shipping" onchange="calculateTotal()" value="' +
        //             ongkirData[i].cost +
        //             '" data-cost="' + ongkirData[i].cost + '" data-code="' + ongkirData[i].code + '" data-service="' +
        //             ongkirData[i].service + '" class="list-group-item">' + ongkirData[i].code +
        //             ' : <strong>' + ongkirData[i].service + '</strong> - Rp. ' + ongkirData[i].cost + ' (' + ongkirData[
        //                 i].etd + ' hari)');
        //     }

        // }

        $.ajax({
            url: '/ongkirs',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data)
                // mengosongkan elemen #ongkir sebelum menambahkan radio button
                $('#ongkir').empty();

                // menambahkan radio button untuk setiap data yang diperoleh dari database
                for (let i = 0; i < data.length; i++) {
                    $('#ongkir').append(
                        '<input type="radio" name="shipping" onchange="calculateTotal()" value="' +
                        data[i].cost[0].value +
                        '" data-cost="' + data[i].cost[0].value + '" data-code="' + data[i].service +
                        '" data-service="' +
                        data[i].description + '" class="list-group-item">' + data[i].description +
                        ' - <strong>' + data[i].service + '</strong> - Rp. ' + data[i].cost[0]
                        .value +
                        ' (' +
                        data[i].cost[0]
                        .etd + ' hari)');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // menangani error jika terjadi error saat melakukan request ajax
                console.log(errorThrown);
            }
        });


        // hitung total harga //
        function calculateTotal() {
            let subtotal = <?php echo $total; ?>;
            let shippingCost = parseFloat($('input[name="shipping"]:checked').val());
            let shippingCode = $('input[name="shipping"]:checked').data('code');
            let shippingService = $('input[name="shipping"]:checked').data('service');
            let total = subtotal + shippingCost;
            $('#subtotal').text('IDR ' + subtotal.toLocaleString('id-ID'));
            $('#shippingCost').text('IDR ' + shippingCost.toLocaleString('id-ID'));
            $('#shippingCostInput').val(shippingCost);
            $('#shippingCodeInput').val(shippingCode);
            $('#shippingServiceInput').val(shippingService);
            $('#totalPriceInput').val(total);
            $('#totalPrice').text('IDR ' + total.toLocaleString('id-ID'));
        }
    </script>

@endsection
