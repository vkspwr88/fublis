@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	@include('users.includes.architect.setting-breadcrumb')

	@include('users.includes.architect.setting-header')

	<hr class="border-gray-300 my-4">

	@include('users.includes.architect.setting-nav', ['setting' => 'Company'])

	<livewire:architects.settings.company />
</div>
@endsection

@include('users.includes.common.profile-script')
