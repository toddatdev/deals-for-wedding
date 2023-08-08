@extends('admin.layouts.app')
@section('title', 'Edit Category')
@push('customCSS')
@endpush

@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Category Management</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
							Add Category
							</div>
						</div>
					<div class="card-body">
						<form action="{{route('categories.update', $category->id)}}" method="post" enctype="multipart/form-data">
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
							   </div>
							</div>

							<div style="display: none" class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="icon" class="form-label"><strong>Icon </strong></label>
							        	 @if(isset($category->icon))
			                              <div class="old_img">
			                                 <img src="{{asset('public/'.$category->icon)}}" style="width:100px">
			                                 <i class="fa fa-times text-success" aria-hidden="true" onclick="removeFile(this);"></i>
			                               </div>
			                              @endif
			                              <input type="file" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" accept="image/*">
			                              {{-- <input type="hidden" id="old_icon" value="{{isset($category->icon) ? $category->icon :''}}" name="old_icon"> --}}
							        	@error('icon')
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
<script type="text/javascript">
@if(isset($category->icon))
function removeFile(element){
    $(element).parent('div.old_img').remove();
}
@endif
</script>
@endpush