<div class="row">
	<div class="col-sm-3">
		<div class="row g-3">
			<div class="col-12">
				<img src="{{ $architect->profileImage ? Storage::url($architect->profileImage->image_path) : 'https://via.placeholder.com/150x150' }}" style="max-width: 150px; max-height: 150px;" class="img-fluid" alt="logo">
			</div>
			<div class="col-12">
				<h4 class="text-dark fs-5 fw-semibold m-0 p-0">{{ $architect->name }}</h4>
				<p class="m-0 p-0 text-secondary">{{ $architect->position->name }}</p>
			</div>
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-geo-alt text-secondary" viewBox="0 0 16 16">
							<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
							<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
						</svg>
					</div>
					<div class="col">
						<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ $architect->company->location->name }}</span>
					</div>
				</div>
			</div>

			<div class="col-12">
				<p class="m-0 text-secondary">RENESA is an award winning creative consultancy firm dealing in Architectural & Interior design consulting across India.</p>
			</div>
		</div>
		<hr class="border-gray-300 my-4">
		<div class="row g-3">
			<div class="col-12">
				<h4 class="fs-5 text-purple-700 fw-semibold">Brand</h4>
			</div>
			<div class="col-12">
				<div class="row g-2 align-items-center">
					<div class="col-auto">
						<img src="{{ $architect->company->profileImage ? Storage::url($architect->company->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" style="max-width: 48px; max-height: 48px;" alt=".." class="img-fluid rounded-circle">
					</div>
					<div class="col">
						<h6 class="fs-6 fw-medium m-0 p-0">
							<a href="{{ route('journalist.brand.view', ['brand' => $architect->company->id]) }}" class="text-dark">
								{{ $architect->company->name }}
							</a>
						</h6>
						<p class="m-0 p-0">
							<a href="{{ $architect->company->website }}" class="text-secondary" target="_blank">
								{{ trimWebsiteUrl($architect->company->website) }}
							</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="row g-4">
			<div class="col-12">
				<div class="row align-items-center">
					<div class="col-auto">
						<span class="badge rounded-pill text-purple-700 bg-purple-100">Press Release <a href="#" class="ms-2 text-purple-700">X</i></a></span>
						<span class="badge rounded-pill text-purple-700 bg-purple-100">India <a href="#" class="ms-2 text-purple-700">X</a></span>
						<button type="button" class="btn btn-white btn-sm fw-semibold">
							<i class="bi bi-filter"></i> More filters
						</button>
					</div>
					<div class="col">
						<div class="d-flex justify-content-end">
							<div class="input-group" style="width: 280px;">
								<label class="input-group-text bg-white" for="filterSearchInput"><i class="bi bi-search"></i></label>
								<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search media kit by name" aria-label="Search" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<x-users.media-kits.journalist-list :mediaKits="$architect->mediaKits->sortByDesc('created_at')" />
			</div>
		</div>
	</div>
</div>
