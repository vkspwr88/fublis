<div class="relative z-10 flex flex-shrink-0 h-16 bg-white">
	<button @click.stop="sidebarOpen = true"
		class="px-4 text-gray-500 border-r border-gray-200 focus:outline-none focus:bg-gray-100 focus:text-gray-600 md:hidden"
		aria-label="Open sidebar">
		<svg id="open_sidebar" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
				d="M4 6h16M4 12h16M4 18h7"></path>
		</svg> </button>
	<div class="flex justify-between flex-1 px-4">
		<div class="flex flex-1">
		</div>
		<div class="flex items-center ml-4 md:ml-6">

			<div @click.away="open = false" class="relative ml-3" x-data="{ open: false }">
				<div>
					<button @click="open = !open"
						class="flex items-center max-w-xs text-sm rounded-full focus:outline-none focus:shadow-outline"
						id="user-menu" aria-label="User menu" aria-haspopup="true"
						x-bind:aria-expanded="open">
						<img alt=""
							src="https://secure.gravatar.com/avatar/0d1dc16b4aa79cb695f402f14fd7f122?s=96&amp;d=mm&amp;r=g"
							srcset="https://secure.gravatar.com/avatar/0d1dc16b4aa79cb695f402f14fd7f122?s=96&amp;d=mm&amp;r=g 2x"
							class="w-8 h-8 rounded-full avatar avatar-96 photo" height="96" width="96"
							loading="lazy" decoding="async"><svg class="w-5 h-5 ml-1 text-gray-500"
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
					class="absolute right-0 mt-2 origin-top-right rounded-md shadow-lg min-w-150"
					style="display: none;">

					<div class="bg-white rounded-md shadow-xs">
						<div class="px-4 py-3">
							<p class="text-sm leading-5">
								Signed in as </p>
							<p class="text-sm font-medium leading-5 text-gray-900">
								vkspwr88@gmail.com </p>
						</div>
						<div class="border-t border-gray-100"></div>
						<div class="py-1">
							<a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
								href="https://eduwik.com/affiliate-area/settings/">Settings</a>
						</div>
						<div class="border-t border-gray-100"></div>
						<div class="py-1">
							<a class="block w-full px-4 py-2 text-sm leading-5 text-left text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
								href="https://eduwik.com/wp-login.php?action=logout&amp;redirect_to=https%3A%2F%2Feduwik.com%2Faffiliate-area%2F&amp;_wpnonce=518a503456">
								Sign out </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
