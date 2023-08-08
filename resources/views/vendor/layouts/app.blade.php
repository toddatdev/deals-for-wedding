<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>@yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
		name='viewport' />
	@include('vendor.layouts.header')
	@stack('customCSS')
	<style type="text/css">
		.sidebar .nav .nav-item a {
			padding: 5px 25px;
		}
	</style>

	<style>
		.panel-heading.note-toolbar {
			background-color: #636680;
		}
		.panel-heading.note-toolbar .btn-default {
			background: #636680 !important;
		}





	</style>
</head>

<body>





	<div class="wrapper">

		@include('vendor.layouts.nav-menu')

		@include('vendor.layouts.sidebar')

		@include('flash-message')

		@yield('content')

	</div>
</body>
@include('vendor.layouts.footer')
@stack('customJs')



</html>