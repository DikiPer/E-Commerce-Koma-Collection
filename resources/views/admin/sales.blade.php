@extends('layouts.app-admin')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <a href="{{ url('/export/sales/excel') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
            style="float: right"><i class="fas fa-print fa-sm text-white-50"></i> Export Excel</a>

        <h1 class="h3 mb-2 text-gray-800">Sales</h1>
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
                <h6 class="m-0 font-weight-bold text-primary">Data Sales</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataProduct" class="table table-striped table-bordered" width="100%"
                        style="font-size: 13px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Order</th>
                                <th>ID Product</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Action</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>ID Order</th>
                                <th>ID Product</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Action</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($sales as $key => $product)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $product->id_pesanan }}</td>
                                    <td>{{ $product->id_produk }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->qty }} Pcs</td>
                                    <td>{{ number_format($product->price) }}</td>
                                    <td>{{ $product->created_at->format('d-M-Y') }}</td>
                                    <td>
                                        <a href="{{ route('detail.sales', $product->id) }}" class="btn btn-info"><i
                                                class="fa fa-search"></i></a>
                                    </td>
                                </tr>
                            @endforeach
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
