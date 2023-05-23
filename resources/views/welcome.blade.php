<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>KOMA</title>

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Themefisher Constra HTML Template v1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}" />

    <!-- Themefisher Icon font -->
    <link rel="stylesheet" href="{{ asset('plugins/themefisher-font/style.css') }}">
    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">

    <!-- Animate css -->
    <link rel="stylesheet" href="{{ asset('plugins/animate/animate.css') }}">
    <!-- Slick Carousel -->
    <link rel="stylesheet" href="{{ asset('plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/slick/slick-theme.css') }}">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Fontaswome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/brands.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/solid.min.css') }}">

    <!-- Link eye -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!-- Animated -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

</head>

<body id="body">
    <!-- Start Top Header Bar -->
    <section class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xs-12 col-sm-4">
                    <div class="contact-number">
                        <i class="tf-ion-ios-telephone"></i>
                        <span>081321689202</span>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12 col-sm-4">
                    <!-- Site Logo -->
                    <div class="logo text-center">
                        <a href="{{ url('/') }}">
                            <!-- replace logo here -->
                            <svg width="135px" height="29px" viewBox="0 0 155 29" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                    font-size="40" font-family="AustinBold, Austin" font-weight="bold">
                                    <g id="Group" transform="translate(-108.000000, -297.000000)" fill="#000000">
                                        <text id="AVIATO">
                                            <tspan x="108.94" y="325">KOMA</tspan>
                                        </text>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12 col-sm-4">
                    <!-- Cart -->
                    <ul class="top-menu text-right list-inline">
                        <li class="dropdown cart-nav dropdown-slide">
                            <a href="#!" class="dropdown-toggle" data-toggle="modal" data-target="dropdown"><i
                                    class="fa fa-shopping-cart"></i></a>
                        <li>
                            <a href="{{ url('/wishlist') }}" class="tf-ion-ios-heart" title="wishlist"></a>
                        </li>
                        <div class="dropdown-menu cart-dropdown">
                            <!-- Cart Item -->
                            <div class="media">
                                <a class="pull-left" href="#!">
                                    <i class="fa fa-cart-plus"></i>
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Cart Empty<a href="#!"></a>
                                    </h4>
                                </div>
                            </div><!-- / Cart Item -->
                        </div>
                        </li><!-- / Cart -->

                        <!-- Search -->
                        <li class="dropdown search dropdown-slide">
                            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i
                                    class="fa fa-search"></i></a>
                            <ul class="dropdown-menu search-dropdown">
                                <li>
                                    <form action="post"><input type="search" class="form-control"
                                            placeholder="Search..."></form>
                                </li>
                            </ul>
                        </li><!-- / Search -->
                        <!-- Login -->

                        @if (Auth::check() && Auth::user()->isUser())
                            <li class="dropdown dropdown-slide">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                    data-hover="dropdown"><i class="fa fa-user"></i></a>
                                <ul class="dropdown-menu dropdown">
                                    <li>Welcome, {{ Auth::user()->name }}</li>
                                    <li>
                                        <a href="/logout"
                                            onclick="event.preventDefault(); document.getElementById('logout').submit()"
                                            class="nav-link"><i class="fa fa-power-off"></i> Logout</a>
                                    </li>
                                    <form action="/logout" method="POST" id="logout">@csrf</form>
                            </li>
                    </ul>
                    </li>
                @else
                    <li class="common">
                        <a href="{{ route('login') }}" title="Login"><i class="fa fa-user"></i></a>
                    </li>
                    @endif
                    <!-- / Login -->
                    </ul><!-- / .nav .navbar-nav .navbar-right -->
                </div>
            </div>
        </div>
    </section><!-- End Top Header Bar -->

    <!-- Main Menu Section -->
    <section class="menu">
        <nav class="navbar navigation">
            <div class="container">
                <div class="navbar-header">
                    <h2 class="menu-title">Main Menu</h2>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div><!-- / .navbar-header -->

                <!-- Navbar Links -->
                <div id="navbar" class="navbar-collapse collapse text-center">
                    <ul class="nav navbar-nav">

                        <!-- Home -->
                        <li class="dropdown ">
                            <a href="{{ url('/') }}">Home</a>
                        </li><!-- / Home -->

                        <!-- Sale -->
                        <li class="dropdown ">
                            <a href="{{ url('/onsale') }}">Sale</a>
                        </li>


                        <!-- Elements -->
                        <li class="dropdown dropdown-slide">
                            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">Shop
                                <span class="tf-ion-ios-arrow-down"></span></a>
                            <div class="dropdown-menu">
                                <div class="row">
                                    <!-- Basic -->
                                    <div class="col-lg-6 col-md-6 mb-sm-3">
                                        <ul>
                                            <li class="dropdown-header">Top Women</li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="{{ url('/shop') }}">Blouse</a></li>
                                            <li><a href="{{ url('/shop') }}">Tunik</a></li>
                                            <li><a href="{{ url('/shop') }}">Kemeja</a></li>
                                        </ul>
                                    </div>

                                    <!-- Layout -->
                                    <div class="col-lg-6 col-md-6 mb-sm-3">
                                        <ul>
                                            <li class="dropdown-header">Bottom</li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="{{ url('/shop') }}">Kulot</a></li>
                                        </ul>
                                    </div>

                                </div><!-- / .row -->
                            </div><!-- / .dropdown-menu -->
                        </li><!-- / Elements -->


                        <!-- Pages -->
                        <li class="dropdown full-width dropdown-slide">
                            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">About
                                <span class="tf-ion-ios-arrow-down"></span></a>
                            <div class="dropdown-menu">
                                <div class="row">

                                    <!-- About -->
                                    <div class="col-sm-3 col-xs-12">
                                        <ul>
                                            <li class="dropdown-header">About</li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                                            <li><a href="{{ url('/about') }}">About Us</a></li>
                                            <li><a href="{{ url('/coomingsoon') }}">Coming Soon</a></li>
                                        </ul>
                                    </div>
                                    <!-- Find -->
                                    <div class="col-sm-3 col-xs-12">
                                        <ul>
                                            <li class="dropdown-header">Find Us</li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="https://instagram.com/collectionkoma?igshid=YmMyMTA2M2Y="
                                                    target="_blank">Instagram</a>
                                            </li>
                                            <li><a
                                                    href="https://www.facebook.com/profile.php?id=100084770293751&mibextid=ZbWKwL">Facebook
                                                    Pages</a></li>
                                        </ul>
                                    </div>

                                    <!-- Service -->
                                    <div class="col-sm-3 col-xs-12">
                                        <ul>
                                            <li class="dropdown-header">Service</li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="{{ url('/howtoorder') }}">How to order</a></li>
                                            <li><a href="order.html">Shipping</a></li>
                                            <li><a href="address.html">Terms & Condition</a></li>
                                            {{-- <li><a href="{{ url('/faq') }}">FAQ</a></li> --}}
                                        </ul>
                                    </div>

                                    <!-- Mega Menu -->
                                    <div class="col-sm-3 col-xs-12">
                                        <a href="{{ url('/') }}">
                                            <img class="img-responsive" src="{{ asset('images/shop/kc.png') }}"
                                                alt="menu image" />
                                        </a>
                                    </div>
                                </div><!-- / .row -->
                            </div><!-- / .dropdown-menu -->
                        </li><!-- / Pages -->
                    </ul><!-- / .nav .navbar-nav -->

                </div>
                <!--/.navbar-collapse -->
            </div><!-- / .container -->
        </nav>
    </section>

    <div class="hero-slider">
        <div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-4.png)">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 text-center">
                        <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
                        <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of
                            nature <br>
                            is hidden in details.</h1>
                        <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn"
                            href="{{ url('/shop') }}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-5.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 text-left">
                        <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
                        <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of
                            nature <br>
                            is hidden in details.</h1>
                        <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn"
                            href="{{ url('/shop') }}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-6.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 text-right">
                        <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
                        <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of
                            nature <br>
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
                @php
                    $firstData = App\Models\Product::where('discount', 1)->get();
                    $secondData = App\Models\Product::all();
                @endphp
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
                        <a href="{{ url('/onsale') }}" class="btn btn-main text-center" style="width: 200px">See
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
                    <h2>Best Seller</h2>
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
                                                <span data-toggle="modal"
                                                    data-target="#product-modal-{{ $data->id }}">
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
                                    <h5 class="price">IDR {{ number_format($data->price - $data->discount_price) }}
                                    </h5>
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
        <div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-2.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 text-center">
                        <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn"
                            href="{{ url('/shop') }}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-8.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 text-left">
                        <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn"
                            href="{{ url('/shop') }}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-1.jpg);">
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
                            <img class="img-responsive" src="images/shop/category/category-1.jpg"
                                alt="product-img" />
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
                            <img class="img-responsive" src="images/shop/category/category-2.jpg"
                                alt="product-img" />
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
                            <img class="img-responsive" src="images/shop/category/category-3.jpg"
                                alt="product-img" />
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
                            <img class="img-responsive" src="images/shop/category/category-6.jpg"
                                alt="product-img" />
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
                <div class="title" style="padding-top: 50px">
                    <h1>SUBSCRIBE TO NEWSLETTER</h1>
                    <p style="color: #FEFCF3; font-size: 16px">KLAIM GRATIS ONGKIR PERTAMAMU.</p>
                </div>
                <div class="col-lg-6 col-md-offset-3">
                    <div class="input-group subscription-form text-center" style="width: 278px">
                        <input type="text" class="form-control" placeholder="Enter Your Email Address">
                    </div>
                    <div class="input-group subscription-form">
                        <span class="input-group-btn">
                            <button class="btn btn-main" type="button">Subscribe
                                Now!</button>
                        </span>
                    </div>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->

        </div>
        </div>
    </section>
    <footer class="footer section text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="social-media">
                        <li>
                            <a href="https://www.facebook.com/profile.php?id=100084770293751&mibextid=ZbWKwL">
                                <i class="tf-ion-social-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://instagram.com/collectionkoma?igshid=YmMyMTA2M2Y=">
                                <i class="tf-ion-social-instagram"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="footer-menu text-uppercase">
                        <li>
                            <a href="{{ url('/contact') }}">CONTACT</a>
                        </li>
                        <li>
                            <a href="{{ url('/shop') }}">SHOP</a>
                        </li>
                        <li>
                            <a href="{{ url('/onsale') }}">Sale</a>
                        </li>
                        <li>
                            <a href="{{ url('/contact') }}">PRIVACY POLICY</a>
                        </li>
                    </ul>
                    <p class="copyright-text">Copyright &copy;2023, Designed &amp; Developed by <a
                            href="https://komacollection.com/">KOMA Collection</a></p>
                </div>
            </div>
        </div>
    </footer>
    <a href="https://wa.me/+6281321689202?text=Hallo KOMA Collection, saya tertarik dengan produknya."
        class="floating" target="_blank">
        <i class="fab fa-whatsapp fab-icon"></i>
    </a>

    <!--
    Essential Scripts
    =====================================-->

    <!-- Main jQuery -->
    <script src="{{ asset('plugins/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.1 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Bootstrap Touchpin -->
    <script src="{{ asset('plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <!-- Instagram Feed Js -->
    <script src="{{ asset('plugins/instafeed/instafeed.min.js') }}"></script>
    <!-- Video Lightbox Plugin -->
    <script src="{{ asset('plugins/ekko-lightbox/dist/ekko-lightbox.min.js') }}"></script>
    <!-- Count Down Js -->
    <script src="{{ asset('plugins/syo-timer/build/jquery.syotimer.min.js') }}"></script>

    <!-- slick Carousel -->
    <script src="{{ asset('plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('plugins/slick/slick-animation.min.js') }}"></script>

    <!-- Google Mapl -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
    <script type="text/javascript" src="{{ asset('plugins/google-map/gmap.js') }}"></script>

    <!-- Main Js File -->
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/jqueqy_eye.js') }}"></script>


</body>

</html>
