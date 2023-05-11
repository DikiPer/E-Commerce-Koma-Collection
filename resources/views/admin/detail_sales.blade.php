@extends('layouts.app-admin')
@section('content')
    <div class="container-fluid">
        {{-- <a href="{{ url('/generate/pdf', $id_order) }}" target="_blank"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="float: right; margin-right: 20px"><i
        class="fas fa-print fa-sm text-white-50"></i> Export PDF</a> --}}
        <h1 class="h3 mb-2 text-gray-800">Detail Sales</h1>
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
                <a href="{{ url('/sales_admin') }}"><i class="fa fa-chevron-left"></i> Back</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataProduct" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID Order</th>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Id user</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>ID Order</th>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Id user</th>
                                <th>Date</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>{{ $detail->id }}</td>
                                <td>{{ $detail->id_pesanan }}</td>
                                <td>{{ $detail->product_name }}</td>
                                <td>{{ $detail->size }}</td>
                                <td>{{ $detail->qty }} Pcs</td>
                                <td>IDR {{ number_format($detail->price) }}</td>
                                <td>{{ $detail->id_user }}</td>
                                <td>{{ $detail->created_at->format('d-M-Y') }}</td>
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
