@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	@include('users.includes.common.profile-press-release', ['mediaKit' => $mediaKit, 'allowedEdit' => false])
</div>
@endsection
