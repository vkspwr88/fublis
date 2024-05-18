@extends('users.layouts.master')

{!! seo() !!}

@if($selectedChat != '')
	@push('styles')
		@vite('resources/js/app.js')
	@endpush
@endif

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
						<a href="javascript:;" class="text-secondary fs-6 fw-medium">Account</a>
					</li>
					{{-- <li class="breadcrumb-item fublis-breadcrumb-item">
						<a href="{{ route('journalist.account.profile.index') }}" class="text-secondary fs-6 fw-medium">Profile</a>
					</li> --}}
					<li class="text-purple-600 breadcrumb-item fublis-breadcrumb-item fs-6 fw-medium" aria-current="page">Messages</li>
				</ol>
			</nav>
		</div>
	</div>

	@include('users.includes.journalist.profile-header', ['headerTitle' => 'Messages'])

	<hr class="my-4 border-gray-300">

	<div id="app"></div>
</div>
@endsection
@if($selectedChat != '')
	@push('scripts')
		<x-users.pusher.script
			:selectedChat="$selectedChat"
			:subjectsRoute="$subjectsRoute"
			:chatsRoute="$chatsRoute"
			:sendMessageRoute="$sendMessageRoute"
		/>
	@endpush
@endif
