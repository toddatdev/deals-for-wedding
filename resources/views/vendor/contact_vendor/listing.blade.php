@extends('vendor.layouts.app')

@section('title', 'Vendor : Contact Vendor Data')

@push('customCSS')
<style type="text/css" media="screen">
	.action-cons{
		font-size:20px;font-weight: bold;
	}
	.action-cons:hover{
		font-size:20px;color: #f8f9fa;background: #339af0;
	}
</style>
@endpush

@section('content')

<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Contact Vendor Data</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						@include('flash-message')
						<div class="card-header">
							<div class="card-title">Contact Vendor Data List</div>
							{{-- <a href="{{ route('vendor.states.create') }}" style="float: right;margin-top: -20px;" class="btn btn-danger" title="add users">Add New State</a> --}}
						</div>
					<div class="card-body">
						<table class="table table-bordered" id="userList">
							<thead>
								<tr>
									<th><strong>Sr. No.</strong></th>
									<th><strong>Name</strong></th>
									<th><strong>Email</strong></th>
									<th><strong>Phone</strong></th>
									<th><strong>Deal</strong></th>
									<th><strong>Wedding date</strong></th>
									<th><strong>Message</strong></th>
									<th><strong>Actions</strong></th>
								</tr>
							</thead>
							<tbody>
								@if(!empty($data))
									@php $i = 1; @endphp
									@foreach($data as $key => $value)
										<tr>
											<td>{{ $i }}</td>
											<td>{{ isset($value->name) ? $value->name : ''}}</td>
											<td>{{ isset($value->email) ? $value->email : ''}}</td>
											<td>{{ isset($value->phone) ? $value->phone : ''}}</td>
											<td>{{ isset($value->deal->title) ? $value->deal->title : ''}}</td>
											<td>{{ isset($value->wedding_date) ? $value->wedding_date : ''}}</td>
											<td>{{ isset($value->message) ? $value->message : ''}}</td>
											<td width="20%">
												<a href="#" title="Edit"><i class="la la-edit btn btn-success action-cons" aria-hidden="true"></i></a>
												<a href="#" title="Delete"><i class="la la-trash-o  btn btn-danger action-cons" aria-hidden="true"></i></a>
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
	$(document).ready(function(){

        $('#userList').DataTable();

	});
</script>

@endpush