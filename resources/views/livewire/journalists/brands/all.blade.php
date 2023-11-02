<div class="row g-4">
	@forelse ($brands as $brand)
	<div class="col-12">
		<div class="card border-0 rounded-3 bg-white shadow">
			<div class="card-body">
				<div class="row gx-2 gy-4">
					<div class="col-sm-3">
						<div class="d-block mx-auto text-center">
							<img src="{{ ($brand->profileImage != null) ? Storage::url($brand->profileImage->image_path) : 'https://via.placeholder.com/150x150' }}" class="img-fluid" alt="{{ $brand->name }} logo">
						</div>
					</div>
					<div class="col-sm-9">
						<div class="row align-items-center">
							<p class="fs-6 col m-0">
								<span class="badge rounded-pill text-dark bg-light mb-1">
									<i class="bi bi-geo-alt"></i>
									{{ $brand->location->name }}
								</span>
								<span class="badge rounded-pill text-dark bg-light mb-1">
									{{ $brand->category->name }}
								</span>
							</p>
							<p class="text-end fs-6 col m-0">
								<a href="{{ route('journalist.brand.view', ['brand' => $brand->id]) }}" class="btn btn-primary btn-sm rounded-pill">
									View Media Kits <i class="bi bi-arrow-up-right small"></i>
								</a>
							</p>
						</div>
						<div class="row g-2">
							<div class="col-12">
								<h5 class="fs-5 fw-semibold m-0 pt-3 text-dark">
									{{ $brand->name }}
								</h5>
								<p class="fs-6 m-0 p-0">
									<a href="{{ $brand->website }}" class="text-secondary small" target="_blank">{{ trimWebsiteUrl($brand->website) }}</a>
								</p>
							</div>
							<div class="col-12">
								<p class="m-0 p-0"><small>The House of Things Launches IRA Udaipur - A new luxury product lifestyle product label that celebrates the arts of Rajasthan & the romance of erstwhile Mewar</small></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@empty
	<div class="col-12">
		<div class="card border-0 rounded-3 bg-white shadow">
			<div class="card-body">
				<div class="py-5">
					<h4 class="fs-4 text-purple-800 text-center">No Result Found</h4>
				</div>
			</div>
		</div>
	</div>
	@endforelse

</div>
