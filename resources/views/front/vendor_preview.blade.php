<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Deal : Jane Dwell Photography</title>
    <meta name="csrf-token" content="4V8Xg3JlMuk8UgviHQMIrKVtzo7eOJZuroe3aAlR">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <link rel="shortcut icon" href="/public/front/fevicon-icon.png">
    {{--    <link href="/public/front/css/bootstrap.min.css" rel="stylesheet">--}}
    <link href="{{asset('front/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
            href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,900;1,400;1,500;1,600;1,700;1,900&display=swap"
            rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- Custom styles for this site -->
    {{--    <link href="/public/front/css/custom.css" rel="stylesheet">--}}
    <link href="{{asset('front/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('front/css/responsive.css')}}" rel="stylesheet">
    {{--    <link href="/public/front/css/responsive.css" rel="stylesheet">--}}
    <style>
        @font-face {
            font-family: "Basic Sans Regular";
            src: url("https://db.onlinewebfonts.com/t/927699cb752d1b76650593a4ad6710b8.eot");
            /* IE9*/
            src: url("https://db.onlinewebfonts.com/t/927699cb752d1b76650593a4ad6710b8.eot?#iefix") format("embedded-opentype"),
                /* IE6-IE8 */ url("https://db.onlinewebfonts.com/t/927699cb752d1b76650593a4ad6710b8.woff2") format("woff2"),
                /* chrome firefox */ url("https://db.onlinewebfonts.com/t/927699cb752d1b76650593a4ad6710b8.woff") format("woff"),
                /* chrome firefox */ url("https://db.onlinewebfonts.com/t/927699cb752d1b76650593a4ad6710b8.ttf") format("truetype"),
                /* chrome firefox opera Safari, Android, iOS 4.2+*/ url("https://db.onlinewebfonts.com/t/927699cb752d1b76650593a4ad6710b8.svg#Basic Sans Regular") format("svg");
            /* iOS 4.1- */
        }

        select.form-control:not([size]):not([multiple]) {
            height: auto !important;
        }

        .navbar-form .form-control {
            padding: 0 12px !important;
            height: auto;
        }

        .navbar-header {
            padding: 0 12px !important;
        }

        .btn-primary {
            color: #fff !important;
            background-color: #f2a391 !important;
            border-color: #f2a391 !important;
            text-transform: uppercase !important;
            display: table !important;
            margin: 10px auto !important;
            font-size: 14px !important;
            font-weight: 800 !important;
            width: 50%;
        }

        .btn-info {
            color: #fff !important;
            background-color: #636680 !important;
            border-color: #c2c6e9 !important;
            text-transform: uppercase !important;
            display: table !important;
            margin: 10px auto !important;
            font-size: 14px !important;
            font-weight: 800 !important;
            width: 50%;
        }

        .pink-bgBox .form-group,
        .pink-bgBox .form-group input {
            margin-bottom: 0 !important;
        }

        .pink-bgBox .form-group input,
        .pink-bgBox .form-group textarea {
            background: white !important;
        }

        #preview_title {
            text-transform: uppercase;
        }
        .preview_class{
            background: green;
            padding: 10px;
            color: white;
            border-radius: 10px;
            display: block;
            margin-top: 10px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link
            href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet">
    <link
            href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap"
            rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
</head>
@php
    use App\Models\VendorCompanyProfile;
$advertiser = Auth::user();
    $vendorcompany = VendorCompanyProfile::select('*')->where('field_key',
    'company_name')->where('user_id',$advertiser->id)->get();
$companyslogan = VendorCompanyProfile::select('*')->where('field_key',
    'company_bio')->where('user_id',$advertiser->id)->get();
    $vendorimage = VendorCompanyProfile::select('*')->where('field_key',
    'company_logo')->where('user_id',$advertiser->id)->get();
    $vendorwebsite = VendorCompanyProfile::select('*')->where('field_key',
    'company_website_url')->where('user_id',$advertiser->id)->get();
    $vendorfacebook = VendorCompanyProfile::select('*')->where('field_key',
    'company_facebook_url')->where('user_id',$advertiser->id)->get();
    $vendorinsta = VendorCompanyProfile::select('*')->where('field_key',
    'company_instagram_url')->where('user_id',$advertiser->id)->get();

    // $vendortwitter = VendorCompanyProfile::select('*')->where('field_key',
    //'company_twitter_url')->where('user_id',$advertiser->id)->get();
     // $vendortiktok = VendorCompanyProfile::select('*')->where('field_key',
   // 'company_tiktok_url')->where('user_id',$advertiser->id)->get();
@endphp


<body>

<main class="middle-area inner-page sidebar-fixed" id="category-page">

    <nav class="navbar navbar-expand-lg bg-dark navbar-dark" style="position:relative">
        <a class="navbar-brand logo-area" href="/"><img src="{{asset('front/images/logo.png')}}"
                                                        alt="Deals for Weddings" class="mx-auto d-block img-fluid"/>
        </a>
        <a href=""><img src="{{asset('front/images/account-mobile-view.png')}}" alt="Account"
                        class="img-fluid account-img"/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-md-none d-lg-block d-xl-block">

                    <div class="accountBox2">
                        <h6 style="margin-top:0; color:#fff;">oh hey, Advertiser Shop <br><a
                                    style="font-size:1.5em;" href="/dashboard">your account</a>
                        </h6>
                        <img src="{{asset('front/images/account.png')}}"
                             class="mx-auto d-block img-fluid" alt="Account"/>
                    </div>

                </li>
                <li class="nav-item d-block d-md-block d-lg-none d-xl-none mt-4">
                    <a class="nav-link" href="#">
                        <div class="form-group">
                            <select class="form-control" id="category">
                                <option value="">Select Category</option>
                                <option value="photography">Photography</option>
                                <option value="music-night">Music &amp; Entertainment</option>
                                <option value="photobooth">Photobooth</option>
                                <option value="restaurent">Catering</option>
                                <option value="floral-decor">Floral &amp; Decor</option>
                                <option value="honeymoon-travel">Honeymoon &amp; Travel</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="state">
                                <option value="">Select City</option>
                                <option value="WPB">WPB</option>
                                <option value="MIA">MIA</option>
                                <option value="TPA">TPA</option>
                                <option value="ORL">ORL</option>
                                <option value="JAX">JAX</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 purple-bg py-4 px-3" id="sidebar" style="position: absolute;">
                <div class="side-body-section">

                    <div class="form-group">
                        <select class="form-control" id="category">
                            <option value="">Select Category</option>
                            <option value="restaurent">Catering</option>
                            <option value="floral-decor">Floral &amp; Decor</option>
                            <option value="honeymoon-travel">Honeymoon &amp; Travel</option>
                            <option value="music-night">Music &amp; Entertainment</option>
                            <option value="photobooth">Photobooth</option>
                            <option value="photography">Photography</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="state">
                            <option value="">Select City</option>
                            <option value="WPB">West Palm Beach-Boca Raton</option>
                            <option value="MIA">Miami-Ft. Lauderdale</option>
                            <option value="TPA">Tampa-Sarasota</option>
                            <option value="ORL">Orlando</option>
                            <option value="JAX">Jacksonville</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
                <div class="side-footer-section">
                    <div class="row">
                        <div class="col-md-12">
                            <ul>
                                <li><a href=""><img src="{{asset('front/images/fb-purple.png')}}"
                                                    class="d-block img-fluid" alt="Facebook"/></a></li>
                                <li><a href=""><img src="{{asset('front/images/tw-purple.png')}}"
                                                    class="d-block img-fluid" alt="Twitter"/></a></li>
                                <li><a href=""><img
                                                src="{{asset('front/images/instagram-purple.png')}}"
                                                class="d-block img-fluid" alt="Instgram"/></a></li>
                            </ul>
                            <p class="my-3"><a href="/about_us">About us</a><br><a
                                        href="/faqs">Faq</a><br><a
                                        href="/contact">Contact</a><br><a
                                        href="/blog">Blog</a></p>
                            <p><a href="/vendor/login">Advertiser Login</a><br><a
                                        href="/privacy-policy">Privacy Policy</a><br/><a
                                        href="/term_conditions">Terms & Conditions</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9 pink-bg py-4 px-3" id="middle-section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="middle-content-area vendor-description">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-6 col-xl-6">

                                    <h1 class="m-0">

                                        @foreach ($vendorcompany as $key => $item)
                                            {{$item->field_value}}
                                        @endforeach
                                    </h1>


                                    <ul class="vendor-link">
                                        
                                        <li>
                                            <a class="text-dark" href="@foreach ($vendorwebsite as $key => $item)
                                            {{$item->field_value}}
                                            @endforeach" target="_blank">

                                                @foreach ($vendorwebsite as $key => $item)
                                                    @if(isset($item->field_value))
                                                        Website <img src="{{asset('images/globe-icon.png')}}" style="width: 13px;margin-top: -4px !important;" alt="">
                                                    @endif

                                                @endforeach
                                            </a>
                                        </li>

                                        <li>
                                            <a href="@foreach ($vendorfacebook as $key => $item)
                                            {{$item->field_value}}
                                            @endforeach" target="_blank">

                                                @foreach ($vendorfacebook as $key => $item)
                                                    @if(isset($item->field_value))
                                                 <img src="{{asset('front/images/fb-purple.png')}}"
                                                     class="d-block img-fluid" alt="Facebook">
                                                    @endif

                                                @endforeach
                                            </a>
                                        </li>

                                        <li>
                                            <a href="@foreach ($vendorinsta as $key => $item)
                                                {{$item->field_value}}
                                                @endforeach" target="_blank">

                                                @foreach ($vendorinsta as $key => $item)
                                                    @if(isset($item->field_value))

                                                <img src="{{asset('front/images/instagram-purple.png')}}"
                                                        class="d-block img-fluid" alt="Instgram">
                                                    @endif
                                                @endforeach
                                            </a>
                                        </li>


{{--                                        <li>--}}
{{--                                            <a href="@foreach ($vendortwitter as $key => $item)--}}
{{--                                            {{$item->field_value}}--}}
{{--                                            @endforeach" target="_blank">--}}

{{--                                                @foreach ($vendortwitter as $key => $item)--}}
{{--                                                    @if(isset($item->field_value))--}}
{{--                                                        Twitter--}}
{{--                                                        <img src="{{asset('front/images/instagram-purple.png')}}"--}}
{{--                                                             class="d-block img-fluid" alt="Instgram">--}}
{{--                                                    @endif--}}
{{--                                                @endforeach--}}
{{--                                            </a>--}}
{{--                                        </li>--}}


{{--                                        <li>--}}
{{--                                            <a href="@foreach ($vendortiktok as $key => $item)--}}
{{--                                            {{$item->field_value}}--}}
{{--                                            @endforeach" target="_blank">--}}

{{--                                                @foreach ($vendortiktok as $key => $item)--}}
{{--                                                    @if(isset($item->field_value))--}}

{{--                                                        TikTok--}}
{{--                                                        <img src="{{asset('front/images/instagram-purple.png')}}"--}}
{{--                                                             class="d-block img-fluid" alt="Instgram">--}}
{{--                                                    @endif--}}
{{--                                                @endforeach--}}
{{--                                            </a>--}}
{{--                                        </li>--}}


                                    </ul>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="slider-section mt-3">
                                                <div id="demo" class="carousel slide" data-ride="carousel">
                                                    <!-- The slideshow -->
                                                    <div class="carousel-inner">

                                                        <div class="carousel-item active">
                                                                <img id="preview_img" class="deal-page-main-img"
                                                                     src="{{isset($deal->image) ? asset($deal->image) : asset('uploads/deals/dummy-product-image.jpg')}}"
                                                                     alt="Jane Dwell Photography"
                                                                     class="d-block img-fluid w-100"/>
                                                        </div>


                                                    </div>
                                                    <!-- Left and right controls -->


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-3">

                                            @isset($companyslogan)
                                                @foreach ($companyslogan as $key => $item)
                                                    {!! $item->field_value ?? '' !!}
                                                @endforeach
                                            @endisset
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
{{--                                                                            <div class="row">--}}
{{--                                                                                <div class="col-8">--}}
{{--                                                                                    <h3>Comments</h3>--}}
{{--                                                                                    <p>2 Comments</p>--}}
{{--                                                                                </div>--}}
{{--                                                                                <div class="col-4">--}}
{{--                                                                                    <a href="javascript:void(0)" class="leave-review-btn"--}}
{{--                                                                                        data-toggle="modal" data-target="#review-from-modal">Leave a--}}
{{--                                                                                        review</a>--}}
{{--                                                                                </div>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div class="row">--}}
{{--                                                                                <div class="col-12">--}}
{{--                                                                                    <div class="commentBox mb-3">--}}
{{--                                                                                        <div class="row">--}}
{{--                                                                                            <div class="col-3">--}}
{{--                                                                                                <img src="{{asset('front/images/img3.png')}}"--}}
{{--                                                                                                    class="d-block img-fluid" alt="" />--}}
{{--                                                                                                <span>06-17-21</span>--}}
{{--                                                                                            </div>--}}
{{--                                                                                            <div class="col-9">--}}
{{--                                                                                                <h5>What is deal?</h5>--}}
{{--                                                                                                <p>Ut sit amet ipsum diam. Quisque facilisis nibh ut orci--}}
{{--                                                                                                    malesuada, vitae tristique arcu mollis.--}}
{{--                                                                                                </p>--}}
{{--                                                                                            </div>--}}
{{--                                                                                        </div>--}}
{{--                                                                                    </div>--}}
{{--                                                                                </div>--}}
{{--                                                                            </div>--}}

{{--                                    <div class="">--}}
{{--                                        <h6>Description</h6>--}}
{{--                                        <p>{!! $deal->description ?? '' !!}</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="">--}}
{{--                                        <h6>Teaser Text</h6>--}}
{{--                                            <p>{!! $deal->teaser_text ?? '' !!}</p>--}}
{{--                                    </div>--}}

                                </div>
                                <div class="col-md-12 col-sm-12 col-lg-6 col-xl-6">
                                    <div class="pink-bgBox mb-4 shadow">
                                        <div class="white-bg">

                                            <div class="alert alert-success alert-block" id="successmsg_3"
                                                 style="display:none;"></div>
                                            <div class="alert alert-danger alert-block" id="dangermsg_3"
                                                 style="display:none;"></div>
                                            <div class="row">
                                                <div class="col-12 col-lg-7">
                                                    <h2 class="text-capitalize font-weight-bold" >

                                                        @if (Auth::user()->role == 1)
                                                            By Admin
                                                        @else
                                                            @foreach ($vendorcompany as $key => $item)
                                                                {{$item->field_value}}
                                                            @endforeach
                                                        @endif

                                                    </h2>
                                                </div>
                                                <div class="col-12 col-lg-5 mb-3 mb-lg-0 text-center text-lg-right">
                                            <span  class="px-3 py-2 text-white font-weight-bold" style="background-image: url({{asset('images/ribbon.svg')}});
                                                    background-repeat: no-repeat; background-size: cover">
                                                    Save Over $<span id="preview_class_price"></span>
                                            </span>
                                                </div>

                                            </div>


                                            <div class="strip-line"></div>
                                            <h3>Use Code <span id="preview_discount" class="preview_class">XXXXXX</span></h3>
                                            <div class="text-center" style="display:flex;">
                                                <a href="#contact_vendor"
                                                   data-toggle="modal" data-target="#contactVendorModal"
                                                   class="btn btn-primary">Contact Vendor</a>
                                                <a style="cursor:pointer;color:#fff;" class="btn btn-info save-deal"
                                                   data-price="120.00" data-deal="3">Save Deal</a>
                                            </div>
                                            <div id="preview_desc">
                                                <p>Vestibulum at velit vel risus cursus lacinia nec sit amet diam.
                                                    Duis
                                                    in hendrerit tortor. </p>
                                                <p>Nunc sed vulputate est, nec dictum dolor.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        {{-- //Contact vendor Modal--}}

                        <!-- Modal -->
                            <div class="modal fade" id="contactVendorModal" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">CONTACT VENDOR</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="pink-bgBox mb-4">
                                                <h4>Contact Vendor</h4>
                                                <p class="m-0 text-center">go ahead, say hi!</p>
                                                <div id="message"></div>
                                                <input type="hidden" value="6">
                                                <input type="hidden" value="3">
                                                <div class="form-group">
                                                    <label for="name">Your name*</label>
                                                    <input type="text" class="form-control" id="name"
                                                           placeholder="<AUTOFILL NAME>" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email*</label>
                                                    <input type="email" class="form-control" id="email"
                                                           placeholder="<AUTOFILL E-MAIL>" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Phone number*</label>
                                                    <input type="number" class="form-control" id="phone"
                                                           placeholder="<AUTOFILL PHONE>" value="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="date">Wedding date*</label>
                                                    <input type="date" class="form-control" id="date"
                                                           placeholder="<AUTOFILL DATE>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="discount-code">Your message*</label>
                                                    <textarea class="form-control" rows="6" id="message"></textarea>
                                                </div>
                                                <div class="form-group text-center">
                                                    <button type="button" class="btn btn-info"
                                                            id="contact-send">Send
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row mt-5">
                                <div class="col-md-6 offset-md-3 text-center">

                                    <p>In the meantime, find other great vendors.</p>
                                    <div class="form-group">
                                        <select class="form-control" id="category">
                                            <option value="">Select Category</option>
                                            <option value="restaurent">Catering</option>
                                            <option value="floral-decor">Floral &amp; Decor</option>
                                            <option value="honeymoon-travel">Honeymoon &amp; Travel</option>
                                            <option value="music-night">Music &amp; Entertainment</option>
                                            <option value="photobooth">Photobooth</option>
                                            <option value="photography">Photography</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="state">
                                            <option value="">Select City</option>
                                            <option value="WPB">WPB</option>
                                            <option value="MIA">MIA</option>
                                            <option value="TPA">TPA</option>
                                            <option value="ORL">ORL</option>
                                            <option value="JAX">JAX</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Show Me The
                                            Deals!
                                        </button>
                                    </div>

                                    <p class="d-none d-md-none d-sm-none d-lg-block d-xl-block">&copy; Deals For
                                        Weddings </p>
                                </div>
                            </div>
                            <div class="row mt-5 mb-3">
                                <div class="col-sm-12">
                                    <h4 class="pink-text text-center">While you're at it, <span>check out these
                                                similar deals...</span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="review-from-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" id="close-modal">&times;</button>
                    <h4 class="modal-title float-left">Add Review</h4>
                </div>
                <div class="modal-body">
                    <div id="r_message"></div>
                    <input type="hidden" value="6">
                    <input type="hidden" value="3">
                    <div class="form-group">
                        <label for="m_name">Your name*</label>
                        <input type="text" class="form-control" id="m_name" placeholder="<AUTOFILL NAME>" value="">
                    </div>
                    <div class="form-group">
                        <label for="m_email">Email*</label>
                        <input type="email" class="form-control" id="m_email" placeholder="<AUTOFILL E-MAIL>"
                               value="">
                    </div>
                    <div class="form-group">
                        <label for="title">Title*</label>
                        <input type="text" class="form-control" id="title" placeholder="Title" value=""="">
                    </div>
                    <div class="form-group">
                        <label for="m_message">Your Review*</label>
                        <textarea class="form-control" rows="10" id="m_message"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="button" class="btn btn-info" id="review-send">Send</button>
                    </div>
                </div>

            </div>

        </div>
    </div>

</main>
</body>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="social-icon">
                    <li><a href=""><img src="/public/front/images/fb-footer.png"
                                        class="d-block img-fluid" alt="Facebook"/></a></li>
                    <li><a href=""><img src="/public/front/images/tw-footer.png"
                                        class="d-block img-fluid" alt="Twitter"/></a></li>
                    <li><a href=""><img src="/public/front/images/instagram-footer.png"
                                        class="d-block img-fluid" alt="Instgram"/></a></li>
                </ul>
                <ul class="footer-link">
                    <li><a href="">About us</a></li>
                    <li><a href="">Faq</a></li>
                    <li><a href="">Contact</a></li>
                    <li><a href="">Privacy Policy</a></li>
                </ul>
                <p><a href="" class="white-btn">Advertiser Log in</a></p>
            </div>
        </div>
    </div>
</footer>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{--<script src="/public/front/js/jquery.min.js"></script>--}}
<script src="{{asset('front/js/jquery.min.js')}}"></script>
{{--<script src="/public/front/js/bootstrap.min.js"></script>--}}
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/popper.min.js')}}"></script>
<script src="{{asset('front/js/custom.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    //deal view
    $(document).ready(function () {
        let formData = $('#deal_view').serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/deal-view",
            method: 'post',
            data: formData,
            // beforeSend: function(){
            //   // Show image container
            //   $(".loading").show();
            // },
            success: function (response) {
                if (response.status == 'success') {
                    setTimeout(function () {
                        console.log('success');
                    }, 8000);
                } else {
                    console.log('failed');
                }
            },
            // complete:function(data){
            //   // Hide image container
            //   $(".loading").hide();
            // }
        });
    });
    //Contact Send Vendor
    $('body').on('click', '#contact-send', function () {
        let formData = $('#contact_vendor').serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/contact-vendor",
            method: 'post',
            data: formData,
            // beforeSend: function(){
            //   // Show image container
            //   $(".loading").show();
            // },
            success: function (response) {
                if (response.status == 'success') {
                    setTimeout(function () {
                        $('#message').html('<p class="alert alert-success">' + response.message + '</p>');
                    }, 8000);
                } else {
                    $('#message').html('<p class="alert alert-danger">' + response.message + '</p>');
                }
            },
            // complete:function(data){
            //   // Hide image container
            //   $(".loading").hide();
            // }
        });
    });
    $('body').on('click', '#review-send', function () {
        let formData = $('#modal_review_form').serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/send-review",
            method: 'post',
            data: formData,
            // beforeSend: function(){
            //   // Show image container
            //   $(".loading").show();
            // },
            success: function (response) {
                if (response.status == 'success') {
                    setTimeout(function () {
                        $('#r_message').html('<p class="alert alert-success">' + response.message + '</p>');
                    }, 3000);
                    setTimeout(function () {
                        $('#close-modal').trigger('click');
                    }, 8000);

                } else {
                    $('#r_message').html('<p class="alert alert-danger">' + response.message + '</p>');
                }
            },
            // complete:function(data){
            //   // Hide image container
            //   $(".loading").hide();
            // }
        });
    });
    //save deal
    $('body').on('click', '.save-deal', function () {
        let deal_id = $(this).data('deal');
        let price = $(this).data('price');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/save-deal",
            method: 'post',
            data: {
                'deal_id': deal_id,
                'price': price
            },
            // beforeSend: function(){
            //   // Show image container
            //   $(".loading").show();
            // },
            success: function (response) {
                if (response.status == 'success') {
                    $('#dangermsg_' + deal_id).hide();
                    $('#successmsg_' + deal_id).show();
                    $('#successmsg_' + deal_id).html(response.message);

                    /* setTimeout(function(){
                    	$('.alert-success').html(response.message);  
                    }, 8000);   */
                } else {
                    $('#successmsg_' + deal_id).hide();
                    $('#dangermsg_' + deal_id).show();
                    $('#dangermsg_' + deal_id).html(response.message);
                    //$('.alert-danger').html(response.message);
                }
            },
            // complete:function(data){
            //   // Hide image container
            //   $(".loading").hide();
            // }
        });
    });
</script>
<script>
    var preview_value = document.getElementById('preview_price');
    console.log(preview_value);

</script>

</html>