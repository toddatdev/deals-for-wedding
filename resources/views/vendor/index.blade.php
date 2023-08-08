@extends('vendor.layouts.app')

@section('title', 'Deals for Weddings')

@push('customCSS')

@endpush

@section('content')
<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Advertiser Dashboard</h4>
			<div class="row">
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
										<p class="card-category">My Deal(s)</p>
										<h4 class="card-title">{{$deal_count}}</h4>
									</div>
								</div>
								<div class="col-7 d-flex align-items-center">
									<a class="btn-danger mt-2 mb-2 p-2 text-center" style="color: white" href="{{route('vendor.deals.index')}}" title="View">View More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card card-stats card-default">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="la la-newspaper-o"></i>
									</div>
								</div>
								<div class="col-7 d-flex align-items-center">
									<div class="numbers">
										<p class="card-category">Report(s)</p>
										<h4 class="card-title">{{isset($dealViews) ? count($dealViews) : 0}}</h4>
									</div>
								</div>
								<div class="col-7 d-flex align-items-center">
									<a class="btn-danger mt-2 mb-2 p-2 text-center" style="color: white" href="{{route('vendor.deals.viewed')}}" title="View">View More</a>
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
										<p class="card-category">Customer Query(s)</p>
										<h4 class="card-title">{{$deal_query_count}}</h4>
									</div>
								</div>
								<div class="col-7 d-flex align-items-center">
									<a class="btn-danger mt-2 mb-2 p-2 text-center" style="color: white" href="{{route('vendor.contact_vendor.index')}}" title="View">View More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h6 class="modal-title"><i class="la la-frown-o"></i> Under Development</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<p>Currently the pro version of the <b>Ready Dashboard</b> Bootstrap is in progress development</p>
				<p>
					<b>We'll let you know when it's done</b>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="showSuccessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="text-right">
				<button type="button" class="close mr-3 mt-2"
						data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="card border-0 shadow-none"
					 style="box-shadow: none">
					<div class="card-body">
						<div class="text-center">
							<h4 class="text-success font-weight-bold">Success!</h4>
							<i class="la la-check bg-success my-3 font-weight-bold text-white rounded-circle p-3 text-center" style="font-size: 50px"></i>

							@if(isset($success_plan_purchase) && !is_null($success_plan_purchase))
							<h6>{{ $success_plan_purchase }} </h6>
							@else
								<h6>
									Plan Purchased successfully...
								</h6>
							@endif
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@push('customJs')


	@if ($message = Session::get('success_payment'))

		<script>
			$(document).ready(function (){
				$('#showSuccessModal').modal('show');
			})
		</script>
	@endif

@endpush