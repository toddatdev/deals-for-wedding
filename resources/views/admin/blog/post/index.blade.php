@extends('admin.layouts.app')

@section('title', 'Admin : Blogs')

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
			<h4 class="page-title">Blog Management</h4>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						@include('flash-message')
						<div class="card-header">
							<div class="card-title">Blog List</div>
							<a href="{{ url('admin/add-blog') }}" style="float: right;margin-top: -20px;" class="btn btn-danger" title="add users">Add New Blog </a>
						</div>
					<div class="card-body">
						<table class="table table-bordered" id="userList">
							<thead>
								<tr>
									<th><strong>Title</strong></th>
									<th><strong>Image</strong></th> 
									<th><strong>Category</strong></th>
									<th><strong>Descriptions</strong></th>
									<!--<th><strong>Status</strong></th>-->
									<th><strong>Created At</strong></th>
									<th><strong>Actions</strong></th>
								</tr>
							</thead>
							<tbody>
								@if(!empty($posts))
									@foreach($posts as $key => $post)
										<tr>
											<td>{{ isset($post->title) ? $post->title : ''}}</td>
											<td>
												@if(isset($post->image))
												<img src="{{asset('public/uploads/'.$post->image)}}" alt="{{ isset($post->image) ? $post->image : ''}}" width="70">
												@else
												N/A
												@endif
											</td>
											<td>{{ $post->category->name }}</td>
											<td>{!! $post->description !!}</td>
											<!--<td>{{ (($post->status == 1) ? 'Active' : 'Inactive') }}</td>-->
											<td>{{ $post->created_at }}</td>
											<td>
												<a href="{{ url('admin/blog-edit')}}/{{ $post->id }}" title="Edit"><i class="la la-edit btn btn-success action-cons" aria-hidden="true"></i></a>
												<a href="{{ url('admin/blog-delete')}}/{{ $post->id }}" onclick="return confirm('Are you sure to want delete this item?');" title="Delete"><i class="la la-trash-o  btn btn-danger action-cons" aria-hidden="true"></i></a>
											</td>
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