<h2 class="m-0 py-2 text-secondary fs-3 fw-semibold">{{ $title }}</h2>
	<p class="m-0 py-2 text-secondary">
		<span class="fw-medium"><i>submitted by</i></span>
		<span class="text-purple fw-bold">{{ auth()->user()->name }}</span>
	</p>
	<hr class="border-gray-300 my-3">
	<div class="row g-4">
		<div class="col-md-4">
			<p class="text-secondary fw-semibold m-0 p-0">Call for Submissions</p>
		</div>
		<div class="col-md-8">{{ $description }}</div>
	</div>
	<hr class="border-gray-300 my-3">
	<div class="row g-4">
		<div class="col-md-4">
			<p class="text-secondary fw-semibold m-0 p-0">Submission Deadline</p>
		</div>
		<div class="col-md-8">{{ $submissionEndsDate }}</div>
	</div>
	<hr class="border-gray-300 my-3">
	<div class="row g-4">
		<div class="col-md-4">
			<p class="text-secondary fw-semibold m-0 p-0">Publication</p>
		</div>
		<div class="col-md-8">
			<div class="row align-items-center">
				<div class="col-auto">
					<img class="rounded-circle" src="https://via.placeholder.com/45x45" alt=".." />
				</div>
				<div class="col">
					<p class="text-secondary fw-semibold m-0 p-0">{{ $publication->name }}</p>
					<p class="text-secondary m-0 p-0"><span class="small">{{ trimWebsiteUrl($publication->website) }}</span></p>
				</div>
			</div>
		</div>
	</div>
	<hr class="border-gray-300 my-3">
	<div class="row g-4">
		<div class="col-md-4">
			<p class="text-secondary fw-semibold m-0 p-0">Tags</p>
		</div>
		<div class="col-md-8">
			<div class="row justify-content-start gx-1 gy-3">
				<div class="col-auto">
					<span class="badge rounded-pill bg-purple-50 text-purple-700 fw-medium">{{ $category->name }}</span>
				</div>
				<div class="col-auto">
					<span class="badge rounded-pill bg-purple-50 text-purple-700 fw-medium">{{ $language->name }}</span>
				</div>
				<div class="col-auto">
					<span class="badge rounded-pill bg-purple-50 text-purple-700 fw-medium">{{ $location->name }}</span>
				</div>
			</div>
		</div>
	</div>
