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
							<img width="256px" src="{{asset('/images/loading-circle.gif')}}" alt="">
							<script src="https://js.stripe.com/v3/"></script>
										<form style="display: none" action="{{route('plan.payment.all')}}" method="POST">
											@csrf
											<input type="hidden" name="user_id" value="{{$user->id}}">
											<input type="hidden" name="details" value="Plan {{ $data->plan_id}}">
											<input type="hidden" name="details2" value="{{ $data->details}}">
											<input type="hidden" name="plan_id" value="{{ $data->plan_id}}">
											<input type="hidden" name="plan_price" value="{{ $data->plan_price}}">
											<input type="hidden" name="plan_expiry" value="{{ $data->plan_expiry}}">
											<input type="hidden" name="price" value="{{ isset($data->price) ? $data->price : ''}}">
											<input type="hidden" name="cart_id" value="{{ isset($cart) ? $cart : ''}}">
											<input type="hidden" name="data" value="{{ isset($data) ? $data : ''}}">
											<button id="checkout-button" class="btn btn-success action-cons">Checkout</button>
										</form>
			
										<script type="text/javascript">

											// Create an instance of the Stripe object with your publishable API key

											var stripe = Stripe('pk_test_8l3Hjcr9iumvbGKsMZcYtJCH'); // Add your own

											var checkoutButton = document.getElementById('checkout-button');
			
											checkoutButton.addEventListener('click', function() {
												// Create a new Checkout Session using the server-side endpoint you
												// created in step 3.
												fetch('/plan_payment_all', {
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
											});
											setTimeout(() => {
												checkoutButton.click();
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