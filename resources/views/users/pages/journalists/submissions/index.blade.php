@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	<div class="row mb-3">
		<div class="col-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('home') }}" class="text-secondary fs-6 fw-medium"><i class="bi bi-house"></i></a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item text-purple-600 fs-6 fw-medium" aria-current="page">Submissions</li>
				</ol>
			</nav>
		</div>
	</div>

	@include('users.includes.journalist.brand-header', ['headerTitle' => 'Submissions for your calls'])

	<hr class="border-gray-300 my-4">

	<livewire:journalists.submissions.index />
</div>
@endsection
