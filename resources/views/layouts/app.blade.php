<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KOMA</title>

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Themefisher Constra HTML Template v1.0">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css"
        rel="stylesheet" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}" />

    <!-- Tambahkan link CSS Toastr di dalam tag head -->
    <link rel="stylesheet" href="{{ asset('toastr/build/toastr.min.css') }}">

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
                            @if (null !== session('cart') && count((array) session('cart')) > 0)
                                <a href="#!" class="dropdown-toggle" data-toggle="modal" data-target="dropdown">
                                    <i class="fa fa-shopping-cart"><span
                                            style="font-size: 12px; color: black;">{{ count((array) session('cart')) }}</span></i>
                                </a>
                            @else
                                <a href="#!" class="dropdown-toggle" data-toggle="modal" data-target="dropdown"><i
                                        class="fa fa-shopping-cart"></i></a>
                            @endif



                            <div class="dropdown-menu cart-dropdown">
                                <!-- Cart Item -->

                                @php
                                    $total = 0;
                                    $totalQuantity = 0;
                                @endphp
                                @if (session('cart'))
                                    @foreach (session('cart') as $id => $details)
                                        @php
                                            $total += $details['price'] * $details['quantity'];
                                            $totalQuantity += $details['quantity'];
                                        @endphp
                                        <div class="media">
                                            <a class="pull-left" href="#!">
                                                <img class="media-object"
                                                    src="{{ asset('storage/product/' . $details['images']) }}"
                                                    alt="image" />
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="#!">{{ $details['name'] }}</a>
                                                </h4>
                                                <div class="cart-price">
                                                    <span>{{ $details['quantity'] }} Pcs</span>
                                                    <span>IDR {{ number_format($details['price']) }}</span>
                                                </div>
                                                <h5><strong>IDR
                                                        {{ number_format($details['price'] * $details['quantity']) }}</strong>
                                                </h5>
                                            </div>
                                            <a href="{{ route('cart.remove', $id) }}" class="remove"><i
                                                    class="tf-ion-close"></i></a>
                                        </div><!-- / Cart Item -->
                                    @endforeach
                                @endif
                                <div class="cart-summary">
                                    <span>Total</span>
                                    <span class="total-price">IDR {{ number_format($total) }}</span>
                                </div>
                                <ul class="text-center cart-buttons">
                                    <li><a href="{{ route('cart.index') }}" class="btn btn-small">View Cart</a></li>
                                    @if (session('cart'))
                                        @if (count(session('cart')) > 0)
                                            <!-- Tampilkan tombol checkout -->
                                            <li><a href="{{ route('customer.checkout') }}"
                                                    class="btn btn-small btn-solid-border">Checkout</a>
                                        @endif
                                    @else
                                        <li><a href="{{ url('/on_sale') }}"
                                                class="btn btn-small btn-solid-border">Shop
                                                Now</a></li>
                                    @endif
                        </li>
                    </ul>
                </div>
                </li><!-- / Cart -->
                <li>
                    <a href="{{ url('/wishlist') }}" title="wishlist"><i class="tf-ion-ios-heart"></i></a>
                </li>

                <!-- Search -->
                <li class="dropdown search dropdown-slide">
                    <a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i
                            class="fa fa-search"></i></a>
                    <ul class="dropdown-menu search-dropdown">
                        <li>
                            <form action="post"><input type="search" class="form-control" placeholder="Search...">
                            </form>
                        </li>
                    </ul>
                </li><!-- / Search -->
                <!-- Login -->
                @if (Auth::check() && Auth::user()->isUser())
                    <li class="dropdown cart-nav dropdown-slide">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i
                                class="fa fa-user"></i></a>
                        <div class="dropdown-menu cart-dropdown">
                            <!-- Cart Item -->
                            <div class="media">
                                <a class="pull-left" href="#!">
                                    <img class="media-object" style="border-radius: 50%; width: 50px; height: 50px"
                                        src="{{ asset('storage/avatar/' . Auth::user()->avatar) }}" alt="image" />
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#!">{{ Auth::user()->name }}</a>
                                    </h4>
                                    <div class="cart-price">
                                        <span>{{ Auth::user()->email }}</span>
                                    </div>
                                    <h5><strong>{{ Auth::user()->username }}</strong>
                                    </h5>
                                    <a href="/logout"
                                        onclick="event.preventDefault(); document.getElementById('logout').submit()"
                                        class="remove"><i class="fa fa-power-off"></i> Logout</a>

                                    <form action="/logout" method="POST" id="logout">@csrf</form>
                                </div>
                            </div><!-- / Cart Item -->
                            <div class="cart-summary">
                            </div>
                            <ul class="text-center cart-buttons">
                                <li><a href="{{ route('cek.pesanan') }}" class="btn btn-small">Pesanan</a></li>

                                <li><a href="{{ url('/detail_user', Auth::user()->id) }}"
                                        class="btn btn-small btn-solid-border">Profile</a></li>
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
                            <a href="{{ url('/on_sale') }}">Sale</a>
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
                                            <li><a href="{{ url('/tmc') }}">Terms & Condition</a></li>
                                            <li><a href="{{ url('/faq') }}">FAQ</a></li>
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
    @yield('content')
</body>

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
<a href="https://wa.me/+6281321689202?text=Hallo KOMA Collection, saya tertarik dengan produknya." class="floating"
    target="_blank">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- AJAX ONGKIR -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="{{ asset('toastr/build/toastr.min.js') }}"></script>

<!-- Main Js File -->
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/jqueqy_eye.js') }}"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script type="text/javascript">
    < /body>

    <
    /html>
