<!DOCTYPE html>
<html lang="en">
<head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="x-ua-compatible" content="ie=edge">

  	@yield('title')

  	<link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
  		<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
			<ul class="navbar-nav">
	  			<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
	  			</li>
			</ul>
			<form class="form-inline ml-3">
	  			<div class="input-group input-group-sm">
					<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
					<div class="input-group-append">
		  				<button class="btn btn-navbar" type="submit">
							<i class="fa fa-search"></i>
		  				</button>
					</div>
	  			</div>
			</form>
  		</nav>

  		@include('layouts.partials.sidebar')
  
  		<div class="content-wrapper">
			@yield('content')
  		</div>

  		@include('layouts.partials.footer')
	</div>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
