<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		@yield('head')
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Inter" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('css/aman.css') }}">

		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
		</script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
		</script>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		@stack('styles')
	</head>

	<body class="bg-light">
		@include('users.includes.header')
		<section id="body" class="w-100 m-0 px-0 pb-0">
			@yield('body')
		</section>
		@include('users.includes.footer')
		<script>
			window.addEventListener('alert', event => {
				const type = event.detail[0].type;
				const message = event.detail[0].message;
				const title = event.detail[0].title ?? '';
				const options = {
					'closeButton': true,
					'progressBar': true,
					'showDuration': '300',
					'hideDuration': '5000',
					'timeOut': '5000',
				};
				switch(type){
					case 'success':
						toastr.success(message, title ?? '', options);
						break;
					case 'warning':
						toastr.warning(message, title ?? '', options);
						break;
					case 'error':
						toastr.error(message, title ?? '', options);
						break;
					case 'info':
						toastr.info(message, title ?? '', options);
						break;
					default:
						toastr.info(message, title ?? '', options);
				};
			});
		</script>
		@stack('scripts')
	</body>

</html>
