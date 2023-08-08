@extends('theme.secondary')

@section('title', 'Blog Details' )

@push('customCSS')

@endpush

@section('content')

	<div class="col-md-9 pink-bg py-4 px-3 blog-details-page" id="middle-section">
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div class="middle-content-area">
					<div class="row">
						<div class="col-md-10">
							<h1>{{ $post->title }}</strong></h1>
						</div>					
					</div>
					<div class="row">	
						<div class="col-md-12">
							<div class="DW-blogBox">
								<img src="{{ asset('uploads/'.$post->image) }}" alt="" class="mx-auto d-block img-fluid w-100"/>
								<div class="DW-blogBox-content pl-3 pr-3 pb-3 pt-0">
									<p class="mt-2 pink-txt"><a>{{ $post->category->name }}</a> | <span>{{ date('d F , Y',strtotime($post->created_at)) }}</span></p>
									<h2>{{ $post->title }}</h2>
									<p>{!! $post->description !!}</p>
								</div>	
							</div>
						</div>
					</div>
					
					<div class="row py-3">	
						<div class="col-md-12">
							<h3>Related Posts</h3>
						</div>
					</div>	
					<div class="row">
					    @if(!empty($latest_posts))
							@foreach($latest_posts as $latestPost)
								<div class="col-md-4">
									<div class="DW-blogBox">
										<img src="{{ asset('uploads/'.$latestPost->image) }}" alt="" class="mx-auto d-block img-fluid w-100"/>
										<div class="DW-blogBox-content pl-3 pr-3 pb-3 pt-0">
											<h2 class="mt-2">{{ $latestPost->title }}</h2>
											<p>{!! $latestPost->description !!}</p>
											<a href="{{ url('/blog-details/') }}/{{ $latestPost->slug }}" class="btn btn-info">Read More</a>
										</div>	
									</div>
								</div>
						    @endforeach
						@else
							<p>No Any Related Post..</p>
						@endif
					</div>	
				</div>
			</div>
		</div>	
	</div>

@endsection

@push('customJs')

@endpush