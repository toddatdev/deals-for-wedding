@extends('admin.layouts.app')

@if(isset($userDetails) && !empty($userDetails->id))
@section('title', 'Edit Advertiser')
@else
@section('title', 'Add Advertiser')
@endif

@push('customCSS')
<style>
#company_prfl .col-md-6:nth-child(7) {
flex: 0 0 100% !important;
max-width: 100% !important;
}
</style>
@endpush

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Advertiser Section</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                @if(isset($userDetails) && !empty($userDetails->id))
                                Update Advertiser Details
                                @else
                                Add New Advertiser
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            @if(isset($userDetails) && !empty($userDetails->id))
                            <form action="{{route('admin.update-advertiser', $userDetails->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @else
                                <form action="{{route('admin.save-advertiser')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @endif
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="fname" class="form-label"><strong>First Name</strong></label>
                                                <input type="text" class="form-control @error('fname') is-invalid @enderror" id="fname" name="fname" placeholder="First Name" value="{{(isset($userDetails) && !empty($userDetails->fname)) ? $userDetails->fname : ''}}" required="">
                                                @error('fname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lname" class="form-label"><strong>Last Name</strong></label>
                                                <input type="text" class="form-control @error('lname') is-invalid @enderror" id="lname" name="lname" placeholder="Last Name" value="{{(isset($userDetails) && !empty($userDetails->lname)) ? $userDetails->lname : ''}}" required="">
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
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email Address" value="{{(isset($userDetails) && !empty($userDetails->email)) ? $userDetails->email : ''}}" required="">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="password" class="form-label"><strong>Password</strong></label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password..">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label"><strong>Phone </strong></label>
                                                <input type="text" class="phone form-control @error('phone') is-invalid @enderror"
                                                       id="update_vendor_phone_number" name="phone" placeholder="Phone"
                                                       value="{{(isset($userDetails) && !empty($userDetails->userDetails->phone)) ? $userDetails->userDetails->phone : ''}}"
                                                       required=""
                                                       onkeypress="addSpace()"

                                                >
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="image" class="form-label"><strong>Profile Image</strong> <small>Required square
                                                    size & minimum 300px width. Allowed image type (jpeg, jpg, png, gif)</small></label>
                                                <input type="file" class="form-control" id="image" name="image" accept=".jpeg,.jpg,.png,.gif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            {{-- <div class="col-md-6">
                                                <label for="dob" class="form-label"><strong>Date of birth </strong></label>
                                                <input type="date" class="form-control" id="dob" name="dob" placeholder="mm-dd-yyyy" required="" value="{{(isset($userDetails) && !empty($userDetails->userDetails->dob)) ? $userDetails->userDetails->dob : ''}}">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <label><strong>Gender</strong></label><br />
                                                    <label class="form-radio-label">
                                                        <input class="form-radio-input" type="radio" name="gender" value="male" checked="" {{(isset($userDetails) && ($userDetails->userDetails->gender == 'male')) ? 'checked' : ''}}>
                                                        <span class="form-radio-sign">Male</span>
                                                    </label>
                                                    <label class="form-radio-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="gender" value="female" {{(isset($userDetails) && ($userDetails->userDetails->gender == 'female')) ? 'checked' : ''}}>
                                                        <span class="form-radio-sign">Female</span>
                                                    </label>
                                                </div>
                                            </div> --}}

                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <label><strong>Address</strong></label><br />
                                                    <textarea name="address" id="address" placeholder="address.." class="form-control" required="">{{(isset($userDetails) && !empty($userDetails->userDetails->address)) ? $userDetails->userDetails->address : ''}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="role" class="form-label"><strong>Role</strong></label>
                                                <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required="">
                                                    <option value="">Select any</option>
                                                    <option value="2">User</option>
                                                    <option value="3" selected>Advertiser</option>
                                                </select>
                                                @error('role')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-action">
                                        @if(isset($userDetails) && !empty($userDetails->id))
                                        <input type="submit" value="Update User" class="btn btn-success">
                                        @else
                                        <input type="submit" value="Add User" class="btn btn-success">
                                        @endif
                                    </div>

                                </form>
                        </div>
                    </div>
                </div>


                @if(isset($userDetails) && !empty($userDetails->id))
                    <div class="col-md-12">
                    @include('flash-message')
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                Company Profile
                                </div>
                            </div>
                        <div class="card-body">
                            <form action="{{route('admin.vendor.company_profile.update', $vendor->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                <div id="company_prfl" class="row">
                                @foreach($fields as $key => $field)
                                <?php
                                $profile_value = App\Models\VendorCompanyProfile::select('field_value')
                                                    ->where('user_id', $vendor->id)
                                                    ->where('field_key', $field->input_name)
                                                    ->first();
                                ?>

                                        <div style="padding: 15px 10px;" class="col-md-12">
                                            <label for="{{isset($field->input_name) ? $field->input_name : ''}}" class="form-label"><strong>{{isset($field->input_label) ? $field->input_label : ''}}@if($field->data_type == 1)<sup style="color:red;">*</sup> @endif</strong>@if($field->input_type == 'file')<small>Required square
                                                size & minimum 300px width. Allowed image type (jpeg, jpg, png, gif)</small>@endif</label>
                                            @if($field->input_type == 'textarea')
                                            <textarea class="form-control" id="{{isset($field->input_name) ? $field->input_name : ''}}" name="{{isset($field->input_name) ? $field->input_name : ''}}" placeholder="{{isset($field->input_label) ? $field->input_label : ''}}" @if($field->data_type == 1) required @endif>{{isset($profile_value->field_value) ? $profile_value->field_value : ''}}</textarea>
                                            @else
                                                @if(isset($profile_value->field_value) && ($field->input_type == 'file'))
                                                <div class="old_img">
                                                     <img src="{{asset($profile_value->field_value)}}" style="width:100px">
                                                     <i class="fa fa-times text-success" aria-hidden="true" onclick="removeFile(this);"></i>
                                                </div>
                                                @endif
                                            <input type="{{isset($field->input_type) ? $field->input_type : ''}}" class="form-control {{isset($field->input_name) ? $field->input_name : ''}}" id="{{isset($field->input_name) ? $field->input_name : ''}}" name="{{isset($field->input_name) ? $field->input_name : ''}}" placeholder="{{isset($field->input_label) ? $field->input_label : ''}}" value="{{isset($profile_value->field_value) ? $profile_value->field_value : ''}}" @if($field->data_type == 1 && $field->input_type !== 'file') required @endif @if ($field->input_type == 'file' && !isset($profile_value->field_value)) required @endif @if($field->input_type == 'file') accept=".jpeg,.jpg,.pnp,.gif"@endif>
                                            @endif
                                        </div>
                                        @endforeach
                                   </div>
                        </div>

                                <div class="card-action">
                                    <input type="submit" value="Save" class="btn btn-success">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            @if(isset($userDetails) && !empty($userDetails->id))

                @php
                    $currentAdviserDealList =  App\Models\Deals::where('user_id', $userDetails->id)->get();
                    $cities = App\Models\State::get();
                @endphp

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            @include('flash-message')
                            <div class="card-header d-block d-lg-flex justify-content-between">
                                <div class="card-title">
                                    {{(isset($userDetails) && !empty($userDetails->fname)) ? $userDetails->fname : ''}}
                                    {{(isset($userDetails) && !empty($userDetails->lname)) ? $userDetails->lname : ''}} Deals
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table style="width: 100%;" class="table table-bordered" id="userList">
                                        <thead>
                                        <tr>
                                            <th><strong>Date Created</strong></th>
                                            <th><strong>Title</strong></th>
                                            <th><strong>Image</strong></th>
                                            <th><strong>Price</strong></th>
                                            <th><strong>Offer Price</strong></th>
                                            <th><strong>User</strong></th>
                                            <th><strong>Company</strong></th>
                                            <th><strong>Category</strong></th>
                                            <th><strong>City</strong></th>
                                            <th><strong>Additional Cities</strong></th>
                                            <th><strong>Is featured?</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th><strong>Actions</strong></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @include('admin.advertiser.partials.deals')
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endif

        </div>
    </div>


    @endsection

    @push('customJs')
    <script>
        $(document).ready(function() {
            $("#dob").datepicker({
                dateFormat: 'yy-mm-dd'
            });
            // $( "#dob" ).datepicker("show");
        });
    </script>
    <script type="text/javascript">
        function removeFile(element){
            $(element).parent('div.old_img').remove();
        }
        </script>
	<script>
        $(document).ready(function() {

            $('#company_bio').summernote();

        });
	</script>

<script>
	/*******************************************************
	  * create a filter that will be used to determine
	  * which keystrokes are allowed in the input field
	  * and which are not. Since we're working exclusively
	  * with phone numbers, we'll need the following:
	  * -- digits 0 to 9 from the numeric keys
	  * -- digits 0 to 9 from the num pad keys
	  * -- arrow keys (left/right)
	  * -- backspace / delete for correcting
	  * -- tab key to allow focus to shift
	*******************************************************/
	var filter = [];
	
	//since we're looking for phone numbers, we need
	//to allow digits 0 - 9 (they can come from either
	//the numeric keys or the numpad)
	const keypadZero = 48;
	const numpadZero = 96;
	
	//add key codes for digits 0 - 9 into this filter
	for(var i = 0; i <= 9; i++){
	  filter.push(i + keypadZero);
	  filter.push(i + numpadZero);  
	}
	
	//add other keys that might be needed for navigation
	//or for editing the keyboard input
	filter.push(8);     //backspace
	filter.push(9);     //tab
	filter.push(46);    //delete
	filter.push(37);    //left arrow
	filter.push(39);    //right arrow
	
	/*******************************************************
	  * replaceAll
	  * returns a string where all occurrences of a
	  * string 'search' are replaced with another 
	  * string 'replace' in a string 'src'
	*******************************************************/
	function replaceAll(src,search,replace){
	  return src.split(search).join(replace);
	}
	
	/*******************************************************
	  * formatPhoneText
	  * returns a string that is in XXX-XXX-XXXX format
	*******************************************************/
	// function formatPhoneText(value){
	//   value = this.replaceAll(value.trim(),"-","");
	//
	//   if(value.length > 3 && value.length <= 6)
	// 	value = value.slice(0,3) + "-" + value.slice(3);
	//   else if(value.length > 6)
	// 	value = value.slice(0,3) + "-" + value.slice(3,6) + "-" + value.slice(6);
	//
	//   return value;
	// }


        function addSpace(){
        var inputValue = document.getElementById("update_vendor_phone_number").value;
        var inputValueLength = inputValue.length;

        if(inputValueLength == 0){
        document.getElementById("update_vendor_phone_number").value = inputValue+"(";
    }
        if(inputValueLength == 4){
        document.getElementById("update_vendor_phone_number").value = inputValue+") ";
    }

        if(inputValueLength == 9){
        document.getElementById("update_vendor_phone_number").value = inputValue+"-";
    }
    }



	/*******************************************************
	  * validatePhone
	  * return true if the string 'p' is a valid phone
	*******************************************************/
	function validatePhone(p){
	  var phoneRe = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;
	  var digits = p.replace(/\D/g, "");
	  return phoneRe.test(digits);
	}
	
	/*******************************************************
	  * onKeyDown(e)
	  * when a key is pressed down, check if it is allowed
	  * or not. If not allowed, prevent the key event
	  * from propagating further
	*******************************************************/
	function onKeyDown(e){  
	  if(filter.indexOf(e.keyCode) < 0){
		e.preventDefault();
		return false;
	  }  
	}
	
	/*******************************************************
	  * onKeyUp(e)
	  * when a key is pressed up, grab the contents in that
	  * input field, format them in line with XXX-XXX-XXXX
	  * format and validate if the text is infact a complete
	  * phone number. Adjust the border color based on the
	  * result of that validation
	*******************************************************/
	function onKeyUp(e){
	  var input = e.target;
	  var formatted = formatPhoneText(input.value);
	  var isError = (validatePhone(formatted) || formatted.length == 0);
	  var color =  (isError) ? "gray" : "red";
	  var borderWidth =  (isError)? "1px" : "3px";
	  input.style.borderColor = color;
	  input.style.borderWidth = borderWidth;
	  input.value = formatted;
	}
	
	/*******************************************************
	  * setupPhoneFields
	  * Now let's rig up all the fields with the specified
	  * 'className' to work like phone number input fields
	*******************************************************/
	function setupPhoneFields(className){
	  var lstPhoneFields = document.getElementsByClassName(className);
	  
	  for(var i=0; i < lstPhoneFields.length; i++){
		var input = lstPhoneFields[i];
		if(input.type.toLowerCase() == "text" || input.type.toLowerCase() == "tel"){
		  input.placeholder = "Phone (XXX-XXX-XXXX)";
		  input.addEventListener("keydown", onKeyDown);
		  input.addEventListener("keyup", onKeyUp);
		}
	  }
	}
	
	//MAIN
	setupPhoneFields("phone");
	setupPhoneFields("contacts_phone_number");
	
	</script>


    @endpush