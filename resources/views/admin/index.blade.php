@extends('admin.layouts.app')

@section('title', 'Deals for Weddings')

@push('customCSS')

@endpush

@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Dashboard</h4>
			<div class="row">

{{--				<div class="col-md-3">--}}
{{--					<div class="card card-stats card-info">--}}
{{--						<div class="card-body ">--}}
{{--							<div class="row">--}}
{{--								<div class="col-5">--}}
{{--									<div class="icon-big text-center">--}}
{{--										<i class="la la-users"></i>--}}
{{--									</div>--}}
{{--								</div>--}}
{{--								<div class="col-7 d-flex align-items-center">--}}
{{--									<div class="numbers">--}}
{{--										<p class="card-category">Admin(s)</p>--}}
{{--										<h4 class="card-title">000</h4>--}}
{{--									</div>--}}
{{--								</div>--}}
{{--								<div class="col-7 d-flex align-items-center">--}}
{{--									<a class="btn-danger mt-2 mb-2 p-2 text-center"  style="color: white" href="{{route('admin.admin-list')}}" title="View">View More</a>--}}
{{--								</div>--}}
{{--							</div>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}


				<div class="col-md-3">
					<div class="card card-stats card-warning">
						<div class="card-body ">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="la la-users"></i>
									</div>
								</div>
								<div class="col-7 d-flex align-items-center">
									<div class="numbers">
										<p class="card-category">User(s)</p>
										<h4 class="card-title">{{$user_count}}</h4>
									</div>
								</div>
								<div class="col-7 d-flex align-items-center">
									<a class="btn-danger mt-2 mb-2 p-2 text-center"  style="color: white" href="{{route('admin.user-list')}}" title="View">View More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card card-stats card-success">
						<div class="card-body ">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="la la-bar-chart"></i>
									</div>
								</div>
								<div class="col-7 d-flex align-items-center">
									<div class="numbers">
										<p class="card-category">Deal(s)</p>
										<h4 class="card-title">{{$deal_count}}</h4>
									</div>
								</div>
								<div class="col-7 d-flex align-items-center">
									<a class="btn-danger mt-2 mb-2 p-2 text-center" style="color: white" href="{{route('deals.index')}}" title="View">View More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card card-stats card-danger">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="la la-newspaper-o"></i>
									</div>
								</div>
								<div class="col-7 d-flex align-items-center">
									<div class="numbers">
										<p class="card-category">Category(s)</p>
										<h4 class="card-title">{{$category_count}}</h4>
									</div>
								</div>
								<div class="col-7 d-flex align-items-center">
									<a class="btn-danger mt-2 mb-2 p-2 text-center" style="color: white" href="{{route('categories.index')}}" title="View">View More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card card-stats card-primary">
						<div class="card-body ">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="la la-check-circle"></i>
									</div>
								</div>
								<div class="col-7 d-flex align-items-center">
									<div class="numbers">
										<p class="card-category">Deal Query(s)</p>
										<h4 class="card-title">{{$deal_query_count}}</h4>
									</div>
								</div>
								<div class="col-7 d-flex align-items-center">
									<a class="btn-danger mt-2 mb-2 p-2 text-center" style="color: white" href="{{route('contact_vendor.index')}}" title="View">View More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
@include('admin.tasks')
		</div>
	</div>
</div>

@endsection
@push('customJs')
<script src="{{asset('/public/admin/js/bootstrap-editable.js')}}"></script>
<script>
    $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });

            $('.xedit').editable({
                url: '{{route('tasks.update')}}',
                title: 'Update',
                success: function (response, newValue) {
                    console.log('Updated', response);
					$('#task-alert').html('Task Updated Successfully!');
					$('#task-alert').show();
					setTimeout(() => {
						location.reload();
					}, 1000);
					
                }
            });

            $('.xadd').editable({
                url: '{{route('tasks.add')}}',
                title: 'Update',
                success: function (response, newValue) {
                    console.log('Updated', response)
					$('#task-alert').html('Task Added Successfully!');
					$('#task-alert').show();
					setTimeout(() => {
						location.reload();
					}, 1000);
                }
            });

    });

	function taskRemove(id){

        $.ajax({
			type: "POST",
			id: id,
            url: "{{ route('tasks.delete') }}",
			data:{
				id: id,
			},
            success: function (response) {
				console.log('Deleted', response)
				$('#task-alert').html('Task Deleted Successfully!');
					$('#task-alert').show();
					setTimeout(() => {
						location.reload();
					}, 1000);
				}
			})
	}
</script>

@endpush