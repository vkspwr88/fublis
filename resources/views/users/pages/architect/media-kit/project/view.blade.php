@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	<div class="row">
		<div class="col-md-8">
			<h1 class="text-dark fs-2 fw-semibold m-0 py-2">Chengdu National History Museum Pelli Clarke & Partners + CSWADI Udaipur</h1>
			<div class="row justify-content-center g-2 py-3">
				<div class="col-auto">
					<span class="badge rounded-pill bg-purple-50 text-purple-700 fs-6 fw-medium">Project</span>
				</div>
				<div class="col-auto">
					<span class="badge rounded-pill bg-purple-50 text-purple-700 fs-6 fw-medium">Hospitality</span>
				</div>
				<div class="col-auto">
					<span class="badge rounded-pill bg-purple-50 text-purple-700 fs-6 fw-medium">India</span>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col">
					<img src="https://via.placeholder.com/791x491" alt="" class="img-fluid" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<img src="https://via.placeholder.com/250x164" alt="" class="img-fluid" />
				</div>
				<div class="col-md-4">
					<img src="https://via.placeholder.com/250x164" alt="" class="img-fluid" />
				</div>
				<div class="col-md-4">
					<img src="https://via.placeholder.com/250x164" alt="" class="img-fluid" />
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<p class="text-dark fs-6 py-2">Submitted By</p>
			<div class="row align-items-center">
				<div class="col-8">
					<div class="row g-2">
						<div class="col-auto">
							<img class="rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="text-purple-800 fs-6 fw-medium m-0 p-0">Pelli Clarke & Partners</p>
							<p class="fs-6 m-0 p-0">
								<a href="#" class="text-secondary">www.pcparch.com</a>
							</p>
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="row g-2 justify-content-end">
						<div class="col-auto">
							<a href="{{ route('architect.media-kit.project.edit', ['id' => 'id']) }}" class="text-purple-600">
								<i class="bi bi-pencil-square"></i>
							</a>
						</div>
						<div class="col-auto">
							<a href="{{ route('architect.media-kit.project.edit', ['id' => 'id']) }}" class="text-purple-600">
								<i class="bi bi-share-fill"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
			<hr class="border-gray-300">
			<div class="row">
				<div class="col-12">
					<div class="row g-2 pb-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-pin-map"></i></p></div>
						<div class="col">
							<p class="m-0 p-0 text-secondary fs-6">
								<span class="fw-bold">Location </span>
								<span>- Amritsar</span>
							</p>
						</div>
					</div>
					<div class="row g-2 pb-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-textarea"></i></p></div>
						<div class="col">
							<p class="m-0 p-0 text-secondary fs-6">
								<span class="fw-bold">Area </span>
								<span>- 1500 sq. ft</span>
							</p>
						</div>
					</div>
					<div class="row g-2 pb-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-calendar4"></i></p></div>
						<div class="col">
							<p class="m-0 p-0 text-secondary fs-6">
								<span class="fw-bold">Year </span>
								<span>- 2021</span>
							</p>
						</div>
					</div>
					<div class="row g-2 pb-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-building"></i></p></div>
						<div class="col">
							<p class="m-0 p-0 text-secondary fs-6">
								<span class="fw-bold">Typology </span>
								<span>- Hospitality</span>
							</p>
						</div>
					</div>
					<div class="row g-2 pb-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-pencil"></i></p></div>
						<div class="col">
							<p class="m-0 p-0 text-secondary fs-6">
								<span class="fw-bold">Text Credits </span>
								<span>- Studio Renesa</span>
							</p>
						</div>
					</div>
					<div class="row g-2 pb-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-camera"></i></p></div>
						<div class="col">
							<p class="m-0 p-0 text-secondary fs-6">
								<span class="fw-bold">Photography Credits </span>
								<span>- Niveditaa Gupta</span>
							</p>
						</div>
					</div>
					<div class="row g-2 pb-2">
						<div class="col-auto"><p class="mx-auto my-1"><i class="bi bi-people"></i></p></div>
						<div class="col">
							<p class="m-0 p-0 text-secondary fs-6">
								<span class="fw-bold">Design Team </span>
								<span>- Anushka Arora, Akarsh Varma, Aayush Misra, Tarun Tyagi, Prityaanshi Agarwal, Tarun Tyagi, Prityaanshi Agarwal, Agarwal, Tarun Tyagi, Prityaanshi Agarwal</span>
							</p>
						</div>
					</div>
				</div>
			</div>
			<hr class="border-gray-300">
			<div class="row align-items-center">
				<div class="col">
					<p class="text-dark fs-6 m-0">Description</p>
				</div>
				<div class="col text-end">
					<button class="btn btn-primary fs-6 fw-medium" type="button">Download</button>
				</div>
			</div>
			<hr class="border-gray-300">
			<div class="row align-items-center">
				<div class="col">
					<p class="text-dark fs-6 m-0">Gallery</p>
				</div>
				<div class="col text-end">
					<button class="btn btn-primary fs-6 fw-medium" type="button">Download</button>
				</div>
			</div>
			<hr class="border-gray-300">
			<div class="row">
				<div class="col-12">
					<p class="text-dark fs-6 m-0 pb-2">Media Contact</p>
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col-auto">
							<p class="text-purple-800 fs-6 fw-medium m-0 p-0">Vikas Pawar</p>
							<p class="text-secondary fs-6 m-0 p-0">Architect</p>
						</div>
						<div class="col-auto text-purple-700"><i class="bi bi-arrow-up-right"></i></div>
					</div>
				</div>
				{{-- <div class="col-12 row align-items-center">

				<div class="col-4 row">
				<div class="col-12 row">
				<p class="text-purple fs-6 fw-medium font-family-Inter col-10 m-0 px-3 py-2">Vikas Pawar</p>
				</div>
				<p class="text-secondary fs-6 fw-normal font-family-Inter col-12 m-0 px-3 py-2">Architect</p>
				</div>
				<div class="position-relative col-1"></div>
				</div> --}}
			</div>
		</div>
	</div>
</div>
@endsection
