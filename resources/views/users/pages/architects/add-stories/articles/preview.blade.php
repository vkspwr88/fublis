@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	@include('users.includes.common.profile-article', ['mediaKit' => $mediaKit, 'allowedEdit' => $mediaKit->architect->user->id === auth()->id(), 'viewAs' => 'architect', 'drafted' => true])
</div>
@endsection
