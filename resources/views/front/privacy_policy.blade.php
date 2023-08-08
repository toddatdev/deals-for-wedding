@extends('theme.secondary')

@section('title', (isset($data->title) ? $data->title : ''))

@push('customCSS')

@endpush

@section('content')

<div class="col-md-9 pink-bg py-4 px-3 scroll-height" id="middle-section">
				<div class="row">
					<div class="col-md-10 offset-md-1">
						<div class="middle-content-area">
							<div class="row">
								<div class="col-md-10">
									<h1>{{isset($data->title) ? $data->title : ''}}</strong></h1>
 									@if(isset($data->content))
									{!! $data->content !!}
									@else
									<p>Data coming soon !!</p>
									@endif
								</div>
								{{-- <div class="col-md-3">
									<div class="accountBox">
										<h6>{{(Auth::check()) ? 'oh hey, '.Auth::user()->fname : 'have an account?'}}<br><small><a href="{{(Auth::check()) ? route('home.dashboard') : route('login')}}">{{(Auth::check()) ? 'Your Account' : 'log in here'}}</a></small></h6>
										<img src="{{ asset('public/front/images/account.png') }}" class="mx-auto d-block img-fluid" alt="Account" />
									</div>	
								</div> --}}
							</div>
						</div>
					</div>
				</div>	
			</div>

@endsection

@push('customJs')

@endpush