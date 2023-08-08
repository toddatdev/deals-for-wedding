@extends('admin.layouts.app')
@section('title', 'Company Profile')
@push('customCSS')
@endpush

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
						<form action="{{route('admin.vendor.company_profile.update', $vendor->id)}}" method="post" enctype="multipart/form-data">
							@csrf
							@foreach($fields as $key => $field)
							<?php
							$profile_value = App\Models\VendorCompanyProfile::select('field_value')
												->where('user_id', $vendor->id)
												->where('field_key', $field->input_name)
												->first();
							?>
							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="{{isset($field->input_name) ? $field->input_name : ''}}" class="form-label"><strong>{{isset($field->input_label) ? $field->input_label : ''}}</strong></label>
							        	@if($field->input_type == 'textarea')
							        	<textarea class="form-control" id="{{isset($field->input_name) ? $field->input_name : ''}}" name="{{isset($field->input_name) ? $field->input_name : ''}}" placeholder="{{isset($field->input_label) ? $field->input_label : ''}}">{{isset($profile_value->field_value) ? $profile_value->field_value : ''}}</textarea>
							        	@else
								        	@if(isset($profile_value->field_value) && ($field->input_type == 'file'))
								        	<div class="old_img">
				                                 <img src="{{asset('public/'.$profile_value->field_value)}}" style="width:100px">
				                                 <i class="fa fa-times text-success" aria-hidden="true" onclick="removeFile(this);"></i>
				                            </div>
								        	@endif
							        	<input type="{{isset($field->input_type) ? $field->input_type : ''}}" class="form-control" id="{{isset($field->input_name) ? $field->input_name : ''}}" name="{{isset($field->input_name) ? $field->input_name : ''}}" placeholder="{{isset($field->input_label) ? $field->input_label : ''}}" value="{{isset($profile_value->field_value) ? $profile_value->field_value : ''}}" {{in_array($field->input_type, array('file','textarea','url')) ? '' : 'required'}}>
							        	@endif
							        </div>
							   </div>
							</div>
							@endforeach

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


@endsection

@push('customJs')
<script type="text/javascript">
function removeFile(element){
    $(element).parent('div.old_img').remove();
}
</script>
@endpush