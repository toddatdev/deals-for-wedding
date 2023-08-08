@extends('admin.layouts.app')
@section('title', 'Additional Pricing')
@push('customCSS')
@endpush

@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Pricing Plan Management</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						@include('flash-message')
						<div class="card-header">
							<div class="card-title">
							Additional Pricing
							</div>
						</div>
					<div class="card-body">
						@foreach ($additional as $item)
						<form action="{{route('plan.additionalupdate')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="per_listing_price" class="form-label"><strong>Extra Listing Price</strong></label>
							        	<input type="text" class="form-control @error('per_listing_price') is-invalid @enderror" id="per_listing_price" name="per_listing_price" placeholder="Extra Listing Price" value="{{isset($item->per_listing_price) ? $item->per_listing_price : ''}}" required="">
							        	@error('per_listing_price')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							        <div class="col-md-6">
							        	<label for="additional_city_price" class="form-label"><strong>Additional City Price</strong></label>
							        	<input type="text" class="form-control @error('additional_city_price') is-invalid @enderror" id="additional_city_price" name="additional_city_price" placeholder="Additional City Price"  required="" value="{{isset($item->additional_city_price) ? $item->additional_city_price : ''}}">
							        	@error('additional_city_price')
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
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

@push('customJs')
@endpush