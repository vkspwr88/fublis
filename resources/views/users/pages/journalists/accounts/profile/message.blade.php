@extends('users.layouts.master')

{!! seo() !!}

@push('styles')
@vite('resources/js/app.js')
@endpush

@section('body')
<div class="container py-5">
	<div class="row mb-3">
		<div class="col-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('home') }}" class="text-secondary fs-6 fw-medium"><i class="bi bi-house"></i></a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="javascript:;" class="text-secondary fs-6 fw-medium">Account</a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('journalist.account.profile.index') }}" class="text-secondary fs-6 fw-medium">Profile</a>
					</li>
					<li class="breadcrumb-item fublis-breadcrumb-item text-purple-600 fs-6 fw-medium" aria-current="page">Messages</li>
				</ol>
			</nav>
		</div>
	</div>

	@include('users.includes.journalist.profile-header', ['headerTitle' => 'Messages'])

	<hr class="border-gray-300 my-4">

	<div id="app"></div>
</div>
@endsection

@push('scripts')
<x-users.pusher.script
	:selectedChat="$selectedChat"
	:subjectsRoute="$subjectsRoute"
	:chatsRoute="$chatsRoute"
	:sendMessageRoute="$sendMessageRoute"
/>
@endpush
