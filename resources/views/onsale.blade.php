@extends('layouts.app')
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">Sale</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li class="active">sale</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="products section">
        <div class="container">
            <div class="row">
                @foreach ($sale as $data)
                    <div class="col-md-4">
                        <div class="product-item">
                            <div class="product-thumb">
                                <span class="bage">Sale</span>
                                <img class="img-responsive" src="{{ asset('storage/product/' . $data->images) }}"
                                    alt="product-img" />
                                <div class="preview-meta">
                                    <ul>
                                        <li>
                                            <span data-toggle="modal" data-target="#product-modal-{{ $data->id }}">
                                                <i class="tf-ion-ios-search-strong"></i>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <h4><a href="product-single.html">{{ $data->name }}</a></h4>
                                <s class="price">IDR {{ number_format($data->price) }}</s>
                                <p class="price">IDR {{ number_format($data->price - $data->discount_price) }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal product-modal fade" id="product-modal-{{ $data->id }}">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="tf-ion-close"></i>
                        </button>
                        <div class="modal-dialog " role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-6 col-xs-12">
                                            <div class="modal-image">
                                                <img class="img-responsive"
                                                    src="{{ asset('storage/product/' . $data->images) }}"
                                                    alt="product-img" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="product-short-details">
                                                <h2 class="product-title">{{ $data->name }}</h2>
                                                <s class="product-price">IDR {{ number_format($data->price) }}</s>
                                                <h4 class="product-short-description">
                                                    IDR {{ number_format($data->price - $data->discount_price) }}</h4>
                                                <h6 class="product-short-description">Size : {{ $data->size }}</h6>
                                                <p class="product-short-description">
                                                    {{ $data->description }}
                                                </p>
                                                <a href="{{ route('detail.product', $data->id) }}"
                                                    class="btn btn-main">View Product
                                                    Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal -->
                @endforeach
            </div>
        </div>

        </div>
        </div>
    </section>
@endsection
