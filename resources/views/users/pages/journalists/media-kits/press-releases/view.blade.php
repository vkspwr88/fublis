@extends('users.layouts.master')

{!! seo($SEOData) !!}

@section('body')
<div class="container py-5">
	@include('users.includes.common.profile-press-release', ['mediaKit' => $mediaKit, 'allowedEdit' => false, 'viewAs' => 'journalist'])
</div>
@endsection
