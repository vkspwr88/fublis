<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		@yield('head')
		<link rel="icon" type="image/png" href="{{ asset(env('COMPANY_ICON')) }}">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900" rel="stylesheet">

		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
		</script>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		@stack('styles')
		<link rel="stylesheet" href="{{ asset('css/aman.css') }}">
	</head>

	<body class="bg-white">
		<nav id="header" class="navbar navbar-expand-xl">
			<div class="container">
				<a class="navbar-brand" href="{{ route('home') }}">
					<img src="{{ asset(env('COMPANY_LOGO')) }}" alt="{{ env('APP_NAME') }}" class="header-logo">
				</a>
			</div>
		</nav>
		<section class="px-0 pt-3 pb-5 m-0 w-100">
			@yield('body')
		</section>
		<footer id="footer">
			<div id="footer2" class="py-3">
				<div class="container">
					<div class="row">
						<div class="col-md-7">
							<p class="d-flex justify-content-center justify-content-md-start align-items-center h-100 m-md-0 text-muted">
								<i class="bi bi-c-circle me-1"></i> {{ env('COMPANY_NAME') }} {{ date('Y') }}
							</p>
						</div>
						<div class="col-md-5">
							<p class="d-flex justify-content-center justify-content-md-end align-items-center h-100 m-md-0 text-muted">
								<i class="bi bi-envelope me-2"></i> <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}" class="text-muted">{{ env('MAIL_FROM_ADDRESS') }}</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<script>
			const uploadHostUrl = '{{ route('architect.trix-file-upload') }}';
		</script>
		<script src="{{ asset('js/aman.js') }}"></script>
		@stack('scripts')
	</body>

</html>
