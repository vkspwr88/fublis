@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	@include('users.includes.architect.add-story-steps')

	<div class="row justify-content-center pt-5">
		<div class="col-md-11">
			<h4 class="text-purple-600 fs-3 fw-semibold m-0 py-2">Submit Project</h4>
			<livewire:architects.add-stories.project-draft :mediaKitDraft="$mediaKitDraft" />
		</div>
	</div>
</div>
@endsection

@include('users.includes.architect.add-story.media-kit-form-script')
