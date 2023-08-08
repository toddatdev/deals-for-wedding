<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>@yield('title')</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	@include('theme.header')
	@stack('customCSS')

	<style>
		.bg-light-deal{
			background-color: #58585826;
		}
	</style>
</head>

<body id="capture">
	<main class="middle-area inner-page sidebar-fixed" id="category-page">

		@include('theme.nav-menu')

		@include('theme.light_sidebar')

		{{-- @include('flash-message') --}}

		@yield('content')

	</main>
</body>
@include('theme.footer')
@stack('customJs')

</html>