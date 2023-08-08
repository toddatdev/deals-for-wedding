@extends('vendor.layouts.app')
@section('title', 'Company Profile')
@push('customCSS')
@endpush
<style>
	.custom-row {
		margin-bottom: 20px;
	}
</style>
@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Company Profile</h4>
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
						<form action="{{url('advertiser/update_company_profile/'.Auth::user()->id)}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
							   <div class="row">
							   @foreach($fields as $key => $field)
							<?php
							$profile_value = App\Models\VendorCompanyProfile::select('field_value')
												->where('user_id', Auth::user()->id)
												->where('field_key', $field->input_name)
												->first();
							?>
							        <div class="col-md-6 custom-row">
							        	<label for="{{isset($field->input_name) ? $field->input_name : ''}}" class="form-label"><strong>{{isset($field->input_label) ? $field->input_label : ''}}@if($field->data_type == 1)<sup style="color:red;">*</sup> @endif</strong>@if($field->input_type == 'file')<small>Required square
											size & minimum 300px width. Allowed image type (jpeg, jpg, png, gif)</small>@endif</label>
							        	@if($field->input_type == 'textarea')
							        	<textarea class="form-control" id="{{isset($field->input_name) ? $field->input_name : ''}}" name="{{isset($field->input_name) ? $field->input_name : ''}}" placeholder="{{isset($field->input_label) ? $field->input_label : ''}}" @if($field->data_type == 1) required @endif>{{isset($profile_value->field_value) ? $profile_value->field_value : ''}}</textarea>
							        	@else
								        	@if(isset($profile_value->field_value) && ($field->input_type == 'file'))
								        	<div class="old_img">
				                                 <img src="{{asset('public/'.$profile_value->field_value)}}" style="width:100px">
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
		</div>
	</div>
</div>
</div>


@endsection

@push('customJs')
<script type="text/javascript">
function removeFile(element){
    $(element).parent('div.old_img').remove();
}
</script>
{{-- <script>
		function addSpace(){
 			var inputValue = document.getElementById("contacts_phone_number").value;
 			var inputValueLength = inputValue.length;
 			if(inputValueLength == 3 || inputValueLength == 7){
 			document.getElementById("contacts_phone_number").value = inputValue+"-"; 
 			}
		};
		$('#contacts_phone_number').on('click keyup keydown change', function(){
			console.log('working');
			$(this).attr('minlength', 10);
			$(this).attr('maxlength', 12);
			addSpace();
		});
	  </script> --}}
	<script>
		$('textarea').summernote();
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
    if(input.type.toLowerCase() == "tel"){
      input.placeholder = "Enter a phone (XXX-XXX-XXXX)";
      input.addEventListener("keydown", onKeyDown);
      input.addEventListener("keyup", onKeyUp);
    }
  }
}

//MAIN
setupPhoneFields("contacts_phone_number");

</script>
@endpush