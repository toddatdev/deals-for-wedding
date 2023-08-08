@extends('admin.layouts.app')

@section('title', 'Admin : Company Form Fields')

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
			<h4 class="page-title">Company Form Management</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						@include('flash-message')
						<div class="card-header">
							<div class="card-title">Company Form Fields List</div>
							<a href="{{ route('company_form.create') }}" style="float: right;margin-top: -20px;" class="btn btn-danger" title="add users">Add New Field</a>
						</div>
					<div class="card-body">
						<table class="table table-bordered" id="userList">
							<thead>
								<tr>
									<th><strong>Sr. No.</strong></th>
									<th><strong>Label</strong></th>
									<th><strong>Name</strong></th>
									<th><strong>Type</strong></th>
									<th><strong>Status</strong></th>
									<th><strong>Data Type</strong></th>
									<th><strong>Actions</strong></th>
								</tr>
							</thead>
							<tbody>
								@if(!empty($data))
									@php $i = 1; @endphp
									@foreach($data as $key => $value)
										<tr>
											<td>{{ $i }}</td>
											<td>{{ isset($value->input_label) ? $value->input_label : ''}}</td>
											<td>{{ isset($value->input_name) ? $value->input_name : ''}}</td>
											<td>{{ isset($value->input_type) ? $value->input_type : ''}}</td>
											<td>{{ (($value->status == 1) ? 'Active' : 'Inactive') }}</td>
											<td>{{ (($value->data_type == 1) ? 'Required' : 'Optional') }}</td>
											<td>
												<a href="{{route('company_form.edit',$value->id)}}" title="Edit"><i class="la la-edit btn btn-success action-cons" aria-hidden="true"></i></a>
												{{-- <a href="{{route('company_form.delete',$value->id)}}" onclick="return confirm('Are you sure to want delete this item?');" title="Delete"><i class="la la-trash-o  btn btn-danger action-cons" aria-hidden="true"></i></a> --}}
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