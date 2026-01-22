<div class="mt-10 sm:mt-0"{{--  x-show="!isLoading" --}}>
	<div class="md:grid md:grid-cols-3 md:gap-6">
		<div id="referral-url" class="md:col-span-1">
			<h2 id="section-heading" class="mb-3 text-xl font-medium leading-6 text-gray-900">Referral URL</h2>
			<p class="mt-2 text-sm leading-5 text-gray-600" id="section-desc">Share your referral URL with your audience to earn commission.</p>
		</div>
		<div class="mt-5 overflow-hidden shadow md:mt-0 sm:rounded-md md:col-span-2">
			<div class="p-4 bg-white sm:p-6">
				<div class="setting div_with_copy-control">
					<div class="border border-gray-200 rounded-md">
						<div class="flex items-center justify-between py-3 pl-3 pr-4 text-sm leading-5">
							<div class="flex flex-wrap items-center flex-1 w-0">
								<svg class="flex-shrink-0 w-5 h-5 text-gray-400" id="referral-url-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
								</svg>
								<span class="flex-1 w-0 ml-2 break-words sm:truncate">{{ $affiliate_url }}</span>
								<div class="w-full mt-2 text-center sm:ml-4 sm:flex-shrink-0 sm:w-auto sm:mt-0">
									<button type="button" class="ml-2 font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500" id="referral-url-copy"{{--  @click="setCopy('referral')" x-text="getUrlParam('referral','copyMessage')" --}}>Copy link</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="py-8">
		<section class="border-t border-gray-200"></section>
	</div>
	<div class="md:grid md:grid-cols-3 md:gap-6">
		<div id="referral-url-generator" class="md:col-span-1">
			<h2 id="section-heading" class="mb-3 text-xl font-medium leading-6 text-gray-900">Referral URL generator</h2>
			<p class="mt-2 text-sm leading-5 text-gray-600" id="section-desc">Use this form to generate a referral link.</p>
		</div>
		<div class="mt-5 overflow-hidden shadow md:mt-0 sm:rounded-md md:col-span-2">
			<div class="p-4 bg-white sm:p-6">
				<div class="mt-5 setting input-control">
					<label for="affwp-campaign" id="affwp-campaign-label" for="affwp-campaign">Campaign name</label>
					<p class="mb-2 text-sm leading-5 text-gray-500" id="affwp-campaign-desc">Enter an optional campaign name to help track performance.</p>
					<input type="text" id="affwp-campaign" wire:model.live="campaign_name" class="block w-full px-3 py-2 mt-1 transition duration-150 ease-in-out border border-gray-300 rounded-md shadow-sm form-input sm:text-sm sm:leading-5 focus:outline-none focus:shadow-outline-blue focus:border-blue-300">
				</div>
				<div class="mt-5 setting div_with_copy-control">
					<label id="generated-referral-url-label" for="">Generated referral URL</label>
					<p class="mb-2 text-sm leading-5 text-gray-500" id="generated-referral-url-desc">Share this URL with your audience.</p>
					<div class="border border-gray-200 rounded-md">
						<div class="flex items-center justify-between py-3 pl-3 pr-4 text-sm leading-5">
							<div class="flex flex-wrap items-center flex-1 w-0">
								<svg class="flex-shrink-0 w-5 h-5 text-gray-400" id="generated-referral-url-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
								</svg>
								<span class="flex-1 w-0 ml-2 break-words sm:truncate">{{ $campaign_url }}</span>
								<div
									class="w-full mt-2 text-center sm:ml-4 sm:flex-shrink-0 sm:w-auto sm:mt-0"
									x-data="{
										link: '{{ $campaign_url }}',
										copied: false,
										copy () {
											console.log('copy');
											navigator.clipboard.writeText(link);
										  	copied = true;
											setTimeout(() => copied = false, 3000);
										}
									}"
								>
									<button x-on:click="copy" type="button" value="" class="ml-2 font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500" id="generated-referral-url-copy" x-text="copied ? `Copied!` : `Copy link`" {{-- @click="setCopy('generated')" x-text="getUrlParam('generated','copyMessage')" --}}>Copy link</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
