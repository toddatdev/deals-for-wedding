<?php
$settings = App\Models\Settings::where('id', 1)->first();
?>
<div class="col-md-3 purple-bg py-4 px-3" id="sidebar">
    <div class="side-body-section">
        <nav class="navbar navbar-expand-lg bg-light navbar-light">
            <a class="navbar-brand logo-area" href="/"><img src="{{ asset('front/images/logo.png') }}" alt="Deals for Weddings" class="mx-auto d-block img-fluid" />
            </a>
            <a href=""><img src="{{ asset('front/images/account-mobile-view.png') }}" alt="Account" class="img-fluid account-img" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <div class="row">
                        <li class="nav-item col-md-4 col-sm-4 col-xl-12 col-lg-12 col-12">
                            <a class="nav-link" href="/">
                                <div class="sidebarBox text-center text-white">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12 col-3">
                                            <img src="{{ asset('front/images/find.png') }}" class="mx-auto d-block img-fluid" alt="Find" />
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12 col-9">
                                            <div class="sideBox-content">
                                                <h5>Find</h5>
                                                <p>search for the best deal from your local wedding vendor </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item col-md-4 col-sm-4 col-xl-12 col-lg-12 col-12">
                            <a class="nav-link" href="#">
                                <div class="sidebarBox text-center text-white">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12 col-3">
                                            <img src="{{ asset('front/images/love.png') }}" class="mx-auto d-block img-fluid" alt="Love" />
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12 col-9">
                                            <div class="sideBox-content">
                                                <h5>Love</h5>
                                                <p>click the heart to save that deal to your account</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item col-md-4 col-sm-4 col-xl-12 col-lg-12 col-12">
                            <a class="nav-link" href="#">
                                <div class="sidebarBox text-center text-white">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12 col-3">
                                            <img src="{{ asset('front/images/save.png') }}" class="mx-auto d-block img-fluid save-img" alt="Save" />
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12 col-9">
                                            <div class="sideBox-content">
                                                <h5>Save</h5>
                                                <p>contact the wedding pro and give them the deal code</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item col-md-12 col-sm-12 col-xl-12 col-lg-12 col-12">
                            <a class="nav-link" href="#">
                                <div class="sidebarBox text-center text-white">
                                    <h6 class="text-white">yep, it's that <span>easy</span></h6>
                                    <p>now start saving, because the wedding is just the opening act.</p>
                                </div>
                            </a>
                        </li>
                    </div>
                </ul>
            </div>
        </nav>
    </div>
    <div class="side-footer-section">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li><a href="{{$settings->facebook}}" target="_blank"><img src="{{ asset('front/images/fb.png') }}" class="d-block img-fluid" alt="Facebook" /></a></li>
                    <li><a href="{{$settings->twitter}}" target="_blank"><img src="{{ asset('front/images/tw.png') }}" class="d-block img-fluid" alt="Twitter" /></a></li>
                    <li><a href="{{$settings->instagram}}" target="_blank"><img src="{{ asset('front/images/instagram.png') }}" class="d-block img-fluid" alt="Instgram" /></a></li>
                </ul>
                <p><a href="{{route('vendor.login')}}">Advertiser Login</a></p>
                <p><a href="{{url('blog')}}">Blog</a></p>
                <p><a href="{{route('front.privacy_policy')}}">Privacy Policy</a></p>
                <p><a href="{{route('front.term_conditions')}}">Terms & Conditions</a></p>
            </div>
        </div>
    </div>
</div>