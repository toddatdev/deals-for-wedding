@extends('admin.layouts.app')
@section('title', 'Update Blog')
@push('customCSS')
@endpush

@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Blog Management</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
					   @include('flash-message')
						<div class="card-header">
							<div class="card-title">
							Update Blog
							</div>
						</div>
					<div class="card-body">
						<form action="{{url('admin/update_blog_action')}}" method="post" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="post_id" value="{{ $post->id }}" required>
							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="name" class="form-label"><strong>Title</strong></label>
							        	<input type="text" class="form-control @error('name') is-invalid @enderror" id="title" name="title" placeholder="Title" value="{{ $post->title }}" required="">
							        	@error('title')
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
							        	<label for="status" class="form-label"><strong>Blog Category </strong></label>
							        	<select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id" required>
							        		<option value="">-Select-</option>
											@if(!empty($categories)) 
											    @foreach($categories as $category)
											        @if($category->id==$post->category_id)
													    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
													@else
							        		            <option value="{{ $category->id }}">{{ $category->name }}</option>
												    @endif
										        @endforeach
										    @endif
							        	</select>
							        	@error('category_id')
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
							        	<label for="image" class="form-label"><strong>Image </strong></label>
							        	<input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
							        	@error('image')
							        	    <span class="invalid-feedback" role="alert">
							        	        <strong>{{ $message }}</strong>
							        	    </span>
							        	@enderror
							        </div>
							    </div>
							</div>
							
							<div class="form-group">
							   <div class="row">
							        <div class="col-md-12">
							        	<label for="answer" class="form-label"><strong>Description </strong></label>
							        	<textarea class="form-control @error('description') is-invalid @enderror" name="description" id="answer" rows="15" cols="30" required>{{ $post->description }}</textarea>
							        	@error('description')
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
<script type="text/javascript">
	$(function () {
    // Summernote
    $('#answer').summernote({
    	 height:250,
    })
})
</script>
@endpush