@extends('users.layouts.master')

{!! seo($SEOData) !!}

@section('body')
<div class="container py-5">
	<div class="row justify-content-center">
		<div class="col-md-11">
			<h4 class="text-purple-600 fs-3 fw-semibold m-0 py-2">Edit Press Release</h4>
			<livewire:architects.media-kits.press-releases.edit :mediaKit="$mediaKit" />
		</div>
	</div>
</div>
@endsection

@include('users.includes.architect.add-story.media-kit-form-script')
