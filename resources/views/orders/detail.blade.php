@extends('layouts.app-admin')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <a href="{{ url('/generate/pdf', $id_order) }}" target="_blank"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="float: right; margin-right: 20px"><i
                class="fas fa-print fa-sm text-white-50"></i> Export PDF</a>
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
                <h6 class="m-0 font-weight-bold text-primary">Data Detail Order</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataProduct" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>ID Order</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>ID Order</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($order as $key => $product)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->id_order }}</td>
                                    <td>IDR {{ number_format($product->price) }}</td>
                                    <td>{{ $product->qty }} Pcs</td>

                                    <td>
                                        <a href="{{ route('edit.pesanan', $product->id) }}" class="btn btn-warning"><i
                                                class="fa fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-info"><i
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
