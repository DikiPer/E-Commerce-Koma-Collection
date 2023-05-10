@extends('layouts.app-admin')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        {{-- <a href="{{ url('/add_product') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
            style="float: right"><i class="fas fa-print fa-sm text-white-50"></i> Print</a> --}}
        <h1 class="h3 mb-2 text-gray-800">Orders</h1>
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
                <h6 class="m-0 font-weight-bold text-primary">Data Order</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataProduct" class="table table-striped table-bordered" width="100%"
                        style="font-size: 13px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>ID Order</th>
                                <th>Total Price</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>ID Order</th>
                                <th>Total Price</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($order as $key => $product)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->id_pesanan }}</td>
                                    <td>IDR {{ number_format($product->total_price) }}</td>
                                    <td><img src="{{ asset('/storage/bukti_pembayaran/' . $product->bukti_pembayaran) }}"
                                            alt="" width="100%" data-toggle="modal" data-target="#modal-image"
                                            data-src="{{ asset('/storage/bukti_pembayaran/' . $product->bukti_pembayaran) }}">
                                    </td>

                                    <td>{{ $product->status }}</td>
                                    <td>
                                        <a href="{{ route('edit.pesanan', $product->id) }}" class="btn btn-warning"><i
                                                class="fa fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('detail.order', $product->id) }}" class="btn btn-info"><i
                                                class="fa fa-search"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-image" tabindex="-1" role="dialog" aria-labelledby="modal-image-label"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-image-label">Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="modal-image-placeholder" src="" alt="">
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <script>
        $('#modal-image').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var src = button.data('src') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('#modal-image-placeholder').attr('src', src)
        })
    </script>

@endsection
