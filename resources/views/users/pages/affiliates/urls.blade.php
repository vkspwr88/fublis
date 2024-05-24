@extends('users.layouts.affiliates.master')

@section('body')
	<h1 id="urls-head" class="mb-5 text-3xl font-semibold text-gray-900 sm:mb-10">Affiliate URLs</h1>
	<div class="mt-10 sm:mt-0" x-show="!isLoading">
		<div class="md:grid md:grid-cols-3 md:gap-6">
			<div id="referral-url" class="md:col-span-1">
				<h2 id="section-heading" class="mb-3 text-xl font-medium leading-6 text-gray-900">Referral URL</h2>
				<p class="mt-2 text-sm leading-5 text-gray-600" id="section-desc">Share your referral URL with your
					audience to earn commission.</p>
			</div>
			<div class="mt-5 overflow-hidden shadow md:mt-0 sm:rounded-md md:col-span-2">
				<div class="p-4 bg-white sm:p-6">
					<div class="setting div_with_copy-control">
						<div class="border border-gray-200 rounded-md">
							<div class="flex items-center justify-between py-3 pl-3 pr-4 text-sm leading-5">
								<div class="flex flex-wrap items-center flex-1 w-0"><svg
										class="flex-shrink-0 w-5 h-5 text-gray-400" id="referral-url-icon" fill="none"
										viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
										</path>
									</svg><span class="flex-1 w-0 ml-2 break-words sm:truncate"
										x-text="getUrlParam( 'referral', 'url' )">https://eduwik.com/ref/eduwik_af/</span>
									<div class="w-full mt-2 text-center sm:ml-4 sm:flex-shrink-0 sm:w-auto sm:mt-0">
										<button type="button" value=""
											class="ml-2 font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500"
											id="referral-url-copy" @click="setCopy('referral')"
											x-text="getUrlParam('referral','copyMessage')">Copy link</button></div>
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
				<h2 id="section-heading" class="mb-3 text-xl font-medium leading-6 text-gray-900">Referral URL generator
				</h2>
				<p class="mt-2 text-sm leading-5 text-gray-600" id="section-desc">Use this form to generate a referral
					link.</p>
			</div>
			<div class="mt-5 overflow-hidden shadow md:mt-0 sm:rounded-md md:col-span-2">
				<div class="p-4 bg-white sm:p-6">
					<div class="setting input-control"><label for="affwp-url" id="affwp-url-label">Page URL</label>
						<p class="mb-2 text-sm leading-5 text-gray-500" id="affwp-url-desc"></p>
						<div class="relative"><input type="text" aria-describedby="message-error" name="affwp-url"
								id="affwp-url"
								class="block w-full px-3 py-2 mt-1 transition duration-150 ease-in-out border border-gray-300 rounded-md shadow-sm form-input sm:text-sm sm:leading-5 focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
								:class="{ 'border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red': getUrlParam('generated','isError') === true,
																    'focus:shadow-outline-blue focus:border-blue-300 focus:outline-none border-gray-300': getUrlParam('generated','isError') !== true  }"
								:aria-invalid="!getUrlParam('generated','isError')" @input="generateUrl('generated')"
								x-model="inputUrl" aria-invalid="true">
							<div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none"
								x-show="getUrlParam('generated','isError')" style="display: none;"><svg
									class="w-5 h-5 text-red-500" id="affwp-url-error-icon" fill="currentColor"
									viewBox="0 0 20 20">
									<path fill-rule="evenodd"
										d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
										clip-rule="evenodd"></path>
								</svg></div>
						</div>
					</div>
					<div class="mt-5 setting input-control"><label for="affwp-campaign"
							id="affwp-campaign-label">Campaign name</label>
						<p class="mb-2 text-sm leading-5 text-gray-500" id="affwp-campaign-desc">Enter an optional
							campaign name to help track performance.</p><input type="text" id="affwp-campaign"
							name="campaign-name"
							class="block w-full px-3 py-2 mt-1 transition duration-150 ease-in-out border border-gray-300 rounded-md shadow-sm form-input sm:text-sm sm:leading-5 focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
							x-model="campaign" @input="generateUrl(&quot;generated&quot;)">
					</div>
					<div class="mt-5 setting div_with_copy-control"><label id="generated-referral-url-label">Generated
							referral URL</label>
						<p class="mb-2 text-sm leading-5 text-gray-500" id="generated-referral-url-desc">Share this URL
							with your audience.</p>
						<div class="border border-gray-200 rounded-md">
							<div class="flex items-center justify-between py-3 pl-3 pr-4 text-sm leading-5">
								<div class="flex flex-wrap items-center flex-1 w-0"><svg
										class="flex-shrink-0 w-5 h-5 text-gray-400" id="generated-referral-url-icon"
										fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
										</path>
									</svg><span class="flex-1 w-0 ml-2 break-words sm:truncate"
										x-show="!getUrlParam('generated','isError')"
										x-text="getUrlParam('generated','url')">https://eduwik.com/ref/eduwik_af/</span>
									<div class="w-full mt-2 text-center sm:ml-4 sm:flex-shrink-0 sm:w-auto sm:mt-0">
										<button type="button" value=""
											class="ml-2 font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500"
											id="generated-referral-url-copy" @click="setCopy('generated')"
											x-text="getUrlParam('generated','copyMessage')">Copy link</button></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
