@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	@include('users.includes.journalist.setting-breadcrumb')

	@include('users.includes.journalist.profile-header', ['headerTitle' => 'Account Details'])

	<hr class="border-gray-300 my-4">

	@include('users.includes.journalist.setting-nav', ['setting' => 'Your Publications'])

	<livewire:journalists.settings.publication />
</div>
@endsection
