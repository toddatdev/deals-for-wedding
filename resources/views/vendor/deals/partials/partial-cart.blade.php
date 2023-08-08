@php
    $vendorDeals = \App\Models\Deals::where('user_id', Auth::user()->id)->get();
@endphp

<div class="partial-cart">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @include('flash-message')

                <div class="card-header row">
                    <div class="card-title col-6">Your Cart</div>
                    <div class="card-title col-6">

                        <div class="row text-end">

                            {{-- <div class="col-6 text-right align-self-center">--}}
                            {{-- <h6 class="font-weight-bold mb-0">Total Ammount = $<span class="totalCheckoutAlllData"></span></h6>--}}
                            {{-- </div>--}}

                            <div class="col-12 align-self-center text-right">

                                @if(isset($carts))
                                    @if(count($carts) > 0)

                                    <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success font-weight-bold" data-toggle="modal" data-target="#checkoutAllCartData">
                                            Checkout All
                                        </button>

                                    @endif
                                @endif


                                <!-- Modal -->
                                <div class="modal fade" id="checkoutAllCartData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="text-right">
                                                <button type="button" class="close mr-3 mt-2"
                                                        data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <h4 class="text-capitalize mb-3 text-center font-weight-bold text-warning">{{Auth::user()->fname}} {{Auth::user()->lname}}</h4>
                                                <h6 class="text-capitalize mb-3 text-center">Your Total Deals Cart Price's &nbsp;<span style="font-size: 28px; font-weight: bold">$</span><span style="font-size: 28px; font-weight: bold" id="show_checkout_price"></span></h6>

                                                <form style="text-align: right; margin-bottom: 20px;" action="{{route('checkout.all')}}"
                                                      method="POST">
                                                    @csrf
                                                    <div class="text-left position-relative">

                                                       <input type="hidden"  class="form-control" name="total_checkout_price" id="total_checkout_price">

                                                    </div>

                                                    <div class="text-left">
                                                        <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                                                    </div>

                                                    <button id="checkout-button" class="btn btn-warning action-cons mt-3 w-100">Proceed To Checkout <i class="la la-arrow-circle-o-right"></i>
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    @php
                        //dd(count($deals))
                    @endphp

                    <div class="table-responsive">
                        <table class="table table-bordered" id="userList">
                            <thead>
                            <tr>
                                <th><strong>Sr. No.</strong></th>
                                <th><strong>Title</strong></th>
                                <th><strong>Image</strong></th>
                                <th><strong>Original Price</strong></th>
                                <th><strong>Deal Price</strong></th>
                                <th><strong>Category</strong></th>
                                <th><strong>City</strong></th>
                                <th><strong>Additional Cities</strong></th>
{{--                                <th><strong>Discount Code</strong></th>--}}
                                {{--                                            <th><strong>Total</strong></th>--}}
                                <th><strong>Actions</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($carts))
                                @php $i = 1; @endphp
                                @foreach($carts as $key => $deal)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ isset($deal->title) ? $deal->title : ''}}</td>
                                        <td>
                                            @if(isset($deal->image))
                                                <img src="{{asset($deal->image)}}"
                                                     alt="{{ isset($deal->title) ? $deal->title : ''}}"
                                                     width="70" height="50">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>${{ isset($deal->price) ? $deal->price : ''}}</td>
                                        <td>${{ isset($deal->offer_price) ? $deal->offer_price : '--'}}</td>
                                        <td>{{ !empty($deal->category) ? (isset($deal->category->name) ? $deal->category->name : '') : ''}}
                                        </td>
                                        <td>{{ !empty($deal->state) ? (isset($deal->state->name) ? $deal->state->name : '') : ''}}
                                        </td>
                                        <td>
                                            @if (isset($deal->multiple_cities))
                                                @if(is_array(json_decode($deal->multiple_cities)))
                                                    @foreach (json_decode($deal->multiple_cities) as $cityn)
                                                        @foreach ($cities->where('id', $cityn)->where('id', '!=', $deal->state->id) as $city)
                                                            {{$city->name}} <br>
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            @endif

                                            <a href="{{route('vendor.cart.editCity',$deal->id)}}"class="text-left text-warning font-weight-bold">
                                                <i class="la la-plus-circle font-weight-bold"></i> Add Additional City
                                            </a>
                                        </td>
{{--                                        <td>--}}
{{--                                            <input class="form-control" type="text" name="discount_code"--}}
{{--                                                   value="" placeholder="got a discount! type here...">--}}
{{--                                        </td>--}}
                                        {{--                                                    <td>--}}

                                        {{--                                                        @php--}}
                                        {{--                                                            $vendorDeals = \App\Models\Deals::where('user_id', Auth::user()->id)->get();--}}
                                        {{--                                                        @endphp--}}

                                        {{--                                                        @if(isset($vendorDeals))--}}

                                        {{--                                                            @if(count($vendorDeals) > 0 || Auth::user()->free_deal == 'used')--}}
                                        {{--                                                                <p class="mb-0 font-weight-bold">--}}
                                        {{--                                                                    <span class="badge badge-dark">${{ isset($deal->checkout_price) ? $deal->checkout_price : 0}}</span>--}}
                                        {{--                                                                </p>--}}
                                        {{--                                                            @else--}}

                                        {{--                                                                @php--}}
                                        {{--                                                                    $adListPrice = $additionalCharges->per_listing_price;--}}
                                        {{--                                                                @endphp--}}

                                        {{--                                                                <p class="font-weight-bold">--}}
                                        {{--                                                                    <span class="badge badge-dark">${{ isset($deal->checkout_price) ? $deal->checkout_price - $adListPrice : 0}}</span>--}}
                                        {{--                                                                </p>--}}

                                        {{--                                                            @endif--}}
                                        {{--                                                        @endif--}}
                                        {{--                                                    </td>--}}
                                        <td width="20%">

                                            {{-- <a href="{{route('home.deal_detail', $deal->slug)}}" target="_blank"><i
                                                    class="la la-eye btn btn-success action-cons"
                                                    aria-hidden="true"></i></a> --}}
                                            {{-- <a class="btn btn-success action-cons" href="" title="Checkout">Checkout</a> --}}

                                            <script src="https://js.stripe.com/v3/"></script>

                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#checkoutByDeal{{$deal->id}}Id">
                                                checkout
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="checkoutByDeal{{$deal->id}}Id"
                                                 tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                 aria-hidden="true" style="padding-right: 0px !important;">
                                                <div class="modal-dialog modal-dialog-centered modal-lg"
                                                     role="document">
                                                    <div class="modal-content">
                                                        <div class="text-right">
                                                            <button type="button" class="close mr-3 mt-2"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card border-0 shadow-none"
                                                                 style="box-shadow: none">
                                                                <div class="card-body">
                                                                    <div class="row mb-3">

                                                                        <div class="col-12 col-lg-5 mb-3 mb-lg-0">
                                                                            @if(isset($deal->image))
                                                                                <img class="img-fluid w-100 h-auto"
                                                                                     style="border-radius: 20px;"
                                                                                     src="{{asset($deal->image)}}"
                                                                                     alt="{{ isset($deal->title) ? $deal->title : ''}}">
                                                                            @else
                                                                                N/A
                                                                            @endif
                                                                        </div>

                                                                        <div class="col-12 col-lg-7 mb-3 mb-lg-0">
                                                                            <div>
                                                                                <h5 class="font-weight-bold">{{ isset($deal->title) ? $deal->title : ''}}</h5>
                                                                                <hr>

                                                                                <div class="row mb-3">
                                                                                    <div class="col-5">
                                                                                        <p class="mb-0 font-weight-bold">
                                                                                            Original Price:</p>
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <p class="mb-0">
                                                                                            ${{ isset($deal->price) ? $deal->price : ''}}</p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row mb-3">
                                                                                    <div class="col-5">
                                                                                        <p class="mb-0 font-weight-bold">
                                                                                            Deal Price:</p>
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <p class="mb-0">
                                                                                            ${{ isset($deal->offer_price) ? $deal->offer_price : ''}}</p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row mb-3">
                                                                                    <div class="col-5">
                                                                                        <p class="mb-0 font-weight-bold">
                                                                                            Category:</p>
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <p class="mb-0"><span
                                                                                                    class="badge badge-warning">
																								{{ !empty($deal->category) ? (isset($deal->category->name) ? $deal->category->name : '') : ''}}
																							</span></p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row mb-3">
                                                                                    <div class="col-5">
                                                                                        <p class="mb-0 font-weight-bold">
                                                                                            City:</p>
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <p class="mb-0">
																							<span class="badge badge-light">
																								{{ !empty($deal->state) ? (isset($deal->state->name) ? $deal->state->name : '') : ''}}
																							</span>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row mb-3">
                                                                                    <div class="col-5">
                                                                                        <p class="mb-0 font-weight-bold">
                                                                                            Additional
                                                                                            Cities:</p>
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <p class="mb-0">
                                                                                            @if (isset($deal->multiple_cities))
                                                                                                @if(is_array(json_decode($deal->multiple_cities)))
                                                                                                    @foreach (json_decode($deal->multiple_cities) as $cityn)
                                                                                                        @foreach ($cities->where('id', $cityn)->where('id', '!=', $deal->state->id) as $city)
                                                                                                            <span class="badge badge-light">{{$city->name}} </span>
                                                                                                        @endforeach
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            @else
                                                                                                <span class="badge badge-light">No Additional City Selected </span
                                                                                            @endif
                                                                                        </p>
                                                                                    </div>
                                                                                </div>



                                                                                <div class="row mb-3">
                                                                                    <div class="col-5">
                                                                                        <p class="mb-0 font-weight-bold">Additional Cities Charges:</p>
                                                                                    </div>

                                                                                    <div class="col-7">
                                                                                        <p class="mb-0">

                                                                                            @if (isset($deal->multiple_cities) && is_array(json_decode($deal->multiple_cities)))
                                                                                                @php
                                                                                                    $m_Cities = count(json_decode($deal->multiple_cities));
                                                                                                    $ad_payment = $additionalCharges->additional_city_price;
                                                                                                    $t_ad_price = $m_Cities*$ad_payment;
                                                                                                @endphp
                                                                                                <span class="font-weight-bold" style="font-size: 18px">${{$t_ad_price}}</span>
                                                                                            @else
                                                                                                <span class="font-weight-bold">$0</span>
                                                                                            @endif

                                                                                        </p>
                                                                                    </div>
                                                                                </div>

                                                                                @if(isset($vendorDeals))

                                                                                    @if(count($vendorDeals) > 0 || Auth::user()->free_deal == 'used')
                                                                                    @else
                                                                                        <h6 class="font-weight-bold mb-4 bg-warning py-1 text-center text-white">
                                                                                            Category listing for the first deal is free
                                                                                        </h6>
                                                                                    @endif
                                                                                @endif


                                                                                @if(isset($vendorDeals))

                                                                                    @if(count($vendorDeals) > 0 || Auth::user()->free_deal == 'used')

                                                                                        <div class="row mb-3">
                                                                                            <div class="col-5">
                                                                                                <p class="mb-0 font-weight-bold">
                                                                                                    Extra Category Price:
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="col-7">
                                                                                                <p class="mb-0 font-weight-bold">
                                                                                                    <span class="font-weight-bold">${{$additionalCharges->per_listing_price}}</span>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>

                                                                                    @else
                                                                                        <div class="row mb-3">
                                                                                            <div class="col-5">
                                                                                                <p class="mb-0 font-weight-bold">
                                                                                                    Extra Category Price:
                                                                                                </p>
                                                                                            </div>
                                                                                            <div class="col-7">
                                                                                                <p class="mb-0 font-weight-bold">
                                                                                                    <span class="font-weight-bold text-danger"><del>${{$additionalCharges->per_listing_price}}</del></span>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>

                                                                                    @endif
                                                                                @endif


                                                                                <div class="row mb-3">
                                                                                    <div class="col-4">
                                                                                        <p class="mb-0 font-weight-bold">
                                                                                            Total Charges:</p>
                                                                                    </div>

                                                                                    @php
                                                                                        $adListPrice = $additionalCharges->per_listing_price;
                                                                                    @endphp
                                                                                    <div class="col-8">
                                                                                        <p class="mb-0">
                                                                                        @if(isset($userPlanID))
                                                                                            @if(isset($vendorDeals))

                                                                                                @if(count($vendorDeals) > 0 || Auth::user()->free_deal == 'used')
                                                                                                    <p class="mb-0 font-weight-bold">
                                                                                                        ${{ isset($deal->checkout_price) ? $deal->checkout_price + ($adListPrice ?? 0) : 0}}
                                                                                                    </p>
                                                                                                @else

                                                                                                    <p class="font-weight-bold">
                                                                                                        ${{ isset($deal->checkout_price) ? (int)$deal->checkout_price  : 0}}
                                                                                                    </p>

                                                                                                @endif
                                                                                            @endif

                                                                                        @else

                                                                                            @php
                                                                                                $adListPrice = $additionalCharges->per_listing_price;
                                                                                            @endphp

                                                                                            @foreach($discounts as $d)
                                                                                                <p class=""
                                                                                                   style="font-size: 16px"><span class="text-warning font-weight-bold">{{$d->name}} :</span>
                                                                                                    &nbsp;&nbsp;
                                                                                                    <span class="font-weight-bold">${{$d->price}} + ${{(int)$deal->checkout_price }} =
                                                                                                                         <span class="font-weight-bold text-dark" ><b>${{$d->price + $deal->checkout_price }}</b></span>
                                                                                                                         </span>

                                                                                                </p>
                                                                                                @endforeach

                                                                                                @endif
                                                                                                </p>
                                                                                    </div>
                                                                                </div>

                                                                                <hr>

                                                                                <div class="row mb-3">
                                                                                    <div class="col-5">
                                                                                        <p class="mb-0 font-weight-bold">
                                                                                            Discount Code:</p>
                                                                                    </div>
                                                                                    <div class="col-7">
                                                                                        <input class="form-control discount-code"
                                                                                               type="text"
                                                                                               name="discount_code"
                                                                                               value=""
                                                                                               data-deal-id="{{ $deal->id }}"
                                                                                               placeholder="Got a discount! type here...">
                                                                                    </div>
                                                                                </div>


                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <form style="display: inline"
                                                                          action="{{route('deal.payment')}}"
                                                                          method="POST">
                                                                        @csrf

                                                                        <input type="hidden" name="discount" id="discount-code-{{ $deal->id }}"
                                                                               value="">

                                                                        <input type="hidden" name="deal_id"
                                                                               value="{{$deal->id}}">
                                                                        <input type="hidden" name="deal_title"
                                                                               value="{{ isset($deal->title) ? $deal->title : ''}}">
                                                                        <input type="hidden" name="deal_image"
                                                                               value="{{ isset($deal->image) ? asset($deal->image) : ''}}">

                                                                        @php
                                                                            $vendorDeals = \App\Models\Deals::where('user_id', Auth::user()->id)->get();
                                                                        @endphp

                                                                        @if(isset($userPlanID))
                                                                            @if(isset($vendorDeals))

                                                                                @if(count($vendorDeals) > 0 || Auth::user()->free_deal == 'used')

                                                                                    <input class="checkout_price"
                                                                                           type="hidden"
                                                                                           name="checkout_price"
                                                                                           value="{{ isset($deal->checkout_price) ? $deal->checkout_price + ($adListPrice ?? 0) : 0}}"
                                                                                    >
                                                                                @else

                                                                                    <input class="checkout_price"
                                                                                           type="hidden"
                                                                                           name="checkout_price"
                                                                                           value="{{ isset($deal->checkout_price) ? (int)$deal->checkout_price  : 0}}"
                                                                                    >

                                                                                @endif
                                                                            @endif

                                                                        @else

                                                                            @if(isset($vendorDeals))

                                                                                @if(count($vendorDeals) > 0 || Auth::user()->free_deal == 'used')

                                                                                    <input class="checkout_price"
                                                                                           type="hidden"
                                                                                           name="checkout_price"
                                                                                           value="{{ isset($deal->checkout_price) ? $deal->checkout_price + ($adListPrice ?? 0) : 0}}"
                                                                                    >
                                                                                @else

                                                                                    <input class="checkout_price"
                                                                                           type="hidden"
                                                                                           name="checkout_price"
                                                                                           value="{{ isset($deal->checkout_price) ? (int)$deal->checkout_price  : 0}}"
                                                                                    >

                                                                                @endif
                                                                            @endif

                                                                        @endif

                                                                        <button id="checkout-button{{$deal->id}}"
                                                                                class="btn btn-success w-100 text-uppercase">
                                                                            @if(Auth::user()->plan_id == null)
                                                                                Go To Subscriptions Plans  <i class="la la-arrow-right" style="font-size: 16px"></i>
                                                                            @else
                                                                                Proceed to Checkout  <i class="la la-shopping-cart" style="font-size: 16px"></i>
                                                                            @endif



                                                                        </button>


                                                                    </form>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <script type="text/javascript">
                                                // Create an instance of the Stripe object with your publishable API key
                                                var stripe = Stripe('pk_test_8l3Hjcr9iumvbGKsMZcYtJCH'); // Add your own
                                                var checkoutButton = document.getElementById('checkout-button{{$deal->id}}');

                                                checkoutButton.addEventListener('click', function () {
                                                    // Create a new Checkout Session using the server-side endpoint you
                                                    // created in step 3.
                                                    fetch('/deal_payment', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'Accept': 'application/json',
                                                            'url': '/payment',
                                                            "X-CSRF-Token": document.querySelector('input[name=_token]').value
                                                        },
                                                    })
                                                        .then(function (response) {
                                                            return response.json();
                                                        })
                                                        .then(function (session) {
                                                            return stripe.redirectToCheckout({sessionId: session.id});
                                                        })
                                                        .then(function (result) {
                                                            // If `redirectToCheckout` fails due to a browser or network
                                                            // error, you should display the localized error message to your
                                                            // customer using `error.message`.
                                                            if (result.error) {
                                                                alert(result.error.message);
                                                            }
                                                        })
                                                        .catch(function (error) {
                                                            console.error('Error:', error);
                                                        });
                                                });
                                            </script>
                                            <a href="{{route('vendor.cart.edit',$deal->id)}}" title="Edit"><i
                                                        class="la la-edit btn btn-success action-cons"
                                                        aria-hidden="true"></i></a>
                                            <a href="{{route('vendor.cart.delete',$deal->id)}}"
                                               onclick="return confirm('Are you sure to want delete this item?');"
                                               title="Delete"><i
                                                        class="la la-trash-o  btn btn-danger action-cons"
                                                        aria-hidden="true"></i>
                                            </a>

                                        </td>
                                        @php $i++; @endphp
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{--    @if(count($carts) > 9)--}}
{{--        <div class="card my-3   ">--}}
{{--            <div class="card-body py-4">--}}
{{--                @if(isset($vendorDeals))--}}

{{--                    @if(count($vendorDeals) > 0 || Auth::user()->free_deal == 'used')--}}
{{--                    @else--}}
{{--                        <h6 class="font-weight-bold mb-4 bg-warning py-1 text-center text-white">--}}
{{--                            Category listing for the First Deal is Free--}}
{{--                        </h6>--}}
{{--                    @endif--}}
{{--                @endif--}}


{{--                <div class="row">--}}
{{--                    <div class="col-12 col-lg-9 align-items-center align-self-center">--}}
{{--                        <div class="row text-center">--}}
{{--                            <div class="12 col-2">--}}
{{--                                <p class="font-weight-bold">Total cart = <span class="totalCart"></span></p>--}}
{{--                            </div>--}}
{{--                            <div class="12 col-4">--}}
{{--                                <p class="font-weight-bold">Total Listing Price : &nbsp;--}}
{{--                                    <span class="totalCart"></span> * <span class="listPrice"></span> =  <span class="totalAmount"></span>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <div class="12 col-3">--}}
{{--                                <p class="font-weight-bold">Total Cart Price = <span class="sum"></span></p>--}}
{{--                            </div>--}}

{{--                            <div class="12 col-3">--}}
{{--                                <p class="font-weight-bold">Total Amount = <span class="totalCartAmount"></span></p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-12 col-lg-3 text-end">--}}


{{--                            @if(isset($userPlanID))--}}

{{--                                <form style="text-align: right; margin-bottom: 20px;" action="{{route('checkout.all')}}"--}}
{{--                                      method="POST">--}}
{{--                                    @csrf--}}
{{--                                    <div class="text-left">--}}
{{--                                        <input type="hidden" class="form-control" name="total_checkout_price" id="total_checkout_price">--}}
{{--                                    </div>--}}

{{--                                    <div class="text-left">--}}
{{--                                        <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{Auth::user()->id}}">--}}
{{--                                    </div>--}}

{{--                                    <button id="checkout-button" class="btn btn-success action-cons">Checkout All--}}
{{--                                    </button>--}}
{{--                                </form>--}}

{{--                            @else--}}
{{--                                <div class="text-right mb-3">--}}
{{--                                    <button id="" class="btn btn-success btn-lg"--}}
{{--                                            data-toggle="modal" data-target="#checkoutAllBtn"--}}
{{--                                    >Checkout All--}}
{{--                                    </button>--}}
{{--                                </div>--}}


{{--                                <div class="modal fade" id="checkoutAllBtn"--}}
{{--                                     tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"--}}
{{--                                     aria-hidden="true" style="padding-right: 0px !important;">--}}
{{--                                    <div class="modal-dialog modal-dialog-centered modal-lg"--}}
{{--                                         role="document">--}}
{{--                                        <div class="modal-content">--}}
{{--                                            <div class="text-right">--}}
{{--                                                <button type="button" class="close mr-3 mt-2"--}}
{{--                                                        data-dismiss="modal" aria-label="Close">--}}
{{--                                                    <span aria-hidden="true">&times;</span>--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                            <div class="modal-body text-center  ">--}}

{{--                                                <i class="la la-exclamation-circle rounded-circle text-warning" style="font-size: 120px"></i>--}}

{{--                                                <h4 class="my-3">Please Buy Subscription Plan...</h4>--}}

{{--                                                <a class="btn btn-sm btn-warning mb-4"  href="{{route('plan.pricing')}}" style="font-size: 16px">--}}
{{--                                                    Go to Subscription <i class="la la-arrow-right"></i>--}}
{{--                                                </a>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            @endif--}}

{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}
</div>


@push('customJs')
    <script>
        $(document).ready(function () {

            $('#userList').DataTable();

        });
    </script>

    <script>
        jQuery(document).ready(function() {
            jQuery('#loading').fadeOut(3000);

            $(document).on('keyup', '.discount-code', function (e) {
                let dealId = $(this).data('deal-id');
                $(`#discount-code-${dealId}`).val($(this).val());
            })
        });
    </script>



    {{--                    <script>--}}
    {{--                        setTimeout(() => {--}}
    {{--                            sumjq = function (selector) {--}}
    {{--                                var sum = 0;--}}

    {{--                                let additonalListingPrice = {{$additionalCharges->per_listing_price ?? 0 }};--}}

    {{--                                console.log(additonalListingPrice);--}}
    {{--                                alert("ok")--}}

    {{--                                $(selector).each(function () {--}}
    {{--                                    sum += Number($(this).val());--}}
    {{--                                });--}}
    {{--                                return sum;--}}
    {{--                            }--}}

    {{--                            $('#total_checkout_price').val(sumjq('.checkout_price'));--}}
    {{--                        }, 2000);--}}
    {{--                    </script>--}}


    @if(isset($vendorDeals))

        @php
            $cart = \App\Models\Cart::where('user_id', Auth::user()->id)->get();
                    $countCartDeal = count($cart);
        @endphp

        @if(count($vendorDeals) > 0 || Auth::user()->free_deal == 'used')

            <script>
                setTimeout(() => {
                    sumjq = function (selector) {
                        var sum = 0;

                        let additonalListingPrice = {{$additionalCharges->per_listing_price ?? 0 }};

                        let countCartData = {{$countCartDeal ?? 0 }};

                        $(selector).each(function () {
                            sum += Number($(this).val());
                        });

                        let totalfreeCheckoutPrice = additonalListingPrice * countCartData ;

                        // let totalAmount = sum

                        $('.totalCheckoutAlllData').html(sum);

                        return sum ;
                    }

                    $('#total_checkout_price').val(sumjq('.checkout_price'));
                    $('#show_checkout_price').html(sumjq('.checkout_price'));
                }, 2000);
            </script>

        @else

            <script>
                setTimeout(() => {
                    sumjq = function (selector) {
                        var sum = 0;

                        let additonalListingPrice = {{$additionalCharges->per_listing_price ?? 0 }};

                        let countCartData = {{$countCartDeal ?? 0 }};

                        $(selector).each(function () {
                            sum += Number($(this).val());
                        });

                        let totalfreeCheckoutPrice = additonalListingPrice * countCartData ;
                        let totalAmount = (sum + totalfreeCheckoutPrice) - additonalListingPrice


                        // $('.totalCart').html(countCartData);
                        $('.listPrice').html('$' +additonalListingPrice);
                        $('.totalAmount').html('$' +totalfreeCheckoutPrice);
                        $('.sum').html('$' +sum);

                        $('.totalCart').html(countCartData);
                        $('.totalCartAmount').html('$' +totalAmount);


                        return totalAmount ;
                    }

                    $('#total_checkout_price').val(sumjq('.checkout_price'));
                    $('#show_checkout_price').html(sumjq('.checkout_price'));

                }, 2000);
            </script>

        @endif

    @endif

@endpush