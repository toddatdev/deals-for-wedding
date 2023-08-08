@extends('theme.secondary')

@section('title', (isset($data->title) ? $data->title : 'Contact Us'))
@push('customCSS')

@endpush
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@section('content')
<div class="col-md-9 pink-bg py-4 px-3" id="middle-section">
	<div class="row">
		<div class="col-md-10 offset-md-1">
			<div class="middle-content-area">
				@include('flash-message')
				<div class="row">
					<div class="col-md-9">
						<p style="font-size: 1.5em;" class="text-center m-0">General Email<br>
							<span class="text-center" style="color: rgba(0,0,0,0.4);">[support@dealsforweddings.com]</span>
						</p>
						<form id="frm-signup" class="mt-5" method="POST" action="{{route('home.contact_support')}}">
							@csrf
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" class="form-control" id="name" name="name" required="" value="{{old('name')}}">
							</div>
							<div class="form-group">
								<label for="email">E-mail</label>
								<input type="email" class="form-control" id="email" name="email" required="" value="{{old('email')}}">
							</div>
							<div class="form-group">
								<label for="phone">Phone</label>
								<input type="phone" class="form-control" id="phone" name="phone" required="" value="{{old('phone')}}">
							</div>
							<div class="form-group">
								<div class="form-check-inline">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="contact_type[]" value="engaged_user">I am an engaged user
									</label>
								</div>
								<div class="form-check-inline">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input" name="contact_type[]" value="advertiser">I am an advertiser
									</label>
								</div>

							</div>
							<div class="form-group">
								<label for="subject">Subject</label>
								<input type="text" class="form-control" id="subject" name="subject" required="" value="{{old('subject')}}">
							</div>
							<div class="form-group">
								<label for="message">Message</label>
								<textarea class="form-control" id="message" name="message" rows="5">{{old('message')}}</textarea>
							</div>
							<div class="form-group">
								<div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.sitekey') }}"></div>

									@if ($errors->has('g-recaptcha-response'))
										<span class="invalid-feedback" style="display: block;">
											<strong>Please complete reCAPTCHA!</strong>
										</span>
									@endif
							</div>

							<button type="submit" class="btn btn-info">Send</button>
						</form>
					</div>
					{{-- <div class="col-md-3">
									<div class="accountBox">
										<h6>{{(Auth::check()) ? 'oh hey, '.Auth::user()->fname : 'have an account?'}}<br><small><a href="{{(Auth::check()) ? route('home.dashboard') : route('login')}}">{{(Auth::check()) ? 'your account' : 'log in here'}}</a></small></h6>
					<img src="{{ asset('public/front/images/account.png') }}" class="mx-auto d-block img-fluid" alt="Account" />
				</div>
			</div> --}}
		</div>
	</div>
</div>
</div>
</div>
@endsection

@push('customJs')

{{-- <script>
	function checkRecaptcha() {
    res = $('#g-recaptcha-response').val();

    if (res == "" || res == undefined || res.length == 0)
        return false;
    else
        return true;
}

//...
 
$('#frm-signup').submit(function(e) {

    if(!checkRecaptcha()) {
        $( "#frm-result" ).text("Please validate your reCAPTCHA.");
        return false;
    }
    //...
});
</script> --}}

@endpush