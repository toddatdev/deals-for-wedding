@extends('theme.primary')

@section('title', 'Home : Deals for Weddings')

@push('customCSS')

@endpush

@section('content')
<script src="https://www.google.com/recaptcha/api.js" async defer>
</script>



	<div class="col-md-9 pink-bg py-4 px-3" id="middle-section">
		<div class="row">
			<div class="col-md-10 offset-md-1">

				<div class="middle-content-area">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xl-10 col-lg-9 ">
							<div class="row middle-height">
								<div class="col-md-12 my-auto">
									<h1>your budget's <strong>new bff</strong></h1>
									<p>Save hundreds of dollars on your wedding by getting the best wedding deals from the finest wedding pros in your area. And the best part? <strong>It's absolutely free.</strong></p>
									<p>Your email address is your log-in to your account and where you can SAVE all your wedding deal(s).</p> 
									<div class="row">
										<div class="col-md-12">
											@include('flash-message')
											<form method="POST" action="{{ route('register') }}" id="register-form">
												@csrf
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="fname">First name*</label>
															<input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" id="fname" placeholder="Your first name"  autocomplete="fname" autofocus required>
															@error('fname')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
														</div>	
													</div>
												
													<div class="col-md-6">
														<div class="form-group">
															<label for="email">E-mail*</label>
															<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" id="email" placeholder="youremail@website.com" required>
															@error('email')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
														</div>	
													</div>
												
													<div class="col-md-6">
														<div class="form-group">
															<label for="wedding_date">Wedding date</label>
															<input type="date" class="form-control @error('wedding_date') is-invalid @enderror" name="wedding_date" id="wedding_date" placeholder="mm-dd-yyyy"  autocomplete="wedding_date" autofocus required>
															@error('wedding_date')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
														</div>	
													</div>
												
													<div class="col-md-6">
														<div class="form-group">
															<label for="password">Password*</label>
															<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholde="********">
															@error('password')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
														</div>
													</div>	
												</div>
												<div class="row">
													{{--<div class="col-md-6">
														 <div class="form-group">
															<label for="lname">Last name*</label>
															<input type="text" class="form-control @error('lname') is-invalid @enderror" id="lname" name="lname" placeholder="Your Last name"  autocomplete="lname" autofocus>
															@error('lname')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
														</div>
													</div>	 --}}
													{{-- <div class="col-md-6">
														<div class="form-group">
															<label for="phone">Phone number*</label>
															<input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="000-000-0000"  autocomplete="phone" min="10" autofocus required>
															@error('phone')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
														</div>
													</div> --}}
													<div class="col-md-6">
														<div class="form-group">
															<label for="password-confirm">Re-enter Password*</label>
															<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholde="********" required autocomplete="new-password">
														</div>	
													</div>	

													<div class="col-md-6">
														<div class="form-group">

													        <!-- <div id="html_element"></div> -->
													        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.sitekey') }}"></div>

													        @if ($errors->has('g-recaptcha-response'))
													            <span class="invalid-feedback" style="display: block;">
													                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
													            </span>
													        @endif
														</div>	
													</div>	

												</div>



												
												<!-- <script type="text/javascript">
      var onloadCallback = function() {
      	console.log('sach');
        grecaptcha.render('html_element', {
          'sitekey' : '{{ config('services.recaptcha.sitekey') }}'
        });
      };
    </script> -->



												{{-- <div class="row">
													<div class="col-md-8">
														<div class="form-group">
															<label for="city">City*</label>
															<input type="city" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="City"  autocomplete="city" autofocus required>
															@error('city')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
														</div>	
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label for="state">State*</label>
															<select class="form-control @error('city') is-invalid @enderror" id="state" name="state" autocomplete="city" autofocus required>
																<option value="FI">Fl</option>
																<option value="EN">EN</option>
																<option value="FR">FR</option>
															</select>
															@error('state')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
														</div>	
													</div>
													<div class="col-md-2">
														<div class="form-group">
															<label for="zip">Zip*</label>
															<input type="zip" class="form-control @error('zip') is-invalid @enderror" id="zip" name="zip" placeholder="00000"  autocomplete="zip" autofocus required>
															@error('zip')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
														</div>	
													</div>
												</div> --}}	

								

												<div class="row">
													<div class="col-md-12">
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck" name="confirm" required="">
															<label class="custom-control-label" for="customCheck">I have read the Privacy Policy and agree to the Terms of Service.</label>
														</div>
													</div>
												</div>	
												<div class="row">
													<div class="col-md-12">
														<button type="submit" class="btn btn-primary">Show Me The Deals!</button>
														<a href="{{route('login')}}" class="btn btn-info d-md-none">Go to Login</a>
													</div>
												</div>	
											</form>	
										</div>
									</div>	
								</div>	
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xl-2 col-lg-3">
							<div class="accountBox">
								<h6>{{(Auth::check()) ? 'oh hey, '.Auth::user()->fname : 'have an account?'}}<br><small>
										<a class="font-weight-bold" style="font-size: 18px" href="{{(Auth::check()) ? route('home.dashboard') : route('login')}}">{{(Auth::check()) ? 'Your Account' : 'log in here'}}</a></small></h6>
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