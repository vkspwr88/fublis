@extends('users.layouts.affiliates.master')

@section('body')
	<h1 id="stats-head" class="mb-5 text-3xl font-semibold text-gray-900 sm:mb-10">Statistics</h1>
	<div class="mt-10 sm:mt-0">
		<div class="md:grid md:grid-cols-3 md:gap-6">
			<div class="mt-5 overflow-hidden md:mt-0 sm:rounded-md md:col-span-3 lg:col-span-3">
				<div>
					<div class="setting card_control-control">
						<div>
							<div class="grid grid-cols-1 gap-5 mb-10 md:grid-cols-2 lg:grid-cols-4">
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-1">
											<dl>
												<dt class="text-sm font-medium leading-5 text-gray-500 truncate">Unpaid
													referrals</dt>
												<dd class="flex items-baseline">
													<div class="text-3xl font-semibold leading-8 text-gray-900">0</div>
												</dd>
											</dl>
										</div>
									</div>
								</div>
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-1">
											<dl>
												<dt class="text-sm font-medium leading-5 text-gray-500 truncate">Paid
													referrals</dt>
												<dd class="flex items-baseline">
													<div class="text-3xl font-semibold leading-8 text-gray-900">0</div>
												</dd>
											</dl>
										</div>
									</div>
								</div>
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-1">
											<dl>
												<dt class="text-sm font-medium leading-5 text-gray-500 truncate">Visits
												</dt>
												<dd class="flex items-baseline">
													<div class="text-3xl font-semibold leading-8 text-gray-900">0</div>
												</dd>
											</dl>
										</div>
									</div>
								</div>
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-1">
											<dl>
												<dt class="text-sm font-medium leading-5 text-gray-500 truncate">
													Conversion rate</dt>
												<dd class="flex items-baseline">
													<div class="text-3xl font-semibold leading-8 text-gray-900">0%</div>
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
							<div class="grid grid-cols-1 gap-5 mb-10 md:grid-cols-2 lg:grid-cols-4">
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-1">
											<dl>
												<dt class="text-sm font-medium leading-5 text-gray-500 truncate">Unpaid
													earnings</dt>
												<dd class="flex items-baseline">
													<div class="text-3xl font-semibold leading-8 text-gray-900">$0.00
													</div>
												</dd>
											</dl>
										</div>
									</div>
								</div>
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-1">
											<dl>
												<dt class="text-sm font-medium leading-5 text-gray-500 truncate">Paid
													earnings</dt>
												<dd class="flex items-baseline">
													<div class="text-3xl font-semibold leading-8 text-gray-900">$0.00
													</div>
												</dd>
											</dl>
										</div>
									</div>
								</div>
								<div
									class="flex flex-col overflow-hidden bg-white rounded-lg shadow place-content-between">
									<div class="flex items-center px-4 py-5 sm:p-6">
										<div class="flex-1">
											<dl>
												<dt class="text-sm font-medium leading-5 text-gray-500 truncate">
													Commission rate</dt>
												<dd class="flex items-baseline">
													<div class="text-3xl font-semibold leading-8 text-gray-900">20%
													</div>
												</dd>
											</dl>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="mt-5 setting table-control">
						<h3 id="campaigns-table-head" class="mb-2 text-lg font-medium leading-6 text-gray-900">Campaigns
						</h3>
						<div class="px-4 mx-auto mb-10 max-w-7xl sm:px-6 md:px-8">
							<div x-data="AFFWP.portal.table.default({&quot;allowSorting&quot;:false,&quot;type&quot;:&quot;campaigns-table&quot;,&quot;perPage&quot;:20})"
								x-init="init()" x-show="!isLoading">
								<div class="flex flex-col">
									<div class="py-2 mt-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
										<div
											class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
											<table class="min-w-full">
												<thead>
													<tr><template x-for="(heading, index) in schema" :key="index">
															<th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-white border-b border-gray-200"
																x-on:click="handleOrderEvent( $event, heading.id )"
																:class="{&quot;cursor-pointer&quot;: true === allowSorting}">
																<div class="flex"><span
																		x-text="heading.title"></span><svg
																		class="w-5 h-5 ml-1 text-gray-500"
																		id="campaigns-table-sort-desc-icon"
																		x-show="'desc' === getSortOrder(heading.id)"
																		fill="none" viewBox="0 0 24 24"
																		stroke="currentColor">
																		<path stroke-linecap="round"
																			stroke-linejoin="round" stroke-width="2"
																			d="M19 9l-7 7-7-7"></path>
																	</svg><svg class="w-5 h-5 ml-1 text-gray-500"
																		id="campaigns-table-sort-asc-icon"
																		x-show="'asc' === getSortOrder(heading.id)"
																		fill="none" viewBox="0 0 24 24"
																		stroke="currentColor">
																		<path stroke-linecap="round"
																			stroke-linejoin="round" stroke-width="2"
																			d="M5 15l7-7 7 7"></path>
																	</svg></div>
															</th>
														</template>
														<th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-white border-b border-gray-200"
															x-on:click="handleOrderEvent( $event, heading.id )"
															:class="{&quot;cursor-pointer&quot;: true === allowSorting}">
															<div class="flex"><span
																	x-text="heading.title">Campaign</span><svg
																	class="w-5 h-5 ml-1 text-gray-500"
																	id="campaigns-table-sort-desc-icon"
																	x-show="'desc' === getSortOrder(heading.id)"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor" style="display: none;">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2" d="M19 9l-7 7-7-7"></path>
																</svg><svg class="w-5 h-5 ml-1 text-gray-500"
																	id="campaigns-table-sort-asc-icon"
																	x-show="'asc' === getSortOrder(heading.id)"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor" style="display: none;">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2" d="M5 15l7-7 7 7"></path>
																</svg></div>
														</th>
														<th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-white border-b border-gray-200"
															x-on:click="handleOrderEvent( $event, heading.id )"
															:class="{&quot;cursor-pointer&quot;: true === allowSorting}">
															<div class="flex"><span
																	x-text="heading.title">Visits</span><svg
																	class="w-5 h-5 ml-1 text-gray-500"
																	id="campaigns-table-sort-desc-icon"
																	x-show="'desc' === getSortOrder(heading.id)"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor" style="display: none;">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2" d="M19 9l-7 7-7-7"></path>
																</svg><svg class="w-5 h-5 ml-1 text-gray-500"
																	id="campaigns-table-sort-asc-icon"
																	x-show="'asc' === getSortOrder(heading.id)"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor" style="display: none;">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2" d="M5 15l7-7 7 7"></path>
																</svg></div>
														</th>
														<th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-white border-b border-gray-200"
															x-on:click="handleOrderEvent( $event, heading.id )"
															:class="{&quot;cursor-pointer&quot;: true === allowSorting}">
															<div class="flex"><span x-text="heading.title">Unique
																	Links</span><svg class="w-5 h-5 ml-1 text-gray-500"
																	id="campaigns-table-sort-desc-icon"
																	x-show="'desc' === getSortOrder(heading.id)"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor" style="display: none;">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2" d="M19 9l-7 7-7-7"></path>
																</svg><svg class="w-5 h-5 ml-1 text-gray-500"
																	id="campaigns-table-sort-asc-icon"
																	x-show="'asc' === getSortOrder(heading.id)"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor" style="display: none;">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2" d="M5 15l7-7 7 7"></path>
																</svg></div>
														</th>
														<th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-white border-b border-gray-200"
															x-on:click="handleOrderEvent( $event, heading.id )"
															:class="{&quot;cursor-pointer&quot;: true === allowSorting}">
															<div class="flex"><span
																	x-text="heading.title">Converted</span><svg
																	class="w-5 h-5 ml-1 text-gray-500"
																	id="campaigns-table-sort-desc-icon"
																	x-show="'desc' === getSortOrder(heading.id)"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor" style="display: none;">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2" d="M19 9l-7 7-7-7"></path>
																</svg><svg class="w-5 h-5 ml-1 text-gray-500"
																	id="campaigns-table-sort-asc-icon"
																	x-show="'asc' === getSortOrder(heading.id)"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor" style="display: none;">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2" d="M5 15l7-7 7 7"></path>
																</svg></div>
														</th>
														<th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-white border-b border-gray-200"
															x-on:click="handleOrderEvent( $event, heading.id )"
															:class="{&quot;cursor-pointer&quot;: true === allowSorting}">
															<div class="flex"><span x-text="heading.title">Conversion
																	Rate</span><svg class="w-5 h-5 ml-1 text-gray-500"
																	id="campaigns-table-sort-desc-icon"
																	x-show="'desc' === getSortOrder(heading.id)"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor" style="display: none;">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2" d="M19 9l-7 7-7-7"></path>
																</svg><svg class="w-5 h-5 ml-1 text-gray-500"
																	id="campaigns-table-sort-asc-icon"
																	x-show="'asc' === getSortOrder(heading.id)"
																	fill="none" viewBox="0 0 24 24"
																	stroke="currentColor" style="display: none;">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		stroke-width="2" d="M5 15l7-7 7 7"></path>
																</svg></div>
														</th>
													</tr>
												</thead>
												<tbody class="bg-white divide-y divide-gray-200"><template
														x-for="(row, index) in rows" :key="index">
														<tr><template x-for="(heading, headingIndex) in schema"
																:key="headingIndex">
																<td class="px-6 py-4 text-sm font-medium leading-5 text-gray-500 whitespace-no-wrap"
																	x-html="getCell(index, heading.id)"></td>
															</template></tr>
													</template></tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="flex items-center justify-between px-4 py-3 sm:px-6" x-show="showPagination"
									style="display: none;">
									<nav class="relative z-0 inline-flex shadow-sm affwp-pagination"><a
											class="flex items-center prev page-numbers disabled" role="button"
											id="campaigns-table-prev-link" x-bind:href="urlForPage( previousPage )"
											x-on:click="handlePageEvent( $event, previousPage )"
											:class="{'disabled': currentPage <= 1}"
											href="https://eduwik.com/affiliate-area/stats/"><svg
												id="campaigns-table-prev-link-icon" class="w-5 h-5 mr-3"
												fill="currentColor" viewBox="0 0 20 20">
												<path fill-rule="evenodd"
													d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
													clip-rule="evenodd"></path>
											</svg> </a><template x-for="pageObject in getPages()"
											:key="pageObject.page"><a class="page-numbers" role="button"
												id="campaigns-table-page-numbers"
												x-bind:href="urlForPage( pageObject.page )"
												x-on:click="handlePageEvent( $event, pageObject.page )"
												:class="{'disabled': pageObject.disabled}" x-text="pageObject.page">
											</a></template><a class="flex items-center next page-numbers" role="button"
											id="campaigns-table-next-link" x-bind:href="urlForPage( nextPage )"
											x-on:click="handlePageEvent( $event, nextPage )"
											:class="{'disabled': currentPage === pages}"
											href="https://eduwik.com/affiliate-area/stats/"><svg
												id="campaigns-table-next-link-icon" class="w-5 h-5 mr-3"
												fill="currentColor" viewBox="0 0 20 20">
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
