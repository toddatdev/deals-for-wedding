@extends('theme.primary')

@section('title', 'Dream-Team : Deals for Weddings')

@push('customCSS')

@endpush

@section('content')

	<div class="col-md-9 pink-bg py-4 px-3" id="middle-section">
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div class="middle-content-area">
					<div class="row">
						<div class="col-md-9">
							<div class="row dream-team-top">
								<div class="col-md-12 col-sm-12 col-xl-10 offset-xl-1 col-lg-10 offset-lg-1">
									<h1>dream team. <strong>dream price.</strong></h1>
									<p>Select from the options below to find verified and trusted wedding vendors in your area to complete your perfect wedding team.</p> 									
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
										<option value="{{isset($state->code) ? $state->code : ''}}" {{isset($_REQUEST['state']) ? (($_REQUEST['state'] == $state->code) ? 'selected="selected"' : '') : ''}}>{{isset($state->code) ? $state->code : ''}}</option>
										@endforeach
									</select>
								</div>	
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Show Me The Deals!</button>
								</div>
							</form>	
								</div>
							</div>		
						</div>
						<div class="col-md-3">
							<div class="accountBox">
								<h6>{{(Auth::check()) ? 'oh hey, '.Auth::user()->fname : 'have an account?'}}<br><small><a href="{{(Auth::check()) ? route('home.dashboard') : route('login')}}">{{(Auth::check()) ? 'your account' : 'log in here'}}</a></small></h6>
										<img src="{{ asset('front/images/account.png') }}" class="mx-auto d-block img-fluid" alt="Account" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>

@endsection

@push('customJs')

@endpush