@extends('vendor.layouts.app')

@section('title', 'Advertiser : Deal Review(s)')

@push('customCSS')
<style type="text/css" media="screen">
	.action-cons {
		font-size: 20px;
		font-weight: bold;
	}

	.action-cons:hover {
		font-size: 20px;
		color: #f8f9fa;
		background: #339af0;
	}
</style>
@endpush

@section('content')

<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Deal Review</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						@include('flash-message')
						<div class="card-header">
							<div class="card-title">Deal Review(s) List</div>
							{{-- <a href="{{ route('states.create') }}" style="float: right;margin-top: -20px;"
							class="btn btn-danger" title="add users">Add New State</a> --}}
						</div>
						<div class="card-body">
							<table class="table table-bordered" id="userList">
								<thead>
									<tr>
										<th><strong>Date Created</strong></th>
										<th><strong>Name</strong></th>
										<th><strong>Email</strong></th>
										<th><strong>Deal</strong></th>
										<th><strong>Title</strong></th>
										<th><strong>Message</strong></th>
									</tr>
								</thead>
								<tbody>
									@if(!empty($data))
									@php $i = 1; @endphp
									@foreach($data as $key => $value)
									<tr>
										<td>{{ $value->created_at->toDateString() }}</td>
										<td>{{ isset($value->name) ? $value->name : ''}}</td>
										<td>{{ isset($value->email) ? $value->email : ''}}</td>
										<td>{{ isset($value->deal->title) ? $value->deal->title : ''}}</td>
										<td>{{ isset($value->title) ? $value->title : ''}}</td>
										<td>{{ isset($value->message) ? $value->message : ''}}</td>
										@php $i++; @endphp
									</tr>
									@endforeach
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	@endsection

	@push('customJs')
	<script>
		$(document).ready(function(){

        $('#userList').DataTable();

	});
	</script>

	@endpush