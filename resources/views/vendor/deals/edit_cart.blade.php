@extends('vendor.layouts.app')
@section('title', 'Advertiser: Edit Cart Deals')
<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
<link href="{{asset('vendor/css/app.css')}}" rel="stylesheet"/>
<link rel="stylesheet" href="{{asset('vendor/css/dealstep.css')}}">
@push('customCSS')
@endpush
<style>
    .main-header {
        top: 0;
    }
</style>

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                @include('flash-message')
                <div class="row">
                    <div class="col-md-12">
                        <div style="padding: 3% 1% 0 1% !important;" class="card">
                            <h2 id="heading">Edit Deals</h2>
                            <p>Fill all form field to go to next step</p>

                            <section class="wizard-section">
                                <div class="row no-gutters">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-wizard">
                                            <form action="{{route('vendor.cart.update', $deal->id)}}" method="post"
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
                                                                <div class="col-md-6">
                                                                    <label for="category_id"
                                                                           class="form-label"><strong>Select Service
                                                                        </strong></label>
                                                                    <select
                                                                            class="form-control wizard-required @error('category_id') is-invalid @enderror"
                                                                            name="category_id" id="category_id"
                                                                            required>
                                                                        <option value="" selected="">Select Any</option>
                                                                        @foreach($categories as $category)
                                                                            <option
                                                                                    value="{{isset($category->id) ? $category->id : ''}}"
                                                                                    {{($deal->category_id == $category->id) ? 'selected="selected"' : ''}}>
                                                                                {{isset($category->name) ? $category->name : ''}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <div class="wizard-form-error"></div>
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
                                                                <div class="col-md-6">
                                                                    <label for="state_id" class="form-label"><strong>Select
                                                                            City
                                                                        </strong></label>
                                                                    <select
                                                                            class="form-control selectCity wizard-required @error('state_id') is-invalid @enderror"
                                                                            name="state_id" id="state_id" required>
                                                                        <option value="" selected="">Select Any</option>
                                                                        @foreach($states as $state)
                                                                            <option
                                                                                    value="{{isset($state->id) ? $state->id : ''}}"
                                                                                    {{($deal->state_id == $state->id) ? 'selected="selected"' : ''}}>
                                                                                {{isset($state->name) ? $state->name : ''}}
                                                                                -
                                                                                {{isset($state->code) ? strtoupper($state->code) : ''}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <div class="wizard-form-error"></div>
                                                                    @error('state')
                                                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="wizard-form-error"></div>
                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <a href="javascript:;"
                                                           class="form-wizard-next-btn float-right">Next</a>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="wizard-fieldset">
                                                    <h5>Deals Details</h5>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="text-center">
                                                                    <label for="image" class="form-label"><strong>Image
                                                                        </strong>
                                                                    </label>
                                                                    @if(isset($deal->image))
                                                                        <div class="old_img mb-1">
                                                                            <img src="{{asset($deal->image)}}"
                                                                                 style="width:100px">
                                                                            <i class="fa fa-times text-success"
                                                                               aria-hidden="true"
                                                                               onclick="removeFile(this);">Remove</i>
                                                                        </div>
                                                                        <small>Required square
                                                                            size & minimum 800px width.</small>
                                                                    @endif
                                                                    <input id="imgInp" type="file" id="image"
                                                                           name="image"
                                                                           class="form-control mt-3" accept="image/*"
                                                                    />
                                                                    <input type="hidden" id="old_image"
                                                                           value="{{isset($deal->image) ? $deal->image :''}}"
                                                                           name="old_image">
                                                                    <input type="hidden" id="discountcode"
                                                                           value="{{isset($deal->discountcode) ? $deal->discountcode :'xxxxxx'}}"
                                                                    >
                                                                    @error('image')
                                                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                                    @enderror
                                                                    <div class="wizard-form-error"></div>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-12 mt-3">
                                                                <label for="title"
                                                                       class="form-label"><strong>Title</strong></label>
                                                                <input type="text"
                                                                       class="form-control wizard-required @error('title') is-invalid @enderror"
                                                                       id="title" name="title" placeholder="title"
                                                                       value="{{isset($deal->title) ? $deal->title : ''}}"
                                                                       required="">
                                                                @error('title')

                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                                @enderror
                                                                <div class="wizard-form-error"></div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="description"
                                                                       class="form-label"><strong>Description
                                                                    </strong></label>
                                                                <textarea
                                                                        class="form-control wizard-required @error('description') is-invalid @enderror"
                                                                        name="description"
                                                                        id="description">{{isset($deal->description) ? $deal->description : ''}}</textarea>
                                                                @error('description')
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                                @enderror
                                                                <div class="wizard-form-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="teaser_text" class="form-label"><strong>Teaser
                                                                        Text
                                                                    </strong></label>
                                                                <textarea
                                                                        class="form-control wizard-required @error('teaser-text') is-invalid @enderror"
                                                                        name="teaser_text"
                                                                        id="teaser_text">{{isset($deal->teaser_text) ? $deal->teaser_text : ''}}</textarea>
                                                                @error('teaser_text')
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                                @enderror
                                                                <div class="wizard-form-error"></div>
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
                                                                <input type="number" step="0.01"
                                                                       class="form-control wizard-required validate_price @error('price') is-invalid @enderror"
                                                                       id="price" name="price" placeholder="price"
                                                                       value="{{isset($deal->price) ? $deal->price :''}}"
                                                                       required="">
                                                                @error('price')
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                                @enderror
                                                                <div class="wizard-form-error"></div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <h4>Deal Price</h4>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="number" step="0.01"
                                                                       class="form-control validate_price @error('offer_price') is-invalid @enderror"
                                                                       id="offer_price" name="offer_price"
                                                                       placeholder="offer_price"
                                                                       value="{{isset($deal->offer_price) ? $deal->offer_price :''}}">
                                                                @error('offer_price')
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                                @enderror
                                                                <div class="wizard-form-error"></div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <h4>Deal Expiration Date</h4>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="date" class="form-control wizard-required"
                                                                       id="expire_date" name="expire_date"
                                                                       placeholder="mm-dd-yyyy"
                                                                       value="{{isset($deal->expiration_date) ? $deal->expiration_date :''}}">
                                                                <div class="wizard-form-error"></div>
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
                                                    <h5>Preview</h5>
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
                                                                <label for="state_id" class="form-label"><strong>CTRL +
                                                                        Select for Multi
                                                                        Select...
                                                                    </strong></label>
                                                                <select
                                                                        class="form-control getSelectedOptionCount @error('state_id') is-invalid @enderror"
                                                                        multiple name="multiple_cities[]"
                                                                        id="multi_city"
                                                                        value="{{isset($deal->multiple_cities) ? $deal->multiple_cities :''}}">
                                                                    @foreach($states as $state)
                                                                        <option value="{{isset($state->id) ? $state->id : ''}}"
                                                                                @if ($deal->multiple_cities != 'null' && $deal->multiple_cities != 'NULL' && !empty($deal->multiple_cities))
                                                                                @foreach (json_decode($deal->multiple_cities) as $cityn)
                                                                                @if($cityn == $state->id)
                                                                                selected
                                                                                @endif
                                                                                @endforeach
                                                                                @endif>
                                                                            {{isset($state->name) ? $state->name : ''}}-
                                                                            {{isset($state->code) ? strtoupper($state->code) : ''}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('state')
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                                @enderror

                                                                <p id="countSelectedOption"
                                                                   style="font-size: 18px;color: #ff646d"
                                                                   class="mt-3 font-weight-bold"></p>

                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                        </div>


                                                        <div class="row">
                                                            <p>Additional Charges Applies*</p>

                                                            <input id="listing-price" type="hidden" name="listing_price"
                                                                   value="0.00">
                                                            <input id="per-city-price" type="hidden" name="city_price"
                                                                   value="{{$checkout->additional_city_price}}">
                                                            <input id="free-deal" type="hidden" name="free_deal"
                                                                   value="{{Auth::user()->free_deal}}">
                                                            <input id="checkout-priceEdit" type="hidden"
                                                                   name="checkout_price" value="">

                                                        </div>

                                                    </div>
                                                    <div class="form-group clearfix">
                                                        <a href="javascript:;"
                                                           class="form-wizard-previous-btn float-left">Previous</a>
                                                        <button type="submit" href="javascript:;"
                                                                class="form-wizard-submit float-right btn btn-success"
                                                                style="margin: 0 15px">Update
                                                        </button>
                                                        {{-- <button type="button" wire:click.prevent="checkout"
                                                            class="form-wizard-submit float-right btn btn-success">Checkout</button> --}}
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


        @endsection

        @push('customJs')

            <script>
                $(function () {

                    let multiCities = [];

                    @foreach($states as $state)

                    @php

                        $selectedCities = json_decode($deal->multiple_cities);
                    if (isset($selectedCities)){
                         $selectedCities = json_decode($deal->multiple_cities);
                    }else{
                         $selectedCities = [];
                    }

                    @endphp

                    multiCities.push({

                        value: "{{isset($state->id) ? $state->id : ''}}",
                        text: "{{isset($state->name) ? $state->name : ''}} - {{isset($state->code) ? strtoupper($state->code) : ''}}",
                        selected: {{ in_array($state->id, $selectedCities) ? 1 : 0 }}

                    })

                    @endforeach

                    $('.selectCity').change(function () {


                        let selectedCity = $(this).find(':selected').val();
                        $('#multi_city').html('');

                        multiCities.filter(mc => parseInt(mc.value) !== parseInt(selectedCity))
                            .map(mc => {
                                $('#multi_city').append(`<option value="${mc.value}" ${mc.selected ? 'selected' : ''}>${mc.text}</option>`);
                            })
                    })

                    $('.selectCity').trigger('change')


                    // let selectedCity = $('.selectCity').find(':selected').val();
                    //
                    // $('#multi_city').html('');
                    //
                    // multiCities.filter(mc => parseInt(mc.value) !== parseInt(selectedCity))
                    //
                    //     .map(mc => {
                    //
                    //         $('#multi_city').append(`<option value="${mc.value}">${mc.text}</option>`);
                    //
                    //     })


                });
            </script>

            <script>
                $(function () {

                    $('.getSelectedOptionCount').change(function () {

                        let selected = $(this).find(':selected');

                        let count = selected.length;

                        let CityPrice = {{$checkout->additional_city_price}};

                        if (count > 0) {

                            let total = count * CityPrice

                            $('#countSelectedOption').html('Additional City Price is  ' + '$' + total);

                            $("#checkout-priceEdit").val(total);

                        } else {

                            $('#countSelectedOption').html('');
                            $("#checkout-priceEdit").val('0');

                        }
                    })

                    $('.getSelectedOptionCount').trigger('change')
                });
            </script>


            <script type="text/javascript">
                $(".validate_price").blur(function () {
                    var price = $(this).val();
                    var validatePrice = function (price) {
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

                $("#offer_price").blur(function () {
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

                @if(isset($deal -> id))
                // $(document).ready(function() {
                //     $('#image').removeAttr('required');
                //     var form = document.getElementById('create-deal');
                //     form.addEventListener('submit', function(event) {
                //         event.preventDefault();
                //         console.log($('#old_image').val());
                //         var oldimage = $('#old_image').val();
                //         if (oldimage != '' || oldimage != null || oldimage.length > 0) {
                //             $('#image').removeAttr('required');
                //             form.submit();
                //         } else {
                //             $('#image').attr('required', true);
                //             return false;
                //         }
                //     });
                // });

                function removeFile(element) {
                    $(element).parent('div.old_img').remove();
                    $('#image').attr('required', true);
                }

                @endif

                $(function () {
                    // Summernote
                    $('#description').summernote();
                    $('#teaser_text').summernote();
                    $('#advertiser_bio').summernote();
                })
            </script>


            <script type='text/javascript'>
                jQuery(document).ready(function () {
                    // click on next button
                    jQuery('.form-wizard-next-btn').click(function () {
                        var parentFieldset = jQuery(this).parents('.wizard-fieldset');
                        var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
                        var next = jQuery(this);
                        var nextWizardStep = true;
                        parentFieldset.find('.wizard-required').each(function () {
                            var thisValue = jQuery(this).val();

                            if (thisValue == "") {
                                jQuery(this).siblings(".wizard-form-error").slideDown();
                                nextWizardStep = false;
                            } else {
                                jQuery(this).siblings(".wizard-form-error").slideUp();
                            }
                        });
                        if (nextWizardStep) {
                            next.parents('.wizard-fieldset').removeClass("show", "400");
                            currentActiveStep.removeClass('active').addClass('activated').next().addClass('active', "400");
                            next.parents('.wizard-fieldset').next('.wizard-fieldset').addClass("show", "400");
                            jQuery(document).find('.wizard-fieldset').each(function () {
                                if (jQuery(this).hasClass('show')) {
                                    var formAtrr = jQuery(this).attr('data-tab-content');
                                    jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function () {
                                        if (jQuery(this).attr('data-attr') == formAtrr) {
                                            jQuery(this).addClass('active');
                                            var innerWidth = jQuery(this).innerWidth();
                                            var position = jQuery(this).position();
                                            jQuery(document).find('.form-wizard-step-move').css({
                                                "left": position.left,
                                                "width": innerWidth
                                            });
                                        } else {
                                            jQuery(this).removeClass('active');
                                        }
                                    });
                                }
                            });
                        }
                    });
                    //click on previous button
                    jQuery('.form-wizard-previous-btn').click(function () {
                        var counter = parseInt(jQuery(".wizard-counter").text());
                        ;
                        var prev = jQuery(this);
                        var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
                        prev.parents('.wizard-fieldset').removeClass("show", "400");
                        prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show", "400");
                        currentActiveStep.removeClass('active').prev().removeClass('activated').addClass('active', "400");
                        jQuery(document).find('.wizard-fieldset').each(function () {
                            if (jQuery(this).hasClass('show')) {
                                var formAtrr = jQuery(this).attr('data-tab-content');
                                jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(function () {
                                    if (jQuery(this).attr('data-attr') == formAtrr) {
                                        jQuery(this).addClass('active');
                                        var innerWidth = jQuery(this).innerWidth();
                                        var position = jQuery(this).position();
                                        jQuery(document).find('.form-wizard-step-move').css({
                                            "left": position.left,
                                            "width": innerWidth
                                        });
                                    } else {
                                        jQuery(this).removeClass('active');
                                    }
                                });
                            }
                        });
                    });
                    //click on form submit button
                    jQuery(document).on("click", ".form-wizard .form-wizard-submit", function () {
                        var parentFieldset = jQuery(this).parents('.wizard-fieldset');
                        var currentActiveStep = jQuery(this).parents('.form-wizard').find('.form-wizard-steps .active');
                        parentFieldset.find('.wizard-required').each(function () {
                            var thisValue = jQuery(this).val();
                            if (thisValue == "") {
                                jQuery(this).siblings(".wizard-form-error").slideDown();
                            } else {
                                jQuery(this).siblings(".wizard-form-error").slideUp();
                            }
                        });
                    });
                    // focus on input field check empty or not
                    jQuery(".form-control").on('focus', function () {
                        var tmpThis = jQuery(this).val();
                        if (tmpThis == '') {
                            jQuery(this).parent().addClass("focus-input");
                        } else if (tmpThis != '') {
                            jQuery(this).parent().addClass("focus-input");
                        }
                    }).on('blur', function () {
                        var tmpThis = jQuery(this).val();
                        if (tmpThis == '') {
                            jQuery(this).parent().removeClass("focus-input");
                            jQuery(this).siblings('.wizard-form-error').slideDown("3000");
                        } else if (tmpThis != '') {
                            jQuery(this).parent().addClass("focus-input");
                            jQuery(this).siblings('.wizard-form-error').slideUp("3000");
                        }
                    });
                });

            </script>

            <script src="{{asset('front/js/html2canvas.min.js')}}"></script>
            <script>
                document.getElementById('capbtn').addEventListener('click', function () {
                    html2canvas(document.querySelector("#capture2")).then(canvas => {
                        document.getElementById('parentcanvas').appendChild(canvas);
                        document.getElementById('parentcanvas').style.display = "block";
                        // var link = document.getElementById('capbtn');
                        // link.setAttribute('download', 'ListingPreview.png');
                        // link.setAttribute('href', canvas.toDataURL("image/png").replace("image/png", "image/octet-stream"));
                        // link.click();
                    });
                });
                document.getElementById('down').addEventListener('click', function () {
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
                document.getElementById('canvasremove').addEventListener('click', function () {
                    document.getElementById('parentcanvas').style.display = "none";
                    document.getElementsByTagName('canvas')[0].remove();
                });
            </script>
            <script>
                $('body').on('click keyup change', function () {
                    $('#preview_title').text($('#title').val());
                    $('#preview_teaser').html(document.querySelectorAll('.note-editable')[1].innerHTML);
                    $('#preview_desc').html(document.querySelectorAll('.note-editable')[0].innerHTML);
                    imgInp.onchange = evt => {
                        const [file] = imgInp.files
                        if (file) {
                            preview_img.src = URL.createObjectURL(file)
                        }
                        ;
                    }

                    if ($('#offer_price').val() > 0) {
                        $('#preview_price').text(parseFloat($('#price').val() - $('#offer_price').val()).toFixed('2'));
                    } else {
                        $('#preview_price').text(parseFloat($('#price').val()).toFixed('2'));
                    }
                    console.log('method called');
                })
            </script>
        @endpush

        <style>
            .ui-tooltip-content {
                color: gray !important;
            }
        </style>