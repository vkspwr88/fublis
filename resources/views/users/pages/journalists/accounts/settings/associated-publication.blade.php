@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	@include('users.includes.journalist.setting-breadcrumb')

	@include('users.includes.journalist.profile-header', ['headerTitle' => 'Account Details'])

	<hr class="border-gray-300 my-4">

	@include('users.includes.journalist.setting-nav', ['setting' => 'Associated Publications'])

	<livewire:journalists.settings.associated-publication />
</div>
@endsection

@include('users.includes.common.profile-script')
