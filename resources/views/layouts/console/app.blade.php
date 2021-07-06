<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Katalog Online">
	<meta name="author" content="Wahyu Nur Hidayat">
	<link rel="icon" href="https://um.ac.id/wp-content/uploads/2020/08/cropped-Lambang-UM-32x32.png" sizes="32x32" />
	<link rel="icon" href="https://um.ac.id/wp-content/uploads/2020/08/cropped-Lambang-UM-192x192.png" sizes="192x192" />
	<link rel="apple-touch-icon" href="https://um.ac.id/wp-content/uploads/2020/08/cropped-Lambang-UM-180x180.png" />
	<meta name="msapplication-TileImage" content="https://um.ac.id/wp-content/uploads/2020/08/cropped-Lambang-UM-270x270.png" />

	<title>{{ config('app.name') }} - @yield('title', 'Halaman Kosong')</title>

	<link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

	@stack('stylesheets')

</head>
<body id="page-top">

@hasSection('simple')
	@yield('simple')
@else
	<div id="wrapper">

		@include('layouts.console.sidebar')

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				@include('layouts.console.topbar')

				<div class="container-fluid">
					<div class="d-sm-flex align-items-center justify-content-between mb-3">
						<h1 class="h3 mb-0 text-gray-800">@yield('title', 'Halaman Kosong')</h1>
						<div>
							@yield('actions')
						</div>
					</div>

                    @hasSection('breadcrumbs')
                    <div class="mb-4">
                        @yield('breadcrumbs')
					</div>
                    @endif

					@include('layouts.console.flash')

					@yield('content')
				</div>

			</div>

			@include('layouts.console.footer')
		</div>
	</div>

	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	@include('layouts.console.logout-modal')
@endif

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>

@stack('scripts')

</body>
</html>
