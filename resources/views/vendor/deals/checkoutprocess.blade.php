@extends('vendor.layouts.app')

@section('title', 'Vendor : Checkout Process')

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
</style>
@endpush

@section('content')

<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						@include('flash-message')
						<div class="card-header">
							<div class="card-title">Checkout Processing Now</div>

						</div>
						<div style="margin: 10% 0" class="card-body text-center">
							<img width="256px" src="{{asset('images/loading-circle.gif')}}" alt="">
							<script src="https://js.stripe.com/v3/"></script>
										<form style="display: none" action="{{route('deal.payment')}}" method="POST">
											@csrf
											<input type="hidden" name="deal_id" value="{{$deal->id}}">
											<input type="hidden" name="deal_title" value="{{ isset($deal->title) ? $deal->title : ''}}">
											<input type="hidden" name="deal_image" value="{{ isset($deal->image) ? asset('public/'.$deal->image) : ''}}">
											<input id="checkout-price" type="hidden" name="checkout_price" value="{{ isset($deal->checkout_price) ? $deal->checkout_price : ''}}">
											<button id="checkout-button" class="btn btn-success action-cons">Checkout</button>
										</form>
										<form style="display: none" action="{{route('deal.payment.free')}}" method="POST">
											@csrf
											<input type="hidden" name="deal_id" value="{{$deal->id}}">
											<input type="hidden" name="deal_title" value="{{ isset($deal->title) ? $deal->title : ''}}">
											<input type="hidden" name="deal_image" value="{{ isset($deal->image) ? asset('public/'.$deal->image) : ''}}">
											<input type="hidden" name="checkout_price" value="{{ isset($deal->checkout_price) ? $deal->checkout_price : ''}}">
											<button id="checkout-button2" class="btn btn-success action-cons">Checkout</button>
										</form>
			
										<script type="text/javascript">
											// Create an instance of the Stripe object with your publishable API key
											var stripe = Stripe('pk_test_8l3Hjcr9iumvbGKsMZcYtJCH'); // Add your own
											var checkoutButton = document.getElementById('checkout-button');
											var checkoutButton2 = document.getElementById('checkout-button2');
			
											checkoutButton.addEventListener('click', function() {
												// Create a new Checkout Session using the server-side endpoint you
												// created in step 3.
												console.log($('#checkout-price').val());
												if ($('#checkout-price').val() == 0){
													fetch('/deal_payment_free', {
													method: 'POST', 
													headers: {
														'Content-Type': 'application/json',
														'Accept': 'application/json',
														'url': '/deal_payment_free',
														"X-CSRF-Token": document.querySelector('input[name=_token]').value
													},
												})
												.then(function(response) {
													return response.json();
												})
												.then(function(result) {
													// If `redirectToCheckout` fails due to a browser or network
													// error, you should display the localized error message to your
													// customer using `error.message`.
													if (result.error) {
														alert(result.error.message);
													}
												})
												.catch(function(error) {
													console.error('Error:', error);
												});
												}
												else {
												fetch('/deal_payment', {
													method: 'POST', 
													headers: {
														'Content-Type': 'application/json',
														'Accept': 'application/json',
														'url': '/payment',
														"X-CSRF-Token": document.querySelector('input[name=_token]').value
													},
												})
												.then(function(response) {
													return response.json();
												})
												.then(function(session) {
													return stripe.redirectToCheckout({ sessionId: session.id });
												})
												.then(function(result) {
													// If `redirectToCheckout` fails due to a browser or network
													// error, you should display the localized error message to your
													// customer using `error.message`.
													if (result.error) {
														alert(result.error.message);
													}
												})
												.catch(function(error) {
													console.error('Error:', error);
												});

												}
											});
											setTimeout(() => {
												if ($('#checkout-price').val() == 0) {
													checkoutButton2.click();
												}
												else {
													checkoutButton.click();
												}
											}, 1500);
									</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	@endsection

	@push('customJs')
	<script>
		$(document).ready(function() {

			$('#userList').DataTable();

		});
	</script>

	@endpush