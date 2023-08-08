@extends('admin.layouts.app')
@section('title', 'Edit Field Input')
@push('customCSS')
@endpush

@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Company Form Management</h4>
			@include('flash-message')
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
							Edit Field Input
							</div>
						</div>
					<div class="card-body">
						<form action="{{route('company_form.update', $data->id)}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="input_label" class="form-label"><strong>Input Label</strong></label>
							        	<input type="text" class="form-control @error('input_label') is-invalid @enderror" id="input_label" name="input_label" placeholder="Input Label" value="{{isset($data->input_label) ? $data->input_label : ''}}" required="">
							        	@error('input_label')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							        <div class="col-md-6">
							        	<label for="input_name" class="form-label"><strong>Input Name</strong></label>
							        	<input type="text" class="form-control @error('input_name') is-invalid @enderror" id="input_name" name="input_name" placeholder="Input Name" value="{{isset($data->input_name) ? $data->input_name : ''}}" readonly>
							        	@error('input_name')
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
								        	<label for="input_type" class="form-label"><strong>Input Type</strong></label>
								        	<select class="form-control @error('input_type') is-invalid @enderror" id="input_type" name="input_type" required="">
								        		<option value="">Select Any</option>
								        		<option value="text" {{($data->input_type == "text") ? 'selected="selected"' : ''}}>Text</option>
								        		<option value="number" {{($data->input_type == "number") ? 'selected="selected"' : ''}}>Number</option>
								        		<option value="url" {{($data->input_type == "url") ? 'selected="selected"' : ''}}>URL</option>
								        		<option value="file" {{($data->input_type == "file") ? 'selected="selected"' : ''}}>File</option>
								        		<option value="email" {{($data->input_type == "email") ? 'selected="selected"' : ''}}>email</option>
								        		<option value="tel" {{($data->input_type == "tel") ? 'selected="selected"' : ''}}>Phone Number</option>
								        		<option value="password" {{($data->input_type == "password") ? 'selected="selected"' : ''}}>password</option>
								        		<option value="textarea" {{($data->input_type == "textarea") ? 'selected="selected"' : ''}}>Textarea</option>
								        		{{-- <option value="select" {{($data->input_type == "select") ? 'selected="selected"' : ''}}>Select</option> --}}
								        		<option value="checkbox" {{($data->input_type == "checkbox") ? 'selected="selected"' : ''}}>Checkbox</option>
								        		{{-- <option value="radio" {{($data->input_type == "radio") ? 'selected="selected"' : ''}}>Radio</option> --}}
								        	</select>
								        	@error('input_type')
								        	    <span class="invalid-feedback" role="alert">
								        	        <strong>{{ $message }}</strong>
								        	    </span>
								        	@enderror
								        </div>
								        <div class="col-md-6">
								        	<label for="input_note" class="form-label"><strong>Input Note</strong></label>
								        	<textarea class="form-control @error('input_note') is-invalid @enderror" id="input_note" name="input_note" >{{isset($data->input_note) ? $data->input_note : ''}}</textarea>
								        	@error('input_note')
								        	    <span class="invalid-feedback" role="alert">
								        	        <strong>{{ $message }}</strong>
								        	    </span>
								        	@enderror
								        </div>
								   </div>
								</div>
							</div>

							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="status" class="form-label"><strong>Status </strong></label>
							        	<select class="form-control @error('icon') is-invalid @enderror" name="status" id="status">
							        		<option value="1" {{($data->status == 1) ? 'selected="selected"' : ''}}>Active</option>
							        		<option value="0" {{($data->status == 0) ? 'selected="selected"' : ''}}>Inactive</option>
							        	</select>
							        	@error('status')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							        <div class="col-md-6">
							        	<label for="data_type" class="form-label"><strong>Data Type </strong></label>
							        	<select class="form-control @error('icon') is-invalid @enderror" name="data_type" id="data_type">
							        		<option value="0" {{($data->data_type == 0) ? 'selected="selected"' : ''}}>Optional</option>
							        		<option value="1" {{($data->data_type == 1) ? 'selected="selected"' : ''}}>Required</option>
							        	</select>
							        	@error('data_type')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
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


@endsection

@push('customJs')

@endpush