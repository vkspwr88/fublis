<div x-show="sidebarOpen" class="md:hidden" style="display: none;">
	<div class="fixed inset-0 z-40 flex">
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
			class="relative flex flex-col flex-1 w-full max-w-xs pb-4 bg-gray-800 pt-5b"
			style="display: none;">
			<div class="absolute top-0 right-0 p-1 -mr-14">
				<button x-show="sidebarOpen" @click="sidebarOpen = false"
					class="flex items-center justify-center w-12 h-12 rounded-full focus:outline-none focus:bg-gray-600"
					aria-label="Close sidebar" style="display: none;">
					<svg id="close" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24"
						stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M6 18L18 6M6 6l12 12"></path>
					</svg> </button>
			</div>

			<div class="flex items-center flex-shrink-0 h-16 px-4 bg-gray-800">
				<span class="text-white">Eduwik</span>
			</div>

			<div class="px-2 bg-gray-800 ">
				<a class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-400 transition duration-150 ease-in-out group focus:outline-none hover:text-gray-300"
					href="https://eduwik.com" id="back-to-site-link"><svg id="back-to-site-link-icon"
						class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path>
					</svg> Back to site</a>
			</div>

			<div class="flex-1 h-0 mt-5 overflow-y-auto">
				<nav class="px-2">
					<a class="flex items-center px-2 py-2 mt-1 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-gray-900 rounded-md group focus:outline-none focus:bg-gray-700"
						href="https://eduwik.com/affiliate-area/" id="home_nav_item"><svg
							stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
							class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
							fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
							</path>
						</svg> Dashboard</a> <a
						class="flex items-center px-2 py-2 mt-1 text-base font-medium leading-6 text-gray-300 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-700"
						href="https://eduwik.com/affiliate-area/urls/" id="urls_nav_item"><svg
							stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
							class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
							fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
							</path>
						</svg> Affiliate URLs</a> <a
						class="flex items-center px-2 py-2 mt-1 text-base font-medium leading-6 text-gray-300 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-700"
						href="https://eduwik.com/affiliate-area/stats/" id="stats_nav_item"><svg
							stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
							class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
							fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
						</svg> Statistics</a> <a
						class="flex items-center px-2 py-2 mt-1 text-base font-medium leading-6 text-gray-300 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-700"
						href="https://eduwik.com/affiliate-area/graphs/" id="graphs_nav_item"><svg
							stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
							class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
							fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
							</path>
						</svg> Graphs</a> <a
						class="flex items-center px-2 py-2 mt-1 text-base font-medium leading-6 text-gray-300 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-700"
						href="https://eduwik.com/affiliate-area/referrals/" id="referrals_nav_item"><svg
							stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
							class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
							fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
							</path>
						</svg> Referrals</a> <a
						class="flex items-center px-2 py-2 mt-1 text-base font-medium leading-6 text-gray-300 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-700"
						href="https://eduwik.com/affiliate-area/payouts/" id="payouts_nav_item"><svg
							stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
							class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
							fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
							</path>
						</svg> Payouts</a> <a
						class="flex items-center px-2 py-2 mt-1 text-base font-medium leading-6 text-gray-300 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-700"
						href="https://eduwik.com/affiliate-area/visits/" id="visits_nav_item"><svg
							stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
							class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
							fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
							</path>
						</svg> Visits</a> <a
						class="flex items-center px-2 py-2 mt-1 text-base font-medium leading-6 text-gray-300 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-700"
						href="https://eduwik.com/affiliate-area/coupons/" id="coupons_nav_item"><svg
							stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
							class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
							fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
							</path>
						</svg> Coupons</a> <a
						class="flex items-center px-2 py-2 mt-1 text-base font-medium leading-6 text-gray-300 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-700"
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

					<a class="flex items-center px-2 py-2 mt-1 text-base font-medium leading-6 text-gray-300 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-700"
						href="https://eduwik.com/tutorials/" target="_blank" id="2_menu_link_nav_item"><svg
							class="mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
							id="2_menu_link_icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
							</path>
						</svg> Get Started</a><a
						class="flex items-center px-2 py-2 mt-1 text-base font-medium leading-6 text-gray-300 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-700"
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
		<div class="flex items-center flex-shrink-0 h-16 px-4 bg-gray-800">
			<span class="text-white">
				Eduwik </span>
		</div>
		<div class="pl-2 bg-gray-800 ">
			<a class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-400 transition duration-150 ease-in-out group focus:outline-none hover:text-gray-300"
				href="https://eduwik.com" id="back-to-site-link"><svg id="back-to-site-link-icon"
					class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path>
				</svg> Back to site</a>
		</div>
		<div class="flex flex-col flex-1 h-0 overflow-y-auto">
			<nav class="flex-1 px-2 py-4 bg-gray-800">
				<a class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-gray-900 rounded-md group focus:outline-none focus:bg-gray-700" href="{{ route('affiliate.dashboard') }}" id="home_nav_item">
					<svg stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon" class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
						</path>
					</svg>
					Dashboard
				</a>
				<a class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-300 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-700"
					href="{{ route('affiliate.urls') }}" id="urls_nav_item"><svg
						stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
						class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
						fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
						</path>
					</svg> Affiliate URLs</a> <a
					class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-300 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-700"
					href="{{ route('affiliate.stats') }}" id="stats_nav_item"><svg
						stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
						class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
						fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
					</svg> Statistics</a> <a
					class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-300 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-700"
					href="{{ route('affiliate.graphs') }}" id="graphs_nav_item"><svg
						stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
						class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
						fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
						</path>
					</svg> Graphs</a> <a
					class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-300 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-700"
					href="{{ route('affiliate.referrals') }}" id="referrals_nav_item"><svg
						stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
						class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
						fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
						</path>
					</svg> Referrals</a> <a
					class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-300 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-700"
					href="{{ route('affiliate.payouts') }}" id="payouts_nav_item"><svg
						stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
						class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
						fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
						</path>
					</svg> Payouts</a> <a
					class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-300 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 hover:text-white focus:text-white hover:bg-gray-700"
					href="{{ route('affiliate.visits') }}" id="visits_nav_item"><svg
						stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon"
						class="mr-3 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5 mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300 h-5 w-5"
						fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
						</path>
					</svg> Visits</a>

			</nav>
		</div>
	</div>
</div>
