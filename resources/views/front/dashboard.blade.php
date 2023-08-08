@extends('theme.secondary')

@section('title', 'User Dashboard')

@push('customCSS')
<style>
	#mobile-saved{
	display: none;
	}

    @media(max-width:767px) {
        .nav-tabs.tabs-left.sideways {
            height: auto;
        }
	#dealList, #dealList_wrapper {
	display: none;
	}
	#mobile-saved{
	display: block;
	}
    }
</style>
@endpush

@section('content')
<div class="col-md-9 pink-bg py-4 px-3" id="middle-section">
    <div class="row">
        <div class="col-md-12">
            <div class="middle-content-area">
                <div class="row">
                    <div class="col-md-12">
                        <a style="max-width: 250px; margin-right: auto; margin-left: 0;" class="btn btn-primary" href="{{route('home.welcome')}}">Go back to home.</a>
                        <h1>User Dashboard</h1>

                        <div class="row pt-4">
                            <div class="col-md-3">
                                <ul id="extra-nav" class="nav-tabs tabs-left sideways">
                                    <li class="active"><a href="#my-profile" data-toggle="tab">My Profile</a></li>
                                    <li><a href="#my-deals" data-toggle="tab">My Saved Deals</a></li>
{{--                                    <li><a href="{{ route('home.logout') }}" class="logout">Logout</a></li>--}}
                                </ul>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content" style="height: auto;">
                                    <div class="tab-pane active" id="my-profile">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @include('flash-message')
                                                <form method="POST" action="{{ route('home.update-user-profile') }}" id="register-form" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fname">First name*</label>
                                                                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                                                <input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" id="fname" placeholder="Your first name" value="{{$user_details->fname}}" autocomplete="fname" autofocus required>
                                                                @error('fname')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email">E-mail*</label>
                                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth::user()->email}}" autocomplete="email" id="email" placeholder="youremail@website.com" required>
                                                                @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password">New Password</label>
                                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholde="********">
                                                                @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group" style="margin-bottom: 13px;">
                                                                <div class="form-check">
                                                                    <label><strong>Gender</strong></label><br />
                                                                    <label class="form-radio-label">
                                                                        <input class="form-radio-input" type="radio" name="gender" value="male" checked="" {{(isset($user_details->userDetails) && ($user_details->userDetails->gender == 'male')) ? 'checked' : ''}}>
                                                                        <span class="form-radio-sign">Male</span>
                                                                    </label>
                                                                    <label class="form-radio-label ml-3">
                                                                        <input class="form-radio-input" type="radio" name="gender" value="female" {{(isset($user_details->userDetails) && ($user_details->userDetails->gender == 'female')) ? 'checked' : ''}}>
                                                                        <span class="form-radio-sign">Female</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="image">Image<small>Required square
                                                                    size & minimum 300px width. Allowed image type (jpeg, jpg, png, gif)</small></label>
                                                                @if(isset($user_details->userDetails->image))
                                                                <div class="old_img">
                                                                    <img src="{{asset($user_details->userDetails->image)}}" style="width:70px">
                                                                    <i class="fa fa-times text-success" aria-hidden="true" onclick="removeFile(this);"></i>
                                                                </div>
                                                                @endif
                                                                <input type="file" class="form-control" name="image" id="image" accept=".jpeg,.jpg,.png,.gif">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="wedding_date">Wedding Date*</label>
                                                                <input required type="date" id="wedding_date" name="wedding_date" class="form-control" placeholder="mm-dd-yy" value="{{(isset($user_details) && !empty($user_details->userDetails->wedding_date)) ? $user_details->userDetails->wedding_date : ''}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="zip_code">Zip Code</label>
                                                                <input type="text" id="zip_code" name="zip_code" class="form-control" placeholder="Zip Code" value="{{(isset($user_details) && !empty($user_details->userDetails->zip)) ? $user_details->userDetails->zip : ''}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lname">Last name*</label>
                                                                <input type="text" class="form-control @error('lname') is-invalid @enderror" id="lname" name="lname" placeholder="Your Last name" value="{{Auth::user()->lname}}" autocomplete="lname" autofocus>
                                                                @error('lname')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="phone">Phone number*</label>
                                                                <input id="phoneNumber" type="text" class="phone form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="000-000-0000" value="{{(isset($user_details) && !empty($user_details->userDetails->phone)) ? $user_details->userDetails->phone : ''}}" autocomplete="phone" min="10" autofocus required>
                                                                @error('phone')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password-confirm">Re-enter Password</label>
                                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholde="********" autocomplete="new-password">
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <label for="dob">Date Of Birth</label>
                                                                <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" placeholder="mm-dd-yyyy" value="{{(isset($user_details->userDetails) && !empty($user_details->userDetails->dob)) ? $user_details->userDetails->dob : ''}}" autocomplete="dob" autofocus>
                                                                @error('dob')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div> -->
                                                            <div class="form-group">
                                                                <label for="address">Address*</label>
                                                                <textarea name="address" id="address" style="height:20px;" class="form-control" placeholder="Address.." rows="2">{{(isset($user_details->userDetails) && !empty($user_details->userDetails->address)) ? $user_details->userDetails->address : ''}}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="city">City*</label>
                                                                <input type="text" id="city" name="city" class="form-control" placeholder="City" value="{{(isset($user_details) && !empty($user_details->userDetails->city)) ? $user_details->userDetails->city : ''}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="state">State*</label>
                                                                <input type="text" id="state" name="state" class="form-control" placeholder="State" value="{{(isset($user_details) && !empty($user_details->userDetails->state)) ? $user_details->userDetails->state : ''}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="my-deals">
                                        <table class="table table-bordered display nowrap" id="dealList">
                                            <thead>
                                                <tr>
                                                    <th><strong>Sr. No.</strong></th>
                                                    <th><strong>Image</strong></th>
                                                    <th><strong>Title</strong></th>
                                                    <th><strong>Deal Offer</strong></th>
                                                    <th><strong>Category</strong></th>
                                                    <th><strong>Action</strong></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty($userDeals))
                                                @php $i = 1; @endphp
                                                @foreach($userDeals as $key => $userdeal)
						@if(!empty($userdeal->deal->id))

                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td><img src="{{$userdeal->deal->image}}" height="80" width="80" alt="image not found"></td>
                                                    <td>{{ $userdeal->deal->title }}</td>
                                                    <td>{{ $userdeal->price }}</td>
                                                    <td>{{ $userdeal->categories }}</td>
                                                    <td>
                                                        <a href="{{route('home.deal_detail2', $userdeal->deal_id)}}" target="_blank" title="Preview Saved Deal"><i class="fa fa-eye fa-2x btn btn-success"></i></a> &nbsp;
                                                        <a href="{{ url('/print-deals') }}/{{ $userdeal->deal_id }}" target="_blank" title="Print Deals"><i class="fa fa-print fa-2x btn btn-success"></i></a> &nbsp;
                                                        <a href="{{route('home.save_deal_delete', $userdeal->id)}}" onclick="return confirm('Are you sure to want delete this item?');" title="Delete"><i class="fa fa-trash fa-2x btn btn-warning" aria-hidden="true"></i></a>
                                                    </td>
                                                    @php $i++; @endphp
                                                </tr>
						@endif
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <div id="mobile-saved">
                                            @if(!empty($userDeals))
                                            @foreach($userDeals as $key => $userdealm)
                                            @if(!empty($userdealm->deal->id))
                                        <div class="row" style="flex-wrap: nowrap; margin-bottom:20px;">
                                            <div class="col-md-4" style="flex-basis: 33%; padding:0;">
                                                <img src="{{ asset('public') }}/{{$userdealm->deal->image}}" height="100" width="100" alt="image not found">
                                            </div>
                                            <div class="col-md-8" style="flex-basis: 67%;">
                                                <h6>{{ $userdealm->deal->title }}</h6>
                                                <hr>
                                                <a href="{{route('home.deal_detail2', $userdealm->deal_id)}}" target="_blank" title="Preview Saved Deal"><i class="fa fa-eye fa-2x btn btn-success"></i></a> &nbsp;
                                                        <a href="{{ url('/print-deals') }}/{{ $userdealm->deal_id }}" target="_blank" title="Print Deals"><i class="fa fa-print fa-2x btn btn-success"></i></a> &nbsp;
                                                        <a href="{{route('home.save_deal_delete', $userdealm->id)}}" onclick="return confirm('Are you sure to want delete this item?');" title="Delete"><i class="fa fa-trash fa-2x btn btn-warning" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center" style="margin-top: 5%;">
                                <p class="d-none d-md-none d-sm-none d-lg-block d-xl-block">&copy; Deals For Weddings </p>
                            </div>
                        </div>
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
	$('#extra-nav li').click(function(){
	$('#extra-nav li').removeClass('active');
	$(this).addClass('active');
})
        // $("#dob").datepicker({
        //     dateFormat: 'yy-mm-dd'
        // });

        // $("#wedding_date").datepicker({
        //     dateFormat: 'yy-mm-dd'
        // });

        $('#dealList').DataTable();
        // $( "#dob" ).datepicker("show");
        // function removeFile(element) {
        // 	$(element).parent('div.old_img').remove();
        // }
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
	function formatPhoneText(value){
	  value = this.replaceAll(value.trim(),"-","");
	  
	  if(value.length > 3 && value.length <= 6) 
		value = value.slice(0,3) + "-" + value.slice(3);
	  else if(value.length > 6) 
		value = value.slice(0,3) + "-" + value.slice(3,6) + "-" + value.slice(6);
	  
	  return value;
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
		  input.placeholder = "Phone (XXX-XXX-XXXX)";
		  input.addEventListener("keydown", onKeyDown);
		  input.addEventListener("keyup", onKeyUp);
		}
	  }
	}
	
	//MAIN
	setupPhoneFields("phone");
	
	</script>

@endpush