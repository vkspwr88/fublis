<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		{!! seo($SEOData ?? null) !!}
		@yield('head')
		@stack('meta')
		<link rel="icon" type="image/png" href="{{ asset(env('COMPANY_ICON')) }}">
		<link rel='stylesheet' id='inter-font-css' href='https://rsms.me/inter/inter.css?ver=6.5.3' type='text/css' media='all' />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('css/style-portal.css') }}">
		@stack('styles')
		<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		{{-- <script src="{{ asset('js/affiliate/core.js') }}"></script> --}}
	</head>

	<body class="font-sans antialiased">
		<div class="flex h-screen overflow-hidden bg-gray-100" x-data="{ sidebarOpen: false, notificationsOpen: false }" @keydown.window.escape="{ sidebarOpen = false, notificationsOpen = false }">
			@include('users.includes.affiliates.sidebar')
			<div class="flex flex-col flex-1 w-0 overflow-hidden">
				@include('users.includes.affiliates.header')
				<main id="portal-content-wrap" class="relative flex-1 py-6 overflow-y-auto focus:outline-none"
					tabindex="0" x-data="" x-init="$el.focus()">
					<div id="affiliate-portal-content" class="px-4 pb-8 mx-auto max-w-7xl sm:px-6 md:px-8">
						@yield('body')
					</div>
				</main>
			</div>
		</div>
		<script>
			c => {
				a !== window && a !== document || document.body.contains(t) ? function(e) {
					return ["keydown", "keyup"].includes(e)
				}(n) && function(e, t) {
					let n = t.filter(e => !["window", "document", "prevent", "stop"].includes(e));
					if (n.includes("debounce")) {
					let e = n.indexOf("debounce");
					n.splice(e, O((n[e + 1] || "invalid-wait").split("ms")[0]) ? 2 : 1)
					}
					if (0 === n.length) return !1;
					if (1 === n.length && n[0] === T(e.key)) return !1;
					const r = ["ctrl", "shift", "alt", "meta", "cmd", "super"].filter(e => n.includes(e));
					return n = n.filter(e => !r.includes(e)), !(r.length > 0 && r.filter(t => ("cmd" !== t && "super" !== t || (t = "meta"), e[t + "Key"])).length === r.length && n[0] === T(e.key))
				}(c, r) || (r.includes("prevent") && c.preventDefault(), r.includes("stop") && c.stopPropagation(), r.includes("self") && c.target !== t) || C(e, i, c, o).then(e => {
					!1 === e ? c.preventDefault() : r.includes("once") && a.removeEventListener(n, u, s)
				}) : a.removeEventListener(n, u, s)
			}
		</script>
	</body>

</html>
