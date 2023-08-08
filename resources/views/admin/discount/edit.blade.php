@extends('admin.layouts.app')
@section('title', 'Edit Discount')
@push('customCSS')
@endpush

@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Discount Management</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
							Edit Discount
							</div>
						</div>
					<div class="card-body">
						<form action="{{route('discount.update', $category->id)}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="name" class="form-label"><strong>Name</strong></label>
							        	<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{isset($category->name) ? $category->name : ''}}" required="">
							        	@error('name')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							        <div class="col-md-6">
							        	<label for="description" class="form-label"><strong>Description</strong></label>
							        	<input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description" value="{{isset($category->description) ? $category->description : ''}}" required="">
							        	@error('description')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							   </div>
							</div>

							<div class="form-group">
							   <div class="row">
							        <div class="col-md-4">
							        	<label for="value" class="form-label"><strong>Value</strong></label>
							        	<input type="text" class="form-control @error('value') is-invalid @enderror" id="value" name="value" placeholder="Value" value="{{isset($category->value) ? $category->value : ''}}" required="">
							        	@error('value')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							        <div class="col-md-4">
							        	<label for="expire_date" class="form-label"><strong>Expire Date</strong></label>
							        	<input type="text" class="form-control @error('expire_date') is-invalid @enderror" id="expire_date" name="expire_date" placeholder="Expire Date" value="{{isset($category->expire_date) ? $category->expire_date : ''}}" required="">
							        	@error('expire_date')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							        <div class="col-md-4">
							        	<label for="status" class="form-label"><strong>Status </strong></label>
							        	<select class="form-control @error('icon') is-invalid @enderror" name="status" id="status">
							        		<option value="1" {{isset($category->status) ? (($category->status == 1) ? 'checked="checked"' : '') : ''}}>Active</option>
							        		<option value="0" {{isset($category->status) ? (($category->status == 0) ? 'checked="checked"' : '') : ''}}>Inactive</option>
							        	</select>
							        	@error('status')
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
@endpush