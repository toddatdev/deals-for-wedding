@extends('admin.layouts.app')
@section('title', 'Add FAQs')
@push('customCSS')
@endpush

@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">FAQs Management</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
							Add FAQs
							</div>
						</div>
					<div class="card-body">
						<form action="{{route('faqs.store')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
							   <div class="row">
							        <div class="col-md-6">
							        	<label for="question" class="form-label"><strong>Question</strong></label>
							        	<input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" placeholder="Question" value="" required="">
							        	@error('question')
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
							        	<label for="answer" class="form-label"><strong>Answer </strong></label>
							        	<textarea class="form-control @error('answer') is-invalid @enderror" name="answer" id="answer" rows="15" cols="30"></textarea>
							        	@error('answer')
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
							        	<label for="category" class="form-label"><strong>Category </strong></label>
							        	<select class="form-control @error('category') is-invalid @enderror" name="category" id="category" required="">
							        		<option value="">Select Any</option>
							        		<option value="user_faq" >User FAQ</option>
							        		<option value="vendor_faq">Advertiser FAQ</option>
							        	</select>
							        	@error('category')
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
							        	<select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
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
<script type="text/javascript">
	$(function () {
    // Summernote
    $('#answer').summernote({
    	 height:250,
    })
})
</script>

@endpush