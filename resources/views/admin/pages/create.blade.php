@extends('admin.layouts.app')
@section('title', $page_title)
@push('customCSS')
@endpush

@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">{{$page_title}}</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
							{{$page_title}}
							</div>
						</div>
					<div class="card-body">
						@include('flash-message')
						<form action="{{route('page.save_data')}}" method="post" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="page_key" value="{{$page_key}}">
							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="title" class="form-label"><strong>Title</strong></label>
							        	<input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="title" value="{{isset($data->title) ? $data->title : ''}}" required="">
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
							        <div class="col-md-12">
							        	<label for="content" class="form-label"><strong>Content </strong></label>
							        	<textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="15" cols="30">{{isset($data->content) ? $data->content : ''}}</textarea>
							        	@error('content')
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
    $('#content').summernote({
    	 height:300,
    })
})
</script>

@endpush