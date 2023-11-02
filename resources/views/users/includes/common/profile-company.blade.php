<div class="row">
	<div class="col-sm-3">
		<div class="row g-3">
			<div class="col-12">
				<img src="{{ $brand->profileImage ? Storage::url($brand->profileImage) : 'https://via.placeholder.com/150x150' }}" style="max-width: 150px; max-height: 150px;" class="img-fluid" alt="logo">
			</div>
			<div class="col-12">
				<h4 class="text-dark fs-5 fw-semibold m-0 p-0">{{ $brand->name }}</h4>
				<p class="m-0 p-0"><a href="{{ $brand->website }}" class="text-secondary" target="_blank">{{ trimWebsiteUrl($brand->website) }}</a></p>
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
						<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ $brand->location->name }}</span>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-link text-secondary" viewBox="0 0 16 16">
							<path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/>
							<path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z"/>
						</svg>
					</div>
					<div class="col">
						<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ trimWebsiteUrl($brand->website) }}</span>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-calendar2-minus text-secondary" viewBox="0 0 16 16">
							<path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
							<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
							<path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"/>
						</svg>
					</div>
					<div class="col">
						<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ $brand->starting_year ?? '-' }}</span>
				</div>
			</div>
			</div>
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-grid text-secondary" viewBox="0 0 16 16">
							<path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
						</svg>
					</div>
					<div class="col">
						<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ $brand->category->name }}</span>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-instagram text-secondary" viewBox="0 0 16 16">
							<path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
						</svg>
					</div>
					<div class="col">
						<span class="badge rounded-pill text-gray-700 bg-gray-200">{{ $brand->instagram ?? '-' }}</span>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row g-2">
					<div class="col-auto">
						<svg xmlns="http://www.w3.org/2000/svg" height="19" fill="currentColor" class="bi bi-tag text-secondary" style="margin-top: 5px;" viewBox="0 0 16 16">
							<path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z"/>
							<path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z"/>
						</svg>
					</div>
					<div class="col">
						@foreach ($tags as $tag)
						<span class="badge rounded-pill text-purple-700 bg-purple-100">{{ $tag }}</span>
						@endforeach
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
				<h4 class="fs-5 text-dark fw-semibold">Team Members</h4>
			</div>
			<div class="col-12">
				@foreach ($brand->architects as $architect)
				<div class="row g-2 align-items-center">
					<div class="col-auto">
						<img src="{{ $architect->profileImage ? Storage::url($architect->profileImage) : 'https://via.placeholder.com/48x48' }}" style="max-width: 48px; max-height: 48px;" alt=".." class="img-fluid rounded-circle">
					</div>
					<div class="col">
						<a href="{{ route('journalist.brand.architect', ['architect' => $architect->id]) }}">
							<h6 class="text-purple-800 fw-medium m-0 p-0">{{ $architect->user->name }}</h6>
							<p class="text-secondary m-0 p-0">{{ $architect->position->name }}</p>
						</a>
					</div>
				</div>
				@endforeach
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
				<x-users.media-kits.journalist-list :mediaKits="$brand->mediaKits->sortByDesc('created_at')" />
			</div>
		</div>
	</div>
</div>