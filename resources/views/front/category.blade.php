@extends('theme.secondary')

@section('title', 'Category : '.(!empty($category) ? strtoupper( $category->name) : '').' in '.(!empty($state) ? strtoupper( $state->name) : ''))

@push('customCSS')

@endpush

@section('content')
    @php
        use App\Models\VendorCompanyProfile;
    @endphp


    <div class="col-md-9 pink-bg py-4 px-3" id="middle-section">
        <div class="row">
            <div class="col-md-12">
                <div class="middle-content-area mt-4">
                    <h1 class="m-0">Great {{!empty($category) ? strtoupper( $category->name) : ''}} Deals
                        <strong>in</strong> {{!empty($state) ? strtoupper( $state->name) : ''}}</h1>
                    {{-- <p class="pink-text m-0">you're beautiful your photos should be, too</p> --}}
                    @include('flash-message')
                    <br>
                    <hr>
                    <div class="row">
                        @if(count($deals) > 0)
                            @foreach($deals as $deal)
                                @if ($deal->state_id == $state->id)

                                    @php
                                        $vendorcompany = VendorCompanyProfile::select('*')->where('field_key',
                                        'company_name')->where('user_id',$deal->user_id)->get();
                                $companyslogan = VendorCompanyProfile::select('*')->where('field_key',
                                        'company_bio')->where('user_id',$deal->user_id)->get();
                                        $vendorimage = VendorCompanyProfile::select('*')->where('field_key',
                                        'company_logo')->where('user_id',$deal->user_id)->first();
                                        $vendorwebsite = VendorCompanyProfile::select('*')->where('field_key',
                                        'company_website_url')->where('user_id',$deal->user_id)->get();
                                        $vendorfacebook = VendorCompanyProfile::select('*')->where('field_key',
                                        'company_facebook_url')->where('user_id',$deal->user_id)->get();
                                        $vendorinsta = VendorCompanyProfile::select('*')->where('field_key',
                                        'company_instagram_url')->where('user_id',$deal->user_id)->get();
                                    @endphp

                                    <div class="col-md-12">
                                        <div class="photographyBox">
                                            <div class="row mb-5 py-3 {{$loop->iteration % 2 == 0 ? 'bg-light-deal shadow-sm': 'bg-white shadow-sm'}}">
                                                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-3">
                                                    <div class="photography-img">
                                                        @if(isset($deal->is_featured) && ($deal->is_featured == 1))
                                                            <span class="strip">featured</span>
                                                            <h3 class="title"></h3>
                                                        @endif

                                                            <img src="{{isset($deal->image) ? $deal->image : asset('front/images/no-image.png')}}" style="width: 250px;height: 150px" alt="">

{{--                                                        @if(isset($vendorimage))--}}
{{--                                                            <img class="" src="{{ asset($vendorimage->field_value) }}"--}}
{{--                                                                 alt="{{isset($deal->title) ? $deal->title : ''}}"--}}
{{--                                                                 class="mx-auto d-block img-fluid"--}}
{{--                                                                 style="width: 150px;height: 150px"/>--}}
{{--                                                        @elseif ($deal->user->role == 1)--}}
{{--                                                            <img class=""--}}
{{--                                                                 src="{{ asset($deal->user->userDetails->image) }}"--}}
{{--                                                                 alt="{{isset($deal->title) ? 	$deal->title : ''}}"--}}
{{--                                                                 class="mx-auto d-block img-fluid"--}}
{{--                                                                 style="width: 150px;height: 150px"/>--}}
{{--                                                        @else--}}
{{--                                                            <img class=""--}}
{{--                                                                 src="{{ asset('front/images/no-image.png') }}    "--}}
{{--                                                                 alt="" class="mx-auto d-block"--}}
{{--                                                                 style="width: 150px;height: 150px"/>--}}
{{--                                                        @endif--}}
                                                        {{--											<div class="heart-icon">--}}
                                                        {{--												<img src="{{ asset('front/images/heart.png') }}" alt="" class="img-fluid" />--}}
                                                        {{--											</div>--}}
                                                    </div>
                                                    <div class="d-block d-md-block d-sm-block d-lg-none d-xl-none">
{{--                                                        <a href="#" class="btn btn-primary save-deal"--}}
{{--                                                           data-price="{{isset($deal->offer_price) ? $deal->offer_price : $deal->price}}"--}}
{{--                                                           data-deal="{{isset($deal->id) ? $deal->id : ''}}">Save Over--}}
{{--                                                            $ {{isset($deal->offer_price) ? $deal->offer_price : $deal->price}}</a>--}}
                                                        <a href="{{route('home.deal_detail', $deal->slug)}}"
                                                           class="btn btn-info">Show Me The Deals!</a>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-sm-7 col-lg-7 col-xl-9">
                                                    <div class="alert alert-success font-weight-bold alert-block" id="successmsg_{{$deal->id}}"
                                                         style="display:none;"></div>
                                                    <div class="alert alert-danger font-weight-bold alert-block" id="dangermsg_{{$deal->id}}"
                                                         style="display:none;">
                                                    </div>
                                                    <div class="photography-content mt-5">

                                                        <div class="row">
                                                            <div class="col-12 col-lg-8">
                                                                <h4 class="text-capitalize">{{isset($deal->title) ? $deal->title : ''}}</h4>
                                                            </div>
                                                            <div class="col-12 col-lg-4 mb-3">

                                                                <a href="javascript:void(0)" class="save-deal"
                                                                   data-price="{{isset($deal->offer_price) ? $deal->offer_price : $deal->price}}"
                                                                   data-deal="{{isset($deal->id) ? $deal->id : ''}}"
                                                                   data-city="{{isset($deal->state) ? $deal->state->name : ''}}"
                                                                   data-categories="{{isset($deal->category) ? $deal->category->name : ''}}">
													                 <span class="px-2 py-1 rounded-pill font-weight-bold bg-success text-white">
                                                                   <img src="{{asset('images/tabler_discount.svg')}}"
                                                                        style="width: 16px" alt=""> Save Over ${{isset($deal->offer_price) ? $deal->price - $deal->offer_price : $deal->price}}</span>
                                                                                {{--                                            <i class="fa fa-heart text-danger " style="font-size: 22px"></i>--}}
                                                                            </a>

                                                                            {{--													<a href="#" class="ml-3 save-deal " data-price="{{isset($deal->offer_price) ? $deal->offer_price : $deal->price}}"--}}
                                                                            {{--													   data-deal="{{isset($deal->id) ? $deal->id : ''}}" data-city="{{isset($deal->state) ? $deal->state->name : ''}}"--}}
                                                                            {{--													   data-category="{{isset($deal->category_id) ? $deal->category->name : ''}}">--}}
                                                                            {{--													<span class="px-2 py-1 rounded-pill font-weight-bold bg-success text-white">--}}
                                                                            {{--														<img src="{{asset('images/tabler_discount.svg')}}" style="width: 16px" alt="">	Save Over ${{isset($deal->offer_price) ? $deal->price - $deal->offer_price : $deal->price}}--}}
                                                                            {{--													</span>--}}
                                                                            {{--													</a>--}}
                                                            </div>
                                                        </div>

                                                        <h6 {{isset($deal->state) ? $deal->state->name : ''}}</h6>
                                                            @if(isset($deal->teaser_text))
                                                                {!! $deal->teaser_text !!}
                                                            @else
                                                                <p>N/A</p>
                                                            @endif
                                                        <h3>
                                                            @if ($deal->user->role == 1)
                                                                By Admin
                                                            @else
                                                                @foreach ($vendorcompany as $key => $item)
                                                                    {{$item->field_value}}
                                                                @endforeach
                                                            @endif
                                                        </h3>
                                                        <div class="d-none d-md-none d-sm-none d-lg-block d-xl-block">
                                                            {{--												<a href="#" class="btn btn-primary save-deal" data-price="{{isset($deal->offer_price) ? $deal->offer_price : $deal->price}}"
                                                             data-deal="{{isset($deal->id) ? $deal->id : ''}}">Save Over $ {{isset($deal->offer_price) ? $deal->price - $deal->offer_price : $deal->price}}</a>--}}
                                                            <a href="{{route('home.deal_detail', $deal->slug)}}"
                                                               class="btn btn-info">Show Me The Deals!</a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--								<hr>--}}
                                        </div>
                                    </div>
                                @elseif($deal->state_id != $state->id)
                                    @foreach ((array)json_decode($deal->multiple_cities) as $cityn)
                                        @if($cityn == $state->id)
                                            @php
                                                $vendorcompany = VendorCompanyProfile::select('*')->where('field_key',
                                                'company_name')->where('user_id',$deal->user_id)->get();
                                        $companyslogan = VendorCompanyProfile::select('*')->where('field_key',
                                                'company_bio')->where('user_id',$deal->user_id)->get();
                                                $vendorimage = VendorCompanyProfile::select('*')->where('field_key',
                                                'company_logo')->where('user_id',$deal->user_id)->get();
                                                $vendorwebsite = VendorCompanyProfile::select('*')->where('field_key',
                                                'company_website_url')->where('user_id',$deal->user_id)->get();
                                                $vendorfacebook = VendorCompanyProfile::select('*')->where('field_key',
                                                'company_facebook_url')->where('user_id',$deal->user_id)->get();
                                                $vendorinsta = VendorCompanyProfile::select('*')->where('field_key',
                                                'company_instagram_url')->where('user_id',$deal->user_id)->get();
                                            @endphp

                                            <div class="col-md-12">
                                                <div class="photographyBox">
                                                    <div class="row">
                                                        <div class="col-md-5 col-sm-5 col-lg-5 col-xl-3">
                                                            <div class="photography-img">
                                                                @if(isset($deal->is_featured) && ($deal->is_featured == 1))
                                                                    <span class="strip">featured</span>
                                                                    <h3 class="title"></h3>
                                                                @endif

                                                                @if(isset($deal->image))
                                                                    <img src="{{ asset($deal->image) }}"
                                                                         alt="{{isset($deal->title) ? $deal->title : ''}}"
                                                                         class="mx-auto d-block w-75"/>
                                                                @else
                                                                    <img src="{{ asset('front/images/no-image.png') }}"
                                                                         alt="" class="mx-auto d-block img-fluid w-75"/>
                                                                @endif
{{--                                                                <div class="heart-icon">--}}
{{--                                                                    <img src="{{ asset('front/images/heart.png') }}"--}}
{{--                                                                         alt="" class="w-75"/>--}}
{{--                                                                </div>--}}
                                                            </div>
                                                            <div class="d-block d-md-block d-sm-block d-lg-none d-xl-none">
                                                                <a href="#" class="btn btn-primary save-deal"
                                                                   data-price="{{isset($deal->offer_price) ? $deal->offer_price : $deal->price}}"
                                                                   data-deal="{{isset($deal->id) ? $deal->id : ''}}">Save
                                                                    Over
                                                                    $ {{isset($deal->offer_price) ? $deal->offer_price : $deal->price}}</a>
                                                                <a href="{{route('home.deal_detail', $deal->slug)}}"
                                                                   class="btn btn-info">Show Me The Deals!</a>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-7 col-sm-7 col-lg-7 col-xl-9">
                                                            <div class="alert alert-success font-weight-bold alert-block" id="successmsg_{{$deal->id}}"
                                                                 style="display:none;"></div>
                                                            <div class="alert alert-danger font-weight-bold alert-block" id="dangermsg_{{$deal->id}}"
                                                                 style="display:none;">
                                                            </div>
                                                            <div class="photography-content mt-5">

                                                                <div class="row">
                                                                    <div class="col-12 col-lg-8">
                                                                        <h4 class="text-capitalize">{{isset($deal->title) ? $deal->title : ''}}</h4>
                                                                    </div>
                                                                    <div class="col-12 col-lg-4 mb-3">

                                                                        <a href="javascript:void(0)" class="save-deal"
                                                                           data-price="{{isset($deal->offer_price) ? $deal->offer_price : $deal->price}}"
                                                                           data-deal="{{isset($deal->id) ? $deal->id : ''}}"
                                                                           data-city="{{isset($deal->state) ? $deal->state->name : ''}}"
                                                                           data-categories="{{isset($deal->category) ? $deal->category->name : ''}}">
													                 <span class="px-2 py-1 rounded-pill font-weight-bold bg-success text-white">
                                                                   <img src="{{asset('images/tabler_discount.svg')}}"
                                                                        style="width: 16px" alt=""> Save Over ${{isset($deal->offer_price) ? $deal->price - $deal->offer_price : $deal->price}}</span>
                                                                            {{--                                            <i class="fa fa-heart text-danger " style="font-size: 22px"></i>--}}
                                                                        </a>

                                                                        {{--													<a href="#" class="ml-3 save-deal " data-price="{{isset($deal->offer_price) ? $deal->offer_price : $deal->price}}"--}}
                                                                        {{--													   data-deal="{{isset($deal->id) ? $deal->id : ''}}" data-city="{{isset($deal->state) ? $deal->state->name : ''}}"--}}
                                                                        {{--													   data-category="{{isset($deal->category_id) ? $deal->category->name : ''}}">--}}
                                                                        {{--													<span class="px-2 py-1 rounded-pill font-weight-bold bg-success text-white">--}}
                                                                        {{--														<img src="{{asset('images/tabler_discount.svg')}}" style="width: 16px" alt="">	Save Over ${{isset($deal->offer_price) ? $deal->price - $deal->offer_price : $deal->price}}--}}
                                                                        {{--													</span>--}}
                                                                        {{--													</a>--}}
                                                                    </div>
                                                                </div>

                                                                <h6 {{isset($deal->state) ? $deal->state->name : ''}}</h6>
                                                                @if(isset($deal->teaser_text))
                                                                    {!! $deal->teaser_text !!}
                                                                @else
                                                                    <p>N/A</p>
                                                                @endif
                                                                <h3>
                                                                    @if ($deal->user->role == 1)
                                                                        By Admin
                                                                    @else
                                                                        @foreach ($vendorcompany as $key => $item)
                                                                            {{$item->field_value}}
                                                                        @endforeach
                                                                    @endif
                                                                </h3>
                                                                <div class="d-none d-md-none d-sm-none d-lg-block d-xl-block">
                                                                    {{--												<a href="#" class="btn btn-primary save-deal" data-price="{{isset($deal->offer_price) ? $deal->offer_price : $deal->price}}"
                                                                     data-deal="{{isset($deal->id) ? $deal->id : ''}}">Save Over $ {{isset($deal->offer_price) ? $deal->price - $deal->offer_price : $deal->price}}</a>--}}
                                                                    <a href="{{route('home.deal_detail', $deal->slug)}}"
                                                                       class="btn btn-info">Show Me The Deals!</a>

                                                                </div>
                                                            </div>
                                                        </div>

{{--                                                        <div class="col-md-7 col-sm-7 col-lg-7 col-xl-9">--}}
{{--                                                            <div class="photography-content mt-5">--}}
{{--                                                                <h4>@foreach ($vendorcompany as $key => $item)--}}
{{--                                                                        {{$item->field_value}}--}}
{{--                                                                    @endforeach</h4>--}}
{{--                                                                <h6 {{isset($deal->state) ? $deal->state->name : ''}}</h6>--}}
{{--                                                                @if(isset($deal->teaser_text))--}}
{{--                                                                    {!! $deal->teaser_text !!}--}}
{{--                                                                @else--}}
{{--                                                                    <p>N/A</p>--}}
{{--                                                                @endif--}}

{{--                                                                <div class="d-none d-md-none d-sm-none d-lg-block d-xl-block">--}}

{{--                                                                    <a href="{{route('home.deal_detail', $deal->slug)}}"--}}
{{--                                                                       class="btn btn-info">Show Me The Deals!--}}
{{--                                                                    </a>--}}

{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <p>There is no deal found!</p>
                                @endif
                            @endforeach
                        @else
                            <p>There is no deal found!</p>
                        @endif
                    </div>
                    <div class="row mt-5 pt-5">
                        <div class="col-md-6 offset-md-3 text-center">
                            <h4>That's it... for now.</h4>
                            <p>Check back soon for more deals!</p>
                            <form class="my-5 category-form" method="GET" action="{{route('home.allDeals')}}">
                                <p>In the meantime, find other great vendors.</p>
                                <div class="form-group">
                                    <select class="form-control" id="category" name="category" required="">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{isset($category->slug) ? $category->slug : ''}}" {{isset($_REQUEST['category']) ? (($_REQUEST['category'] == $category->slug) ? 'selected="selected"' : '') : ''}}>{{isset($category->name) ? $category->name : ''}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="state" name="state" required="">
                                        <option value="">Select City</option>
                                        @foreach($states as $state)
                                            <option value="{{isset($state->code) ? $state->code : ''}}" {{isset($_REQUEST['state']) ? (($_REQUEST['state'] == $state->code) ? 'selected="selected"' : '') : ''}}>{{isset($state->name) ? $state->name : ''}}</option>
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
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection

@push('customJs')
    <script type="text/javascript">
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
        if (document.querySelector('.middle-content-area .row').innerHTML.includes('<div class="col-md-12">')) {
            //
        } else {
            document.querySelector('.middle-content-area .row').innerHTML = '<p>There is no deal found!</p>'
        }
    </script>
@endpush