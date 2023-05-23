@extends('layouts.app')
@section('content')
    <div class="hero-slider">
        <div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-4.png)">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 text-center">
                        <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
                        <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of nature <br>
                            is hidden in details.</h1>
                        <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn"
                            href="{{ url('/shop') }}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="product section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title text-center">
                        <h2>Discount 30%</h2>
                    </div>
                </div>
                @if (isset($firstData))
                    @foreach ($firstData->take(3) as $data)
                        <div class="col-md-4">
                            <div class="category-box">
                                <a href="{{ route('detail.product', $data->id) }}">
                                    <img src="{{ asset('/storage/product/' . $data->images) }}" alt="" />
                                </a>
                            </div>
                            <div class="content text-center">
                                <h3>{{ $data->name }}</h3>
                                <s>IDR {{ number_format($data->price) }}</s>
                                <p>IDR {{ number_format($data->price - $data->discount_price) }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="col-md-12">
                    <div class="title text-center">
                        <a href="{{ url('/on_sale') }}" class="btn btn-main text-center" style="width: 200px">See
                            More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="products section bg-gray">
        <div class="container">
            <div class="row">
                <div class="title text-center">
                    <h2>All Products</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($secondData as $data)
                    <div class="col-md-4">
                        <div class="product-item">
                            <div class="product-thumb">
                                @if ($data->discount == 1)
                                    <span class="bage">Sale</span>
                                @endif
                                <img class="img-responsive" src="{{ asset('/storage/product/' . $data->images) }}"
                                    alt="product-img" />
                                <div class="preview-meta">
                                    <ul>
                                        @if ($data->stock > 1)
                                            <li>
                                                <span data-toggle="modal" data-target="#product-modal-{{ $data->id }}">
                                                    <i class="tf-ion-ios-search-strong"></i>
                                                </span>
                                            </li>
                                            <li>
                                                <a href="{{ route('wishlist.store', $data->id) }}" class="btn-btn"
                                                    onclick="event.preventDefault();
                                                             if(confirm('Masukan product kedalam wishlist ?')){
                                                               document.getElementById('store-form-{{ $data->id }}').submit();
                                                             }">
                                                    <i class="tf-ion-ios-heart"></i>
                                                </a>
                                                <form id="store-form-{{ $data->id }}"
                                                    action="{{ route('wishlist.store', $data->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                            <li>
                                                <a href="{{ route('store', $data->id) }}"><i
                                                        class="tf-ion-android-cart"></i></a>
                                            </li>
                                        @else
                                            <h3 style="color: white"> SOLD </h3>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <h4><a href="product-single.html">{{ $data->name }}</a></h4>
                                @if ($data->discount == 1)
                                    <p class="price"><s>IDR {{ number_format($data->price) }}</s></p>
                                    <h5 class="price">IDR {{ number_format($data->price - $data->discount_price) }}</h5>
                                @else
                                    <h5 class="price">IDR {{ number_format($data->price) }}</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12">
                    <div class="title text-center">
                        <a href="" class="btn btn-main text-center" style="width: 200px">See More</a>
                    </div>
                </div>

                <!-- Modal -->
                @foreach ($secondData as $item)
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
                <!-- /.modal -->

            </div>
        </div>
    </section>

    <div class="hero-slider" style="width: 100%">
        <div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-1.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 text-center">
                        <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn"
                            href="{{ url('/shop') }}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Call To Action ==================================== -->

    <hr style="border: 1px solid rgb(234, 231, 231)">
    <section class="products section bg-gray">
        <div class="container-fluid">
            <div class="row">
                <div class="title text-center">
                    <h2>FOLLOW US ON INSTAGRAM</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="product-item">
                        <div class="product-thumb">
                            <img class="img-responsive" src="images/shop/category/category-1.jpg" alt="product-img" />
                            <div class="preview-meta">
                                <ul>
                                    <li>
                                        <a href="https://instagram.com/collectionkoma?igshid=YmMyMTA2M2Y="><i
                                                class="tf-ion-social-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="product-item">
                        <div class="product-thumb">
                            <img class="img-responsive" src="images/shop/category/category-2.jpg" alt="product-img" />
                            <div class="preview-meta">
                                <ul>
                                    <li>
                                        <a href="https://instagram.com/collectionkoma?igshid=YmMyMTA2M2Y="><i
                                                class="tf-ion-social-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="product-item">
                        <div class="product-thumb">
                            <img class="img-responsive" src="images/shop/category/category-3.jpg" alt="product-img" />
                            <div class="preview-meta">
                                <ul>
                                    <li>
                                        <a href="https://instagram.com/collectionkoma?igshid=YmMyMTA2M2Y="><i
                                                class="tf-ion-social-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="product-item">
                        <div class="product-thumb">
                            <img class="img-responsive" src="images/shop/category/category-6.jpg" alt="product-img" />
                            <div class="preview-meta">
                                <ul>
                                    <li>
                                        <a href="https://instagram.com/collectionkoma?igshid=YmMyMTA2M2Y="><i
                                                class="tf-ion-social-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="side">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/slider/slider-10.jpg') }}" alt="" width="100%">
            </div>
            <div class="col-md-6 text-center">
                @if (session('success'))
                    <div class="alert" style="color: white; margin-bottom: -25px">
                        {{ session('success') }}
                        <p style="color: white">Gunakan kode promo <strong>KOMA-17052023</strong> untuk mendapatkan
                            gratis ongkir pada pembelian pertama Anda!</p>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert" style="color: red; margin-bottom: -25px">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <div class="title" style="padding-top: 50px">
                    <h1>SUBSCRIBE TO NEWSLETTER</h1>
                    <p style="color: #FEFCF3; font-size: 16px">KLAIM GRATIS ONGKIR PERTAMAMU.</p>
                </div>
                <div class="col-lg-6 col-md-offset-3">
                    <div class="input-group subscription-form" style="width: 278.5px; text-align: center;">
                        <form action="{{ route('subscribe') }}" method="post">
                            @csrf
                            @method('POST')
                            <input type="email" name="email" class="form-control"
                                placeholder="Enter Your Email Address">
                    </div>
                </div>
                <div class="col-lg-6 col-md-offset-3 text-center">
                    <div class="input-group subscription-form">
                        <span class="input-group-btn">
                            <button class="btn btn-main" type="submit">Subscribe
                                Now!</button>
                        </span>
                        </form>
                    </div>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->

        </div>
        </div>
    </section>
@endsection
