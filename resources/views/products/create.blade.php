@extends('layouts.app-admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Add Product</h2>
            </div>
        </div>
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
        <form action="{{ url('/add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Name:
                        </strong>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Price:</strong>
                        <input type="number" name="price" class="form-control" placeholder="Price">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Code:</strong>
                        <input type="text" name="code" class="form-control" placeholder="Code">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <textarea class="form-control" style="height:150px" name="description" placeholder="Description"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Image:</strong>
                        <input type="file" name="images" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Category:</strong>
                        <select name="category" id="" class="form-control">
                            <option value="top">Top</option>
                            <option value="bottom">Bottom</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <strong>Stock :</strong>
                        <input type="text" class="form-control" id="stock" name="stock">
                    </div>
                    <div class="form-group">
                        <strong>Berat (Gram):</strong>
                        <input type="number" class="form-control" id="berat" name="berat">
                    </div>
                    <div class="form-group">
                        <strong>Size:</strong>
                        <input type="text" name="size" class="form-control">
                    </div>
                    <div class="form-group">
                        <strong>Discount :</strong>
                        <select name="discount" id="discount" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('/product') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
        </form>
    </div>
@endsection
