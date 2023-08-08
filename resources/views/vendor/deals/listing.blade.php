@extends('vendor.layouts.app')

@section('title', 'Vendor : Deals List')

@push('customCSS')
<style type="text/css" media="screen">
	.action-cons {
		font-size: 20px;
		font-weight: bold;
	}

	.action-cons:hover {
		font-size: 20px;
		color: #f8f9fa;
		background: #339af0;
	}
	.filter-input-list{
		display:inline-flex;
	}
	.filter-input-list .filter-input , .filter-select{
		padding: 5px;
		font-size:revert;
		margin:0px 10px 5px 2px;
	}

	li::marker{
		color: transparent;
	}

</style>
@endpush

@section('content')

<div class="main-panel">
	<div class="content">
		<div class="container-fluid mb-3">
			<a href="{{ route('vendor.deals.create') }}" style="margin-top: -20px; margin-bottom: 20px"
				class="btn btn-danger" title="add users">Create A Deal</a>

			<div class="modal fade" id="showSuccessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
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
									<div class="text-center">
										<h4 class="text-success font-weight-bold">Success!</h4>
										<i class="la la-check bg-success my-3 font-weight-bold text-white rounded-circle p-3 text-center" style="font-size: 50px"></i>
										@if(isset($success_deal) && !is_null($success_deal))
										<h6>{{ $success_deal }} </h6>
										@else
										<h6>
											Your checkout data send to admin,
											please wait for their moderation before publish your Deal!
										</h6>
										@endif
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-md-12">
					<div class="card">


						@if (session()->has('welcome_msg'))

						@endif

						@if ($message = Session::get('success'))
							<div class="alert alert-success alert-block">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong>{{ $message }}</strong>

							</div>
						@endif

{{--						@include('flash-message')--}}
						<div class="card-header">
							<div class="card-title">Deals List</div>
						</div>

						<div class="card-body">
						<div class="filter-input-list">
							<input type="text" class="form-control filter-input" placeholder="Search By Title" data-column="1" >
							<input type="text" class="form-control filter-input" placeholder="Search By Original Price" data-column="3" >
							<input type="text" class="form-control filter-input" placeholder="Search By Deal Code" data-column="6" >
							<input type="text" class="form-control filter-input" placeholder="Search By City" data-column="7" >
							<select class="form-control filter-select" data-column="10">
							    <option class="all" value="" data-column="10">All</option>
							    <option class="select-active text-success" value="Active" data-column="10">Active</option>
								<option class="select-Inactive text-danger" value="Inactive" data-column="10">Inactive</option>
							</select>
						</div>
						<div class="table-responsive mt-3">
							<table class="table table-bordered" id="userList">
								<thead>
								<tr>
									<th><strong>Sr. No.</strong></th>
									<th><strong>Title</strong></th>
									<th><strong>Image</strong></th>
									<th><strong>Original Price</strong></th>
									<th><strong>Deal Price</strong></th>
									<th><strong>Category</strong></th>
									<th><strong>Deal Code</strong></th>
									<th><strong>City</strong></th>
									<th><strong>Additional Cities</strong></th>
									<th><strong>Is featured?</strong></th>
									<th><strong>Status</strong></th>
									<th><strong>Admin Comment</strong></th>
									<th><strong>Actions</strong></th>
								</tr>
								</thead>
								<tbody>
								@if(!empty($deals))
									@php $i = 1; @endphp
									@foreach($deals as $key => $deal)
										<tr>
											<td>{{ $i }}</td>
											<td>{{ isset($deal->title) ? $deal->title : ''}}</td>
											<td>
												@if(isset($deal->image))
													<img src="{{asset($deal->image)}}"
														 alt="{{ isset($deal->title) ? $deal->title : ''}}" width="70">
												@else
													N/A
												@endif
											</td>
											<td>${{ isset($deal->price) ? $deal->price : ''}}</td>
											<td>${{ isset($deal->offer_price) ? $deal->offer_price : '--'}}</td>
											<td>{{ !empty($deal->category) ? (isset($deal->category->name) ? $deal->category->name : '') : ''}}</td>

											<td>{{ isset($deal->discountcode) ? $deal->discountcode : '' }}</td>

											<td>{{ !empty($deal->state) ? (isset($deal->state->name) ? $deal->state->name : '') : ''}}
											</td>
											<td>
												@if ($deal->multiple_cities != 'null' && $deal->multiple_cities != 'NULL' && !empty($deal->multiple_cities))
													@foreach (json_decode($deal->multiple_cities) as $cityn)
														@foreach ($cities->where('id', $cityn)->where('id', '!=', $deal->state->id) as $city)
															{{$city->name}} <br>
														@endforeach
													@endforeach
												@endif

													<a href="{{route('vendor.deals.editDealCity',$deal->id)}}"class="text-left text-warning font-weight-bold"><i class="la la-plus-circle font-weight-bold"></i> Add Additional City
													</a>

											</td>
											<td>{{ (($deal->is_featured == 1) ? 'Yes' : 'No') }}</td>

											<td><span class="badge badge-{{ (($deal->status == 1) ? 'success' : 'danger') }}">
												{{ (($deal->status == 1) ? 'Active' : 'Inactive') }}
											</span></td>

											<td>{{ isset($deal->admin_comment) ? $deal->admin_comment : ''}}</td>
											<td width="20%">
												<a href="{{route('vendor.dealdetail', $deal->id)}}" target="_blank"><i
															class="la la-eye btn btn-success action-cons"
															aria-hidden="true"></i></a>
												<a href="{{route('vendor.deals.edit',$deal->id)}}" title="Edit"><i
															class="la la-edit btn btn-success action-cons"
															aria-hidden="true"></i></a>
												<a href="{{route('vendor.deals.delete',$deal->id)}}"
												   onclick="return confirm('Are you sure to want delete this item?');"
												   title="Delete"><i class="la la-trash-o  btn btn-danger action-cons"
																	 aria-hidden="true"></i></a>
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
		</div>

		<div class="container-fluid">

			@include('vendor.deals.partials.partial-cart')


{{--			<div class="row">--}}
{{--				<div class="col-md-12">--}}
{{--					<div class="card">--}}
{{--						@include('flash-message')--}}
{{--						<div class="card-header">--}}
{{--							<div class="card-title">Your Pending Cart List</div>--}}
{{--						</div>--}}
{{--						<div class="card-body">--}}
{{--							<div class="table-responsive">--}}
{{--								<table class="table table-bordered" id="userList">--}}
{{--									<thead>--}}
{{--									<tr>--}}
{{--										<th><strong>Sr. No.</strong></th>--}}
{{--										<th><strong>Title</strong></th>--}}
{{--										<th><strong>Image</strong></th>--}}
{{--										<th><strong>Original Price</strong></th>--}}
{{--										<th><strong>Deal Price</strong></th>--}}
{{--										<th><strong>Category</strong></th>--}}
{{--										<th><strong>City</strong></th>--}}
{{--										<th><strong>Additional Cities</strong></th>--}}
{{--										<th><strong>Discount Code</strong></th>--}}
{{--										<th><strong>Actions</strong></th>--}}
{{--									</tr>--}}
{{--									</thead>--}}
{{--									<tbody>--}}
{{--									@if(!empty($cartData))--}}
{{--										@php $i = 1; @endphp--}}
{{--										@foreach($cartData as $key => $cart)--}}
{{--											<tr>--}}
{{--												<td>{{ $i }}</td>--}}
{{--												<td>{{ isset($cart->title) ? $cart->title : ''}}</td>--}}
{{--												<td>--}}
{{--													@if(isset($cart->image))--}}
{{--														<img src="{{asset($cart->image)}}"--}}
{{--															 alt="{{ isset($cart->title) ? $cart->title : ''}}"--}}
{{--															 width="70" height="50">--}}
{{--													@else--}}
{{--														N/A--}}
{{--													@endif--}}
{{--												</td>--}}
{{--												<td>${{ isset($cart->price) ? $cart->price : ''}}</td>--}}
{{--												<td>${{ isset($cart->offer_price) ? $cart->offer_price : '--'}}</td>--}}
{{--												<td>{{ !empty($cart->category) ? (isset($cart->category->name) ? $cart->category->name : '') : ''}}--}}
{{--												</td>--}}
{{--												<td>{{ !empty($cart->state) ? (isset($cart->state->name) ? $cart->state->name : '') : ''}}--}}
{{--												</td>--}}
{{--												<td>--}}
{{--													@if (isset($cart->multiple_cities))--}}
{{--														@if(is_array(json_decode($cart->multiple_cities)))--}}
{{--															@foreach (json_decode($cart->multiple_cities) as $cityn)--}}
{{--																@foreach ($cities->where('id', $cityn)->where('id', '!=', $cart->state->id) as $city)--}}
{{--																	{{$city->name}} <br>--}}
{{--																@endforeach--}}
{{--															@endforeach--}}
{{--														@endif--}}
{{--													@endif--}}
{{--												</td>--}}
{{--												<td><input class="form-control" type="text" name="discount_code"--}}
{{--														   value="" placeholder="got a discount! type here..."></td>--}}
{{--												<td width="20%">--}}
{{--													--}}{{-- <a href="{{route('home.deal_detail', $deal->slug)}}" target="_blank"><i--}}
{{--                                                            class="la la-eye btn btn-success action-cons"--}}
{{--                                                            aria-hidden="true"></i></a> --}}
{{--													--}}{{-- <a class="btn btn-success action-cons" href="" title="Checkout">Checkout</a> --}}

{{--													<script src="https://js.stripe.com/v3/"></script>--}}

{{--													<button type="button" class="btn btn-success" data-toggle="modal"--}}
{{--															data-target="#checkoutByDeal{{$cart->id}}Id">--}}
{{--														checkout--}}
{{--													</button>--}}

{{--													<!-- Modal -->--}}
{{--													<div class="modal fade" id="checkoutByDeal{{$cart->id}}Id"--}}
{{--														 tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"--}}
{{--														 aria-hidden="true">--}}
{{--														<div class="modal-dialog modal-dialog-centered modal-lg"--}}
{{--															 role="document">--}}
{{--															<div class="modal-content">--}}
{{--																<div class="text-right">--}}
{{--																	<button type="button" class="close mr-3 mt-2"--}}
{{--																			data-dismiss="modal" aria-label="Close">--}}
{{--																		<span aria-hidden="true">&times;</span>--}}
{{--																	</button>--}}
{{--																</div>--}}
{{--																<div class="modal-body">--}}
{{--																	<div class="card border-0 shadow-none"--}}
{{--																		 style="box-shadow: none">--}}
{{--																		<div class="card-body">--}}
{{--																			<div class="row mb-3">--}}

{{--																				<div class="col-12 col-lg-5 mb-3 mb-lg-0">--}}
{{--																					@if(isset($cart->image))--}}
{{--																						<img class="img-fluid w-100 h-auto"--}}
{{--																							 style="border-radius: 20px;"--}}
{{--																							 src="{{asset($cart->image)}}"--}}
{{--																							 alt="{{ isset($cart->title) ? $cart->title : ''}}">--}}
{{--																					@else--}}
{{--																						N/A--}}
{{--																					@endif--}}
{{--																				</div>--}}

{{--																				<div class="col-12 col-lg-7 mb-3 mb-lg-0">--}}
{{--																					<div>--}}
{{--																						<h5 class="font-weight-bold">{{ isset($cart->title) ? $cart->title : ''}}</h5>--}}
{{--																						<hr>--}}

{{--																						<div class="row mb-3">--}}
{{--																							<div class="col-5">--}}
{{--																								<p class="mb-0 font-weight-bold">--}}
{{--																									Original Price:</p>--}}
{{--																							</div>--}}
{{--																							<div class="col-7">--}}
{{--																								<p class="mb-0">--}}
{{--																									${{ isset($cart->price) ? $cart->price : ''}}</p>--}}
{{--																							</div>--}}
{{--																						</div>--}}

{{--																						<div class="row mb-3">--}}
{{--																							<div class="col-5">--}}
{{--																								<p class="mb-0 font-weight-bold">--}}
{{--																									Deal Price:</p>--}}
{{--																							</div>--}}
{{--																							<div class="col-7">--}}
{{--																								<p class="mb-0">--}}
{{--																									${{ isset($cart->offer_price) ? $cart->offer_price : ''}}</p>--}}
{{--																							</div>--}}
{{--																						</div>--}}

{{--																						<div class="row mb-3">--}}
{{--																							<div class="col-5">--}}
{{--																								<p class="mb-0 font-weight-bold">--}}
{{--																									Category:</p>--}}
{{--																							</div>--}}
{{--																							<div class="col-7">--}}
{{--																								<p class="mb-0"><span--}}
{{--																											class="badge badge-warning">--}}
{{--																								{{ !empty($cart->category) ? (isset($cart->category->name) ? $cart->category->name : '') : ''}}--}}
{{--																							</span></p>--}}
{{--																							</div>--}}
{{--																						</div>--}}

{{--																						<div class="row mb-3">--}}
{{--																							<div class="col-5">--}}
{{--																								<p class="mb-0 font-weight-bold">--}}
{{--																									City:</p>--}}
{{--																							</div>--}}
{{--																							<div class="col-7">--}}
{{--																								<p class="mb-0">--}}
{{--																							<span class="badge badge-light">--}}
{{--																								{{ !empty($cart->state) ? (isset($cart->state->name) ? $cart->state->name : '') : ''}}--}}
{{--																							</span>--}}
{{--																								</p>--}}
{{--																							</div>--}}
{{--																						</div>--}}

{{--																						<div class="row mb-3">--}}
{{--																							<div class="col-5">--}}
{{--																								<p class="mb-0 font-weight-bold">--}}
{{--																									Additional--}}
{{--																									Cities:</p>--}}
{{--																							</div>--}}
{{--																							<div class="col-7">--}}
{{--																								<p class="mb-0">--}}

{{--																									@if (isset($cart->multiple_cities))--}}
{{--																										@if(is_array(json_decode($cart->multiple_cities)))--}}
{{--																											@foreach (json_decode($cart->multiple_cities) as $cityn)--}}
{{--																												@foreach ($cities->where('id', $cityn)->where('id', '!=', $cart->state->id) as $city)--}}
{{--																													<span class="badge badge-light">{{$city->name}} </span>--}}
{{--																												@endforeach--}}
{{--																											@endforeach--}}
{{--																										@endif--}}
{{--																									@else--}}
{{--																										<span class="badge badge-light">No Additional City Selected </span--}}
{{--																									@endif--}}
{{--																								</p>--}}
{{--																							</div>--}}
{{--																						</div>--}}


{{--																						@php--}}

{{--																							$allCartData = \App\Models\Cart::where('user_id', Auth::user()->id)->first();--}}

{{--                                                                                            $alldealData = \App\Models\Deals::where('user_id', Auth::user()->id)->first();--}}


{{--																						@endphp--}}



{{--																						@if($loop->iteration == 1)--}}

{{--																						@else--}}

{{--																							@if(!is_null($allCartData) || !is_null($alldealData))--}}

{{--																								<div class="row mb-3">--}}
{{--																									<div class="col-5">--}}
{{--																										<p class="mb-0 font-weight-bold">--}}
{{--																											Category Price:</p>--}}
{{--																									</div>--}}
{{--																									<div class="col-7">--}}
{{--																										<p class="mb-0 font-weight-bold">--}}
{{--																											<span class="font-weight-bold">${{$additionalCharges->per_listing_price}}</span>--}}
{{--																										</p>--}}
{{--																									</div>--}}
{{--																								</div>--}}
{{--																							@else--}}

{{--																							@endif--}}

{{--																						@endif--}}

{{--																						<div class="row mb-3">--}}
{{--																							<div class="col-5">--}}
{{--																								<p class="mb-0 font-weight-bold">--}}
{{--																									Additional Cities--}}
{{--																									Charges:</p>--}}
{{--																							</div>--}}

{{--																							<div class="col-7">--}}
{{--																								<p class="mb-0">--}}

{{--																									@if (isset($cart->multiple_cities) && is_array(json_decode($cart->multiple_cities)))--}}
{{--																										@php--}}
{{--																											$m_Cities = count(json_decode($cart->multiple_cities));--}}
{{--                                                                                                            $ad_payment = $additionalCharges->additional_city_price;--}}
{{--                                                                                                            $t_ad_price = $m_Cities*$ad_payment;--}}
{{--																										@endphp--}}
{{--																										<span class="font-weight-bold"--}}
{{--																											  style="font-size: 18px">${{$t_ad_price}}</span>--}}
{{--																									@else--}}
{{--																										<span class="badge badge-light">$0</span>--}}
{{--																									@endif--}}


{{--																								</p>--}}
{{--																							</div>--}}
{{--																						</div>--}}

{{--																						<div class="row mb-3">--}}
{{--																							<div class="col-4">--}}
{{--																								<p class="mb-0 font-weight-bold">--}}
{{--																									Total Charges:</p>--}}
{{--																							</div>--}}

{{--																							<div class="col-8">--}}
{{--																								<p class="mb-0">--}}
{{--																									@if(isset($userPlanID))--}}

{{--																										@if (isset($cart->multiple_cities) && json_decode($cart->multiple_cities))--}}
{{--																											@php--}}
{{--																												$m_Cities = count(json_decode($cart->multiple_cities));--}}
{{--                                                                                                                $ad_payment = $additionalCharges->additional_city_price;--}}
{{--                                                                                                                $t_ad_price = $m_Cities*$ad_payment;--}}
{{--                                                                                                                 $adListPrice = $additionalCharges->per_listing_price;--}}
{{--																											@endphp--}}
{{--																											@if($loop->iteration == 1)--}}

{{--																											@else--}}
{{--																												@if(!is_null($allCartData) || !is_null($alldealData))--}}

{{--																													<span class="font-weight-bold" style="font-size: 18px"> ${{$adListPrice + $t_ad_price }}</span>--}}

{{--																												@else--}}

{{--																													<span class="font-weight-bold" style="font-size: 18px"> ${{ $additionalCharges->per_listing_price ?? ''  }}</span>--}}

{{--																								@endif--}}

{{--																								@endif--}}
{{--																								@endif--}}

{{--																								@else--}}

{{--																									@if (isset($cart->multiple_cities) && json_decode($cart->multiple_cities))--}}
{{--																										@php--}}
{{--																											$m_Cities = count(json_decode($cart->multiple_cities));--}}
{{--                                                                                                            $ad_payment = $additionalCharges->additional_city_price;--}}
{{--                                                                                                            $t_ad_price = $m_Cities*$ad_payment;--}}
{{--																										@endphp--}}

{{--																										@foreach($discounts as $d)--}}
{{--																											<p class="font-weight-bold"--}}
{{--																											   style="font-size: 18px">{{$d->name}}--}}
{{--																												: &nbsp;&nbsp;<span--}}
{{--																														class="">${{$d->price}} + ${{$t_ad_price}} =--}}
{{--                                                                                                                <span class="text-white"--}}
{{--																													  style="background-color: #ff646d;border-radius: 3px;padding: 2px 4px">${{($d->price+$t_ad_price)}}</span>--}}
{{--                                                                                                                </span>--}}
{{--																											</p>--}}
{{--																											@endforeach--}}

{{--																											@endif--}}
{{--																											@endif--}}
{{--																											</p>--}}
{{--																							</div>--}}
{{--																						</div>--}}


{{--																						--}}{{--																				<div class="row mb-3">--}}
{{--																						--}}{{--																					<div class="col-5">--}}
{{--																						--}}{{--																						<p class="mb-0 font-weight-bold">Total Charges Charges:</p>--}}
{{--																						--}}{{--																					</div>--}}

{{--																						--}}{{--																					<h4>{{Auth::user()->plan_id}}</h4>--}}

{{--																						--}}{{--																					<div class="col-7">--}}
{{--																						--}}{{--																						<p class="mb-0">--}}
{{--																						--}}{{--																							--}}
{{--																						--}}{{--																						</p>--}}
{{--																						--}}{{--																					</div>--}}
{{--																						--}}{{--																				</div>--}}

{{--																						<hr>--}}

{{--																						<div class="row mb-3">--}}
{{--																							<div class="col-5">--}}
{{--																								<p class="mb-0 font-weight-bold">--}}
{{--																									Discount Code:</p>--}}
{{--																							</div>--}}
{{--																							<div class="col-7">--}}
{{--																								<input class="form-control"--}}
{{--																									   type="text"--}}
{{--																									   name="discount_code"--}}
{{--																									   value=""--}}
{{--																									   placeholder="Got a discount! type here...">--}}
{{--																							</div>--}}
{{--																						</div>--}}


{{--																					</div>--}}
{{--																				</div>--}}

{{--																			</div>--}}

{{--																			<div class="row mb-3">--}}
{{--																				@if(!empty($discounts))--}}
{{--																					@php $i = 1; @endphp--}}
{{--																					@foreach($discounts->sortBy('name') as $key => $discount)--}}
{{--																						<div class="col-12 col-md-6 wow fadeInUp mb-5 mb-lg-0 text-center"--}}
{{--																							 style="visibility: visible; animation-name: fadeInUp;">--}}
{{--																							<div class="price-table">--}}
{{--																								<div class="price-header lis-bg-light lis-rounded-top pt-3 pb-2 border border-bottom-0  lis-brd-light">--}}
{{--																									<h5 class="text-uppercase lis-latter-spacing-2 font-weight-bold">{{$discount->name}}</h5>--}}
{{--																									<h4 class="font-weight-bold">--}}
{{--																										<sup class="">$</sup> {{$discount->price}}--}}
{{--																										<small class="font-weight-bold" style="color: #fbad4c;font-size: 17px">/{{$discount->plan_duration}}</small>--}}
{{--																									</h4>--}}
{{--																									<p class="mb-0">--}}
{{--																										Advertiser--}}
{{--																										Membership</p>--}}
{{--																									--}}{{--                                                <p class="mb-0">First deal free.</p>--}}
{{--																								</div>--}}
{{--																								<div class="description-block border border-top-0 lis-brd-light bg-white pb-3 pt-1 lis-rounded-bottom">--}}
{{--																									<p>{!! $discount->description !!}</p>--}}

{{--																									@if (Auth::user()->plan_id == $discount->id && Auth::user()->plan_expiry_date > \Carbon\Carbon::now())--}}
{{--																										<button type="submit"--}}
{{--																												class="btn--}}
{{--                                                               											                  @if (isset(Auth::user()->plan_id)) btn-danger @else  btn-primary-outline @endif--}}
{{--																														btn-md lis-rounded-circle-50"--}}
{{--																												data-abc="true"--}}
{{--																												disabled>--}}
{{--																											<i class="la la-check-circle-o font-weight-bold text-white" style="color: #ffffff;font-size: 15px"></i>--}}
{{--																											Current--}}
{{--																											Plan--}}
{{--																										</button>--}}
{{--																									@else--}}

{{--																										@if (Auth::user()->plan_id)--}}

{{--																											<a href="{{route('plan.pricing')}}"--}}
{{--																											   class="btn btn-warning btn-md lis-rounded-circle-50" data-abc="true">--}}
{{--																												<i class="la la-cart-plus"></i> Upgrade Plan--}}
{{--																											</a>--}}
{{--																										@else--}}

{{--																											<form style="display: inline"--}}
{{--																												  action="{{route('deal.payment')}}"--}}
{{--																												  method="POST">--}}
{{--																												@csrf--}}
{{--																												<input type="hidden" name="deal_id"--}}
{{--																													   value="{{$cart->id}}">--}}
{{--																												<input type="hidden" name="deal_title"--}}
{{--																													   value="{{ isset($cart->title) ? $cart->title : ''}}">--}}
{{--																												<input type="hidden" name="deal_image"--}}
{{--																													   value="{{ isset($cart->image) ? asset($cart->image) : ''}}">--}}
{{--																												<input class="checkout_price"--}}
{{--																													   type="hidden"--}}
{{--																													   name="checkout_price"--}}
{{--																													   value="{{ isset($cart->checkout_price) ? $cart->checkout_price : ''}}">--}}
{{--																												<button id="checkout-button{{$cart->id}}"--}}
{{--																														class="btn btn-warning text-uppercase">--}}
{{--																													Sign Up Now--}}
{{--																												</button>--}}
{{--																											</form>--}}

{{--																										@endif--}}

{{--																									@endif--}}


{{--																								</div>--}}
{{--																							</div>--}}
{{--																						</div>--}}
{{--																						@php $i++; @endphp--}}
{{--																					@endforeach--}}
{{--																				@endif--}}
{{--																			</div>--}}

{{--																			<form style="display: inline"--}}
{{--																				  action="{{route('deal.payment')}}"--}}
{{--																				  method="POST">--}}
{{--																				@csrf--}}
{{--																				<input type="hidden" name="deal_id"--}}
{{--																					   value="{{$cart->id}}">--}}
{{--																				<input type="hidden" name="deal_title"--}}
{{--																					   value="{{ isset($cart->title) ? $cart->title : ''}}">--}}
{{--																				<input type="hidden" name="deal_image"--}}
{{--																					   value="{{ isset($cart->image) ? asset($cart->image) : ''}}">--}}
{{--																				<input class="checkout_price"--}}
{{--																					   type="hidden"--}}
{{--																					   name="checkout_price"--}}
{{--																					   value="{{ isset($cart->checkout_price) ? $cart->checkout_price : ''}}">--}}
{{--																				<button id="checkout-button{{$cart->id}}"--}}
{{--																						class="btn btn-success w-100 text-uppercase">--}}
{{--																					Proceed to Checkout--}}
{{--																				</button>--}}
{{--																			</form>--}}


{{--																		</div>--}}
{{--																	</div>--}}
{{--																</div>--}}
{{--															</div>--}}
{{--														</div>--}}
{{--													</div>--}}


{{--													<script type="text/javascript">--}}
{{--														// Create an instance of the Stripe object with your publishable API key--}}
{{--														var stripe = Stripe('pk_test_8l3Hjcr9iumvbGKsMZcYtJCH'); // Add your own--}}
{{--														var checkoutButton = document.getElementById('checkout-button{{$cart->id}}');--}}

{{--														checkoutButton.addEventListener('click', function () {--}}
{{--															// Create a new Checkout Session using the server-side endpoint you--}}
{{--															// created in step 3.--}}
{{--															fetch('/deal_payment', {--}}
{{--																method: 'POST',--}}
{{--																headers: {--}}
{{--																	'Content-Type': 'application/json',--}}
{{--																	'Accept': 'application/json',--}}
{{--																	'url': '/payment',--}}
{{--																	"X-CSRF-Token": document.querySelector('input[name=_token]').value--}}
{{--																},--}}
{{--															})--}}
{{--																	.then(function (response) {--}}
{{--																		return response.json();--}}
{{--																	})--}}
{{--																	.then(function (session) {--}}
{{--																		return stripe.redirectToCheckout({sessionId: session.id});--}}
{{--																	})--}}
{{--																	.then(function (result) {--}}
{{--																		// If `redirectToCheckout` fails due to a browser or network--}}
{{--																		// error, you should display the localized error message to your--}}
{{--																		// customer using `error.message`.--}}
{{--																		if (result.error) {--}}
{{--																			alert(result.error.message);--}}
{{--																		}--}}
{{--																	})--}}
{{--																	.catch(function (error) {--}}
{{--																		console.error('Error:', error);--}}
{{--																	});--}}
{{--														});--}}
{{--													</script>--}}
{{--													<a href="{{route('vendor.cart.edit',$cart->id)}}" title="Edit"><i--}}
{{--																class="la la-edit btn btn-success action-cons"--}}
{{--																aria-hidden="true"></i></a>--}}
{{--													<a href="{{route('vendor.cart.delete',$cart->id)}}"--}}
{{--													   onclick="return confirm('Are you sure to want delete this item?');"--}}
{{--													   title="Delete"><i--}}
{{--																class="la la-trash-o  btn btn-danger action-cons"--}}
{{--																aria-hidden="true"></i>--}}
{{--													</a>--}}

{{--												</td>--}}
{{--												@php $i++; @endphp--}}
{{--											</tr>--}}
{{--										@endforeach--}}
{{--									@endif--}}
{{--									</tbody>--}}
{{--								</table>--}}
{{--							</div>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}
		</div>

	</div>


	@endsection

	@push('customJs')
	<script>
		$(document).ready(function() {

			$('#userList').DataTable();

		});
	</script>
	<script>
	var table = $('#userList').DataTable();
		$('.filter-input').keyup(function(){
            table.column($(this).data('column') )
			.search($(this).val() )
			.draw();
		});
	</script>

	<script>
        var table = $('#userList').DataTable();

        $('.filter-select').change(function() {
            console.log($(this).val().length);
            table.column($(this).data('column'))
                .search($(this).val() ,true, true, false)
                .draw();
        });

    </script>


		@if ($message = Session::get('success_payment'))
				<script>
					$(document).ready(function (){
						$('#showSuccessModal').modal('show');
					})
				</script>
		@endif

	@endpush