@extends('admin.layouts.app')

@section('title', 'Admin : FAQs List')

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
			<h4 class="page-title">FAQs Management</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						@include('flash-message')
						<div class="card-header">
							<div class="card-title">FAQs List</div>
							<a href="{{ route('faqs.create') }}" style="float: right;margin-top: -20px;" class="btn btn-danger" title="add users">Add New FAQ</a>
						</div>
					<div class="card-body">
						<table class="table table-bordered" id="userList">
							<thead>
								<tr>
									<th><strong>Sr. No.</strong></th>
									<th><strong>Question</strong></th>
									<th><strong>Answer</strong></th>
									<th><strong>Category</strong></th>
									<th><strong>Status</strong></th>
									<th width="15%"><strong>Actions</strong></th>
								</tr>
							</thead>
							<tbody>
								@if(!empty($faqs))
									@php $i = 1; @endphp
									@foreach($faqs as $key => $faq)
										<tr>
											<td>{{ $i }}</td>
											<td>{{ isset($faq->question) ? $faq->question : ''}}</td>
											<td>{!! isset($faq->answer) ? \Illuminate\Support\Str::limit($faq->answer, 150, $end='...') : ''!!}</td>
											<td>{{ isset($faq->category) ? str_replace('_', ' ', $faq->category) : ''}}</td>
											<td>{{ (($faq->status == 1) ? 'Active' : 'Inactive') }}</td>
											<td>
												<a href="{{route('faqs.edit',$faq->id)}}" title="Edit"><i class="la la-edit btn btn-success action-cons" aria-hidden="true"></i></a>
												<a href="{{route('faqs.delete',$faq->id)}}" onclick="return confirm('Are you sure to want delete this item?');" title="Delete"><i class="la la-trash-o  btn btn-danger action-cons" aria-hidden="true"></i></a>
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