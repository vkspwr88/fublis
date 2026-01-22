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
				<button x-show="sidebarOpen" @click="sidebarOpen = false" class="flex items-center justify-center w-12 h-12 rounded-full focus:outline-none focus:bg-gray-600" aria-label="Close sidebar" style="display: none;">
					<svg id="close" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
					</svg>
				</button>
			</div>

			@include('users.includes.affiliates.nav')

		</div>
		<div class="flex-shrink-0 w-14"></div>
	</div>
</div>

<div class="hidden md:flex md:flex-shrink-0">
	<div class="flex flex-col w-64">
		@include('users.includes.affiliates.nav')
	</div>
</div>
