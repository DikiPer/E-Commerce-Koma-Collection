@extends('layouts.app')
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">Shop</h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ url('/customer') }}">Home</a></li>
                            <li class="active">shop</li>
                            @if (session('success'))
                                <div class="alert alert-success text-center">
                                    <strong>{{ session('success') }}</strong>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="products section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="widget">
                        <h4 class="widget-title">Short By</h4>
                        <form method="get" action="{{ url('/shop') }}">
                            <select class="form-control" name="category">
                                <option value="top" {{ !$category || $category == 'top' ? 'selected' : '' }}>Top
                                </option>
                                <option value="bottom" {{ $category == 'bottom' ? 'selected' : '' }}>Bottom</option>
                            </select>
                            <button class="btn btn-main" style="margin-top: 15px" type="submit">Filter</button>
                        </form>
                    </div>

                </div>
                <div class="col-md-9">
                    <div class="row">
                        @foreach ($products as $item)
                            <div class="col-md-4">
                                <div class="product-item">
                                    <div class="product-thumb">
                                        @if ($item->discount == 1)
                                            <span class="bage">Sale</span>
                                        @endif
                                        <img class="img-responsive" src="{{ asset('storage/product/' . $item->images) }}"
                                            alt="product-img" />
                                        <div class="preview-meta">
                                            <ul>
                                                <li>
                                                    <span data-toggle="modal"
                                                        data-target="#product-modal-{{ $item->id }}">
                                                        <i class="tf-ion-ios-search-strong"></i>
                                                    </span>
                                                </li>
                                                <li>
                                                    <a href="{{ route('wishlist.store', $item->id) }}" class="btn-btn"
                                                        onclick="event.preventDefault();
                                                                     if(confirm('Masukan product kedalam wishlist ?')){
                                                                       document.getElementById('store-form-{{ $item->id }}').submit();
                                                                     }">
                                                        <i class="tf-ion-ios-heart"></i>
                                                    </a>
                                                    <form id="store-form-{{ $item->id }}"
                                                        action="{{ route('wishlist.store', $item->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                    </form>
                                                </li>
                                                <li>
                                                    <a href="{{ route('store', $item->id) }}"><i
                                                            class="tf-ion-android-cart"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h4><a href="{{ route('detail.product', $item->id) }}">{{ $item->name }}</a>
                                        </h4>
                                        @if ($item->discount == 1)
                                            <p class="price">IDR <s>{{ number_format($item->price) }}</s></p>
                                        @else
                                            <h5 class="price">IDR {{ number_format($item->price) }}</h5>
                                        @endif
                                        <?php
                                        $normal = $item->price;
                                        $discount = $item->discount_price;
                                        $final = $normal - $discount;
                                        ?>
                                        @if ($item->discount == 1)
                                            <h5 class="price" style="margin-top: -10px">IDR
                                                {{ number_format($final) }}
                                            </h5>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @foreach ($products as $item)
                            <!-- Modal -->
                            <div class="modal product-modal fade" id="product-modal-{{ $item->id }}">
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
                                                            src="{{ asset('storage/product/' . $item->images) }}"
                                                            alt="product-img" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <div class="product-short-details">
                                                        <h2 class="product-title">{{ $item->name }}</h2>
                                                        @if ($item->discount == 1)
                                                            <s class="product-price">IDR
                                                                {{ number_format($item->price) }}</s>
                                                        @else
                                                            <p class="product-price">IDR {{ number_format($item->price) }}
                                                            </p>
                                                        @endif
                                                        @if ($item->discount == 1)
                                                            <h4 class="product-short-description">
                                                                IDR
                                                                {{ number_format($item->price - $item->discount_price) }}
                                                            </h4>
                                                        @endif
                                                        <h6 class="product-short-description">Size : {{ $item->size }}
                                                        </h6>
                                                        <p class="product-short-description">
                                                            {{ $item->description }}
                                                        </p>
                                                        <a href="{{ route('detail.product', $item->id) }}"
                                                            class="btn btn-main">View
                                                            Product
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
