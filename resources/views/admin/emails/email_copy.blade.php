@extends('admin.layouts.app')
@section('title', 'Email body Management')
@push('customCSS')
	<style>
		.panel-heading.note-toolbar {
			background-color: #636680;
		}
		.panel-heading.note-toolbar .btn-default {
			background: #636680 !important;
		}
	</style>
@endpush

@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Email body Management</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						@include('flash-message')
						<div class="card-header">
							<div class="card-title">
							Update Email Notifications
							</div>
						</div>
					<div class="card-body">
						<form action="{{route('email.update')}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
							   <div class="row">
							        <div class="col-md-12">
							        	<h6 for="new_user_reg" class="form-label"><strong>New User Registration Email</strong></h6>
							        	<textarea type="text" class="form-control @error('new_user_reg') is-invalid @enderror" id="new_user_reg" name="new_user_reg" placeholder="Extra Listing Price" required="">{{isset($emails->new_user_reg) ? $emails->new_user_reg : ''}}</textarea>
							        	@error('new_user_reg')
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
							        	<h6 for="new_advertiser_reg" class="form-label"><strong>New Advertiser Registration Email</strong></h6>
							        	<textarea type="text" class="form-control @error('new_advertiser_reg') is-invalid @enderror" id="new_advertiser_reg" name="new_advertiser_reg" placeholder="Extra Listing Price" required="">{{isset($emails->new_advertiser_reg) ? $emails->new_advertiser_reg : ''}}</textarea>
							        	@error('new_advertiser_reg')
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
							        	<h6 for="new_deal_submit" class="form-label"><strong>Advertiser Deal Submit Email</strong></h6>
							        	<textarea type="text" class="form-control @error('new_deal_submit') is-invalid @enderror" id="new_deal_submit" name="new_deal_submit" placeholder="Additional City Price"  required="">{{isset($emails->new_deal_submit) ? $emails->new_deal_submit : ''}}</textarea>
							        	@error('new_deal_submit')
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('textarea').summernote();
    });
</script>