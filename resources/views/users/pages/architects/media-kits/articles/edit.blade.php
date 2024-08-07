@extends('users.layouts.master')

{!! seo($SEOData) !!}

@section('body')
<div class="container py-5">
	<div class="row justify-content-center">
		<div class="col-md-11">
			<h4 class="text-purple-600 fs-3 fw-semibold m-0 py-2">Edit Article</h4>
			<livewire:architects.media-kits.articles.edit :mediaKit="$mediaKit" />
		</div>
	</div>
</div>
@endsection
