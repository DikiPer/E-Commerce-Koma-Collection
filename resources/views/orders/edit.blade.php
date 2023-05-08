@extends('layouts.app-admin')
@section('content')
    <div class="container mb-3">
        <div class="row">
            <div class="col">
                <h2>Edit Data Order</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-center">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('update.pesanan', $order->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $order->name) }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">ID Order</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $order->id_pesanan) }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="discount">Status</label>
                        <select name="status" id="discount" class="form-control">
                            <option value="0">{{ old('status', $order->status) }}</option>
                            <option value="unpaid">Unpaid</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
        </div>
    </div>
@endsection
