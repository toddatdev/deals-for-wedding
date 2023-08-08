@extends('theme.secondary')

@section('title', (isset($data->title) ? $data->title : 'FAQs'))
@push('customCSS')

@endpush

@section('content')

{{-- <div class="col-md-9 pink-bg py-4 px-3" id="middle-section">
	<div class="row">
		<div class="col-md-10 offset-md-1">
			<div class="middle-content-area">
				<div class="row">
					<div class="col-md-10">
						<h1>got questions? <br><strong>get answers!</strong></h1>
						@if(count($data) > 0)
						 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						 	
						 	@foreach($data as $key => $faq)
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="heading{{$key+1}}">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key+1}}" aria-expanded="true" aria-controls="collapseOne">
											{{isset($faq->question) ? $faq->question :''}}
										</a>
									</h4>
								</div>
								<div id="collapse{{$key+1}}" class="panel-collapse collapse in " role="tabpanel" aria-labelledby="heading{{$key+1}}">
									<div class="panel-body">
										<div>
											@if(isset($faq->answer))
											{!! $faq->answer !!}
											@endif
										</div>
									</div>
								</div>
							</div>
							@endforeach
							
						</div>
						@else
						<p>Data coming soon!</p>
						@endif		
					</div>
				</div>
			</div>
		</div>
	</div>	
</div> --}}

<div class="col-md-9 pink-bg py-4 px-3 faq" id="middle-section">
	<div class="row">
		<div class="col-md-10 offset-md-1">
			<div class="middle-content-area">
				<div class="row">
					<div class="col-md-9">
						<h1>got questions? <br><strong>get answers!</strong></h1>
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Advertiser</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">User</a>
							</li>
						</ul><!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane active" id="tabs-1" role="tabpanel">
								@if(count($vendor_faq) > 0)
								 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								 	
								 	@foreach($vendor_faq as $key => $faq)
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="heading{{$key+1}}">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key+1}}" aria-expanded="true" aria-controls="collapseOne">
													{{isset($faq->question) ? $faq->question :''}}
												</a>
											</h4>
										</div>
										<div id="collapse{{$key+1}}" class="panel-collapse collapse in " role="tabpanel" aria-labelledby="heading{{$key+1}}">
											<div class="panel-body">
												<div>
													@if(isset($faq->answer))
													{!! $faq->answer !!}
													@endif
												</div>
											</div>
										</div>
									</div>
									@endforeach
									
								</div>
								@else
								<p>Data coming soon!</p>
								@endif		
							</div>
							<div class="tab-pane" id="tabs-2" role="tabpanel">
								@if(count($user_faq) > 0)
								 <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								 	
								 	@foreach($user_faq as $t => $ufaq)
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="heading{{$t+1}}">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$t+1}}" aria-expanded="true" aria-controls="collapseOne">
													{{isset($ufaq->question) ? $ufaq->question :''}}
												</a>
											</h4>
										</div>
										<div id="collapse{{$t+1}}" class="panel-collapse collapse in " role="tabpanel" aria-labelledby="heading{{$t+1}}">
											<div class="panel-body">
												<div>
													@if(isset($ufaq->answer))
													{!! $ufaq->answer !!}
													@endif
												</div>
											</div>
										</div>
									</div>
									@endforeach
									
								</div>
								@else
								<p>Data coming soon!</p>
								@endif		
							</div>
						</div>		
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>

@endsection

@push('customJs')

@endpush