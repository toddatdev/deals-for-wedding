<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Vendor-Register</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js" type="text/javascript"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer>
	</script>
	<style type="text/css" media="screen">
		:root {
		  --input-padding-x: 1.5rem;
		  --input-padding-y: .75rem;
		}

		body {
		  background: #636680;
		  /*background: linear-gradient(to right, #0062E6, #33AEFF);*/
		}

		.card-signin {
		  border: 0;
		  border-radius: 1rem;
		  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
		}

		.card-signin .card-title {
		  margin-bottom: 2rem;
		  font-weight: 300;
		  font-size: 1.5rem;
		}

		.card-signin .card-body {
		  padding: 2rem;
		}

		.form-signin {
		  width: 100%;
		}

		.form-signin .btn {
		  font-size: 80%;
		  border-radius: 5rem;
		  letter-spacing: .1rem;
		  font-weight: bold;
		  padding: 1rem;
		  transition: all 0.2s;
		}

		.form-label-group {
		  position: relative;
		  margin-bottom: 1rem;
		}

		.form-label-group input {
		  height: auto;
		  border-radius: 2rem;
		}

		.form-label-group>input,
		.form-label-group>label {
		  padding: var(--input-padding-y) var(--input-padding-x);
		}

		.form-label-group>label {
		  position: absolute;
		  top: 0;
		  left: 0;
		  display: block;
		  width: 100%;
		  margin-bottom: 0;
		  /* Override default `<label>` margin */
		  line-height: 1.5;
		  color: #000000;
		  border: 1px solid transparent;
		  border-radius: .25rem;
		  transition: all .1s ease-in-out;
		}

		

		.btn-google {
		  color: white;
		  background-color: #ea4335;
		}

		.btn-facebook {
		  color: white;
		  background-color: #3b5998;
		}

		/* Fallback for Edge
		-------------------------------------------------- */

		@supports (-ms-ime-align: auto) {
		  .form-label-group>label {
			display: none;
		  }
		  .form-label-group input::-ms-input-placeholder {
			color: #777;
		  }
		}

		/* Fallback for IE
		-------------------------------------------------- */

		@media all and (-ms-high-contrast: none),
		(-ms-high-contrast: active) {
		  .form-label-group>label {
			display: none;
		  }
		  .form-label-group input:-ms-input-placeholder {
			color: #777;
		  }
		}
	</style>
</head>
<body>
  	<div class="container">
  		<div class="text-center p-2 mt-5">
  			<img src="{{asset('front/images/logo.png')}}" width="300" class="img-fluid">
  		</div>
		<div class="row">
		  	<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
				<div class="card card-signin my-5">
				  	@include('flash-message')
				  	<div class="card-body">
						<h5 class="card-title text-center">Vendor Sign Up</h5>
						<form method="POST" action="{{ route('vendor.register_post') }}">
                        @csrf
						  	<div class="form-label-group">
								<input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus placeholder=" First Name">
								@error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						  	</div>

						  	<div class="form-label-group">
								<input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus placeholder="Last Name">
								@error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						  	</div>

						  	<div class="form-label-group">
								<input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company') }}" required autocomplete="company" autofocus placeholder="Company Name">
								@error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						  	</div>

						  	<div class="form-label-group">
								<input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone"
									   value="{{ old('company') }}" minlength="10" maxlength="14" required autocomplete="company"
									   autofocus placeholder="Phone Number" onkeypress="addSpace()">
								@error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						  	</div>


					  		<div class="form-label-group">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email address">
								@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					  		</div>

					  		<div class="form-label-group">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
								@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					  		</div>

					  		<div class="form-label-group">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
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

					  		<button class="btn btn-lg btn-success btn-block text-uppercase" type="submit">Sign Up</button>
					  		<br>
					  		<span>Already have an account ? </span><a href="{{ route('vendor.login') }}" title="register">Login</a>
						</form>
				  	</div>
				</div>
			</div>
		</div>
  	</div>
	  <script>
		function addSpace(){
 			var inputValue = document.getElementById("phone").value;
 			var inputValueLength = inputValue.length;

			if(inputValueLength == 0){
				document.getElementById("phone").value = inputValue+"(";
			}
			if(inputValueLength == 4){
				document.getElementById("phone").value = inputValue+") ";
			}

 			if(inputValueLength == 9){
 			document.getElementById("phone").value = inputValue+"-";
 			}
		}
	  </script>
</body>
</html>