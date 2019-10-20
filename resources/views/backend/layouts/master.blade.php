<!DOCTYPE html>
<html>

<head>
    @include('backend.layouts.head')
</head>

<body class="vertical-layout vertical-menu 2-columns fixed-navbar menu-expanded pace-done" data-open="click" data-menu="vertical-menu" data-col="2-columns">
	<!-- Header -->
	<header>
		@include('backend.layouts.header')
	</header>

	<!-- Sidebar -->
	@include('backend.layouts.sidebar')

	<!-- Content Wrapper. Contains page content -->
	<div class="app-content content">
		<div class="content-wrapper">
			@if (session('status'))
			<div class="alert-message">{{ session('status') }}</div>
			@endif
			<!-- Main content -->
		 	@yield('content')
			<!-- /.content -->
		</div>
	</div>

	<!-- Footer -->
	<footer class="footer footer-static footer-light navbar-border">
		@include('backend.layouts.footer')
	</footer>

	@include('backend.layouts.scripts')
	@yield('scripts')
</body>
</html>
