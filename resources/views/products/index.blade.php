 @extends('layouts.app-admin')
 @section('content')
     <!-- Begin Page Content -->
     <div class="container-fluid">
         <!-- Page Heading -->
         <a href="{{ url('/add_product') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
             style="float: right"><i class="fas fa-plus fa-sm text-white-50"></i> Add Products</a>
         <h1 class="h3 mb-2 text-gray-800">Products</h1>
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
                 <h6 class="m-0 font-weight-bold text-primary">Data Products</h6>
             </div>
             <div class="card-body">
                 <div class="table-responsive">
                     <table id="dataProduct" class="table table-striped table-bordered" width="100%"
                         style="font-size: 13px">
                         <thead>
                             <tr>
                                 <th>No</th>
                                 <th>Name</th>
                                 <th>Price</th>
                                 <th>Code</th>
                                 <th>Description</th>
                                 <th>Stock</th>
                                 <th>Image</th>
                                 <th>Action</th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tfoot>
                             <tr>
                                 <th>No</th>
                                 <th>Name</th>
                                 <th>Price</th>
                                 <th>Code</th>
                                 <th>Description</th>
                                 <th>Stock</th>
                                 <th>Image</th>
                                 <th>Action</th>
                                 <th>Action</th>
                             </tr>
                         </tfoot>
                         <tbody>
                             @foreach ($products as $key => $product)
                                 <tr>
                                     <td>{{ $key + 1 }}</td>
                                     <td>{{ $product->name }}</td>
                                     <td>{{ $product->price }}</td>
                                     <td>{{ $product->code }}</td>
                                     <td>{{ Str::limit($product->description, 90) }}</td>
                                     <td>{{ $product->stock }}</td>

                                     <td><img src="{{ asset('/storage/product/' . $product->images) }}" width="100"
                                             alt="{{ $product->name }}"></td>
                                     <td>
                                         <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning"><i
                                                 class="fa fa-edit"></i></a>
                                     </td>
                                     <td>
                                         <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                             @csrf
                                             @method('delete')
                                             <button type="submit" class="btn btn-danger"><i
                                                     class="fa fa-trash"></i></button>
                                         </form>
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
