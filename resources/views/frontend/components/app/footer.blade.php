<!-- footer start -->
<footer>
    <div class="footer1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-main">
                        <div class="footer-box">
                            <div class="footer-title mobile-title">
                                <h5>about</h5>
                            </div>
                            <div class="footer-contant">
                                <div class="footer-logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ $siteOption->logo_path }}" class="img-fluid" alt="logo">
                                    </a>
                                </div>
                                <ul class="paymant">
                                    <li><a href="javascript:void(0)"><img
                                                src="{{ asset('frontend/') }}/assets/imgs/pay/1.png" class="img-fluid"
                                                alt="pay"></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><img
                                                src="{{ asset('frontend/') }}/assets/imgs/pay/2.png" class="img-fluid"
                                                alt="pay"></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><img
                                                src="{{ asset('frontend/') }}/assets/imgs/pay/3.png" class="img-fluid"
                                                alt="pay"></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><img
                                                src="{{ asset('frontend/') }}/assets/imgs/pay/4.png" class="img-fluid"
                                                alt="pay"></a>
                                    </li>
                                    <li><a href="javascript:void(0)"><img
                                                src="{{ asset('frontend/') }}/assets/imgs/pay/5.png" class="img-fluid"
                                                alt="pay"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-box">
                            <div class="footer-title">
                                <h5>Quick Links</h5>
                            </div>
                            <div class="footer-contant">
                                <ul>
                                    <li><a href="{{ route('staticPages', ['page'=>'about']) }}">about us</a></li>
                                    <li><a href="{{ route('contact') }}">contact us</a></li>
                                    <li><a href="{{ route('staticPages', ['page'=>'terms']) }}">terms &amp; conditions</a></li>
                                    <li><a href="{{ route('staticPages', ['page'=>'policy']) }}">Privacy &amp; Policy</a></li>
                                    <li><a href="{{ route('staticPages', ['page'=>'returns_exchanges']) }}">returns &amp; exchanges</a></li>
                                    <li><a href="{{ route('staticPages', ['page'=>'shipping_delivery']) }}">shipping &amp; delivery</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-box">
                            <div class="footer-title">
                                <h5>contact us</h5>
                            </div>
                            <div class="footer-contant">
                                <ul class="contact-list">
                                    <li><i class="fa fa-phone"></i>call us: <span>{{ $siteOption->num1 }}</span></li>
                                    <li><i class="fa fa-envelope-o"></i>email us: {{ $siteOption->email }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-box">
                            <div class="footer-title">
                                <h5>Download App</h5>
                            </div>
                            <div class="img-app">
                                <a href=""><img src="{{ asset('frontend/') }}/assets/imgs/app-appstore.png"
                                        alt=""></a>
                                <a href=""><img src="{{ asset('frontend/') }}/assets/imgs/app-google-play.png"
                                        alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="subfooter dark-footer ">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-8 col-sm-12">
                    <div class="footer-left">
                        <p>{{ $siteOption->copyRights }}</p>
                    </div>
                </div>
                <div class="col-xl-6 col-md-4 col-sm-12">
                    <div class="footer-right">
                        <ul class="sosiyal">
                            @foreach ($socialMedia as $value)
                                @if ($value->link != null)
                                    <li><a href="{{ $value->link }}" target="_blank"><i
                                                class="fa fa-facebook"></i></a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->
