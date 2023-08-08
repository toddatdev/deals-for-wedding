@extends('admin.layouts.app')

@section('title', 'Admin : Pricing Plans')

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
			<h4 class="page-title">Pricing Plan Management</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						@include('flash-message')
						<div class="card-header">
							<div class="card-title">Pricing Plans</div>
							<a href="{{ route('plan.add') }}" style="float: right;margin-top: -20px;" class="btn btn-danger" title="add plan">Add Plan</a>
						</div>
						<div class="card-body">
							<table class="table table-bordered" id="userList">
								<thead>
									<tr>
										<th><strong>Sr. No.</strong></th>
										<th><strong>Name</strong></th>
										<th><strong>Description</strong></th>
										<th><strong>Price</strong></th>
										<th><strong>Plan Duration</strong></th>
										<th><strong>Status</strong></th>
										<th><strong>Actions</strong></th>
									</tr>
								</thead>
								<tbody>
									@if(!empty($discounts))
									@php $i = 1; @endphp
									@foreach($discounts->sortBy('name') as $key => $discount)
									<tr>
										<td>{{ $i }}</td>
										<td>{{ isset($discount->name) ? $discount->name : ''}}</td>
										<td>{!! isset($discount->description) ? $discount->description : ''!!}</td>
										<td>{{ isset($discount->price) ? $discount->price : ''}}</td>
										<td>{{ isset($discount->plan_duration) ? $discount->plan_duration : ''}}</td>
										<td>{{ (($discount->status == 1) ? 'Active' : 'Inactive') }}</td>
										<td>
											<a href="{{route('plan.edit',$discount->id)}}" title="Edit"><i class="la la-edit btn btn-success action-cons" aria-hidden="true"></i></a>
											<a href="{{route('plan.delete',$discount->id)}}" onclick="return confirm('Are you sure to want delete this item?');" title="Delete"><i class="la la-trash-o  btn btn-danger action-cons" aria-hidden="true"></i></a>
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