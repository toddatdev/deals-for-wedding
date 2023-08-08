@extends('admin.layouts.app')
@section('title', 'Admin : Contact Edit Advertiser Data')
@push('customCSS')
@endpush

@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Contact Advertiser Data</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
								Edit Contact Advertiser Data
							</div>
						</div>
						<div class="card-body">
							<form action="{{url('/admin/contact-vendor/update')}}" method="post"
								enctype="multipart/form-data">
								@csrf
								<input type="hidden" name="contact_vendor_id" value="{{ $results->id }}" required>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label for="name" class="form-label"><strong>Name</strong></label>
											<input type="text" class="form-control @error('name') is-invalid @enderror"
												id="name" name="name" placeholder="Name"
												value="{{isset($results->name) ? $results->name : ''}}" required="">
											@error('name')
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
											<label for="name" class="form-label"><strong>Email</strong></label>
											<input type="email"
												class="form-control @error('email') is-invalid @enderror" id="name"
												name="email" placeholder="Email"
												value="{{isset($results->email) ? $results->email : ''}}" required="">
											@error('email')
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
											<label for="name" class="form-label"><strong>Email</strong></label>
											<input type="text" class="form-control @error('phone') is-invalid @enderror"
												id="phone" name="phone" placeholder="Phone"
												value="{{isset($results->phone) ? $results->phone : ''}}" required="">
											@error('phone')
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
											<label for="name" class="form-label"><strong>Message</strong></label>
											<textarea class="form-control @error('message') is-invalid @enderror"
												id="message" name="message"
												placeholder="message">{{isset($results->message) ? $results->message : ''}}</textarea>
											@error('message')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
									</div>
								</div>


								<!--<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="name" class="form-label"><strong>Wedding Date</strong></label>
							        	<input type="date" class="form-control @error('wedding_date') is-invalid @enderror" id="wedding_date" name="wedding_date" placeholder="Wedding Date" value="{{isset($results->wedding_date) ? $results->wedding_date : ''}}" required="">
							        	@error('wedding_date')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							   </div>
							</div>-->



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


	@endsection

	@push('customJs')

	@endpush