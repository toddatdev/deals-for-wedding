<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>@yield('title')</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	@include('theme.header')
	@stack('customCSS')
</head>
<body>
	
	<main class="middle-area dashboard">
		<div class="container-fluid">
			<div class="row">
				@include('theme.dark_sidebar')
				
				{{-- @include('flash-message') --}}
				
				@yield('content')
			</div>
		</div>
	</main>

</body>
@include('theme.footer')
@stack('customJs')
</html>