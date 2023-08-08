@extends('admin.layouts.app')

@section('title', 'Admin : Category List')

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
			<h4 class="page-title">Category Management</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						@include('flash-message')
						<div class="card-header">
							<div class="card-title">Category List</div>
							<a href="{{ route('categories.create') }}" style="float: right;margin-top: -20px;" class="btn btn-danger" title="add users">Add New Category</a>
						</div>
						<div class="card-body">
							<table class="table table-bordered" id="userList">
								<thead>
									<tr>
										<th><strong>Date Created</strong></th>
										<th><strong>Name</strong></th>
										<!-- <th><strong>Icon</strong></th> -->
										<th><strong>Status</strong></th>
										<th><strong>Actions</strong></th>
									</tr>
								</thead>
								<tbody>
									@if(!empty($categories))
									@php $i = 1; @endphp
									@foreach($categories->sortBy('name') as $key => $category)
									<tr>
										<td>{{ $category->created_at->toDateString() }}</td>
										<td>{{ isset($category->name) ? $category->name : ''}}</td>

										<td>{{ (($category->status == 1) ? 'Active' : 'Inactive') }}</td>
										<td>
											<a href="{{route('categories.edit',$category->id)}}" title="Edit"><i class="la la-edit btn btn-success action-cons" aria-hidden="true"></i></a>
											<a href="{{route('categories.delete',$category->id)}}" onclick="return confirm('Are you sure to want delete this item?');" title="Delete">
												<i class="la la-trash-o  btn btn-danger action-cons" aria-hidden="true"></i></a>
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