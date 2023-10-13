@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	<div class="row">
		<div class="col-md-8">
			<h1 class="text-dark fs-2 fw-semibold m-0 py-2">Chengdu National History Museum Pelli Clarke & Partners + CSWADI Udaipur</h1>
			<div class="row justify-content-center g-2 py-3">
				<div class="col-auto">
					<span class="badge rounded-pill bg-purple-50 text-purple-700 fs-6 fw-medium">Article</span>
				</div>
				<div class="col-auto">
					<span class="badge rounded-pill bg-purple-50 text-purple-700 fs-6 fw-medium">Hospitality</span>
				</div>
				<div class="col-auto">
					<span class="badge rounded-pill bg-purple-50 text-purple-700 fs-6 fw-medium">India</span>
				</div>
			</div>
			<div class="row mb-4">
				<div class="col text-secondary fs-6">
					<p>
						The latest product of RENESA ARCHITECTURE DESIGN INTERIORS STUDIO, The Elgin Cafe restaurant and bar is a culmination of a day bistro with a hip bar vibe by night. Leaning on our maximalist side, we created a clean, soft space with an inviting color palette. The idea was to create an atmosphere and feel of the outdoors, where you would find yourself surrounded by greenery, natural wood, food spots, and conversations. We sought to engage in a design that would create an international hospitality experience, consequently appealing to the social media savvy clientele that enjoys cafe culture.
					</p>
					<p>
						The latest product of RENESA ARCHITECTURE DESIGN INTERIORS STUDIO, The Elgin Cafe restaurant and bar is a culmination of a day bistro with a hip bar vibe by night. Leaning on our maximalist side, we created a clean, soft space with an inviting color palette. The idea was to create an atmosphere and feel of the outdoors, where you would find yourself surrounded by greenery, natural wood, food spots, and conversations. We sought to engage in a design that would create an international hospitality experience, consequently appealing to the social media savvy clientele that enjoys cafe culture.
					</p>
					<p>
						We began by understanding the functional demands coupled with our modern and refreshing interpretation defined by design, materiality, and brand. Once inside, customers are invited to engage with the play of materials and the spaces they form in the cafe. One part forms the cafe area which has more of a day dining aesthetic while separating the private dining room through sliding folding shutters.
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<img src="https://via.placeholder.com/790x400" alt="" class="img-fluid" />
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
					<img src="https://via.placeholder.com/401x213" class="img-fluid" alt="..." />
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
			</div>
		</div>
	</div>
</div>
@endsection
