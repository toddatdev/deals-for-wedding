<?php
$categories = App\Models\Category::where('status', 1)->get();
$states = App\Models\State::where('status', 1)->get();
$settings = App\Models\Settings::where('id', 1)->first();
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 purple-bg py-4 px-3" id="sidebar">
			<div class="side-body-section">
				<form action="{{route('home.allDeals')}}" method="GET">
					<div class="form-group">
						<select class="form-control" id="category" name="category" required="">
							<option value="">Select Category</option>
							@foreach($categories->sortBy('name') as $category)
							<option value="{{isset($category->slug) ? $category->slug : ''}}" {{isset($_REQUEST['category']) ? (($_REQUEST['category'] == $category->slug) ? 'selected="selected"' : '') : ''}}>{{isset($category->name) ? $category->name : ''}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<select class="form-control" id="state" name="state" required="">
							<option value="">Select City</option>
							@foreach($states as $state)
							<option value="{{isset($state->code) ? $state->code : ''}}" {{isset($_REQUEST['state']) ? (($_REQUEST['state'] == $state->code) ? 'selected="selected"' : '') : ''}}>{{isset($state->code) ? $state->name : ''}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Search</button>
					</div>
				</form>
			</div>
			<div class="side-footer-section">
				<div class="row">
					<div class="col-md-12">
						<ul>
							<li><a href="{{$settings->facebook}}" target="_blank"><img src="{{ asset('front/images/fb-purple.png') }}" class="d-block img-fluid" alt="Facebook" /></a></li>
							<li><a href="{{$settings->twitter}}" target="_blank"><img src="{{ asset('front/images/tw-purple.png') }}" class="d-block img-fluid" alt="Twitter" /></a></li>
							<li><a href="{{$settings->instagram}}" target="_blank"><img src="{{ asset('front/images/instagram-purple.png') }}" class="d-block img-fluid" alt="Instgram" /></a></li>
						</ul>
						<p class="my-3"><a href="{{route('front.about_us')}}">About us</a><br><a href="{{route('front.faqs')}}">Faq</a><br><a href="{{route('front.contact')}}">Contact</a><br><a href="{{url('blog')}}">Blog</a></p>
						<p><a href="{{route('vendor.login')}}">Advertiser Login</a><br><a href="{{route('front.privacy_policy')}}">Privacy Policy</a><br /><a href="{{route('front.term_conditions')}}">Terms & Conditions</a></p>
					</div>
				</div>
			</div>
		</div>