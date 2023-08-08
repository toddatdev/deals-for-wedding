@extends('theme.primary')

@section('title', 'Oh-Hey-There : Deals for Weddings')

@push('customCSS')

@endpush

@section('content')

	<div class="col-md-9 pink-bg py-4 px-3" id="middle-section">
					<div class="row">
						<div class="col-md-10 offset-md-1 col-sm-10 offset-sm-1 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
							<div class="middle-content-area">
								<div class="row">
									<div class="col-md-12">
										@include('flash-message')
										<h1>oh, <strong>hey there!</strong></h1>
										<p>Welcome Please log in to view your saved deals and find more.</p>
										<form method="POST" action="{{ route('login') }}">
											@csrf
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="email">E-mail*</label>
														<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus id="email" placeholder="youremail@website.com" required>
														@error('email')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                @enderror
													</div>	
													<div class="form-group">
														<label for="password">Password*</label>
														<input type="password" id="password" placeholder="********" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
														@error('password')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                @enderror
													</div>

													<a class="btn btn-link" href="{{ route('password.request') }}">
														{{ __('Forgot Your Password?') }}
													</a>

												</div>
											</div>	
											<div class="row">
												<div class="col-md-12">
													<button type="submit" class="btn btn-primary">Show Me The Deals!</button>
												</div>
											</div>	
										</form>	
									</div>
								</div>
							</div>
						</div>
					</div>	
				</div>

@endsection

@push('customJs')

@endpush