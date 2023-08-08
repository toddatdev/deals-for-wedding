@extends('vendor.layouts.app')
@section('title', 'Company Profile')
@push('customCSS')
@endpush

@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Vendor Management</h4>
			@include('flash-message')
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
							Company Profile
							</div>
						</div>
					<div class="card-body">
						<form action="{{route('vendor.company.update')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="fname" class="form-label"><strong>First Name</strong></label>
							        	<input type="text" class="form-control @error('fname') is-invalid @enderror" id="fname" name="fname" placeholder="First Name" value="{{isset($vendor->fname)  ? $vendor->fname : ''}}" required="">
							        	@error('fname')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							        <div class="col-md-6">
							        	<label for="lname" class="form-label"><strong>Last Name</strong></label>
							        	<input type="text" class="form-control @error('lname') is-invalid @enderror" id="lname" name="lname" placeholder="Last Name" value="{{isset($vendor->lname)  ? $vendor->lname : ''}}" required="">
							        </div>
							        @error('lname')
							            <span class="invalid-feedback" role="alert">
							                <strong>{{ $message }}</strong>
							            </span>
							        @enderror
							   </div>
							</div>

							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="email" class="form-label"><strong>Email Address</strong></label>
							        	<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email Address" value="{{isset($vendor->email)  ? $vendor->email : ''}}" required="">
							        	@error('email')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							        <div class="col-md-6">
							        	<label for="phone" class="form-label"><strong>Phone </strong></label>
							        	<input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Phone" value="{{(isset($vendor->userDetails) && !empty($vendor->userDetails->phone)) ? $vendor->userDetails->phone : ''}}" required="">
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
							        	<label for="dob" class="form-label"><strong>Date of birth </strong></label>
							        	<input type="text" class="form-control" id="dob" name="dob" placeholder="dd-mm-yy" required="" value="{{(isset($vendor->userDetails) && !empty($vendor->userDetails->dob)) ? $vendor->userDetails->dob : ''}}">
							        </div>
							        <div class="col-md-6">
							        	<div class="form-check">
							        		<label><strong>Gender</strong></label><br/>
							        		<label class="form-radio-label">
							        			<input class="form-radio-input" type="radio" name="gender" value="male" checked="" {{(isset($vendor->userDetails) && ($vendor->userDetails->gender == 'male')) ? 'checked' : ''}}>
							        			<span class="form-radio-sign">Male</span>
							        		</label>
							        		<label class="form-radio-label ml-3">
							        			<input class="form-radio-input" type="radio" name="gender" value="female"{{(isset($vendor->userDetails) && ($vendor->userDetails->gender == 'female')) ? 'checked' : ''}}>
							        			<span class="form-radio-sign">Female</span>
							        		</label>
							        	</div>
							        </div>

							        <div class="col-md-6">
							        	<label for="company" class="form-label"><strong>Company</strong></label>
							        	<input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company" placeholder="company Name" value="{{isset($vendor->userDetails->company)  ? $vendor->userDetails->company : ''}}" required="">
							        </div>
							        @error('company')
							            <span class="invalid-feedback" role="alert">
							                <strong>{{ $message }}</strong>
							            </span>
							        @enderror

							        <div class="col-md-6">
							        	<div class="form-check">
							        		<label><strong>Address</strong></label><br/>
							        		<textarea name="address" id="address" placeholder="address.." class="form-control" required="">{{(isset($vendor->userDetails) && !empty($vendor->userDetails->address)) ? $vendor->userDetails->address : ''}}</textarea>
							        	</div>
							        </div>
							   </div>
							</div>

							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="image" class="form-label"><strong>Image </strong></label>
							        	 @if(isset($vendor->userDetails->image))
			                              <div class="old_img">
			                                 <img src="{{asset('public/'.$vendor->userDetails->image)}}" style="width:100px">
			                                 <i class="la la-times text-success" aria-hidden="true" onclick="removeFile(this);"></i>
			                               </div>
			                              @endif
			                              <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
							        	@error('image')
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


@endsection

@push('customJs')
<script type="text/javascript">
@if(isset($vendor->userDetails->image))
function removeFile(element){
    $(element).parent('div.old_img').remove();
}
@endif
</script>
@endpush