@extends('admin.layouts.app')
@section('title', 'Add City')
@push('customCSS')
@endpush

@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">City Management</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
								Add City
							</div>
						</div>
						<div class="card-body">
							<form action="{{route('states.store')}}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label for="name" class="form-label"><strong>Name</strong></label>
											<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="" required="">
											@error('name')
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
											<label for="code" class="form-label"><strong>Code</strong></label>
											<input type="text" class="form-control @error('code') is-invalid @enderror" id="name" name="code" placeholder="e.g. TX for Texas" value="" required="">
											@error('code')
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