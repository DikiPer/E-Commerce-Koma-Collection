@extends('layouts.app-admin')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <a href="{{ url('/export/order/' . $order->id) }}" target="_blank"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="float: right; margin-right: 20px"><i
                class="fas fa-print fa-sm text-white-50"></i> Cetak Resi</a>
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Detail Orders</h1>
        @if (session('success'))
            <div class="alert alert-success text-center">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your
                input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ url('/order_admin') }}"><i class="fa fa-chevron-left"></i> Back</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataProduct" class="table table-striped table-bordered" width="100%"
                        style="font-size: 13px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Order</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Ship to</th>
                                <th>Ship serve</th>
                                <th>Total Qty</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Payment Method</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>ID Order</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Ship to</th>
                                <th>Ship serve</th>
                                <th>Total Qty</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Payment Method</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>{{ 1 }}</td>
                                <td>{{ $order->id_pesanan }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->contact }}</td>
                                <td>{{ $order->shipto }}</td>
                                <td>{{ $order->shippingserve }}</td>
                                <td>{{ $order->total_qty }} Pcs</td>
                                <td>IDR {{ number_format($order->total_price) }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->payment_method }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection
