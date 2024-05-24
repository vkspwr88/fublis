@extends('users.layouts.affiliates.master')

@section('body')
	<h1 id="home-head" class="mb-5 text-3xl font-semibold text-gray-900 sm:mb-10">Welcome Vikas</h1>
	<div class="mt-10 sm:mt-0">
		<div class="md:grid md:grid-cols-3 md:gap-6">
			<div class="mt-5 overflow-hidden md:mt-0 sm:rounded-md md:col-span-3 lg:col-span-3">
				<div>
					<div class="setting card_control-control">
						<div>
							<h3 id="last_30_days_card_group-head"
								class="mb-2 text-lg font-medium leading-6 text-gray-900">
								Last 30 days</h3>
							<div class="grid grid-cols-1 gap-5 mb-10 md:grid-cols-2 lg:grid-cols-3">
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-shrink-0 text-gray-400"><svg
												id="last_30_days_card_group-card-0-icon"
												class="w-8 h-8" fill="none" viewBox="0 0 24 24"
												stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round"
													stroke-width="2"
													d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
												</path>
											</svg></div>
										<div class="flex-1 w-0 ml-4">
											<dl>
												<dt
													class="text-sm font-medium leading-5 text-gray-500 truncate">
													Referrals</dt>
												<dd class="flex items-baseline">
													<div
														class="text-3xl font-semibold leading-8 text-gray-900">
														1</div>
												</dd>
											</dl>
										</div>
									</div>
									<div class="px-4 py-4 text-sm leading-5 bg-gray-50 sm:px-6"><a
											class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500"
											href="https://eduwik.com/affiliate-area/referrals/"
											id="last_30_days_card_group-card-0-link"> View all</a>
									</div>
								</div>
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-shrink-0 text-gray-400"><svg
												id="last_30_days_card_group-card-1-icon"
												class="w-8 h-8" fill="none" viewBox="0 0 24 24"
												stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round"
													stroke-width="2"
													d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
												</path>
											</svg></div>
										<div class="flex-1 w-0 ml-4">
											<dl>
												<dt
													class="text-sm font-medium leading-5 text-gray-500 truncate">
													Visits</dt>
												<dd class="flex items-baseline">
													<div
														class="text-3xl font-semibold leading-8 text-gray-900">
														3346</div>
													<div
														class="flex items-baseline ml-2 text-sm font-semibold leading-5 text-green-600">
														<svg class="self-center flex-shrink-0 w-4 w-5 h-4 h-5 text-green-500"
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
									<div class="px-4 py-4 text-sm leading-5 bg-gray-50 sm:px-6"><a
											class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500"
											href="https://eduwik.com/affiliate-area/visits/"
											id="last_30_days_card_group-card-1-link"> View all</a>
									</div>
								</div>
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-shrink-0 text-gray-400"><svg
												id="last_30_days_card_group-card-2-icon"
												class="w-8 h-8" fill="none" viewBox="0 0 24 24"
												stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round"
													stroke-width="2"
													d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3">
												</path>
											</svg></div>
										<div class="flex-1 w-0 ml-4">
											<dl>
												<dt
													class="text-sm font-medium leading-5 text-gray-500 truncate">
													Conversion Rate</dt>
												<dd class="flex items-baseline">
													<div
														class="text-3xl font-semibold leading-8 text-gray-900">
														0.03%</div>
													<div
														class="flex items-baseline ml-2 text-sm font-semibold leading-5 text-red-600">
														<svg class="self-center flex-shrink-0 w-4 w-5 h-4 h-5 text-red-500"
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
					<div class="mt-5 setting card_control-control">
						<div>
							<h3 id="all_time_card_group-head"
								class="mb-2 text-lg font-medium leading-6 text-gray-900">
								All-time</h3>
							<div class="grid grid-cols-1 gap-5 mb-10 md:grid-cols-2 lg:grid-cols-4">
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-shrink-0 text-gray-400"><svg
												id="all_time_card_group-card-0-icon" class="w-8 h-8"
												fill="none" viewBox="0 0 24 24"
												stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round"
													stroke-width="2"
													d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
												</path>
											</svg></div>
										<div class="flex-1 w-0 ml-4">
											<dl>
												<dt
													class="text-sm font-medium leading-5 text-gray-500 truncate">
													Referrals</dt>
												<dd class="flex items-baseline">
													<div
														class="text-3xl font-semibold leading-8 text-gray-900">
														62</div>
												</dd>
											</dl>
										</div>
									</div>
									<div class="px-4 py-4 text-sm leading-5 bg-gray-50 sm:px-6"><a
											class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500"
											href="https://eduwik.com/affiliate-area/referrals/"
											id="all_time_card_group-card-0-link"> View all</a></div>
								</div>
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-shrink-0 text-gray-400"><svg
												id="all_time_card_group-card-1-icon" class="w-8 h-8"
												fill="none" viewBox="0 0 24 24"
												stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round"
													stroke-width="2"
													d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
												</path>
											</svg></div>
										<div class="flex-1 w-0 ml-4">
											<dl>
												<dt
													class="text-sm font-medium leading-5 text-gray-500 truncate">
													Visits</dt>
												<dd class="flex items-baseline">
													<div
														class="text-3xl font-semibold leading-8 text-gray-900">
														91392</div>
												</dd>
											</dl>
										</div>
									</div>
									<div class="px-4 py-4 text-sm leading-5 bg-gray-50 sm:px-6"><a
											class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500"
											href="https://eduwik.com/affiliate-area/visits/"
											id="all_time_card_group-card-1-link">
											View all</a></div>
								</div>
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-shrink-0 text-gray-400"><svg
												id="all_time_card_group-card-2-icon" class="w-8 h-8"
												fill="none" viewBox="0 0 24 24"
												stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round"
													stroke-width="2"
													d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3">
												</path>
											</svg></div>
										<div class="flex-1 w-0 ml-4">
											<dl>
												<dt
													class="text-sm font-medium leading-5 text-gray-500 truncate">
													Conversion Rate</dt>
												<dd class="flex items-baseline">
													<div
														class="text-3xl font-semibold leading-8 text-gray-900">
														0.07%</div>
												</dd>
											</dl>
										</div>
									</div>
								</div>
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-shrink-0 text-gray-400"><svg
												id="all_time_card_group-card-3-icon" class="w-8 h-8"
												fill="none" viewBox="0 0 24 24"
												stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round"
													stroke-width="2"
													d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
												</path>
											</svg></div>
										<div class="flex-1 w-0 ml-4">
											<dl>
												<dt
													class="text-sm font-medium leading-5 text-gray-500 truncate">
													Unpaid Referrals</dt>
												<dd class="flex items-baseline">
													<div
														class="text-3xl font-semibold leading-8 text-gray-900">
														62</div>
												</dd>
											</dl>
										</div>
									</div>
									<div class="px-4 py-4 text-sm leading-5 bg-gray-50 sm:px-6"><a
											class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500"
											href="https://eduwik.com/affiliate-area/referrals/"
											id="all_time_card_group-card-3-link"> View all</a></div>
								</div>
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-shrink-0 text-gray-400"><svg
												id="all_time_card_group-card-4-icon" class="w-8 h-8"
												fill="none" viewBox="0 0 24 24"
												stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round"
													stroke-width="2"
													d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
												</path>
											</svg></div>
										<div class="flex-1 w-0 ml-4">
											<dl>
												<dt
													class="text-sm font-medium leading-5 text-gray-500 truncate">
													Paid Referrals</dt>
												<dd class="flex items-baseline">
													<div
														class="text-3xl font-semibold leading-8 text-gray-900">
														0</div>
												</dd>
											</dl>
										</div>
									</div>
									<div class="px-4 py-4 text-sm leading-5 bg-gray-50 sm:px-6"><a
											class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500"
											href="https://eduwik.com/affiliate-area/referrals/"
											id="all_time_card_group-card-4-link"> View all</a></div>
								</div>
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-shrink-0 text-gray-400"><svg
												id="all_time_card_group-card-5-icon" class="w-8 h-8"
												fill="none" viewBox="0 0 24 24"
												stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round"
													stroke-width="2"
													d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
												</path>
											</svg></div>
										<div class="flex-1 w-0 ml-4">
											<dl>
												<dt
													class="text-sm font-medium leading-5 text-gray-500 truncate">
													Unpaid Earnings</dt>
												<dd class="flex items-baseline">
													<div
														class="text-3xl font-semibold leading-8 text-gray-900">
														$678.53</div>
												</dd>
											</dl>
										</div>
									</div>
								</div>
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-shrink-0 text-gray-400"><svg
												id="all_time_card_group-card-6-icon" class="w-8 h-8"
												fill="none" viewBox="0 0 24 24"
												stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round"
													stroke-width="2"
													d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
												</path>
											</svg></div>
										<div class="flex-1 w-0 ml-4">
											<dl>
												<dt
													class="text-sm font-medium leading-5 text-gray-500 truncate">
													Total Earnings</dt>
												<dd class="flex items-baseline">
													<div
														class="text-3xl font-semibold leading-8 text-gray-900">
														$0.00</div>
												</dd>
											</dl>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="mt-5 setting table-control">
						<h3 id="referral-activity-table-head"
							class="mb-2 text-lg font-medium leading-6 text-gray-900">
							Recent referral activity</h3>
						<div class="px-4 mx-auto mb-10 max-w-7xl sm:px-6 md:px-8">
							<div x-data="AFFWP.portal.table.default({ & quot;perPage & quot;: 5, & quot;showPagination & quot;: false, & quot;allowSorting & quot;: false, & quot;orderby & quot;: & quot;date & quot;, & quot;type & quot;: & quot;referral - activity - table & quot; })"
								x-init="init()" x-show="!isLoading">
								<div class="flex flex-col">
									<div class="py-2 mt-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
										<div
											class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
											<table class="min-w-full">
												<thead>
													<tr><template x-for="(heading, index) in schema"
															:key="index">
															<th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-white border-b border-gray-200"
																x-on:click="handleOrderEvent( $event, heading.id )"
																:class="{ & quot;
						cursor - pointer & quot;: true === allowSorting }">
																<div class="flex"><span
																		x-text="heading.title"></span><svg
																		class="w-5 h-5 ml-1 text-gray-500"
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
																		class="w-5 h-5 ml-1 text-gray-500"
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
														<th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-white border-b border-gray-200"
															x-on:click="handleOrderEvent( $event, heading.id )"
															:class="{ & quot;
						cursor - pointer & quot;: true === allowSorting }">
															<div class="flex"><span
																	x-text="heading.title">Reference</span><svg
																	class="w-5 h-5 ml-1 text-gray-500"
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
																	class="w-5 h-5 ml-1 text-gray-500"
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
														<th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-white border-b border-gray-200"
															x-on:click="handleOrderEvent( $event, heading.id )"
															:class="{ & quot;
						cursor - pointer & quot;: true === allowSorting }">
															<div class="flex"><span
																	x-text="heading.title">Amount</span><svg
																	class="w-5 h-5 ml-1 text-gray-500"
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
																	class="w-5 h-5 ml-1 text-gray-500"
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
														<th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-white border-b border-gray-200"
															x-on:click="handleOrderEvent( $event, heading.id )"
															:class="{ & quot;
						cursor - pointer & quot;: true === allowSorting }">
															<div class="flex"><span
																	x-text="heading.title">Description</span><svg
																	class="w-5 h-5 ml-1 text-gray-500"
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
																	class="w-5 h-5 ml-1 text-gray-500"
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
														<th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-white border-b border-gray-200"
															x-on:click="handleOrderEvent( $event, heading.id )"
															:class="{ & quot;
						cursor - pointer & quot;: true === allowSorting }">
															<div class="flex"><span
																	x-text="heading.title">Status</span><svg
																	class="w-5 h-5 ml-1 text-gray-500"
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
																	class="w-5 h-5 ml-1 text-gray-500"
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
														<th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-white border-b border-gray-200"
															x-on:click="handleOrderEvent( $event, heading.id )"
															:class="{ & quot;
						cursor - pointer & quot;: true === allowSorting }">
															<div class="flex"><span
																	x-text="heading.title">Date</span><svg
																	class="w-5 h-5 ml-1 text-gray-500"
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
																	class="w-5 h-5 ml-1 text-gray-500"
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
																<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
																	x-html="getCell(index, heading.id)">
																</td>
															</template></tr>
													</template>
													<tr><template
															x-for="(heading, headingIndex) in schema"
															:key="headingIndex">
															<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
																x-html="getCell(index, heading.id)">
															</td>
														</template>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															27995</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															$5.80</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															<span class="whitespace-normal">How to
																Design Architecture Portfolio</span>
														</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															<span
																class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">Unpaid</span>
														</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															April 25, 2024 8:00 pm</td>
													</tr>
													<tr><template
															x-for="(heading, headingIndex) in schema"
															:key="headingIndex">
															<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
																x-html="getCell(index, heading.id)">
															</td>
														</template>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															25740</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															$6.34</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															<span class="whitespace-normal">How to
																Design Architecture Portfolio</span>
														</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															<span
																class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">Unpaid</span>
														</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															March 14, 2024 3:58 pm</td>
													</tr>
													<tr><template
															x-for="(heading, headingIndex) in schema"
															:key="headingIndex">
															<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
																x-html="getCell(index, heading.id)">
															</td>
														</template>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															23001</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															$4.58</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															<span class="whitespace-normal">The
																Ultimate
																Thesis Guide</span></td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															<span
																class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">Unpaid</span>
														</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															December 19, 2023 7:56 pm</td>
													</tr>
													<tr><template
															x-for="(heading, headingIndex) in schema"
															:key="headingIndex">
															<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
																x-html="getCell(index, heading.id)">
															</td>
														</template>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															22999</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															$11.60</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															<span class="whitespace-normal">How to
																Design Architecture Portfolio, How
																to Design Affordable Housing</span>
														</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															<span
																class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">Unpaid</span>
														</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															December 10, 2023 4:24 pm</td>
													</tr>
													<tr><template
															x-for="(heading, headingIndex) in schema"
															:key="headingIndex">
															<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
																x-html="getCell(index, heading.id)">
															</td>
														</template>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															22981</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															$4.56</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															<span class="whitespace-normal">The
																Ultimate
																Thesis Guide</span></td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															<span
																class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">Unpaid</span>
														</td>
														<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
															x-html="getCell(index, heading.id)">
															October 15, 2023 3:18 pm</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="flex items-center justify-between px-4 py-3 sm:px-6"
									x-show="showPagination" style="display: none;">
									<nav
										class="relative z-0 inline-flex shadow-sm affwp-pagination">
										<a class="flex items-center prev page-numbers disabled"
											role="button" id="referral-activity-table-prev-link"
											x-bind:href="urlForPage(previousPage)"
											x-on:click="handlePageEvent( $event, previousPage )"
											:class="{ 'disabled': currentPage <= 1 }"
											href="https://eduwik.com/affiliate-area/?orderby=date"><svg
												id="referral-activity-table-prev-link-icon"
												class="w-5 h-5 mr-3" fill="currentColor"
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
											class="flex items-center next page-numbers"
											role="button" id="referral-activity-table-next-link"
											x-bind:href="urlForPage(nextPage)"
											x-on:click="handlePageEvent( $event, nextPage )"
											:class="{ 'disabled': currentPage === pages }"
											href="https://eduwik.com/affiliate-area/11/?orderby=date"><svg
												id="referral-activity-table-next-link-icon"
												class="w-5 h-5 mr-3" fill="currentColor"
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
@endsection
