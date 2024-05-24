@extends('users.layouts.affiliates.master')

@section('body')
	<h1 id="graphs-head" class="mb-5 text-3xl font-semibold text-gray-900 sm:mb-10">Graphs</h1>
	<div class="mt-10 sm:mt-0">
		<div class="md:grid md:grid-cols-3 md:gap-6">
			<div class="mt-5 overflow-hidden md:mt-0 sm:rounded-md md:col-span-3 lg:col-span-3">
				<div>
					<div class="setting chart_control-control">
						<h2 id="referral-earnings-chart-head" class="mb-3 text-xl font-medium leading-6 text-gray-900">
							Earnings</h2>
						<div class="w-full" x-data="AFFWP.portal.chart.default({ type: 'referral-earnings-chart' })"
							x-init="init()" x-show="!isLoading">
							<div class="chartjs-size-monitor">
								<div class="chartjs-size-monitor-expand">
									<div class=""></div>
								</div>
								<div class="chartjs-size-monitor-shrink">
									<div class=""></div>
								</div>
							</div>
							<form method="post" @submit="handleSubmit($event)">
								<div class="sm:flex">
									<div class="w-64 max-w-xs rounded-md shadow-sm sm:mr-2"><select
											class="block w-full affwp-graphs-date-options form-select transition2 duration-1502 ease-in-out2 sm:text-sm sm:leading-5"
											@change="handleSelectChange($event)"><template
												x-for="( dateQuery, index ) in dateQueries" :key="index">
												<option x-text="dateQuery.label" x-bind:value="dateQuery.key"></option>
											</template>
											<option x-text="dateQuery.label" x-bind:value="dateQuery.key" value="today">
												Today</option>
											<option x-text="dateQuery.label" x-bind:value="dateQuery.key"
												value="yesterday">Yesterday</option>
											<option x-text="dateQuery.label" x-bind:value="dateQuery.key"
												value="this_week">This Week</option>
											<option x-text="dateQuery.label" x-bind:value="dateQuery.key"
												value="last_week">Last Week</option>
											<option x-text="dateQuery.label" x-bind:value="dateQuery.key"
												value="this_month">This Month</option>
											<option x-text="dateQuery.label" x-bind:value="dateQuery.key"
												value="last_month">Last Month</option>
											<option x-text="dateQuery.label" x-bind:value="dateQuery.key"
												value="this_quarter">This Quarter</option>
											<option x-text="dateQuery.label" x-bind:value="dateQuery.key"
												value="last_quarter">Last Quarter</option>
											<option x-text="dateQuery.label" x-bind:value="dateQuery.key"
												value="this_year">This Year</option>
											<option x-text="dateQuery.label" x-bind:value="dateQuery.key"
												value="last_year">Last Year</option>
										</select></div><span class="inline-flex rounded-md shadow-sm"><button
											type="submit" value="Filter"
											class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue hover:bg-indigo-500 focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 active:bg-indigo-600"
											id="filter">Filter</button></span>
								</div>
							</form><canvas x-ref="canvas" id="chart-canvas"
								style="display: block; height: 490px; width: 981px;" height="534" width="1070"
								class="chartjs-render-monitor"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
