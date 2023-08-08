@extends('theme.secondary')

@section('title', 'Blogs')

@push('customCSS')

@endpush

@section('content')

	<div class="col-md-9 pink-bg py-4 px-3 blog-page" id="middle-section">
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div class="middle-content-area">
					<div class="row">
						<div class="col-md-12">
							<h1>Blog</strong></h1>
						</div>
					</div>	
					<div class="row">
					    @if(!empty($posts))
							@foreach($posts as $post)
								<div class="col-md-12 col-sm-12 col-xl-6 col-lg-6">
									<div class="DW-blogBox">
										<img src="{{ asset('uploads/'.$post->image) }}" alt="" class="mx-auto d-block img-fluid w-100"/>
										<div class="DW-blogBox-content pl-3 pr-3 pb-3 pt-0">
											<p class="mt-2 pink-txt"><a>{{ $post->category->name }}</a> | <span>{{ date('d F , Y',strtotime($post->created_at)) }}</span></p>
											<h2>{{ $post->title }}</h2>
											<p>{!! $post->description !!}</p>
											<a href="{{ url('/blog-details/') }}/{{ $post->slug }}" class="btn btn-info">Read More</a>
										</div>	
									</div>
								</div>
							@endforeach
						@else
							<p>No any blog..</p>
						@endif
						
					</div>
				</div>
			</div>
		</div>	
	</div>

@endsection

@push('customJs')

@endpush