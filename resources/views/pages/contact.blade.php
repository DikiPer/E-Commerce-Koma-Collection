@extends('layouts.app')
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name">Contact Us</h1>
                        <ol class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li class="active">contact</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-wrapper">
        <div class="contact-section">
            <div class="container">
                <div class="row">
                    <!-- Contact Form -->
                    <div class="contact-form col-md-6 ">
                        @if (session('success'))
                            <div class="alert alert-success text-center">
                                <strong>{{ session('success') }}</strong>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert" style="color: red; margin-bottom: -25px">
                                @foreach ($errors->all() as $error)
                                    <li>Silahkan Login terlebih dahulu!{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="contact-form" method="post" action="{{ route('message') }}" role="form">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Your Name" class="form-control"
                                    id="name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Your Email" class="form-control"
                                    id="email">
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" placeholder="Subject" class="form-control"
                                    id="subject">
                            </div>
                            <div class="form-group">
                                <textarea rows="6" name="message" placeholder="Message" class="form-control" id="message"></textarea>
                            </div>
                            <div id="cf-submit">
                                <button type="submit" id="contact-submit" class="btn btn-transparent"
                                    value="Submit">Kirim</button>
                            </div>
                        </form>
                    </div>
                    <!-- ./End Contact Form -->

                    <!-- Contact Details -->
                    <div class="contact-details col-md-6 ">
                        <div class="google-map">
                            {{-- <div id="map"></div> --}}
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.7979543869733!2d106.74567427337739!3d-6.157809060350439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f7c012767d65%3A0xab6284fa59425b!2sJl.%20Jemb.%20Gantung%20No.144%2C%20RT.7%2FRW.8%2C%20Kedaung%20Kali%20Angke%2C%20Kecamatan%20Cengkareng%2C%20Kota%20Jakarta%20Barat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2011710!5e0!3m2!1sid!2sid!4v1683814498524!5m2!1sid!2sid"
                                width="600" height="300" style="border:1cm;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <ul class="contact-short-info">
                            <li>
                                <i class="tf-ion-ios-home"></i>
                                <span>Jl. Jembatan Gantung No. 144 Rt.07/08, Jakarta
                                    Barat</span>
                            </li>
                            <li>
                                <i class="tf-ion-android-phone-portrait"></i>
                                <span>Phone: +62 8132-1689-202</span>
                            </li>
                            <li>
                                <i class="tf-ion-android-globe"></i>
                                <span>Web : <a href="{{ url('/') }}">KOMA Collection</a></span>
                            </li>
                            <li>
                                <i class="tf-ion-android-mail"></i>
                                <span>Email: collectionkoma@gmail.com</span>
                            </li>
                        </ul>
                        <!-- Footer Social Links -->
                        <div class="social-icon">
                            <ul>
                                <li> <a href="https://www.facebook.com/profile.php?id=100084770293751&mibextid=ZbWKwL">
                                        <i class="tf-ion-social-facebook"></i>
                                    </a></li>
                                <li><a href="https://instagram.com/collectionkoma?igshid=YmMyMTA2M2Y=">
                                        <i class="tf-ion-social-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--/. End Footer Social Links -->
                    </div>
                    <!-- / End Contact Details -->
                </div> <!-- end row -->
            </div> <!-- end container -->
        </div>
    </section>
@endsection
