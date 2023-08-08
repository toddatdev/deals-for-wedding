@extends('vendor.layouts.app')
@section('title', 'Advertiser: Create a Deal')
<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
<link href="{{asset('vendor/css/app.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('vendor/css/dealstep.css')}}">
@push('customCSS')
@endpush
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            {{-- <h4 class="page-title">Deals Management</h4> --}}
            @include('flash-message')
            <div class="row">
                <div class="col-md-12">
                    <div style="padding: 3% 1% 0 1% !important;" class="card">
                        <h2 id="heading">Create a Deal</h2>
                        <p>Fill all form field to go to next step</p>
                        <section class="wizard-section">
                            <div class="row no-gutters">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-wizard">
                                        <form id="deal-create-form" action="{{route('vendor.cart.store')}}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-wizard-header">
                                                <ul class="list-unstyled form-wizard-steps clearfix">
                                                    <li class="active"><span>1</span></li>
                                                    <li><span>2</span></li>
                                                    <li><span>3</span></li>
                                                    <li><span>4</span></li>
                                                    <li><span>5</span></li>
                                                </ul>
                                            </div>
                                            <fieldset class="wizard-fieldset show">
                                                <h5>Service & City</h5>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h3>Select a Wedding Service </h3>
                                                            </div>

                                                            @php

                                                            @endphp

                                                            <div class="col-md-6 px-0">
                                                                <label for="category_id"
                                                                    class="form-label"><strong>Select Service
                                                                    </strong></label>
                                                                <select
                                                                    class="form-control wizard-required @error('category_id') is-invalid @enderror"
                                                                    name="category_id" id="category_id" required>
                                                                    <option value="" selected="">Select Any</option>
                                                                    @foreach($categories->sortBy('name') as $category)
                                                                    <option
                                                                        value="{{isset($category->id) ? $category->id : ''}}">
                                                                        {{isset($category->name) ? $category->name : ''}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                 <div class="wizard-form-error"><span class="mt-2 font-weight-bold text-danger" style="font-size: 13px">This Field is Required</span></div>

                                                                @error('category')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top:4%;">
                                                            <div class="col-md-6">
                                                                <h3>Select a City </h3>
                                                            </div>
                                                            <div class="col-md-6 px-0">
                                                                <label for="state_id" class="form-label"><strong>Select
                                                                        City
                                                                    </strong></label>
                                                                <select
                                                                    class="form-control selectCity wizard-required @error('state_id') is-invalid @enderror"
                                                                    name="state_id" id="state_id" required>
                                                                    <option value="" selected="">Select Any</option>
                                                                    @foreach($states as $state)
                                                                    <option
                                                                        value="{{isset($state->id) ? $state->id : ''}}">
                                                                        {{isset($state->name) ? $state->name : ''}} -
                                                                        {{isset($state->code) ? strtoupper($state->code) : ''}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                     <div class="wizard-form-error"><span class="mt-2 font-weight-bold text-danger" style="font-size: 13px">This Field is Required</span></div>

                                                                @error('state')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="discountcode" id="discountcode" value="">
                                                    </div>
                                                         <div class="wizard-form-error"><span class="mt-2 font-weight-bold text-danger" style="font-size: 13px">This Field is Required</span></div>

                                                </div>
                                                <div class="form-group clearfix">
                                                    <a href="javascript:;"
                                                        class="form-wizard-next-btn float-right">Next</a>
                                                </div>
                                            </fieldset>
                                            <fieldset class="wizard-fieldset">
                                                <h5>Deal Details</h5>
                                                <div class="form-group">
                                                    <div class="row">

                                                        <div class="col-12 col-lg-4 mb-3 mx-auto">
                                                           <div class="text-center">
                                                               <a href="javascript:void(0)" class="clickToUpladImage">
                                                                   <img class="shadow profile-pic " style="width: 220px; height: 220px; border-radius: 20px" src="{{asset('front/images/upload.png')}}" alt="">
                                                                   <h6 class="font-weight-bold text-dark mt-1">Upload Your Deal Image</h6>
                                                               </a>
                                                               <small>Required square
                                                                   size & minimum 800px width. Allowed image type (jpeg, jpg, png, gif)</small>
                                                               <input type="file"
                                                                      class="form-control file-upload hiddenUploadImageInput"
                                                                      id="imgInp" name="image" accept=".jpeg,.jpg,.png,.gif" style="display: none">
                                                               <strong></strong>
                                                               @error('image')

                                                               <span class="invalid-feedback" role="alert">
                                                                 <strong>{{ $message }}</strong>
                                                               </span>
                                                               @enderror
                                                                    <div class="wizard-form-error"><span class="mt-2 font-weight-bold text-danger" style="font-size: 13px">This Field is Required</span></div>


                                                           </div>
                                                        </div>

                                                        <div class="col-md-12 px-0 ">
                                                            <label for="title"
                                                                class="form-label"><strong>Deal Title</strong></label>
                                                            <input type="text"
                                                                class="form-control wizard-required @error('title') is-invalid @enderror"
                                                                id="title" name="title" placeholder="title" value=""
                                                                required>
                                                            @error('title')

                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                                 <div class="wizard-form-error"><span class="mt-2 font-weight-bold text-danger" style="font-size: 13px">This Field is Required</span></div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12 px-0">
                                                            <label for="description"
                                                                class="form-label"><strong>Deal Description
                                                                </strong></label>
                                                            <textarea
                                                                class="form-control wizard-required @error('description') is-invalid @enderror"
                                                                name="description" id="description"></textarea>
                                                            @error('description')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                                 <div class="wizard-form-error"><span class="mt-2 font-weight-bold text-danger" style="font-size: 13px">This Field is Required</span></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12 px-0">
                                                            <label for="teaser_text" class="form-label"><strong>Deal Teaser
                                                                    Text
                                                                </strong></label>
                                                            <textarea
                                                                class="form-control wizard-required @error('teaser-text') is-invalid @enderror"
                                                                name="teaser_text" id="teaser_text"></textarea>
                                                            @error('teaser_text')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                                 <div class="wizard-form-error"><span class="mt-2 font-weight-bold text-danger" style="font-size: 13px">This Field is Required</span></div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <a href="javascript:;"
                                                        class="form-wizard-previous-btn float-left">Previous</a>
                                                    <a href="javascript:;"
                                                        class="form-wizard-next-btn float-right">Next</a>
                                                </div>
                                            </fieldset>
                                            <fieldset class="wizard-fieldset">
                                                <h5>Pricing & Misc</h5>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <h4>Original Price</h4>
                                                        </div>
                                                        <div class="col-md-4">
                                                            {{-- <label for="price" class="form-label"><strong>Price</strong></label> --}}
                                                            <input type="number" step="0.01"
                                                                class="form-control wizard-required validate_price @error('price') is-invalid @enderror"
                                                                id="price" name="price" placeholder="price" value=""
                                                                required="">
                                                            @error('price')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                                 <div class="wizard-form-error"><span class="mt-2 font-weight-bold text-danger" style="font-size: 13px">This Field is Required</span></div>

                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <h4>Deal Price</h4>
                                                        </div>
                                                        <div class="col-md-4">
                                                            {{-- <label for="offer_price" class="form-label"><strong>Offer
                                                                    Price</strong></label> --}}
                                                            <input type="number" step="0.01"
                                                                class="form-control wizard-required validate_price @error('offer_price') is-invalid @enderror"
                                                                id="offer_price" name="offer_price"
                                                                placeholder="offer_price" value="">
                                                            @error('offer_price')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                                 <div class="wizard-form-error"><span class="mt-2 font-weight-bold text-danger" style="font-size: 13px">This Field is Required</span></div>

                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <h4>Deal Expiration Date</h4>
                                                        </div>
                                                        <div class="col-md-4">
                                                            {{-- <label for="offer_price" class="form-label"><strong>Offer
                                                                    Price</strong></label> --}}
                                                            <input type="date" class="form-control wizard-required"
                                                                id="expire_date" name="expire_date"
                                                                placeholder="mm-dd-yyyy">
                                                                 <div class="wizard-form-error"><span class="mt-2 font-weight-bold text-danger" style="font-size: 13px">This Field is Required</span></div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <a href="javascript:;"
                                                        class="form-wizard-previous-btn float-left">Previous</a>
                                                    <a href="javascript:;"
                                                        class="form-wizard-next-btn float-right">Next</a>
                                                </div>
                                            </fieldset>
                                            <fieldset class="wizard-fieldset">
{{--                                                <h5>Preview</h5>--}}
{{--                                                <div>--}}
{{--                                                    <a href="#" id="capbtn" class="btn btn-success"><i--}}
{{--                                                            class="fa fa-camera"></i>--}}
{{--                                                        &nbsp;Preview</a>--}}
{{--                                                    <a href="#" id="down" class="btn btn-success"><i--}}
{{--                                                            class="fa fa-download"></i>--}}
{{--                                                        &nbsp;Save Preview</a>--}}
{{--                                                    <a href="#" id="download" style="display: none;">--}}
{{--                                                        < Download</a> </div> <div class="col-5">--}}
{{--                                                </div>--}}

                                                <div class="form-group">
                                                    <div id="capture2" class="row"
                                                        style=" position: relative; display: grid;">
                                                        @include('front.vendor_preview')
                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <a href="javascript:;"
                                                        class="form-wizard-previous-btn float-left">Previous</a>
                                                    <a href="javascript:;"
                                                        class="form-wizard-next-btn float-right">Next</a>
                                                </div>
                                            </fieldset>
                                            <fieldset class="wizard-fieldset">
                                                <h5>Add Additional City</h5>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h3>Additional Cities </h3>
                                                        </div>



                                                        <div class="col-md-6">
                                                            <label for="state_id" class="form-label"><strong>CTRL + Click to Select/Unselect Multi Select...
                                                                </strong></label>
                                                            <select
                                                                class="form-control getSelectedOptionCount @error('state_id') is-invalid @enderror"
                                                                multiple name="multiple_cities[]" id="state_mid">


                                                                @foreach($states as $state)

                                                                    <option value="{{isset($state->id) ? $state->id : ''}}">
                                                                        {{isset($state->name) ? $state->name : ''}} -
                                                                        {{isset($state->code) ? strtoupper($state->code) : ''}}
                                                                    </option>

                                                                @endforeach


                                                            </select>
                                                            @error('state')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror

                                                            <p id="countSelectedOption" style="font-size: 18px;color: #ff646d" class="mt-3 font-weight-bold"></p>

                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                    </div>
                                                    <div class="row">

                                                        <p>Additional Charges Applies*</p>

                                                        @php

                                                            $allCartData = \App\Models\Cart::where('user_id', Auth::user()->id)->first();
                                                            $alldealData = \App\Models\Deals::where('user_id', Auth::user()->id)->first();

                                                        @endphp

{{--                                                        @if(!is_null($allCartData) || !is_null($alldealData))--}}

{{--                                                            <input id="listing-price" class="form-control col-6 mx-auto" type="hidden" name="listing_price" value="{{$checkout->per_listing_price}}">--}}
                                                            <input id="listing-price" class="form-control col-6 mx-auto" type="hidden" name="listing_price" value="0">

{{--                                                        @else--}}

{{--                                                            <input id="listing-price" class="form-control col-6 mx-auto" type="hidden" name="listing_price" value="0">--}}

{{--                                                        @endif--}}

                                                        <input id="per-city-price" type="hidden" name="city_price" value="{{$checkout->additional_city_price}}">
                                                        <input id="free-deal" type="hidden" name="free_deal" value="{{Auth::user()->free_deal}}">
                                                        <input id="checkout-price" type="hidden" name="checkout_price" value="">

                                                    </div>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <a href="javascript:;"
                                                        class="form-wizard-previous-btn float-left">Previous</a>

                                                    <button type="button" class="btn btn-success float-right form-wizard-submit " data-toggle="modal" data-target="#verifyAddtoCartModal">
                                                        Add to Cart
                                                    </button>

{{--                                                        <button name="checkout" id="checkout-btn" style="margin: 0 10px;" type="submit" --}}
{{--                                                        class="form-wizard-submit float-right btn btn-success">Checkout</button>--}}
                                                </div>

                                                <!-- Verify want create new deal or go to cart page -->
                                                 <?php
						                        	$message = App\Models\DynamicMessage::first();
                                                ?>

                                                <div class="modal fade" id="verifyAddtoCartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">{!! $message->checkout_modal_title ?? 'Thankyou ! for creating deal.' !!}</h5>
                                                                <button type="button" id="crossBtn" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! $message->checkout_modal_description ?? 'Multiple deals will help you to get more business and leads.So if you want to create new deal please click on Create New button'!!}
                                                            </div>
                                                            <div class="modal-footer">

                                                                <input type="submit" name="createNewDeal" value="Create New Deal" href="javascript:;"
                                                                        class="form-wizard-submit  btn btn-success"/>

                                                                <input type="submit" id="triggerAddToCart" name="goToAddToCart" value="No thanks" href="javascript:;"
                                                                        class="form-wizard-submit  btn btn-danger"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div data-html2canvas-ignore="true">
        <div id="parentcanvas" class="css-xnjket"><img id="canvasremove"
                src="data:image/svg+xml;base64,PHN2ZyBmaWxsPSIjZmZmZmZmIiBoZWlnaHQ9IjI0IiB2aWV3Qm94PSIwIDAgMjQgMjQiIHdpZHRoPSIyNCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICAgIDxwYXRoIGQ9Ik0xOSA2LjQxTDE3LjU5IDUgMTIgMTAuNTkgNi40MSA1IDUgNi40MSAxMC41OSAxMiA1IDE3LjU5IDYuNDEgMTkgMTIgMTMuNDEgMTcuNTkgMTkgMTkgMTcuNTkgMTMuNDEgMTJ6Ii8+CiAgICA8cGF0aCBkPSJNMCAwaDI0djI0SDB6IiBmaWxsPSJub25lIi8+Cjwvc3ZnPgo="
                alt="Close" class="css-1htfbdm">

        </div>
    </div>


{{--    @php--}}

{{--        $additonalCityPrice = $checkout->additional_city_price;--}}

{{--    dd($additonalCityPrice);--}}

{{--    @endphp--}}


    @endsection

    @push('customJs')

{{--        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>--}}

        <script>
            $(".clickToUpladImage").click(function () {
                $(".hiddenUploadImageInput").click();
            });
        </script>

        <script>

            $("#crossBtn").click(function () {
                $("#triggerAddToCart").trigger("click");
            });

        </script>

        <script>
            $(function () {

                let multiCities = [];

                @foreach($states as $state)

                    multiCities.push({

                        value:"{{isset($state->id) ? $state->id : ''}}",
                        text:"{{isset($state->name) ? $state->name : ''}} - {{isset($state->code) ? strtoupper($state->code) : ''}}"

                    })

                @endforeach

                $('.selectCity').change(function () {

                    console.log("ok");
                    console.log(multiCities);

                    let selectedCity = $(this).find(':selected').val();
                    $('#state_mid').html('');
                    multiCities.filter(mc => parseInt(mc.value) !== parseInt(selectedCity))
                        .map(mc => {
                            $('#state_mid').append(`<option value="${mc.value}">${mc.text}</option>`);
                        })
                })

            });
        </script>


        <script>

            $(function () {

                $('.getSelectedOptionCount').change(function () {

                    let selected = $(this).find(':selected');

                    console.log(selected);

                    let selectedAd = $(this).find(':selected').val();

                    let count = selected.length;

                    let CityPrice = {{$checkout->additional_city_price}};

                    if (count > 0) {

                        let total = count*CityPrice

                        $('#countSelectedOption').html('Additional City Price is  '+'$'+total);

                    } else {

                        $('#countSelectedOption').html('');

                    }
                })
            });
        </script>


    <script type="text/javascript">
        $(".validate_price").blur(function() {
            var price = $(this).val();
            var validatePrice = function(price) {
                return /^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(price);
            }
            var dfd = validatePrice(price);
            console.log(dfd);
            if (!dfd) {
                alert('Price should be in integer');
                $(this).val('0');
            }
            //alert(validatePrice(price)); // False
        });

        $("#offer_price").blur(function() {
            var offer_price = parseFloat($("#offer_price").val());
            var regular_price = parseFloat($("#price").val());

            if (regular_price > offer_price) {
                console.log('dfgdg');
            } else {
                $("#offer_price").val('0');
                alert('Offer price should be less then regular price.');
            }
            //alert(validatePrice(price)); // False
        });

        $(function() {
            // Summernote
            $('#description').summernote();
            $('#teaser_text').summernote();
            $('#advertiser_bio').summernote();
        })
    </script>
    <script type='text/javascript'>
        jQuery(document).ready(function() {
	// click on next button
	jQuery('.form-wizard-next-btn').click(function() {
		var parentFieldset = jQuery(this).parents('.wizard-fieldset');
		var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
		var next = jQuery(this);
		var nextWizardStep = true;
		parentFieldset.find('.wizard-required').each(function(){
			var thisValue = jQuery(this).val();

			if( thisValue == "") {
				jQuery(this).siblings(".wizard-form-error").slideDown();
				nextWizardStep = false;
			}
			else {
				jQuery(this).siblings(".wizard-form-error").slideUp();
			}
		});
		if( nextWizardStep) {
			next.parents('.wizard-fieldset').removeClass("show","400");
			currentActiveStep.removeClass('active').addClass('activated').next().addClass('active',"400");
			next.parents('.wizard-fieldset').next('.wizard-fieldset').addClass("show","400");
			jQuery(document).find('.wizard-fieldset').each(function(){
				if(jQuery(this).hasClass('show')){
					var formAtrr = jQuery(this).attr('data-tab-content');
					jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){
						if(jQuery(this).attr('data-attr') == formAtrr){
							jQuery(this).addClass('active');
							var innerWidth = jQuery(this).innerWidth();
							var position = jQuery(this).position();
							jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
						}else{
							jQuery(this).removeClass('active');
						}
					});
				}
			});
		}
	});
	//click on previous button
	jQuery('.form-wizard-previous-btn').click(function() {
		var counter = parseInt(jQuery(".wizard-counter").text());;
		var prev =jQuery(this);
		var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
		prev.parents('.wizard-fieldset').removeClass("show","400");
		prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show","400");
		currentActiveStep.removeClass('active').prev().removeClass('activated').addClass('active',"400");
		jQuery(document).find('.wizard-fieldset').each(function(){
			if(jQuery(this).hasClass('show')){
				var formAtrr = jQuery(this).attr('data-tab-content');
				jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function(){
					if(jQuery(this).attr('data-attr') == formAtrr){
						jQuery(this).addClass('active');
						var innerWidth = jQuery(this).innerWidth();
						var position = jQuery(this).position();
						jQuery(document).find('.form-wizard-step-move').css({"left": position.left, "width": innerWidth});
					}else{
						jQuery(this).removeClass('active');
					}
				});
			}
		});
	});
	//click on form submit button
	jQuery(document).on("click",".form-wizard .form-wizard-submit" , function(){
		var parentFieldset = jQuery(this).parents('.wizard-fieldset');
		var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
		parentFieldset.find('.wizard-required').each(function() {
			var thisValue = jQuery(this).val();
			if( thisValue == "" ) {
				jQuery(this).siblings(".wizard-form-error").slideDown();
			}
			else {
				jQuery(this).siblings(".wizard-form-error").slideUp();
			}
		});
	});
	// focus on input field check empty or not
	jQuery(".form-control").on('focus', function(){
		var tmpThis = jQuery(this).val();
		if(tmpThis == '' ) {
			jQuery(this).parent().addClass("focus-input");
		}
		else if(tmpThis !='' ){
			jQuery(this).parent().addClass("focus-input");
		}
	}).on('blur', function(){
		var tmpThis = jQuery(this).val();
		if(tmpThis == '' ) {
			jQuery(this).parent().removeClass("focus-input");
			jQuery(this).siblings('.wizard-form-error').slideDown("3000");
		}
		else if(tmpThis !='' ){
			jQuery(this).parent().addClass("focus-input");
			jQuery(this).siblings('.wizard-form-error').slideUp("3000");
		}
	});
});

    </script>

    <script src="{{asset('front/js/html2canvas.min.js')}}"></script>
    <script>
        document.getElementById('capbtn').addEventListener('click', function() {
        html2canvas(document.querySelector("#capture2")).then(canvas => {
            document.getElementById('parentcanvas').appendChild(canvas);
            document.getElementById('parentcanvas').style.display = "block";
            // var link = document.getElementById('capbtn');
            // link.setAttribute('download', 'ListingPreview.png');
            // link.setAttribute('href', canvas.toDataURL("image/png").replace("image/png", "image/octet-stream"));
            // link.click();
        });
        });
        document.getElementById('down').addEventListener('click', function() {
        html2canvas(document.querySelector("#capture2")).then(canvas => {
            document.getElementById('parentcanvas').appendChild(canvas);
            //document.getElementById('parentcanvas').style.display = "block";
            var link = document.getElementById('download');
            link.setAttribute('download', 'DealPreview.png');
            link.setAttribute('href', canvas.toDataURL("image/png").replace("image/png", "image/octet-stream"));
            link.click();
            document.getElementsByTagName('canvas')[0].remove();
            link.setAttribute('href', '#');
            link.removeAttribute('download');
        });

    });
    document.getElementById('canvasremove').addEventListener('click', function() {
        document.getElementById('parentcanvas').style.display = "none";
        document.getElementsByTagName('canvas')[0].remove();
    });
    </script>
    <script>
        $('body').on('click keyup change',  function(){
            $('#preview_title').text($('#title').val());
            // $('#preview_teaser').html(document.querySelectorAll('.note-editable')[1].innerHTML);
            $('#preview_desc').html(document.querySelectorAll('.note-editable')[0].innerHTML);
            imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
            preview_img.src = URL.createObjectURL(file)
            };
            }

            if($('#offer_price').val() > 0){
                $('#preview_price').text(parseFloat($('#price').val() - $('#offer_price').val()).toFixed('2'));
                $('#preview_class_price').text(parseFloat($('#price').val() - $('#offer_price').val()).toFixed('2'));
            }else{
                $('#preview_price').text(parseFloat($('#price').val()).toFixed('2'));
                $('#preview_class_price').text(parseFloat($('#price').val()).toFixed('2'));
            }
            $('#preview_discount').text($('#discountcode').val());
            //console.log('method called');
        })
    </script>

    <script>
        $(document).ready(function(){
            var discountcode = `DFW-` + Math.floor((Math.random() * 999999) + 111111);
            document.getElementById("discountcode").value = discountcode;
            //console.log(discountcode);
        })
    </script>
    <script>
        $('body').on('click keyup change',  function(){
        if ($('#state_mid :selected').length > 0) {
            var listingPrice = parseFloat($('#listing-price').val());
            var cityPrice = parseFloat($('#per-city-price').val());
            if (jQuery.inArray($('#state_id').val(), $('#state_mid').val()) != -1){
            var totalCity = parseFloat($('#state_mid :selected').length - 1);
            }
            else {
            var totalCity = parseFloat($('#state_mid :selected').length);
            };
            if ($('#free-deal').val() != 'used'){
                listingPrice = 0;
            }
            $('#checkout-price').val(listingPrice + (cityPrice*totalCity));
            //console.log($('#checkout-price').val());
        }
        else {
            var listingPrice = parseFloat($('#listing-price').val());
            if ($('#free-deal').val() != 'used'){
                listingPrice = 0;
            }
            $('#checkout-price').val(listingPrice);
            //console.log($('#checkout-price').val());
        }
        })
    </script>

        <script>
            $(document).ready(function() {

                var readURL = function(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('.profile-pic').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $(".file-upload").on('change', function(){
                    readURL(this);
                });

                $(".upload-button").on('click', function() {
                    $(".file-upload").click();
                });
            });
        </script>
    @endpush
    <style>
        .ui-tooltip-content {
        color: gray !important;
        }
    </style>