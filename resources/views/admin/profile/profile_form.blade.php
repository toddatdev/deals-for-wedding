@extends('admin.layouts.app')
@section('title', 'My Profile')
@push('customCSS')
@endpush

@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Admin Management</h4>
			@include('flash-message')
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
							My Profile
							</div>
						</div>
					<div class="card-body">
						<form action="{{route('admin.profile.update')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="fname" class="form-label"><strong>First Name</strong></label>
							        	<input type="text" class="form-control @error('fname') is-invalid @enderror" id="fname" name="fname" placeholder="First Name" value="{{isset($admin->fname)  ? $admin->fname : ''}}" required="">
							        	@error('fname')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							        <div class="col-md-6">
							        	<label for="lname" class="form-label"><strong>Last Name</strong></label>
							        	<input type="text" class="form-control @error('lname') is-invalid @enderror" id="lname" name="lname" placeholder="Last Name" value="{{isset($admin->lname)  ? $admin->lname : ''}}" required="">
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
							        	<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email Address" value="{{isset($admin->email)  ? $admin->email : ''}}" required="">
							        	@error('email')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							        <div class="col-md-6">
							        	<label for="phone" class="form-label"><strong>Phone </strong></label>
							        	<input type="text" class="form-control @error('phone') is-invalid @enderror" id="admin_phone_number"
											   name="phone" placeholder="Phone"

											   value="{{(isset($admin->userDetails) && !empty($admin->userDetails->phone)) ? $admin->userDetails->phone : ''}}" required=""

											   onkeypress="addSpace()"
										>
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
							        	<input type="text" class="form-control" id="dob" name="dob" placeholder="dd-mm-yy" required="" value="{{(isset($admin->userDetails) && !empty($admin->userDetails->dob)) ? $admin->userDetails->dob : ''}}">
							        </div>
							        <div class="col-md-6">
							        	<div class="form-check">
							        		<label><strong>Gender</strong></label><br/>
							        		<label class="form-radio-label">
							        			<input class="form-radio-input" type="radio" name="gender" value="male" checked="" {{(isset($admin->userDetails) && ($admin->userDetails->gender == 'male')) ? 'checked' : ''}}>
							        			<span class="form-radio-sign">Male</span>
							        		</label>
							        		<label class="form-radio-label ml-3">
							        			<input class="form-radio-input" type="radio" name="gender" value="female"{{(isset($admin->userDetails) && ($admin->userDetails->gender == 'female')) ? 'checked' : ''}}>
							        			<span class="form-radio-sign">Female</span>
							        		</label>
							        	</div>
							        </div>

							        <div class="col-md-12">
							        	<div class="form-check">
							        		<label><strong>Address</strong></label><br/>
							        		<textarea name="address" id="address" placeholder="address.." class="form-control" required="">{{(isset($admin->userDetails) && !empty($admin->userDetails->address)) ? $admin->userDetails->address : ''}}</textarea>
							        	</div>
							        </div>
							   </div>
							</div>

							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="image" class="form-label"><strong>Image </strong></label>
							        	 @if(isset($admin->userDetails->image))
			                              <div class="old_img">
			                                 <img src="{{asset($admin->userDetails->image)}}" style="width:100px">
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
@if(isset($admin->userDetails->image))
function removeFile(element){
    $(element).parent('div.old_img').remove();
}
@endif

</script>
		<script>
			function addSpace(){
				var inputValue = document.getElementById("admin_phone_number").value;
				var inputValueLength = inputValue.length;

				if(inputValueLength == 0){
					document.getElementById("admin_phone_number").value = inputValue+"(";
				}
				if(inputValueLength == 4){
					document.getElementById("admin_phone_number").value = inputValue+") ";
				}

				if(inputValueLength == 9){
					document.getElementById("admin_phone_number").value = inputValue+"-";
				}
			}
		</script>
@endpush