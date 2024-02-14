@extends('users.layouts.master')

{!! seo() !!}

{{-- @push('styles')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush --}}

@section('body')
<div class="container py-5">
	@include('users.includes.architect.add-story-steps')

	<div class="row justify-content-center pt-5">
		<div class="col-md-11">
			<h4 class="text-purple-600 fs-3 fw-semibold m-0 py-2">Submit Press Release</h4>
			<livewire:architects.add-stories.press-release-draft :mediaKitDraft="$mediaKitDraft" />
		</div>
	</div>
</div>
@endsection

@include('users.includes.architect.add-story.media-kit-form-script')
