@extends('admin.layouts.app')
@section('title', 'My Profile')
@push('customCSS')
@endpush

@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Settings</h4>
			@include('flash-message')
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
							Social media Links
							</div>
						</div>
					<div class="card-body">
						<form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="facebook" class="form-label"><strong>Facebook</strong></label>
							        	<input type="text" class="form-control @error('facebook') is-invalid @enderror" id="facebook" name="facebook" placeholder="Facebook URL" value="{{isset($settings->facebook)  ? $settings->facebook : ''}}">
							        	@error('facebook')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							        <div class="col-md-6">
							        	<label for="twitter" class="form-label"><strong>Twitter</strong></label>
							        	<input type="text" class="form-control @error('twitter') is-invalid @enderror" id="twitter" name="twitter" placeholder="Twitter URL" value="{{isset($settings->twitter)  ? $settings->twitter : ''}}" >
							        </div>
							        @error('twitter')
							            <span class="invalid-feedback" role="alert">
							                <strong>{{ $message }}</strong>
							            </span>
							        @enderror
							   </div>
							</div>

							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="instagram" class="form-label"><strong>Instagram</strong></label>
							        	<input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" placeholder="Instagram URL" value="{{isset($settings->instagram)  ? $settings->instagram : ''}}" >
							        	@error('instagram')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							   </div>
							</div>

							<div class="card-action">
								<input type="submit" value="Update" class="btn btn-success">
							</div>
							

						</form>
					</div>
				</div>
			</div>
		</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
							Reset Admin Password
							</div>
						</div>
					<div class="card-body">
						<form id="password-reset" action="{{route('admin.settings.password')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="password" class="form-label"><strong>New Password</strong></label>
							        	<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="New Password" value="" required>
							        	@error('password')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							   </div>
							</div>

							<div class="form-group">
							   <div class="row">
                                <div class="col-md-6">
                                    <label for="confirm_password" class="form-label"><strong>New Password</strong></label>
                                    <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="" required>
                                    @error('confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
							   </div>
							</div>

							<div class="card-action">
								<input type="submit" value="Update" class="btn btn-success">
							</div>
							

						</form>
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