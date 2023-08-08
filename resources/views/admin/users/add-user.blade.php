@extends('admin.layouts.app')

@if(isset($userDetails) && !empty($userDetails->id))
@section('title', 'Edit Users')
@else
@section('title', 'Add Users')
@endif

@push('customCSS')

@endpush

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Users Section</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                @if(isset($userDetails) && !empty($userDetails->id))
                                Update User Details
                                @else
                                Add New Users
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            @if(isset($userDetails) && !empty($userDetails->id))
                            <form action="{{route('admin.update-user', $userDetails->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @else
                                <form action="{{route('admin.add-user')}}" method="post" enctype="multipart/form-data">
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
                                                <input type="text" class="phone form-control @error('phone') is-invalid @enderror" id="user_phone_format"
                                                       name="phone" placeholder="Phone"
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
                                                <label for="image" class="form-label"><strong>Profile Image</strong><small> Required square
                                                    size & minimum 300px width. Allowed image type (jpeg, jpg, png, gif)</small></label>
                                                <input type="file" class="form-control" id="image" name="image" accept=".jpeg,.jpg,.png,.gif">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="wedding_date" class="form-label"><strong>Wedding Date</strong></label>
                                                <input type="text" class="form-control" id="wedding_date" name="wedding_date" placeholder="mm-dd-yyyy" required="" value="{{(isset($userDetails) && !empty($userDetails->userDetails->wedding_date)) ? Carbon\Carbon::parse($userDetails->userDetails->wedding_date)->format('m-d-Y') : ''}}">
                                            </div>

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
                                                    <option value="2" selected>User</option>
                                                    <option value="3">Advertiser</option>
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
            </div>
        </div>
    </div>


    @endsection

    @push('customJs')
    <script>
        $(document).ready(function() {
            $("#wedding_date").datepicker({
                dateFormat: 'mm-dd-yy'
            });
            // $( "#dob" ).datepicker("show");
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
        var inputValue = document.getElementById("user_phone_format").value;
        var inputValueLength = inputValue.length;

        if(inputValueLength == 0){
        document.getElementById("user_phone_format").value = inputValue+"(";
    }
        if(inputValueLength == 4){
        document.getElementById("user_phone_format").value = inputValue+") ";
    }

        if(inputValueLength == 9){
        document.getElementById("user_phone_format").value = inputValue+"-";
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
		if(input.type.toLowerCase() == "text"){
		  input.placeholder = "Phone (XXX) XXX-XXXX";
		  input.addEventListener("keydown", onKeyDown);
		  input.addEventListener("keyup", onKeyUp);
		}
	  }
	}
	
	//MAIN
	setupPhoneFields("phone");
	
	</script>

    @endpush