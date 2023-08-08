@extends('theme.secondary')

@section('title', 'Deal : '.$deal->title)

@push('customCSS')

@endpush

@section('content')

    @php
        use App\Models\VendorCompanyProfile;
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

        $mailingaddress = VendorCompanyProfile::select('*')->where('field_key',
        'contacts_mailings_address')->where('user_id',$advertiser->id)->get();

        $mailingstatus = VendorCompanyProfile::select('*')->where('field_key',
        'contacts_mailings_address')->where('user_id',$advertiser->id)->first();

    @endphp
    {{--    //$mailingstatus = VendorCompanyProfile::where('status',1)--}}
    {{--    //->where('user_id',$advertiser->id)->first();--}}

    <div class="col-md-9 pink-bg py-4 px-3" id="middle-section">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="middle-content-area vendor-description">
                    @include('flash-message')
                    <div class="row mt-5">
                        <div class="col-md-12 col-sm-12 col-lg-6 col-xl-6">
                            <h1 class="m-0 text-capitalize">
                                @if ($deal->user->role == 1)
                                    By Admin
                                @else
                                    @foreach ($vendorcompany as $key => $item)
                                        {{$item->field_value}}
                                    @endforeach
                                @endif
                            </h1>
                            <ul class="vendor-link">

                                <li>
                                    <a class="text-dark" style="font-size: 18px"  href="@foreach ($vendorwebsite as $key => $item)
                                    {{$item->field_value}}
                                    @endforeach" target="_blank">

                                        @foreach ($vendorwebsite as $key => $item)
                                            @if(isset($item->field_value))
                                                Website <img src="{{asset('images/globe-icon.png')}}" style="width: 13px;margin-top: -4px !important;" alt="">
                                            @endif

                                        @endforeach
                                    </a>
                                </li>

                                <li class="">
                                    <a class="" href="@foreach ($vendorfacebook as $key => $item)
                                    {{$item->field_value}}
                                    @endforeach" target="_blank">

                                        @foreach ($vendorfacebook as $key => $item)
                                            @if(isset($item->field_value))
                                                <img src="{{asset('front/images/fb-purple.png')}}"
                                                     class="d-block img-fluid" style="width: 14px;" alt="Facebook">
                                            @endif

                                        @endforeach
                                    </a>
                                </li>

                                <li class="">
                                    <a class="" href="@foreach ($vendorinsta as $key => $item)
                                    {{$item->field_value}}
                                    @endforeach" target="_blank">

                                        @foreach ($vendorinsta as $key => $item)
                                            @if(isset($item->field_value))

                                                <img src="{{asset('front/images/instagram-purple.png')}}"
                                                     class="d-block img-fluid" style="width: 14px;" alt="Instgram">
                                            @endif
                                        @endforeach
                                    </a>
                                </li>

{{--                                <li>--}}
{{--                                    <a href="@foreach ($vendorfacebook as $key => $item)--}}
{{--                                    {{$item->field_value}}--}}
{{--                                    @endforeach"><img src="{{ asset('front/images/fb-purple.png') }}"--}}
{{--                                                      class="d-block img-fluid" alt="Facebook"></a>--}}
{{--                                </li>--}}

{{--                                <li>--}}
{{--                                    <a href="@foreach ($vendorinsta as $key => $item)--}}
{{--                                    {{$item->field_value}}--}}
{{--                                    @endforeach"><img src="{{ asset('front/images/instagram-purple.png') }}"--}}
{{--                                                      class="d-block img-fluid" alt="Instgram"></a>--}}
{{--                                </li>--}}

                            </ul>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="slider-section mt-3">
                                        <div id="demo" class="carousel slide" data-ride="carousel">
                                            <!-- The slideshow -->
                                            <div class="carousel-inner">
                                                {{-- <div class="carousel-item active">
                                                  <img src="{{ asset('public/front/images/img2.jpg') }}" class="d-block img-fluid w-100" alt=""/>
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{ asset('public/front/images/img2.jpg') }}"
                                                    class="d-block img-fluid w-100" alt="" />
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{ asset('public/front/images/img2.jpg') }}"
                                                    class="d-block img-fluid w-100" alt="" />
                                            </div>
                                        </div> --}}
                                                <div class="carousel-item active">
                                                    @if(isset($deal->image))
                                                        <img class="deal-page-main-img"
                                                             src="{{ asset($deal->image) }}"
                                                             alt="{{isset($deal->title) ? $deal->title : ''}}"
                                                             class="d-block w-75"/>
                                                    @else
                                                        <img class="deal-page-main-img"
                                                             src="{{ asset('front/images/no-image.png') }}"
                                                             alt=""
                                                             class="d-block w-75" sty/>
                                                    @endif
                                                </div>


                                            </div>

                                            <!-- Left and right controls -->
                                            {{-- <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                                        <span class="carousel-control-prev-icon"></span>
                                                      </a>
                                                      <a class="carousel-control-next" href="#demo" data-slide="next">
                                                        <span class="carousel-control-next-icon"></span>
                                                      </a> --}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">

                                @isset($mailingstatus)
                                    @if($mailingstatus['status'] == 1)
                                        @foreach ($mailingaddress as $key => $item)
                                            @isset($item->field_value)
                                                <div class="content mb-2 col-12">
                                                    <h5 class="font-weight-bold">Vendor Mailing Address</h5>
                                                    <p class="font-weight-bold">
                                                        {!! $item->field_value !!}
                                                    </p>
                                                </div>
                                            @endisset
                                        @endforeach
                                    @endif
                                @endisset

                                @foreach ($companyslogan as $key => $item)
                                    @isset($item->field_value)
                                        <div class="content mb-2 col-12">
                                            <h5 class="font-weight-bold">Company Bio</h5>
                                            <p class="font-weight-bold">{!! $item->field_value !!}</p>
                                        </div>
                                    @endisset
                                @endforeach


                            </div>
                            <br>

                            <hr>
                            {{--                <div class="row">--}}
                            {{--                    <div class="col-8">--}}
                            {{--                        <h3>Reviews</h3>--}}
                            {{--                        <p>{{count($reviews)}} Reviews</p>--}}
                            {{--                    </div>--}}
                            {{--                    <div class="col-4">--}}
                            {{--                        <a href="javascript:void(0)" class="leave-review-btn" data-toggle="modal"--}}
                            {{--                            data-target="#review-from-modal">Leave a review</a>--}}
                            {{--                    </div>--}}
                            {{--                </div>--}}
                            {{--                <div class="row">--}}
                            {{--                    <div class="col-12">--}}
                            {{--                        @if(count($reviews) > 0)--}}
                            {{--                        @foreach($reviews as $review)--}}
                            {{--                        <div class="commentBox mb-3">--}}
                            {{--                            <div class="row">--}}
                            {{--                                <div class="col-3">--}}
                            {{--                                    <img src="{{ asset('public/'.$review->userDetails->image) }}" class="d-block img-fluid"--}}
                            {{--                                        alt="" />--}}
                            {{--                                    <span>{{isset($review->created_at) ? date('m-d-y',strtotime($review->created_at)) : ''}}</span>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="col-9">--}}
                            {{--                                    <h5>{{isset($review->title) ? $review->title : ''}}</h5>--}}
                            {{--                                    <p>{{isset($review->message) ? $review->message : ''}}</p>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                            {{--                        @endforeach--}}
                            {{--                        @if(count($reviews) > 5)--}}
                            {{--			     {{ $reviews->links() }}--}}
                            {{--                    @endif--}}
                            {{--                        @else--}}
                            {{--                        <p>Be the first to review this deal !!</p>--}}
                            {{--                        @endif--}}
                            {{--                    </div>--}}
                            {{--                </div>--}}
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-6 col-xl-6">
                            <div class="pink-bgBox mb-4 shadowll shadow">
                                <div class="white-bg">

                                    <div class="alert alert-success alert-block" id="successmsg_{{$deal->id}}"
                                         style="display:none;"></div>
                                    <div class="alert alert-danger alert-block" id="dangermsg_{{$deal->id}}"
                                         style="display:none;">
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-lg-7">
{{--                                            <h2>Save over ${{isset($deal->offer_price) ? $deal->price - $deal->offer_price : $deal->price}}! </h2>--}}
                                            <h2 class="text-capitalize font-weight-bold">
                                                @if ($deal->user->role == 1)
                                                    By Admin
                                                @else
                                                    @foreach ($vendorcompany as $key => $item)
                                                        {{$item->field_value}}
                                                    @endforeach
                                                @endif
                                            </h2>
                                        </div>
                                        <div class="col-12 col-lg-5 mb-3 mb-lg-0 text-center text-lg-right">
                                            <span class="px-3 py-2 text-white font-weight-bold" style="background-image: url({{asset('images/ribbon.svg')}});
                                                    background-repeat: no-repeat; background-size: cover">
                                                Save Over ${{isset($deal->offer_price) ? $deal->price - $deal->offer_price : $deal->price}}
                                            </span>
                                        </div>

                                    </div>

                                    <div class="strip-line"></div>
                                    <h3>Use Code <span id="discount-code">{{$deal->discountcode}}</span></h3>
                                    <div class="text-center">


                                        <a href="#contact_vendor"
                                           data-toggle="modal" data-target="#contactVendorModalUser"
                                           class="btn btn-primary py-2"
                                           data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing..."
                                        >Contact Vendor
                                        </a>




                                        <a href="javascript:void(0)" class="save-deal py-2 btn btn-info"
                                           data-price="{{isset($deal->offer_price) ? $deal->offer_price : $deal->price}}"
                                           data-deal="{{isset($deal->id) ? $deal->id : ''}}"
                                           data-city="{{isset($deal->state) ? $deal->state->name : ''}}"
                                           data-categories="{{isset($deal->category) ? $deal->category->name : ''}}">

                                               <img src="{{asset('images/tabler_discount.svg')}}" style="width: 16px" alt=""> Save Deal
{{--                                            ${{isset($deal->offer_price) ? $deal->price - $deal->offer_price : $deal->price}}--}}
                                            {{--                                            <i class="fa fa-heart text-danger " style="font-size: 22px"></i>--}}
                                        </a>




                                    </div>
                                         <p>{!! $deal->description !!}
                                    </p>
                                </div>
                            </div>


                        {{-- //Contact vendor Modal--}}

                        <!-- Modal -->
                            <div class="modal fade" id="contactVendorModalUser" tabindex="-1" role="dialog"
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
                                                <form class="mt-3" id="contact_vendor" method="POST">
                                                    <div id="message"></div>
                                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                    <input type="hidden" name="deal_id" value="{{$deal->id}}">
                                                    <input type="hidden" name="advertiser" value="{{$deal->user_id}}">
                                                    <input type="hidden" name="advertiser_name"
                                                           value="{{$advertiser->fname}} {{$advertiser->lname}}">
                                                    <input type="hidden" name="deal_slug" value="{{$deal->slug}}">
                                                    <input type="hidden" name="deal_name" value="{{$deal->title}}">
                                                    <input type="hidden" name="user_name"
                                                           value="{{(Auth::check()) ? Auth::user()->fname : ''}} {{(Auth::check()) ? Auth::user()->lname : ''}}">
                                                    <div class="form-group">
                                                        <label for="name">Your name*</label>
                                                        <input type="text" class="form-control" id="name"
                                                               placeholder="<AUTOFILL NAME>"
                                                               name="name"
                                                               value="{{(Auth::check()) ? Auth::user()->fname : ''}} {{(Auth::check()) ? Auth::user()->lname : ''}}"
                                                               required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email*</label>
                                                        <input type="email" class="form-control" id="email" name="email"
                                                               placeholder="<AUTOFILL E-MAIL>"
                                                               value="{{(Auth::check()) ? Auth::user()->email : ''}}"
                                                               required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Phone number*</label>
                                                        <input type="text" class="phone form-control" id="phone"
                                                               name="phone"
                                                               placeholder="<AUTOFILL PHONE>"
                                                               value="{{isset($user->userDetails) ? $user->userDetails->phone : ''}}"
                                                               required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="date">Wedding date*</label>
                                                        <input type="date" class="form-control" id="date"
                                                               name="wedding_date"
                                                               placeholder="<AUTOFILL DATE>" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="discount-code">Your message*</label>
                                                        <textarea class="form-control" rows="6" id="message"
                                                                  name="message"
                                                                  required=""></textarea>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <button type="button" style="font-size: 20px;font-weight: 600" class="btn w-100 btn-info hideVendorBtn" id="contact-send">
                                                            Send
                                                        </button>

                                                        <button type="button" style="font-size: 20px;font-weight: 600" class="btn w-100 btn-primary showVendorBtn">
                                                            Processing...
                                                        </button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <hr>
                    @if(count($relative_deals) > 0)
                        <div class="row">
                            <div class="col-md-12 pt-3">
                                <h4 class="pink-text text-center">While you're at it, <span>check out these similar deals...</span>
                                </h4>
                            </div>
                        </div>
                        <div class="row mt-5">
                            @foreach($relative_deals as $rdeal)
                                <div class="col-md-12 col-sm-12 col-lg-4 col-xl-4">
                                    <div class="infoBox mb-3">
                                        <h5>{{isset($rdeal->title) ? $rdeal->title : ''}}</h5>
                                        @if(isset($rdeal->image))
                                            <img src="{{ asset($rdeal->image) }}"
                                                 alt="{{isset($rdeal->title) ? $rdeal->title : ''}}"
                                                 class="mx-auto d-block img-fluid w-100"/>
                                        @else
                                            <img src="{{ asset('public/front/images/no-image.png') }}" alt=""
                                                 class="mx-auto d-block img-fluid w-100"/>
                                        @endif
                                        <div class="heart-icon">
                                            <img src="{{ asset('public/front/images/heart.png') }}" alt=""
                                                 class="img-fluid">
                                        </div>
                                        <a href="#" class="btn btn-primary save-deal"
                                           data-price="{{isset($rdeal->offer_price) ? $rdeal->offer_price : $rdeal->price}}"
                                           data-deal="{{isset($rdeal->id) ? $rdeal->id : ''}}"
                                           data-city="{{isset($rdeal->state) ? $rdeal->state->name : ''}}"
                                           data-categories="{{isset($deal->category) ? $deal->category->name : ''}}">Save
                                            Over $
                                            {{isset($deal->offer_price) ? $deal->offer_price : $deal->price}}</a>
                                        <a href="{{route('home.deal_detail', $rdeal->slug)}}" class="btn btn-info">Show
                                            Me The Deal</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <a href="{{route('home.allDeals')}}" class="btn btn-primary">See More</a>
                            </div>
                        </div>
                    @endif
                    <div class="row mt-5">
                        <div class="col-md-6 offset-md-3 text-center">
                            <form class="my-5 category-form" method="GET" action="{{route('home.allDeals')}}">
                                <p>In the meantime, find other great vendors.</p>
                                <div class="form-group">
                                    <select class="form-control" id="category" name="category" required="">
                                        <option value="">Select Category</option>
                                        @foreach($categories->sortBy('name') as $category)
                                            <option value="{{isset($category->slug) ? $category->slug : ''}}"
                                                    {{isset($_REQUEST['category']) ? (($_REQUEST['category'] == $category->slug) ? 'selected="selected"' : '') : ''}}>
                                                {{isset($category->name) ? $category->name : ''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="state" name="state" required="">
                                        <option value="">Select City</option>
                                        @foreach($states as $state)
                                            <option value="{{isset($state->code) ? $state->code : ''}}"
                                                    {{isset($_REQUEST['state']) ? (($_REQUEST['state'] == $state->code) ? 'selected="selected"' : '') : ''}}>
                                                {{isset($state->name) ? $state->name : ''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Show Me The Deals!</button>
                                </div>
                            </form>
                            <p class="d-none d-md-none d-sm-none d-lg-block d-xl-block">&copy; Deals For Weddings </p>
                        </div>
                    </div>
                    <div class="row mt-5 mb-3">
                        <div class="col-sm-12">
                            <h4 class="pink-text text-center">While you're at it,
                                <span>check out these similar deals...</span></h4>
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
                    <form class="mt-3" id="modal_review_form" method="POST">
                        <div id="r_message"></div>
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="deal_id" value="{{$deal->id}}">
                        <input type="hidden" name="advertiser" value="{{$deal->user_id}}">
                        <input type="hidden" name="advertiser_name"
                               value="{{$advertiser->fname}} {{$advertiser->lname}}">
                        <input type="hidden" name="deal_slug" value="{{$deal->slug}}">
                        <input type="hidden" name="deal_name" value="{{$deal->title}}">
                        <input type="hidden" name="user_name"
                               value="{{(Auth::check()) ? Auth::user()->fname : ''}} {{(Auth::check()) ? Auth::user()->lname : ''}}">
                        <div class="form-group">
                            <label for="m_name">Your name*</label>
                            <input type="text" class="form-control" id="m_name" placeholder="<AUTOFILL NAME>"
                                   name="name"
                                   value="{{(Auth::check()) ? Auth::user()->fname : ''}} {{(Auth::check()) ? Auth::user()->lname : ''}}"
                                   required="">
                        </div>
                        <div class="form-group">
                            <label for="m_email">Email*</label>
                            <input type="email" class="form-control" id="m_email" name="email"
                                   placeholder="<AUTOFILL E-MAIL>"
                                   value="{{(Auth::check()) ? Auth::user()->email : ''}}"
                                   required="">
                        </div>
                        <div class="form-group">
                            <label for="title">Title*</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value=""
                                   required="">
                        </div>
                        <div class="form-group">
                            <label for="m_message">Your Review*</label>
                            <textarea class="form-control" rows="10" id="m_message" name="message"
                                      required=""></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="button" class="btn btn-info" id="review-send">Send</button>
                        </div>
                    </form>
                </div>
                {{-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="close-modal">Close</button>
          </div> --}}
            </div>

        </div>
    </div>
    <form style="display: none" class="mt-3" id="deal_view" method="POST">
        <div id="message"></div>
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <input id="user_role" type="hidden" name="user_role" value="{{Auth::user()->role}}">
        <input type="hidden" name="deal_id" value="{{$deal->id}}">
        <input type="hidden" name="advertiser" value="{{$deal->user_id}}">
        <input type="hidden" name="advertiser_name" value="{{$advertiser->fname}} {{$advertiser->lname}}">
        <input type="hidden" name="deal_slug" value="{{$deal->slug}}">
        <input type="hidden" name="deal_name" value="{{$deal->title}}">
        <div class="form-group">
            <label for="name">Your name*</label>
            <input type="text" class="form-control" id="vname" placeholder="<AUTOFILL NAME>" name="user_name"
                   value="{{(Auth::check()) ? Auth::user()->fname : ''}} {{(Auth::check()) ? Auth::user()->lname : ''}}"
                   required="">
        </div>
        <div class="form-group">
            <label for="email">Email*</label>
            <input type="email" class="form-control" id="vemail" name="user_email" placeholder="<AUTOFILL E-MAIL>"
                   value="{{(Auth::check()) ? Auth::user()->email : ''}}" required="">
        </div>
        <div class="form-group">
            <label for="phone">Phone number*</label>
            <input type="number" class="form-control" id="vphone" name="user_phone" placeholder="<AUTOFILL PHONE>"
                   value="{{isset($user->userDetails) ? $user->userDetails->phone : ''}}" required="">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" id="vdate" name="wedding_date" placeholder="<AUTOFILL DATE>"
                   value="{{isset($user->userDetails) ? $user->userDetails->wedding_date : ''}}">
        </div>
        <div class=" form-group text-center">
            <button type="button" class="btn btn-info" id="deal_send">Send</button>
        </div>
    </form>
@endsection

@push('customJs')
    <script type="text/javascript">
        //deal view
        $(document).ready(function () {
            if ($('#user_role').val() == 2) {
                let formData = $('#deal_view').serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('home.deal_view')}}",
                    method: 'post',
                    data: formData,
                    // beforeSend: function(){
                    //   // Show image container
                    //   $(".loading").show();
                    // },
                    success: function (response) {
                        if (response.status == 'success') {

                            console.log('success');

                        } else {
                            console.log('failed');
                            console.log(formData);
                        }
                    },
                    // complete:function(data){
                    //   // Hide image container
                    //   $(".loading").hide();
                    // }
                });
            } else {
                console.log('not user');
            }
        });
        $(document).ready(function () {
            if ($('#user_role').val() == 2) {
                let formData = $('#deal_view').serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('deal_notify')}}",
                    method: 'get',
                    data: formData,
                    // beforeSend: function(){
                    //   // Show image container
                    //   $(".loading").show();
                    // },
                    success: function (response) {
                        if (response.status == 'success') {

                            console.log('success');

                        } else {
                            console.log('failed notify');
                            console.log(formData);
                        }
                    },

                    error:function (  jqXHR,  textStatus,  errorThrown ) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }

                    // complete:function(data){
                    //   // Hide image container
                    //   $(".loading").hide();
                    // }
                });
            } else {
                console.log('not user');
            }
        });

        $('.showVendorBtn').hide();
        //Contact Send Vendor
        $('body').on('click', '#contact-send', function () {


            $('.hideVendorBtn').hide();
            $('.showVendorBtn').show();

            let formData = $('#contact_vendor').serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('home.contact_vendor')}}",
                method: 'post',
                data: formData,
                // beforeSend: function(){
                //   // Show image container
                //   $(".loading").show();
                // },
                success: function (response) {
                    if (response.status == 'success') {
                        setTimeout(function () {
                            $('#message').html('<p class="alert alert-success font-weight-bold">' + response.message + '</p>');
                        }, 1000);

                        $('.hideVendorBtn').show();
                        $('.showVendorBtn').hide();

                    } else {
                        $('#message').html('<p class="alert alert-danger font-weight-bold">' + response.message + '</p>');
                        $('.hideVendorBtn').show();
                        $('.showVendorBtn').hide();
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
                url: "{{route('home.send_review')}}",
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
                            location.reload();
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
            let city = $(this).data('city');
            let categories = $(this).data('categories');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('home.save_deal')}}",
                method: 'post',
                data: {
                    'deal_id': deal_id,
                    'price': price,
                    'city': city,
                    'category': categories
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
        /*******************************************************
         * create a filter that will be used to determine
         * which keystrokes are allowed in the input field
         * and which are not. Since we're working exclusively
         * with phone numbers, we'll need the following:
         * -- digits 0 to 9 from the numeric keys
         * -- digits 0 to 9 from the num pad keys
         * -- arrow keys (left/right)
         * -- backspace / delete for correcting
         * -- tab key to allow focus to shift
         *******************************************************/
        var filter = [];

        //since we're looking for phone numbers, we need
        //to allow digits 0 - 9 (they can come from either
        //the numeric keys or the numpad)
        const keypadZero = 48;
        const numpadZero = 96;

        //add key codes for digits 0 - 9 into this filter
        for (var i = 0; i <= 9; i++) {
            filter.push(i + keypadZero);
            filter.push(i + numpadZero);
        }

        //add other keys that might be needed for navigation
        //or for editing the keyboard input
        filter.push(8);     //backspace
        filter.push(9);     //tab
        filter.push(46);    //delete
        filter.push(37);    //left arrow
        filter.push(39);    //right arrow

        /*******************************************************
         * replaceAll
         * returns a string where all occurrences of a
         * string 'search' are replaced with another
         * string 'replace' in a string 'src'
         *******************************************************/
        function replaceAll(src, search, replace) {
            return src.split(search).join(replace);
        }

        /*******************************************************
         * formatPhoneText
         * returns a string that is in XXX-XXX-XXXX format
         *******************************************************/
        function formatPhoneText(value) {
            value = this.replaceAll(value.trim(), "-", "");

            if (value.length > 3 && value.length <= 6)
                value = value.slice(0, 3) + "-" + value.slice(3);
            else if (value.length > 6)
                value = value.slice(0, 3) + "-" + value.slice(3, 6) + "-" + value.slice(6);

            return value;
        }

        /*******************************************************
         * validatePhone
         * return true if the string 'p' is a valid phone
         *******************************************************/
        function validatePhone(p) {
            var phoneRe = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;
            var digits = p.replace(/\D/g, "");
            return phoneRe.test(digits);
        }

        /*******************************************************
         * onKeyDown(e)
         * when a key is pressed down, check if it is allowed
         * or not. If not allowed, prevent the key event
         * from propagating further
         *******************************************************/
        function onKeyDown(e) {
            if (filter.indexOf(e.keyCode) < 0) {
                e.preventDefault();
                return false;
            }
        }

        /*******************************************************
         * onKeyUp(e)
         * when a key is pressed up, grab the contents in that
         * input field, format them in line with XXX-XXX-XXXX
         * format and validate if the text is infact a complete
         * phone number. Adjust the border color based on the
         * result of that validation
         *******************************************************/
        function onKeyUp(e) {
            var input = e.target;
            var formatted = formatPhoneText(input.value);
            var isError = (validatePhone(formatted) || formatted.length == 0);
            var color = (isError) ? "gray" : "red";
            var borderWidth = (isError) ? "1px" : "3px";
            input.style.borderColor = color;
            input.style.borderWidth = borderWidth;
            input.value = formatted;
        }

        /*******************************************************
         * setupPhoneFields
         * Now let's rig up all the fields with the specified
         * 'className' to work like phone number input fields
         *******************************************************/
        function setupPhoneFields(className) {
            var lstPhoneFields = document.getElementsByClassName(className);

            for (var i = 0; i < lstPhoneFields.length; i++) {
                var input = lstPhoneFields[i];
                if (input.type.toLowerCase() == "text") {
                    input.placeholder = "Phone (XXX-XXX-XXXX)";
                    input.addEventListener("keydown", onKeyDown);
                    input.addEventListener("keyup", onKeyUp);
                }
            }
        }

        //MAIN
        setupPhoneFields("phone");

    </script>

@endpush