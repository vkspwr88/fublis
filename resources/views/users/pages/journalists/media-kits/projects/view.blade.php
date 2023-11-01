@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	@include('users.includes.common.profile-project', ['mediaKit' => $mediaKit, 'allowedEdit' => true])
</div>
@endsection
