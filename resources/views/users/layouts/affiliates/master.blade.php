<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
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

	<body class="antialiased font-sans">

		<div class="h-screen flex overflow-hidden bg-gray-100" x-data="{ sidebarOpen: false, notificationsOpen: false }"
			@keydown.window.escape="{ sidebarOpen = false, notificationsOpen = false }">
			<div x-show="sidebarOpen" class="md:hidden" style="display: none;">
				<div class="fixed inset-0 flex z-40">
					<div @click="sidebarOpen = false" x-show="sidebarOpen"
						x-description="Off-canvas menu overlay, show/hide based on off-canvas menu state."
						x-transition:enter="transition-opacity ease-linear duration-300"
						x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
						x-transition:leave="transition-opacity ease-linear duration-300"
						x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0"
						style="display: none;">
						<div class="absolute inset-0 bg-gray-600 opacity-75"></div>
					</div>
					<div x-show="sidebarOpen" x-description="Off-canvas menu, show/hide based on off-canvas menu state."
						x-transition:enter="transition ease-in-out duration-300 transform"
						x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
						x-transition:leave="transition ease-in-out duration-300 transform"
						x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
						class="relative flex-1 flex flex-col max-w-xs w-full pt-5b pb-4 bg-gray-800"
						style="display: none;">
						<div class="absolute top-0 right-0 -mr-14 p-1">
							<button x-show="sidebarOpen" @click="sidebarOpen = false"
								class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600"
								aria-label="Close sidebar" style="display: none;">
								<svg id="close" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
									stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M6 18L18 6M6 6l12 12"></path>
								</svg> </button>
						</div>

						<div class="items-center h-16 flex-shrink-0 flex px-4 bg-gray-800">
							<span class="text-white">
								Eduwik </span>
						</div>

						<div class="bg-gray-800 px-2 ">
							<a class="mt-1 group flex items-center px-2 py-2 font-medium focus:outline-none transition ease-in-out duration-150 text-sm leading-5 hover:text-gray-300 text-gray-400 flex items-center"
								href="https://eduwik.com" id="back-to-site-link"><svg id="back-to-site-link-icon"
									class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path>
								</svg> Back to site</a>
						</div>

						<div class="mt-5 flex-1 h-0 overflow-y-auto">
							<nav class="px-2">
								<a class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-base leading-6 text-white bg-gray-900 flex items-center"
									href="https://eduwik.com/affiliate-area/" id="home_nav_item"><svg
										stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
										class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
										fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
										</path>
									</svg> Dashboard</a> <a
									class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-base leading-6 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
									href="https://eduwik.com/affiliate-area/urls/" id="urls_nav_item"><svg
										stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
										class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
										fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
										</path>
									</svg> Affiliate URLs</a> <a
									class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-base leading-6 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
									href="https://eduwik.com/affiliate-area/stats/" id="stats_nav_item"><svg
										stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
										class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
										fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
									</svg> Statistics</a> <a
									class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-base leading-6 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
									href="https://eduwik.com/affiliate-area/graphs/" id="graphs_nav_item"><svg
										stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
										class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
										fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
										</path>
									</svg> Graphs</a> <a
									class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-base leading-6 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
									href="https://eduwik.com/affiliate-area/referrals/" id="referrals_nav_item"><svg
										stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
										class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
										fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
										</path>
									</svg> Referrals</a> <a
									class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-base leading-6 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
									href="https://eduwik.com/affiliate-area/payouts/" id="payouts_nav_item"><svg
										stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
										class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
										fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
										</path>
									</svg> Payouts</a> <a
									class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-base leading-6 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
									href="https://eduwik.com/affiliate-area/visits/" id="visits_nav_item"><svg
										stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
										class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
										fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
										</path>
									</svg> Visits</a> <a
									class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-base leading-6 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
									href="https://eduwik.com/affiliate-area/coupons/" id="coupons_nav_item"><svg
										stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
										class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
										fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
										</path>
									</svg> Coupons</a> <a
									class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-base leading-6 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
									href="https://eduwik.com/affiliate-area/creatives/" id="creatives_nav_item"><svg
										stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
										class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
										fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
										</path>
									</svg> Creatives</a>

								<div class="flex items-center py-2">
									<hr class="w-full border-gray-700">
								</div>

								<a class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-base leading-6 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
									href="https://eduwik.com/tutorials/" target="_blank" id="2_menu_link_nav_item"><svg
										class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
										id="2_menu_link_icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
										</path>
									</svg> Get Started</a><a
									class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-base leading-6 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
									href="https://eduwik.com/shop/" target="_blank" id="3_menu_link_nav_item"><svg
										class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
										id="3_menu_link_icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
										</path>
									</svg> All Courses</a>
							</nav>
						</div>
					</div>
					<div class="flex-shrink-0 w-14">
					</div>
				</div>
			</div>

			<div class="hidden md:flex md:flex-shrink-0">
				<div class="flex flex-col w-64">
					<div class="items-center h-16 flex-shrink-0 flex px-4 bg-gray-800">
						<span class="text-white">
							Eduwik </span>
					</div>
					<div class="bg-gray-800 pl-2 ">
						<a class="mt-1 group flex items-center px-2 py-2 font-medium focus:outline-none transition ease-in-out duration-150 text-sm leading-5 hover:text-gray-300 text-gray-400 flex items-center flex items-center"
							href="https://eduwik.com" id="back-to-site-link"><svg id="back-to-site-link-icon"
								class="mr-3 mr-3 h-5 w-5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path>
							</svg> Back to site</a>
					</div>
					<div class="h-0 flex-1 flex flex-col overflow-y-auto">
						<nav class="flex-1 px-2 py-4 bg-gray-800">
							<a class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-sm leading-5 text-white bg-gray-900 flex items-center"
								href="https://eduwik.com/affiliate-area/" id="home_nav_item"><svg stroke-linecap="round"
									stroke-linejoin="round" stroke-width="2" id="view_icon"
									class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
									fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
									</path>
								</svg> Dashboard</a> <a
								class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-sm leading-5 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
								href="https://eduwik.com/affiliate-area/urls/" id="urls_nav_item"><svg
									stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
									class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
									fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
									</path>
								</svg> Affiliate URLs</a> <a
								class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-sm leading-5 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
								href="https://eduwik.com/affiliate-area/stats/" id="stats_nav_item"><svg
									stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
									class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
									fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
								</svg> Statistics</a> <a
								class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-sm leading-5 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
								href="https://eduwik.com/affiliate-area/graphs/" id="graphs_nav_item"><svg
									stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
									class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
									fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
									</path>
								</svg> Graphs</a> <a
								class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-sm leading-5 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
								href="https://eduwik.com/affiliate-area/referrals/" id="referrals_nav_item"><svg
									stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
									class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
									fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
									</path>
								</svg> Referrals</a> <a
								class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-sm leading-5 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
								href="https://eduwik.com/affiliate-area/payouts/" id="payouts_nav_item"><svg
									stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
									class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
									fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
									</path>
								</svg> Payouts</a> <a
								class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-sm leading-5 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
								href="https://eduwik.com/affiliate-area/visits/" id="visits_nav_item"><svg
									stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
									class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
									fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
									</path>
								</svg> Visits</a> <a
								class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-sm leading-5 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
								href="https://eduwik.com/affiliate-area/coupons/" id="coupons_nav_item"><svg
									stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
									class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
									fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
									</path>
								</svg> Coupons</a> <a
								class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-sm leading-5 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
								href="https://eduwik.com/affiliate-area/creatives/" id="creatives_nav_item"><svg
									stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
									class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
									fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
									</path>
								</svg> Creatives</a>

							<div class="flex items-center py-2">
								<hr class="w-full border-gray-700">
							</div>

							<a class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-sm leading-5 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
								href="https://eduwik.com/tutorials/" target="_blank" id="2_menu_link_nav_item"><svg
									class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
									id="2_menu_link_icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
									</path>
								</svg> Get Started</a><a
								class="mt-1 group px-2 py-2 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 focus:bg-gray-700 text-sm leading-5 hover:text-white focus:text-white text-gray-300 hover:bg-gray-700 flex items-center"
								href="https://eduwik.com/shop/" target="_blank" id="3_menu_link_nav_item"><svg
									class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
									id="3_menu_link_icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
									</path>
								</svg> All Courses</a>
						</nav>
					</div>
				</div>
			</div>
			<div class="flex flex-col w-0 flex-1 overflow-hidden">
				<div class="relative z-10 flex-shrink-0 flex h-16 bg-white">
					<button @click.stop="sidebarOpen = true"
						class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:bg-gray-100 focus:text-gray-600 md:hidden"
						aria-label="Open sidebar">
						<svg id="open_sidebar" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M4 6h16M4 12h16M4 18h7"></path>
						</svg> </button>
					<div class="flex-1 px-4 flex justify-between">
						<div class="flex-1 flex">
						</div>
						<div class="ml-4 flex items-center md:ml-6">

							<div @click.away="open = false" class="ml-3 relative" x-data="{ open: false }">
								<div>
									<button @click="open = !open"
										class="max-w-xs flex items-center text-sm rounded-full focus:outline-none focus:shadow-outline"
										id="user-menu" aria-label="User menu" aria-haspopup="true"
										x-bind:aria-expanded="open">
										<img alt=""
											src="https://secure.gravatar.com/avatar/0d1dc16b4aa79cb695f402f14fd7f122?s=96&amp;d=mm&amp;r=g"
											srcset="https://secure.gravatar.com/avatar/0d1dc16b4aa79cb695f402f14fd7f122?s=96&amp;d=mm&amp;r=g 2x"
											class="avatar avatar-96 photo h-8 w-8 rounded-full" height="96" width="96"
											loading="lazy" decoding="async"><svg class="ml-1 h-5 w-5 text-gray-500"
											id="sort_down" fill="currentColor" viewBox="0 0 20 20">
											<path fill-rule="evenodd"
												d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
												clip-rule="evenodd"></path>
										</svg> </button>
								</div>

								<div x-show="open"
									x-description="Profile dropdown panel, show/hide based on dropdown state."
									x-transition:enter="transition ease-out duration-100"
									x-transition:enter-start="transform opacity-0 scale-95"
									x-transition:enter-end="transform opacity-100 scale-100"
									x-transition:leave="transition ease-in duration-75"
									x-transition:leave-start="transform opacity-100 scale-100"
									x-transition:leave-end="transform opacity-0 scale-95"
									class="origin-top-right absolute right-0 mt-2 min-w-150 rounded-md shadow-lg"
									style="display: none;">

									<div class="rounded-md bg-white shadow-xs">
										<div class="px-4 py-3">
											<p class="text-sm leading-5">
												Signed in as </p>
											<p class="text-sm leading-5 font-medium text-gray-900">
												vkspwr88@gmail.com </p>
										</div>
										<div class="border-t border-gray-100"></div>
										<div class="py-1">
											<a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
												href="https://eduwik.com/affiliate-area/settings/">Settings</a>
										</div>
										<div class="border-t border-gray-100"></div>
										<div class="py-1">
											<a class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
												href="https://eduwik.com/wp-login.php?action=logout&amp;redirect_to=https%3A%2F%2Feduwik.com%2Faffiliate-area%2F&amp;_wpnonce=518a503456">
												Sign out </a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

				<main id="portal-content-wrap" class="flex-1 relative overflow-y-auto py-6 focus:outline-none"
					tabindex="0" x-data="" x-init="$el.focus()">
					<div id="affiliate-portal-content" class="max-w-7xl mx-auto px-4 pb-8 sm:px-6 md:px-8">
						<h1 id="home-head" class="text-3xl font-semibold text-gray-900 mb-5 sm:mb-10">Welcome Vikas</h1>
						<div class="mt-10 sm:mt-0">
							<div class="md:grid md:grid-cols-3 md:gap-6">
								<div class="mt-5 md:mt-0 overflow-hidden sm:rounded-md md:col-span-3 lg:col-span-3">
									<div>
										<div class="setting card_control-control">
											<div>
												<h3 id="last_30_days_card_group-head"
													class="text-lg font-medium leading-6 text-gray-900 mb-2">
													Last 30 days</h3>
												<div class="grid gap-5 grid-cols-1 mb-10 md:grid-cols-2 lg:grid-cols-3">
													<div
														class="bg-white overflow-hidden shadow rounded-lg flex flex-col place-content-between">
														<div class="px-4 py-5 sm:p-6 flex items-center">
															<div class="flex-shrink-0 text-gray-400"><svg
																	id="last_30_days_card_group-card-0-icon"
																	class="h-8 w-8" fill="none" viewBox="0 0 24 24"
																	stroke="currentColor">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2"
																		d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
																	</path>
																</svg></div>
															<div class="flex-1 ml-4 w-0">
																<dl>
																	<dt
																		class="text-sm leading-5 font-medium text-gray-500 truncate">
																		Referrals</dt>
																	<dd class="flex items-baseline">
																		<div
																			class="text-3xl leading-8 font-semibold text-gray-900">
																			1</div>
																	</dd>
																</dl>
															</div>
														</div>
														<div class="bg-gray-50 px-4 py-4 sm:px-6 text-sm leading-5"><a
																class="font-medium text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150"
																href="https://eduwik.com/affiliate-area/referrals/"
																id="last_30_days_card_group-card-0-link"> View all</a>
														</div>
													</div>
													<div
														class="bg-white overflow-hidden shadow rounded-lg flex flex-col place-content-between">
														<div class="px-4 py-5 sm:p-6 flex items-center">
															<div class="flex-shrink-0 text-gray-400"><svg
																	id="last_30_days_card_group-card-1-icon"
																	class="h-8 w-8" fill="none" viewBox="0 0 24 24"
																	stroke="currentColor">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2"
																		d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
																	</path>
																</svg></div>
															<div class="flex-1 ml-4 w-0">
																<dl>
																	<dt
																		class="text-sm leading-5 font-medium text-gray-500 truncate">
																		Visits</dt>
																	<dd class="flex items-baseline">
																		<div
																			class="text-3xl leading-8 font-semibold text-gray-900">
																			3346</div>
																		<div
																			class="ml-2 flex items-baseline text-sm leading-5 font-semibold text-green-600">
																			<svg class="self-center flex-shrink-0 h-4 w-4 text-green-500 h-5 w-5"
																				id="last_30_days_card_group-card-1-compare-icon"
																				fill="currentColor" viewBox="0 0 20 20">
																				<path fill-rule="evenodd"
																					d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z"
																					clip-rule="evenodd"></path>
																			</svg><span class="sr-only">Increased
																				by</span>4.8%
																		</div>
																	</dd>
																</dl>
															</div>
														</div>
														<div class="bg-gray-50 px-4 py-4 sm:px-6 text-sm leading-5"><a
																class="font-medium text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150"
																href="https://eduwik.com/affiliate-area/visits/"
																id="last_30_days_card_group-card-1-link"> View all</a>
														</div>
													</div>
													<div
														class="bg-white overflow-hidden shadow rounded-lg flex flex-col place-content-between">
														<div class="px-4 py-5 sm:p-6 flex items-center">
															<div class="flex-shrink-0 text-gray-400"><svg
																	id="last_30_days_card_group-card-2-icon"
																	class="h-8 w-8" fill="none" viewBox="0 0 24 24"
																	stroke="currentColor">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2"
																		d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3">
																	</path>
																</svg></div>
															<div class="flex-1 ml-4 w-0">
																<dl>
																	<dt
																		class="text-sm leading-5 font-medium text-gray-500 truncate">
																		Conversion Rate</dt>
																	<dd class="flex items-baseline">
																		<div
																			class="text-3xl leading-8 font-semibold text-gray-900">
																			0.03%</div>
																		<div
																			class="ml-2 flex items-baseline text-sm leading-5 font-semibold text-red-600">
																			<svg class="self-center flex-shrink-0 h-4 w-4 text-red-500 h-5 w-5"
																				id="last_30_days_card_group-card-2-compare-icon"
																				fill="currentColor" viewBox="0 0 20 20">
																				<path fill-rule="evenodd"
																					d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z"
																					clip-rule="evenodd"></path>
																			</svg><span class="sr-only">Decreased
																				by</span>4.8%
																		</div>
																	</dd>
																</dl>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="setting card_control-control mt-5">
											<div>
												<h3 id="all_time_card_group-head"
													class="text-lg font-medium leading-6 text-gray-900 mb-2">
													All-time</h3>
												<div class="grid gap-5 grid-cols-1 mb-10 md:grid-cols-2 lg:grid-cols-4">
													<div
														class="bg-white overflow-hidden shadow rounded-lg flex flex-col place-content-between">
														<div class="px-4 py-5 sm:p-6 flex items-center">
															<div class="flex-shrink-0 text-gray-400"><svg
																	id="all_time_card_group-card-0-icon" class="h-8 w-8"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2"
																		d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
																	</path>
																</svg></div>
															<div class="flex-1 ml-4 w-0">
																<dl>
																	<dt
																		class="text-sm leading-5 font-medium text-gray-500 truncate">
																		Referrals</dt>
																	<dd class="flex items-baseline">
																		<div
																			class="text-3xl leading-8 font-semibold text-gray-900">
																			62</div>
																	</dd>
																</dl>
															</div>
														</div>
														<div class="bg-gray-50 px-4 py-4 sm:px-6 text-sm leading-5"><a
																class="font-medium text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150"
																href="https://eduwik.com/affiliate-area/referrals/"
																id="all_time_card_group-card-0-link"> View all</a></div>
													</div>
													<div
														class="bg-white overflow-hidden shadow rounded-lg flex flex-col place-content-between">
														<div class="px-4 py-5 sm:p-6 flex items-center">
															<div class="flex-shrink-0 text-gray-400"><svg
																	id="all_time_card_group-card-1-icon" class="h-8 w-8"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2"
																		d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
																	</path>
																</svg></div>
															<div class="flex-1 ml-4 w-0">
																<dl>
																	<dt
																		class="text-sm leading-5 font-medium text-gray-500 truncate">
																		Visits</dt>
																	<dd class="flex items-baseline">
																		<div
																			class="text-3xl leading-8 font-semibold text-gray-900">
																			91392</div>
																	</dd>
																</dl>
															</div>
														</div>
														<div class="bg-gray-50 px-4 py-4 sm:px-6 text-sm leading-5"><a
																class="font-medium text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150"
																href="https://eduwik.com/affiliate-area/visits/"
																id="all_time_card_group-card-1-link">
																View all</a></div>
													</div>
													<div
														class="bg-white overflow-hidden shadow rounded-lg flex flex-col place-content-between">
														<div class="px-4 py-5 sm:p-6 flex items-center">
															<div class="flex-shrink-0 text-gray-400"><svg
																	id="all_time_card_group-card-2-icon" class="h-8 w-8"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2"
																		d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3">
																	</path>
																</svg></div>
															<div class="flex-1 ml-4 w-0">
																<dl>
																	<dt
																		class="text-sm leading-5 font-medium text-gray-500 truncate">
																		Conversion Rate</dt>
																	<dd class="flex items-baseline">
																		<div
																			class="text-3xl leading-8 font-semibold text-gray-900">
																			0.07%</div>
																	</dd>
																</dl>
															</div>
														</div>
													</div>
													<div
														class="bg-white overflow-hidden shadow rounded-lg flex flex-col place-content-between">
														<div class="px-4 py-5 sm:p-6 flex items-center">
															<div class="flex-shrink-0 text-gray-400"><svg
																	id="all_time_card_group-card-3-icon" class="h-8 w-8"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2"
																		d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
																	</path>
																</svg></div>
															<div class="flex-1 ml-4 w-0">
																<dl>
																	<dt
																		class="text-sm leading-5 font-medium text-gray-500 truncate">
																		Unpaid Referrals</dt>
																	<dd class="flex items-baseline">
																		<div
																			class="text-3xl leading-8 font-semibold text-gray-900">
																			62</div>
																	</dd>
																</dl>
															</div>
														</div>
														<div class="bg-gray-50 px-4 py-4 sm:px-6 text-sm leading-5"><a
																class="font-medium text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150"
																href="https://eduwik.com/affiliate-area/referrals/"
																id="all_time_card_group-card-3-link"> View all</a></div>
													</div>
													<div
														class="bg-white overflow-hidden shadow rounded-lg flex flex-col place-content-between">
														<div class="px-4 py-5 sm:p-6 flex items-center">
															<div class="flex-shrink-0 text-gray-400"><svg
																	id="all_time_card_group-card-4-icon" class="h-8 w-8"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2"
																		d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
																	</path>
																</svg></div>
															<div class="flex-1 ml-4 w-0">
																<dl>
																	<dt
																		class="text-sm leading-5 font-medium text-gray-500 truncate">
																		Paid Referrals</dt>
																	<dd class="flex items-baseline">
																		<div
																			class="text-3xl leading-8 font-semibold text-gray-900">
																			0</div>
																	</dd>
																</dl>
															</div>
														</div>
														<div class="bg-gray-50 px-4 py-4 sm:px-6 text-sm leading-5"><a
																class="font-medium text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150"
																href="https://eduwik.com/affiliate-area/referrals/"
																id="all_time_card_group-card-4-link"> View all</a></div>
													</div>
													<div
														class="bg-white overflow-hidden shadow rounded-lg flex flex-col place-content-between">
														<div class="px-4 py-5 sm:p-6 flex items-center">
															<div class="flex-shrink-0 text-gray-400"><svg
																	id="all_time_card_group-card-5-icon" class="h-8 w-8"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2"
																		d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
																	</path>
																</svg></div>
															<div class="flex-1 ml-4 w-0">
																<dl>
																	<dt
																		class="text-sm leading-5 font-medium text-gray-500 truncate">
																		Unpaid Earnings</dt>
																	<dd class="flex items-baseline">
																		<div
																			class="text-3xl leading-8 font-semibold text-gray-900">
																			$678.53</div>
																	</dd>
																</dl>
															</div>
														</div>
													</div>
													<div
														class="bg-white overflow-hidden shadow rounded-lg flex flex-col place-content-between">
														<div class="px-4 py-5 sm:p-6 flex items-center">
															<div class="flex-shrink-0 text-gray-400"><svg
																	id="all_time_card_group-card-6-icon" class="h-8 w-8"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2"
																		d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
																	</path>
																</svg></div>
															<div class="flex-1 ml-4 w-0">
																<dl>
																	<dt
																		class="text-sm leading-5 font-medium text-gray-500 truncate">
																		Total Earnings</dt>
																	<dd class="flex items-baseline">
																		<div
																			class="text-3xl leading-8 font-semibold text-gray-900">
																			$0.00</div>
																	</dd>
																</dl>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="setting table-control mt-5">
											<h3 id="referral-activity-table-head"
												class="text-lg font-medium leading-6 text-gray-900 mb-2">
												Recent referral activity</h3>
											<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 mb-10">
												<div x-data="AFFWP.portal.table.default({ & quot;perPage & quot;: 5, & quot;showPagination & quot;: false, & quot;allowSorting & quot;: false, & quot;orderby & quot;: & quot;date & quot;, & quot;type & quot;: & quot;referral - activity - table & quot; })"
													x-init="init()" x-show="!isLoading">
													<div class="flex flex-col">
														<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 lg:-mx-8 mt-4">
															<div
																class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
																<table class="min-w-full">
																	<thead>
																		<tr><template x-for="(heading, index) in schema"
																				:key="index">
																				<th class="px-6 py-3 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
																					x-on:click="handleOrderEvent( $event, heading.id )"
																					:class="{ & quot;
                                            cursor - pointer & quot;: true === allowSorting }">
																					<div class="flex"><span
																							x-text="heading.title"></span><svg
																							class="ml-1 text-gray-500 h-5 w-5"
																							id="referral-activity-table-sort-desc-icon"
																							x-show="'desc' === getSortOrder(heading.id)"
																							fill="none"
																							viewBox="0 0 24 24"
																							stroke="currentColor">
																							<path stroke-linecap="round"
																								stroke-linejoin="round"
																								stroke-width="2"
																								d="M19 9l-7 7-7-7">
																							</path>
																						</svg><svg
																							class="ml-1 text-gray-500 h-5 w-5"
																							id="referral-activity-table-sort-asc-icon"
																							x-show="'asc' === getSortOrder(heading.id)"
																							fill="none"
																							viewBox="0 0 24 24"
																							stroke="currentColor">
																							<path stroke-linecap="round"
																								stroke-linejoin="round"
																								stroke-width="2"
																								d="M5 15l7-7 7 7">
																							</path>
																						</svg></div>
																				</th>
																			</template>
																			<th class="px-6 py-3 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
																				x-on:click="handleOrderEvent( $event, heading.id )"
																				:class="{ & quot;
                                          cursor - pointer & quot;: true === allowSorting }">
																				<div class="flex"><span
																						x-text="heading.title">Reference</span><svg
																						class="ml-1 text-gray-500 h-5 w-5"
																						id="referral-activity-table-sort-desc-icon"
																						x-show="'desc' === getSortOrder(heading.id)"
																						fill="none" viewBox="0 0 24 24"
																						stroke="currentColor"
																						style="display: none;">
																						<path stroke-linecap="round"
																							stroke-linejoin="round"
																							stroke-width="2"
																							d="M19 9l-7 7-7-7"></path>
																					</svg><svg
																						class="ml-1 text-gray-500 h-5 w-5"
																						id="referral-activity-table-sort-asc-icon"
																						x-show="'asc' === getSortOrder(heading.id)"
																						fill="none" viewBox="0 0 24 24"
																						stroke="currentColor"
																						style="display: none;">
																						<path stroke-linecap="round"
																							stroke-linejoin="round"
																							stroke-width="2"
																							d="M5 15l7-7 7 7"></path>
																					</svg></div>
																			</th>
																			<th class="px-6 py-3 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
																				x-on:click="handleOrderEvent( $event, heading.id )"
																				:class="{ & quot;
                                          cursor - pointer & quot;: true === allowSorting }">
																				<div class="flex"><span
																						x-text="heading.title">Amount</span><svg
																						class="ml-1 text-gray-500 h-5 w-5"
																						id="referral-activity-table-sort-desc-icon"
																						x-show="'desc' === getSortOrder(heading.id)"
																						fill="none" viewBox="0 0 24 24"
																						stroke="currentColor"
																						style="display: none;">
																						<path stroke-linecap="round"
																							stroke-linejoin="round"
																							stroke-width="2"
																							d="M19 9l-7 7-7-7"></path>
																					</svg><svg
																						class="ml-1 text-gray-500 h-5 w-5"
																						id="referral-activity-table-sort-asc-icon"
																						x-show="'asc' === getSortOrder(heading.id)"
																						fill="none" viewBox="0 0 24 24"
																						stroke="currentColor"
																						style="display: none;">
																						<path stroke-linecap="round"
																							stroke-linejoin="round"
																							stroke-width="2"
																							d="M5 15l7-7 7 7"></path>
																					</svg></div>
																			</th>
																			<th class="px-6 py-3 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
																				x-on:click="handleOrderEvent( $event, heading.id )"
																				:class="{ & quot;
                                          cursor - pointer & quot;: true === allowSorting }">
																				<div class="flex"><span
																						x-text="heading.title">Description</span><svg
																						class="ml-1 text-gray-500 h-5 w-5"
																						id="referral-activity-table-sort-desc-icon"
																						x-show="'desc' === getSortOrder(heading.id)"
																						fill="none" viewBox="0 0 24 24"
																						stroke="currentColor"
																						style="display: none;">
																						<path stroke-linecap="round"
																							stroke-linejoin="round"
																							stroke-width="2"
																							d="M19 9l-7 7-7-7"></path>
																					</svg><svg
																						class="ml-1 text-gray-500 h-5 w-5"
																						id="referral-activity-table-sort-asc-icon"
																						x-show="'asc' === getSortOrder(heading.id)"
																						fill="none" viewBox="0 0 24 24"
																						stroke="currentColor"
																						style="display: none;">
																						<path stroke-linecap="round"
																							stroke-linejoin="round"
																							stroke-width="2"
																							d="M5 15l7-7 7 7"></path>
																					</svg></div>
																			</th>
																			<th class="px-6 py-3 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
																				x-on:click="handleOrderEvent( $event, heading.id )"
																				:class="{ & quot;
                                          cursor - pointer & quot;: true === allowSorting }">
																				<div class="flex"><span
																						x-text="heading.title">Status</span><svg
																						class="ml-1 text-gray-500 h-5 w-5"
																						id="referral-activity-table-sort-desc-icon"
																						x-show="'desc' === getSortOrder(heading.id)"
																						fill="none" viewBox="0 0 24 24"
																						stroke="currentColor"
																						style="display: none;">
																						<path stroke-linecap="round"
																							stroke-linejoin="round"
																							stroke-width="2"
																							d="M19 9l-7 7-7-7"></path>
																					</svg><svg
																						class="ml-1 text-gray-500 h-5 w-5"
																						id="referral-activity-table-sort-asc-icon"
																						x-show="'asc' === getSortOrder(heading.id)"
																						fill="none" viewBox="0 0 24 24"
																						stroke="currentColor"
																						style="display: none;">
																						<path stroke-linecap="round"
																							stroke-linejoin="round"
																							stroke-width="2"
																							d="M5 15l7-7 7 7"></path>
																					</svg></div>
																			</th>
																			<th class="px-6 py-3 border-b border-gray-200 bg-white text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
																				x-on:click="handleOrderEvent( $event, heading.id )"
																				:class="{ & quot;
                                          cursor - pointer & quot;: true === allowSorting }">
																				<div class="flex"><span
																						x-text="heading.title">Date</span><svg
																						class="ml-1 text-gray-500 h-5 w-5"
																						id="referral-activity-table-sort-desc-icon"
																						x-show="'desc' === getSortOrder(heading.id)"
																						fill="none" viewBox="0 0 24 24"
																						stroke="currentColor"
																						style="display: none;">
																						<path stroke-linecap="round"
																							stroke-linejoin="round"
																							stroke-width="2"
																							d="M19 9l-7 7-7-7"></path>
																					</svg><svg
																						class="ml-1 text-gray-500 h-5 w-5"
																						id="referral-activity-table-sort-asc-icon"
																						x-show="'asc' === getSortOrder(heading.id)"
																						fill="none" viewBox="0 0 24 24"
																						stroke="currentColor"
																						style="display: none;">
																						<path stroke-linecap="round"
																							stroke-linejoin="round"
																							stroke-width="2"
																							d="M5 15l7-7 7 7"></path>
																					</svg></div>
																			</th>
																		</tr>
																	</thead>
																	<tbody class="bg-white divide-y divide-gray-200">
																		<template x-for="(row, index) in rows"
																			:key="index">
																			<tr><template
																					x-for="(heading, headingIndex) in schema"
																					:key="headingIndex">
																					<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																						x-html="getCell(index, heading.id)">
																					</td>
																				</template></tr>
																		</template>
																		<tr><template
																				x-for="(heading, headingIndex) in schema"
																				:key="headingIndex">
																				<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																					x-html="getCell(index, heading.id)">
																				</td>
																			</template>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				27995</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				$5.80</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				<span class="whitespace-normal">How to
																					Design Architecture Portfolio</span>
																			</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				<span
																					class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Unpaid</span>
																			</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				April 25, 2024 8:00 pm</td>
																		</tr>
																		<tr><template
																				x-for="(heading, headingIndex) in schema"
																				:key="headingIndex">
																				<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																					x-html="getCell(index, heading.id)">
																				</td>
																			</template>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				25740</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				$6.34</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				<span class="whitespace-normal">How to
																					Design Architecture Portfolio</span>
																			</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				<span
																					class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Unpaid</span>
																			</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				March 14, 2024 3:58 pm</td>
																		</tr>
																		<tr><template
																				x-for="(heading, headingIndex) in schema"
																				:key="headingIndex">
																				<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																					x-html="getCell(index, heading.id)">
																				</td>
																			</template>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				23001</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				$4.58</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				<span class="whitespace-normal">The
																					Ultimate
																					Thesis Guide</span></td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				<span
																					class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Unpaid</span>
																			</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				December 19, 2023 7:56 pm</td>
																		</tr>
																		<tr><template
																				x-for="(heading, headingIndex) in schema"
																				:key="headingIndex">
																				<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																					x-html="getCell(index, heading.id)">
																				</td>
																			</template>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				22999</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				$11.60</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				<span class="whitespace-normal">How to
																					Design Architecture Portfolio, How
																					to Design Affordable Housing</span>
																			</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				<span
																					class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Unpaid</span>
																			</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				December 10, 2023 4:24 pm</td>
																		</tr>
																		<tr><template
																				x-for="(heading, headingIndex) in schema"
																				:key="headingIndex">
																				<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																					x-html="getCell(index, heading.id)">
																				</td>
																			</template>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				22981</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				$4.56</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				<span class="whitespace-normal">The
																					Ultimate
																					Thesis Guide</span></td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				<span
																					class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Unpaid</span>
																			</td>
																			<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-500"
																				x-html="getCell(index, heading.id)">
																				October 15, 2023 3:18 pm</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<div class="px-4 py-3 flex items-center justify-between sm:px-6"
														x-show="showPagination" style="display: none;">
														<nav
															class="affwp-pagination relative z-0 inline-flex shadow-sm">
															<a class="prev page-numbers flex items-center disabled"
																role="button" id="referral-activity-table-prev-link"
																x-bind:href="urlForPage(previousPage)"
																x-on:click="handlePageEvent( $event, previousPage )"
																:class="{ 'disabled': currentPage <= 1 }"
																href="https://eduwik.com/affiliate-area/?orderby=date"><svg
																	id="referral-activity-table-prev-link-icon"
																	class="mr-3 h-5 w-5" fill="currentColor"
																	viewBox="0 0 20 20">
																	<path fill-rule="evenodd"
																		d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
																		clip-rule="evenodd"></path>
																</svg> </a><template x-for="pageObject in getPages()"
																:key="pageObject.page"><a class="page-numbers"
																	role="button"
																	id="referral-activity-table-page-numbers"
																	x-bind:href="urlForPage(pageObject.page)"
																	x-on:click="handlePageEvent( $event, pageObject.page )"
																	:class="{ 'disabled': pageObject.disabled }"
																	x-text="pageObject.page"> </a></template><a
																class="next page-numbers flex items-center"
																role="button" id="referral-activity-table-next-link"
																x-bind:href="urlForPage(nextPage)"
																x-on:click="handlePageEvent( $event, nextPage )"
																:class="{ 'disabled': currentPage === pages }"
																href="https://eduwik.com/affiliate-area/11/?orderby=date"><svg
																	id="referral-activity-table-next-link-icon"
																	class="mr-3 h-5 w-5" fill="currentColor"
																	viewBox="0 0 20 20">
																	<path fill-rule="evenodd"
																		d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
																		clip-rule="evenodd"></path>
																</svg> </a></nav>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
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
