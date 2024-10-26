<div class="flex items-center flex-shrink-0 h-auto px-4 bg-gray-800">
	<img src="{{ asset(env('COMPANY_EMAIL_LOGO')) }}" alt="{{ env('APP_NAME') }}" style="width: 150px; margin-top: 5px;">
</div>
<div class="pl-2 bg-gray-800 ">
	<a class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-400 transition duration-150 ease-in-out group focus:outline-none hover:text-gray-300" href="{{ route('home') }}" id="back-to-site-link">
		<svg id="back-to-site-link-icon" class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path>
		</svg> Back to site
	</a>
</div>
<div class="flex flex-col flex-1 h-0 overflow-y-auto">
	@php
		$currentPage = Request::route()->getName();
		$activeClasses = 'text-white bg-gray-900';
		$inactiveClasses = 'text-gray-300 hover:text-white focus:text-white hover:bg-gray-700';
	@endphp
	<nav class="flex-1 px-2 py-4 bg-gray-800">
		<a class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 {{ $currentPage == 'affiliate.dashboard' ? $activeClasses : $inactiveClasses }}" href="{{ route('affiliate.dashboard') }}" id="home_nav_item">
			<svg stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon" class="mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
			</svg> Dashboard
		</a>
		<a class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 {{ $currentPage == 'affiliate.urls' ? $activeClasses : $inactiveClasses }}" href="{{ route('affiliate.urls') }}" id="urls_nav_item">
			<svg stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon" class="mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
			</svg> Affiliate URLs
		</a>
		<a class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 {{ $currentPage == 'affiliate.stats' ? $activeClasses : $inactiveClasses }}" href="{{ route('affiliate.stats') }}" id="stats_nav_item">
			<svg stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon" class="mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
			</svg> Statistics
		</a>
		<a class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 {{ $currentPage == 'affiliate.graphs' ? $activeClasses : $inactiveClasses }}" href="{{ route('affiliate.graphs') }}" id="graphs_nav_item">
			<svg stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon" class="mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
			</svg> Graphs
		</a>
		<a class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 {{ $currentPage == 'affiliate.referrals' ? $activeClasses : $inactiveClasses }}" href="{{ route('affiliate.referrals') }}" id="referrals_nav_item">
			<svg stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon" class="mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
			</svg> Referrals
		</a>
		<a class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 {{ $currentPage == 'affiliate.payouts' ? $activeClasses : $inactiveClasses }}" href="{{ route('affiliate.payouts') }}" id="payouts_nav_item">
			<svg stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon" class="mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
			</svg> Payouts
		</a>
		<a class="flex items-center px-2 py-2 mt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out rounded-md group focus:outline-none focus:bg-gray-700 {{ $currentPage == 'affiliate.visits' ? $activeClasses : $inactiveClasses }}" href="{{ route('affiliate.visits') }}" id="visits_nav_item">
			<svg stroke-linecap="round" stroke-linejoin="round" stroke-width="2" id="view_icon" class="mr-3 h-6 w-6 pt-0.5 transition ease-in-out duration-150 text-gray-300 group-focus:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
			</svg> Visits
		</a>
	</nav>
</div>
