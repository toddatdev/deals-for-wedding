@extends('admin.layouts.app')

@section('title', 'Admin : City List')

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
			<h4 class="page-title">City Management</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						@include('flash-message')
						<div class="card-header">
							<div class="card-title">City List</div>
							<a href="{{ route('states.create') }}" style="float: right;margin-top: -20px;" class="btn btn-danger" title="add users">Add New City</a>
						</div>
						<div class="card-body">
							<table class="table table-bordered" id="userList">
								<thead>
									<tr>
										<th><strong>Date Created</strong></th>
										<th><strong>Name</strong></th>
										<th><strong>Code</strong></th>
										<th><strong>Status</strong></th>
										<th><strong>Actions</strong></th>
									</tr>
								</thead>
								<tbody>
									@if(!empty($states))
									@php $i = 1; @endphp
									@foreach($states as $key => $state)
									<tr>
										<td>{{ $state->created_at->toDateString() }}</td>
										<td>{{ isset($state->name) ? $state->name : ''}}</td>
										<td>{{ isset($state->code) ? $state->code : ''}}</td>
										<td>{{ (($state->status == 1) ? 'Active' : 'Inactive') }}</td>
										<td>
											<a href="{{route('states.edit',$state->id)}}" title="Edit"><i class="la la-edit btn btn-success action-cons" aria-hidden="true"></i></a>
											<a href="{{route('states.delete',$state->id)}}" onclick="return confirm('Are you sure to want delete this item?');" title="Delete"><i class="la la-trash-o  btn btn-danger action-cons" aria-hidden="true"></i></a>
										</td>
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
		$(document).ready(function() {

			$('#userList').DataTable();

		});
	</script>

	@endpush