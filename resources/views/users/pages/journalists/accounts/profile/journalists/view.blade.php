@extends('users.layouts.master')

{!! seo($SEOData) !!}

@section('body')
<div class="container py-5">
	<div class="mb-3 row">
		<div class="col-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('home') }}" class="text-secondary fs-6 fw-medium"><i class="bi bi-house"></i></a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('journalist.account.profile.journalists.index') }}" class="text-secondary fs-6 fw-medium">Journalists</a>
					</li>
					<li class="text-purple-600 breadcrumb-item fublis-breadcrumb-item fs-6 fw-medium" aria-current="page">{{ $journalist->user->name }}</li>
				</ol>
			</nav>
		</div>
	</div>

	@include('users.includes.journalist.profile-header', ['headerTitle' => $journalist->user_id === auth()->id() ? 'Your Profile' : 'Journalist Profile'])

	<hr class="my-4 border-gray-300">

	@include('users.includes.common.profile-journalist', [
		'viewAs' => 'journalist',
	])
</div>
@endsection
