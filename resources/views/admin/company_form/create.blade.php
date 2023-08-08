@extends('admin.layouts.app')
@section('title', 'Add Field Input')
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
							Add Field Input
							</div>
						</div>
					<div class="card-body">
						<form action="{{route('company_form.store')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="input_label" class="form-label"><strong>Input Label</strong></label>
							        	<input type="text" class="form-control @error('input_label') is-invalid @enderror" id="input_label" name="input_label" placeholder="Input Label" value="" required="">
							        	@error('input_label')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							        <div class="col-md-6">
							        	<label for="input_name" class="form-label"><strong>Input Name</strong></label>
							        	<input type="text" class="form-control @error('input_name') is-invalid @enderror" id="input_name" name="input_name" placeholder="Input Name" value="" required="">
							        	<span><small>Note: Do not use special characters (,:/+=_).</small></span>
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
								        		<option value="text">Text</option>
								        		<option value="number">Number</option>
								        		<option value="url">URL</option>
								        		<option value="file">File</option>
								        		<option value="email">email</option>
								        		<option value="tel">Phone Number</option>
								        		<option value="password">password</option>
								        		<option value="textarea">Textarea</option>
								        		{{-- <option value="select">Select</option> --}}
								        		<option value="checkbox">Checkbox</option>
								        		{{-- <option value="radio">Radio</option> --}}
								        	</select>
								        	@error('input_type')
								        	    <span class="invalid-feedback" role="alert">
								        	        <strong>{{ $message }}</strong>
								        	    </span>
								        	@enderror
								        </div>
								        <div class="col-md-6">
								        	<label for="input_note" class="form-label"><strong>Input Note</strong></label>
								        	<textarea class="form-control @error('input_note') is-invalid @enderror" id="input_note" name="input_note" ></textarea>
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
							        		<option value="1">Active</option>
							        		<option value="0">Inactive</option>
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
							        		<option value="0">Optional</option>
							        		<option value="1">Required</option>
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